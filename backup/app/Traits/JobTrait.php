<?php

namespace App\Traits;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\Job;
use App\Company;
use App\JobSkill;
use App\JobSkillManager;
use App\Country;
use App\CountryDetail;
use App\State;
use App\City;
use App\CareerLevel;
use App\FunctionalArea;
use App\JobType;
use App\JobShift;
use App\Gender;
use App\JobExperience;
use App\DegreeLevel;
use App\SalaryPeriod;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\JobFormRequest;
use App\Http\Requests\Front\JobFrontFormRequest;
use App\Http\Controllers\Controller;
use App\Traits\Skills;
use App\Events\JobPosted;
use App\PositionLookingModel;
use App\SchoolJoinModel;
use App\WorkTypeModel;
use App\VisaModel;
use App\TeachModel;
use App\PositionModel;
use App\SalaryExpectModel;
use App\WelfareModel;
use App\WorkingScheduleModel;
use App\JobWelfareModel;
use App\JobSchoolEnvironmentModel;
use App\JobTeachersAccommodationModel;
use App\EmerencyLevelModel;


use App\CityLineModel;

use File;

trait JobTrait
{

    use Skills;

    public function deleteJob(Request $request)
    {
        $id = $request->input('id');
        try {
            $job = Job::findOrFail($id);
            JobSkillManager::where('job_id', '=', $id)->delete();
            

            JobWelfareModel::where('job_id','=',$job->id)->delete();

            foreach($job->jobschoolenvironment as $jobschoolenvironment) {
                unlink('public/company/'.$jobschoolenvironment->image_name);
            }

            foreach($job->jobteachersaccommodation as $jobteachersaccommodation) {
                unlink('public/company/'.$jobteachersaccommodation->image_name);
            }
            
            JobSchoolEnvironmentModel::where('job_id','=',$job->id)->delete();
            JobTeachersAccommodationModel::where('job_id','=',$job->id)->delete();
            
            $job->delete();

            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    private function updateFullTextSearch($job)
    {
        $str = '';
        $str .= $job->getCompany('name');
        $str .= ' ' . $job->getCountry('country');
        $str .= ' ' . $job->getState('state');
        $str .= ' ' . $job->getCity('city');
        $str .= ' ' . $job->title;
        $str .= ' ' . $job->description;
        $str .= $job->getJobSkillsStr();
        $str .= ((bool) $job->is_freelance) ? ' freelance remote work from home multiple cities' : '';
        $str .= ' ' . $job->getCareerLevel('career_level');
        $str .= ((bool) $job->hide_salary === false) ? ' ' . $job->salary_from . ' ' . $job->salary_to : '';
        $str .= $job->getSalaryPeriod('salary_period');
        $str .= ' ' . $job->getFunctionalArea('functional_area');
        $str .= ' ' . $job->getJobType('job_type');
        $str .= ' ' . $job->getJobShift('job_shift');
        $str .= ' ' . $job->getGender('gender');
        $str .= ' ' . $job->getDegreeLevel('degree_level');
        $str .= ' ' . $job->getJobExperience('job_experience');

        $job->search = $str;
        $job->update();
    }

    private function assignJobValues_Rechange($job, $request)
    {
        $job->r_position_looking_id = $request->input('r_position_looking_id');
        $job->r_school_id = $request->input('r_school_id');
        $job->r_work_type_id = $request->input('r_work_type_id');
        $job->country_id = $request->input('country_id');
        $job->state_id = $request->input('state_id');
        $job->city_id = $request->input('city_id');

        $job->r_english_speaker_id = $request->input('r_english_speaker_id');
        $job->r_visa_id = $request->input('r_visa_id');
        $job->r_teach_id = $request->input('r_teach_id');
        $job->r_position_id =  $request->input('r_position_id');
        $job->r_salary_id = $request->input('r_salary_id');
        $job->r_max_salary_id = $request->input('r_max_salary_id');
        

        $job->r_hour_id = $request->input('r_hour_id');
        $job->r_working_schedule_id = $request->input('r_working_schedule_id');
        $job->r_class_size_id = $request->input('r_class_size_id');
        $job->r_min_age_requirement_id = $request->input('r_min_age_requirement_id');
        $job->r_max_age_requirement_id = $request->input('r_max_age_requirement_id');
        $job->r_contact_name = $request->input('r_contact_name');
        $job->r_phone_number = $request->input('r_phone_number');
        $job->r_wechat_id = $request->input('r_wechat_id');
        $job->r_school_name = $request->input('r_school_name');
        $job->expiry_date = $request->input('expiry_date');
        return $job;

    }

    private function assignJobValues($job, $request)
    {
        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->benefits = $request->input('benefits');
        $job->country_id = $request->input('country_id');
        $job->state_id = $request->input('state_id');
        $job->city_id = $request->input('city_id');
        $job->is_freelance = $request->input('is_freelance');
        $job->career_level_id = $request->input('career_level_id');
        $job->salary_from = (int) $request->input('salary_from');
        $job->salary_to = (int) $request->input('salary_to');
        $job->salary_currency = $request->input('salary_currency');
        $job->hide_salary = $request->input('hide_salary');
        $job->functional_area_id = $request->input('functional_area_id');
        $job->job_type_id = $request->input('job_type_id');
        $job->job_shift_id = $request->input('job_shift_id');
        $job->num_of_positions = $request->input('num_of_positions');
        $job->gender_id = $request->input('gender_id');
        $job->expiry_date = $request->input('expiry_date');
        $job->degree_level_id = $request->input('degree_level_id');
        $job->job_experience_id = $request->input('job_experience_id');
        $job->salary_period_id = $request->input('salary_period_id');
        return $job;
    }

    public function createJob()
    {
        
        $companies = DataArrayHelper::companiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $currencies = DataArrayHelper::currenciesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();
        $jobTypes = DataArrayHelper::defaultJobTypesArray();
        $jobShifts = DataArrayHelper::defaultJobShiftsArray();
        $genders = DataArrayHelper::defaultGendersArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $jobSkills = DataArrayHelper::defaultJobSkillsArray();
        $degreeLevels = DataArrayHelper::defaultDegreeLevelsArray();
        $salaryPeriods = DataArrayHelper::defaultSalaryPeriodsArray();
        $jobSkillIds = array();

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
        
        

        return view('admin.job.add')
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

                        ->with('companies', $companies)
                        ->with('countries', $countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('careerLevels', $careerLevels)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('jobTypes', $jobTypes)
                        ->with('jobShifts', $jobShifts)
                        ->with('genders', $genders)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('jobSkills', $jobSkills)
                        ->with('jobSkillIds', $jobSkillIds)
                        ->with('degreeLevels', $degreeLevels)
                        ->with('salaryPeriods', $salaryPeriods);
    }

    public function storeJob(JobFormRequest $request)
    {
        $job = new Job();
        $job->company_id = $request->input('company_id');
        $job = $this->assignJobValues_Rechange($job, $request);
        $job->is_active = $request->input('is_active');
        $job->is_featured = $request->input('is_featured');

        $job->r_city_line_id        = $request->input('r_city_line_id');
        $job->r_visa_qualification_id = $request->input('r_visa_qualification_id');
        $job->r_colour_id           = $request->input('r_colour_id');
        $job->r_current_location_id = $request->input('r_current_location_id');
        $job->r_emerency_level_id   = $request->input('r_emerency_level_id');



        $job->save();
        /*         * ******************************* */
        $jobtitle = PositionLookingModel::find($request->r_position_looking_id);
        $job->slug = str_slug($jobtitle->name, '-') . '-' . $job->id;

       

        /*         * ******************************* */
        $job->update();


        JobWelfareModel::where('job_id','=',$job->id)->delete();
        foreach ($request->welfare as $welfare_id) {
            $savewelfate             = new JobWelfareModel;
            $savewelfate->job_id    = $job->id;
            $savewelfate->welfare_id = $welfare_id;
            $savewelfate->save();
        }

        if(!empty($request->file('school_environment')))
        {
            $i = 0;
            $destinationPath = public_path('/company/'); // upload path
            foreach($request->file('school_environment') as $img) {
                $profileImage = $i.date('YmdHis').'.jpg';
                $img->move($destinationPath, $profileImage);

                $imagemodel= new JobSchoolEnvironmentModel();
                $imagemodel->job_id = $job->id;
                $imagemodel->image_name = $profileImage;
                $imagemodel->save();
                $i++;
            }
        }

        if(!empty($request->file('teachers_accommodation')))
        {
            $i = 100;
            $destinationPaths = public_path('/company/'); // upload path
            foreach($request->file('teachers_accommodation') as $imgs) {
                $profileImages = $i.date('YmdHis').'.jpg';
                $imgs->move($destinationPaths, $profileImages);
                
                $imagemodelda = new JobTeachersAccommodationModel();
                $imagemodelda->job_id = $job->id;
                $imagemodelda->image_name = $profileImages;
                $imagemodelda->save();
                $i++;
            }
        }



        /*         * ************************************ */
        /*         * ************************************ */
        // $this->storeJobSkills($request, $job->id);
        /*         * ************************************ */
        // $this->updateFullTextSearch($job);
        /*         * ************************************ */
        flash('Job has been added!')->success();
        return \Redirect::route('edit.job', array($job->id));
    }

    public function editJob($id)
    {
        $companies = DataArrayHelper::companiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $currencies = DataArrayHelper::currenciesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();
        $jobTypes = DataArrayHelper::defaultJobTypesArray();
        $jobShifts = DataArrayHelper::defaultJobShiftsArray();
        $genders = DataArrayHelper::defaultGendersArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $jobSkills = DataArrayHelper::defaultJobSkillsArray();
        $degreeLevels = DataArrayHelper::defaultDegreeLevelsArray();
        $salaryPeriods = DataArrayHelper::defaultSalaryPeriodsArray();

        $job = Job::findOrFail($id);
        $jobSkillIds = $job->getJobSkillsArray();


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
        


        return view('admin.job.edit')
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
                        


                        ->with('companies', $companies)
                        ->with('countries', $countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('careerLevels', $careerLevels)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('jobTypes', $jobTypes)
                        ->with('jobShifts', $jobShifts)
                        ->with('genders', $genders)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('jobSkills', $jobSkills)
                        ->with('jobSkillIds', $jobSkillIds)
                        ->with('degreeLevels', $degreeLevels)
                        ->with('salaryPeriods', $salaryPeriods)
                        ->with('job', $job);
    }

    public function updateJob($id, JobFormRequest $request)
    {
        $job = Job::findOrFail($id);
        $job->company_id = $request->input('company_id');
        $job = $this->assignJobValues_Rechange($job, $request);
        $job->is_active = $request->input('is_active');
        $job->is_featured = $request->input('is_featured');

        $job->r_city_line_id        = $request->input('r_city_line_id');
        $job->r_visa_qualification_id = $request->input('r_visa_qualification_id');
        $job->r_colour_id           = $request->input('r_colour_id');
        $job->r_current_location_id = $request->input('r_current_location_id');
        $job->r_emerency_level_id   = $request->input('r_emerency_level_id');

        /*         * ******************************* */
        $jobtitle = PositionLookingModel::find($request->r_position_looking_id);
        $job->slug = str_slug($jobtitle->name, '-') . '-' . $job->id;
        /*         * ******************************* */
        /*         * ************************************ */
        $job->update();
        /*         * ************************************ */

        JobWelfareModel::where('job_id','=',$job->id)->delete();
        foreach ($request->welfare as $welfare_id) {
            $savewelfate             = new JobWelfareModel;
            $savewelfate->job_id    = $job->id;
            $savewelfate->welfare_id = $welfare_id;
            $savewelfate->save();
        }

        if(!empty($request->file('school_environment')))
        {
            $i = 0;
            $destinationPath = public_path('/company/'); // upload path
            foreach($request->file('school_environment') as $img) {
                $profileImage = $i.date('YmdHis').'.jpg';
                $img->move($destinationPath, $profileImage);

                $imagemodel= new JobSchoolEnvironmentModel();
                $imagemodel->job_id = $job->id;
                $imagemodel->image_name = $profileImage;
                $imagemodel->save();
                $i++;
            }
        }

        if(!empty($request->file('teachers_accommodation')))
        {
            $i = 100;
            $destinationPaths = public_path('/company/'); // upload path
            foreach($request->file('teachers_accommodation') as $imgs) {
                $profileImages = $i.date('YmdHis').'.jpg';
                $imgs->move($destinationPaths, $profileImages);
                
                $imagemodelda = new JobTeachersAccommodationModel();
                $imagemodelda->job_id = $job->id;
                $imagemodelda->image_name = $profileImages;
                $imagemodelda->save();
                $i++;
            }
        }







        // $this->storeJobSkills($request, $job->id);
        /*         * ************************************ */
        // $this->updateFullTextSearch($job);
        /*         * ************************************ */
        flash('Job has been updated!')->success();
        return \Redirect::route('edit.job', array($job->id));
    }

    /*     * *************************************** */
    /*     * *************************************** */

    public function createFrontJob()
    {
        $company = Auth::guard('company')->user();
		
		if ((bool)$company->is_active === false) {
            flash(__('Your account is inactive contact site admin to activate it'))->error();
            return \Redirect::route('company.home');
            exit;
        }
		// if((bool)config('company.is_company_package_active')){
		// 	if(
		// 		($company->package_end_date === null) || 
		// 		($company->package_end_date->lt(Carbon::now())) ||
		// 		($company->jobs_quota <= $company->availed_jobs_quota)
		// 		)
		// 	{
		// 		flash(__('Please subscribe to package first'))->error();
		// 		return \Redirect::route('company.home');
		// 		exit;
		// 	}
		// }
        
		$countries = DataArrayHelper::langCountriesArray();
        $currencies = DataArrayHelper::currenciesArray();
        $careerLevels = DataArrayHelper::langCareerLevelsArray();
        $functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $jobTypes = DataArrayHelper::langJobTypesArray();
        $jobShifts = DataArrayHelper::langJobShiftsArray();
        $genders = DataArrayHelper::langGendersArray();
        $jobExperiences = DataArrayHelper::langJobExperiencesArray();
        $jobSkills = DataArrayHelper::langJobSkillsArray();
        $degreeLevels = DataArrayHelper::langDegreeLevelsArray();
        $salaryPeriods = DataArrayHelper::langSalaryPeriodsArray();


        $getPositionLooking = PositionLookingModel::all();
        $getSchoolJoin      = SchoolJoinModel::all();
        $getWorkType        = WorkTypeModel::all();
        $getVisa            = VisaModel::all();
        $getTeach           = TeachModel::all();
        $getPosition        = PositionModel::all();
        $getSalaryExpect    = SalaryExpectModel::all();
        $getWelfare         = WelfareModel::all();
        $getWorkingSchedule = WorkingScheduleModel::all();
        
        

        $jobSkillIds = array();
        return view('job.add_edit_job')
                        ->with('getPositionLooking', $getPositionLooking)
                        ->with('getSchoolJoin', $getSchoolJoin)
                        ->with('getWorkType', $getWorkType)
                        ->with('getVisa', $getVisa)
                        ->with('getTeach', $getTeach)
                        ->with('getPosition', $getPosition)
                        ->with('getSalaryExpect', $getSalaryExpect)
                        ->with('getWelfare', $getWelfare)
                        ->with('getWorkingSchedule', $getWorkingSchedule)
                        
                        
                        
                        ->with('countries', $countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('careerLevels', $careerLevels)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('jobTypes', $jobTypes)
                        ->with('jobShifts', $jobShifts)
                        ->with('genders', $genders)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('jobSkills', $jobSkills)
                        ->with('jobSkillIds', $jobSkillIds)
                        ->with('degreeLevels', $degreeLevels)
                        ->with('salaryPeriods', $salaryPeriods);
    }

    public function storeFrontJob(JobFrontFormRequest $request)
    {
        // dd($request->all());

        $company = Auth::guard('company')->user();

        $job = new Job();
        $job->company_id = $company->id;
        $job = $this->assignJobValues_Rechange($job, $request);
        $job->save();
        /*         * ******************************* */

        $jobtitle = PositionLookingModel::find($request->r_position_looking_id);

        $job->slug = str_slug($jobtitle->name, '-') . '-' . $job->id;

        /*         * ******************************* */
        $job->update();


        JobWelfareModel::where('job_id','=',$job->id)->delete();
        foreach ($request->welfare as $welfare_id) {
            $savewelfate             = new JobWelfareModel;
            $savewelfate->job_id    = $job->id;
            $savewelfate->welfare_id = $welfare_id;
            $savewelfate->save();
        }

        if(!empty($request->file('school_environment')))
        {
            $i = 0;
            $destinationPath = public_path('/company/'); // upload path
            foreach($request->file('school_environment') as $img) {
                $profileImage = $i.date('YmdHis').'.jpg';
                $img->move($destinationPath, $profileImage);

                $imagemodel= new JobSchoolEnvironmentModel();
                $imagemodel->job_id = $job->id;
                $imagemodel->image_name = $profileImage;
                $imagemodel->save();
                $i++;
            }
        }

        if(!empty($request->file('teachers_accommodation')))
        {
            $i = 100;
            $destinationPaths = public_path('/company/'); // upload path
            foreach($request->file('teachers_accommodation') as $imgs) {
                $profileImages = $i.date('YmdHis').'.jpg';
                $imgs->move($destinationPaths, $profileImages);
                
                $imagemodelda = new JobTeachersAccommodationModel();
                $imagemodelda->job_id = $job->id;
                $imagemodelda->image_name = $profileImages;
                $imagemodelda->save();
                $i++;
            }
        }
        

        /*         * ************************************ */
        /*         * ************************************ */
        // $this->storeJobSkills($request, $job->id);
        /*         * ************************************ */
        // $this->updateFullTextSearch($job);
        /*         * ************************************ */

        /*         * ******************************* */
        $company->availed_jobs_quota = $company->availed_jobs_quota + 1;
        $company->update();
        /*         * ******************************* */

        // event(new JobPosted($job));
        flash('Job has been added!')->success();
        return \Redirect::route('edit.front.job', array($job->id));
    }

    public function editFrontJob($id)
    {
        $countries = DataArrayHelper::langCountriesArray();
        $currencies = DataArrayHelper::currenciesArray();
        $careerLevels = DataArrayHelper::langCareerLevelsArray();
        $functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $jobTypes = DataArrayHelper::langJobTypesArray();
        $jobShifts = DataArrayHelper::langJobShiftsArray();
        $genders = DataArrayHelper::langGendersArray();
        $jobExperiences = DataArrayHelper::langJobExperiencesArray();
        $jobSkills = DataArrayHelper::langJobSkillsArray();
        $degreeLevels = DataArrayHelper::langDegreeLevelsArray();
        $salaryPeriods = DataArrayHelper::langSalaryPeriodsArray();

        $getPositionLooking = PositionLookingModel::all();
        $getSchoolJoin      = SchoolJoinModel::all();
        $getWorkType        = WorkTypeModel::all();
        $getVisa            = VisaModel::all();
        $getTeach           = TeachModel::all();
        $getPosition        = PositionModel::all();
        $getSalaryExpect    = SalaryExpectModel::all();
        $getWelfare         = WelfareModel::all();
        $getWorkingSchedule = WorkingScheduleModel::all();

        $job = Job::findOrFail($id);
        $jobSkillIds = $job->getJobSkillsArray();
        return view('job.add_edit_job')
                        ->with('getPositionLooking', $getPositionLooking)
                        ->with('getSchoolJoin', $getSchoolJoin)
                        ->with('getWorkType', $getWorkType)
                        ->with('getVisa', $getVisa)
                        ->with('getTeach', $getTeach)
                        ->with('getPosition', $getPosition)
                        ->with('getSalaryExpect', $getSalaryExpect)
                        ->with('getWelfare', $getWelfare)
                        ->with('getWorkingSchedule', $getWorkingSchedule)


                        ->with('countries', $countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('careerLevels', $careerLevels)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('jobTypes', $jobTypes)
                        ->with('jobShifts', $jobShifts)
                        ->with('genders', $genders)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('jobSkills', $jobSkills)
                        ->with('jobSkillIds', $jobSkillIds)
                        ->with('degreeLevels', $degreeLevels)
                        ->with('salaryPeriods', $salaryPeriods)
                        ->with('job', $job);
    }

    public function updateFrontJob($id, JobFrontFormRequest $request)
    {
        $job = Job::findOrFail($id);
		$job = $this->assignJobValues_Rechange($job, $request);
        /*         * ******************************* */

        $jobtitle = PositionLookingModel::find($request->r_position_looking_id);

        $job->slug = str_slug($jobtitle->name, '-') . '-' . $job->id;
        /*         * ******************************* */

        /*         * ************************************ */
        $job->update();

        

        JobWelfareModel::where('job_id','=',$job->id)->delete();
        foreach ($request->welfare as $welfare_id) {
            $savewelfate             = new JobWelfareModel;
            $savewelfate->job_id    = $job->id;
            $savewelfate->welfare_id = $welfare_id;
            $savewelfate->save();
        }




        // Handle multiple file upload

        if(!empty($request->file('school_environment')))
        {
            $i = 0;
            $destinationPath = public_path('/company/'); // upload path
            foreach($request->file('school_environment') as $img) {
                $profileImage = $i.date('YmdHis').'.jpg';
                $img->move($destinationPath, $profileImage);

                $imagemodel= new JobSchoolEnvironmentModel();
                $imagemodel->job_id = $job->id;
                $imagemodel->image_name = $profileImage;
                $imagemodel->save();
                $i++;
            }
        }

        if(!empty($request->file('teachers_accommodation')))
        {
            $i = 100;
            $destinationPaths = public_path('/company/'); // upload path
            foreach($request->file('teachers_accommodation') as $imgs) {
                $profileImages = $i.date('YmdHis').'.jpg';
                $imgs->move($destinationPaths, $profileImages);
                
                $imagemodelda = new JobTeachersAccommodationModel();
                $imagemodelda->job_id = $job->id;
                $imagemodelda->image_name = $profileImages;
                $imagemodelda->save();
                $i++;
            }
        }


        /*         * ************************************ */
        // $this->storeJobSkills($request, $job->id);
        /*         * ************************************ */
        // $this->updateFullTextSearch($job);
        /*         * ************************************ */
        flash('Job has been updated!')->success();
        return \Redirect::route('edit.front.job', array($job->id));
    }

    public function DeleteFrontJobTeachersAccommodation($job_id, $id)
    {
        $get = JobTeachersAccommodationModel::find($id);

        unlink('public/company/'.$get->image_name);

        $get->delete();
        flash('Image deleted successfully!')->success();
        return redirect()->back();
    }

    public function DeleteFrontJobSchoolEnvironment($job_id, $id)
    {
        $get = JobSchoolEnvironmentModel::find($id);

        unlink('public/company/'.$get->image_name);

        $get->delete();
        flash('Image deleted successfully!')->success();
        return redirect()->back();
    }

    


    public static function countNumJobs($field = 'title', $value = '')
    {
        if (!empty($value)) {
            if ($field == 'title') {
                return DB::table('jobs')->where('title', 'like', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'company_id') {
                return DB::table('jobs')->where('company_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'industry_id') {
                $company_ids = Company::where('industry_id', '=', $value)->where('is_active', '=', 1)->pluck('id')->toArray();
                return DB::table('jobs')->whereIn('company_id', $company_ids)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'job_skill_id') {
                $job_ids = JobSkillManager::where('job_skill_id', '=', $value)->pluck('job_id')->toArray();
                return DB::table('jobs')->whereIn('id', array_unique($job_ids))->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'functional_area_id') {
                return DB::table('jobs')->where('functional_area_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'careel_level_id') {
                return DB::table('jobs')->where('careel_level_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'job_type_id') {
                return DB::table('jobs')->where('job_type_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'job_shift_id') {
                return DB::table('jobs')->where('job_shift_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'gender_id') {
                return DB::table('jobs')->where('gender_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'degree_level_id') {
                return DB::table('jobs')->where('degree_level_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'job_experience_id') {
                return DB::table('jobs')->where('job_experience_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'country_id') {
                return DB::table('jobs')->where('country_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'state_id') {
                return DB::table('jobs')->where('state_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
            if ($field == 'city_id') {
                return DB::table('jobs')->where('city_id', '=', $value)->where('is_active', '=', 1)->count('id');
            }
        }
    }

    public function scopeNotExpire($query)
    {
        return $query->whereDate('expiry_date', '>', Carbon::now()); //where('expiry_date', '>=', date('Y-m-d'));
    }
    
    public function isJobExpired()
    {
        return ($this->expiry_date < Carbon::now())? true:false;
    }

}
