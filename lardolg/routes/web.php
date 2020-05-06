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

Route::get('/', 'HomeController@index')->name('/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('users', 'pagination@users');
    Route::get('journal', 'journal@classes');
    Route::get('classes', 'ClassesController@index'); 
    Route::post('journal', 'journal@data');
    Route::post('classes/post', 'ClassesController@post');
    Route::post('journal_object', 'journObject@post');
    Route::get('journal_object', 'journObject@index');
    Route::delete('classes/delete/{task}', 'ClassesController@delete');
});

