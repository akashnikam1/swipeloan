<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();
Route::get('/', function () {
    return redirect('login');
});
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// User Routes

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
	Route::get('all', 'UserController@getAllUsers');
	Route::get('user_details/{id}', 'UserController@getUserDetails')->name('user.details');
	Route::post('change-status', 'UserController@changeStatus');
	Route::post('change-notification-status', 'UserController@changeNotificationStatus');
	Route::post('user_details/personal_info/edit/{id}', 'UserController@updatePersonalInfo');
	Route::post('user_details/relative_info/edit/{id}', 'UserController@updateRelativeInfo');
	Route::post('user_details/loan_limit_info/edit/{id}', 'UserController@updateLoanLimitInfo');
	Route::post('user_details/kyc_info/edit/{id}', 'UserController@updateKYCInfo');
	Route::post('user_details/bank_info/edit/{id}', 'UserController@updateBankInfo');
});

// Banner Routes

Route::group(['prefix' => 'banners', 'middleware' => ['auth']], function () {
	Route::get('all', 'BannerController@getAllBanners');
	Route::get('add', 'BannerController@getAddBanner');
	Route::post('add', 'BannerController@addBanner');
	Route::get('delete/{id}', 'BannerController@deleteBanner');
	Route::get('edit/{id}', 'BannerController@getEditBanner');
	Route::post('edit/{id}', 'BannerController@updateBanner');
	Route::post('change-status', 'BannerController@changeStatus');
});

// Partner Routes

Route::group(['prefix' => 'partners', 'middleware' => ['auth']], function () {
	Route::get('all', 'PartnerController@getAllPartners');
	Route::get('add', 'PartnerController@getAddPartner');
	Route::post('add', 'PartnerController@addPartner');
	Route::get('delete/{id}', 'PartnerController@deletePartner');
	Route::get('edit/{id}', 'PartnerController@getEditPartner');
	Route::post('edit/{id}', 'PartnerController@updatePartner');
	Route::post('change-status', 'PartnerController@changeStatus');
});

// General Setting Routes

Route::group(['prefix' => 'general_settings', 'middleware' => ['auth']], function () {
	Route::get('edit/{id}', 'GeneralSettingController@getEditGeneralSetting');
	Route::post('edit/{id}', 'GeneralSettingController@updateGeneralSetting');
});

// Notification Routes

Route::group(['prefix' => 'notifications', 'middleware' => ['auth']], function () {
	Route::get('all', 'NotificationController@getAllNotifications');
	Route::get('add', 'NotificationController@getAddNotification');
	Route::post('add', 'NotificationController@addNotification');
	Route::get('edit/{id}', 'NotificationController@getEditNotification');
	Route::post('edit/{id}', 'NotificationController@updateNotification');
	Route::get('send/{id}', 'NotificationController@pushNotification');
	Route::get('auto_notifications', 'NotificationController@getAllAutoNotifications');
});

// User Notification Routes

Route::group(['prefix' => 'user_notifications', 'middleware' => ['auth']], function () {
	Route::get('all', 'UserNotificationController@getAlluserNotifications');
});

// Loan Requests Routes

Route::group(['prefix' => 'loan_requests', 'middleware' => ['auth']], function () {
	Route::get('all', 'LoanRequestController@getAllLoanRequests');
	Route::get('loan_details/{id}', 'LoanRequestController@getAllLoanRequestDetails')->name('loan.details');
	Route::post('loan_details/declined_loan_request/{id}', 'LoanRequestController@declinedLoanRequest');
	Route::post('loan_details/disburse_amount/{id}', 'LoanRequestController@disburseLoanAmount')->name('loan.disburse');
});

// Payment Routes

Route::group(['prefix' => 'payments', 'middleware' => ['auth']], function () {
	Route::get('all', 'PaymentController@getAllPayments');
});

// Credit Report Transaction Routes

Route::group(['prefix' => 'credit_report_transactions', 'middleware' => ['auth']], function () {
	Route::get('all', 'CreditReportTransactionController@getAllCreditReportTransactions');
});

// Loan Limit Request

Route::group(['prefix' => 'loan_limit_requests', 'middleware' => ['auth']], function () {
	Route::get('all', 'LoanLimitRequestController@getAllLoanLimitRequests');
	Route::post('update', 'LoanLimitRequestController@updateCreditLimit');
});

// Contact Us Routes

Route::group(['prefix' => 'contact_us', 'middleware' => ['auth']], function () {
	Route::get('all', 'ContactUsController@getAllContacts');
});

// Loan Stages Routes

Route::group(['prefix' => 'loan_stages', 'middleware' => ['auth']], function () {
	Route::get('all', 'LoanStageController@getAllLoanStages');
	Route::post('change-status', 'LoanStageController@changeStatus');
});

// Feedback Routes

Route::group(['prefix' => 'user_feedbacks', 'middleware' => ['auth']], function () {
	Route::get('all', 'FeedbackController@getAllFeedbacks');
});

// Defaulters List

Route::group(['prefix' => 'defaulters_users', 'middleware' => ['auth']], function () {
	Route::get('all', 'DefaulterUserController@getAlldefaulters');
});

// Business Loan Enquiry Routes

Route::group(['prefix' => 'business_loan_enquiry', 'middleware' => ['auth']], function () {
	Route::get('all', 'BusinessLoanEnquiryController@getAllBusinessLoanEnquiries');
});

// NBFC Routes

Route::group(['prefix' => 'nbfc', 'middleware' => ['auth']], function () {
	Route::get('all', 'NbfcController@getAllNbfcs');
	Route::get('add', 'NbfcController@getAddNbfc');
	Route::post('add', 'NbfcController@addNbfc');
	Route::get('delete/{id}', 'NbfcController@deleteNbfc');
	Route::get('edit/{id}', 'NbfcController@getEditNbfc')->name('nbfc.edit');
	Route::post('edit/{id}', 'NbfcController@updateNbfc');
	Route::post('change-status', 'NbfcController@changeStatus');
	Route::post('update-transaction', 'NbfcController@updateTransaction');
	Route::post('convert-to-words', 'NbfcController@convertToWords');
});

// Business Enquiry Statistics Routes

Route::group(['prefix' => 'business_enquiry_statistics', 'middleware' => ['auth']], function () {
	Route::get('all', 'BusinessEnquiryStatisticsController@getAllBusinessEnquiryStatistics');
});

// Download Excel Report

Route::get('download/loan_report', 'GenerateExcelController@generateLoanReport');
Route::get('download/payment_history_report', 'GenerateExcelController@generatePaymentHistoryReport');
Route::get('download/credit_report_transaction', 'GenerateExcelController@generateCreditTransactionReport');
Route::get('download/business_loan_enquiry_report', 'GenerateExcelController@generateBusinessLoanEnquiryReport');
Route::get('download/user_report', 'GenerateExcelController@generateUserReport');

// Get User List

Route::get('fetch-users', 'NotificationController@fetchUsers')->name('users.fetch');
Route::get('calculate-users-count', 'NotificationController@fetchUsersCount')->name('calculate.user_count');