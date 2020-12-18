<?php

namespace App\Http\Controllers;

use App\Story;
use App\Tag;
use App\Profile;

use Illuminate\Support\Facades\DB;
use App\Events\StoryEdited;
use App\Events\StoryCreated;

use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
use App\Mail\NewStoryNotification;
use App\Mail\NotifyAdmin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Collection;

class StoriesController extends Controller
{

    public function __construct()
    {   //$this->authorizeResource(Model::class, 'name of resource');
        $this->authorizeResource(Story::class, 'story');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $stories = Story::where('user_id', auth()->user()->id)
            ->with('tags')
            ->orderBy('id', 'DESC')->paginate('6');
        //dd(auth()->user()->id);
        //dd($stories);
        // folderName.bladeName
        return view('stories.index', [
            'stories' => $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Story $story)
    {
        //$this->authorize('create');
        $story = new Story;
        $tags = Tag::get();

        return view('stories.create', [
            'story' => $story,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $story = auth()->user()->stories()->create($request->all());
        // Mail::send(new NewStoryNotification($story->title)); //will send email to admin
        // Log::info('A Story with title' . $story->title . 'was added.');

        if ($request->hasFile('image')) {
            $this->_uploadImage($request, $story);
        }
        $story->tags()->sync($request->tags);

        //        event(new StoryCreated($story->title));

        return redirect()->route('stories.index')->with('status', 'Story Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        return view('stories.show', [
            'story' => $story
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        $tags = Tag::get();
        // Gate::authorize('edit-story', $story);
        return view('stories.edit', [
            'story' => $story,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */

    public function update(StoryRequest $request, Story $story)
    {
        //StoryRequest is use to validate
        $this->authorize('update', $story);
        $story->update($request->all());
        if ($request->hasFile('image')) {
            $this->_uploadImage($request, $story);
        }
        $story->tags()->sync($request->tags);
        // event(new StoryEdited($story->title));
        return redirect()->route('stories.index')->with('status', 'Story Updated Successfully!');
        //dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories.index')->with('status', 'Story Delete Successfully');
    }

    private function _uploadImage($request, $story)
    {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension(); //generate file
        Image::make($image)->resize(650, 400)->save(public_path('storage/' . $filename));
        $story->image = $filename;
        $story->save();
    }
}
