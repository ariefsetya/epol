<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/core', 'LotteryController@core');
Route::get('/lottery/history','LotteryController@history');
Route::get('/lottery/scan','LotteryController@scan');
Route::get('/lottery/report','LotteryController@report');
Route::get('/lottery/display','LotteryController@display');
Route::get('/quiz/display','PollingController@display');
Route::get('/quiz/display_report/{id}','PollingController@display_report')->name('quiz_display_report');
Route::get('/polling/essay_report/{id}','PollingController@polling_essay_report')->name('polling_essay_report');
Route::get('/participant/list','LotteryController@participant');
Route::get('/participant_category/list','LotteryController@participant_category');
Route::post('/upload/csv','LotteryController@upload_csv');

// Route::get('/home', 'HomeController@index');

//--------------------------import from er
Route::post('/register_user', 'CustomAuthController@register_user')->name('register_user');
Route::get('/loginPage','CustomAuthController@loginPage')->name('loginPage');
Route::get('/registerPage','CustomAuthController@registerPage')->name('registerPage');
Route::get('/create_event/{name}/{location}/{date}','EventController@create_event')->name('create_event');

Route::post('/phoneLogin','CustomAuthController@phoneLogin')->name('phoneLogin');
Route::get('/removeRedirectToHome','CustomAuthController@removeRedirectToHome')->name('removeRedirectToHome');

Route::get('/setting/reset_presence','HomeController@reset_presence')->name('reset_presence');
Route::get('/setting/reset_polling','HomeController@reset_polling')->name('reset_polling');
Route::get('/setting/reset_quiz','HomeController@reset_quiz')->name('reset_quiz');
Route::get('/setting/reset_lottery','HomeController@reset_lottery')->name('reset_lottery');
Route::get('/polling_setting','PollingController@polling_setting')->name('polling_setting');
Route::get('/lottery_setting','LotteryController@lottery_setting')->name('lottery_setting');
Route::get('/quiz_join/{id}','HomeController@quiz_join')->name('quiz_join');
Route::get('/finish_quiz/{id}','HomeController@finish_quiz')->name('finish_quiz');
Route::get('/polling_question/{id?}','HomeController@polling_question')->name('polling_question');
Route::get('/polling_response/{id}','HomeController@polling_response')->name('polling_response');
Route::get('/polling_response/{question_id?}/{answer_id?}','HomeController@select_polling_response')->name('select_polling_response');
Route::post('/checkbox_essay','HomeController@save_checkbox_essay')->name('save_checkbox_essay');
Route::post('/vote_essay','HomeController@save_vote_essay')->name('save_vote_essay');
Route::get('/set_winner/{response_id?}/{user_id?}','HomeController@set_winner')->name('set_winner');
Route::get('/quiz_report/{polling_id?}','HomeController@quiz_report')->name('quiz_report');
Route::get('/quiz_result/{polling_id?}','HomeController@quiz_result')->name('quiz_result');
Route::get('/quiz_result_data/{polling_id}','HomeController@quiz_result_data')->name('quiz_result_data');

Route::post('/join_quiz/{id}', 'HomeController@join_quiz')->name('join_quiz');
Route::get('/downloadBarcode', 'HomeController@downloadBarcode')->name('downloadBarcode');
Route::get('/viewBarcode', 'HomeController@viewBarcode')->name('viewBarcode');
Route::get('/viewEticket', 'HomeController@viewEticket')->name('viewEticket');
Route::get('/viewEticketPDF', 'HomeController@viewEticketPDF')->name('viewEticketPDF');
Route::get('/sendEmailBarcode', 'HomeController@sendEmailBarcode')->name('sendEmailBarcode');
Route::get('/setEmail', 'HomeController@setEmail')->name('setEmail');
Route::get('/sendEmailWA', 'HomeController@sendEmailWA')->name('sendEmailWA');

