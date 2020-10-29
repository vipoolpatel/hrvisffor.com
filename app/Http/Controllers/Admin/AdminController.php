<?php

namespace App\Http\Controllers\Admin;

use Config;
use Auth;
use DB;
use App\Admin;

use App\Company;
use App\PermissionModel;
use App\AdminPermissionModel;


use App\AdminCompanyModel;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Role;
use App\Http\Requests\AdminFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
{

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
    public function indexAdminUsers()
    {
        return view('admin.admin.index');
    }

    public function createAdminUser()
    {
        $roles = Role::select('role_name', 'id')->orderBy('role_name')->pluck('role_name', 'id')->toArray();
        /*
          print_r($roles);
          print_r(['0' => 'Select a Role']+$roles);exit;
         */
        return view('admin.admin.create')->with('roles', $roles);
    }

    public function storeAdminUser(AdminFormRequest $request)
    {
        $user = new Admin;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        /*         * ******************** */
        // Mail::send('admin.admin.emails.new_admin_user_created', ['user' => $user], function ($msg) use ($user) {
        //     $msg->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
        //     $msg->to($user->email, $user->name)->subject('Please set your password to ' . config('app.name') . ' admin panel.');
        // });
        /*         * ******************** */
        flash('New Admin User has been created!')->success();
        return \Redirect::route('edit.admin.user', array($user->id));
    }

    public function editAdminUser($id)
    {
        $user = Admin::findOrFail($id);
        $roles = Role::select('role_name', 'id')->orderBy('role_name')->pluck('role_name', 'id')->toArray();
        return view('admin.admin.edit')->with('roles', $roles)->with('user', $user);
    }

    public function updateAdminUser($id, AdminFormRequest $request)
    {
        $user = Admin::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->save();
        flash('Admin User has been updated!')->success();
        return \Redirect::route('edit.admin.user', array($user->id));
    }

    public function deleteAdminUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = Admin::findOrFail($id);
            $user->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function fetchAdminUsersData()
    {
        $users = Admin::join('roles', 'admins.role_id', '=', 'roles.id')
                ->select('admins.id', 'admins.name', 'admins.email', 'roles.role_name');
         $result = Datatables::of($users);


                    if(Auth::user()->role_id == 1)
                    {

                        $result = $result->addColumn('assign_company', function ($user) {

                                $admincompany = AdminCompanyModel::where('staff_id','=',$user->id)->get();

                                $getCompany = Company::get();
                                $companyhtml = '';
                                $companyhtml .= '
                                <select class="form-control" multiple name="company_id[]" id="AssignCompany'.$user->id.'">';
                                    foreach ($getCompany as $company) {
                                        $selected = '';
                                        foreach($admincompany as $company_id)
                                        {
                                            if($company_id->company_id == $company->id)
                                            {
                                                $selected = 'selected';
                                            }    
                                        }

                                        $companyhtml .= '<option '.$selected.' value="'.$company->id.'">'.$company->name.'</option>';
                                    }
                                $companyhtml .= '</select>';

                                $companyhtml .= '<button class="btn btn-danger AssignStaffSave" id="'.$user->id.'">Save</button>';
                                return $companyhtml;
                            });
                    }



                       $result = $result->addColumn('action', function ($user) {

                            return '<a href="' . route('edit.admin.user', ['id' => $user->id]) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="javascript:void(0);" onclick="delete_user(' . $user->id . ');" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a>

                                <button class="btn btn-xs btn-success SetPermission" type="button" id="'.$user->id.'">Permission</button>
                            ';
                        })
                        ->removeColumn('password')
                        ->setRowId(function($user) {
                            return 'admin_user_dt_row_' . $user->id;
                        });

                        if(Auth::user()->role_id == 1)
                        {
                              $result = $result->rawColumns(['assign_company','action']);
                        }
                        else
                        {
                              $result = $result->rawColumns(['action']);  
                        }

                      

                        $result = $result->make(true);

                    return $result;


    }



    public function AssignCompanyStaff(Request $request)
    {
        AdminCompanyModel::where('staff_id','=',$request->staff_id)->delete();

        if(!empty($request->company_id)) {
            foreach ($request->company_id as $company_id) {

                $company              = new AdminCompanyModel;
                $company->company_id  = $company_id;
                $company->staff_id    = $request->staff_id;
                $company->save();

            }
        }

        $json['success'] = true;
        echo json_encode($json);
    }


    public function get_permission(Request $request) {

        $permission = PermissionModel::getpermission();
        $user_permission = AdminPermissionModel::get_permission($request->staff_id);

        return response()->json([
          "status"  => true,
          "success" => view("admin.admin._permission", [
            "permission" => $permission,
            "user_permission" => $user_permission,
            "staff_id" => $request->staff_id,
          ])->render(),
        ], 200);     

    }

    public function save_permission(Request $request) {
        AdminPermissionModel::where('staff_id','=',$request->staff_id)->delete();

        if(!empty($request->permission))
        {
            foreach($request->permission as $permission_id)
            {
                $permission = new AdminPermissionModel;
                $permission->permission_id  = $permission_id;
                $permission->staff_id       = $request->staff_id;
                $permission->save();
            }
            
        }

        $json['message'] = "Permission sucessfully apply";
        echo json_encode($json);
    }

}



    