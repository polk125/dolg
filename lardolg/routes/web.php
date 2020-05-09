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

Auth::routes(['reset' => false]);


Route::group(['middleware' => 'isAdmin'], function () {
    Route::group(['middleware' => 'ForTeachers'], function () 
    {
        Route::get('journal', 'journal@classes');
        Route::post('journal', 'journal@data');
        Route::resource('journal_object', 'journObject',['only' => ['index', 'store', 'show', 'destroy']]);
        Route::post('ajax/post', 'AjaxController@store');
        Route::get('tests', 'TestsController@index');
        Route::post('tests', 'TestsController@post');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('users', 'pagination@users');
    Route::get('classes', 'ClassesController@index');
    Route::post('classes/post', 'ClassesController@post');
    Route::delete('classes/delete/{task}', 'ClassesController@delete');
    Route::get('alerts', 'AlertController@index');
    Route::get('users', 'pagination@users');
});

