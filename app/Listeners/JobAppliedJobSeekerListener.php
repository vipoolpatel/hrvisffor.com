<?php

namespace App\Listeners;

use Mail;
use DB;
use App\Events\JobApplied;
use App\Mail\JobAppliedJobSeekerMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobAppliedJobSeekerListener implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CompanyRegistered  $event
     * @return void
     */
    public function handle(JobApplied $event)
    {
		$job_id = $event->job->id;
		$user_ = auth()->user()->id;
$data=array('seeker_id'=>auth()->user()->id,"job_id"=>$event->job->id,"date_created"=>date('Y-m-d H:i:s'),"status"=>'pending');
		DB::table('job_seeker_notifications')->insert($data);

        Mail::send(new JobAppliedJobSeekerMailable($event->job, $event->jobApply));
    }

}
