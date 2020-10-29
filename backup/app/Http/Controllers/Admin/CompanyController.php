<?php

namespace App\Http\Controllers\Admin;

use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use App\Package;
use App\Company;
use App\Country;
use App\CompanyMessage;
use App\CompanyStaffMessage;
use App\AdminCompanyModel;


use App\State;
use App\Admin;
use App\City;
use App\Industry;
use App\OwnershipType;
use Carbon\Carbon;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\CompanyFormRequest;
use App\Http\Controllers\Controller;
use App\Traits\CompanyTrait;
use App\Traits\CompanyPackageTrait;

use App\TeachModel;
use App\User;


class CompanyController extends Controller
{

    use CompanyTrait;
    use CompanyPackageTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    // start Company message 

    public function all_my_company_message(){
        $getcompany = Company::select('companies.*')
            ->join('admins','admins.id','=','companies.staff_id');
        if(Auth::user()->role_id == 2) {
            $getcompany = $getcompany->where('companies.staff_id', Auth::user()->id);
        }
        $getcompany = $getcompany->groupBy('companies.id');
        $getcompany = $getcompany->get();

        $data['getcompany'] = $getcompany;

        return view('admin.company.chat.my_company_message')->with($data);
    }

    public function company_append_messages(Request $request)
    {
        $company_id = $request->get('company_id');
        $staff_id = $request->get('staff_id');

        $messages = CompanyStaffMessage::where('company_id', $company_id)->where('user_id', $staff_id)->get();
        $seeker = Admin::where('id', $staff_id)->first();
        $company = Company::where('id', $company_id)->first();
        $search = view("admin.company.chat.company_append_messages", compact('messages', 'seeker', 'company'))->render();
        return $search;
    }

    public function company_appendonly_messages(Request $request)
    {
        $seeker_id = $request->get('seeker_id');
        $company_id = $request->get('company_id');

        $messages = CompanyStaffMessage::where('company_id', $company_id)->where('user_id', $seeker_id)->get();
        $seeker = Admin::where('id', $seeker_id)->first();
        $company = Company::where('id', $company_id)->first();
        $search = view("admin.company.chat.company_appendonly_messages", compact('messages', 'seeker', 'company'))->render();
        $data = array();
        $data['html_data'] = $search;
        $data['seeker_id'] = $seeker_id;
        return \Response::json($data);
    }


