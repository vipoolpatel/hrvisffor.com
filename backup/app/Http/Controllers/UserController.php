<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Input;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use ImgUploader;
use Carbon\Carbon;
use Redirect;
use Newsletter;
use App\User;
use App\CountryPhoneCode;
use App\Subscription;
use App\ApplicantMessage;
use App\Company;
use App\FavouriteCompany;
use App\Gender;
use App\MaritalStatus;
use App\Country;
use App\State;
use App\City;
use App\JobExperience;
use App\JobApply;
use App\CareerLevel;
use App\HighestEducationModel;
use App\Industry;
use App\Alert;
use App\FunctionalArea;
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
use App\TypeChineseVisaModel;






use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\CommonUserFunctions;
use App\Traits\ProfileSummaryTrait;
use App\Traits\ProfileCvsTrait;
use App\Traits\ProfileProjectsTrait;
use App\Traits\ProfileExperienceTrait;
use App\Traits\ProfileEducationTrait;
use App\Traits\ProfileSkillTrait;
use App\Traits\ProfileLanguageTrait;
use App\Traits\Skills;
use App\Http\Requests\Front\UserFrontFormRequest;
use App\Helpers\DataArrayHelper;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['only' => ['myProfile', 'updateMyProfile', 'viewPublicProfile']]);
        $this->middleware('auth', ['except' => ['showApplicantProfileEducation', 'showApplicantProfileProjects', 'showApplicantProfileExperience', 'showApplicantProfileSkills', 'showApplicantProfileLanguages']]);
    }

    public function viewPublicProfile($id)
    {

        $user = User::findOrFail($id);
        $profileCv = $user->getDefaultCv();

        return view('user.applicant_profile')
                        ->with('user', $user)
                        ->with('profileCv', $profileCv)
                        ->with('page_title', $user->getName())
                        ->with('form_title', 'Contact ' . $user->getName());
    }

    public function myProfile()
    {
        $genders = DataArrayHelper::langGendersArray();
        $maritalStatuses = DataArrayHelper::langMaritalStatusesArray();
        $nationalities = Country::select('countries.nationality', 'countries.country_id', 'countries.is_native')->lang()->active()->sorted()->get();

        $countries = DataArrayHelper::langCountriesArray();
        $jobExperiences = DataArrayHelper::langJobExperiencesArray();
        $careerLevels = DataArrayHelper::langCareerLevelsArray();
        $industries = DataArrayHelper::langIndustriesArray();
        $functionalAreas = DataArrayHelper::langFunctionalAreasArray();

        $getCountryCode = CountryPhoneCode::all();

        $getHighestEducation = HighestEducationModel::all();
        $getSchoolJoin = SchoolJoinModel::all();
        $getTeach = TeachModel::all();
        $getPositionLooking = PositionLookingModel::all();
        $getWorkType = WorkTypeModel::all();
        $getPosition = PositionModel::all();
        $getCurrentLocatioin = CurrentLocatioinModel::all();
        $getWelfare = WelfareModel::all();
        $getSalaryExpect = SalaryExpectModel::all();

        $getTypeChineseVisa = TypeChineseVisaModel::all();
        
        

        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);
        $user = User::findOrFail(Auth::user()->id);
        return view('user.edit_profile')
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
                    ->with('upload_max_filesize', $upload_max_filesize);
    }

    public function updateMyProfile(UserFrontFormRequest $request)
    {

        // dd($request->all());
        

        $user = User::findOrFail(Auth::user()->id);
        /*         * **************************************** */
        if ($request->hasFile('image')) {
            $is_deleted = $this->deleteUserImage($user->id);
            $image = $request->file('image');
            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
            $user->image = $fileName;
        }


        if ($request->hasFile('self_intro')) {

            if (!empty($user->self_intro)) {
                if (file_exists('public/video/' . $user->self_intro)) {
                    unlink('public/video/' . $user->self_intro);
                }
            }

            $extension = $request->file('self_intro')->getClientOriginalExtension();
            $randomStr = str_random(30);
            $filenamevideo = $randomStr.'.'.$extension;
            $file = $request->file('self_intro');
            $file->move('public/video/', $filenamevideo);
            $user->self_intro = $filenamevideo;
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
        
        $user->r_age_id                = $request->input('r_age_id');
        $user->r_subject_education        = $request->input('r_subject_education');
        $user->r_working_experience       = $request->input('r_working_experience');
        $user->r_native_english_speaking  = $request->input('r_native_english_speaking');
        $user->r_other_requirements       = $request->input('r_other_requirements');



        
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

        // $user->country_code_id = $request->input('country_code_id');
        

        // $user->expectation_working_location = $request->input('expectation_working_location');
        // $user->age_range                    = $request->input('age_range');
        $user->chinese_visa_are_you_holding = $request->input('chinese_visa_are_you_holding');

        $user->online_interview             = $request->input('online_interview');
        // $user->anything_else_you_want_to_remark = $request->input('anything_else_you_want_to_remark');

        // if(!empty($request->input('tefl_tesol_certificate')))
        // {
        //     $user->tefl_tesol_certificate = implode(",", $request->input('tefl_tesol_certificate'));                
        // }
        // else
        // {
        //     $user->tefl_tesol_certificate = null;                   
        // }

        // if(!empty($request->input('school_you_prefer')))
        // {
        //     $user->school_you_prefer = implode(",", $request->input('school_you_prefer'));                
        // }
        // else
        // {
        //     $user->school_you_prefer = null;                   
        // }

        // if(!empty($request->input('students_would_you_like_teach')))
        // {
        //     $user->students_would_you_like_teach = implode(",", $request->input('students_would_you_like_teach'));                
        // }
        // else
        // {
        //     $user->students_would_you_like_teach = null;                   
        // }


		$user->is_subscribed = $request->input('is_subscribed', 0);
		
        $user->update();



        // UserWelfareModel::where('user_id','=',$user->id)->delete();

        UserSchoolJoinModel::where('user_id','=',$user->id)->delete();


        // foreach ($request->welfare as $welfare_id) {
        //     $savewelfate             = new UserWelfareModel;
        //     $savewelfate->user_id    = $user->id;
        //     $savewelfate->welfare_id = $welfare_id;
        //     $savewelfate->save();
        // }

        foreach ($request->school_join as $school_join_id) {
            $saveschool             = new UserSchoolJoinModel;
            $saveschool->user_id    = $user->id;
            $saveschool->school_join_id = $school_join_id;
            $saveschool->save();
        }

        $this->updateUserFullTextSearch($user);
		/*************************/
		Subscription::where('email', 'like', $user->email)->delete();
		if((bool)$user->is_subscribed)
		{			
			$subscription = new Subscription();
			$subscription->email = $user->email;
			$subscription->name = $user->name;
			$subscription->save();
			
			/*************************/
			Newsletter::subscribeOrUpdate($subscription->email, ['FNAME'=>$subscription->name]);
			/*************************/
		}
		else
		{
			/*************************/
			Newsletter::unsubscribe($user->email);
			/*************************/
		}
		
        flash(__('You have updated your profile successfully'))->success();
        return \Redirect::route('my.profile');
    }

    public function addToFavouriteCompany(Request $request, $company_slug)
    {
        $data['company_slug'] = $company_slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteCompany::create($data);
        flash(__('Company has been added in favorites list'))->success();
        return \Redirect::route('company.detail', $company_slug);
    }

    public function removeFromFavouriteCompany(Request $request, $company_slug)
    {
        $user_id = Auth::user()->id;
        FavouriteCompany::where('company_slug', 'like', $company_slug)->where('user_id', $user_id)->delete();

        flash(__('Company has been removed from favorites list'))->success();
        return \Redirect::route('company.detail', $company_slug);
    }

    public function myFollowings()
    {
        $user = User::findOrFail(Auth::user()->id);
        $companiesSlugArray = $user->getFollowingCompaniesSlugArray();
        $companies = Company::whereIn('slug', $companiesSlugArray)->get();

        return view('user.following_companies')
                        ->with('user', $user)
                        ->with('companies', $companies);
    }

    public function myMessages()
    {
        $user = User::findOrFail(Auth::user()->id);
        $messages = ApplicantMessage::where('user_id', '=', $user->id)
                ->orderBy('is_read', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('user.applicant_messages')
                        ->with('user', $user)
                        ->with('messages', $messages);
    }

    public function applicantMessageDetail($message_id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $message = ApplicantMessage::findOrFail($message_id);
        $message->update(['is_read' => 1]);

        return view('user.applicant_message_detail')
                        ->with('user', $user)
                        ->with('message', $message);
    }

    public function myAlerts()
    {
        $alerts = Alert::where('email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($alerts);
        return view('user.applicant_alerts')
            ->with('alerts', $alerts);
    }
    public function delete_alert($id)
    {
        $alert = Alert::findOrFail($id);
        $alert->delete();
        $arr = array('msg' => 'A Alert has been successfully deleted. ', 'status' => true);
        return Response()->json($arr);
    }

}
