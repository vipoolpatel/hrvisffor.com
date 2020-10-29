<?php

namespace App\Http\Controllers;

use App\Traits\Cron;
use Auth;
use App\Job;
use DB;
use App\FavouriteCompany;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    use Cron;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->runCheckPackageValidity();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matchingJobs = Job::where('functional_area_id', auth()->user()->industry_id)->paginate(7);
		$followers = FavouriteCompany::where('user_id', auth()->user()->id)->get();
		$val = 'SELECT * FROM gr_msgs where uid!="'.Auth::user()->id.'" and ("'.Auth::user()->id.'" = CONVERT(SUBSTRING_INDEX(SUBSTRING_INDEX(gid, "-", 1), "-", -1),
		UNSIGNED INTEGER) or "'.Auth::user()->id.'" = CONVERT(SUBSTRING_INDEX(SUBSTRING_INDEX(gid, "-", -1), "-", 1), UNSIGNED INTEGER))';
		$result = DB::select(DB::raw($val));
		//return view('home', compact('chart', 'matchingJobs', 'followers'));
        return view('home', compact('matchingJobs', 'followers','result'));
    }

}
