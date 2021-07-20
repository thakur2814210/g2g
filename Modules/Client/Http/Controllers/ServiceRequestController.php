<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Auth;
use App\User;
use App\Vehicle;
use App\Section;
use App\Garage;
use App\Client;
use App\GarageService;
use App\ClientLocation;

use App\ServicePackage;
use App\ClientPackageSubscribe;
use App\VehicleMake;
use App\VehicleModel;
use App\City;
use App\Country;

use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ServiceRequestLog;
use App\Models\Core\Setting;


use DB;
use App\Models\Autoshop\Index;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Autoshop\AlertController;

class ServiceRequestController extends Controller
{

     public function __construct(Index $index){
      $this->index = $index;
      $this->theme = new \App\Http\Controllers\Website\ThemeController();
    }


  

    public function index()
    {	
        
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $client = Client::where('user_id', Auth::user()->id)->first();

        $serviceRequests = ServiceRequest::where('client_id', $client->id)
                        ->orderBy('updated_at','desc')
                        ->with('category' , 'garage')
                        ->get();
        $data['serviceRequests'] =  $serviceRequests;
        return view('client::service-request.index', $data)->with('result', $result);
    }

   public function logs($id){
        if(!empty($id)){

            $final_theme = $this->theme->theme();
            $result = array();
            $result['commonContent'] = $this->index->commonContent();

            $serviceRequest = ServiceRequest::where('id' , $id)->with('client')->first();
            if(!empty($serviceRequest)){
                $data['sr'] = $serviceRequest;
                $data['logs'] = ServiceRequestLog::where('service_request_id' , $id)->get();
                return view('client::service-request.logs', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

     public function settings($id){
        if(!empty($id)){

            $final_theme = $this->theme->theme();
            $result = array();
            $result['commonContent'] = $this->index->commonContent();

            $serviceRequest = ServiceRequest::where('id' , $id)->with('client','category','vehicle')->first();
            if(!empty($serviceRequest)){
                $data['sr'] = $serviceRequest;
                $data['sr_payment'] = ServiceRequestPayment::where('service_request_id', $id)->first();
                return view('client::service-request.setting', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    // Show service request booking confirmation...
    public function bookingConfrimed(){

        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        return view('client::service-request.booking-confimation',['final_theme' => $final_theme])->with('result', $result);
    }


     // TODO update logs...
    public function makeServiceRequestLog($service_request_id , $log){
       
        $serviceRequestLog = new ServiceRequestLog();
        $serviceRequestLog->service_request_id = $service_request_id;
        $serviceRequestLog->description = $log;
        $serviceRequestLog->save();

    }

    
    // Show page for creating service request based on Category...
    public function category($slug)
    {

        $data = [];
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;

        $setting = new Setting();
        $getSettings = $setting->getSettings();

        //echo'<pre>';print_r($getSettings);die();

        $vip_pickup_enabled = $getSettings[126]->value;
        $vip_pickup_amount = $getSettings[127]->value;

        if(!empty($slug)){
            $cat_slug = $slug;

            $subCats = $mainCats = [];
            $categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
                        ->select('sections_description.sections_name as name','sections_description.sections_id' ,'sections.parent', 'sections.id')
                        ->where('sections_description.language_id', $language_id)
                        ->where('status', 1)->get();
            if(!$categories->isEmpty()){
                $categories = $categories->toArray();
                foreach ($categories as $cat) {
                    if($cat['parent'] == 0){
                        $mainCats[$cat['id']] =  $cat;
                    }else{
                         $subCats[$cat['parent']][] = $cat;
                    }
                }
            }
            $catList = [
                'mainCats' => $mainCats,
                'subCats' => $subCats,
            ];

            $categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
                ->select('sections_description.sections_name as name', 'sections.id', 'sections.parent')
                ->where('sections_description.language_id', $language_id)
                ->where('slug', $slug)
                ->first();
                
            //Section::where('status', 1)->where('slug', $slug)->first();
            $client = Client::where('user_id' , Auth::user()->id)->first();
            if(is_null($client)){
                return view('client::error' , ['final_theme' => $final_theme,'message' =>'Users does not have permission to view this page. !!!' ])->with('result', $result);
            }

            if(!empty($categories) && !empty($client)){
               
                $vehicles = Vehicle::where('client_id' , $client->id)->where('status' ,1)->get();
                $c_locations = ClientLocation::active()->where('client_id' , $client->id)->get();
                $vehicle_makes = VehicleMake::active()->get();
                
                $allCitiesList = City::active()->get();
                foreach ($allCitiesList as $value){
                    if($language_id == 2){
                        $value['name'] =  $value['name_ar'];
                    }else{
                         $value['name'] =  $value['name'];
                    }
                   $cities[$value['id']] = $value;
                }
                $allCitiesList = Country::active()->get();
                foreach ($allCitiesList as $value){
                    if($language_id == 2){
                        $value['name'] =  $value['name_ar'];
                    }else{
                        $value['name'] =  $value['name'];
                    }
                   $countries[$value['id']] = $value;
                }

                return view('client::service-request.create-service-request', [
                    'final_theme' => $final_theme,
                    'categories' => $categories,
                     'catList' => $catList,
                    'cat_slug' => $cat_slug,
                    'vehicles' => $vehicles,
                    'c_locations' => $c_locations,
                    'vehicle_makes' => $vehicle_makes,
                    'cities' => $cities,
                    'countries' => $countries,
                    'client' => $client,
                    'vip_pickup_enabled' => $vip_pickup_enabled,
                    'vip_pickup_amount' => $vip_pickup_amount

                ])->with('result', $result);
            }
        }
        
        return view('client::error' , ['final_theme' => $final_theme,'message' =>'Category does not exist !!!' ])->with('result', $result);
    }

     // Create service request...
    public function save(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'garage_id'  => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'pobox' => 'required',
            'faults_remarks' => 'required',
            'vehicle_id' => 'required',
            'sevices' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }


        $slug = $request->cat_id;
        $client = Client::where('user_id',auth()->user()->id )->firstOrFail();
        $category = Section::where('status', 1)->where('slug', $slug)->firstOrFail();
        if(!empty($category) ){

            $cat_id = $category->id;

            // check if already any package is active for the same
            /*$is_allowed = ServiceRequest::where('vehicle_id',$request->vehicle_id )
                                                ->where('cat_id' , $cat_id)
                                                 ->where('client_id' , Auth::user()->id)
                                                 ->whereNotIn('status' ,['completed','cancel'])
                                                 ->first();*/
            $is_allowed = null;
            if(is_null($is_allowed)){
                $sr_images = [];
                $image_str = null;
                $imgLocations = 'assets/uploads/service-request';
                $image_arr = ['nsr_info_file_1','nsr_info_file_2'];
                foreach ($image_arr as $image_name) {
                    if ($request->hasFile($image_name)) {
                        $f_image = $request->file($image_name);
                        if(!empty($f_image)){
                            $imageName = 'sr-'.time().'.'.$f_image->getClientOriginalExtension();
                            $f_image->move($imgLocations , $imageName);
                            $sr_images[] = $imageName;
                        }
                    }
                }
                if(count($sr_images) > 0){
                    $image_str = implode(',', $sr_images);
                }   

                $serviceRequest = new ServiceRequest();
                $serviceRequest->sr_code = time();
                $serviceRequest->cat_id = $cat_id;
                $serviceRequest->client_id = $client->id;
                $serviceRequest->vehicle_id = $request->vehicle_id;
                $serviceRequest->garage_id = $request->garage_id;
                $serviceRequest->address = $request->address;
                $serviceRequest->latitude = $request->latitude;
                $serviceRequest->longitude = $request->longitude;
                $serviceRequest->city = $request->city;
                $serviceRequest->country = $request->country;
                $serviceRequest->status = 'new';
                $serviceRequest->section_ids = is_array($request->sevices) ? implode(',' , $request->sevices) : $request->sevices;
                $serviceRequest->pobox = $request->pobox;
                $serviceRequest->faults_remarks = $request->faults_remarks;
                $serviceRequest->image = $image_str;
                $serviceRequest->vip_pickup_opted = $request->vip_pickup_opted;
                $serviceRequest->vip_pickup_price = $request->vip_pickup_price;
                $serviceRequest->appointment_at = (!empty($request->appointment_at)) ? date('Y-m-d H:i:s', strtotime($request->appointment_at)) : null;
                if( $serviceRequest->save()){
                    
                    // Send Mail to Admin and Garage without customer identity.
                    //$myVar = new AlertController();
                    //$alertSetting = $myVar->sendCreateMailNotification($serviceRequest);
                    
                    // make log entry
                    $this->makeServiceRequestLog( $serviceRequest->id, 'SERVICE REQUEST CREATED. Your service request has been created, please wait for the garage to get back with the quotation.');
                    
                    // successfully created and show user confrimed message
                    return  redirect()->route('client.service-request.booking-confimation');
                }
            }else{
                return  redirect()->back()->with('status', 'Already Exist!!! - A service request is already exist in this category for this vehicle. Please visit dashboard for more information.');
            }
            
            
        }
        return  redirect()->back()->with('error', 'Something went wrong. Cannot save data.');
    }

    

    // Customer Payment - COD
    public function updatePaymentStatus(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'payment_type' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $id = $request->id;
        $serviceRequest = ServiceRequest::where('id' , $id)->first();
        if(!empty($serviceRequest)){

            // update service request status
            ServiceRequest::where('id', '=', $id)->update(['status' => 'received-payment' ]);

             //upadte payment status
            ServiceRequestPayment::where('service_request_id', '=', $id)->update(['payment_type' => $request->payment_type , 'status' => 1 ]);

             // TODO update logs...
            $this->makeServiceRequestLog( $id, 'PAYMENT DONE!!! - Customer paid the garage requested quote amount.');
         
            return \Redirect::back()->with('status', 'Package payment status updated successfully');
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    
    public function getGarageByService(Request $request){
        $category_ids = [];
        $category_checkbox = $request->category_checkbox;
        if(!empty($category_checkbox)){
            $category_ids = explode(',', $category_checkbox);
       
            $data = [];
            $data['garages'] = Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                            ->select('garages.*')
                            ->where(function($query) use($category_ids) {
                                foreach($category_ids as $cf){
                                    return $query->whereRaw("FIND_IN_SET($cf,garage_services.cat_id)")
                                            ->orWhereRaw("FIND_IN_SET($cf,garage_services.sub_cat_id)");
                                }
                            })
                            ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                            ->get();

            $view  = (string)\View::make('client::service-request.includes.garage-list',$data);
            return response()->json(['html' => $view]);
        }
        return response()->json(['html' => '<p>Please select atleast one service</p>']);
    }



    

    public function getGarageByLatLong( Request $request){

        $s_latitude = $request->latitude;
        $s_longitude = $request->longitude;
        $cat_slug = $request->category;
        $s_city_id = $request->city_id;
        $s_country_id = $request->country_id;
        $s_distance = $request->distance;
         $language_id = $request->language_id;

        $category = Section::where('status', 1)->where('slug', $cat_slug)->first();
        if(is_null($category)){
            return response()->json(['html' => Lang::get("website.Mandatory field is missing")]);
        }else{
            $s_category = $category->id;
        }

        if(!empty($s_latitude) && !empty($s_longitude)){
            
             $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->join('garages_description' , function($query) use ($language_id){
                            $query->on( 'garages_description.garages_id', '=' ,'garages.id')
                            ->where('garages_description.language_id', 1);
                        })
                        ->join('cities', 'cities.id', 'garages.city_id')
                        ->join('countries', 'countries.id', 'garages.country_id')
                        ->select('garages.id' ,'garages.address','garages.postal as pobox' ,'garages_description.garages_name as name' 
                                    ,'garages.latitude', 'garages.longitude', 'cities.name as city_name', 'cities.name_ar as city_name_ar' , 'countries.name as country_name', 'countries.name_ar as country_name_ar' )
                       ->where(function($query) use($s_category , $cat_slug) {
                            if($cat_slug != 'custom-request')
                                return $query->whereRaw("FIND_IN_SET($s_category,garage_services.cat_id)")
                                        ->orWhereRaw("FIND_IN_SET($s_category,garage_services.sub_cat_id)");
                            
                        })->where('garages.city_id', $s_city_id)
                        ->where('garages.country_id', $s_country_id)
                        ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                        ->get();

             
             //dd($garages);
             if(!empty($garages) && count($garages) > 0){

                foreach($garages as $key => $garage){
                    $g_latitude = $garage->latitude; 
                    $g_longitude = $garage->longitude; 

                    $distanceInKm = $this->calculateDistanceBetweenTwoPoints( $s_latitude, $s_longitude , $g_latitude,$g_longitude);
                    //echo $distanceInKm . '-----';
                    if(round($distanceInKm,2) > round($s_distance,2)){
                        $garages->forget($key);
                    }
                }
            }
            $data['garages'] = $garages;
            $view  = (string)\View::make('client::service-request.includes.garage-list',$data);
            return response()->json(['html' => $view]);

        }
        //return response()->json(['html' => Lang::get("website.Mandatory field is missing")]);
        return response()->json(['html' => Lang::get("website.no_garage_found_by_cat")]);
    }



    // Calculate distance between two place based on lat long....
    public function calculateDistanceBetweenTwoPoints($latitudeOne='', $longitudeOne='', $latitudeTwo='', $longitudeTwo='',$distanceUnit ='',$round=false,$decimalPoints='')
    {
        if (empty($decimalPoints)){
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
        $toMiles  =  $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        return ($round == true ? round($toKilometers) : round($toKilometers, $decimalPoints));
    }

    // get bvehicles model based on vehicle make id
    public function getModels($id){
        $models = VehicleModel::where("vehicle_make_id",$id)->pluck("name","id");
        return json_encode($models);
    }


   

   

}
