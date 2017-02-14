<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'Admin\\SongsController@index');
Route::resource('/admin/songs', 'Admin\\SongsController');
Route::resource('/admin/artists', 'Admin\\ArtistsController');
Route::resource('/admin/albums', 'Admin\\AlbumsController');

Route::post('/admin/profile/{id}', 'UserController@update');
Route::get('/admin/profile', 'UserController@index');
Route::get('/admin/users', 'UserController@users');
Route::post('/admin/profile/change-password/{id}', 'UserController@changePassword');

Route::resource('admin/comments', 'Admin\\CommentsController');
Route::resource('admin/pages', 'Admin\\PagesController');

Route::resource('pages', 'Web\\PagesController');
Route::resource('admin/feedback', 'Admin\\FeedbackController');
Route::resource('admin/requests', 'Admin\\RequestsController');

