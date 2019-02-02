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

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
// Route::resource('user', 'UserController');
// Route::resource('permission', 'PermissionController');
// Route::resource('role', 'RoleController');
Route::middleware(['auth','revalidate'])->group(function () {

    Route::resource('students','StudentController');
    Route::resource('activities','ActivityController');
    Route::resource('schoolyear','SchoolYearController');
    Route::resource('activity-settings','ActivitySettingController');
    Route::resource('attendance','AttendanceController');
    Route::get('summary-attendance','AttendanceSummaryController@index');
    Route::get('total-summary-attendance','TotalAttedanceSummaryController@index');

    Route::get('/scan-students','StudentController@scanBarcode');
    Route::get('/search-idstudents','StudentController@scanID');
    Route::get('/get-activitysettings','ActivitySettingController@index');
    Route::get('/get-activity','ActivityController@getActivity');
    Route::get('/get-schoolyear','SchoolYearController@getSchoolYear');

    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');

    Route::get('/', function () {
        return view('home');
    });
    Route::get('/attendances', function () {
        return view('attendance.index');
    });
    Route::get('/manual-attendance', function () {
        return view('manual-attendance.index');
    });
    Route::get('/attendance-summary', function () {
        return view('attendance-summary.index');
    });
    Route::get('/attendance-list', function () {
        return view('attendance-list.index');
    });
    Route::get('/activity', function () {
        return view('activity.index');
    });
    Route::get('/student', function () {
        return view('student.index');
    });

    Route::get('/', 'DashboardController@index');
    Route::get('/home', 'DashboardController@index');



    Route::resource('profile', 'ProfileController');

});