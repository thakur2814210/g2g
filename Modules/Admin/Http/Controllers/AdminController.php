<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\Garage;
use App\Client;
use App\Admin;
use App\User;

use App\ServicePackage;
use App\ServiceRequest;
use App\ClientPackageSubscribe;
use App\GaragePackageSubscribe;


class AdminController extends Controller
{
    
    // Dashboard Page
    public function index()
    {
        $data = [];
        $c_garage = Garage::count();
        $c_client = Client::count();
        $c_admin = Admin::count();
        $c_servicePackage = ServicePackage::count();
        $c_serviceRequest = ServiceRequest::count();
        $c_clientPackageSubscribe = ClientPackageSubscribe::count();
        $c_garagePackageSubscribe = GaragePackageSubscribe::count();

        $count = [
            'garage' => $c_garage,
            'client' =>  $c_client,
            'admin' => $c_admin,
            'servicePackage' => $c_servicePackage,
            'serviceRequest' => $c_serviceRequest,
            'clientPackageSubscribe' => $c_clientPackageSubscribe,
            'garagePackageSubscribe' => $c_garagePackageSubscribe,
        ];
        $data['counts'] = $count;
        
        return view('admin::dashboard.index' , $data);
    }



    public function viewProfile(){
        $id = Auth::user()->id;
        $data['users'] = Admin::where('id', $id)->first();
        return view('admin::profile.profile', $data);
    }

    public function changePassword(){

        $id = Auth::user()->id;
        $data['users'] = Admin::where('id', $id)->first();
        return view('admin::profile.change-password', $data);
    }

    public function updatePassword(Request $request){
       
        $id = $request->id;
        $users = Admin::where('id', '=', $id)->first();
        if(!empty($users)){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'min:5|required_with:cpassword|same:cpassword',
                'cpassword' => 'min:5'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            Admin::where('id', '=', $id)
                ->update([
                    'password' =>  \Hash::make($request->password)
                ]);
            return \Redirect::back()->with('status', 'Password updated successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }


    /*

    // Roles
    public function getAllUserRoles()
    {
      
        $data['roles'] = Role::query()->paginate(10);
        return view('admin::roles.role', $data);
    }

    public function addUserRole()
    {
        
        return view('admin::roles.add-role');
    }

    public function createNewUserRole(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:roles|max:255',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/role/add')
                        ->withErrors($validator)
                        ->withInput();
        }

        $role = new Role();
        $role->name = !empty($request->name) ? $request->name : null;
        $role->slug =!empty($request->slug) ? $request->slug : null;
        $role->status = !empty($request->status) ? $request->status : null;
        if($role->save()){
            return redirect('admin/roles')->with('status', 'New role saved successfully !!!');
        }else{
            return redirect('admin/roles')->with('status', 'Something went wrong !!!');
        }
    }


    public function editUserRole($id)
    {
        
        if(!empty($id)){
            $data = [];
            $data['roles'] = Role::where('id', $id)->first();
            if(!empty($data['roles'])){
                return view('admin::roles.edit-role', $data);
            }
        }
        return redirect('admin/roles')->with('status', 'Role does not exit !!!');
       
        
    }

    public function updateUserRole(Request $request)
    {   
        

        $id = $request->id;
        $roles = Role::where('id', '=', $id)->first();
        if(!empty($roles)){
                $validator = Validator::make($request->all(), [
                    'name'   =>  [
                        'required',
                        'max:255'
                    ],
                    'slug'   =>  [
                        'required',
                        'max:255',
                         Rule::unique('roles')->ignore($id),
                    ],

                ]);

                if ($validator->fails()) {
                    return redirect('admin/role/edit/'.$id)
                                ->withErrors($validator)
                                ->withInput();
                }

                Role::where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'slug' => $request->slug,
                        'status' => $request->status
                    ]);

                return redirect('admin/roles')->with('status', 'Update role saved successfully !!!');
        }
        return redirect('admin/roles')->with('status', 'Something went wrong !!!');
    }

    public function setUserRoleDelete($id)
    {
        
        if(!empty($id)){
            $allUserByRoles = User::where('role', $id)->get()->toArray();
            if(empty($allUserByRoles)){
                Role::where('id', $id)->update(['status' => 2]);
                return redirect('admin/roles')->with('status', 'Role deleted successfully !!!');
            }else{
                return redirect('admin/roles')->with('status', 'Error - Cannot be deleted, user exist');
            }
        }
        return redirect('admin/roles')->with('status', 'Role does not exit !!!');
    }

    public function assignRoleToUser()
    {
        
        $data = [];
        $data['roles'] = Role::where('status', 1)->get();
        $data['users'] = User::where('status', 1)->get();
        return view('admin::roles.assign-user-role', $data);
    }

     public function updateAssignRoleToUser(Request $request)
    {
        
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        if(!empty($user_id) && !empty($role_id)){
            User::where('id', $user_id)->update(['role' => $role_id]);
            return redirect('admin/roles')->with('status', 'New Role assign to the user successfully.');
        }
        return redirect('admin/roles')->with('status', 'Something went wrong !!!');
    }
    */
}
