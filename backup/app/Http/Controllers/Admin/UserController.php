<?php

namespace App\Http\Controllers\Admin;

use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Carbon\Carbon;
use Redirect;
use App\User;
use App\Gender;
use App\MaritalStatus;
use App\Country;
use App\State;
use App\City;
use App\JobExperience;
use App\CareerLevel;
use App\Industry;
use App\FunctionalArea;
use App\ProfileSummary;
use App\ProfileProject;
use App\ProfileExperience;
use App\ProfileEducation;
use App\ProfileSkill;
use App\ProfileLanguage;
use App\Package;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\ProfileProjectFormRequest;
use App\Http\Requests\ProfileProjectImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\CommonUserFunctions;
use App\Traits\ProfileSummaryTrait;
use App\Traits\ProfileCvsTrait;
use App\Traits\ProfileProjectsTrait;
use App\Traits\ProfileExperienceTrait;
use App\Traits\ProfileEducationTrait;
use App\Traits\ProfileSkillTrait;
use App\Traits\ProfileLanguageTrait;
use App\Traits\Skills;
use App\Traits\JobSeekerPackageTrait;
use App\Helpers\DataArrayHelper;
use App\Admin;

use App\SchoolJoinModel;
use App\PositionLookingModel;
use App\TeachModel;
use App\WorkTypeModel;
use App\PositionModel;
use App\CurrentLocatioinModel;
use App\WelfareModel;
use App\SalaryExpectModel;
use App\UserSchoolJoinModel;
use App\UserWelfareModel;
use App\CountryPhoneCode;
use App\HighestEducationModel;
use App\ColourModel;
use App\TypeChineseVisaModel;


use App\UsersNoteModel;


class UserController extends Controller
{

    use CommonUserFunctions;
    use ProfileSummaryTrait;
    use ProfileCvsTrait;
    use ProfileProjectsTrait;
    use ProfileExperienceTrait;
    use ProfileEducationTrait;
    use ProfileSkillTrait;
    use ProfileLanguageTrait;
    use Skills;
    use JobSeekerPackageTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUsers()
    {


        

        $getHighestEducation = HighestEducationModel::all();
        $getSchoolJoin = SchoolJoinModel::all();
        $getTeach = TeachModel::all();
        $getPositionLooking = PositionLookingModel::all();
        $getWorkType = WorkTypeModel::all();
        $getPosition = PositionModel::all();
        $getCurrentLocatioin = CurrentLocatioinModel::all();
        $getWelfare = WelfareModel::all();
        $getSalaryExpect = SalaryExpectModel::all();
        $getCountryCode = CountryPhoneCode::all();
        $getColour = ColourModel::all();

        $nationalities = Country::select('countries.nationality', 'countries.country_id', 'countries.is_native')->lang()->active()->sorted()->get();


        return view('admin.user.index')    
                    ->with('nationalities', $nationalities)
                    ->with('getWelfare', $getWelfare)
                    ->with('getSalaryExpect', $getSalaryExpect)
                    ->with('getCurrentLocatioin', $getCurrentLocatioin)
                    ->with('getPosition', $getPosition)
                    ->with('getWorkType', $getWorkType)
                    ->with('getCountryCode', $getCountryCode)
                    ->with('getTeach', $getTeach)
                    ->with('getPositionLooking', $getPositionLooking)
                    ->with('getHighestEducation', $getHighestEducation)
                    ->with('getColour', $getColour)
                    
                    ->with('getSchoolJoin', $getSchoolJoin);
    }

