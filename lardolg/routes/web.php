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
        Route::get('make_tests', 'MakeTestController@index');
        Route::post('make_tests', 'MakeTestController@post');
        Route::post('make_tests/add', 'MakeTestController@add');
        Route::get('tests/{test}', 'TestsController@test');
        Route::get('editTest/{test}', 'TestsController@editTest');
        Route::post('ajax/delete', 'AjaxController@delete');
        Route::get('ajax/renderTests', 'AjaxController@render');
        
        Route::get('make_materials', 'makeMaterial@index');
        Route::post('make_materials', 'makeMaterial@post');
        Route::post('make_materials/add', 'makeMaterial@add');
        Route::get('editmaterial/{id}', 'materialsController@editMaterial');

        Route::post('ajaxEditMaterial/editName', 'editMaterialController@name');
        Route::post('ajaxEditMaterial/editTheme', 'editMaterialController@theme');
        Route::post('ajaxEditMaterial/editLesson', 'editMaterialController@lesson');
        Route::post('ajaxEditMaterial/editFirstImg', 'editMaterialController@editfirstimg');
        Route::post('ajaxEditMaterial/editImg', 'editMaterialController@editImg');
        Route::post('ajaxEditMaterial/editFirstImg', 'editMaterialController@editfirstimg');
        Route::post('ajaxEditMaterial/deleteFirstImg', 'editMaterialController@deletefirstimg');
        Route::post('ajaxEditMaterial/deleteImg', 'editMaterialController@deleteImg');

        Route::post('ajaxEditTest/editName', 'renderTestController@name');
        Route::post('ajaxEditTest/editTheme', 'renderTestController@theme');
        Route::post('ajaxEditTest/editLesson', 'renderTestController@lesson');
        Route::get('ajaxEditTest/delete/{id}', 'renderTestController@delete');
        Route::post('ajaxEditTest/editQuestion', 'renderTestController@question');
        Route::post('ajaxEditTest/editAnswer', 'renderTestController@answer');

        Route::post('ajaxEditTest/editFirstImg', 'renderTestController@editfirstimg');
        Route::post('ajaxEditTest/editImg', 'renderTestController@editImg');
        Route::post('ajaxEditTest/editAnsImg', 'renderTestController@editAnswerImg');
        Route::post('ajaxEditTest/deleteFirstImg', 'renderTestController@deleteFirstImg');
        Route::post('ajaxEditTest/deleteImg', 'renderTestController@deleteImg');
        Route::post('ajaxEditTest/deleteAnsImg', 'renderTestController@deleteAnswerImg');

        Route::post('mat/updateaddimg', 'AjaxController@updateaddimg');
        Route::post('mat/updateimg', 'AjaxController@updateimg');
        Route::post('test/updateaddimg', 'AjaxController@testupdateaddimg');
        Route::post('test/updateimg', 'AjaxController@testupdateimg');
        Route::post('test/updateanswerimg', 'AjaxController@testupdateanswerimg');
        Route::get('ajaxEditMaterial/delete/{id}', 'editMaterialController@delete');
        Route::get('docs/{fileId}', 'TestsController@loock');
        Route::get('download/{fileId}', 'TestsController@download');
    });
    
    Route::get('docs/material/{fileId}', 'materialsController@loock');
    Route::get('materials', 'materialsController@index');
    Route::get('download/materials/{fileId}', 'materialsController@download');
    Route::post('materials', 'materialsController@post');
    Route::get('materials/{test}', 'materialsController@material');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('classes', 'ClassesController@index');
    Route::post('classes/post', 'ClassesController@post');
    Route::delete('classes/delete/{task}', 'ClassesController@delete');
    Route::get('alerts', 'AlertController@index');
    Route::get('users', 'pagination@users');
});

