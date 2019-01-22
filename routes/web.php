<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/kickoff', 'KickOffController@index')->name('kickoff');

Route::post('/kickoff', 'KickOffController@store')->name('kickoff.store');

Route::resource('teams', 'TeamController');

Route::resource('members', 'MemberController');

Route::resource('projects', 'ProjectController');

Route::resource('weeks', 'WeekController');

Route::resource('tasks', 'TaskController');

Route::resource('works', 'WorkController');