    public function createUser()
    {

        $getHighestEducation = HighestEducationModel::all();
        $getSchoolJoin = SchoolJoinModel::all();
        $getTeach = TeachModel::all();
        $getPositionLooking = PositionLookingModel::all();
        $getWorkType = WorkTypeModel::all();
        $getPosition = PositionModel::all();
        $getCurrentLocatioin = CurrentLocatioinModel::all();
        $getWelfare = WelfareModel::all();
        $getSalaryExpect = SalaryExpectModel::all();
        $getCountryCode = CountryPhoneCode::all();
        $getColour = ColourModel::all();
        $getTypeChineseVisa = TypeChineseVisaModel::all();
        
        

        $nationalities = Country::select('countries.nationality', 'countries.country_id', 'countries.is_native')->lang()->active()->sorted()->get();



        $genders = DataArrayHelper::defaultGendersArray();
        $maritalStatuses = DataArrayHelper::defaultMaritalStatusesArray();
        // $nationalities = DataArrayHelper::defaultNationalitiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();
        $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->pluck('package_detail', 'id')->toArray();
        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);

        return view('admin.user.add')

                        ->with('getWelfare', $getWelfare)
                        ->with('getSalaryExpect', $getSalaryExpect)
                        ->with('getCurrentLocatioin', $getCurrentLocatioin)
                        ->with('getPosition', $getPosition)
                        ->with('getWorkType', $getWorkType)
                        ->with('getCountryCode', $getCountryCode)
                        ->with('getTeach', $getTeach)
                        ->with('getPositionLooking', $getPositionLooking)
                        ->with('getHighestEducation', $getHighestEducation)
                        ->with('getSchoolJoin', $getSchoolJoin)
                        ->with('getColour', $getColour)
                        ->with('getTypeChineseVisa', $getTypeChineseVisa)
                        


