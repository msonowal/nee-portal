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
Route::get('/candidate/otp/resend', ['as' => 'candidate.otp.resend', 'uses' => 'Auth\CandidateAuthController@resendOTP']);
Route::post('/candidate/otp/resend', ['as' => 'candidate.otp.resend', 'uses' => 'Auth\CandidateAuthController@resendOTP']);

Route::group(['prefix'=>'candidate', 'namespace' => 'Candidate'], function() {
    Route::group(['middleware'=>['auth.candidate']], function() {
        Route::get('/home', ['as' => 'candidate.home', 'uses' =>'CandidateController@home']);
        Route::post('/home', ['as' => 'candidate.home', 'uses' =>'CandidateController@storeExam']);
        Route::get('/exam_list', ['as' =>'exam.by.qualification', 'uses'=> 'RestController@getExamList']);
        Route::get('/get/allied_branch', ['as' =>'allied_branch.by.branch_id', 'uses'=> 'RestController@getAlliedBranch']);
        Route::get('/dashboard', ['as' => 'candidate.application.dashboard', 'uses' =>'CandidateController@dashboard']);
        Route::post('/proceed', ['as' => 'candidate.proceed', 'uses' =>'CandidateController@proceed']);
        Route::get('/application/step', ['as' => 'candidate.application.step', 'uses' =>'RegistrationController@getStep']);
        Route::get('reservation_code', ['as' =>'reservation_code.by.quota', 'uses'=> 'RestController@getReservationCode']);
        Route::get('distrist_list', ['as' =>'district.by.state', 'uses'=> 'RestController@getDistrictList']);
        Route::get('/application/step1', ['as' => 'candidate.application.step1', 'uses' =>'RegistrationController@showStep1']);
        Route::post('/application/step1', ['as' => 'candidate.application.step1', 'uses' =>'RegistrationController@saveStep1']);
        Route::get('/application/step2', ['as' => 'candidate.application.step2', 'uses' =>'RegistrationController@showStep2']);
        Route::post('/application/step2', ['as' => 'candidate.application.step2', 'uses' =>'RegistrationController@saveStep2']);
        Route::get('/application/step3', ['as' => 'candidate.application.step3', 'uses' =>'RegistrationController@showStep3']);
        Route::post('/application/step3', ['as' => 'candidate.application.step3', 'uses' =>'RegistrationController@saveStep3']);
        Route::get('/application/final', ['as' => 'candidate.application.final', 'uses' =>'RegistrationController@showFinal']);
        Route::get('/application/edit/step1', ['as' => 'candidate.application.editstep1', 'uses' =>'RegistrationController@editStep1']);
        Route::post('/application/edit/step1', ['as' => 'candidate.application.editstep1', 'uses' =>'RegistrationController@updateStep1']);
        Route::get('/application/edit/step2', ['as' => 'candidate.application.editstep2', 'uses' =>'RegistrationController@editStep2']);
        Route::post('/application/edit/step2', ['as' => 'candidate.application.editstep2', 'uses' =>'RegistrationController@updateStep2']);
        Route::get('/application/edit/step3', ['as' => 'candidate.application.editstep3', 'uses' =>'RegistrationController@editStep3']);
        Route::post('/application/edit/step3', ['as' => 'candidate.application.editstep3', 'uses' =>'RegistrationController@updateStep3']);
        Route::post('/submit', ['as' => 'candidate.application.submit', 'uses' =>'RegistrationController@finalSubmit']);
        Route::get('/application/payment', ['as' => 'candidate.application.payment_options', 'uses' =>'RegistrationController@paymentOptions']);
        Route::post('/application/payment', ['as' => 'candidate.application.payment_options', 'uses' =>'RegistrationController@paymentProceed']);
        Route::get('/application/challan_format', ['as' => 'candidate.application.challan_format', 'uses' =>'RegistrationController@challanFormat']);
        Route::get('/error', ['as' => 'candidate.error', 'uses' =>'RegistrationController@showError']);
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
