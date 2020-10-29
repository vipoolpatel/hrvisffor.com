<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/20/2020
 * Time: 2:58 PM
 */

namespace App\Http\Controllers\School;


use App\Http\Controllers\Controller;
use App\SchoolTimeAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolTimeAvailabilityController extends Controller
{
    /**
     * Store School Availability Time
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

        $row = SchoolTimeAvailability::create([
            'school_id'=>Auth::guard('company')->user()->school_id,
            'date'=>$request->date,
            'time'=>$request->time,
            'duration'=>$request->duration,
            'note'=>$request->note
        ]);

        return redirect()->back();

    }

    /**
     * Delete School Time Availability
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $row= SchoolTimeAvailability::where('id',decrypt($id))->where('school_id',Auth::guard('company')->user()->school_id)->first();
        $row->delete();
        return redirect()->back();
    }
}