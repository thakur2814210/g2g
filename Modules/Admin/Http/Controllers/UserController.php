<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\Role;
use App\User;
use App\Helpers\Helper;


// not is used ...
class UserController extends Controller
{

    private $role_id;
    public function __construct(){
        $this->middleware('admin');
        $this->role_id = 2;
    }
    
    public function isCanAccess(){
        if(!Helper::isCanAccess($this->role_id)){
           return view('admin::no-access');
        }
    }

    public function activeUserList(){
        $this->isCanAccess();
        $data = [];
        $data['users'] = User::where('status',1)->whereNotIn('role',[1,2])->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin::user.user-active-list',$data);
    }

    public function deleteUserList(){
        $this->isCanAccess();
        $data = [];
        $data['users'] = User::where('status',2)->whereNotIn('role',[1,2])->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin::user.user-delete-list',$data);
    }

    public function pendingUserList(){
        $this->isCanAccess();
        $data = [];
        $data['users'] = User::where('status',3)->whereNotIn('role',[1,2])->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin::user.user-pending-list',$data);
    }

    public function addUser(){
        $this->isCanAccess();
        return view('admin::user.add');
    }

    public function saveUser(Request $request){
       $this->isCanAccess();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'status' =>'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        // Create client
        $user = new User();
        $user->name = $request->name;
        $user->email =  $request->email;
        $user->status =  $request->status;
        $user->phone =  $request->phone;
        $user->password =  \Hash::make($request->password);
        $user->role =  $request->role;

        if($user->save()){
            return redirect('admin/users')->with('status', 'New user created successfully !!!');
        }
        return redirect('admin/users')->with('status', 'Something went wrong !!!');
    }

    public function editUser($id){
        $this->isCanAccess();
        $data = [];
        if(!empty($id)){
            $data['users'] = User::where('id', $id)->first();
            if(!empty($data['users'])){
                return view('admin::user.edit',$data);
            }
        }
        return \Redirect::back()->with('status', 'User does not exist !!!');
    }

    public function updateUser(Request $request){
        $this->isCanAccess();
        $id = $request->id;
        $users = User::where('id', '=', $id)->first();
        if(!empty($users)){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'role' => 'required',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            User::where('id', '=', $id)
                ->update([
                    'name' =>  $request->name,
                    'email' =>  $request->email,
                    'phone' =>  $request->phone,
                    'role' =>  $request->role,
                    'status' =>  $request->status,
                ]);
            return redirect('admin/users')->with('status', 'Update user info successfully !!!');
        }
        return \Redirect::back()->with('status', 'User does not exist !!!');
    }

   
    public function changeUserPassword($id){
        $this->isCanAccess();
        $data = [];
        if(!empty($id)){
            $data['users'] = User::where('id', $id)->first();
            if(!empty($data['users'])){
                return view('admin::user.change-password',$data);
            }
        }
        return \Redirect::back()->with('status', 'User does not exist !!!');
        
    }

    public function updateUserPassword(Request $request){
        $this->isCanAccess();
        $id = $request->id;
        $users = User::where('id', '=', $id)->first();
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

            User::where('id', '=', $id)
                ->update([
                    'password' =>  \Hash::make($request->password)
                ]);
            return redirect('admin/users')->with('status', 'Update password successfully !!!');
        }
        return \Redirect::back()->with('status', 'User does not exist !!!');
    }


    public function changeUserStatus($id){
        $this->isCanAccess();
        $data = [];
        if(!empty($id)){
            $data['users'] = User::where('id', $id)->first();
            if(!empty($data['users'])){
                return view('admin::user.change-status',$data);
            }
        }
        return \Redirect::back()->with('status', 'User does not exist !!!');
    }

    public function updateUserStatus(Request $request){
        $this->isCanAccess();
        $id = $request->id;
        $users = User::where('id', '=', $id)->first();
        if(!empty($users)){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            User::where('id', '=', $id)
                ->update([
                    'status' => $request->status
                ]);
            return redirect('admin/users')->with('status', 'Update status successfully !!!');
        }
        return \Redirect::back()->with('status', 'User does not exist !!!');
    }
}