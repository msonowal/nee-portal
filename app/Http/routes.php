<?php

//Front End
Route::get('/', array('as'=>'index', 'uses' => 'FrontEndController@index'));

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

      Route::get('/get/exam_list', ['as' =>'exam.by.qualification', 'uses'=> 'RestController@getExamList']);
      Route::get('/get/allied_branch', ['as' =>'allied_branch.by.branch_id', 'uses'=> 'RestController@getAlliedBranch']);
      Route::get('/get/distrist_list', ['as' =>'district.by.state', 'uses'=> 'RestController@getDistrictList']);
      Route::get('/get/reservation_code/quota', ['as' =>'reservation_code.by.quota', 'uses'=> 'RestController@getReservationCode']);
      Route::get('/get/reservation_code/status', ['as' =>'reservation_code.get.status', 'uses'=> 'RestController@getReservationStatus']);

        Route::get('/home', ['as' => 'candidate.home', 'uses' =>'CandidateController@home']);
        Route::post('/home', ['as' => 'candidate.home', 'uses' =>'CandidateController@storeExam']);
        Route::get('/dashboard', ['as' => 'candidate.application.dashboard', 'uses' =>'CandidateController@dashboard']);
        Route::post('/proceed', ['as' => 'candidate.proceed', 'uses' =>'CandidateController@proceed']);
        Route::get('/application/step', ['as' => 'candidate.application.step', 'uses' =>'RegistrationController@getStep']);
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
        Route::get('/application/challan', ['as' => 'candidate.application.challan', 'uses' =>'RegistrationController@challan']);
        Route::post('/application/challan', ['as' => 'candidate.application.challan', 'uses' =>'PaymentController@challanDetail']);
        Route::get('/application/challan_copy', ['as' => 'candidate.application.challan_copy', 'uses' =>'RegistrationController@challanCopy']);
        Route::get('/error', ['as' => 'candidate.error', 'uses' =>'RegistrationController@showError']);
        Route::get('/application/completed', ['as' => 'candidate.application.completed', 'uses' =>'RegistrationController@completed']);
        Route::get('/application/view_confirmation', ['as' => 'candidate.application.view_confirmation', 'uses' =>'RegistrationController@viewConfirmation']);
        //Debit Card payment of Axis Bank
        Route::get('/payment/debit_card', ['as' => 'payment.debit_card', 'uses' =>'PaymentController@showDebit_card']);
        Route::post('/payment/debit_card', ['as' => 'payment.debit_card', 'uses' =>'PaymentController@doDebit_card']);
        //Credit Card payment of Axis Bank
        Route::get('/payment/credit_card', ['as' => 'payment.credit_card', 'uses' =>'PaymentController@showCredit_card']);
        Route::post('/payment/credit_card', ['as' => 'payment.credit_card', 'uses' =>'PaymentController@doCredit_card']);
        //Net Banking payment of Axis Bank
        Route::get('/payment/net_banking', ['as' => 'payment.net_banking', 'uses' =>'PaymentController@showNet_banking']);
        
        //Pay U money
        Route::get('/payment/pay_u', ['as' => 'payment.pay_u', 'uses' =>'PaymentController@showPayU']);
        Route::post('/payment/pay_u', ['as' => 'payment.pay_u', 'uses' =>'PaymentController@doPayU']);

    });
});

//Debit payment gateway Response
Route::get('/payment/response/debit_card', ['as' => 'payment.response.debit_card','uses' =>'Candidate\PaymentController@debitResponse']);
//Debit payment gateway Response
Route::get('/payment/response/credit_card', ['as' => 'payment.response.credit_card','uses' =>'Candidate\PaymentController@creditResponse']);
//NetBanking Payment Gatway Response
Route::get('/nee/candidate/getcheck.php', ['as' => 'payment.net_banking.getcheck', 'uses' =>'Candidate\PaymentController@doNet_banking']);
Route::post('/nee/candidate/getcheck.php', ['as' => 'payment.net_banking.getcheck', 'uses' =>'Candidate\PaymentController@doNet_banking']);
Route::get('/nee/candidate/response.php', ['as' => 'payment.response.net_banking','uses' =>'Candidate\PaymentController@netBankingResponse']);
Route::post('/nee/candidate/response.php', ['as' => 'payment.response.net_banking','uses' =>'Candidate\PaymentController@netBankingResponse']);

