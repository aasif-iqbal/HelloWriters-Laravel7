<?php

namespace App\Http\Controllers;

use App\Story;
use App\User;
use App\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index(Request $request, Story $stories, User $users, Profile $profile)
    {
        $user_id = $request->user_id;
        //dd($user_id);
        $users = User::where('id', $user_id)->get();

        $profile = Profile::where('user_id', $user_id)->get();

        $stories = Story::where('user_id', $user_id)->paginate(6);

        return view('dashboard.author', [
            'stories' => $stories,
            'users' => $users,
            'profile' => $profile
        ])->with(
            'Story', //model-name
            $stories,
            'user',
            $users,
            'profile',
            $profile
        );
    }
}
