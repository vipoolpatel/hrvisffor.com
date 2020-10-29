<?php

Route::get('job/{slug}', 'Job\JobController@jobDetail')->name('job.detail');
Route::get('apply/{slug}', 'Job\JobController@applyJob')->name('apply.job');
Route::post('apply/{slug}', 'Job\JobController@postApplyJob')->name('post.apply.job');
Route::get('jobs', 'Job\JobController@jobsBySearch')->name('job.list');
Route::get('add-to-favourite-job/{job_slug}', 'Job\JobController@addToFavouriteJob')->name('add.to.favourite');
Route::get('remove-from-favourite-job/{job_slug}', 'Job\JobController@removeFromFavouriteJob')->name('remove.from.favourite');
Route::get('my-job-applications', 'Job\JobController@myJobApplications')->name('my.job.applications');
Route::get('my-favourite-jobs', 'Job\JobController@myFavouriteJobs')->name('my.favourite.jobs');
Route::get('post-job', 'Job\JobPublishController@createFrontJob')->name('post.job');
Route::post('store-front-job', 'Job\JobPublishController@storeFrontJob')->name('store.front.job');
Route::get('edit-front-job/{id}', 'Job\JobPublishController@editFrontJob')->name('edit.front.job');
Route::put('update-front-job/{id}', 'Job\JobPublishController@updateFrontJob')->name('update.front.job');
Route::delete('delete-front-job', 'Job\JobPublishController@deleteJob')->name('delete.front.job');
Route::get('job-seekers', 'Job\JobSeekerController@jobSeekersBySearch')->name('job.seeker.list');

Route::get('apply-job-details/{id}','Job\JobController@applyJobDetails');
Route::get('apply-details-job/{id}','Job\JobController@applyJobDetailsByTeacher');

Route::get('job-invitation/{id}','Job\JobController@jobInvitation')->name('job.invite');
Route::post('job-invitation/{id}','Job\JobController@invitationStore')->name('job.invitation.store');
Route::get('job-invitation-list','Job\JobInvitationController@invitationList')->name('invitation.list');
Route::get('job-invitation-details/{id}','Job\JobInvitationController@invitationDetails')->name('job.invitation.details');
Route::get('teacher-job-invitation','Job\JobInvitationController@teacherInvitation')->name('teacher.invitation.list');
Route::get('teacher-invitation-details/{id}','Job\JobInvitationController@teacherInvitationDetails')->name('invitation.details');
Route::get('job-invitation/accept/{id}/{state}','Job\JobInvitationController@invitationAccept');
Route::get('job-invitation/reject/{id}/{state}','Job\JobInvitationController@invitationReject');

Route::get('job-interview-time/accept/{id}','Job\JobInvitationController@interviewTimeConfirm');
Route::get('job-interview-time/reject/{id}','Job\JobInvitationController@interviewTimeReject');


Route::get('delete-front-job-teachers-accommodation/{job_id}/{id}', 'Job\JobPublishController@DeleteFrontJobTeachersAccommodation');

Route::get('delete-front-job-school-environment/{job_id}/{id}', 'Job\JobPublishController@DeleteFrontJobSchoolEnvironment');




Route::post('submit-message', 'Job\SeekerSendController@submit_message')->name('submit-message');

Route::get('subscribe-alert', 'SubscriptionController@submitAlert')->name('subscribe.alert');
