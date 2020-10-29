<?php

namespace App\Http\Controllers\Job;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\Job;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobSeekers;
use App\PositionLookingModel;

class JobSeekerController extends Controller
{

    //use Skills;
    use FetchJobSeekers;

    private $functionalAreas = '';
    private $countries = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->countries = DataArrayHelper::langCountriesArray();
    }

    public function jobSeekersBySearch(Request $request)
    {
            

        if(empty(Auth::guard('company')->user()->id) && empty(Auth::guard('admin')->user()->id) && empty(Auth::user()->id)) {
             return redirect('login');
        }


        $search = $request->query('search', '');
        $functional_area_ids = $request->query('functional_area_id', array());
        $country_ids = $request->query('country_id', array());
        $state_ids = $request->query('state_id', array());
        $city_ids = $request->query('city_id', array());
        $career_level_ids = $request->query('career_level_id', array());
        $gender_ids = $request->query('gender_id', array());
        $industry_ids = $request->query('industry_ids', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $current_salary = $request->query('current_salary', '');
        $expected_salary = $request->query('expected_salary', '');
        $salary_currency = $request->query('salary_currency', '');
        $position_looking_id = $request->query('position_looking_id', '');
        
        $order_by = $request->query('order_by', 'id');
        $limit = 10;

        // $jobSeekers = $this->fetchJobSeekers($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $position_looking_id,$order_by, $limit);


        $jobSeekers = User::select('users.*');

        if(!empty($position_looking_id)) {
            $jobSeekers = $jobSeekers->where('users.r_position_looking_id', '=', $position_looking_id);    
        }

        if (!empty($country_ids[0])) {
            $jobSeekers = $jobSeekers->whereIn('users.country_id', $country_ids);
        }

        if (!empty($state_ids[0])) {        
            $jobSeekers = $jobSeekers->whereIn('users.state_id', $state_ids);
        }

        if (!empty($city_ids[0])) {
            $jobSeekers = $jobSeekers->whereIn('users.city_id', $city_ids);
        }

        if(!empty($request->id)) {

            $getJob = Job::find($request->id);
            if(!empty($getJob))
            {
                if($getJob->r_english_speaker_id == "Yes") {
                    $jobSeekers = $jobSeekers->where('users.r_english_speaker_id','=',$getJob->r_english_speaker_id);
                }

                $jobSeekers = $jobSeekers->where('users.r_position_looking_id','=',$getJob->r_position_looking_id);
                $jobSeekers = $jobSeekers->where('users.r_work_type_id','=',$getJob->r_work_type_id);

                if($getJob->r_visa_id == 1) {
                    $jobSeekers = $jobSeekers->where('users.r_visa_id','=',$getJob->r_visa_id);
                }

                $r_teach_id = array();
                if(!empty($getJob->r_teach_id))                
                {
                    $r_teach_id = array($getJob->r_teach_id,3);
                    if($getJob->r_teach_id == 3)
                    {
                        $r_teach_id = array(1,2,3);
                    }
                }

                $jobSeekers = $jobSeekers->whereIn('users.r_teach_id',$r_teach_id);


                if(!empty($getJob->state_id) && !empty($getJob->city_id)) {
                    $city_id = $getJob->city_id;
                    $state_id = $getJob->state_id;
                    
                    $jobSeekers = $jobSeekers->join('states','states.state_id','=','users.state_id');                    
                    $jobSeekers = $jobSeekers->where(function($q) use ($state_id) {
                            $q->where('users.state_id','=',$state_id)
                            ->orWhere('states.state','=','All States');
                    });

                    $jobSeekers = $jobSeekers->join('cities','cities.city_id','=','users.city_id');
                    $jobSeekers = $jobSeekers->where(function($q) use ($city_id) {
                            $q->where('users.city_id','=',$city_id)
                            ->orWhere('cities.city','=','All')
                            ->orWhere('cities.city','=','All Cities');
                    });
                }

                if(!empty($getJob->r_school_id))
                {
                    $jobSeekers = $jobSeekers->join('user_school_join','users.id','=','user_school_join.user_id');
                    $jobSeekers = $jobSeekers->where('user_school_join.school_join_id','=',$getJob->r_school_id);     
                }

            }
        }









        // if(!empty($request->id)) {

        //     $getJob = Job::find($request->id);
        //     if(!empty($getJob))
        //     {
        //         if($getJob->r_english_speaker_id == "Yes") {
        //             $jobSeekers = $jobSeekers->where('users.r_english_speaker_id','=',$getJob->r_english_speaker_id);
        //         }

        //         $jobSeekers = $jobSeekers->where('users.r_position_looking_id','=',$getJob->r_position_looking_id);
        //         $jobSeekers = $jobSeekers->where('users.r_work_type_id','=',$getJob->r_work_type_id);

        //         if($getJob->r_visa_id == 1) {
        //             $jobSeekers = $jobSeekers->where('users.r_visa_id','=',$getJob->r_visa_id);
        //         }

        //         if(!empty($request->state) || !empty($request->city)) {
        //             if(!empty($request->state))
        //             {
        //                 $jobSeekers = $jobSeekers->where('users.state_id','=',$getJob->state_id);       
        //             }

        //             if(!empty($request->city))
        //             {
        //                 $jobSeekers = $jobSeekers->where('users.city_id','=',$getJob->city_id);       
        //             }
        //         }
        //         else
        //         {
        //             if($getJob->r_teach_id != 3)
        //             {
        //                 $jobSeekers = $jobSeekers->where('users.r_teach_id','=',$getJob->r_teach_id);
        //             }
        //         }

        //         if(!empty($getJob->r_school_id))
        //         {
        //             $jobSeekers = $jobSeekers->join('user_school_join','users.id','=','user_school_join.user_id');
        //             $jobSeekers = $jobSeekers->where('user_school_join.school_join_id','=',$getJob->r_school_id);     
        //         }
        //     }
        // }











        $jobSeekers = $jobSeekers->where('users.is_active', 1);
        $jobSeekers = $jobSeekers->orderBy('users.id', 'desc');
        $jobSeekers = $jobSeekers->groupBy('users.id');
        $jobSeekers = $jobSeekers->paginate($limit);

        $getJobData = !empty($getJob) ? $getJob : '';

        /*         * ************************************************** */

        $jobSeekerIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.id');

        /*         * ************************************************** */

        $skillIdsArray = $this->fetchSkillIdsArray($jobSeekerIdsArray);

        /*         * ************************************************** */

        $countryIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.country_id');

        /*         * ************************************************** */

        $stateIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.state_id');

        /*         * ************************************************** */

        $cityIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.city_id');

        /*         * ************************************************** */

        $industryIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.industry_id');

        /*         * ************************************************** */


        /*         * ************************************************** */

        $functionalAreaIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.functional_area_id');

        /*         * ************************************************** */

        $careerLevelIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.career_level_id');

        /*         * ************************************************** */

        $genderIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.gender_id');

        /*         * ************************************************** */

        $jobExperienceIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.job_experience_id');

        /*         * ************************************************** */

        $seoArray = $this->getSEO($functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids);

        /*         * ************************************************** */

        $currencies = DataArrayHelper::currenciesArray();

        /*         * ************************************************** */

        $seo = (object) array(
                    'seo_title' => $seoArray['description'],
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );


        $getPositionLooking = PositionLookingModel::all();

        return view('user.list')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('countries', $this->countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('jobSeekers', $jobSeekers)
                        ->with('skillIdsArray', $skillIdsArray)
                        ->with('countryIdsArray', $countryIdsArray)
                        ->with('stateIdsArray', $stateIdsArray)
                        ->with('cityIdsArray', $cityIdsArray)
                        ->with('industryIdsArray', $industryIdsArray)
                        ->with('functionalAreaIdsArray', $functionalAreaIdsArray)
                        ->with('careerLevelIdsArray', $careerLevelIdsArray)
                        ->with('genderIdsArray', $genderIdsArray)
                        ->with('jobExperienceIdsArray', $jobExperienceIdsArray)
                        ->with('getPositionLooking', $getPositionLooking)
                        ->with('getJobData', $getJobData)
                        ->with('seo', $seo);
    }

}
