<?php

use Illuminate\Support\Str;

function getProfileImage($profile_image)
{
    if ($profile_image) {
        return asset('storage/' . $profile_image ?? '');
    }
    return asset('storage/profile_images.png');
}

function getThumbnailAttribute($image)
{
    if ($image) {
        return asset('storage/' . $image ?? '');
    }
    return asset('storage/thumbnail.png');
}

function getAuthorName($name)
{
    if ($name) {
        return ucfirst($name ?? '');
    }
}

function getStory($body)
{
    $body = Str::limit($body, 300, $end = '...');
    $body = str_replace("&nbsp;", '', $body);
    return  strip_tags($body);
}
