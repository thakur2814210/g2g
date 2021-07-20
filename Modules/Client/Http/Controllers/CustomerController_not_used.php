<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\Client;
use App\ClientLocation;
use App\City;
use App\Country;
use App\ServiceRequest;
use App\ClientPackageSubscribe;

class CustomerController extends Controller
{
   
    public function index(){


        $client = Client::where('id', Auth::user()->id)->first();
        $sr_customer_count = ServiceRequest::where('client_id', $client->id)
                                    ->get();
        $ps_customer_count = ClientPackageSubscribe::where('client_id', $client->id)
                                    ->get();


        $data['sr_customer_count'] = $sr_customer_count->count();
        $data['ps_customer_count'] = $ps_customer_count->count();
    	return view('client::dashboard.index' , $data);
    }

    public function viewProfile()
    {
        $data = [];
        $data['users'] = Client::where('user_id', Auth::user()->id)->with('t_city','t_country')->first();
        if(!empty($data['users'])){
            return view('client::profile.view-profile', $data);
        }
         return \Redirect::back()->with('status', 'Something went wrong!!!');
    }

    public function editProfile()
    {
        $data = [];
        $data['users'] = Client::where('id', Auth::user()->id)->with('t_city','t_country')->first();
        if(!empty($data['users'])){
            $data['cities'] = City::where('status', 1)->get();
            $data['countries'] = Country::where('status', 1)->get();
            $data['language'] =\Config::get('app.locale');
            return view('client::profile.profile', $data);
        }
        return \Redirect::back()->with('status', 'Something went wrong!!!');
    }

    public function updateProfile(Request $request){

         $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal' => 'required', 
        ]);

        if ($validator->fails()) {
            return  \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $client = Client::where('id', Auth::user()->id)->first();
        if(!empty($client)){
            Client::where('id', $client->id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'city' => $request->city,
                'country' => $request->country,
                'postal' => $request->postal,
                'fax' => !empty($request->fax) ? $request->fax : null,
                'mobile2' => !empty($request->mobile2) ? $request->mobile2 : null,
                'phone2' => !empty($request->phone2) ? $request->phone2 : null,
            ]);
            return  \Redirect::back()->with('status', 'Update profile successfully !!!');
        }
        return \Redirect::back()->with('error', 'Something went wrong!!!');
    }

    public function passwordChange()
    {
        return view('client::profile.password-change');
    }

    public function updateClientPassword(Request $request){
       
        $id = $request->id;
        $users = Client::where('id', '=', $id)->first();
        if(!empty($users)){
            $validator = Validator::make($request->all(), [
                'password' => 'min:5|required_with:cpassword|same:cpassword',
                'cpassword' => 'min:5'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            Client::where('id', '=', $id)
                ->update([
                    'password' =>  \Hash::make($request->password)
                ]);
            return  \Redirect::back()->with('status', 'Update password successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong!!!');
    }

    public function addNewLocations(Request $request){
       
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'pobox' => 'required', 
        ]);


        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

        $client = Client::where('user_id',\Auth::guard('customer')->user()->id)->first();
        if(!empty($client)){
            $clientLocation = new ClientLocation();
            $clientLocation->client_id = $client->id;
            $clientLocation->address = $request->address;
            $clientLocation->latitude = $request->latitude;
            $clientLocation->longitude = $request->longitude;
            $clientLocation->city_id = $request->city_id;
            $clientLocation->country_id = $request->country_id;
            $clientLocation->pobox = $request->pobox;
            if($clientLocation->save()){
                return \Redirect::back()->with('status', 'Update new location successfully!!!');
            }

        }
        return \Redirect::back()->with('status', 'Something went wrong!!!');
    }

}
