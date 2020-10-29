<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 10:19 PM
 */

namespace App\Http\Controllers;


use App\InterviewApplicant;
use App\JobApply;
use App\JobInvitation;
use App\SchoolJobInterviewTime;
use App\TeacherJobInterviewTime;
use App\TeacherTimeAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherInterviewController extends Controller
{
    public function index(){
       $teacher_availabilities = TeacherTimeAvailability::where('teacher_id',Auth::id())->get();
        $teacher_times = [];
       return view('teacher_interview.index',['teacher_availabilities'=>$teacher_availabilities,'teacher_times'=>$teacher_times]);
    }
    public function storeReschedule(Request $request){

    }
    public function interviewCancel($id){
        $row = InterviewApplicant::where('id',$id)->where('user_id',Auth::id())->first();
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
            $row = InterviewApplicant::where('invite_id',$request->invitation_id)->where('user_id',Auth::id())->first();
            if(!empty($row)){
                $row->delete();
            }
            $invitation = JobInvitation::where('id',$request->invitation_id)->first();
            $invitation->update([
                'is_accept'=>0
            ]);
            $school_time = SchoolJobInterviewTime::where('invitation_id',$request->invitation_id)->delete();;


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
            $row = InterviewApplicant::where('applied_id',$request->apply_id)->where('user_id',Auth::id())->first();
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

}