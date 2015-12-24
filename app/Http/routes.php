<?php

//Front End
Route::get('/', array('uses' => 'FrontEndController@index'));

//Candidate
Route::get('/candidate/register', array('as' => 'candidate.register', 'uses' => 'Auth\CandidateAuthController@getRegister'));
Route::post('/candidate/register', array('as' => 'candidate.register', 'uses' => 'Auth\CandidateAuthController@postRegister'));
Route::get('/candidate/login', array('as' => 'candidate.login', 'uses' => 'Auth\CandidateAuthController@getLogin'));
Route::post('/candidate/login', array('as' => 'candidate.login', 'uses' => 'Auth\CandidateAuthController@postLogin'));
Route::get('candidate/logout', array('as' => 'candidate.logout', 'uses' => 'Auth\CandidateAuthController@getLogout'));
Route::get('/candidate/otp/activate', ['as' => 'candidate.otp.activate', 'uses' => 'Auth\CandidateAuthController@showOTP']);
Route::post('/candidate/otp/activate', ['as' => 'candidate.otp.activate', 'uses' => 'Auth\CandidateAuthController@activateOTP']);
Route::get('/candidate/otp/resend', ['as' => 'candidate.otp.resend', 'uses' => 'Auth\CandidateAuthController@showResendOTP']);
Route::post('/candidate/otp/resend', ['as' => 'candidate.otp.resend', 'uses' => 'Auth\CandidateAuthController@doResendOTP']);

Route::group(['prefix'=>'candidate', 'namespace' => 'Candidate'], function() {
    Route::group(['middleware'=>['auth.candidate']], function() {
        Route::get('/home', ['as' => 'candidate.home', 'uses' =>'CandidateController@home']);
        Route::get('/application/step1', ['as' => 'candidate.application.step1', 'uses' =>'CandidateController@showStep1']);
        Route::post('/application/step1', ['as' => 'candidate.application.step1', 'uses' =>'CandidateController@saveStep1']);
        Route::get('/application/step2', ['as' => 'candidate.application.step2', 'uses' =>'CandidateController@showStep2']);
        Route::post('/application/step2', ['as' => 'candidate.application.step2', 'uses' =>'CandidateController@showStep2']);
    });
});

//Admin
Route::get('/admin/login', array('as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@getLogin'));
Route::post('/admin/login', array('as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@postLogin'));
Route::get('admin/logout', [ 'as' => 'admin.logout', 'uses' => 'Auth\AdminAuthController@getLogout']);

Route::group(['prefix'=>'admin', 'namespace' => 'Admin\MasterEntry'], function() {
    Route::group(['middleware'=>['auth.admin']], function() {
        Route::get('/dashboard', ['as' => 'admin.dashboard', function () {
            return View::make('admin.dashboard');
        }]);
    });
});

//Master Entry
Route::group(['middleware'=>['auth.admin']], function() {

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
