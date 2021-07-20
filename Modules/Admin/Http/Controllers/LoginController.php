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

class LoginController extends Controller
{

    public function authenticate(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

        if(is_numeric($request->get('email'))){
          if (Auth::guard('admin')->attempt(['phone' => $request->email,'password' => $request->password])){
            return redirect()->route('superadmin.dashboard');
          }
        }else{
          if (Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password])){
            return redirect()->route('superadmin.dashboard');
          }
        }
        
        return redirect()->back()->with('status','Email/Phone and Password Not Matched');
    }

    public function logout($id = null) {
      \Auth::guard(\Auth::getDefaultDriver())->logout();
      session()->flash('message', 'Just Logged Out!');
      return redirect()->route('page.homepage');
    }
    
}