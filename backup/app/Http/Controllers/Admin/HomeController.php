<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Job;
use App\CompanyMessage;
use App\CompanyStaffMessage;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $getcompanymessage = CompanyMessage::select('company_messages.*','users.name as seeker_name','companies.name as company_name')
                                ->join('companies','companies.id','=','company_messages.company_id')
                                ->join('users','users.id','=','company_messages.seeker_id')
                                ->where('company_messages.status','=','unviewed');

        if(Auth::user()->role_id == 2) {
            $getcompanymessage = $getcompanymessage->where('companies.staff_id', Auth::user()->id);
        }

        $getcompanymessage = $getcompanymessage->where('company_messages.type','=','message')
                                ->orderBy('company_messages.id','desc')
                                ->get();


        $getstaffcompanymessage = CompanyStaffMessage::select('company_staff_messages.*','admins.name as seeker_name','companies.name as company_name')
                                ->join('companies','companies.id','=','company_staff_messages.company_id')
                                ->join('admins','admins.id','=','company_staff_messages.user_id')
                                ->where('company_staff_messages.status','=','unviewed');

                                if(Auth::user()->role_id == 2) {
                                    $getstaffcompanymessage = $getstaffcompanymessage->where('company_staff_messages.user_id', Auth::user()->id);
                                }
        $getstaffcompanymessage = $getstaffcompanymessage->where('company_staff_messages.type','=','reply')
                                ->orderBy('company_staff_messages.id','desc')
                                ->get();


        $today = Carbon::now();

        $totalActiveUsers = User::where('is_active', 1);
        if(Auth::user()->role_id == 2) {
            $totalActiveUsers = $totalActiveUsers->where('users.staff_id', Auth::user()->id);
        }
        $totalActiveUsers= $totalActiveUsers->count();


        $totalVerifiedUsers = User::where('verified', 1);
        if(Auth::user()->role_id == 2) {
            $totalVerifiedUsers = $totalVerifiedUsers->where('users.staff_id', Auth::user()->id);
        }
        $totalVerifiedUsers = $totalVerifiedUsers->count();


        $totalTodaysUsers = User::where('created_at', 'like', $today->toDateString() . '%');
        if(Auth::user()->role_id == 2) {
            $totalTodaysUsers = $totalTodaysUsers->where('users.staff_id', Auth::user()->id);
        }
        $totalTodaysUsers = $totalTodaysUsers->count();



        $recentUsers = User::select('users.*')->orderBy('users.id', 'DESC');
        if(Auth::user()->role_id == 2) {
            $recentUsers = $recentUsers->where('users.staff_id', Auth::user()->id);
        }
        $recentUsers = $recentUsers->take(25)->get();




        $totalActiveJobs = Job::where('jobs.is_active', 1)
                           ->join('companies','companies.id','=','jobs.company_id');
        if(Auth::user()->role_id == 2) {
            $totalActiveJobs = $totalActiveJobs->where('companies.staff_id', Auth::user()->id);
        }
        $totalActiveJobs = $totalActiveJobs->count();



        $totalFeaturedJobs = Job::where('jobs.is_featured', 1)
                            ->join('companies','companies.id','=','jobs.company_id');
        if(Auth::user()->role_id == 2) {
            $totalFeaturedJobs = $totalFeaturedJobs->where('companies.staff_id', Auth::user()->id);
        }
        $totalFeaturedJobs = $totalFeaturedJobs->count();




        $totalTodaysJobs = Job::where('jobs.created_at', 'like', $today->toDateString() . '%')
                                ->join('companies','companies.id','=','jobs.company_id');
        if(Auth::user()->role_id == 2) {
            $totalTodaysJobs = $totalTodaysJobs->where('companies.staff_id', Auth::user()->id);
        }
        $totalTodaysJobs = $totalTodaysJobs->count();


        $recentJobs = Job::select('jobs.*')->orderBy('jobs.id', 'DESC')
            ->join('companies','companies.id','=','jobs.company_id');
        if(Auth::user()->role_id == 2) {
            $recentJobs = $recentJobs->where('companies.staff_id', Auth::user()->id);
        }
        $recentJobs = $recentJobs->take(25)->get();



		$job_noti_raw = DB::select("SELECT * FROM job_seeker_notifications");
		$jobs_noti = array();
		if(isset($job_noti_raw) && !empty($job_noti_raw)){
			foreach($job_noti_raw as $temp){
				$new = array();
				$new['job'] = DB::select("SELECT jobs.*,companies.name AS company_name, companies.slug AS c_slug FROM jobs INNER JOIN companies ON companies.id = jobs.company_id WHERE jobs.id='".$temp->job_id."' LIMIT 1")[0];
				$new['user'] = DB::select("SELECT * FROM users WHERE id='".$temp->seeker_id."' LIMIT 1")[0];
				$new['apply'] = DB::select("SELECT * FROM job_apply WHERE user_id='".$temp->seeker_id."'  AND job_id='".$temp->job_id."' LIMIT 1")[0];
				$new['cv'] = DB::select("SELECT * FROM profile_cvs WHERE id='".$new['apply']->cv_id."' LIMIT 1")[0];
				$new['all'] = $temp;
				$jobs_noti[] = $new;
			}
		}
        return view('admin.home')
                        ->with('getstaffcompanymessage', $getstaffcompanymessage)
                        ->with('getcompanymessage', $getcompanymessage)
                        ->with('totalActiveUsers', $totalActiveUsers)
                        ->with('totalVerifiedUsers', $totalVerifiedUsers)
                        ->with('totalTodaysUsers', $totalTodaysUsers)
                        ->with('recentUsers', $recentUsers)
                        ->with('totalActiveJobs', $totalActiveJobs)
                        ->with('totalFeaturedJobs', $totalFeaturedJobs)
                        ->with('totalTodaysJobs', $totalTodaysJobs)
                        ->with('recentJobs', $recentJobs)
						->with('job_noti', $jobs_noti);
    }
	
	
	
    public function get_notification_message(){
            $getcompanymessage = CompanyMessage::select('company_messages.*','users.name as seeker_name','companies.name as company_name')
                ->join('companies','companies.id','=','company_messages.company_id')
                ->join('users','users.id','=','company_messages.seeker_id');
                if(Auth::user()->role_id == 2) {
                    $getcompanymessage = $getcompanymessage->where('companies.staff_id', Auth::user()->id);
                }
                $getcompanymessage = $getcompanymessage->where('company_messages.status','=','unviewed')
                ->where('company_messages.type','=','message')
                ->orderBy('company_messages.id','desc')
                ->get();


            return response()->json([
                "status" => count($getcompanymessage),
                "items" => view("admin.get_notification_message", [
                    "getcompanymessage" => $getcompanymessage,
                ])->render(),
            ], 200);
        

    }

    public function get_company_notification_message(){

        $getstaffcompanymessage = CompanyStaffMessage::select('company_staff_messages.*','admins.name as seeker_name','companies.name as company_name')
                                ->join('companies','companies.id','=','company_staff_messages.company_id')
                                ->join('admins','admins.id','=','company_staff_messages.user_id')
                                ->where('company_staff_messages.status','=','unviewed');

                                if(Auth::user()->role_id == 2) {
                                    $getstaffcompanymessage = $getstaffcompanymessage->where('company_staff_messages.user_id', Auth::user()->id);
                                }
        $getstaffcompanymessage = $getstaffcompanymessage->where('company_staff_messages.type','=','reply')
                                ->orderBy('company_staff_messages.id','desc')
                                ->get();




            return response()->json([
                "status" => count($getstaffcompanymessage),
                "items" => view("admin.get_company_notification_message", [
                    "getstaffcompanymessage" => $getstaffcompanymessage,
                ])->render(),
            ], 200);
        

    }

    

}
