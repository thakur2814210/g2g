<?php

namespace Modules\Garage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\Garage;
use App\GeneralSetting as GS;
use Lang;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Languages;
use App\Http\Controllers\Website\ThemeController;


class LoginController extends Controller
{

    public function __construct(Index $index,Languages $languages)
    {
        $this->index = $index;
        $this->languages = $languages;
        $this->theme = new ThemeController();
    }

    public function login(Request $request){
        
        if(auth()->guard('customer')->check()){
            return redirect('/');
        }
        else{
            $previous_url = \Session::get('_previous.url');

            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $ref = rtrim($ref, '/');


            session(['previous'=> $previous_url]);

            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();

            $result = array();
            $result['commonContent'] = $this->index->commonContent();

            return view("auth.garage_login", ['title'=>$title,'final_theme' => $final_theme])->with('result', $result);
        }

    }

	public function authenticate(Request $request){
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
      	  if (Auth::guard('vendor')->attempt(['phone' => $request->email,'password' => $request->password])){
            return redirect()->route('page.homepage');
          }
        }else{
          if (Auth::guard('vendor')->attempt(['email' => $request->email,'password' => $request->password])){
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
            'username' => 'required|unique:garages',
            'email' => 'required|email|max:255|unique:garages',
            'phone' => 'required|max:8|min:8|unique:garages',
            'password' => 'required',
            'address'   =>  ['required'],
            'city_id'   =>  ['required'],
            'postal'   =>  ['required'],
            'country_id'   =>  ['required'],
            'latitude'   =>  ['required'],
            'longitude'   =>  ['required'],
            'name'   =>  'required|unique:garages',
        ]);


        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $garage = new Garage;
        $garage->username = $request->username;
        $garage->name = $request->name;
        $garage->email = $request->email;
        $garage->phone = '971-5'.$request->phone;
        $garage->address = $request->address;
        $garage->city_id = $request->city_id;
        $garage->country_id = $request->country_id;
        $garage->postal = $request->postal;
        $garage->latitude = $request->latitude;
        $garage->longitude = $request->longitude;
        $garage->password = \Hash::make($request->password);
        $garage->save();
        return redirect()->back()->with('status', 'Garage registered successfully, Please verified your email OR contact Admin.');
        
    }

}