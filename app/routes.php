<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/contact', 'HomeController@contact');

/**
 * Auth Routes
 */
Route::post('auth/serviceLogin', 'AuthController@ServiceLogin');
Route::get('/logout', 'AuthController@logout');
Route::resource('auth', 'AuthController');

/**
 * App Routes
 */

Route::controller('tasks', 'TasksController');
Route::controller('users', 'UsersController');
Route::controller('bin', 'TrashController');