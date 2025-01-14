<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1'], function () {
    Route::post('billdesk_webhook_response', 'PaymentApiController@billdeskWebhookResponse');
    Route::post('razorpay_webhook_response', 'PaymentApiController@razorpayWebhookResponse');
    Route::post('checkAppVersion', 'WebApiController@checkAppVersion');

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('googleSignIn', 'AuthController@googleSignIn');
        Route::post('resendOtp', 'AuthController@resendOtp');
        Route::post('logout', 'AuthController@logout')->middleware('jwt.auth');
    });

    Route::group(['prefix' => 'profile', 'middleware' => ['jwt.auth']], function () {
        Route::post('getProfile', 'WebApiController@getProfile');
        Route::post('postProfile', 'WebApiController@postProfile');
        Route::post('getRelations', 'WebApiController@getRelations');
        Route::post('sendEmailOtp', 'WebApiController@sendEmailOtp');
        Route::post('verifyEmailOtp', 'WebApiController@verifyEmailOtp');
        Route::post('sendMobileOtp', 'WebApiController@sendMobileOtp');
        Route::post('verifyMobileOtp', 'WebApiController@verifyMobileOtp');
        Route::post('validatePincode', 'WebApiController@validatePincode');
        Route::post('savePersonalDetails', 'WebApiController@savePersonalDetails');
        Route::post('saveBankStatement', 'VerificationApiController@saveBankStatement');
        Route::post('saveLoanLimitDetails', 'WebApiController@saveLoanLimitDetails');
        Route::post('saveBankDetails', 'VerificationApiController@saveBankDetails');
        Route::post('deleteProfile', 'WebApiController@deleteProfile');
    });

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::post('getBusinessInfo', 'WebApiController@getBusinessInfo');
        Route::post('getBanks', 'WebApiController@getBanks');
        Route::post('saveUserContactData', 'WebApiController@saveUserContactData');
        Route::post('saveUserSmsData', 'WebApiController@saveUserSmsData');
        Route::post('aadhaar/sendOtp', 'VerificationApiController@sendAadhaarOtp');
        Route::post('aadhaar/verifyOtp', 'VerificationApiController@verifyAadhaarOtp');
        Route::post('pan/verifyPan', 'VerificationApiController@verifyPanCard');
        Route::post('verifySelfie', 'VerificationApiController@verifySelfie');
        Route::post('getCibilScore', 'WebApiController@getCibilScore');
        Route::post('getCreditLimit', 'WebApiController@getCreditLimit');
        Route::post('homeScreen', 'WebApiController@homeScreen');
        Route::post('getLoanStages', 'WebApiController@getLoanStages');
        Route::post('getLoanEmiDetails', 'WebApiController@getLoanEmiDetails');
        Route::post('applyLoan', 'WebApiController@applyLoan');
        Route::post('sendEsignOtp', 'VerificationApiController@sendEsignOtp');
        Route::post('verifyEsignOtp', 'VerificationApiController@verifyEsignOtp');
        Route::post('submitFeedback', 'WebApiController@submitFeedback');
        Route::post('myLoans', 'WebApiController@myLoans');
        Route::post('loanDetails', 'WebApiController@loanDetails');
        Route::post('getLoanDocument', 'WebApiController@getLoanDocument');
        Route::post('paymentHistory', 'WebApiController@paymentHistory');
        Route::post('getNotificationList', 'WebApiController@getNotificationList');
        Route::post('changeNotificationStatus', 'WebApiController@changeNotificationStatus');
        Route::post('contactUs', 'WebApiController@storeContactDetails');
        Route::post('getReferAndEarn', 'WebApiController@getReferAndEarn');
        Route::post('saveBusinessLoanEnquiry', 'WebApiController@saveBusinessLoanEnquiry');
        Route::post('updateBusinessEnquiryCount', 'WebApiController@updateBusinessEnquiryCount');
        Route::post('changeUserApplicationStatus', 'WebApiController@changeUserApplicationStatus');
        Route::post('getCreditReportData', 'WebApiController@getCreditReportData');
        Route::post('sendNotify', 'WebApiController@sendNotify');

        // Payment Gateway API

        Route::group(['prefix' => 'payments'], function () {
            Route::post('createOrder', 'PaymentApiController@createOrderId');
            Route::post('paymentStatus', 'PaymentApiController@razorpayPaymentStatus');
            Route::post('billdeskPaymentStatus', 'PaymentApiController@billdeskPaymentStatus');
            Route::post('payEmiNow', 'PaymentApiController@payEmiNow');
        });

        Route::group(['prefix' => 'creditReport'], function () {
            Route::post('createOrder', 'PaymentApiController@createCreditReportOrderId');
            Route::post('paymentStatus', 'PaymentApiController@razorpayCreditReportPaymentStatus');
        });
    });
});
