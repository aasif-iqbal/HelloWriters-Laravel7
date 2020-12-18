<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['profile_image', 'biography', 'address'];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'id');
    }

    //one author hasMany story
    public function stories()
    {
        return $this->hasMany(\App\Story::class);
    }
}
