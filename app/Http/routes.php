<?php

//Front End
Route::get('/', array('uses' => 'FrontEndController@index'));

//Candidate
Route::get('/candidate/register', array('as' => 'candidate.register', 'uses' => 'Auth\CandidateAuthController@getRegister'));
Route::post('/candidate/register', array('as' => 'candidate.register', 'uses' => 'Auth\CandidateAuthController@postRegister'));
Route::get('/candidate/login', array('as' => 'candidate.login', 'uses' => 'Auth\CandidateAuthController@getLogin'));
Route::post('/candidate/login', array('as' => 'candidate.login', 'uses' => 'Auth\CandidateAuthController@postLogin'));
Route::get('candidate/logout', array('as' => 'candidate.logout', 'uses' => 'Auth\CandidateAuthController@getLogout'));

Route::group(['prefix'=>'candidate', 'namespace' => 'Candidate'], function() {
    Route::group(['middleware'=>['auth.candidate']], function() {
        Route::get('/home', ['as' => 'candidate.home', 'uses' =>'CandidateController@home']);
        Route::get('/application/step2', ['as' => 'candidate.application.step2', 'uses' =>'CandidateController@showStep2']);
        Route::post('/application/step2', ['as' => 'candidate.application.step2', 'uses' =>'CandidateController@saveStep2']);
        Route::get('/application/step3', ['as' => 'candidate.application.step3', 'uses' =>'CandidateController@showStep3']);
        Route::post('/application/step3', ['as' => 'candidate.application.step3', 'uses' =>'CandidateController@showStep3']);
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
