<?php

namespace Modules\Client\Http\Controllers;

use App\Models\Core\Setting;
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
use App\VehicleMake;
use App\VehicleModel;

use App\City;
use App\Country;
use App\ClientLocation;

use App\ServicePackage;
use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;
use App\Http\Controllers\Autoshop\AlertController;

use DB;
use App\Models\Autoshop\Index;
use Illuminate\Support\Facades\Lang;

class PackageController extends Controller
{

    public function __construct(Index $index){
      $this->index = $index;
      $this->theme = new \App\Http\Controllers\Website\ThemeController();
    }



    public function getPackageSubscribeStatusName($key){
        $arr =  [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending', 
            '4' => 'Inactive',
            '5' => 'Request-Payemnt', 
            '6' => 'Received-Payment',
            '7' => 'Required-Payment-Approval' 
        ];

        return $arr[$key];
    }

    public function getPackageSubscribeStatusArr(){
       return  [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending', 
            '4' => 'Inactive',
            '5' => 'Request-Payemnt', 
            '6' => 'Received-Payment',
            '7' => 'Required-Payment-Approval' 
        ];
    }

     public function getPackagePaymentStatusName($key){
        $arr =  [
            '1' => 'Success',
            '2' => 'Failed',
            '3' => 'Pending', 
            '4' => 'Required-Payment-Approval' 
        ];

        return $arr[$key];
    }

    public function getPackagePaymentStatusArr(){
       return  [
            '1' => 'Success',
            '2' => 'Failed',
            '3' => 'Pending', 
            '4' => 'Required-Payment-Approval' 
        ];
    }


    public function index(){

        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $client = Client::where('user_id', Auth::user()->id)->first();
        
        $data['packages'] = ClientPackageSubscribe::where('client_id', $client->id)
                                ->orderBy('updated_at', 'desc')
                                ->with('servicePackage','garage','vehicle')
                                ->get();
        $data['packageStatus'] = $this->getPackageSubscribeStatusArr();
        return view('client::package.index' , $data);
    }

