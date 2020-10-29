<?php

namespace App\Http\Controllers\Admin;

use App\JobApply;
use App\TeacherJobInterviewTime;
use Auth;
use DB;
use Input;
use Redirect;
use App\Job;
use App\User;
use App\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Controllers\Controller;
use App\Traits\JobTrait;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\JobsNoteModel;


use App\PositionLookingModel;

use App\SchoolJoinModel;
use App\WorkTypeModel;
use App\VisaModel;
use App\TeachModel;
use App\PositionModel;
use App\SalaryExpectModel;
use App\WelfareModel;
use App\WorkingScheduleModel;
use App\CityLineModel;
use App\EmerencyLevelModel;




class JobController extends Controller
{

    use JobTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function indexJobs()
    {
        $getPositionLooking = PositionLookingModel::all();
        $getSchoolJoin      = SchoolJoinModel::all();
        $getWorkType        = WorkTypeModel::all();
        $getVisa            = VisaModel::all();
        $getTeach           = TeachModel::all();
        $getPosition        = PositionModel::all();
        $getSalaryExpect    = SalaryExpectModel::all();
        $getWelfare         = WelfareModel::all();
        $getWorkingSchedule = WorkingScheduleModel::all();
        $getCityLine        = CityLineModel::all();
        $getEmerencyLevel   = EmerencyLevelModel::all();

        

        $companies = DataArrayHelper::companiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        return view('admin.job.index')
                        ->with('companies', $companies)
                        ->with('getPositionLooking', $getPositionLooking)
                        ->with('getSchoolJoin', $getSchoolJoin)
                        ->with('getWorkType', $getWorkType)
                        ->with('getVisa', $getVisa)
                        ->with('getTeach', $getTeach)
                        ->with('getPosition', $getPosition)
                        ->with('getSalaryExpect', $getSalaryExpect)
                        ->with('getWelfare', $getWelfare)
                        ->with('getWorkingSchedule', $getWorkingSchedule)

                        ->with('getCityLine', $getCityLine)
                        ->with('getEmerencyLevel', $getEmerencyLevel)

                        ->with('countries', $countries);
    }

    public function matchJobs($id)
    {
        $job = Job::find($id);


        $Stateusers = User::select('*');
        if($job->r_english_speaker_id == "Yes")
        {
            $Stateusers = $Stateusers->where('r_english_speaker_id','=',$job->r_english_speaker_id);    
        }
        $Stateusers = $Stateusers->where('r_position_looking_id','=',$job->r_position_looking_id);
        $Stateusers = $Stateusers->where('r_work_type_id','=',$job->r_work_type_id);
        if($job->r_visa_id == 1) {
            $Stateusers = $Stateusers->where('r_visa_id','=',$job->r_visa_id);    
        }
        $Stateusers = $Stateusers->where('state_id','=',$job->state_id);    
        $Stateusers = $Stateusers->where('r_teach_id','=',$job->r_teach_id);    
        $Stateusers = $Stateusers->where('r_position_id','=',$job->r_position_id);

        $Stateusers = $Stateusers->orderBy('id','desc');
        $Stateusers = $Stateusers->limit(150);
        $Stateusers = $Stateusers->get();
        $data['Stateusers'] = $Stateusers;


        $users = User::select('*');
        if($job->r_english_speaker_id == "Yes")
        {
            $users = $users->where('r_english_speaker_id','=',$job->r_english_speaker_id);    
        }
        $users = $users->where('r_position_looking_id','=',$job->r_position_looking_id);
        $users = $users->where('r_work_type_id','=',$job->r_work_type_id);
        if($job->r_visa_id == 1) {
            $users = $users->where('r_visa_id','=',$job->r_visa_id);    
        }
        $users = $users->where('r_teach_id','=',$job->r_teach_id);    
        $users = $users->where('r_position_id','=',$job->r_position_id);

        $users = $users->orderBy('id','desc');
        $users = $users->limit(150);
        $users = $users->get();
        $data['users'] = $users;





        return view('admin.job.match_jobs',$data);
    }

