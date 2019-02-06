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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify-user/{code}','Auth\RegisterController@activateUser')->name('activate.user');

Route::get('/students','HomeController@loadStudents')->name('students');
Route::get('/teachers','HomeController@loadTeachers')->name('teachers');

Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('to_google');
Route::get('/callback','Auth\LoginController@handleProviderCallback');