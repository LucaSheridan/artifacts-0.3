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

// Auth Routes

Auth::routes();

Route::get('/registerTeacher', 'Auth\RegisterTeacherController@showRegistrationForm')->name('registerTeacher');
Route::post('/registerTeacher', 'Auth\RegisterTeacherController@register');

Route::get('/registerStudent', 'Auth\RegisterStudentController@showRegistrationForm')->name('registerStudent');
Route::post('/registerStudent', 'Auth\RegisterStudentController@register');

// Home Routes

Route::get('/home', 'HomeController@index');

// Site Routes

Route::resource('site', 'SiteController');
Route::get('/site/{site}/delete', 'SiteController@delete');

// User Routes

Route::resource('user', 'UserController');
Route::get('/user/{user}/delete', 'UserController@delete');

// Section Routes

Route::resource('section', 'SectionController');
Route::get('/section/{section}/delete', 'SectionController@delete');
//Route::get('/section/{section}/addStudents', 'SectionController@addStudents');
//Route::post('/section/{section}/addStudents', 'SectionController@storeStudents');
Route::get('/section/{section}/createAssignment', 'SectionController@createAssignment');

// Assignment Routes

Route::resource('assignment', 'AssignmentController');
Route::get('/assignment/create/{section}', 'AssignmentController@create');
Route::get('/assignment/{assignment}/delete', 'AssignmentController@delete');
Route::get('/assignment/{assignment}?id={id?}', 'AssignmentController@show', function ($id = 0) {
    return $id; });
Route::get('/assignment/{assignment}/grid', 'AssignmentController@grid');

// Component Routes

Route::resource('component', 'ComponentController');
Route::get('/component/{component}/delete', 'ComponentController@delete');

// Project Routes

Route::resource('project', 'ProjectController');
Route::get('/project/{id}/addArtifact', 'ProjectController@addArtifact');
Route::get('/project/{project}/delete', 'ProjectController@delete');


// Artifact Routes

Route::resource('artifact', 'ArtifactController');
Route::get('/artifact/create/{project_id}', 'ArtifactController@create');
Route::post('/artifact', 'ArtifactController@store');
Route::get('/artifact/{artifact}/delete', 'ArtifactController@delete');

