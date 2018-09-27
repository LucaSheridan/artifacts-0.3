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
    return view('auth/login');
});

Route::get('/addClass', function () {
    return view('auth/login');
});


// Enroll student in a new Section

Route::get('/enroll', ['middleware' => 'auth', 'uses' => 'EnrollmentController@show']);
Route::post('/enroll', ['middleware' => 'auth', 'uses' => 'EnrollmentController@store'])->name('addClass');


// Test Amazon S3 Upload

Route::get('/test', function () {
    return view('artifact/S3upload');
});

Route::post('/test', 'ArtifactController@S3upload');


// Auth Routes

	Auth::routes();

// Registration Routes

	Route::get('/registerTeacher', 'Auth\RegisterTeacherController@showRegistrationForm')->name('registerTeacher');
	Route::post('/registerTeacher', 'Auth\RegisterTeacherController@register');
	Route::get('/registerStudent', 'Auth\RegisterStudentController@showRegistrationForm')->name('registerStudent');
	Route::post('/registerStudent', 'Auth\RegisterStudentController@register');

// Home Routes

	Route::get('/home', ['middleware' =>'auth', 'uses' => 'HomeController@index'])->name('home');


// Site Routes

	Route::get('/site', ['middleware' => 'auth', 'uses' => 'SiteController@index']);
	Route::get('/site/create', ['middleware' => 'auth', 'uses' => 'SiteController@create']);
	Route::post('/site', ['middleware' => 'auth', 'uses' => 'SiteController@store']);
	Route::get('/site/{site}', ['middleware' => 'auth', 'uses' => 'SiteController@show']);
	Route::get('/site/{site}/edit', ['middleware' => 'auth', 'uses' => 'SiteController@edit']);
	Route::patch('/site/{site}', ['middleware' => 'auth', 'uses' => 'SiteController@update']);
	Route::get('/site/{site}/delete', ['middleware' => 'auth', 'uses' => 'SiteController@delete']);
	Route::delete('/site/{site}', ['middleware' => 'auth', 'uses' => 'SiteController@destroy']);

// Collection Routes

	Route::get('/collection', ['middleware' => 'auth', 'uses' => 'CollectionController@index']);
	Route::get('/collection/create', ['middleware' => 'auth', 'uses' => 'CollectionController@create']);
	Route::get('/collection/{collection}', ['middleware' => 'auth', 'uses' => 'CollectionController@show']);
	Route::post('/collection', ['middleware' => 'auth', 'uses' => 'CollectionController@store']);


// User Routes

	Route::get('/user', ['middleware' => 'auth', 'uses' => 'UserController@index']);
	Route::get('/user/create', ['middleware' => 'auth', 'uses' => 'UserController@create']);
	Route::post('/user', ['middleware' => 'auth', 'uses' => 'UserController@store']);
	Route::get('/user/{user}', ['middleware' => 'auth', 'uses' => 'UserController@show']);
	Route::get('/user/{user}/edit', ['middleware' => 'auth', 'uses' => 'UserController@edit']);
	Route::patch('/user/{user}', ['middleware' => 'auth', 'uses' => 'UserController@update']);
	Route::get('/user/{user}/delete', ['middleware' => 'auth', 'uses' => 'UserController@delete']);
	Route::delete('/user/{user}', ['middleware' => 'auth', 'uses' => 'UserController@destroy']);

// Section Routes
	
	Route::get('/section', ['middleware' => 'auth', 'uses' => 'SectionController@index']);
	Route::get('/section/create', ['middleware' => 'auth', 'uses' => 'SectionController@create']);
	Route::post('/section', ['middleware' => 'auth', 'uses' => 'SectionController@store']);
	Route::get('/section/{section}', ['middleware' => 'auth', 'uses' => 'SectionController@show']);
	Route::get('/section/{section}/edit', ['middleware' => 'auth', 'uses' => 'SectionController@edit']);
	Route::patch('/section/{section}', ['middleware' => 'auth', 'uses' => 'SectionController@update']);
	Route::get('/section/{section}/delete', ['middleware' => 'auth', 'uses' => 'SectionController@delete']);
	Route::delete('/section/{section}', ['middleware' => 'auth', 'uses' => 'SectionController@destroy']);

