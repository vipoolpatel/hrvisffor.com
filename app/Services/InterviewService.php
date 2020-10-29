<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/22/2020
 * Time: 12:11 AM
 */

namespace App\Services;


use App\JobInvitation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class InterviewService
{
    /**
     * School Area
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getInvitationList(){
        $rows = \Illuminate\Support\Facades\DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name','jobs.company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->leftJoin('profile_cvs','job_invitations.user_id','=','profile_cvs.user_id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->where('jobs.company_id',Auth::guard('company')->user()->id)
            ->paginate(10);
        return $rows;
    }

    /**
     * Teacher Job applied list
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getJobAppliedList(){
        $rows = \Illuminate\Support\Facades\DB::table('job_apply')
            ->select('job_apply.*','users.first_name','users.last_name','companies.id as company_id',
                'companies.school_id','companies.name','countries.nationality','highest_education.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_apply.user_id','=','users.id')
            ->join('jobs','job_apply.job_id','=','jobs.id')
            ->Join('profile_cvs','job_apply.cv_id','=','profile_cvs.id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->leftJoin('countries','users.nationality_id','=','countries.id')
            ->leftJoin('highest_education','users.r_highest_education_id','=','highest_education.id')
            ->where('jobs.company_id',Auth::guard('company')->user()->id)
            ->where('job_apply.is_approve',true)
            ->where('job_apply.is_confirm',false)
            ->where('job_apply.is_cancel',false)
            ->paginate(10);

        return $rows;
    }
    public static function getInterviewConfirm(){
        $rows = \Illuminate\Support\Facades\DB::table('interview_applicants')
            ->select('interview_applicants.*','users.first_name','users.last_name','companies.id as company_id',
                'companies.school_id','companies.name','countries.nationality','highest_education.name')
            ->join('users','interview_applicants.user_id','=','users.id')
            ->join('jobs','interview_applicants.job_id','=','jobs.id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->leftJoin('countries','users.nationality_id','=','countries.id')
            ->leftJoin('highest_education','users.r_highest_education_id','=','highest_education.id')
            ->where('interview_applicants.is_confirm',true)
            ->where('jobs.company_id',Auth::guard('company')->user()->id)
            ->paginate(10);

        return $rows;
    }

    /**
     * Teacher
     * @return \Illuminate\Support\Collection
     */
    public static function getInterviewRequest(){
        $rows = DB::table('job_invitations')
            ->select('job_invitations.*','users.first_name','users.last_name',
                'companies.name','companies.id as company_id','companies.school_id','cities.city as city_name','jobs.slug')
            ->join('jobs','job_invitations.job_id','=','jobs.id')
            ->join('users','job_invitations.user_id','=','users.id')
            ->join('companies','jobs.company_id','=','companies.id')
            ->leftJoin('cities','companies.city_id','=','cities.id')
            ->where('job_invitations.user_id',Auth::id())
            ->where('is_approve',true)
            ->where('is_accept',false)
            ->get();

        return $rows;
    }
    public static function getTeacherAppliedList(){
        $rows = \Illuminate\Support\Facades\DB::table('job_apply')
            ->select('job_apply.*','users.first_name','users.last_name','companies.id as company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file','cities.city as city_name','jobs.slug')
            ->join('users','job_apply.user_id','=','users.id')
            ->join('jobs','job_apply.job_id','=','jobs.id')
            ->Join('profile_cvs','job_apply.cv_id','=','profile_cvs.id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->leftJoin('cities','companies.city_id','=','cities.id')
            ->where('job_apply.user_id',Auth::id())
            ->paginate(10);

        return $rows;
    }
    public static function getTeacherInterviewConfirm(){
        $rows = \Illuminate\Support\Facades\DB::table('interview_applicants')
            ->select('interview_applicants.*','users.first_name','users.last_name','companies.id as company_id',
                'companies.school_id','companies.name','countries.nationality','cities.city as city_name','jobs.slug')
            ->join('users','interview_applicants.user_id','=','users.id')
            ->join('jobs','interview_applicants.job_id','=','jobs.id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->leftJoin('countries','users.nationality_id','=','countries.id')
            ->leftJoin('cities','companies.city_id','=','cities.id')
            ->where('interview_applicants.is_confirm',true)
            ->where('interview_applicants.user_id',Auth::id())
            ->paginate(10);

        return $rows;
    }
}