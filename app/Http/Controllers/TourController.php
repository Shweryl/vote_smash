<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourStoreRequest;
use App\Models\Category;
use App\Models\Match1Answers;
use App\Models\MatchInfo;
use App\Models\Mvc;
use App\Models\Question;
use App\Models\Tour;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {}

    public function index()
    {
        $tours = Tour::all();
        $userPurchasedTours = Auth::user()->tours;
        return view('tours.index', compact('tours','userPurchasedTours'));
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
        if ($request->hasFile('cover_image')) {
            $cover_image = Storage::disk('public')->put('cover_images', $request->cover_image);
        }

        $data = [
            ...$request->except(['cover_image', 'questions']),
            'cover_image' => $cover_image,
            'user_id' => Auth::id(),
        ];

        $tour = Tour::create($data);
        $questions = json_decode($request->questions, true);

        if ($tour) {
            foreach ($questions as $question) {
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

    public function visit(Tour $tour, Request $request)
    {

        return view('tours.visit', compact('tour'));
    }

    public function purchase(Request $request)
    {
        $tour = Tour::find($request->id);
        if ($tour) {
            $tour->users()->attach(Auth::id());
            $user = Auth::user();
            $user->wallet = $user->wallet - 1;
            $user->save();
            return redirect()->route('tour.visit', ['tour' => $tour->id]);
        }
    }

    public function startMatch($id)
    {
        $tour = Tour::find($id);
        $questions = $tour->questions;
        $checkMatch = MatchInfo::where('tour_id', $tour->id)->where('user_id', Auth::id())->first();
        if (!$checkMatch) {
            $match = MatchInfo::create([
                'tour_id' => $tour->id,
                'user_id' => Auth::id(),
                'start_time' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'match' => $match,
                // 'startmatch' => 'match1',
                'questions' => $questions,
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'match' => $checkMatch,
                // 'startmatch' => 'match1',
                'questions' => $questions,
            ]);
        }
    }

    public function submitAnswers(Request $request, $id)
    {
        $match = MatchInfo::find($id);
        if ($match) {
            foreach ($request->answers as $q => $answer) {
                $answer = Match1Answers::create([
                    'match_info_id' => $match->id,
                    'question_id' => $q,
                    'user_answer' => $answer,
                ]);
            }

            $match->load('match1Answers');

            return response()->json([
                'status' => 'success',
                'match' => $match,
            ]);
        }
    }

    public function submitMVC(Request $request, $id)
    {
        $match = MatchInfo::find($id);
        $mvcs = $request->mvcs;


        $chargeMvcAmount = 0;
        $chargeConfidenceRating = 0;
        Log::alert($request->mvcs);
        if ($match) {
            if (count($mvcs) > 1) {
                $chargeMvcCount = count($mvcs) - 1;
                $chargeMvcAmount = $chargeMvcCount * 0.25;
            }
            foreach ($mvcs as $mvc) {
                if (!is_null($mvc['confidence_rating'])) {
                    $chargeConfidenceRating += 0.10;
                }
                Log::alert($mvc['mvc']);
                Mvc::create([
                    'MVC' => $mvc['mvc'],
                    'confidence_rating' => $mvc['confidence_rating'],
                    'match_info_id' => $match->id,
                    'user_id' => Auth::id(),
                ]);
            }


            $totalMvcCost = $chargeMvcAmount + $chargeConfidenceRating;
            $user = Auth::user();
            $user->wallet = $user->wallet - $totalMvcCost;
            $user->save();

            $match->load('mvcs');

            return response()->json([
                'status' => 'success',
                'match' => $match,
            ]);
        }
    }

    public function submitVote($id, $comment)
    {
        $mvc = Mvc::find($id);
        $match = $mvc->matchInfo;
        $tour = $match->tour;

        $vote = Voting::where('user_id', Auth::id())->where('mvc_id', $mvc->id)->first();
        if (!$vote) {
            $user = Auth::user();
            $user->wallet = $user->wallet - 0.002;
            $user->save();
        }

        if ($mvc) {
            Voting::updateOrCreate(
                [
                    'mvc_id' => $mvc->id,
                    'user_id' => Auth::id()
                ],
                [
                    'comment' => $comment
                ]
            );
            $tour->load('mvcs');
            return response()->json([
                'status' => 'success',
                'message' => 'message voted successfully',
                'tour' => $tour,
            ]);
        }
    }

    // POT = ENTRY TICKETS + MVCS [SUBSEQUENT] + CONFIDENCE_RATINGS + VOTES + SPONSERSHIP
    public function calculateResult($id)
    {
        $tour = Tour::find($id);
        $purchasedUserCount = $tour->users()->count();


        $tickets = $purchasedUserCount * 1;

        $totalMvcs = $tour->mvcs()->count();

        $usersWithoutMvc = $tour->users->filter(function ($user) {
            return $user->mvcs->isEmpty();
        });

        $usersWithoutMvcCount = $usersWithoutMvc->count();
        $userWithMvc = $purchasedUserCount - $usersWithoutMvcCount;
        $mvcInterest = $userWithMvc * 0 + (($totalMvcs - $userWithMvc) * 0.25);

        $ratingCount = $tour->mvcs->whereNotNull('confidence_rating')->count();
        $ratingInterest = $ratingCount * 0.10;

        $tourId = $tour->id;
        $totalVotesCount  = Voting::whereHas('mvc.matchInfo', function ($q) use ($tourId) {
            $q->where('tour_id', $tourId);
        })->count();

        $totalVotesInterest = $totalVotesCount * 0.002;

        $totalInterest =  $tickets + $mvcInterest + $ratingInterest + $totalVotesInterest;

        $mvcSettlement = 0.30 * $totalInterest;
        $crSettlement  = 0.08 * $totalInterest;
        $participation = 0.02 * $totalInterest;
        $wonMvcs = [];
        $wonCRMvc = [];

        foreach($tour->mvcs as $mvc){
            $totalVoting = $mvc->votes()->count();
            $totalAgree = $mvc->votes()->where('comment', 'Agree')->count();
            $agreePercent = $totalVoting > 0 ? round(($totalAgree / $totalVoting) * 100) : 0;

            if($agreePercent >= 85){
                $wonMvcs[] = $mvc;
            }
        }

        foreach($wonMvcs as $mvc){
            if($mvc->confidence_rating > 80){
                $wonCRMvc[] = $mvc;
            }
        }

        $mvcWinnerSettleAmount = count($wonMvcs) > 0 ? $mvcSettlement / count($wonMvcs) : 0;
        $crWinnerSettleAmount = count($wonCRMvc) > 0 ? $crSettlement / count($wonCRMvc) : 0;

        foreach($wonMvcs as $mvc){
            $winner = $mvc->user;
            $winner->wallet = $winner->wallet + $mvcWinnerSettleAmount;




            if($mvc->confidence_rating >= 80){
                $winner->wallet = $winner->wallet + $crWinnerSettleAmount;
            }

            $winner->save();
            // Log::alert($winner);
            // return;
        }

        return response()->json([
            "status" => 'success',
            'wonMvcs' => $wonMvcs,
            'wonCrMvc' => $wonCRMvc,
            'averageMvcSettlement' => $mvcWinnerSettleAmount,
            'averageCrSettlement' => $crWinnerSettleAmount,
        ]);
    }
}
