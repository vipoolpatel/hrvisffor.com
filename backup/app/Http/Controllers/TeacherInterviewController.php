<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 10:19 PM
 */

namespace App\Http\Controllers;


use App\TeacherTimeAvailability;
use Illuminate\Support\Facades\Auth;

class TeacherInterviewController extends Controller
{
    public function index(){
       $teacher_availabilities = TeacherTimeAvailability::where('teacher_id',Auth::id())->get();
       return view('teacher_interview.index',['teacher_availabilities'=>$teacher_availabilities]);
    }

}