    function company_submit_message(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ], [
            'message.required' => 'Message is required.',
        ]);

        $message = new CompanyStaffMessage();
        $message->company_id = $request->company_id;
        $message->message = $request->message;
        $message->user_id = $request->staff_id;
        $message->type = 'message';
        $message->save();
        
        $company = Company::where('id', $request->company_id)->first();
        $user = Admin::where('id', $request->staff_id)->first();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['company_name'] = $company->name;

        // Mail::send(new MessageSendCompanyMail($data));
        if ($message->save() == true) {
            $seeker_id = $request->seeker_id;
            $company_id = $request->company_id;
            $messages = CompanyStaffMessage::where('company_id', $company_id)->where('user_id', $request->staff_id)->get();
            $seeker = Admin::where('id', $request->staff_id)->first();
            $company = Company::where('id', $company_id)->first();
            $search = view("admin.company.chat.company_appendonly_messages", compact('messages', 'seeker', 'company'))->render();
            return $search;
        }
    }


    public function company_change_message_status(Request $request)
    {
        $company_id = $request->get('company_id');
        $seeker_id = $request->staff_id;
        $messages = CompanyStaffMessage::where('company_id', $company_id)->where('user_id', $seeker_id)->get();
        if ($messages) {
            foreach ($messages as $key => $value) {
                $message = CompanyStaffMessage::findOrFail($value->id);
                $message->status = 'viewed';
                $message->update();
            }
        }
        echo 'done';
    }




    // end Company message 
    

    // start company job seeker message
    
     public function all_messages() {

        $messages = CompanyMessage::select('company_messages.*')
                ->join('users','users.id', '=', 'company_messages.seeker_id');
        if(Auth::user()->role_id == 2) {
            $messages = $messages->where('users.staff_id', Auth::user()->id);
        }
        $messages = $messages->groupBy('company_messages.company_id')->get();

        $ids = array();
        foreach ($messages as $key => $value) {
            $ids[] = $value->company_id;
        }

        $getcompanystaff = AdminCompanyModel::where('staff_id', '=', Auth::user()->id)->get();

        foreach($getcompanystaff as $company_id)
        {
            $ids[] = $company_id->company_id; 
        }

        

        $data['companies'] = Company::whereIn('id', $ids)->get();

        return view('admin.company.my_company_message')->with($data);
     }



    public function get_company_seeker(Request $request) {

        $company_id = $request->company_id;
        if(!empty($request->company_id))
        {
             $messages   = CompanyMessage::where('company_id', $company_id)->get();
            $ids = array();

            foreach ($messages as $key => $value) {
                $ids[] = $value->seeker_id;
            }

            $getExtraseekers = User::where('staff_id', '=' ,Auth::user()->id)->get();
            foreach ($getExtraseekers as $value_u) {
                $ids[] = $value_u->id;   
            }

            $seekers = User::whereIn('id', $ids)->get();
        }
        else
        {
            $seekers = array();
        }
        
        $search  = view("admin.company.get_company_seeker", compact('seekers','company_id'))->render();
        return $search;

     }


    
    public function append_messages(Request $request)
    {
        $seeker_id = $request->get('seeker_id');
        $company_id = $request->get('company_id');

        $messages = CompanyMessage::where('company_id', $company_id)->where('seeker_id', $seeker_id)->get();
        $seeker = User::where('id', $seeker_id)->first();
        $company = Company::where('id', $company_id)->first();
        $search = view("admin.company.append_messages", compact('messages', 'seeker', 'company'))->render();
        return $search;
    }



    public function appendonly_messages(Request $request)
    {
        $seeker_id = $request->get('seeker_id');
        $company_id = $request->get('company_id');

        $messages = CompanyMessage::where('company_id', $company_id)->where('seeker_id', $seeker_id)->get();
        $seeker = User::where('id', $seeker_id)->first();
        $company = Company::where('id', $company_id)->first();
        $search = view("admin.company.appendonly_messages", compact('messages', 'seeker', 'company'))->render();
        $data = array();
        $data['html_data'] = $search;
        $data['seeker_id'] = $seeker_id;
        return \Response::json($data);
    }

    function submit_message(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ], [
            'message.required' => 'Message is required.',
        ]);
        $message = new CompanyMessage();
        $message->company_id = $request->company_id;
        $message->message = $request->message;
        $message->seeker_id = $request->seeker_id;
        $message->type = 'reply';
        $message->save();
        
        $company = Company::where('id', $request->company_id)->first();
        $user = User::where('id', $request->seeker_id)->first();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['company_name'] = $company->name;

        // Mail::send(new MessageSendCompanyMail($data));
        if ($message->save() == true) {
            $seeker_id = $request->seeker_id;
            $company_id = $request->company_id;
            $messages = CompanyMessage::where('company_id', $company_id)->where('seeker_id', $seeker_id)->get();
            $seeker = User::where('id', $seeker_id)->first();
            $company = Company::where('id', $company_id)->first();
            $search = view("admin.company.appendonly_messages", compact('messages', 'seeker', 'company'))->render();
            return $search;
        }
    }

    public function change_message_status(Request $request)
    {
        $company_id = $request->get('company_id');
        $seeker_id = $request->get('sender_id');
        $messages = CompanyMessage::where('company_id', $company_id)->where('seeker_id', $seeker_id)->get();
        if ($messages) {
            foreach ($messages as $key => $value) {
                $message = CompanyMessage::findOrFail($value->id);
                $message->status = 'viewed';
                $message->update();
            }
        }
        echo 'done';
    }


    // end company job seeker message




    public function indexCompanies()
    {
        return view('admin.company.index');
    }

    public function createCompany()
    {
        $getTeach = TeachModel::all();

        $countries = DataArrayHelper::defaultCountriesArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $ownershipTypes = DataArrayHelper::defaultOwnershipTypesArray();
        $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'employer')->pluck('package_detail', 'id')->toArray();

        return view('admin.company.add')
                        ->with('getTeach', $getTeach)
                        ->with('countries', $countries)
                        ->with('industries', $industries)
                        ->with('ownershipTypes', $ownershipTypes)
                        ->with('packages', $packages);
    }

    public function storeCompany(CompanyFormRequest $request)
    {
        $company = new Company();
        /*         * **************************************** */
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = ImgUploader::UploadImage('company_logos', $image, $request->input('name'), 300, 300, false);
            $company->logo = $fileName;
        }
        /*         * ************************************** */
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $company->password = Hash::make($request->input('password'));
        }
        $company->ceo = $request->input('ceo');

        // $company->industry_id = $request->input('industry_id');
        // $company->ownership_type_id = $request->input('ownership_type_id');
        // $company->description = $request->input('description');
        // $company->location = $request->input('location');
        // $company->map = $request->input('map');
        // $company->no_of_offices = $request->input('no_of_offices');
        // $website = $request->input('website');
        // $company->website = (false === strpos($website, 'http')) ? 'http://' . $website : $website;
        // $company->no_of_employees = $request->input('no_of_employees');
        // $company->established_in = $request->input('established_in');
        // $company->fax = $request->input('fax');
        $company->phone = $request->input('phone');
        $company->staff_id = Auth::user()->id;
        // $company->facebook = $request->input('facebook');
        // $company->twitter = $request->input('twitter');
        // $company->linkedin = $request->input('linkedin');
        // $company->google_plus = $request->input('google_plus');
        // $company->pinterest = $request->input('pinterest');
        $company->country_id = $request->input('country_id');

        $company->wechat_id = $request->input('wechat_id');
        $company->r_teach_id = $request->input('r_teach_id');   

        $company->state_id = $request->input('state_id');
        $company->city_id = $request->input('city_id');
        $company->is_active = $request->input('is_active');
        $company->is_featured = $request->input('is_featured');
        $company->save();
        /*         * ******************************* */
        $company->slug      = str_slug($company->name, '-') . '-' . $company->id;
        $company->school_id = $company->id.date('dmY');


        /*         * ******************************* */
        $company->update();
        /*         * ************************************ */
        if ($request->has('company_package_id') && $request->input('company_package_id') > 0) {
            $package_id = $request->input('company_package_id');
            $package = Package::find($package_id);
            $this->addCompanyPackage($company, $package);
        }
        /*         * ************************************ */
        flash('Company has been added!')->success();
        return \Redirect::route('edit.company', array($company->id));
    }

    public function editCompany($id)
    {

        $getTeach = TeachModel::all();


        $countries = DataArrayHelper::defaultCountriesArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $ownershipTypes = DataArrayHelper::defaultOwnershipTypesArray();

        $company = Company::findOrFail($id);
        if ($company->package_id > 0) {
            $package = Package::find($company->package_id);
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'employer')->where('id', '<>', $company->package_id)->where('package_price', '>=', $package->package_price)->pluck('package_detail', 'id')->toArray();
        } else {
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'employer')->pluck('package_detail', 'id')->toArray();
        }

        return view('admin.company.edit')
                        ->with('getTeach', $getTeach)
                        ->with('company', $company)
                        ->with('countries', $countries)
                        ->with('industries', $industries)
                        ->with('ownershipTypes', $ownershipTypes)
                        ->with('packages', $packages);
    }

    public function updateCompany($id, CompanyFormRequest $request)
    {
        $company = Company::findOrFail($id);
        /*         * **************************************** */
        if ($request->hasFile('logo')) {
            $is_deleted = $this->deleteCompanyLogo($company->id);
            $image = $request->file('logo');
            $fileName = ImgUploader::UploadImage('company_logos', $image, $request->input('name'), 300, 300, false);
            $company->logo = $fileName;
        }
        /*         * ************************************** */
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $company->password = Hash::make($request->input('password'));
        }
        $company->ceo = $request->input('ceo');
        // $company->industry_id = $request->input('industry_id');
        // $company->ownership_type_id = $request->input('ownership_type_id');
        // $company->description = $request->input('description');
        // $company->location = $request->input('location');
        // $company->map = $request->input('map');
        // $company->no_of_offices = $request->input('no_of_offices');
        // $website = $request->input('website');
        // $company->website = (false === strpos($website, 'http')) ? 'http://' . $website : $website;
        // $company->no_of_employees = $request->input('no_of_employees');
        // $company->established_in = $request->input('established_in');
        // $company->fax = $request->input('fax');
        
        $company->phone = $request->input('phone');

        $company->wechat_id = $request->input('wechat_id');
        $company->r_teach_id = $request->input('r_teach_id');   

        // $company->facebook = $request->input('facebook');
        // $company->twitter = $request->input('twitter');
        // $company->linkedin = $request->input('linkedin');
        // $company->google_plus = $request->input('google_plus');
        // $company->pinterest = $request->input('pinterest');

        $company->country_id = $request->input('country_id');
        $company->state_id = $request->input('state_id');
        $company->city_id = $request->input('city_id');
        $company->is_active = $request->input('is_active');
        $company->is_featured = $request->input('is_featured');

        $company->slug = str_slug($company->name, '-') . '-' . $company->id;
        $company->update();

        /*         * ************************************ */
        if ($request->has('company_package_id') && $request->input('company_package_id') > 0) {
            $package_id = $request->input('company_package_id');
            $package = Package::find($package_id);
            if ($company->package_id > 0) {
                $this->updateCompanyPackage($company, $package);
            } else {
                $this->addCompanyPackage($company, $package);
            }
        }
        /*         * ************************************ */
        flash('Company has been updated!')->success();
        return \Redirect::route('edit.company', array($company->id));
    }

    public function deleteCompany(Request $request)
    {
        $id = $request->input('id');
        try {
            $company = Company::findOrFail($id);
            $this->deleteCompanyLogo($company->id);
            $company->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    public function AssignCompanyStaff(Request $request)
    {
        $company_id = $request->company_id;
        $staff_id = $request->staff_id;
        $company = Company::find($request->company_id);
        $company->staff_id = $staff_id;
        $company->save();

        $json['success'] = true;
        echo json_encode($json);
    }

    public function fetchCompaniesData(Request $request)
    {

        $companies = Company::select([
                    'companies.id',
                    'companies.staff_id',
                    'companies.name',
                    'companies.email',
                    'companies.password',
                    'companies.ceo',
                    'companies.industry_id',
                    'companies.ownership_type_id',
                    'companies.description',
                    'companies.location',
                    'companies.no_of_offices',
                    'companies.website',
                    'companies.no_of_employees',
                    'companies.established_in',
                    'companies.fax',
                    'companies.phone',
                    'companies.logo',
                    'companies.country_id',
                    'companies.state_id',
                    'companies.city_id',
                    'companies.is_active',
                    'companies.is_featured',
                    'companies.school_id',
        ]);

        if(Auth::user()->role_id == 2) {
            $companies = $companies->where('staff_id','=', Auth::user()->id);
        }

        $result =  Datatables::of($companies)
                        ->filter(function ($query) use ($request) {
                            
                            if ($request->has('school_id') && !empty($request->school_id)) {
                                $query->where('companies.school_id', 'like', "%{$request->get('school_id')}%");
                            }
                            if ($request->has('name') && !empty($request->name)) {
                                $query->where('companies.name', 'like', "%{$request->get('name')}%");
                            }
                            if ($request->has('email') && !empty($request->email)) {
                                $query->where('companies.email', 'like', "%{$request->get('email')}%");
                            }
                            if ($request->has('is_active') && $request->is_active != -1) {
                                $query->where('companies.is_active', '=', "{$request->get('is_active')}");
                            }
                            if ($request->has('is_featured') && $request->is_featured != -1) {
                                $query->where('companies.is_featured', '=', "{$request->get('is_featured')}");
                            }
                        })
                        
                        ->addColumn('school_id', function ($companies) {
                            return $companies->school_id;
                        })
                        ->addColumn('is_active', function ($companies) {
                            return ((bool) $companies->is_active) ? 'Yes' : 'No';
                        })
                        ->addColumn('is_featured', function ($companies) {
                            return ((bool) $companies->is_featured) ? 'Yes' : 'No';
                        });

                        if(Auth::user()->role_id == 1)
                        {
                           $result = $result->addColumn('assign_staff', function ($companies) {
                                $getAdmin = Admin::where('role_id','=','2')->get();
                                $adminhtml = '';
                                $adminhtml .= '
                                <select class="form-control AssignStaff"  id="'.$companies->id.'">
                                    <option value="">Select Staff</option>';
                                    foreach ($getAdmin as $admin) {
                                        $selected = '';
                                        if($companies->staff_id == $admin->id)
                                        {
                                            $selected = 'selected';
                                        }
                                        $adminhtml .= '<option '.$selected.' value="'.$admin->id.'">'.$admin->name.'</option>';
                                    }
                                $adminhtml .= '</select>';
                                return $adminhtml;
                            });
                        }

                        $result = $result->addColumn('action', function ($companies) {
                            /*                             * ************************* */
                            $activeTxt = 'Make Active';
                            $activeHref = 'makeActive(' . $companies->id . ');';
                            $activeIcon = 'square-o';
                            if ((int) $companies->is_active == 1) {
                                $activeTxt = 'Make InActive';
                                $activeHref = 'makeNotActive(' . $companies->id . ');';
                                $activeIcon = 'check-square-o';
                            }
                            /*                             * ************************* */
                            $featuredTxt = 'Make Featured';
                            $featuredHref = 'makeFeatured(' . $companies->id . ');';
                            $featuredIcon = 'square-o';
                            if ((int) $companies->is_featured == 1) {
                                $featuredTxt = 'Make Not Featured';
                                $featuredHref = 'makeNotFeatured(' . $companies->id . ');';
                                $featuredIcon = 'check-square-o';
                            }
                            return '
				<div class="btn-group">
					<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('list.jobs', ['company_id' => $companies->id]) . '" target="_blank"><i class="fa fa-list" aria-hidden="true"></i>List Jobs</a>
						</li>
						
						<li>
							<a href="' . route('edit.company', ['id' => $companies->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteCompany(' . $companies->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
						
<li><a href="javascript:void(0);" onClick="' . $activeHref . '" id="onclickActive' . $companies->id . '"><i class="fa fa-' . $activeIcon . '" aria-hidden="true"></i>' . $activeTxt . '</a></li>
						
<li><a href="javascript:void(0);" onClick="' . $featuredHref . '" id="onclickFeatured' . $companies->id . '"><i class="fa fa-' . $featuredIcon . '" aria-hidden="true"></i>' . $featuredTxt . '</a></li>
					</ul>
				</div>';
                        });

                        if(Auth::user()->role_id == 1)
                        {
                            $result = $result->rawColumns(['assign_staff','action', 'is_active', 'is_featured']);
                        }
                        else
                        {
                            $result = $result->rawColumns(['action', 'is_active', 'is_featured']);   
                        }

                        $result = $result->setRowId(function($companies) {
                            return 'companyDtRow' . $companies->id;
                        })
                        ->make(true);

                    return $result;

        //$query = $dataTable->getQuery()->get();
        //return $query;
    }

    public function makeActiveCompany(Request $request)
    {
        $id = $request->input('id');
        try {
            $company = Company::findOrFail($id);
            $company->is_active = 1;
            $company->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveCompany(Request $request)
    {
        $id = $request->input('id');
        try {
            $company = Company::findOrFail($id);
            $company->is_active = 0;
            $company->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeFeaturedCompany(Request $request)
    {
        $id = $request->input('id');
        try {
            $company = Company::findOrFail($id);
            $company->is_featured = 1;
            $company->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotFeaturedCompany(Request $request)
    {
        $id = $request->input('id');
        try {
            $company = Company::findOrFail($id);
            $company->is_featured = 0;
            $company->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

}
