<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/21/2020
 * Time: 12:46 AM
 */

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\InterviewApplicant;
use App\SchoolJobInterviewTime;
use App\TeacherJobInterviewTime;

class TeacherJobInterviewTimeController extends Controller
{
    public function getTeacherWiseTeacherSchedule($id){
        $row = InterviewApplicant::where('id',$id)->first();
        if(!empty($row)){
            if(!empty($row->applied_id)){
                $school_times = TeacherJobInterviewTime::where('apply_id',$row->applied_id)->get();
            }else{
                $school_times = SchoolJobInterviewTime::where('invitation_id',$row->invite_id)->get();
            }
        }else{
            $school_times = SchoolJobInterviewTime::where('invitation_id',$id)->get();
        }
        return view('includes.teacher_reschedule',['teacher_times'=>$school_times]);
    }
    public function getTeacherInterviewTime($id){
        $row = InterviewApplicant::where('id',$id)->first();
        if(!empty($row)){
            if(!empty($row->applied_id)){
                $school_times = TeacherJobInterviewTime::where('apply_id',$row->applied_id)->where('is_approve',true)->get();
            }else{
                $school_times = SchoolJobInterviewTime::where('invitation_id',$row->invite_id)->where('is_approve',true)->get();
            }
        }
        return view('includes.teacher_interview_time',['teacher_times'=>$school_times]);
    }
}