<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;
use Auth;
use App\Client;
use App\GeneralSetting as GS;

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
      	  if (Auth::guard('client')->attempt(['phone' => $request->email,'password' => $request->password])){
            return redirect()->route('page.homepage');
          }
        }else{
          if (Auth::guard('client')->attempt(['email' => $request->email,'password' => $request->password])){
            return redirect()->route('page.homepage');
          }
        }
        
        return redirect()->back()->with('status','Email/Phone and Password Not Matched');
    }

    public function logout($id = null) {
        \Auth::guard(\Auth::getDefaultDriver())->logout();
        session()->flash('message', 'Just Logged Out!');
        return redirect()->route('page.homepage');
    }

    
    public function register(Request $request) {
        // return $request->all();

        $gs = GS::first();
        if ($gs->registration == 0) {
          return redirect()->route('page.homepage')->with('status', 'Registration is closed by Admin');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:clients',
            'email' => 'required|email|max:255|unique:clients',
            'phone' => 'required|max:8|min:8|unique:clients',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $client = new Client;
        $client->username = $request->username;
        $client->email = $request->email;
        $client->phone = '971-5'.$request->phone;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->country = $request->country;
        $client->postal = $request->postal;
        $client->latitude = $request->latitude;
        $client->longitude = $request->longitude;
        $client->password = \Hash::make($request->password);
        $client->save();
        return redirect()->back()->with('status', 'User registered successfully, Please verified your email OR contact Admin.');
        
    }
}