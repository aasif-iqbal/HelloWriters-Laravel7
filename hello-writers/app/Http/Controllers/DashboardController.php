<?php

namespace App\Http\Controllers;

use App\Story;
use App\User;
use App\Profile;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdmin;
use App\Mail\NewStoryNotification;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Tag $tags, Story $stories)
    {
        //DB::enableQueryLog();
        $query = Story::where('status', 1);
        $tags = Tag::get();
        //type filter
        $type = request()->input('type');
        if (in_array($type, ['long', 'short'])) {
            $query->where('type', $type);
        }

        $tag = request()->input('tag');
        // if (in_array($type, ['long', 'short'])) {
        //     $query->where('type', $type);
        // }
        //  dd($tags);
        $stories = $query->with('user')
            ->orderBy('id', 'DESC')
            ->paginate('6');

        // dd($stories);
        return view('dashboard.index', [
            'stories' => $stories,
            'tags' => $tags
        ])->with('Tag', $tags);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $activeStory, Profile $profile)
    {
        $profile = Profile::all();
        //$profile = Profile::with('id')->get();
        //dd($profile);
        return view('dashboard.show', [
            'story' => $activeStory,
            'profile' => $profile
        ])->with('profile', $profile);
    }
    //email send to admin with Title
    public function email()
    {
        // Mail::send(new NewStoryNotification('Title of the Story'));
        //dd("here");
    }
}
