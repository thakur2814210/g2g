<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;



class LoginController extends Controller
{

	public function ajaxSignInModalLogin(Request $request){

     $validator = Validator::make($request->all(), [
          'email' => 'required',
          'password' => 'required'
      ]);


      if ($validator->fails()) {
          return \Redirect::back()
          ->withErrors($validator)
          ->withInput();
      }


      if($request->has('slug') && $request->has('page')){

       $page = $request->get('page');

        switch ($page) {

            case 'service-request':
              if(is_numeric($request->get('email'))){
                if (Auth::guard('client')->attempt(['phone' => $request->email,'password' => $request->password])){
                   return redirect()->route('client.service-request.create',['category' => $request->get('slug')]);
                }
              }else{
                if (Auth::guard('client')->attempt(['email' => $request->email,'password' => $request->password])){
                   return redirect()->route('client.service-request.create',['category' => $request->get('slug')]);
                }
              }
            break;

            case 'client-package-subscription':
               if(is_numeric($request->get('email'))){
                  if (Auth::guard('client')->attempt(['phone' => $request->email,'password' => $request->password])){
                     return redirect()->route('client.package-subscription.create',['category' => $request->get('slug')]);
                  }
                }else{
                  if (Auth::guard('client')->attempt(['email' => $request->email,'password' => $request->password])){
                     return redirect()->route('client.package-subscription.create',['category' => $request->get('slug')]);
                  }
                }
            break;

            case 'garage-package-subscription':
                if(is_numeric($request->get('email'))){
                  if (Auth::guard('vendor')->attempt(['phone' => $request->email,'password' => $request->password])){
                    return redirect()->route('garage.packages.buy_or_upgrade',['slug' => $request->get('slug')]);
                  }
                }else{
                  if (Auth::guard('vendor')->attempt(['email' => $request->email,'password' => $request->password])){
                    return redirect()->route('garage.packages.buy_or_upgrade',['slug' => $request->get('slug')]);
                  }
                }
            break;
        }
    }

    return redirect()->back()->with('status','Authentication Failed! Invalid credentials failed to login');
  }

}