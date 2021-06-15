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

Auth::routes();

//Route::get('/home','HomeController@index');

Route::get('/student', 'StudentController@index')->name('student')->middleware('student');
Route::get('/advisor', 'AdvisorController@index')->name('advisor')->middleware('advisor');
Route::get('/administrative', 'AdministrativeController@index')->name('administrative')->middleware('administrative');
Route::get('delete/{Time}/{Date}', 'deleteMeeting@delete');
Route::get('edit/{Time}/{Date}', 'editMeeting@edit');

Route::get('deleteAccepted/{Time}/{Date}', 'deleteAcceptedMeeting@delete');
Route::get('editAccepted/{Time}/{Date}', 'editAcceptedMeeting@edit');

Route::post('edit/{Date}/edit/{Time}', 'Edit@edit');
Route::post('editAccepted/{Date}/edit/{Time}', 'EditAccepted@edit');
Route::get('book/{Name}/{Time}/{Date}', 'bookMeeting@book');
Route::get('/accepted', function () {
    return view('student.acceptedrequests');
});
Route::get('/rejected', function () {
    return view('student.rejectedrequests');
});
Route::get('/mymeetings', function () {
    return view('advisor.availablemeetings');
});
Route::get('/myrequests', function () {
    return view('advisor.requests');
});
Route::get('/meetingaccepted', function () {
    return view('advisor.acceptedmeetings');
});

Route::get('/sendRequest/{Advisor_Name}/{Student_Name}/{Date}/{Time}', 'sendRequest@send');
Route::get('accept/{Advisor_Name}/{Student_Name}/{Date}/{Time}', 'AcceptMeeting@accept');
Route::get('reject/{Advisor_Name}/{Student_Name}/{Date}/{Time}', 'RejectMeeting@reject');

Route::post('submit', 'InsertAppointments@addData');
Route::get('/student', function () {
    return view('student.index');
});

 

//Route::get('/home', 'HomeController@index')->name('home');