// Teacher View - Class Assignment
	
	Route::get('/section/{section}/assignment/{assignment}/', ['middleware' => 'auth', 'uses' => 'SectionController@ViewClassAssignment']);

// Teacher View - Class Assignment (Grid?)
	
	//Route::get('/section/{section}/assignment/{assignment}/grid', ['middleware' => 'auth', 'uses' => 'SectionController@ViewClassAssignmentGrid']);


// Single Student View - Single Assignment Progress

			// general
		Route::get('/section/{section}/assignment/{assignment}/user/{user}', ['middleware' => 'auth', 'uses' => 'SectionController@StudentAssignmentProgressView']);

			// detail view
		Route::get('/section/{section}/{assignment}/{user}/detail', ['middleware' => 'auth', 'uses' => 'SectionController@StudentAssignmentDetailView']);
	
// Progress Report - Single Student View - All Assignments
Route::get('/section/{section}/user/{user}/progress', ['middleware' => 'auth', 'uses' => 'SectionController@progressReport']);
// Progress Report - Class View - All Assignments
Route::get('/section/{section}/progress', ['middleware' => 'auth', 'uses' => 'SectionController@classProgressReport']);

// Whole Class View - Completion of Component 

Route::get('/section/{section}/assignment/{assignment}/component/{component}', ['middleware' => 'auth', 'uses' => 'SectionController@AssignmentComponent']);




// Should probably be in Assignment Controller
	
	// Depracated
	//Route::get('/section/{section}/createAssignment', 'SectionController@createAssignment');
	
	//Route::get('/section/{section}/addStudents', 'SectionController@addStudents');
	//Route::post('/section/{section}/addStudents', 'SectionController@storeStudents');
	
// Assignment Routes

	Route::resource('assignment', 'AssignmentController');
	Route::get('/assignment/create/{section}', 'AssignmentController@create');
	Route::get('/assignment/{assignment}/delete', 'AssignmentController@delete');
	Route::get('/assignment/{assignment}', 'AssignmentController@show');

	//Route::get('/assignment/{assignment}/grid', 'AssignmentController@grid');

// Component Routes

	//Route::resource('component', 'ComponentController');
	
	Route::get('/component', ['middleware' => 'auth', 'uses' => 'ComponentController@index']);
	Route::get('/component/{assignment}/create', 'ComponentController@create');
	Route::post('/component', ['middleware' => 'auth', 'uses' => 'ComponentController@store']);
	Route::get('/component/{component}', ['middleware' => 'auth', 'uses' => 'ComponentController@show']);
	Route::get('/component/{component}/edit', ['middleware' => 'auth', 'uses' => 'ComponentController@edit']);
	Route::patch('/component/{component}', ['middleware' => 'auth', 'uses' => 'ComponentController@update']);
	Route::get('/component/{component}/delete', ['middleware' => 'auth', 'uses' => 'ComponentController@delete']);
	Route::delete('/component/{component}', ['middleware' => 'auth', 'uses' => 'ComponentController@destroy']);

	// Artifact Routes

Route::resource('artifact', 'ArtifactController');
Route::get('/artifact/create/{component}', 'ArtifactController@create');
//Route::get('/artifact/{artifact}/linkToAssignment/{assignment}', 'ArtifactController@linkToAssignment');
//Route::get('/artifact/{artifact}/attachToAssignment', 'ArtifactController@attachToAssignment');
//Route::post('/artifact', 'ArtifactController@store');
Route::get('/artifact/{artifact}/delete', 'ArtifactController@delete');
Route::get('/artifact/{artifact}/rotate/{degrees}', 'ArtifactController@rotate');

Route::patch('/artifact/{artifact}/publish', 'ArtifactController@publish');
Route::get('/artifact/{artifact}/unpublish', 'ArtifactController@unpublish');



