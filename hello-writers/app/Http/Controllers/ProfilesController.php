<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //
    public function edit()
    {
        $user = auth()->user();
        //dd($user);
        return view('profiles.edit', [
            'user' => $user
        ]);
    }

    public function update(ProfileRequest $request, User $user)
    {
        //users-table update
        $user->name = $request->name;

        //dd($user->name);
        $user->save();
        //profiles-table update
        if ($request->hasFile('profile_image')) {
            $this->_uploadImage($request, $user);
        }

        if ($user->profile) {
            //update
            //dd($user->profile);
            $user->profile()->update($request->only([
                'biography', 'address', 'profile_image'
            ]));
        } else {
            //create
            // dd($user->profile);
            $user->profile()->create($request->all());
        }
        return redirect()->route('profiles.edit')->with('status', 'Profile Updated Successfully!');
    }

    private function _uploadImage($request, $user)
    {
        //$source = storage_path().'/app/public/cover_images/'.$fileNameToStore;
        //http://hellowriters.herokuapp.com/edit-profile/1 production
        //"/Applications/XAMPP/xamppfiles/htdocs/storify/public" local
        // $path = public_path();
        //dd($path);
        $image = $request->file('profile_image');
        $filename = time() . '.' . $image->getClientOriginalExtension(); //generate file
        Image::make($image)->resize(200, 200)->save(public_path('storage/' . $filename));
        $user->profile_image = $filename;
        //dd($user);
        $user->save();
    }
}
