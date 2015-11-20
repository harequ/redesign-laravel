<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::get('dashboard', ['middleware' => 'auth', function () {
	return view('dashboard/dashboard');
}]);

// Authentication routes...
Route::get('dashboard/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('dashboard/projects', 'ProjectsController@viewProjectsList');
Route::post('dashboard/projects', 'ProjectsController@saveProject');
Route::get('dashboard/projects/{slug}/edit', 'ProjectsController@editProject');
Route::get('dashboard/projects/{slug}/delete', 'ProjectsController@deleteProject');
Route::patch('dashboard/projects/{id}', 'ProjectsController@updateProject');

Route::post('dashboard/projects/{id}', 'ProjectImagesController@uploadImage');
Route::post('dashboard/projects/{slug}/remove-image', 'ProjectImagesController@removeImage');



