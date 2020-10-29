<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/21/2020
 * Time: 1:24 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\JobInvitation;
use App\SchoolJobInterviewTime;

class JobInvitationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $rows = \Illuminate\Support\Facades\DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name','jobs.company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->leftJoin('profile_cvs','job_invitations.user_id','=','profile_cvs.user_id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->paginate(20);

        return view('admin.job_invitation.index',['rows'=>$rows]);
    }
    public function view($id){
        $row = \Illuminate\Support\Facades\DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name','jobs.company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->leftJoin('profile_cvs','job_invitations.user_id','=','profile_cvs.user_id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->where('job_invitations.id',$id)
            ->first();
        $school_availabilities = SchoolJobInterviewTime::where('invitation_id',$id)->get();
        return view('admin.job_invitation.view',['row'=>$row,'school_availabilities'=>$school_availabilities]);
    }
    public function isApprove($id, $state){
        $row = JobInvitation::find($id);
        $row->is_approve=($state=='true')?1:0;
        $row->save();
        return redirect()->back();
    }
    public function isReject($id, $state){
        $row = JobInvitation::find($id);
        $row->is_reject=($state=='true')?1:0;
        $row->save();
        return redirect()->back();
    }
    public function destroy($id){
        $row = JobInvitation::find($id);
        $row->delete();
        return redirect()->back();
    }
}