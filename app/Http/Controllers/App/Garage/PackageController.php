<?php

namespace App\Http\Controllers\App\Garage;

//validator is builtin class in laravel
use App\Models\Core\Setting;
use Validator;
use DB;
use DateTime;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//use App\Models\AppModels\ServiceRequest;
use Carbon\Carbon;
use App\User;
use App\Vehicle;
use App\Section;
use App\Garage;
use App\Client;
use App\VehicleMake;
use App\VehicleModel;

use App\City;
use App\Country;
use App\ClientLocation;

use App\ServicePackage;
use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;

class PackageController extends Controller
{

    public function getClientID($user_id)
    {
        $client = Client::where('user_id', $user_id)->first();
        if (!empty($client)) {
            return $client->id;
        } else {
            return null;
        }

    }

    public function getPackageSubscriptionData(Request $request)
    {

        $language_id = $request->language_id;
        $client_id = $this->getClientID($request->client_id);
        $section_id = $request->section_id;
        $data = [];

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $category = Section::with(['sectionsDescription' => function ($q) use ($language_id) {
                return $q->where('language_id', $language_id);
            }])
                ->where('id', $section_id)
                ->where('status', 1)
                ->first();

            if (!empty($category)) {

                $packages = ServicePackage::query()->where('status', 1)
                    ->where('section_id', $category->id)
                    ->with('packageFeatures', 'section')
                    ->get();

                if (empty($packages) || $packages->count() == 0) {
                    $responseData = array('success' => '0', 'packageSubscription' => $data, 'message' => "No Package Exist!!! - We don't have any packages in that category, so nothing is displayed. Please contact admin for further assistance.");
                } else {

                    $data['subcategories'] = $category = Section::with(['sectionsDescription' => function ($q) use ($language_id) {
                        return $q->where('language_id', $language_id);
                    }])
                        ->where('parent', $category->id)
                        ->where('status', 1)
                        ->get();


                    $data['packages'] = $packages;
                    $data['categories'] = $category;
                    $data['vehicles'] = Vehicle::where('client_id', $client_id)->where('status', 1)->orderBy('id', 'DESC')->get();
                    //$data['locations'] = ClientLocation::where('client_id' , $client_id)->get();
                    $data['locations'] = DB::table('client_locations')
                        ->leftjoin('countries', 'countries.id', 'client_locations.country_id')
                        ->leftjoin('cities', 'cities.id', 'client_locations.city_id')
                        ->select('client_locations.id', 'client_locations.address', 'client_locations.pobox as postcode', 'countries.name as country', 'cities.name as city', 'client_locations.longitude', 'client_locations.latitude')
                        ->where('client_id', $client_id)->where('client_locations.status', '=', 'Active')->orderBy('id', 'DESC')->get();

                    $setting = new Setting();
                    $getSettings = $setting->getSettings();

                    $data['vip_pickup_enabled'] = $getSettings[126]->value*1;
                    $data['vip_pickup_amount'] = $getSettings[127]->value*1;

                    $responseData = array('success' => '1', 'packageSubscription' => $data, 'message' => "Returned all records.");
                }
            } else {
                $responseData = array('success' => '0', 'packageSubscription' => $data, 'message' => "Empty records.");
            }

        } else {
            $responseData = array('success' => '0', 'packageSubscription' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function getPackageSubscribeStatusArr()
    {
        return [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending',
            '4' => 'Inactive',
            '5' => 'Request-Payemnt',
            '6' => 'Received-Payment',
            '7' => 'Required-Payment-Approval'
        ];
    }

    public function getPackagePaymentStatusName($key)
    {
        $arr = [
            '1' => 'Success',
            '2' => 'Failed',
            '3' => 'Pending',
            '4' => 'Required-Payment-Approval'
        ];

        return $arr[$key];
    }


    // get package subscription of single client
    public function getPackageSubscription(Request $request)
    {

        $client_id = $this->getClientID($request->client_id);

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $data = [];
            $packageStatus = $this->getPackageSubscribeStatusArr();

            $packages = ClientPackageSubscribe::where('client_id', $client_id)
                ->orderBy('updated_at', 'desc')
                ->with('servicePackage', 'vehicle')
                ->get();
            //echo count($packages);die;
            foreach ($packages as $package) {
                $temp = [];
                $temp['id'] = $package->id;
                $temp['amount'] = $package->amount;
                $temp['service_package_name'] = $package->servicePackage->name;
                $temp['subscription_start_at'] = $package->subscription_start_at;
                $temp['subscription_end_at'] = $package->subscription_start_at;
                $temp['status'] = (isset($packageStatus[$package->status]) ? $packageStatus[$package->status] : null);
                $temp['vehicle'] = (!empty($package->vehicle->plate_no) ? $package->vehicle->plate_no : null);

                $garage = Garage::query()
                    ->join('garages_description', 'garages_description.garages_id', 'garages.id')
                    ->select('garages_description.garages_name as name')
                    ->where('garages_description.language_id', 1)
                    ->where('garages.id', $package->garage_id)->first();

                $temp['garage'] = (!empty($garage) ? $garage->name : null);

                $data[] = $temp;
            }
            //dd($data);

            if (count($data) > 0) {
                $responseData = array('success' => '1', 'data' => $data, 'message' => "Returned all package subscription data.");
            } else {
                $responseData = array('success' => '2', 'data' => $data, 'message' => "No package found.");
            }

        } else {
            $responseData = array('success' => '0', 'packageSubscription' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function getPackageSubscriptionLog(Request $request)
    {

        $id = $request->client_package_subscribe_id;

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {


            $packages = ClientPackageSubscribeLog::where('client_package_subscribe_id', $id)->get();

            if (count($packages) > 0) {
                $responseData = array('success' => '1', 'data' => $packages, 'message' => "Returned all package log data.");
            } else {
                $responseData = array('success' => '0', 'data' => array(), 'message' => "No package found.");
            }

        } else {
            $responseData = array('success' => '0', 'packageSubscription' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function getSinglePackageSubscription(Request $request)
    {

        $id = $request->client_package_subscribe_id;
        $client_id = $this->getClientID($request->client_id);

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $data = [];
            $packageStatus = $this->getPackageSubscribeStatusArr();

            $package = ClientPackageSubscribe::where('client_id', $client_id)
                ->where('id', $id)
                ->orderBy('updated_at', 'desc')
                ->with('servicePackage', 'vehicle')
                ->first();

            $data['packages']['id'] = $package['id'];
            $data['packages']['amount'] = $package['amount'];
            $data['packages']['service_package_name'] = $package['servicePackage']['name'];
            $data['packages']['subscription_start_at'] = $package['subscription_start_at'];
            $data['packages']['subscription_end_at'] = $package['subscription_start_at'];
            $data['packages']['statusName'] = $packageStatus[$package['status']];
            $data['packages']['status'] = $package['status'];
            $data['packages']['vehicle'] = $package['vehicle']['plate_no'];
            $data['packages']['vip_pickup_opted'] = $package['vip_pickup_opted'];
            $data['packages']['vip_pickup_price'] = $package['vip_pickup_price'];

            $garage = Garage::query()
                ->join('garages_description', 'garages_description.garages_id', 'garages.id')
                ->select('garages_description.garages_name as name')
                ->where('garages_description.language_id', 1)
                ->where('garages.id', $package->garage_id)->first();

            $data['packages']['garage'] = $garage->name;


            $clientPackageSubscribePayment = ClientPackageSubscribePayment::where('client_package_subscribe_id', $id)->first();

            if (!empty($clientPackageSubscribePayment)) {

                $data['packageSubscribePayment']['id'] = $clientPackageSubscribePayment['id'];
                $data['packageSubscribePayment']['client_package_subscribe_id'] = $clientPackageSubscribePayment['client_package_subscribe_id'];
                $data['packageSubscribePayment']['date'] = $clientPackageSubscribePayment['date'];
                $data['packageSubscribePayment']['amount'] = $clientPackageSubscribePayment['amount'];
                $data['packageSubscribePayment']['statusName'] = $this->getPackagePaymentStatusName($clientPackageSubscribePayment['status']);
                $data['packageSubscribePayment']['status'] = $clientPackageSubscribePayment['status'];
                $data['packageSubscribePayment']['payment_type'] = $clientPackageSubscribePayment['payment_type'];
            } else {

                $data['packageSubscribePayment']['id'] = null;
                $data['packageSubscribePayment']['client_package_subscribe_id'] = '';
                $data['packageSubscribePayment']['date'] = '';
                $data['packageSubscribePayment']['amount'] = '';
                $data['packageSubscribePayment']['statusName'] = '';
                $data['packageSubscribePayment']['status'] = '';
                $data['packageSubscribePayment']['payment_type'] = '';
            }

            if (count($data) > 0) {
                $responseData = array('success' => '1', 'data' => $data, 'message' => "Returned all package subscription data.");
            } else {
                $responseData = array('success' => '0', 'data' => array(), 'message' => "No package subscription found.");
            }
        } else {
            $responseData = array('success' => '0', 'packageSubscription' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }


    public function getGarageByCategory(Request $request)
    {

        $language_id = $request->language_id;
        $client_id = $this->getClientID($request->client_id);
        $section_id = $request->section_id;
        $client_location_id = $request->client_location_id;
        $s_distance = $request->distance;

        $data = [];

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $clientLocation = ClientLocation::where('id', $client_location_id)->where('client_id', $client_id)->first();
            $s_latitude = $clientLocation->latitude;
            $s_longitude = $clientLocation->longitude;
            $s_city_id = $clientLocation->city_id;
            $s_country_id = $clientLocation->country_id;

            $category = Section::where('status', 1)->where('id', $section_id)->first();
            $s_category = $category->id;
            $cat_slug = $category->slug;

            if (!empty($s_latitude) && !empty($s_longitude) && !empty($cat_slug)) {

                $garages = Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                    ->join('garages_description', 'garages_description.garages_id', '=', 'garages.id')
                    ->join('cities', 'cities.id', 'garages.city_id')
                    ->join('countries', 'countries.id', 'garages.country_id')
                    //->select('garages.id','garages.profile_image as image','garages_description.garages_name','garages_description.garages_description','cities.name as city_name', 'countries.countries_name as country_name','garages.address as address','garages.postal')
                    ->select('garages.*', 'garages_description.garages_name as garages_name', 'cities.name as city_name', 'countries.name as country_name')
                    ->where(function ($query) use ($s_category) {
                        return $query->whereRaw("FIND_IN_SET($s_category,garage_services.cat_id)")
                            ->orWhereRaw("FIND_IN_SET($s_category,garage_services.sub_cat_id)");

                    })
                    ->where('garages_description.language_id', $language_id)
                    ->where('garages.city_id', $s_city_id)
                    ->where('garages.country_id', $s_country_id)
                    ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                    ->get();


                $final_garage_list = [];
                if (!empty($garages) && count($garages) > 0) {

                    foreach ($garages as $key => $garage) {
                        $g_latitude = $garage->latitude;
                        $g_longitude = $garage->longitude;

                        $distanceInKm = $this->calculateDistanceBetweenTwoPoints($s_latitude, $s_longitude, $g_latitude, $g_longitude);
                        //echo '---<br/>';
                        if (round($distanceInKm, 2) <= round($s_distance, 2)) {
                            $final_garage_list[] = $garage;
                        }
                    }

                    $responseData = array('success' => '1', 'data' => $garages, 'message' => "Returned all garges.");
                } else {
                    $responseData = array('success' => '2', 'data' => array(), 'message' => "No Records Found.");
                }


            } else {
                $responseData = array('success' => '2', 'garages' => array(), 'message' => "No Records Found.");
            }

        } else {
            $responseData = array('success' => '0', 'servicRequesteData' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function createPackageSubscription(Request $request)
    {

        $setting = new Setting();
        $getSettings = $setting->getSettings();

        $client_id = $this->getClientID($request->client_id);
        $section_id = $request->section_id;
        $vehicle_id = $request->vehicle_id;
        $client_location_id = $request->client_location_id;
        $faults_remarks = $request->faults_remarks;
        $garage_id = $request->garage_id;
        $package_id = $request->package_id;
        $payment_type = $request->payment_type;
        $subcategory_ids = $request->subcategory_ids;
        if(isset($request->vip_pickup_opted) && $request->vip_pickup_opted==1){
            $vip_pickup_opted = $request->vip_pickup_opted;
            $vip_pickup_price = $getSettings[127]->value*1;
        } else {
            $vip_pickup_opted = 0;
            $vip_pickup_price = '';
        }

        $data = [];

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $clientLocation = ClientLocation::where('id', $client_location_id)->where('client_id', $client_id)->first();

            $category = Section::where('status', 1)->where('id', $section_id)->first();

            $service_package = ServicePackage::where('id', $package_id)->first();


            if (!empty($category) && !empty($clientLocation) && !empty($service_package)) {

                $cat_id = $category->id;
                $clientPackageSubscribe = new ClientPackageSubscribe();
                $clientPackageSubscribe->client_id = $client_id;
                $clientPackageSubscribe->vehicle_id = $vehicle_id;
                $clientPackageSubscribe->service_package_id = $service_package->id;
                $clientPackageSubscribe->garage_id = $garage_id;
                $clientPackageSubscribe->address = $clientLocation->address;
                $clientPackageSubscribe->latitude = $clientLocation->latitude;
                $clientPackageSubscribe->longitude = $clientLocation->longitude;
                $clientPackageSubscribe->city_id = $clientLocation->city_id;
                $clientPackageSubscribe->country_id = $clientLocation->country_id;
                $clientPackageSubscribe->pobox = $clientLocation->pobox;
                $clientPackageSubscribe->pobox = json_encode($subcategory_ids);

                $clientPackageSubscribe->status = 3; // pending...
                $clientPackageSubscribe->amount = $service_package->price;

                $clientPackageSubscribe->vip_pickup_opted = $vip_pickup_opted;
                $clientPackageSubscribe->vip_pickup_price = $vip_pickup_price;

                if ($clientPackageSubscribe->save()) {

                    $clientPackageSubscribePayment = new ClientPackageSubscribePayment();
                    $clientPackageSubscribePayment->client_package_subscribe_id = $clientPackageSubscribe->id;
                    $clientPackageSubscribePayment->amount = $service_package->price;
                    $clientPackageSubscribePayment->payment_type = $payment_type;
                    $clientPackageSubscribePayment->status = 3;
                    $clientPackageSubscribePayment->save();


                    $clientPackageSubscribeLog = new ClientPackageSubscribeLog();
                    $clientPackageSubscribeLog->client_package_subscribe_id = $clientPackageSubscribe->id;
                    $clientPackageSubscribeLog->description = 'Package Subscription requested!!! - Customer subscribe the package but Payment approval required by the Garage.';
                    $clientPackageSubscribeLog->save();

                    $responseData = array('success' => '1', 'message' => "Package Subscription Created Successfully! Thank you. We will get in touch with you shortly.");
                }
            } else {
                $responseData = array('success' => '0', 'message' => "Something went wrong. Please contact admin for further assistance.");

            }
        } else {
            $responseData = array('success' => '0', 'servicRequesteData' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    // Calculate distance between two place based on lat long....
    public function calculateDistanceBetweenTwoPoints($latitudeOne = '', $longitudeOne = '', $latitudeTwo = '', $longitudeTwo = '', $distanceUnit = '', $round = false, $decimalPoints = '')
    {
        if (empty($decimalPoints)) {
            $decimalPoints = '2';
        }
        if (empty($distanceUnit)) {
            $distanceUnit = 'KM';
        }
        $distanceUnit = strtolower($distanceUnit);
        $pointDifference = $longitudeOne - $longitudeTwo;
        $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
        $toAcos = acos($toSin);
        $toRad2Deg = rad2deg($toAcos);
        $toMiles = $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        return ($round == true ? round($toKilometers) : round($toKilometers, $decimalPoints));
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

        if (md5($settings['consumer_key']) == $consumer_data['consumer_key'] &&
            md5($settings['consumer_secret']) == $consumer_data['consumer_secret']
            && count($callExist) == 0) {
            DB::table('api_calls_list')
                ->insert([
                    'device_id' => $consumer_data['consumer_device_id'],
                    'nonce' => $consumer_data['consumer_nonce'],
                    'url' => $consumer_data['consumer_url'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
            return '1';
        } else {
            return '1';
            if ($record_count >= 1000 && $time_taken <= 60) {
                DB::table('http_call_record')->where('url', $consumer_data['consumer_url'])->where('ip', $ip)->delete();

                DB::table('block_ips')
                    ->insert([
                        'ip' => $ip,
                        'device_id' => $device_id,
                        'created_at' => Carbon::now()
                    ]);
                return '0';
            } else {
                return '0';
            }
        }
    }
}
