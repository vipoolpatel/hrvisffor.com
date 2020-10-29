<?php

/* * ******  Job Start ********** */
Route::get('list-jobs', array_merge(['uses' => 'Admin\JobController@indexJobs'], $all_users))->name('list.jobs');
Route::get('create-job', array_merge(['uses' => 'Admin\JobController@createJob'], $all_users))->name('create.job');
Route::post('store-job', array_merge(['uses' => 'Admin\JobController@storeJob'], $all_users))->name('store.job');
Route::get('edit-job/{id}', array_merge(['uses' => 'Admin\JobController@editJob'], $all_users))->name('edit.job');
Route::put('update-job/{id}', array_merge(['uses' => 'Admin\JobController@updateJob'], $all_users))->name('update.job');
Route::delete('delete-job', array_merge(['uses' => 'Admin\JobController@deleteJob'], $all_users))->name('delete.job');
Route::get('fetch-jobs', array_merge(['uses' => 'Admin\JobController@fetchJobsData'], $all_users))->name('fetch.data.jobs');
Route::put('make-active-job', array_merge(['uses' => 'Admin\JobController@makeActiveJob'], $all_users))->name('make.active.job');
Route::put('make-not-active-job', array_merge(['uses' => 'Admin\JobController@makeNotActiveJob'], $all_users))->name('make.not.active.job');
Route::put('make-featured-job', array_merge(['uses' => 'Admin\JobController@makeFeaturedJob'], $all_users))->name('make.featured.job');
Route::put('make-not-featured-job', array_merge(['uses' => 'Admin\JobController@makeNotFeaturedJob'], $all_users))->name('make.not.featured.job');

Route::get('match-jobs/{id}', array_merge(['uses' => 'Admin\JobController@matchJobs'], $all_users));




Route::get('delete-front-job-teachers-accommodation/{job_id}/{id}', 'Job\JobPublishController@DeleteFrontJobTeachersAccommodation');
Route::get('delete-front-job-school-environment/{job_id}/{id}', 'Job\JobPublishController@DeleteFrontJobSchoolEnvironment');

Route::get('applied-jobs','Admin\JobController@jobApplyList')->name('applied.jobs');
Route::get('applied-job/details/{id}','Admin\JobController@appliedJobDetails');
Route::get('applied-job/approve/{id}/{state}','Admin\JobController@jobAppliedApprove');
Route::get('applied-job/reject/{id}/{state}','Admin\JobController@jobAppliedReject');
Route::get('applied-job/destroy/{id}','Admin\JobController@jobAppliedDelete');

Route::get('job-invitations','Admin\JobInvitationController@index')->name('job.invitation');
Route::get('job-invitation/details/{id}','Admin\JobInvitationController@view');
Route::get('job-invitation/approve/{id}/{state}','Admin\JobInvitationController@isApprove');
Route::get('job-invitation/reject/{id}/{state}','Admin\JobInvitationController@isReject');
Route::get('job-invitation/destroy/{id}','Admin\JobInvitationController@destroy');




Route::get('getnotejob','Admin\JobController@GetNote');
Route::post('add-note-job','Admin\JobController@AddNote');
Route::get('delete-note-job','Admin\JobController@DeleteNote');


/* * ****** End Job ********** */