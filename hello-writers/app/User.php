<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravelista\Comments\Commenter;

class User extends Authenticatable
{
    use Notifiable, Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //one-to-many relationship
    public function stories()
    {
        return $this->hasMany(\App\Story::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(\App\Profile::class, 'user_id');
    }


    public function editProfileImage()
    {
        if ($this->profile_image) {
            // dd($this->user->profile_image);
            return asset('storage/' . $this->profile_image);
        }
        return asset('storage/profile_images.png');
    }
}
