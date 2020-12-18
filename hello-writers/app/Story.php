<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    //
    use SoftDeletes, Commentable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title', 'body', 'type', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function profile()
    {
        return $this->belongsTo(\App\Profile::class);
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Tag::class);
    }
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    //To assign a global scope to a model, you should override a given model's booted method and use the addGlobalScope method:
    protected static function booted()
    {
        // static::addGlobalScope('active', function (Builder $builder) {
        //     $builder->where('status', '1');
        // });
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFootnoteAttribute()
    {
        return $this->type . ':Type , Created at:' . date('y-m-d', strtotime($this->created_at));
    }

    public function getCreatedAt()
    {
        return date('M j Y', strtotime($this->created_at));
    }

    public function getUpdatedAt()
    {
        return date('M j Y g:i A', strtotime($this->updated_at));
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getThumbnailAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image ?? '');
        }
        return asset('storage/thumbnail.png');
    }

    public function getProfileImage()
    {
        if ($this->user->profile_image) {
            return asset('storage/' . $this->user->profile_image ?? '');
        }
        return asset('storage/profile_images.png');
    }

    public function getAuthorName()
    {
        return $this->user->name ?? '';
    }

    public function getAuthorBio()
    {
        return $this->profile->biography ?? '';
    }

    public function getStory()
    {
        $body = Str::limit($this->body, 350, $end = '...');
        $body = str_replace("&nbsp;", '', $body);
        return  strip_tags($body);
    }
}
