<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Story;
use App\User;
use Illuminate\Support\Facades\DB;

class StoriesController extends Controller
{
    public function index()
    {
        $stories = Story::onlyTrashed()
            ->with('user') //to solve (n+1) problem
            ->orderBy('id', 'DESC')->paginate('10');
        //dd($stories);
        // folderName.bladeName
        return view('admin.stories.index', [
            'stories' => $stories
        ]);
    }

    public function showUser()
    {
        //$stories = Story::select('select * from users where type = ?', [2]);
        $stories = Story::where('status', 1)->orderBy('id', 'DESC')->paginate('8');
        // dd($stories);
        return view('admin.stories.showUser', [
            'stories' => $stories
        ]);
    }

    public function restore($id)
    {
        //dd($id);
        $story = Story::withTrashed()->findOrFail($id);
        $story->restore();
        return redirect()->route('admin.stories.index')->with('status', 'Story Restored Successfully!');
    }

    public function delete($id)
    {
        //dd($id);
        $story = Story::withTrashed()->findOrFail($id);
        $story->forceDelete();
        return redirect()->route('admin.stories.index')->with('status', 'Story Deleted Successfully!');
    }
}
