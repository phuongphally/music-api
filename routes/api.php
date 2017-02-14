<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


// ========= Route Api for mobile ==================
Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function(){
 	Route::resource('songs', 'Api\\SongsController');
 	Route::get('new/song', 'Api\\SongsController@newSong');
 	Route::resource('songs/search', 'Api\\SongsController@search');
	Route::resource('artists', 'Api\\ArtistsController');

	Route::get('maylike', 'Api\\ArtistsController@mayLike');

	Route::resource('albums', 'Api\\AlbumsController');
	
	Route::get('top', 'Api\\TopController@index');
	Route::get('topten', 'Api\\TopController@topTen');
	
	Route::get('bestfive', 'Api\\BestController@index');
	Route::get('recently/artists', 'Api\\ArtistsController@recently');
    Route::get('trending', 'Api\\ArtistsController@trending');

	// tracking counter 
	Route::post('track', 'Api\\TrackController@track');
	Route::post('track/artist', 'Api\\TrackController@trackArtist');
	Route::post('download', 'Api\\TrackController@download');

	// auth
	Route::post('login', 'Api\\AuthController@login');
	Route::post('register', 'Api\\AuthController@register');
	Route::post('auth/user', 'Api\\AuthController@updateProfile');
	Route::post('auth/user/pass', 'Api\\AuthController@changePassword');

	Route::resource('comments', 'Api\\CommentsController');
	Route::get('general/comments/{id}', 'Api\\GeneralCommentsController@index');
    Route::resource('pages', 'Api\\PagesController');
    Route::resource('feedback', 'Api\\FeedbackController');
    Route::resource('requests', 'Api\\RequestsController');

});

