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
        Route::group(['middleware' => 'notForadmins'], function () 
    {
        Route::get('journal', 'journal@classes');
        Route::post('journal', 'journal@data');
        Route::resource('journal_object', 'journObject',['only' => ['index', 'store', 'show', 'destroy']]);
        Route::post('ajax/post', 'AjaxController@store');
        Route::get('make_materials', 'makeMaterial@index');
        Route::post('make_materials', 'makeMaterial@post');
        Route::post('make_materials/add', 'makeMaterial@add');
    });
        
        Route::get('makeadditional', 'additionalController@make');
        Route::post('add_additional', 'additionalController@add');
       
        Route::get('additional/{id}', 'additionalController@render');
        Route::get('tests', 'TestsController@index');
        Route::post('tests', 'TestsController@post');
        Route::get('make_tests', 'MakeTestController@index');
        Route::post('make_tests', 'MakeTestController@post');
        Route::post('make_tests/add', 'MakeTestController@add');
        Route::get('tests/{test}', 'TestsController@test');
        Route::get('editTest/{test}', 'TestsController@editTest');
        Route::post('ajax/delete', 'AjaxController@delete');
        Route::get('ajax/renderTests', 'AjaxController@render');
        
        
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
        
    });
    Route::get('additional', 'additionalController@index');
    Route::post('additional', 'additionalController@post');
    Route::post('addstudent', 'additionalController@registration');
    Route::get('docs/{fileId}', 'TestsController@loock');
    Route::get('download/{fileId}', 'TestsController@download');
    
    Route::get('docs/material/{fileId}', 'materialsController@loock');
    Route::get('materials', 'materialsController@index');
    
    Route::get('download/materials/{fileId}', 'materialsController@download');
    Route::post('materials', 'materialsController@post');
    Route::get('materials/{test}', 'materialsController@material');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::delete('classes/delete/{task}', 'ClassesController@delete');
    
    Route::group(['middleware' => 'notForadmins'], function () 
    {
    Route::get('alerts', 'AlertController@index');
    Route::get('complite/{test}', 'compliteController@test');
    Route::post('test/addanswer', 'compliteController@addanswer');
    Route::post('test/deleteanswer', 'compliteController@deleteanswer');
    Route::post('test/endtest', 'compliteController@endtest');
    Route::post('test/starttest', 'compliteController@starttest');
    Route::get('start/{test}', 'compliteController@start');
    });
    Route::post('about/add', 'HomeController@add');
    Route::post('about/phone', 'HomeController@phone');
    Route::post('about/email', 'HomeController@email');
    Route::post('about/addhref', 'HomeController@addhref');
    Route::post('about/adddelete', 'HomeController@adddelete');
    Route::get('users/{id}', 'userController@index');
    Route::post('reset', 'Auth\ResetPasswordController@postUpdatePassword');
    
    Route::group(['middleware' => 'ForAdmins'], function () 
    {
    Route::get('adminpanel', 'adminController@index');
    Route::get('adminpanel/add', 'adminController@addusers');
    Route::get('adminpanel/handadd', 'adminController@handadd');

    Route::get('adminpanel/users', 'adminController@users');
    Route::get('adminpanel/users/{id}', 'adminController@userid');
    Route::get('adminpanel/classes', 'adminController@classes');
    Route::get('adminpanel/classes/{id}', 'adminController@classeid');
    Route::get('adminpanel/lessons', 'adminController@lessons');
    Route::get('adminpanel/addlesson', 'adminController@addlesson');
    Route::post('adminpanel/add/lesson', 'adminController@createlesson');

    Route::post('adminpanel/add/uploadstudent', 'adminController@uploadstudent');
    Route::post('adminpanel/add/uploadteacher', 'adminController@uploadteacher');
    Route::post('adminpanel/add/handadd', 'adminController@uploadhand');

    Route::post('adminpanel/edit/add', 'edituserController@add');
    Route::post('adminpanel/edit/phone', 'edituserController@phone');
    Route::post('adminpanel/edit/email', 'edituserController@email');
    Route::post('adminpanel/edit/class', 'edituserController@class');
    Route::post('adminpanel/edit/parent', 'edituserController@parent');
    Route::post('adminpanel/edit/newpass', 'edituserController@newpass');
    Route::post('adminpanel/editclass/teacher', 'edituserController@editClassTeacher');
    Route::post('adminpanel/edit/lessonteacher', 'edituserController@lessonteacher');
    Route::post('adminpanel/ajax/addlessons', 'AjaxController@addlessons');
    Route::post('adminpanel/delete/user', 'edituserController@deleteuser');
    Route::post('adminpanel/delete/class', 'edituserController@deleteclass');
    Route::post('adminpanel/delete/teacherclass', 'edituserController@teacherclass');
    Route::post('adminpanel/delete/parenth', 'edituserController@deleteparenth');
    Route::post('adminpanel/delete/lesson', 'edituserController@deletelesson');
    Route::post('adminpanel/delete/lessonteacher', 'edituserController@deletelessonteacher');
    Route::post('adminpanel/delete/teacherlesson', 'edituserController@deletelessonteacher');
    Route::post('adminpanel/add/handteacher', 'adminController@handteacher');
    Route::post('adminpanel/add/handstudent', 'adminController@handstudent');
    Route::post('adminpanel/add/handparent', 'adminController@handparent');
    Route::get('download/result/{fileId}', 'edituserController@download');
    });
    
});

