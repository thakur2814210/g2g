<?php

namespace App\Http\Controllers\App\Garage;

//validator is builtin class in laravel
use Validator;
use DB;
use DateTime;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\AppModels\Garage;
use Carbon\Carbon;
use App\Models\Core\Setting;

class GarageController extends Controller
{
	public function getAllGarages(Request $request){
    	$getAllGarages = Garage::getAllGarages($request);
		return($getAllGarages) ;
	}

    public function getAllMapGarages(Request $request){
        $getAllGarages = Garage::getAllMapGarages($request);
        return($getAllGarages) ;
    }

    public function getFeaturedGarages(Request $request){
        $getAllGarages = Garage::getFeaturedGarages($request);
        return($getAllGarages) ;
    }
    
    public function getAllPackages(Request $request){
        $getAllPackages = Garage::getAllPackages($request);
        return($getAllPackages) ;
    }

	public function getallcities(){

		$consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $allcities = DB::table('cities')->where('status' , 1)->select('id', 'name')->get();
            $responseData = array('success' => '1', 'allcities' => $allcities, 'message' => "Returned all city.");
        } else {
            $responseData = array('success' => '0', 'allcities' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
		
	}


    //getfilters
    public function getfilters(Request $request){




        $categoryResponse = [];
        print $categoryResponse;
    }

	public function getallcountries(){

		$consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $allcountries = DB::table('countries')->where('status' , 1)->select('countries_id','name')->get();
            $responseData = array('success' => '1', 'allcountries' => $allcountries, 'message' => "Returned all country.");
        } else {
            $responseData = array('success' => '0', 'allcountries' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;

	}

	  public function getSetting()
    {
        $setting = DB::table('settings')->get();
        $result = array();
        foreach ($setting as $settings) {
            $name = $settings->name;
            $value = $settings->value;
            $result[$name] = $value;
        }
        return $result;
    }

	public function apiAuthenticate($consumer_data)
    {
        $settings = $this->getSetting();

        $callExist = DB::table('api_calls_list')
            ->where([
                ['device_id', '=', $consumer_data['consumer_device_id']],
                ['nonce', '=', $consumer_data['consumer_nonce']],
                ['url', '=', $consumer_data['consumer_url']],
            ])
            ->get();
        $ip = $consumer_data['consumer_ip'];
        $device_id = $consumer_data['consumer_device_id'];

        $block_check = DB::table('block_ips')->where('ip', $ip)->orwhere('device_id', $device_id)->first();
        if ($block_check != null) {
            return '0';
        }

        $http_call_record = DB::table('http_call_record')->where('ip', $ip)->orderBy('ping_time', 'desc')->first();
        if ($http_call_record == null) {
            $last_ping_time = Carbon::now();
            $difference_from_previous = 0;
        } else {
            $last_ping_time = $http_call_record->ping_time;
            $difference_from_previous = $http_call_record->difference_from_previous;

        }
        $date = new Carbon(Carbon::now()->toDateTimeString());
        $difference = $date->floatDiffInSeconds($last_ping_time);

        DB::table('http_call_record')
            ->insert([
                'ip' => $ip,
                'device_id' => $device_id,
                'url' => $consumer_data['consumer_url'],
                'ping_time' => Carbon::now(),
                'difference_from_previous' => $difference,
            ]);

        $time_taken = DB::table('http_call_record')->where('url', $consumer_data['consumer_url'])->where('ip', $ip)->take(10)->sum('difference_from_previous');
        $record_count = DB::table('http_call_record')->where('ip', $ip)->count();

        if(md5($settings['consumer_key']) == $consumer_data['consumer_key'] &&
            md5($settings['consumer_secret']) == $consumer_data['consumer_secret']
             && count($callExist)==0){
            DB::table('api_calls_list')
               ->insert([
                     'device_id'=>$consumer_data['consumer_device_id'],
                     'nonce'=>$consumer_data['consumer_nonce'],
                     'url'=>$consumer_data['consumer_url'],
                     'created_at'=>date('Y-m-d h:i:s')
                 ]);
            return '1';
        }else{return '1';
              if($record_count >= 1000 && $time_taken <=60 ){
                     DB::table('http_call_record')->where('url',$consumer_data['consumer_url'])->where('ip',$ip)->delete();

                DB::table('block_ips')
                      ->insert([
                            'ip' => $ip,
                            'device_id' => $device_id,
                     'created_at' => Carbon::now()
                        ]);
                    return '0';
                 }else{
                     return '0';
                 }
        }
    }
}
