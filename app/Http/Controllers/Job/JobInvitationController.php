<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/22/2020
 * Time: 1:57 AM
 */

namespace App\Http\Controllers\Job;


use App\Http\Controllers\Controller;
use App\InterviewApplicant;
use App\JobInvitation;
use App\SchoolJobInterviewTime;
use Illuminate\Support\Facades\Auth;

class JobInvitationController extends Controller
{
    public function invitationList(){
        $rows = \Illuminate\Support\Facades\DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name','jobs.company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->leftJoin('profile_cvs','job_invitations.user_id','=','profile_cvs.user_id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->where('jobs.company_id',Auth::guard('company')->user()->id)
            ->paginate(20);
        return view('school_interview.invitation',['rows'=>$rows]);
    }
    public function invitationDetails($id){
        $row = \Illuminate\Support\Facades\DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name','jobs.company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->leftJoin('profile_cvs','job_invitations.user_id','=','profile_cvs.user_id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->where('job_invitations.id',$id)
            ->where('jobs.company_id',Auth::guard('company')->user()->id)
            ->first();

        $school_availabilities = SchoolJobInterviewTime::where('invitation_id',$id)->get();
        return view('school_interview.invitation_details',['row'=>$row,'school_availabilities'=>$school_availabilities]);

    }
    public function teacherInvitation(){
        $rows = \Illuminate\Support\Facades\DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name','jobs.company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file','jobs.slug')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->leftJoin('profile_cvs','job_invitations.user_id','=','profile_cvs.user_id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->where('job_invitations.user_id',Auth::id())
            ->where('job_invitations.is_approve',true)
            ->paginate(20);
        return view('teacher_interview.invitation',['rows'=>$rows]);
    }
    public function teacherInvitationDetails($id){
        $row = \Illuminate\Support\Facades\DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name','jobs.company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file','jobs.slug')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->leftJoin('profile_cvs','job_invitations.user_id','=','profile_cvs.user_id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->where('job_invitations.id',$id)
            ->where('job_invitations.user_id',Auth::id())
            ->first();

        $school_availabilities = SchoolJobInterviewTime::where('invitation_id',$id)->get();
        return view('teacher_interview.invitation_details',['row'=>$row,'school_availabilities'=>$school_availabilities]);

    }
    public function invitationAccept($id, $state){
        $row = JobInvitation::where('user_id',Auth::id())->where('id',$id)->first();
        $row->update([
           'is_accept'=>1
        ]);
        InterviewApplicant::create([
           'user_id'=>$row->user_id,
           'job_id'=>$row->job_id,
           'type'=>2,
           'invite_id'=>$id,
           'is_confirm'=>1,
        ]);
        return redirect()->back();
    }
    public function invitationReject($id, $state){
        $row = JobInvitation::where('user_id',Auth::id())->where('id',$id)->first();
        $row->update([
            'is_cancel'=>1
        ]);
        return redirect()->back();
    }
    public function interviewTimeConfirm($id){
        $row = SchoolJobInterviewTime::find($id);
        $row->update([
            'is_approve'=>1
        ]);
        return redirect()->back();
    }
    public function interviewTimeReject($id){
        $row = SchoolJobInterviewTime::find($id);
        $row->update([
            'is_reject'=>1
        ]);
        return redirect()->back();
    }
}