//PayYMoney
Route::get('/payment/response/pay_u/sucess', ['as' => 'payment.response.pay_u.sucess','uses' =>'Candidate\PaymentController@payUResponseSuccess']);
Route::get('/payment/response/pay_u/fail', ['as' => 'payment.response.pay_u.fail','uses' =>'Candidate\PaymentController@payUResponseFail']);
Route::get('/payment/response/pay_u/cancel', ['as' => 'payment.response.pay_u.cancel','uses' =>'Candidate\PaymentController@payUResponseCancel']);

//Admin
Route::get('/admin/login', array('as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@getLogin'));
Route::post('/admin/login', array('as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@postLogin'));
Route::get('admin/logout', [ 'as' => 'admin.logout', 'uses' => 'Auth\AdminAuthController@getLogout']);

Route::group(['prefix'=>'admin', 'namespace' => 'Admin'], function() {
    Route::group(['middleware'=>['auth.admin']], function() {
        Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminController@dashboard']);
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

     Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
        Route::get('/challan', ['as' => 'admin.challan.index', 'uses' =>'AdminController@challan']);
        Route::post('/challan/import', ['as' => 'admin.challan.import', 'uses' =>'ExcelController@challanImport']);
        Route::get('/candidate/submitted_forms', ['as' => 'admin.candidate.submittedform', 'uses' =>'AdminController@submittedForm']);
        Route::get('/candidate/nee_i_submitted', ['as' => 'admin.candidate.nee_i_submitted', 'uses' =>'AdminController@nee_i_submitted']);
        Route::get('/candidate/nee_ii_submitted', ['as' => 'admin.candidate.nee_ii_submitted', 'uses' =>'AdminController@nee_ii_submitted']);
        Route::get('/candidate/nee_iii_submitted', ['as' => 'admin.candidate.nee_iii_submitted', 'uses' =>'AdminController@nee_iii_submitted']);
        Route::get('/candidate/view_confirmation/{id}', ['as' =>'admin.candidate.view_confirmation', 'uses'=>'AdminController@viewConfirmation']);
        Route::get('/transaction/success', ['as'=>'admin.transaction.success', 'uses' =>'AdminController@transactionSuccess']);
        Route::get('/transaction/failed', ['as'=>'admin.transaction.failed', 'uses' =>'AdminController@transactionFailed']);
        Route::get('/report/all', ['as' =>'genrate.report.all', 'uses' =>'ExcelController@allCompleted']);
        Route::post('/candidate/submitted_forms', ['as' =>'admin.search.all', 'uses' =>'AdminController@searchALL']);
        Route::get('/report/nee_i', ['as' =>'genrate.report.nee_i', 'uses' =>'ExcelController@nee_i']);
        Route::post('/candidate/nee_i_submitted', ['as' =>'admin.search.nee_i', 'uses' =>'AdminController@search_nee_i']);
        Route::get('/report/nee_ii', ['as' =>'genrate.report.nee_ii', 'uses' =>'ExcelController@nee_ii']);
        Route::post('/candidate/nee_ii_submitted', ['as' =>'admin.search.nee_ii', 'uses' =>'AdminController@search_nee_ii']);
        Route::get('/report/nee_iii', ['as' =>'genrate.report.nee_iii', 'uses' =>'ExcelController@nee_iii']);
        Route::post('/candidate/nee_iii_submitted', ['as' =>'admin.search.nee_iii', 'uses' =>'AdminController@search_nee_iii']);
        Route::get('/report/transaction_success', ['as' =>'genrate.report.transaction_success', 'uses' =>'ExcelController@transaction_success']);
        Route::post('/transaction/success', ['as' =>'admin.search.transaction_success', 'uses' =>'AdminController@transaction_success']);
        Route::get('/report/transaction_failed', ['as' =>'genrate.report.transaction_failed', 'uses' =>'ExcelController@transaction_failed']);
        Route::post('/transaction/failed', ['as' =>'admin.search.transaction_failed', 'uses' =>'AdminController@transaction_failed']);
        Route::get('/search/submitted', ['as' =>'admin.search.submitted', 'uses' =>'AdminController@submitted']);
        Route::post('/search/submitted', ['as' =>'admin.search.search_submitted', 'uses' =>'AdminController@search_submitted']);
        Route::get('/report/submitted', ['as' =>'genrate.report.submitted', 'uses' =>'ExcelController@submitted_report']);
    });
});
