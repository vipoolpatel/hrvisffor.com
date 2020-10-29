<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/20/2020
 * Time: 2:59 PM
 */

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\TeacherTimeAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherTimeAvailabilityController extends Controller
{
    /**
     * Store Teacher Availability Time
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $this->validate($request,[
            'date'=>'required',
            'time'=>'required',
            'duration'=>'required',
            'note'=>'nullable|max:500|string'
        ]);
        $row = TeacherTimeAvailability::create([
            'teacher_id'=>Auth::id(),
            'date'=>$request->date,
            'time'=>$request->time,
            'duration'=>$request->duration,
            'note'=>$request->note
        ]);

        return redirect()->back()->with('msg','Successfully Added!!!');

    }

    /**
     * Delete Teacher Time Availability
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $row= TeacherTimeAvailability::where('teacher_id',Auth::id())->where('id',decrypt($id))->first();
        $row->delete();
        return redirect()->back()->with('msg','Successfully Deleted!!!');
    }
}