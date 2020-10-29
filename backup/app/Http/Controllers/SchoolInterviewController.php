<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 10:11 PM
 */

namespace App\Http\Controllers;


use App\SchoolTimeAvailability;
use Illuminate\Support\Facades\Auth;

class SchoolInterviewController extends Controller
{
    public function index(){
        $school_availabilities = SchoolTimeAvailability::where('school_id',Auth::guard('company')->user()->school_id)->get();
        return view('school_interview.index',['school_availabilities'=>$school_availabilities]);
    }
}