Route::get('/logout','CustomAuthController@logout')->name('logout');
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {

   Route::get('/polling_response/{polling_id}/{user_id}/reset','PollingController@polling_response_reset')->name('polling_response.reset');
   Route::get('/quiz_response/{id}','HomeController@quiz_response')->name('quiz_response');
   Route::get('/quiz_response/{question_id?}/{answer_id?}','HomeController@select_quiz_response')->name('select_quiz_response');
   Route::get('/user/register/face', 'InvitationController@register_face')->name('user.register_face');
   Route::get('/user/check_in/face', 'InvitationController@check_in_face')->name('user.check_in_face');
   Route::post('/user/check_id', 'InvitationController@check_id')->name('user.check_id');
   Route::post('/user/register/face', 'InvitationController@process_register_face')->name('user.process_register_face');

});

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::resource('lottery_property','LotteryPropertyController');
    Route::resource('event_detail','EventDetailController');
    Route::resource('user','InvitationController');
    Route::resource('polling','PollingController');
    Route::resource('polling_answer','PollingAnswerController');
    Route::resource('polling_question','PollingQuestionController');
    Route::get('/product/chart/{id}','HomeController@product_chart')->name('product.chart');
    Route::get('/product/report','HomeController@product_report')->name('product.report');
    Route::get('/product/report/excel','HomeController@product_export_excel')->name('product.export_excel');
    Route::get('/polling_essay/report/excel/{id}','PollingController@polling_essay_export_excel')->name('polling_essay.export_excel');
    Route::get('/presence/report','InvitationController@report')->name('presence.report');
    Route::get('/presence/export/excel', 'InvitationController@export_excel')->name('user.export_excel');
    Route::get('/rsvp/report','RSVPController@report')->name('rsvp.report');
    Route::get('/rsvp/export/excel', 'RSVPController@export_excel')->name('rsvp.export_excel');
    Route::get('/quiz/export/excel/{polling_id}', 'HomeController@quiz_export_excel')->name('quiz.export_excel');
    Route::get('/scan_history/export/excel/', 'LotteryController@scan_history_export_excel')->name('scan_history.export_excel');
    Route::get('/user/{id}/clear','InvitationController@clear')->name('user.clear');
    Route::get('/user/reset','InvitationController@reset')->name('user.reset');
    Route::get('/polling/report','PollingController@report')->name('polling.report');
    Route::get('/polling/activate/{id}','PollingController@activate')->name('polling.activate');
    Route::get('/polling/deactivate/{id}','PollingController@deactivate')->name('polling.deactivate');
    Route::get('/','HomeController@admin')->name('admin');
    Route::get('/user/import', 'InvitationController@import')->name('user.import');
    Route::post('/user/import', 'InvitationController@process_import')->name('user.process_import');
    Route::post('/user/import/update', 'InvitationController@process_import_update')->name('user.process_import_update');
    Route::get('/polling/{polling_id?}/{question_id?}','PollingController@detail')->name('polling.detail');
    Route::get('/screen','HomeController@screen')->name('screen');
});

Route::get('qrcode/{text}', 'HomeController@qrcode');
Route::post('/rsvp/confirm','RSVPController@confirm')->name('rsvp.confirm');
Route::post('/rsvp/update','RSVPController@update')->name('rsvp.update');
Route::get('/rsvp/reset','RSVPController@reset')->name('rsvp.reset');
Route::get('/rsvp/scan/{id}','RSVPController@scan')->name('rsvp.scan');
Route::get('/rsvp/print/{id}/{info}','RSVPController@print')->name('rsvp.print');
Route::get('/rsvp/print_qr/{id}','RSVPController@print_qr')->name('rsvp.print_qr');
Route::get('/rsvp/checkin/{id}','RSVPController@checkin')->name('rsvp.checkin');
Route::get('/rsvp/helpdesk','RSVPController@helpdesk')->name('rsvp.helpdesk');
Route::get('/rsvp/seat/{session?}','RSVPController@seat')->name('rsvp.seat');
Route::get('/rsvp/search/{id}','RSVPController@search')->name('rsvp.search');

Route::get('/lottery/operator', 'LotteryController@operator');
Route::get('/lottery/apps', 'LotteryController@apps');
Route::get('/lottery/winners', 'LotteryController@winners');

Route::get('/vote', 'CustomAuthController@vote');
Route::post('/process_login_vote', 'CustomAuthController@process_login_vote')->name('process_login_vote');
Route::get('/quiz', 'CustomAuthController@quiz');
Route::post('/process_login_quiz', 'CustomAuthController@process_login_quiz')->name('process_login_quiz');