    public function fetchJobsData(Request $request)
    {

        $jobs = Job::select([
                    'jobs.id', 'jobs.company_id', 'jobs.title', 'jobs.description', 'jobs.country_id', 'jobs.state_id', 'jobs.city_id', 'jobs.is_freelance', 'jobs.career_level_id', 'jobs.salary_from', 'jobs.salary_to', 'jobs.hide_salary', 'jobs.functional_area_id', 'jobs.job_type_id', 'jobs.job_shift_id', 'jobs.num_of_positions', 'jobs.gender_id', 'jobs.expiry_date', 'jobs.degree_level_id', 'jobs.job_experience_id', 'jobs.is_active', 'jobs.is_featured', 'position_looking.name','jobs.slug','jobs.r_school_id','jobs.r_work_type_id','jobs.r_english_speaker_id','jobs.r_teach_id','jobs.r_position_id','jobs.r_salary_id','jobs.r_hour_id','jobs.r_working_schedule_id','jobs.r_class_size_id','jobs.r_min_age_requirement_id','jobs.r_max_age_requirement_id','jobs.r_city_line_id','jobs.r_visa_qualification_id','jobs.r_colour_id','jobs.r_current_location_id','jobs.r_emerency_level_id'
        ]);

        $jobs = $jobs->join('position_looking','position_looking.id','=','jobs.r_position_looking_id');

        $jobs = $jobs->join('companies','companies.id','=','jobs.company_id');

        if(Auth::user()->role_id == 2) {
            $jobs = $jobs->where('companies.staff_id','=',Auth::user()->id);
        }

        if(!empty($request->search_note))
        {
            $jobs = $jobs->join('jobs_note','jobs_note.job_id','=','jobs.id');   
            $jobs = $jobs->where('jobs_note.message', 'like', '%' . $request->search_note . '%');
        }

        if(!empty($request->company_name)) {
            $jobs = $jobs->where('companies.name', 'like', '%' . $request->company_name . '%');
        }

        if(!empty($request->school_id)) {
            $jobs = $jobs->where('companies.school_id', 'like', '%' . $request->school_id . '%');
        }

        if(!empty($request->r_school_id)) {
            $jobs = $jobs->where('jobs.r_school_id','=',$request->r_school_id);   
        }

        if(!empty($request->r_work_type_id)) {
            $jobs = $jobs->where('jobs.r_work_type_id','=',$request->r_work_type_id);   
        }

        if(!empty($request->r_english_speaker_id)) {
            if($request->r_english_speaker_id == 'Yes')
            {
                $jobs = $jobs->where('jobs.r_english_speaker_id','=',$request->r_english_speaker_id);       
            }
        }

        if(!empty($request->r_visa_id)) {
            if($request->r_visa_id == 1) {
                $jobs = $jobs->where('jobs.r_visa_id','=',$request->r_visa_id);       
            }
        }

        if(!empty($request->r_teach_id)) {
            $jobs = $jobs->where('jobs.r_teach_id','=',$request->r_teach_id);   
        }

        if(!empty($request->r_position_id)) {
            $jobs = $jobs->where('jobs.r_position_id','=',$request->r_position_id);   
        }

        if(!empty($request->r_salary_id)) {
            $jobs = $jobs->where('jobs.r_salary_id','>=',intval($request->r_salary_id));   
        }

        if(!empty($request->r_max_salary_id)) {
            $jobs = $jobs->where('jobs.r_max_salary_id','<=',intval($request->r_max_salary_id));   
        }
        

        if(!empty($request->r_hour_id)) {
            $jobs = $jobs->where('jobs.r_hour_id','=',$request->r_hour_id);   
        }

        if(!empty($request->r_working_schedule_id)) {
            $jobs = $jobs->where('jobs.r_working_schedule_id','=',$request->r_working_schedule_id);   
        }

        if(!empty($request->r_class_size_id)) {
            $jobs = $jobs->where('jobs.r_class_size_id','=',$request->r_class_size_id);   
        }

        if(!empty($request->r_min_age_requirement_id)) {
            $jobs = $jobs->where('jobs.r_min_age_requirement_id','>=',$request->r_min_age_requirement_id);   
        }

         if(!empty($request->r_max_age_requirement_id)) {
            $jobs = $jobs->where('jobs.r_max_age_requirement_id','<=',$request->r_max_age_requirement_id);   
        }

        if(!empty($request->r_city_line_id)) {
            $jobs = $jobs->where('jobs.r_city_line_id','=',$request->r_city_line_id);   
        }

        if(!empty($request->r_visa_qualification_id)) {
            $jobs = $jobs->where('jobs.r_visa_qualification_id','=',$request->r_visa_qualification_id);   
        }

        if(!empty($request->r_colour_id)) {
            $jobs = $jobs->where('jobs.r_colour_id','=',$request->r_colour_id);   
        }

        if(!empty($request->r_current_location_id)) {
            $jobs = $jobs->where('jobs.r_current_location_id','=',$request->r_current_location_id);   
        }

        if(!empty($request->r_emerency_level_id)) {
            $jobs = $jobs->where('jobs.r_emerency_level_id','=',$request->r_emerency_level_id);   
        }


        return Datatables::of($jobs)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('company_id') && !empty($request->company_id)) {
                                $query->where('jobs.company_id', '=', "{$request->get('company_id')}");
                            }
                            if ($request->has('title') && !empty($request->title)) {
                                $query->where('jobs.r_position_looking_id', '=', $request->title);
                            }
                            // if ($request->has('description') && !empty($request->description)) {
                            //     $query->where('jobs.description', 'like', "%{$request->get('description')}%");
                            // }
                            if ($request->has('country_id') && !empty($request->country_id)) {
                                $query->where('jobs.country_id', '=', "{$request->get('country_id')}");
                            }
                            if ($request->has('state_id') && !empty($request->state_id)) {
                                $query->where('jobs.state_id', '=', "{$request->get('state_id')}");
                            }
                            if ($request->has('city_id') && !empty($request->city_id)) {
                                $query->where('jobs.city_id', '=', "{$request->get('city_id')}");
                            }
                            if ($request->has('is_active') && $request->is_active != -1) {
                                $query->where('jobs.is_active', '=', "{$request->get('is_active')}");
                            }
                            if ($request->has('is_featured') && $request->is_featured != -1) {
                                $query->where('jobs.is_featured', '=', "{$request->get('is_featured')}");
                            }
                        })
                        ->addColumn('school_id', function ($jobs) {
                            return '<a target="_blank" href="'.url('job/'.$jobs->slug).'">'.$jobs->getCompany('school_id').'</a>';
                        })
                        ->addColumn('company_id', function ($jobs) {
                            return $jobs->getCompany('name');
                        })
                        ->addColumn('title', function ($jobs) {
                            return $jobs->name;
                        })
                        ->addColumn('city_id', function ($jobs) {
                            return $jobs->getCity('city') . '(' . $jobs->getState('state') . '-' . $jobs->getCountry('country') . ')';
                        })
                        ->addColumn('description', function ($jobs) {
                            return strip_tags(str_limit($jobs->description, 50, '...'));
                        })
                        ->addColumn('action', function ($jobs) {
                            /*                             * ************************* */
                            $activeTxt = 'Make Active';
                            $activeHref = 'makeActive(' . $jobs->id . ');';
                            $activeIcon = 'square-o';
                            if ((int) $jobs->is_active == 1) {
                                $activeTxt = 'Make InActive';
                                $activeHref = 'makeNotActive(' . $jobs->id . ');';
                                $activeIcon = 'check-square-o';
                            }
                            $featuredTxt = 'Make Featured';
                            $featuredHref = 'makeFeatured(' . $jobs->id . ');';
                            $featuredIcon = 'square-o';
                            if ((int) $jobs->is_featured == 1) {
                                $featuredTxt = 'Make Not Featured';
                                $featuredHref = 'makeNotFeatured(' . $jobs->id . ');';
                                $featuredIcon = 'check-square-o';
                            }


                           $getnotecount = $jobs->getnotecount();

                           $colorcode =  '';
                           if($getnotecount > 0)
                           {
                                $colorcode =  'style="background: orange;border: orange;"';
                           }


                            return '
				<div class="btn-group">
                    <a  href="'.url('job-seekers?id='.$jobs->id).'" target="_blank" class="btn btn-success">Match</a>

                    <button type="button" '.$colorcode.'  class="btn btn-danger AddNotes" data-toggle="modal" data-target="#GetNote" id="'.$jobs->id.'" >Add Note</button>

					<button class="btn blue dropdown-toggle" style="position: absolute;" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
                        <li>
                            <a target="_blank" href="'.url('job/'.$jobs->slug).'"><i class="fa fa-user" aria-hidden="true"></i>View Job Detail</a>
                        </li>   

						<li>
							<a href="' . route('edit.job', ['id' => $jobs->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteJob(' . $jobs->id . ', ' . $jobs->is_default . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
						<li>
						<a href="javascript:void(0);" onClick="' . $activeHref . '" id="onclickActive' . $jobs->id . '"><i class="fa fa-' . $activeIcon . '" aria-hidden="true"></i>' . $activeTxt . '</a>
						</li>
						<li>
						<a href="javascript:void(0);" onClick="' . $featuredHref . '" id="onclickFeatured' . $jobs->id . '"><i class="fa fa-' . $featuredIcon . '" aria-hidden="true"></i>' . $featuredTxt . '</a>
						</li>


					</ul>





				</div>';

                   // <li>
                   //          <a target="_blank" href="'.url('job-seekers?id='.$jobs->id).'&state=true"><i class="fa fa-user" aria-hidden="true"></i>State Match</a>
                   //      </li>  
                   //      <li>
                   //          <a target="_blank" href="'.url('job-seekers?id='.$jobs->id).'&city=true"><i class="fa fa-user" aria-hidden="true"></i>City Match</a>
                   //      </li>  

                        })
                        ->rawColumns(['action', 'company_id', 'city_id','school_id'])
                        ->setRowId(function($jobs) {
                            return 'jobDtRow' . $jobs->id;
                        })
                        ->make(true);

        // <a href="'.url('admin/match-jobs/'.$jobs->id).'" class="btn btn-primary">Match</a>
        //$query = $dataTable->getQuery()->get();
        //return $query;
    }

    public function makeActiveJob(Request $request)
    {
        $id = $request->input('id');
        try {
            $job = Job::findOrFail($id);
            $job->is_active = 1;
            $job->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveJob(Request $request)
    {
        $id = $request->input('id');
        try {
            $job = Job::findOrFail($id);
            $job->is_active = 0;
            $job->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeFeaturedJob(Request $request)
    {
        $id = $request->input('id');
        try {
            $job = Job::findOrFail($id);
            $job->is_featured = 1;
            $job->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotFeaturedJob(Request $request)
    {
        $id = $request->input('id');
        try {
            $job = Job::findOrFail($id);
            $job->is_featured = 0;
            $job->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    /**
     * Job Applied List
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobApplyList(){
        $rows = \Illuminate\Support\Facades\DB::table('job_apply')
            ->select('job_apply.*','users.first_name','users.last_name','companies.id as company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_apply.user_id','=','users.id')
            ->join('jobs','job_apply.job_id','=','jobs.id')
            ->join('profile_cvs','job_apply.cv_id','=','profile_cvs.id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->paginate(20);

        return view('admin.apply_jobs.index',['rows'=>$rows]);
    }

    public function appliedJobDetails($id){
        $row = \Illuminate\Support\Facades\DB::table('job_apply')
            ->select('job_apply.*','users.first_name','users.last_name','companies.id as company_id','companies.school_id','companies.name',
                'profile_cvs.title','profile_cvs.cv_file')
            ->join('users','job_apply.user_id','=','users.id')
            ->join('jobs','job_apply.job_id','=','jobs.id')
            ->join('profile_cvs','job_apply.cv_id','=','profile_cvs.id')
            ->leftJoin('companies','jobs.company_id','=','companies.id')
            ->where('job_apply.id',$id)
            ->first();
        $teacher_availabilities = TeacherJobInterviewTime::where('apply_id',$id)->get();
        return view('admin.apply_jobs.view',['row'=>$row,'teacher_availabilities'=>$teacher_availabilities]);
    }
    /**
     * Applied Job Approved
     * @param $id
     * @param $state
     * @return \Illuminate\Http\RedirectResponse
     */
    public function jobAppliedApprove($id, $state){
        $row = JobApply::find($id);
        $row->is_approve=($state=='true')?1:0;
        $row->save();
        return redirect()->back();
    }

    /**
     * Applied Job Reject
     * @param $id
     * @param $state
     * @return \Illuminate\Http\RedirectResponse
     */
    public function jobAppliedReject($id, $state){
        $row = JobApply::find($id);
        $row->is_reject=($state=='true')?1:0;
        $row->save();
        return redirect()->back();
    }

    /**
     * Applied Job Delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function jobAppliedDelete($id){
        $row = JobApply::find($id);
        $row->delete();
        return redirect()->back();
    }




    public function GetNote(Request $request){
        $job_id    = $request->job_id;
        $getNote = JobsNoteModel::orderBy('id','desc')->where('job_id','=',$job_id)->get();

        $html = '';
      
        $html = '';
        $html .= '<table class="table table-striped  table-bordered">
                <thead>
                    <tr>
                        <th>Notes</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>'; 
                if (count($getNote) > 0) {
                    foreach ($getNote as $value) {
                        $html .= '<tr>
                                    <td>'.$value->message.'</td>
                                    <td width="25%">'.date('d-m-Y h:iA ',strtotime($value->created_at)).'</td>
                                    <td width="10%"><button class="btn btn-danger DeleteNote" action="'.$value->id.'_'.$value->user_id.'" ><i class="fa fa-trash" ></i></button></td>
                                  </tr>'; 
                      
                    }
                } else{
                      $html .= '<tr><td colspan ="3">No any notes</td></tr>';
                }
        $html .=' </tbody></table>';
  

        
        $json['success'] = $html;
        echo json_encode($json);

    }

    public function AddNote(Request $request){
        $UsersNote = new JobsNoteModel;
        $UsersNote->job_id    = $request->job_id;
        $UsersNote->message   = $request->message;
        $UsersNote->save();
        $json['success'] = true;
        echo json_encode($json);
    }


    public function DeleteNote(Request $request){
            $id    = $request->id;
            $record = JobsNoteModel::find($id);
            $record->delete();
            $json['success'] = true;
            echo json_encode($json);
    }















}