                        ->with('genders', $genders)
                        ->with('maritalStatuses', $maritalStatuses)
                        ->with('nationalities', $nationalities)
                        ->with('countries', $countries)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('careerLevels', $careerLevels)
                        ->with('industries', $industries)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('upload_max_filesize', $upload_max_filesize)
                        ->with('packages', $packages);
    }

    public function storeUser(UserFormRequest $request)
    {
        $rule_id = User::getRuleID();

        $user = new User();
        /*         * **************************************** */
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
            $user->image = $fileName;
        }
        /*         * ************************************** */
        $user->first_name = $request->input('first_name');
        $user->staff_id = Auth::user()->id;
        // $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        // $user->father_name = $request->input('father_name');
        // $user->date_of_birth = $request->input('date_of_birth');
        // $user->gender_id = $request->input('gender_id');
        // $user->marital_status_id = $request->input('marital_status_id');
        $user->nationality_id = $request->input('nationality_id');
        // $user->national_id_card_number = $request->input('national_id_card_number');
        $user->country_id = $request->input('country_id');
        $user->state_id = $request->input('state_id');
        $user->city_id = $request->input('city_id');
        $user->rule_id = $rule_id;
        
        // $user->phone = $request->input('phone');
        // $user->mobile_num = $request->input('mobile_num');
        // $user->job_experience_id = $request->input('job_experience_id');
        // $user->career_level_id = $request->input('career_level_id');
        // $user->industry_id = $request->input('industry_id');
        // $user->functional_area_id = $request->input('functional_area_id');
        // $user->current_salary = $request->input('current_salary');
        // $user->expected_salary = $request->input('expected_salary');
        // $user->salary_currency = $request->input('salary_currency');
        // $user->street_address = $request->input('street_address');
        // $user->is_immediate_available = $request->input('is_immediate_available');




        $user->r_current_locatioin_id   = $request->input('r_current_locatioin_id');
        $user->r_english_speaker_id     = $request->input('r_english_speaker_id');
        $user->r_highest_education_id   = $request->input('r_highest_education_id');
        $user->r_graduated_id           = $request->input('r_graduated_id');
        $user->r_teach_id               = $request->input('r_teach_id');
        $user->r_position_looking_id    = $request->input('r_position_looking_id');
        $user->r_work_type_id           = $request->input('r_work_type_id');
        $user->r_position_id            = $request->input('r_position_id');
        $user->r_salary_id              = $request->input('r_salary_id');
        $user->r_max_salary_id              = $request->input('r_max_salary_id');
        
        $user->r_visa_id                = $request->input('r_visa_id');

        $user->r_age_id                = $request->input('r_age_id');
        $user->r_subject_education        = !empty($request->input('r_subject_education')) ? $request->input('r_subject_education') : '';
        $user->r_working_experience       = $request->input('r_working_experience');
        $user->r_native_english_speaking  = !empty($request->input('r_native_english_speaking')) ? $request->input('r_native_english_speaking') : '';
        $user->r_other_requirements       = $request->input('r_other_requirements');

        $user->online_interview             = $request->input('online_interview');
        $user->chinese_visa_are_you_holding = !empty($request->input('chinese_visa_are_you_holding')) ? $request->input('chinese_visa_are_you_holding') : '';
        $user->r_colour_id                = $request->input('r_colour_id');


        $user->is_active = $request->input('is_active');
        $user->verified = $request->input('verified');
        $user->save();

        // UserWelfareModel::where('user_id','=',$user->id)->delete();
        UserSchoolJoinModel::where('user_id','=',$user->id)->delete();

        // if(!empty($request->welfare))
        // {
        //     foreach ($request->welfare as $welfare_id) {
        //         $savewelfate             = new UserWelfareModel;
        //         $savewelfate->user_id    = $user->id;
        //         $savewelfate->welfare_id = $welfare_id;
        //         $savewelfate->save();
        //     }    
        // }
        
        if(!empty($request->school_join))
        {
            foreach ($request->school_join as $school_join_id) {
                $saveschool             = new UserSchoolJoinModel;
                $saveschool->user_id    = $user->id;
                $saveschool->school_join_id = $school_join_id;
                $saveschool->save();
            }    
        }
        



        if ($request->hasFile('self_intro')) {

            $extension      = $request->file('self_intro')->getClientOriginalExtension();
            $randomStr      = str_random(30);
            $filenamevideo  = $randomStr.'.'.$extension;
            $file           = $request->file('self_intro');
            $file->move('public/video/', $filenamevideo);
            $user->self_intro = $filenamevideo;
        }




        /*         * *********************** */
        $user->name = $user->getName();
        $user->update();
        $this->updateUserFullTextSearch($user);
        /*         * *********************** */
        /*         * ************************************ */
        if ($request->has('job_seeker_package_id') && $request->input('job_seeker_package_id') > 0) {
            $package_id = $request->input('job_seeker_package_id');
            $package = Package::find($package_id);
            $this->addJobSeekerPackage($user, $package);
        }
        /*         * ************************************ */

        flash('User has been added!')->success();
        return \Redirect::route('edit.user', array($user->id));
    }

    public function editUser($id)
    {
        $getHighestEducation = HighestEducationModel::all();
        $getSchoolJoin = SchoolJoinModel::all();
        $getTeach = TeachModel::all();
        $getPositionLooking = PositionLookingModel::all();
        $getWorkType = WorkTypeModel::all();
        $getPosition = PositionModel::all();
        $getCurrentLocatioin = CurrentLocatioinModel::all();
        $getWelfare = WelfareModel::all();
        $getSalaryExpect = SalaryExpectModel::all();
        $getCountryCode = CountryPhoneCode::all();
        $getColour = ColourModel::all();
        $getTypeChineseVisa = TypeChineseVisaModel::all();

        $nationalities = Country::select('countries.nationality', 'countries.country_id', 'countries.is_native')->lang()->active()->sorted()->get();


        $genders = DataArrayHelper::defaultGendersArray();
        $maritalStatuses = DataArrayHelper::defaultMaritalStatusesArray();
        // $nationalities = DataArrayHelper::defaultNationalitiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();

        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);
        $user = User::findOrFail($id);
        if ($user->package_id > 0) {
            $package = Package::find($user->package_id);
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->where('id', '<>', $user->package_id)->where('package_price', '>=', $package->package_price)->pluck('package_detail', 'id')->toArray();
        } else {
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->pluck('package_detail', 'id')->toArray();
        }

        return view('admin.user.edit')
                        ->with('getWelfare', $getWelfare)
                        ->with('getSalaryExpect', $getSalaryExpect)
                        ->with('getCurrentLocatioin', $getCurrentLocatioin)
                        ->with('getPosition', $getPosition)
                        ->with('getWorkType', $getWorkType)
                        ->with('getCountryCode', $getCountryCode)
                        ->with('getTeach', $getTeach)
                        ->with('getPositionLooking', $getPositionLooking)
                        ->with('getHighestEducation', $getHighestEducation)
                        ->with('getSchoolJoin', $getSchoolJoin)
                        ->with('getColour', $getColour)
                        ->with('getTypeChineseVisa', $getTypeChineseVisa)
                        
                        

                        ->with('genders', $genders)
                        ->with('maritalStatuses', $maritalStatuses)
                        ->with('nationalities', $nationalities)
                        ->with('countries', $countries)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('careerLevels', $careerLevels)
                        ->with('industries', $industries)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('user', $user)
                        ->with('upload_max_filesize', $upload_max_filesize)
                        ->with('packages', $packages);
    }

    public function updateUser($id, UserFormRequest $request)
    {
        $user = User::findOrFail($id);
        /*         * **************************************** */
        if ($request->hasFile('image')) {
            $is_deleted = $this->deleteUserImage($user->id);
            $image = $request->file('image');
            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
            $user->image = $fileName;
        }
        /*         * ************************************** */
        $user->first_name = $request->input('first_name');
        // $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        /*         * *********************** */
        $user->name = $user->getName();
        /*         * *********************** */
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        // $user->father_name = $request->input('father_name');
        // $user->date_of_birth = $request->input('date_of_birth');
        // $user->gender_id = $request->input('gender_id');
        // $user->marital_status_id = $request->input('marital_status_id');
        $user->nationality_id = $request->input('nationality_id');
        // $user->national_id_card_number = $request->input('national_id_card_number');
        $user->country_id = $request->input('country_id');
        $user->state_id = $request->input('state_id');
        $user->city_id = $request->input('city_id');
        // $user->phone = $request->input('phone');
        // $user->mobile_num = $request->input('mobile_num');
        // $user->job_experience_id = $request->input('job_experience_id');
        // $user->career_level_id = $request->input('career_level_id');
        // $user->industry_id = $request->input('industry_id');
        // $user->functional_area_id = $request->input('functional_area_id');
        // $user->current_salary = $request->input('current_salary');
        // $user->expected_salary = $request->input('expected_salary');
        // $user->salary_currency = $request->input('salary_currency');
        // $user->street_address = $request->input('street_address');
        // $user->is_immediate_available = $request->input('is_immediate_available');

        $user->r_current_locatioin_id   = $request->input('r_current_locatioin_id');
        $user->r_english_speaker_id     = $request->input('r_english_speaker_id');
        $user->r_highest_education_id   = $request->input('r_highest_education_id');
        $user->r_graduated_id           = $request->input('r_graduated_id');
        $user->r_teach_id               = $request->input('r_teach_id');
        $user->r_position_looking_id    = $request->input('r_position_looking_id');
        $user->r_work_type_id           = $request->input('r_work_type_id');
        $user->r_position_id            = $request->input('r_position_id');
        $user->r_salary_id              = $request->input('r_salary_id');
        $user->r_max_salary_id          = $request->input('r_max_salary_id');
        $user->r_visa_id                = $request->input('r_visa_id');
        $user->r_colour_id              = $request->input('r_colour_id');
        


        $user->r_age_id                   = $request->input('r_age_id');
        $user->r_subject_education        = !empty($request->input('r_subject_education')) ? $request->input('r_subject_education') : '';
        $user->r_working_experience       = $request->input('r_working_experience');
        $user->r_native_english_speaking  = !empty($request->input('r_native_english_speaking')) ? $request->input('r_native_english_speaking') : '';
        $user->r_other_requirements       = $request->input('r_other_requirements');


        $user->online_interview             = $request->input('online_interview');
        $user->chinese_visa_are_you_holding = !empty($request->input('chinese_visa_are_you_holding')) ? $request->input('chinese_visa_are_you_holding') : '';
        

        $user->is_active = $request->input('is_active');
        $user->verified = $request->input('verified');

        if ($request->hasFile('self_intro')) {

            if (!empty($user->self_intro)) {
                if (file_exists('public/video/' . $user->self_intro)) {
                    unlink('public/video/' . $user->self_intro);
                }
            }

            $extension      = $request->file('self_intro')->getClientOriginalExtension();
            $randomStr      = str_random(30);
            $filenamevideo  = $randomStr.'.'.$extension;
            $file           = $request->file('self_intro');
            $file->move('public/video/', $filenamevideo);
            $user->self_intro = $filenamevideo;
        }



        $user->update();


        // UserWelfareModel::where('user_id','=',$user->id)->delete();
        UserSchoolJoinModel::where('user_id','=',$user->id)->delete();

        // if(!empty($request->welfare))
        // {
        //     foreach ($request->welfare as $welfare_id) {
        //         $savewelfate             = new UserWelfareModel;
        //         $savewelfate->user_id    = $user->id;
        //         $savewelfate->welfare_id = $welfare_id;
        //         $savewelfate->save();
        //     }    
        // }
        
        if(!empty($request->school_join))
        {
            foreach ($request->school_join as $school_join_id) {
                $saveschool             = new UserSchoolJoinModel;
                $saveschool->user_id    = $user->id;
                $saveschool->school_join_id = $school_join_id;
                $saveschool->save();
            }    
        }
        



        $this->updateUserFullTextSearch($user);
        /*         * ************************************ */
        if ($request->has('job_seeker_package_id') && $request->input('job_seeker_package_id') > 0) {
            $package_id = $request->input('job_seeker_package_id');
            $package = Package::find($package_id);
            if ($user->package_id > 0) {
                $this->updateJobSeekerPackage($user, $package);
            } else {
                $this->addJobSeekerPackage($user, $package);
            }
        }
        /*         * ************************************ */

        flash('User has been updated!')->success();
        return \Redirect::route('edit.user', array($user->id));
    }

    public function AssignUserStaff(Request $request)
    {
        $user_id    = $request->user_id;
        $staff_id   = $request->staff_id;
        $company    = User::find($request->user_id);
        $company->staff_id = $staff_id;
        $company->save();

        $json['success'] = true;
        echo json_encode($json);
    }


    public function fetchUsersData(Request $request)
    {
        $columnIndex = $request->order[0]['column']; // Column index
        $columnName = $request->columns[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->order[0]['dir']; // asc or desc

        // dd($columnName);

        
        $users = User::select(
                        [
                            'users.id',
                            'users.first_name',
                            'users.middle_name',
                            'users.last_name',
                            'users.email',
                            'users.password',
                            'users.phone',
                            'users.country_id',
                            'users.state_id',
                            'users.city_id',
                            'users.is_immediate_available',
                            'users.num_profile_views',
                            'users.is_active',
                            'users.verified',
                            'users.created_at',
                            'users.updated_at',

                            'users.r_current_locatioin_id',
                            'users.nationality_id',
                            'users.r_english_speaker_id',
                            'users.r_highest_education_id',
                            'users.r_graduated_id',
                            'users.r_teach_id',
                            'users.r_position_looking_id',
                            'users.r_work_type_id',
                            'users.r_position_id',
                            'users.r_salary_id',
                            'users.r_max_salary_id',
                            'users.r_visa_id',
                            'users.r_age_id',
                            'users.r_subject_education',
                            'users.r_working_experience',
                            'users.r_native_english_speaking',
                            'users.r_colour_id',
                            'users.rule_id',
                            'users.staff_id'

                            
        ]);

        if(!empty($request->r_school_join_id))
        {
            $users = $users->join('user_school_join','user_school_join.user_id','=','users.id');   
            $users = $users->where('user_school_join.school_join_id','=', $request->r_school_join_id);   
        }

        if(!empty($request->search_note))
        {
            $users = $users->join('users_note','users_note.user_id','=','users.id');   
            $users = $users->where('users_note.message', 'like', '%' . $request->search_note . '%');
        }

        if(Auth::user()->role_id == 2) {
            $users = $users->where('staff_id','=', Auth::user()->id);
        }

        if(!empty($request->r_current_locatioin_id))
        {
            $users = $users->where('users.r_current_locatioin_id','=', $request->r_current_locatioin_id);   
        }
        if(!empty($request->nationality_id))
        {
            $users = $users->where('users.nationality_id','=', $request->nationality_id);   
        }
        if(!empty($request->r_english_speaker_id))
        {
            $users = $users->where('users.r_english_speaker_id','=', $request->r_english_speaker_id);   
        }
        if(!empty($request->r_highest_education_id))
        {
            $users = $users->where('users.r_highest_education_id','=', $request->r_highest_education_id);   
        }
        if(!empty($request->r_position_looking_id))
        {
            $users = $users->where('users.r_position_looking_id','=', $request->r_position_looking_id);   
        }
        if(!empty($request->r_graduated_id))
        {
            $users = $users->where('users.r_graduated_id','=', $request->r_graduated_id);   
        }
        if(!empty($request->r_subject_education))
        {
            $users = $users->where('users.r_subject_education','=', $request->r_subject_education);   
        }
        if(!empty($request->r_teach_id))
        {
            $users = $users->where('users.r_teach_id','=', $request->r_teach_id);   
        }
        if(!empty($request->r_work_type_id))
        {
            $users = $users->where('users.r_work_type_id','=', $request->r_work_type_id);   
        }
        if(!empty($request->r_position_id))
        {
            $users = $users->where('users.r_position_id','=', $request->r_position_id);   
        }
        if(!empty($request->r_working_experience))
        {
            $users = $users->where('users.r_working_experience','=', $request->r_working_experience);   
        }
        if(!empty($request->r_native_english_speaking))
        {
            $users = $users->where('users.r_native_english_speaking','=', $request->r_native_english_speaking);   
        }
        if(!empty($request->r_salary_id))
        {
            $users = $users->where('users.r_salary_id','>=', intval($request->r_salary_id));   
        }
        if(!empty($request->r_max_salary_id))
        {
            $users = $users->where('users.r_max_salary_id','<=', intval($request->r_max_salary_id));   
        }
        
        if(!empty($request->r_colour_id))
        {
            $users = $users->where('users.r_colour_id','=', $request->r_colour_id);   
        }

        if(!empty($request->start_date)) {
            $users = $users->where(\DB::raw("(STR_TO_DATE(users.created_at,'%Y-%m-%d'))"), ">=", $request->start_date);
        }

        if(!empty($request->end_date)) {
            $users = $users->where(\DB::raw("(STR_TO_DATE(users.created_at,'%Y-%m-%d'))"), "<=", $request->end_date);
        }

        if(!empty($request->is_active))
        {   
            $is_active = $request->is_active;
            if($request->is_active == 100)   
            {
                $is_active = 0;
            }
            $users = $users->where('users.is_active','=', $is_active);   
        }
        if(!empty($request->verified))
        {   
            $verified = $request->verified;
            if($request->verified == 100)   
            {
                $verified = 0;
            }
            $users = $users->where('users.verified','=', $verified);   
        }

        $users = $users->orderBy('users.'.$columnName.'',$columnSortOrder);   


        $result = Datatables::of($users)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('id') && !empty($request->id)) {
                                $query->where('users.rule_id', 'like', "{$request->get('id')}");
                            }
                            if ($request->has('name') && !empty($request->name)) {
                                $query->where(function($q) use ($request) {
                                    $q->where('users.first_name', 'like', "%{$request->get('name')}%")
                                    ->orWhere('users.middle_name', 'like', "%{$request->get('name')}%")
                                    ->orWhere('users.last_name', 'like', "%{$request->get('name')}%");
                                });
                            }
                            // if ($request->has('email') && !empty($request->email)) {
                            //     $query->where('users.email', 'like', "%{$request->get('email')}%");
                            // }
                        })
                        ->addColumn('rule_id', function ($users) {
                            return  '<a target="_blank" href="'.url('user-profile/'.$users->id.'').'">'.$users->rule_id.'</a>';

                            
                        })
                        ->addColumn('first_name', function ($users) {
                            return $users->first_name ;
                        })
                        ->addColumn('colour', function ($users) {
                            return !empty($users->getcolour->name) ? $users->getcolour->name : '';
                        })
                        ->addColumn('nationality', function ($users) {
                            return !empty($users->getnationality->nationality) ? $users->getnationality->nationality : '';
                        })
                        ->addColumn('current_location', function ($users) {

                            $location_html = '';
                            if(!empty($users->getState('state')))
                            {
                                $location_html .= $users->getState('state');
                            }
                            if(!empty($users->getCity('city')))
                            {
                                $location_html .= ', '. $users->getCity('city');
                            }

                            if(empty($location_html))
                            {
                                $location_html .= !empty($users->userteach->name) ? $users->userteach->name : '';
                            }


                            $location_html .= '<br /><b>Register Date: '.date('d-m-Y',strtotime($users->created_at));                            
                            $location_html .= '</b>';
                            return $location_html;

                        });

                        if(Auth::user()->role_id == 1)
                        {
                           $result = $result->addColumn('assign_staff', function ($users) {
                                $getAdmin = Admin::where('role_id','=','2')->get();
                                $adminhtml = '';
                                $adminhtml .= '
                                <select class="form-control AssignStaff"  id="'.$users->id.'">
                                    <option value="">Select Staff</option>';
                                    foreach ($getAdmin as $admin) {
                                        $selected = '';
                                        if($users->staff_id == $admin->id)
                                        {
                                            $selected = 'selected';
                                        }
                                        $adminhtml .= '<option '.$selected.' value="'.$admin->id.'">'.$admin->name.'</option>';
                                    }
                                $adminhtml .= '</select>';
                                return $adminhtml;
                            });
                        }


                         $result = $result->addColumn('action', function ($users) {

                            $getnotecount = $users->getnotecount();

                            /*                             * ************************* */
                            $active_txt = 'Make Active';
                            $active_href = 'make_active(' . $users->id . ');';
                            $active_icon = 'square-o';
                            if ((int) $users->is_active == 1) {
                                $active_txt = 'Make InActive';
                                $active_href = 'make_not_active(' . $users->id . ');';
                                $active_icon = 'check-square-o';
                            }
                            /*                             * ************************* */
                            /*                             * ************************* */
                            $verified_txt = 'Not Verified';
                            $verified_href = 'make_verified(' . $users->id . ');';
                            $verified_icon = 'square-o';
                            if ((int) $users->verified == 1) {
                                $verified_txt = 'Verified';
                                $verified_href = 'make_not_verified(' . $users->id . ');';
                                $verified_icon = 'check-square-o';
                            }
                           $color_selected_one = ($users->r_colour_id==1)?'selected':'';
                           $color_selected_two = ($users->r_colour_id==2)?'selected':'';

                           $colorcode =  '';
                           if($getnotecount > 0)
                           {
                                $colorcode =  'style="background: orange;border: orange;"';
                           }

                            /*                             * ************************* */
                            return '
                <div class="btn-group">
                  <button type="button" '.$colorcode.' class="btn btn-danger AddNotes" data-toggle="modal" data-target="#GetNote" id="'.$users->id.'" >Add Note</button>
                  
                    <button style="position: absolute;" class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="' . route('edit.user', ['id' => $users->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                        </li>                       
                        <li>
                            <a href="javascript:void(0);" onclick="delete_user(' . $users->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                        </li>
                        <li>
                        <a href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $users->id . '"><i class="fa fa-' . $active_icon . '" aria-hidden="true"></i>' . $active_txt . '</a>
                        </li>
                        <li>
                        <a href="javascript:void(0);" onClick="' . $verified_href . '" id="onclick_verified_' . $users->id . '"><i class="fa fa-' . $verified_icon . '" aria-hidden="true"></i>' . $verified_txt . '</a>
                        </li>      

                        <li>   
                            <a target="_blank" href="'.url('jobs?teacher='.$users->id).'"><i class="fa fa-eye" aria-hidden="true"></i>General Match Job</a>
                        </li>
                        <li>   
                            <a target="_blank" href="'.url('jobs?teacher='.$users->id).'&visa=true"><i class="fa fa-eye" aria-hidden="true"></i>General Match Job Without Visa</a>
                        </li>
                        <li>   
                            <a target="_blank" href="'.url('jobs?teacher='.$users->id.'&state=true').'"><i class="fa fa-eye" aria-hidden="true"></i>State Match Job</a>
                        </li>
                        <li>   
                            <a target="_blank" href="'.url('jobs?teacher='.$users->id.'&city=true').'"><i class="fa fa-eye" aria-hidden="true"></i>City Match Job</a>
                        </li>                                               
                        <li>   
                            <a target="_blank" href="'.url('jobs?teacher='.$users->id.'&state=true&visa=true').'"><i class="fa fa-eye" aria-hidden="true"></i>State Match Job Without Visa</a>
                        </li>   
                        <li>   
                            <a target="_blank" href="'.url('jobs?teacher='.$users->id.'&city=true&visa=true').'"><i class="fa fa-eye" aria-hidden="true"></i>City Match Job Without Visa</a>
                        </li>                                                                                                                                                   
                    </ul>

                  


                </div>

                    <div style="width:100px;float: right">
                       
                        <select class="form-control rcolourid" name="r_colour_id" id="'.$users->id.'">
                            <option value="">Colour</option>
                            <option value="1" '.$color_selected_one.'  data-id="'.$users->id.'">W</option>
                            <option value="2" '.$color_selected_two.' data-id="'.$users->id.'">N</option>
                        </select>        
                    </div>

                ';
                        });
                        if(Auth::user()->role_id == 1)
                        {
                            $result =  $result->rawColumns(['assign_staff','action', 'name','rule_id','current_location']);
                        }
                        else
                        {
                            $result =  $result->rawColumns(['action', 'name','rule_id','current_location']);
                        }

                         $result =  $result->setRowId(function($users) {
                            return 'user_dt_row_' . $users->id;
                        })
                        ->make(true);

        return $result;

    }

    public function makeActiveUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->is_active = 1;
            $user->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->is_active = 0;
            $user->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeVerifiedUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->verified = 1;
            $user->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotVerifiedUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->verified = 0;
            $user->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }


    public function GetNote(Request $request){
        $user_id    = $request->user_id;
        $getNote = UsersNoteModel::orderBy('id','desc')->where('user_id','=',$user_id)->get();

        $html = '';
        
        // foreach ($getNote as $value) {
        //     $html .= '<p>'.$value->message.'</p>
        //     <hr />'; 
        // } 

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
        $UsersNote = new UsersNoteModel;
        $UsersNote->user_id    = $request->user_id;
        $UsersNote->message   = $request->message;
        $UsersNote->save();
        $json['success'] = true;
        echo json_encode($json);
    }


    public function DeleteNote(Request $request){
            $id    = $request->id;
            $record = UsersNoteModel::find($id);
            $record->delete();
            $json['success'] = true;
            echo json_encode($json);
    }
    public function colorUpdate(Request $request){

        $id = $request->input('user_id');
        $color_id = $request->input('r_colour_id');

            $user = User::findOrFail($id);
            $user->r_colour_id = $color_id;
            $user->update();

        echo json_encode($user);
    }


    

    /*     * ******************************************** */
}
