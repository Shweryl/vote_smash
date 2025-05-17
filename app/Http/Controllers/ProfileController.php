<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getProfile(Request $request){
        $user = Auth::user();
        $toursquery = $user->tours();
        if (!$request->has('show_more')) {
            $toursquery->limit(1);
        }
        $tours= $toursquery->get();
        return view('profile', compact('user', 'tours'));
    }

    public function updateForm(){
        $user = Auth::user();
        return view('profile_update', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id){
        $user = User::find($id);

        if($user){
            // careful with array_filter cuz it deletes falsy values in array
            $imagePath = '';
            if ($request->hasFile('profile_image')) {
                $imagePath = Storage::disk('public')->put('profiles', $request->profile_image);
            };

            $user->update([
                'first_name' => $request->first_name ?? $user->first_name,
                'last_name' => $request->last_name ?? $user->last_name,
                'email' => $request->last_email ?? $user->email,
                'telephone' => $request->telephone ?? $user->last_name,
                'profile_image' => $imagePath ?? $user->profile_image,
            ]);
            return redirect()->route('user.profile');
        }

        return redirect()->back()->withErrors(['message' => "User is not found"]);
    }
}
