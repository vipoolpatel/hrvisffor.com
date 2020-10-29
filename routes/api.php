<?php

use Illuminate\Http\Request;

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
Route::get('school-interview-reschedule/{id}','School\SchoolJobInterviewTimeController@getTeacherWiseSchoolSchedule');
Route::get('teacher-interview-reschedule/{id}','Teacher\TeacherJobInterviewTimeController@getTeacherWiseTeacherSchedule');
Route::get('teacher-interview-time/{id}','Teacher\TeacherJobInterviewTimeController@getTeacherInterviewTime');
Route::get('school-interview-time/{id}','School\SchoolJobInterviewTimeController@getSchoolInterviewTime');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
