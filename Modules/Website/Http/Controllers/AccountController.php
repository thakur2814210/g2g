<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\City;
use App\Country;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function superadminAccount(){
        $data['cities'] = City::where('status', 1)->get();
        $data['countries'] = Country::where('status', 1)->get();
        $data['language'] =\Config::get('app.locale');
    	return view('website::auth.superadmin', $data);
    }

    public function clientAccount(){
        $data['cities'] = City::where('status', 1)->get();
        $data['countries'] = Country::where('status', 1)->get();
        $data['language'] =\Config::get('app.locale');
    	return view('website::auth.client', $data);
    }

    public function garageAccount(){
        $data['cities'] = City::where('status', 1)->get();
        $data['countries'] = Country::where('status', 1)->get();
        $data['language'] =\Config::get('app.locale');
    	return view('auth.login', $data);
    }
}
      