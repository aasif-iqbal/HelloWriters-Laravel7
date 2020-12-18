<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    // Route::get('stories', 'storiesController@index')->name('stories.index');

    //Route::get('stories/{id}', 'storiesController@show');
    Route::get('stories/create', 'StoriesController@create')->name('stories.create');
    //using Route-Model binding    
    Route::get('stories/{story}', 'StoriesController@show')->name('stories.show');
    Route::get('stories/{story}/edit', 'StoriesController@edit')->name('stories.edit');


    //Profile
    Route::get('/edit-profile', 'ProfilesController@edit')->name('profiles.edit');
    Route::put('/edit-profile/{user}', 'ProfilesController@update')->name('profiles.update');

    Route::resource('stories', 'StoriesController');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

//These Route are view by all users (without authenticated).
Route::get('/', 'DashboardController@index')->name('dashboard.index');
Route::get('/story/{activeStory:slug}', 'DashboardController@show')->name('dashboard.show');

Route::get('/author', 'AuthorController@index')->name('dashboard.author');

//go to RouteServiceProvider.
Route::get('/email', 'DashboardController@email')->name('dashboard.email');


// #################---------Admin-panel---------################# //
//App\Http\Controllers\StoriesController@index         
Route::namespace('Admin')->prefix('admin')->middleware(['auth', CheckAdmin::class])->group(function () {
    //using prefix we get this-> admin/deleted_stories
    Route::get('/deleted_stories', 'StoriesController@index')->name('admin.stories.index');
    Route::put('/stories/restore/{id}', 'StoriesController@restore')->name('admin.stories.restore');
    Route::delete('/stories/delete/{id}', 'StoriesController@delete')->name('admin.stories.delete');
    Route::get('/stories/showUser', 'StoriesController@showUser')->name('admin.stories.showUser');
});

//to check image-route only
Route::get('/image', function () {
    $imagePath = public_path('storage/default_blog.png');
    $writePath = public_path('storage/thumbnail.png');

    $img = Image::make($imagePath)->resize(750, 350);
    $img->save($writePath);
    return $img->response('png');
});

Route::get('/profile_image', function () {
    $imagePath = public_path('storage/default_blog.png');
    $writePath = public_path('storage/thumbnail.png');

    $img = Image::make($imagePath)->resize(350, 150);
    $img->save($writePath);
    return $img->response('png');
});

//composer require laravel/telescope "^3.0"