<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourStoreRequest;
use App\Models\Category;
use App\Models\Match1Answers;
use App\Models\MatchInfo;
use App\Models\Question;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

    }

    public function index()
    {
        $tours = Tour::all();
        return view('tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $categories = Category::all();
        return view('tours.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TourStoreRequest $request)
    {

        $cover_image = '';
        if($request->hasFile('cover_image')){
            $cover_image = Storage::disk('public')->put('cover_images', $request->cover_image);
        }

        $data = [
            ...$request->except(['cover_image','questions']),
            'cover_image' => $cover_image,
            'user_id' => Auth::id(),
        ];

        $tour = Tour::create($data);
        $questions = json_decode($request->questions, true);

        if($tour){
            foreach($questions as $question){
                $question = Question::create([
                    'tour_id' => $tour->id,
                    'question_text' => $question['text'],
                    'options' => json_encode($question['options'])
                ]);
            }
            return redirect()->route('tour.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        return view('tours.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //
    }

    public function visit(Tour $tour){
        return view('tours.visit', compact('tour'));
    }

    public function purchase(Request $request){
        $tour = Tour::find($request->id);
        if($tour){
            $tour->users()->attach(Auth::id());
            $user = Auth::user();
            $user->wallet = $user->wallet - 1;
            $user->save();
            return redirect()->route('tour.visit', ['tour' => $tour->id]);
        }
    }

    public function startMatch($id){
        $tour = Tour::find($id);
        $questions = $tour->questions;
        $checkMatch = MatchInfo::where('tour_id', $tour->id)->where('user_id', Auth::id())->first();
        if(!$checkMatch){
            $match = MatchInfo::create([
                'tour_id' => $tour->id,
                'user_id' => Auth::id(),
                'start_time' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'match' => $match,
                // 'startmatch' => 'match1',
                'questions' => $questions,
            ]);
        }else{
            return response()->json([
                'status' => 'success',
                'match' => $checkMatch,
                // 'startmatch' => 'match1',
                'questions' => $questions,
            ]);
        }
    }

    public function submitAnswers(Request $request, $id){
        $match = MatchInfo::find($id);
        if($match){
            foreach($request->answers as $q => $answer){
                $answer = Match1Answers::create([
                            'match_info_id' => $match->id,
                            'question_id' => $q,
                            'user_answer' => $answer,
                        ]);
            }

            return response()->json([
                'status' => 'success',
                'match1Answers' => $match->match1Answers,
            ]);

        }
    }
}
