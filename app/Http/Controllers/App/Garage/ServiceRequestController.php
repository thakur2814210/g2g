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
use App\VehicleMake;
use App\VehicleModel;
use App\City;
use App\Country;
use App\Section;
use App\Vehicle;
use App\GarageService;
use App\ClientLocation;
use App\Garage;

use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ServiceRequestLog;
use App\Client;

use App\Http\Controllers\App\AlertController;

class ServiceRequestController extends Controller
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


    public function allservicerequests(Request $request)
    {
        $language_id = $request->language_id;
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $item = DB::table('sections')
                ->leftJoin('sections_description', 'sections_description.sections_id', '=', 'sections.id')
                ->select('sections.id', 'sections.parent', 'sections.type', 'sections.app_icon as image', 'sections.created_at as date_added', 'sections.updated_at as last_modified', 'sections_description.sections_name as name')
                ->where('sections_description.language_id', $language_id);

            $sections = $item->where('sections.status', '1')
                ->orderby('id', 'ASC')
                ->groupby('id')
                ->get();

            if (count($sections) > 0) {

                $items = array();
                $index = 0;
                foreach ($sections as $section) {
                    array_push($items, $section);
                }

                $responseData = array('success' => '1', 'data' => $items, 'message' => "Returned all serviceRequest.", 'serviceRequest' => count($sections));
            } else {
                $responseData = array('success' => '0', 'data' => array(), 'message' => "No serviceRequest found.", 'serviceRequest' => array());
            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
    }

    public function getServiceRequest1(Request $request)
    {
        $language_id = '1';
        if (empty($request->section_id)) {
            $section_id = '0';
        } else {
            $section_id = $request->section_id;
        }

        $getCategories = DB::table('sections')
            ->leftJoin('sections_description', 'sections_description.sections_id', '=', 'sections.id')
            ->select('sections.id', 'sections.cat_icon as image', 'sections.created_at as date_added', 'sections.updated_at as last_modified', 'sections_description.sections_name as name')
            ->where('parent', $section_id)->where('sections_description.language_id', $language_id)->get();
        return ($getCategories);
    }

    // get service request of single clinet
    public function getServiceRequest(Request $request)
    {

        $language_id = $request->language_id;
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

            $serviceRequests = ServiceRequest::where('client_id', $client_id)
                ->orderBy('updated_at', 'DESC')
                ->with('category', 'garage', 'vehicle')
                ->get();

            if (count($serviceRequests) > 0) {

                $responseData = array('success' => '1', 'data' => $serviceRequests, 'message' => "Returned all serviceRequest.");
            } else {
                $responseData = array('success' => '0', 'data' => array(), 'message' => "No serviceRequest found.");
            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
    }

    public function getSingleServiceRequests(Request $request)
    {

        $client_id = $this->getClientID($request->client_id);
        $service_request_id = $request->service_request_id;

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $serviceRequests = ServiceRequest::where('client_id', $client_id)
                ->where('id', $service_request_id)
                ->orderBy('updated_at', 'DESC')
                ->with('category', 'garage', 'vehicle')
                ->first();
            $data = [];


            $data['serviceRequest']['sr_code'] = $serviceRequests->sr_code;
            $data['serviceRequest']['id'] = $serviceRequests->id;
            $data['serviceRequest']['faults_remarks'] = $serviceRequests->faults_remarks;
            $data['serviceRequest']['appointment_at'] = $serviceRequests->appointment_at;
            $data['serviceRequest']['updated_at'] = $serviceRequests->updated_at;
            $data['serviceRequest']['created_at'] = $serviceRequests->created_at;
            $data['serviceRequest']['vehicle'] = $serviceRequests->vehicle->plate_no;
            $data['serviceRequest']['status'] = $serviceRequests->status;
            $data['serviceRequest']['quote_amount'] = $serviceRequests->quote_amount;
            $data['serviceRequest']['amount_json'] = $serviceRequests->amount_json;
            $data['serviceRequest']['address'] = $serviceRequests->address;
            $data['serviceRequest']['city'] = $serviceRequests->city;
            $data['serviceRequest']['pobox'] = $serviceRequests->pobox;
            $data['serviceRequest']['country'] = $serviceRequests->country;
            $data['serviceRequest']['latitude'] = $serviceRequests->latitude;
            $data['serviceRequest']['longitude'] = $serviceRequests->longitude;
            $data['serviceRequest']['vip_pickup_opted'] = $serviceRequests->vip_pickup_opted;
            $data['serviceRequest']['vip_pickup_price'] = $serviceRequests->vip_pickup_price;

            $garage = Garage::query()
                ->join('garages_description', 'garages_description.garages_id', 'garages.id')
                ->select('garages_description.garages_name as name', 'garages.user_id')
                ->where('garages_description.language_id', 1)
                ->where('garages.id', $serviceRequests->garage_id)->first();

            $data['serviceRequest']['garage_name'] = $garage->name;

            $userInfo = DB::table('users')
                ->where('id', $garage->user_id)
                ->first();


            $data['serviceRequest']['garage_email'] = $userInfo->email;
            $data['serviceRequest']['garage_phone'] = $userInfo->phone;

            $section = DB::table('sections')
                ->leftJoin('sections_description', 'sections_description.sections_id', '=', 'sections.id')
                ->select('sections_description.sections_name as name')
                ->where('sections_description.language_id', 1)
                ->where('sections.id', $serviceRequests->category->id)
                ->first();
            $data['serviceRequest']['category'] = $section->name;

            $payment = ServiceRequestPayment::where('service_request_id', $service_request_id)->first();
            if (!empty($payment)) {
                $data['serviceRequestsPayment']['id'] = $payment['id'];
                $data['serviceRequestsPayment']['service_request_id'] = $payment['service_request_id'];
                $data['serviceRequestsPayment']['date'] = $payment['date'];
                $data['serviceRequestsPayment']['amount'] = $payment['amount'];
                $data['serviceRequestsPayment']['status'] = $payment['status'];
                $data['serviceRequestsPayment']['payment_type'] = $payment['payment_type'];
            } else {
                $data['serviceRequestsPayment']['id'] = null;
                $data['serviceRequestsPayment']['service_request_id'] = '';
                $data['serviceRequestsPayment']['date'] = '';
                $data['serviceRequestsPayment']['amount'] = '';
                $data['serviceRequestsPayment']['status'] = '';
                $data['serviceRequestsPayment']['payment_type'] = '';
            }

            if (count($data) > 0) {

                $responseData = array('success' => '1', 'data' => $data, 'message' => "Returned all serviceRequest.");
            } else {
                $responseData = array('success' => '0', 'data' => array(), 'message' => "No serviceRequest found.");
            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
    }

    public function getServiceRequestLog(Request $request)
    {

        $client_id = $this->getClientID($request->client_id);
        $service_request_log = $request->service_request_log;

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $serviceRequests = ServiceRequestLog::where('service_request_id', $service_request_log)
                ->orderBy('date', 'DESC')
                ->get();

            if (count($serviceRequests) > 0) {

                $responseData = array('success' => '1', 'data' => $serviceRequests, 'message' => "Returned all serviceRequest.");
            } else {
                $responseData = array('success' => '0', 'data' => array(), 'message' => "No serviceRequest found.");
            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
    }

    public function getServiceRequestData(Request $request)
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

                $data['categories'] = $category;

                $data['subcategories'] = $category = Section::with(['sectionsDescription' => function ($q) use ($language_id) {
                    return $q->where('language_id', $language_id);
                }])
                    ->where('parent', $category->id)
                    ->where('status', 1)
                    ->get();
                //dd($data['subcategories']);
                foreach ($data['subcategories'] as $sc) {
                    if (isset($sc->sectionsDescription[0]))
                        $sc->name = $sc->sectionsDescription[0]->sections_name;
                    else
                        $sc->name = 'Not Available';

                }


                $data['vehicles'] = Vehicle::where('client_id', $client_id)->where('status', 1)->get();
                // $data['locations'] = ClientLocation::where('client_id' , $client_id)->get();
                $data['locations'] = DB::table('client_locations')
                    ->leftjoin('countries', 'countries.id', 'client_locations.country_id')
                    ->leftjoin('cities', 'cities.id', 'client_locations.city_id')
                    ->select('client_locations.id', 'client_locations.address', 'client_locations.pobox as postcode', 'countries.name as country', 'cities.name as city', 'client_locations.longitude', 'client_locations.latitude')
                    ->where('client_id', $client_id)->where('client_locations.status', '=', 'Active')->get();

                $setting = new Setting();
                $getSettings = $setting->getSettings();

                $data['vip_pickup_enabled'] = $getSettings[126]->value*1;
                $data['vip_pickup_amount'] = $getSettings[127]->value*1;

                $responseData = array('success' => '1', 'servicRequesteData' => $data, 'message' => "Returned all vehicle and location.");
            } else {
                $responseData = array('success' => '0', 'servicRequesteData' => $data, 'message' => "Empty records.");
            }

        } else {
            $responseData = array('success' => '0', 'servicRequesteData' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }


    public function getServiceRequestByGarage(Request $request)
    {

        $language_id = $request->language_id;

        $client_id = $this->getClientID($request->client_id);
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
            $data['categories'] = Section::join('sections_description', 'sections_description.sections_id', 'sections.id')
                ->where('sections.status', 1)
                ->where('sections.type', 1)
                ->where('sections.parent', 0)
                ->select('sections.id', 'sections_description.sections_name as name')
                ->where('sections_description.language_id', $language_id)
                ->get();
            $data['vehicles'] = Vehicle::where('client_id', $client_id)->where('status', 1)->get();
            $data['locations'] = ClientLocation::active()->where('client_id', $client_id)->get();
            $responseData = array('success' => '1', 'servicRequesteData' => $data, 'message' => "Returned all vehicle and location.");

        } else {
            $responseData = array('success' => '0', 'servicRequesteData' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function updateServiceRequestPayment(Request $request)
    {

        $id = $request->service_request_id;
        $payment_type = $request->payment_type;

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            ServiceRequest::where('id', $id)->update(['status' => 'received-payment']);
            ServiceRequestPayment::where('service_request_id', $id)->update(['payment_type' =>
                $payment_type, 'status' => 1]);

            $serviceRequestLog = new ServiceRequestLog();
            $serviceRequestLog->service_request_id = $id;
            $serviceRequestLog->description = 'PAYMENT DONE!!! - Customer paid the garage requested quote amount.';
            $serviceRequestLog->save();

            $serviceRequest = ServiceRequest::where('id', $id)->first();
            $alertCont = new AlertController();
            $alertCont->customerAcceptPriceAlert($serviceRequest);

            $responseData = array('success' => '1', 'data' => array(), 'message' => "Service request payment status updated successfully.");

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function getGarageByLocation(Request $request)
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


            $s_city_id = [];
            if ($client_location_id > 0) {
                $clientLocation = ClientLocation::where('id', $client_location_id)
                    ->where('client_id', $client_id)->first();
                $s_latitude = $clientLocation->latitude;
                $s_longitude = $clientLocation->longitude;
                $s_city_id[] = $clientLocation->city_id;

            } else {
                $s_latitude = $request->client_latitude;
                $s_longitude = $request->client_longitude;
                $s_city_id = City::get()->pluck('id');
            }
            $s_country_id = 1;


            $category = Section::where('status', 1)->where('id', $section_id)->first();
            $s_category = $category->id;
            $cat_slug = $category->slug;

            if (!empty($s_latitude) && !empty($s_longitude)) {


                $garages = Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                    ->join('garages_description', 'garages_description.garages_id', '=', 'garages.id')
                    ->leftjoin('countries', 'countries.id', 'garages.country_id')
                    ->leftjoin('cities', 'cities.id', 'garages.city_id')
                    ->select('garages.*', 'garages_description.garages_name as garages_name', 'cities.name as city_name', 'countries.name as country_name')
                    ->where(function ($query) use ($s_category, $cat_slug) {
                        if ($cat_slug != 'custom-request')
                            return $query->whereRaw("FIND_IN_SET($s_category,garage_services.cat_id)")
                                ->orWhereRaw("FIND_IN_SET($s_category,garage_services.sub_cat_id)");

                    })
                    ->where('garages_description.language_id', $language_id)
                    ->whereIn('garages.city_id', $s_city_id)
                    ->where('garages.country_id', $s_country_id)
                    ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                    ->get()->toArray();

                //   dd($garages);
                $final_garage_list = [];
                if (!empty($garages) && count($garages) > 0) {

                    foreach ($garages as $key => $garage) {
                        $g_latitude = $garage['latitude'];
                        $g_longitude = $garage['longitude'];

                        $distanceInKm = $this->calculateDistanceBetweenTwoPoints($s_latitude, $s_longitude, $g_latitude, $g_longitude);

                        // 5 5> s_min 5 < s_max
                        if ($s_distance == '50+') {
                            if (round($distanceInKm, 2) > round($s_distance, 2)) {
                                $final_garage_list[] = $garage;
                            }
                        } else {
                            if (round($distanceInKm, 2) <= round($s_distance, 2)) {
                                $final_garage_list[] = $garage;
                            }
                        }

                    }
                    $responseData = array('success' => '1', 'data' => $final_garage_list, 'message' => "Returned all garges.");
                } else {
                    $responseData = array('success' => '3', 'data' => $garages, 'message' => "No Garage Found In Specified Distance.");
                }


            } else {
                $responseData = array('success' => '2', 'data' => array(), 'message' => "Client Location undefined.");
            }

        } else {
            $responseData = array('success' => '0', 'servicRequesteData' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function createServiceRequest(Request $request)
    {

        $setting = new Setting();
        $getSettings = $setting->getSettings();

        //dd($_FILES);
        $client_id = $this->getClientID($request->client_id);
        $section_id = $request->section_id;
        $vehicle_id = $request->vehicle_id;
        $client_location_id = $request->client_location_id;
        $faults_remarks = $request->faults_remarks;
        $subcategory_ids = $request->subcategory_ids;
        $garage_id = $request->garage_id;
        $appointment_at = $request->appointment_at;
        $imageId = $request->imageId;
        $image1 = $image2 = $image3 = $image4 = $image5 = null;
        $imageFile = [];
        $videoFile = null;
        $client_latitude = $request->client_latitude;
        $client_longitude = $request->client_longitude;
        $client_current_address = $request->client_current_address;
        if(isset($request->vip_pickup_opted) && $request->vip_pickup_opted==1){
            $vip_pickup_opted = $request->vip_pickup_opted;
            $vip_pickup_price = $getSettings[127]->value*1;
        } else {
            $vip_pickup_opted = 0;
            $vip_pickup_price = '';
        }

        $data = $responseData = [];

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {


            if ($client_location_id > 0) {
                $clientLocation = ClientLocation::where('id', $client_location_id)->where('client_id', $client_id)->first();
            }


            $category = Section::where('status', 1)->where('id', $section_id)->first();
            if (!empty($category)) {

                if (!empty($imageId)) {
                    $service_request_files = \DB::table('service_request_files')->where('imageId', $imageId)->first();
                    if ($service_request_files) {
                        $image1 = $service_request_files->image1;
                        $image2 = $service_request_files->image2;
                        $image3 = $service_request_files->image3;
                        $image4 = $service_request_files->image4;
                        $image5 = $service_request_files->image5;
                    }

                }


                $cat_id = $category->id;
                $serviceRequest = new ServiceRequest();
                $serviceRequest->sr_code = time();
                $serviceRequest->cat_id = $cat_id;
                $serviceRequest->client_id = $client_id;
                $serviceRequest->vehicle_id = $request->vehicle_id;
                $serviceRequest->garage_id = $request->garage_id;


                if ($client_location_id > 0) {
                    $serviceRequest->address = $clientLocation->address;
                    $serviceRequest->latitude = $clientLocation->latitude;
                    $serviceRequest->longitude = $clientLocation->longitude;
                    $serviceRequest->city = $clientLocation->city_id;
                    $serviceRequest->pobox = $clientLocation->pobox;
                } else {
                    $serviceRequest->address = $client_current_address;
                    $serviceRequest->latitude = $client_latitude;
                    $serviceRequest->longitude = $client_longitude;
                    $serviceRequest->city = 8;
                    $serviceRequest->pobox = null;
                }


                $serviceRequest->country = 1;
                $serviceRequest->status = 'new';

                $serviceRequest->faults_remarks = $request->faults_remarks;
                $serviceRequest->section_ids = json_encode($subcategory_ids);

                $serviceRequest->image1 = $image1;
                $serviceRequest->image2 = $image2;
                $serviceRequest->image3 = $image3;
                $serviceRequest->image4 = $image4;
                $serviceRequest->image5 = $image5;

                $serviceRequest->appointment_at = !empty($appointment_at) ? $appointment_at : null;
                $serviceRequest->vip_pickup_opted = $vip_pickup_opted;
                $serviceRequest->vip_pickup_price = $vip_pickup_price;
                if ($serviceRequest->save()) {

                    $serviceRequestLog = new ServiceRequestLog();
                    $serviceRequestLog->service_request_id = $serviceRequest->id;
                    $serviceRequestLog->description = 'SERVICE REQUEST CREATED. Your service request has been created, please wait for the garage to get back with the quotation.';
                    $serviceRequestLog->save();


                    $alertCont = new AlertController();
                    $alertCont->garageServiceAlert($serviceRequest);

                    $responseData = array('success' => '1', 'message' => "Service Request Created Successfully! Thank you. We will get in touch with you shortly.");
                } else {
                    $responseData = array('success' => '0', 'message' => "Something went wrong. Please contact admin for further assistance.");
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

    public function uploadServiceRequestFiles(Request $request)
    {

        /*	$data = $responseData = [];

            if(isset($_FILES['file'])){
                $newFileName = uniqid().'_'.$_FILES['file']['name'];
                $tmpFilePath = $_FILES['file']['tmp_name'];
                $image1 = "./uploads/service-request/" .$newFileName ;
                move_uploaded_file($tmpFilePath, $image1);

                 $service_request_files_id = \DB::table('service_request_files')->insertGetId([
                    'image1' => $image1,
                    'image2' => $image2,
                    'image3' => $image3,
                    'image4' => $image4,
                    'image5' => $image5,
                    'imageId' => time()

                    ]);
                 $service_request_files = \DB::table('service_request_files')->where('id', $service_request_files_id)->first();
                 $responseData = array('success' => '1', 'data' => $service_request_files, 'message' => "Upload files successfuly.");

            }else{
                $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
            }

            $categoryResponse = json_encode($responseData);
            print $categoryResponse;
            */

        $image1 = $image2 = $image3 = $image4 = $image5 = null;
        $imageFile = null;
        $imageId = $request->imageId;
        $index = $request->index;
        $data = $responseData = [];

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {

            if (!empty($imageId) && !empty($index) && isset($_FILES['file'])) {

                $newFileName = uniqid() . '.jpg';
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $tmpFilePath = $_FILES['file']['tmp_name'];
                $imageFile = "/uploads/service-request/" . $newFileName;
                $imageFile1 = "./uploads/service-request/" . $newFileName;

                move_uploaded_file($tmpFilePath, $imageFile1);

                // check if exist imageId
                $service_request_files = \DB::table('service_request_files')->where('imageId', $imageId)->first();
                if ($service_request_files) {
                    if ($index == 1) $conditions = ['image1' => $imageFile];
                    if ($index == 2) $conditions = ['image2' => $imageFile];
                    if ($index == 3) $conditions = ['image3' => $imageFile];
                    if ($index == 4) $conditions = ['image4' => $imageFile];
                    if ($index == 5) $conditions = ['image5' => $imageFile];
                    DB::table('service_request_files')->where('imageId', $imageId)->update($conditions);
                    $service_request_files_id = $service_request_files->id;

                } else {
                    // insert
                    if ($index == 1) $image1 = $imageFile;
                    if ($index == 2) $image2 = $imageFile;
                    if ($index == 3) $image3 = $imageFile;
                    if ($index == 4) $image4 = $imageFile;
                    if ($index == 5) $image5 = $imageFile;
                    $service_request_files_id = \DB::table('service_request_files')->insertGetId([
                        'image1' => $image1,
                        'image2' => $image2,
                        'image3' => $image3,
                        'image4' => $image4,
                        'image5' => $image5,
                        'imageId' => $imageId
                    ]);
                }
                $service_request_files = \DB::table('service_request_files')->where('id', $service_request_files_id)->first();
                $responseData = array('success' => '1', 'data' => $service_request_files, 'message' => "Upload files successfuly.");
            } else {
                $responseData = array('success' => '0', 'servicRequesteData' => array(), 'message' => "Soomething went wrong, please try again.");
            }
        } else {
            $responseData = array('success' => '0', 'servicRequesteData' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function removeUploadServiceRequestFiles(Request $request)
    {

        $imageId = $request->imageId;
        $index = $request->index;
        $data = $responseData = [];

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);
        if ($authenticate == 1 && !empty($imageId) && !empty($index)) {
            // check if exist imageId
            $service_request_files = \DB::table('service_request_files')->where('imageId', $imageId)->first();
            if ($service_request_files) {
                if ($index == 1) {
                    $imageFile = $service_request_files->image1;
                    $conditions = ['image1' => null];
                }
                if ($index == 2) {
                    $imageFile = $service_request_files->image2;
                    $conditions = ['image2' => null];
                }
                if ($index == 3) {
                    $imageFile = $service_request_files->image3;
                    $conditions = ['image3' => null];
                }
                if ($index == 4) {
                    $imageFile = $service_request_files->image4;
                    $conditions = ['image4' => null];
                }
                if ($index == 5) {
                    $imageFile = $service_request_files->image5;
                    $conditions = ['image5' => null];
                }

                if (!empty($imageFile) && file_exists($imageFile)) {
                    unlink($imageFile);
                }
                DB::table('service_request_files')->where('imageId', $imageId)->update($conditions);
                $responseData = array('success' => '1', 'servicRequesteData' => $service_request_files, 'message' => "Image deleted successfully.");
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
