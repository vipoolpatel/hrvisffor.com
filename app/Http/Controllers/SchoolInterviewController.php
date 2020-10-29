<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 10:11 PM
 */

namespace App\Http\Controllers;


use App\Events\JobApplied;
use App\InterviewApplicant;
use App\JobApply;
use App\JobInvitation;
use App\SchoolJobInterviewTime;
use App\SchoolTimeAvailability;
use App\TeacherJobInterviewTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolInterviewController extends Controller
{
    public function index(){
        $school_availabilities = SchoolTimeAvailability::where('school_id',Auth::guard('company')->user()->school_id)->get();
        $school_times =[];
        return view('school_interview.index',['school_availabilities'=>$school_availabilities,'school_times'=>$school_times]);
    }
    public function appliedJobAccept($id, $state){

        $row = JobApply::where('id',decrypt($id))->first();
        $row->update([
            'is_confirm'=>1
        ]);
        InterviewApplicant::create([
            'user_id'=>$row->user_id,
            'job_id'=>$row->job_id,
            'type'=>1,
            'applied_id'=>decrypt($id),
            'is_confirm'=>1,
        ]);
        return redirect()->back();
    }
    public function appliedJobCancel($id,$state){
        $row = JobApply::where('id',decrypt($id))->first();
        $row->update([
            'is_cancel'=>1
        ]);
        return redirect()->back();
    }
    public function appliedJobTimeAccept($id){
        $row = TeacherJobInterviewTime::where('id',$id)->first();
        $row->update([
            'is_approve'=>1
        ]);

        return redirect()->back();
    }
    public function appliedJobTimeReject($id){
        $row = TeacherJobInterviewTime::where('id',$id)->first();
        $row->update([
            'is_reject'=>1
        ]);
        return redirect()->back();
    }
    public function storeReschedule(Request $request){

    }
    public function interviewCancel($id){
        $row = InterviewApplicant::where('id',$id)->first();
        $row->update([
            'is_cancel'=>1,
            'is_confirm'=>0,
        ]);
        return redirect()->back();
    }
    public function confirmJobDetails(){

    }
    public function storeConfirmReschedule(Request $request){

        if(!empty($request->invitation_id)){
            $row = InterviewApplicant::where('invite_id',$request->invitation_id)->first();
            if(!empty($row)){
                $row->delete();
            }

            $invitation = JobInvitation::where('id',$request->invitation_id)->first();
            $invitation->update([
                    'is_accept'=>0
            ]);
            $school_time = SchoolJobInterviewTime::where('invitation_id',$request->invitation_id)->delete();

            foreach ($request->date as $key=>$d) {
                $r = SchoolJobInterviewTime::create([
                    'job_id' => $request->job_id,
                    'user_id' => $request->user_id,
                    'invitation_id' => $request->invitation_id,
                    'date' => $d,
                    'time' => $request['time'][$key],
                    'duration' => $request['duration'][$key],
                    'note' => $request['note'][$key],
                ]);
            }
        }elseif (!empty($request->apply_id)){
            $row = InterviewApplicant::where('applied_id',$request->apply_id)->first();
            if(!empty($row)){
                $row->delete();
            }
            $invitation = JobApply::where('id',$request->apply_id)->first();

            $invitation->update([
                'is_confirm'=>0
            ]);

            $teacher_time = TeacherJobInterviewTime::where('apply_id',$request->apply_id)->delete();


            foreach ($request->date as $key=>$dd) {
                $r = TeacherJobInterviewTime::create([
                    'job_id' => $request->job_id,
                    'user_id' => $request->user_id,
                    'apply_id' => $request->apply_id,
                    'date' => $dd,
                    'time' => $request['time'][$key],
                    'duration' => $request['duration'][$key],
                    'note' => $request['note'][$key],
                ]);
            }
        }else{

        }
        return redirect()->back();
    }
    public function invitationAccept($id, $state){

    }
    public function addInterviewRoom(Request $request){
        $interview = InterviewApplicant::where('id',$request->interview_id)->first();
        $interview->update([
           'interview_room'=>$request->interview_room
        ]);
        return redirect()->back();
    }

}