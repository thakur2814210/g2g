<?php

namespace Modules\Garage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;
use Auth;
use App\User;
use App\Garage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ProfileController extends Controller
{
   
    public function viewProfile()
    {
        
        
        $title = array('pageTitle' => Lang::get("labels.Profile"));

        $result = array();

        $countries = DB::table('countries')->get();
        $zones = DB::table('zones')->where('zone_country_id', '=', auth()->user()->country)->get();

        $result['countries'] = $countries;
        $result['zones'] = $zones;
         return view('garage::profile.view-profile',$title)->with('result', $result);
    }


    public function updateProfile(Request $request){
        $updated_at = date('y-m-d h:i:s');

        $count = User::where('phone','=', $request->phone)->where('id','!=', Auth()->user()->id)->count();
        if($count){
            $message = "the phone number you've entered already exists with another account";
        }else{
             DB::table('users')->where('id','=', Auth()->user()->id)->update([
                'first_name' =>($request->first_name) ? $request->first_name : Auth()->user()->first_name ,
                'last_name'  =>  ($request->last_name) ? $request->last_name : Auth()->user()->last_name ,
                'phone'         =>  ($request->phone) ? $request->phone : Auth()->user()->phone ,
                'email'         =>  ($request->email) ? $request->email : Auth()->user()->email ,
                'updated_at'    =>  $updated_at,
                'garage_vendor_type' => $request->garage_vendor_type
                ]);

            DB::table('garages')->where('user_id','=', Auth()->user()->id)->update([
                'type' =>  $request->garage_vendor_type
            ]);

                $message = Lang::get("labels.ProfileUpdateMessage");
        }
       
        return redirect()->back()->withErrors([$message]);

    }

    public function updateClientPassword(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'min:5|required_with:re_password|same:re_password',
            're_password' => 'min:5'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

        DB::table('users')->where('id','=', \Auth()->user()->id)->update([
                'password'  =>  \Hash::make($request->password)
                ]);

        $message = Lang::get("labels.PasswordUpdateMessage");
        return redirect()->back()->withErrors([$message]);
       
    }
}
