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
//Front End
Route::get('/', array('uses' => 'FrontEndController@index'));

//Student Resigtration & Login
Route::get('/student/register', array('as' => 'student.register', 'uses' => 'Auth\StudentAuthController@getRegister'));
Route::post('/student/register', array('as' => 'student.register', 'uses' => 'Auth\StudentAuthController@postRegister'));
Route::get('/student/login', array('as' => 'student.login', 'uses' => 'Auth\StudentAuthController@getLogin'));
Route::post('/student/login', array('as' => 'student.login', 'uses' => 'Auth\StudentAuthController@postLogin'));
Route::get('student/logout', array('as' => 'student.logout', 'uses' => 'Auth\StudentAuthController@getLogout'));

Route::group(['prefix'=>'student', 'namespace' => 'Student'], function() {
    Route::group(['middleware'=>['auth.student']], function() {
        Route::get('/dashboard', ['as' => 'student.dashboard', 'uses' =>'StudentController@dashboard']);
        Route::get('/application', ['as' => 'student.application', 'uses' =>'StudentController@index']);
        Route::post('/application', ['as' => 'student.application', 'uses' =>'StudentController@getStep']);
        Route::get('/application/step2', ['as' => 'student.application.step2', 'uses' =>'StudentController@createStep2']);
        Route::post('/application/step2', ['as' => 'student.application.step2', 'uses' =>'StudentController@storeStep2']);
    });
});


//Admin Login & Logout
Route::get('/admin/login', array('as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@getLogin'));
Route::post('/admin/login', array('as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@postLogin'));
Route::get('admin/logout', [ 'as' => 'admin.logout', 'uses' => 'Auth\AdminAuthController@getLogout']);

//Admin
Route::group(['prefix'=>'admin', 'namespace' => 'Admin\MasterEntry'], function() {
    Route::group(['middleware'=>['auth.admin']], function() {
        Route::get('/dashboard', ['as' => 'admin.dashboard', function () {
            return View::make('admin.dashboard');
        }]);
    });
});

//Master Entry
Route::group(['middleware'=>['auth']], function() {

     Route::group(['prefix'=>'admin/masterentry', 'namespace'=>'Admin\MasterEntry'], function() {

        Route::resource('/exam', 'ExamController', ['except' => ['show']]);
        Route::resource('/quota', 'QuotaController', ['except' => ['show']]);
        Route::resource('/branch', 'BranchController', ['except' => ['show']]);
        Route::resource('/centre', 'CentreController', ['except' => ['show']]);
        Route::resource('/centrecapacity', 'CentreCapacityController', ['except' => ['show']]);
        Route::resource('/reservation', 'ReservationController', ['except' => ['show']]);
        Route::resource('/examdetail', 'ExamDetailController', ['except' => ['show']]);
        Route::resource('/alliedbranch', 'AlliedBranchController', ['except' => ['show']]);

     });
});

//User

//Student

Route::get('/charts', function()
{
	return View::make('mcharts');
});

Route::get('/tables', function()
{
	return View::make('table');
});

Route::get('/forms', function()
{
	return View::make('form');
});

Route::get('/grid', function()
{
	return View::make('grid');
});

Route::get('/buttons', function()
{
	return View::make('buttons');
});


Route::get('/icons', function()
{
	return View::make('icons');
});

Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/typography', function()
{
	return View::make('typography');
});

Route::get('/notifications', function()
{
	return View::make('notifications');
});

Route::get('/blank', function()
{
	return View::make('blank');
});



Route::get('/documentation', function()
{
	return View::make('documentation');
});