    public function logs($id){
        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->with('client')->first();
            if(!empty($clientPackageSubscribe)){
                $data['clientPackageSubscribe'] = $clientPackageSubscribe;
                $data['logs'] = ClientPackageSubscribeLog::where('client_package_subscribe_id' , $id)->get();
                return view('client::package.logs', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function settings($id){
        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->with('servicePackage','garage','vehicle')->first();
            if(!empty($clientPackageSubscribe)){
                $data['clientPackageSubscribe'] = $clientPackageSubscribe;
                $data['packageStatus'] = $this->getPackageSubscribeStatusName($clientPackageSubscribe->status);
                $data['clientPackageSubscribePayment'] = ClientPackageSubscribePayment::where('client_package_subscribe_id', $id)->first();
                $data['paymentStatus'] = $this->getPackagePaymentStatusName($data['clientPackageSubscribePayment']->status);
                return view('client::package.setting', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function bookingConfrimed(){

        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        return view('client::package.booking-confimation',['final_theme' => $final_theme])->with('result', $result);
    }

    public function create($slug){
        $data = [];

        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $setting = new Setting();
        $getSettings = $setting->getSettings();

        $vip_pickup_enabled = $getSettings[126]->value;
        $vip_pickup_amount = $getSettings[127]->value;


        if(!empty($slug)){
            $cat_slug = $slug;

            if($slug == 'custom-package'){
                return $this->customPackage();
            }else{

                $categories = Section::where('status', 1)->where('slug', $slug)->first();
                $client = Client::where('user_id' , Auth::user()->id)->first();

                if(!empty($categories)){
                    
                    $packages = ServicePackage::active()
                                ->where('section_id' , $categories->id)
                                ->with('packageFeatures','section')
                                ->get();
                   
                    if(empty($packages) || $packages->count() == 0){
                       return  redirect()->back()->with('status', "No Package Exist!!! - We don't have any packages in that category, so nothing is displayed. Please contact admin for further assistance.");
                    }

                    $vehicles = Vehicle::where('client_id' , $client->id)->where('status' ,1)->get();
                    $vehicle_makes = VehicleMake::active()->get();
                    $cities = City::active()->get();
                    $countries = Country::active()->get();
                    $c_locations = ClientLocation::active()->where('client_id' , $client->id)->get();

                   
                    return view('client::package.add-package', [
                        'final_theme' => $final_theme,
                        'categories' => $categories,
                        'cat_slug' => $cat_slug,
                        'vehicles' => $vehicles,
                        'c_locations' => $c_locations,
                        'vehicle_makes' => $vehicle_makes,
                        'cities' => $cities,
                        'countries' => $countries,
                        'client' => $client,
                        'packages' => $packages,
                        'vip_pickup_enabled' => $vip_pickup_enabled,
                        'vip_pickup_amount' => $vip_pickup_amount

                    ])->with('result', $result);
                }
            }
            
        }
        return view('client::error' , ['final_theme' => $final_theme,'message' =>'Package does not exist !!!' ])->with('result', $result);
    }

    public function isAlreadyPackageRunning($vehicle_id){

        $isAlreadyPackageRunning = ClientPackageSubscribe::where('vehicle_id',$vehicle_id )
                                                 ->where('client_id' , Auth::user()->id)
                                                 ->where('status' ,1)
                                                 ->first();
        if(!is_null($isAlreadyPackageRunning)){
            return response()->json(['html' => 'ERROR!!! - A package is already active for the vehicle. please visit dashboard for more information.']);
        }
       
        return response()->json(['html' => true]);   
    }
    
    public static function paymentByTelr(Request $request)
{
    
    
 
    
    $package_id = $request->requestPackage;
    $service_package = ServicePackage::where('id' , $package_id)->first();
    
    $cat_slug = $request->category;
    $language_id = $request->language_id;
    
    $client = $user = User::where('id', Auth::user()->id)->first();
    $location = \DB::table('client_locations')
                ->join('cities', 'cities.id', 'client_locations.city_id')
                ->join('countries', 'countries.id', 'client_locations.country_id')
                ->select('client_locations.pobox','client_locations.address', 'cities.name as city_name_en', 'cities.name_ar as city_name_ar', 'countries.name  as country_name_en', 'countries.name_ar as country_name_ar')
                ->where('client_locations.id', $request->location_id)->first();
   // dd($location);
    if($location){
        $billing_address_line1 = $location->address;
        $billing_address_line2 = null;
        $billing_address_line3 = null;
        $billing_address_city = $language_id == 1 ? $location->city_name_en : $location->city_name_ar;
        $billing_address_country = $language_id == 1 ? $location->country_name_en : $location->country_name_ar;
        $billing_address_region = null;
        $billing_address_pobox = $location->pobox;;
    }else{
        $billing_address_line1 = $billing_address_line2 = $billing_address_line3 = null;
        $billing_address_city = $billing_address_country =  $billing_address_region = $billing_address_pobox = null;
    }
    
   
    $store_id       = '23596';
    $auth_token     = 'ksHB^z8pGQ~NTPwJ';
    $device_type    = 'G2G Web';
    $device_uuid    = 'Online Web G2G';
    $app_name       = 'G2G';
    $app_version    = '1.0.0';
    $app_user       = $user->id;
    $app_id         = 'com.g2g.app';
    $cartid = 'cart_id'.time();
    $tran_description = $language_id == 1 ? $service_package->name : $service_package->name_ar;
    $tran_amount = $service_package->price;
        
    
    
   
    $url = "https://secure.innovatepayments.com/gateway/mobile.xml";
    $xml = '<?xml version="1.0" encoding="UTF-8"?>
    <mobile>
      <store>'.$store_id.'</store>
      <key>'.$auth_token.'</key> 
      <device>
        <type>'.$device_type.'</type>
        <id>'.$device_uuid.'</id>
      </device>
      <app>
        <name>'.$app_name.'</name>
        <version>'.$app_version.'</version>
        <user>'.$app_user.'</user>
        <id>'.$app_id.'</id>
      </app>
      <tran>
        <test>1</test>
        <type>auth</type>
        <class>paypage</class>
        <cartid>'.$cartid.'</cartid>
        <description>'.$tran_description.'</description>
        <currency>AED</currency>
        <amount>'.$tran_amount.'</amount>
        <ref>'.$cartid.'</ref>
      </tran>
      <billing>
        <name>
          <title>Mr/Mrs</title>
          <first>'.$user->first_name.'</first>
          <last>'.$user->last_name.'</last>
        </name>
        <address>
          <line1>'.$billing_address_line1.'</line1>
          <line2>'.$billing_address_line2.'</line2>
          <line3>'.$billing_address_line3.'</line3>
          <city>'.$billing_address_city.'</city>
          <region>'.$billing_address_region.'</region>
          <country>'.$billing_address_country.'</country>
          <zip>'.$billing_address_pobox.'</zip>
        </address>
        <email>'.$user->email.'</email>
      </billing>
    </mobile>';
    
    $headers = array(
        "Content-type: text/xml",
        "Content-length: " . strlen($xml),
        "Connection: close",
    );

     $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $data = curl_exec($ch);
    $xml = simplexml_load_string($data);
    $responseData = json_encode($xml);
    
    if(curl_errno($ch)) {
        $responseData = array('success'=>'0', 'data'=>curl_error($ch), 'message'=>"Error");
    }else{
        $data = json_decode($responseData);
        $responseData = array('success'=>'1', 'data'=>$data, 'message'=>"Successfull");
       
    }
    curl_close($ch);
    $orderResponse = json_encode($responseData);
    return $orderResponse;
}

    public function telrpaymentstatus(Request $request)
    {
     
        $codeValue =  $request->refrenceCode;
        $statusURL = "https://secure.innovatepayments.com/gateway/mobile_complete.xml";
        
        if(!empty($codeValue)){
            $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <mobile>
                  <store>23596</store>
                  <key>ksHB^z8pGQ~NTPwJ</key> 
                  <complete>'.$codeValue.'</complete>
                </mobile>';
                
            $headers = array(
                "Content-type: text/xml",
                "Content-length: " . strlen($xml),
                "Connection: close",
            );
        
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL,$statusURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $data = curl_exec($ch);
            $xml = simplexml_load_string($data);
            $responseData = json_encode($xml);
            if(curl_errno($ch)) {
                $responseData = array('success'=>'0', 'data'=>curl_error($ch), 'message'=>"Error");
            }else{
                $data = json_decode($responseData);
                $serverResp = $data->auth;
                if($serverResp->status == 'A'){
                    $responseData = array('success'=>'1', 'data'=>$serverResp, 'message'=>$serverResp->message);
                }else{
                    $responseData = array('success'=>'0', 'data'=>$serverResp, 'message'=>$serverResp->message);
                }
            }
            curl_close($ch);
        }else{
            $responseData = array('success'=>'0', 'data'=>curl_error($ch), 'message'=>"Invalid Refrence code.");
        }
      $orderResponse = json_encode($responseData);
      return $orderResponse;
    }
    
    
    
    
    public function paymentByTelr1(Request $request){
        
        $package_id = $request->requestPackage;
        $cat_slug = $request->category;
        $language_id = $request->language_id;
        
        if(empty($package_id) || empty($cat_slug)){
            return response()->json(['status' => 0, 'data' => array(), 'message' => Lang::get("website.Either Package or Section is missing")]);  
        }
        
        $client = Client::where('user_id', Auth::user()->id)->first();
        if(empty($client)){
            return response()->json(['status' => 0, 'data' => array(),  'message' => Lang::get("website.Unauthorized Access: please contact the administrator")]);   
        }
        
        $service_package = ServicePackage::where('id' , $package_id)->first();
        if(empty($service_package)){
            return response()->json(['status' => 0, 'data' => array(), 'message' => Lang::get("website.Package is invalid or does not exist, please try again later")]);  
        }
        
        $category = Section::where('status', 1)->where('slug', $cat_slug)->first();
        if(empty($category)){
            return response()->json(['status' => 0, 'data' => array(), 'message' => Lang::get("website.Telr payment initailise")]); 
        }
        
        
        $params = array(
            'ivp_method'  => 'create',
            'ivp_store'   => '23596',
            'ivp_authkey' => 'ksHB^z8pGQ~NTPwJ',
            'ivp_cart'    => 'cart_id'. time(),  
            'ivp_test'    => '1',
            'ivp_amount'  => $service_package->price,
            'ivp_currency'=> 'AED',
            'ivp_desc'    => ($language_id == 1) ? $service_package->name : $service_package->name_ar,
            'return_auth' => 'https://g2g.ae/client/package-subscription/create/'.$cat_slug,
            'return_can'  => 'https://g2g.ae/client/package-subscription/create/'.$cat_slug,
            'return_decl' => 'https://g2g.ae/client/package-subscription/create/'.$cat_slug
        );
        
        //dd($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://secure.telr.com/gateway/order.json");
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $result = curl_exec($ch);
        if ($result === null || $result == FALSE || $result == '') {
            return response()->json(['status' => 0, 'data' => array(), 'message' => Lang::get("website.ERROR!!! - TELR payment has been failed, please try again later")]);
        } else {
            $results = json_decode($result,true);
            
            dd($results);
            $ref= trim($results['order']['ref']);
            $url= trim($results['order']['url']);
            return response()->json(['status' => 1, 'data' => ['ref' => $ref, 'url' => $url], 'message' => Lang::get("website.Telr payment initailise")]); 
        }
        curl_close($ch);
        
    
            
    }


    // currently payment is cod
    // Garage confirmation required...
    public function save(Request $request){

        $validator = Validator::make($request->all(), [
            'payment_type'=>'required',
            'garage_id'  => 'required',
            'package_id'  => 'required',
            'vehicle_id' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'pobox' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }


        $client = Client::where('user_id', Auth::user()->id)->first();
        if(!empty($client)){

           
            $service_package = ServicePackage::where('id' , $request->package_id)->first();
            if(!empty( $service_package)){

                 // check if already any package is active for the same
                /*$is_allowed = ClientPackageSubscribe::where('vehicle_id',$request->vehicle_id )
                                                     ->where('client_id' , $client->id)
                                                     ->where('status' ,1)
                                                 ->first();*/

                // Ishan - allowed multiple package for same vehicle...
                // for temperory we allow multple package for same vehicle
                $is_allowed = null;


                if(is_null($is_allowed)){

                    $clientPackageSubscribe = new ClientPackageSubscribe();
                    $clientPackageSubscribe->client_id = $client->id;
                    $clientPackageSubscribe->user_id = Auth::user()->id;
                    $clientPackageSubscribe->ps_code = time();
                    $clientPackageSubscribe->vehicle_id = $request->vehicle_id;
                    $clientPackageSubscribe->service_package_id = $service_package->id;
                    $clientPackageSubscribe->garage_id = $request->garage_id;
                    $clientPackageSubscribe->address = $request->address;
                    $clientPackageSubscribe->latitude = $request->latitude;
                    $clientPackageSubscribe->longitude = $request->longitude;
                    $clientPackageSubscribe->city_id = $request->city_id;
                    $clientPackageSubscribe->country_id = $request->country_id;
                    $clientPackageSubscribe->pobox = $request->pobox;
                    
                    $clientPackageSubscribe->status =  ($request->payment_type == 'cod') ? 3 : 1; // pending...
                    $clientPackageSubscribe->amount = $service_package->price;
                    $clientPackageSubscribe->vip_pickup_opted = $request->vip_pickup_opted;
                    $clientPackageSubscribe->vip_pickup_price = $request->vip_pickup_price;

                    if($clientPackageSubscribe->save()){

                        $clientPackageSubscribePayment = new ClientPackageSubscribePayment();
                        $clientPackageSubscribePayment->client_package_subscribe_id = $clientPackageSubscribe->id;
                        $clientPackageSubscribePayment->amount = $service_package->price;  
                        $clientPackageSubscribePayment->payment_type = $request->payment_type;  
                        $clientPackageSubscribePayment->status = ($request->payment_type == 'cod') ? 3 : 1;  
                        $clientPackageSubscribePayment->save();


                        $clientPackageSubscribeLog = new ClientPackageSubscribeLog();
                        $clientPackageSubscribeLog->client_package_subscribe_id = $clientPackageSubscribe->id;
                        $clientPackageSubscribeLog->description = ' Package Subscription requested!!! - Customer subscribe the package but Payment approval required by the Garage.';
                        $clientPackageSubscribeLog->save();
                        
                        // sending mail
                        $myVar = new AlertController();
                        $alertSetting = $myVar->sendPackageSubscription($clientPackageSubscribe, 'subscribe' , 'customer');
                        

                        return  redirect()->route('client.package-subscription.booking-confimation');
                    }  
                }else{
                    // already exist
                    return  redirect()->back()->with('status', 'ERROR!!! - A package is already active for the vehicle. please visit dashboard for more information.');
                }
            }
        }
        return  redirect()->back()->with('status', 'ERROR!!! - Something went wrong! please contact admin for further assistance. ');
    }

    public function getGarageByService(Request $request){
        
        $language_id = $request->language_id;
        $s_latitude = $request->latitude;
        $s_longitude = $request->longitude;
        $s_city_id = $request->city_id;
        $s_country_id = $request->country_id;
        $category_ids = $request->category_checkbox;

        if(empty($category_ids)){
            return response()->json(['html' => Lang::get("website.Mandatory field is missing")]);
        }

        if(!empty($s_latitude) && !empty($s_longitude) && !empty($s_city_id) && !empty($s_country_id)){

            $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->join('garages_description' , function($query) use ($language_id){
                            $query->on( 'garages_description.garages_id', '=' ,'garages.id')
                            ->where('garages_description.language_id', 1);
                        })
                        ->join('cities', 'cities.id', 'garages.city_id')
                        ->join('countries', 'countries.id', 'garages.country_id')
                        ->select('garages.id' ,'garages.address','garages.postal as pobox' ,'garages_description.garages_name as name' 
                                    ,'garages.latitude', 'garages.longitude', 'cities.name as city_name', 'cities.name_ar as city_name_ar' , 'countries.name as country_name', 'countries.name_ar as country_name_ar' )
                        ->where(function($query) use($category_ids) {
                                foreach($category_ids as $cf){
                                    return $query->whereRaw("FIND_IN_SET($cf,garage_services.cat_id)")
                                            ->orWhereRaw("FIND_IN_SET($cf,garage_services.sub_cat_id)");
                                }
                        })->where('garages.city_id', $s_city_id)
                        ->where('garages.country_id', $s_country_id)
                        ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                        ->get();
             
            if(!empty($garages)){

                foreach($garages as $key => $garage){
                    $g_latitude = $garage->latitude; 
                    $g_longitude = $garage->longitude; 

                    $distanceInKm = $this->calculateDistanceBetweenTwoPoints( $s_latitude, $s_longitude , $g_latitude,$g_longitude);
                    if(round($distanceInKm,2) > round(10.00,2)){
                        $garages->forget($key);
                    }
                }
            }
            $data['garages'] = $garages;
            $view  = (string)\View::make('client::service-request.includes.garage-list',$data);
            return response()->json(['data'=> $data, 'html' => $view]);

        }
        return response()->json(['html' => Lang::get("website.no_garage_found_by_cat")]);
        /*
        $data = [];
        $category_ids = [];
        $category_checkbox = $request->category_checkbox;
        $s_latitude = $request->latitude;
        $s_longitude = $request->longitude;
        $s_city_id = $request->city;
        $s_country_id = $request->country;

        if(!empty($category_checkbox)){
            $category_ids = explode(',', $category_checkbox);

            $garages = Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                            ->select('garages.*')
                            ->where(function($query) use($category_ids) {
                                foreach($category_ids as $cf){
                                    return $query->whereRaw("FIND_IN_SET($cf,garage_services.cat_id)")
                                            ->orWhereRaw("FIND_IN_SET($cf,garage_services.sub_cat_id)");
                                }
                            })
                            ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                            ->get();

            if(!empty($garages) && count($garages) > 0){

                foreach($garages as $key => $garage){
                    $g_latitude = $garage->latitude; 
                    $g_longitude = $garage->longitude; 

                    $distanceInKm = $this->calculateDistanceBetweenTwoPoints( $s_latitude, $s_longitude , $g_latitude,$g_longitude);
                    //echo $distanceInKm . '-----';
                    if(round($distanceInKm,2) > round(10.00,2)){
                        $garages->forget($key);
                    }
                }
            }
            $data['garages'] = $garages;

            $view  = (string)\View::make('client::service-request.includes.garage-list',$data);
            return response()->json(['html' => $view]);
        }
        return response()->json(['html' => '<p>Please select atleast one service</p>']);
        */
    }



    public function getGarageByCategory( Request $request){
        
        $cat_slug = $request->category;
        $language_id = $request->language_id;
        $s_latitude = $request->latitude;
        $s_longitude = $request->longitude;
        $s_city_id = $request->city_id;
        $s_country_id = $request->country_id;

        $category = Section::where('status', 1)->where('slug', $cat_slug)->first();
        if(is_null($category)){
            return response()->json(['html' => Lang::get("website.Mandatory field is missing")]);
        }else{
            $s_category = $category->id;
        }

        if(!empty($s_latitude) && !empty($s_longitude) && !empty($s_city_id) && !empty($s_country_id)){

            $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->join('garages_description' , function($query) use ($language_id){
                            $query->on( 'garages_description.garages_id', '=' ,'garages.id')
                            ->where('garages_description.language_id', 1);
                        })
                        ->join('cities', 'cities.id', 'garages.city_id')
                        ->join('countries', 'countries.id', 'garages.country_id')
                        ->select('garages.id' ,'garages.address','garages.postal as pobox' ,'garages_description.garages_name as name' 
                                    ,'garages.latitude', 'garages.longitude', 'cities.name as city_name', 'cities.name_ar as city_name_ar' , 'countries.name as country_name', 'countries.name_ar as country_name_ar' )
                        ->where(function($query) use($s_category) {
                            return $query->whereRaw("FIND_IN_SET($s_category,garage_services.cat_id)")
                                        ->orWhereRaw("FIND_IN_SET($s_category,garage_services.sub_cat_id)");
                            
                        })->where('garages.city_id', $s_city_id)
                        ->where('garages.country_id', $s_country_id)
                        ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                        ->get();
             
            if(!empty($garages)){

                foreach($garages as $key => $garage){
                    $g_latitude = $garage->latitude; 
                    $g_longitude = $garage->longitude; 

                    $distanceInKm = $this->calculateDistanceBetweenTwoPoints( $s_latitude, $s_longitude , $g_latitude,$g_longitude);
                    if(round($distanceInKm,2) > round(10.00,2)){
                        $garages->forget($key);
                    }
                }
            }
            $data['garages'] = $garages;
            $view  = (string)\View::make('client::service-request.includes.garage-list',$data);
            return response()->json(['data'=> $data, 'html' => $view]);

        }
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

   
   



    /*
    On upgrade add days to the existing....
    // remove current and low package
    // user can only upgrade their package....
     */
    public function subscribeBuyOrUpgrade($slug){

        $data = [];
        $data['package_buy_upgrade'] = 'Buy';
        $data['is_subscribed_package_exist'] = false;
        $data['error'] = false;



        // check slug exist...
        if(!empty($slug)){

            // check package exist...
            $requestedPackage = ServicePackage::active()
                                ->where('package_for' , 2)
                                ->where('slug' , $slug)
                                ->with('packageFeatures','section')
                                ->first();

            if(!empty($requestedPackage)){

                // packages existed
                //$data['package'] = $requestedPackage->toArray();
                $data['error'] = false;

                // check user already subscribe or not...
                $garageSubscribedPackage = ClientPackageSubscribe::where('garage_id', Auth::user()->id)
                                            ->with('servicePackage')
                                            ->orderBy('updated_at', 'desc')
                                            ->first();


                if($garageSubscribedPackage){

                    // Check requested Package and Garage Databse package are Same or Not
                    $same_package_for_subscription_requested = false;
                    if($garageSubscribedPackage->servicePackage->id ===  $requestedPackage['id']){
                        $same_package_for_subscription_requested = true;
                    }

                   $data['is_subscribed_package_exist'] = true;

                    if(! $same_package_for_subscription_requested){

                        // Not same
                       
                        if( $garageSubscribedPackage->is_active){  // Already active and approved subscription
                        
                            // Check the price is up or low that cuurent package
                            // if low give them error
                            // if up then upgrade is allowed...
                            if((int) $requestedPackage['price'] > (int) $garageSubscribedPackage->amount){
                                
                                $data['package_buy_upgrade'] = 'Upgrade';  
                                $data['garagePackageSubscribe'] = $garageSubscribedPackage;
                                $data['package'] = $requestedPackage->toArray();

                            }else{

                                $data['error'] = true;
                                $data['msg'] = 'Downgrade package is not allwed this moment. Please conatct Admin support for further assistance.';
                            }

                           

                        }else{ // Yet not activate and approved by admin

                            // Ask for cancellation of subscription package...
                            $data['package'] = $garageSubscribedPackage;
                            return view('client::package.cancel-subscribe' , $data);

                        }

                    }else{

                        $data['error'] = true;
                        if( $garageSubscribedPackage->is_active){
                             $data['msg'] = 'You have already subscribed the requested Package. Please conatct Admin support for further assistance.';
                        }else{
                             $data['msg'] = 'You have pending request for activation of same package . Please conatct Admin support for further assistance.';
                         }
                    }

                }else{
                    
                    $data['is_subscribed_package_exist'] = false;
                    $data['package_buy_upgrade'] = 'Buy'; //buy new package
                   $data['package'] = $requestedPackage->toArray();
                }

            }else{

                $data['error'] = true;
                $data['msg'] = 'The request is not valid or authenticate. Please try again OR Please conatct Admin support for further assistance.';
            }

        }else{

            $data['error'] = true;
            $data['msg'] = 'The request is not valid or authenticate. Please try again Or Please conatct Admin support for further assistance.';
          
        }
        //dd($data);die;
                    
        return view('client::package.subscribe' , $data);
    }

    public function subscribe(Request $request){

        $validator = Validator::make($request->all(), [
            'service_package_id' => 'required',
            'payment_type' => 'required',
            'buy_or_upgrade' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Get package details...
        $package = ServicePackage::where('id' , $request->service_package_id)->first();

        if(!empty($package)){

            // entry in garage_package_subscribe 
            // if already exist then set is active false and make another entry with add remoaing days 
            $garagePackageSubscribe = new ClientPackageSubscribe();

           
            if($request->buy_or_upgrade  == 'Buy'){

                $subscription_start_at = date('Y-m-d');
                $daystosum = (int)$package->period;
                $subscription_end_at = date('Y-m-d', strtotime($subscription_start_at.' + '.$daystosum.' days'));

                $garagePackageSubscribe->service_package_id = $package->id;
                $garagePackageSubscribe->garage_id = Auth::user()->id;
                //$garagePackageSubscribe->payment_type = $request->payment_type;
                $garagePackageSubscribe->amount = $package->price;
                $garagePackageSubscribe->subscription_start_at = $subscription_start_at;
                $garagePackageSubscribe->subscription_end_at = $subscription_end_at;
                //$garagePackageSubscribe->description = 'Purchase '.$package->name .' on '. $subscription_start_at;

                if($garagePackageSubscribe->save()){
                    return \Redirect::route('garage.packages')->with('status', ' Package subscription in process and will be verified by Admin and inform activation by the mail ');
                }

            }elseif($request->buy_or_upgrade  == 'Upgrade'){


                $garageSubscribedPackage = ClientPackageSubscribe::where('id', $request->garageSubscribedPackageId )->first();

                if($garageSubscribedPackage){

                    // cancel the previous package
                   ClientPackageSubscribe::where('id', '=', $garageSubscribedPackage->id)
                    ->update([
                        'description' => 'Cancel Package Subscription due to upgradation.',
                        'is_cancel' => 1,
                        'cancelled_at' => date('Y-m-d')
                    ]);

                    // now add new records
                    $subscription_start_at = date('Y-m-d');
                    $daystosum = (int)$package->period + (int) $this->getDaysRemaining($garageSubscribedPackage->subscription_end_at);
                    $subscription_end_at = date('Y-m-d', strtotime($subscription_start_at.' + '.$daystosum.' days'));

                    $garagePackageSubscribe->service_package_id = $package->id;
                    $garagePackageSubscribe->garage_id = Auth::user()->id;
                    $garagePackageSubscribe->payment_type = $request->payment_type;
                    $garagePackageSubscribe->amount = $package->price;
                    $garagePackageSubscribe->subscription_start_at = $subscription_start_at;
                    $garagePackageSubscribe->subscription_end_at = $subscription_end_at;
                    $garagePackageSubscribe->description = 'Purchase upgrade '.$package->name .' on '. $subscription_start_at;

                    if($garagePackageSubscribe->save()){
                        return \Redirect::route('garage.packages')->with('status', 'Package Upgradation is in process and will be verified by Admin and inform activation by the mail ');
                    }

                }
               

            }
        }

        return \Redirect::back()->with('status', 'Something went wrong !!!');

    } // end

    public function getDaysRemaining($tdate){
        $fdate = now();
        $tdate = $tdate;
        $datetime1 = new \DateTime($fdate);
        $datetime2 = new \DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        if($days < 0) $days = 0;
        return $days;
    }

    // Cancel Existing subscription..
    public function cancelSubscription(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        ClientPackageSubscribe::where('id', '=', $request->id)
            ->update([
                'description' => 'Cancel Package Subscription by the Garage.',
                'is_cancel' => 1,
                'is_active' => 0,
                'cancelled_at' => date('Y-m-d')
            ]);
        return \Redirect::route('client.packages')->with('status', 'Cancel Package Subscription and shortly inform by Email.');

    }




    /*---------------------------------------------------------------
        Custom package 
     ---------------------------------------------------------------*/

     public function customPackage(){

        $data = [];
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;

         $setting = new Setting();
         $getSettings = $setting->getSettings();

         $vip_pickup_enabled = $getSettings[126]->value;
         $vip_pickup_amount = $getSettings[127]->value;

        $cat_slug = 'custom-package';

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

        $client = Client::where('user_id' , Auth::user()->id)->where('status' ,1)->first();

        $vehicles = Vehicle::where('client_id' , $client->id)->where('status' ,1)->get();
        $vehicle_makes = VehicleMake::active()->get();
        $cities = City::active()->get();
        $countries = Country::active()->get();
        $c_locations = ClientLocation::active()->where('client_id' , $client->id)->get();
                
        //dd($data);
        return view('client::package.custom-package.add-custom-package', [
                    'final_theme' => $final_theme,
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
        //return view('client::package.custom-package.add-custom-package', $data);
    }

    public function saveCustomPackage(Request $request){

         $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required',
            'garage_id' => 'required',
            'sevices' => 'required',
            'subscription_duration' => 'required',
            'custom_remarks' => 'custom_remarks',
            'address' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'pobox' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $client = Client::where('user_id', Auth::user()->id)->first();
        if(!empty($client)){
           
            $service_package = ServicePackage::where('slug' , 'custom-package')->first();
            if(!empty( $service_package)){

                $clientPackageSubscribe = new ClientPackageSubscribe();
                $clientPackageSubscribe->client_id = $client->id;
                $clientPackageSubscribe->vehicle_id = $request->vehicle_id;
                $clientPackageSubscribe->service_package_id = $service_package->id;
                $clientPackageSubscribe->garage_id = $request->garage_id;
                $clientPackageSubscribe->custom_package_section_id = $request->sevices;
                $clientPackageSubscribe->address = $request->address;
                $clientPackageSubscribe->latitude = $request->latitude;
                $clientPackageSubscribe->longitude = $request->longitude;
                $clientPackageSubscribe->city_id = $request->city_id;
                $clientPackageSubscribe->country_id = $request->country_id;
                $clientPackageSubscribe->pobox = $request->pobox;
                $clientPackageSubscribe->vip_pickup_opted = $request->vip_pickup_opted;
                $clientPackageSubscribe->vip_pickup_price = $request->vip_pickup_price;
                
                $clientPackageSubscribe->status = 3; // pending...
                $clientPackageSubscribe->amount = null;
                $clientPackageSubscribe->is_custom = 1;  

                if($clientPackageSubscribe->save()){

                    $clientPackageSubscribeLog = new ClientPackageSubscribeLog();
                    $clientPackageSubscribeLog->client_package_subscribe_id = $clientPackageSubscribe->id;
                    $clientPackageSubscribeLog->description = ' Custom Package Subscription requested!!! - Customer request the custom package and wait for the garage quote.';
                    $clientPackageSubscribeLog->save();

                    return  redirect()->route('client.package-subscription.booking-confimation');
                }  
                
            }
        }
        return  redirect()->back()->with('status', 'ERROR!!! - Something went wrong! please contact admin for further assistance. ');
    }

    
    public function customPackageSettings($id){
        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->where('client_id' , Auth::user()->id)->with('servicePackage','garage','vehicle')->first();
            if(!empty($clientPackageSubscribe)){

                $custom_package_section_ids = [];
                if( strpos($clientPackageSubscribe->custom_package_section_id, ',') !== false ) {
                    $custom_package_section_ids = explode(',', $clientPackageSubscribe->custom_package_section_id);
                }else{
                    $custom_package_section_ids[] = $clientPackageSubscribe->custom_package_section_id;
                }

                //dd($custom_package_section_ids);

                $subCats = $mainCats = [];
                $categories = Section::where('status', 1)->whereIn('id' , $custom_package_section_ids)->get();
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
                $data['catList'] = [
                    'mainCats' => $mainCats,
                    'subCats' => $subCats,
                ];

                $data['clientPackageSubscribe'] = $clientPackageSubscribe;
                $data['packageStatus'] = $this->getPackageSubscribeStatusName($clientPackageSubscribe->status);
                $data['clientPackageSubscribePayment'] = ClientPackageSubscribePayment::where('client_package_subscribe_id', $id)->first();
                if(is_null($data['clientPackageSubscribePayment'])){
                    $data['paymentStatus'] = null;
                }else{
                    $data['paymentStatus'] = $this->getPackagePaymentStatusName($data['clientPackageSubscribePayment']->status);
                 }
                return view('client::package.custom-package.settings', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function updateCustomPackagePaymentStatus(Request $request){

         $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'id' => 'required',
            'payment_type' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $id = $request->id;
        $amount = $request->amount;

        if(!empty($id) && !empty($amount)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->where('client_id' , Auth::user()->id)->first();
            if(!empty($clientPackageSubscribe)){

                $clientPackageSubscribe->update(['status' => 7]);

                ClientPackageSubscribePayment::where('client_package_subscribe_id', '=', $clientPackageSubscribe->id)->update(['status' => 4, 'payment_type' => $request->payment_type]);

                // logs
                $clientPackageSubscribeLog = new ClientPackageSubscribeLog();
                $clientPackageSubscribeLog->client_package_subscribe_id = $clientPackageSubscribe->id;
                $clientPackageSubscribeLog->description = ' Custom Package Payment Done(COD mode)!!! - Customer has made payment as COD mode and wait for the Garage Approval To Activate.';
                $clientPackageSubscribeLog->save();

                return \Redirect::back()->with('status', 'PAYMENT DONE!!! - Customer paid the garage requested quote amount and wait for the Garage to activate the package ot contact supports for furthet assistance');

            }
        }
        return \Redirect::back()->with('status', 'Something went wrong!');
    }




    
}
