<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\AppModels\Product;
use DB;
use Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon;
use Hash;

use App\GarageService;
use App\GarageWorkingHour;
use App\GarageTeam;
use App\GarageImage;
use App\GarageVideo;
use App\Section;
use App\City;
use App\Country;
use App\ServiceRequestPayment;
use App\ClientPackageSubscribePayment;
use App\Vehicle;
use App\VehicleMake;
use App\VehicleModel;
use App\Client;
use App\ClientLocation;
use App\ServicePackage;

class Garage extends Model{

	 public static function processlogin($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $email = $request->email;
            $password = $request->password;
            $loginResp = false;

            $customerInfo = array("email" => $email, "password" => $password, 'role' => 4);
             if(is_numeric($request->get('email'))){
	      	  if (Auth::guard('client')->attempt(['phone' => $request->email,'password' => $request->password])){
	            $loginResp = true;
	          }
	        }else{
	          if (Auth::guard('client')->attempt(['email' => $request->email,'password' => $request->password])){
	            $loginResp = true;
	          }
	        }


            if ($loginResp) {
            	 if(is_numeric($request->get('email'))){
            	 	$existUser = DB::table('clients')
                     ->where('phone', $email)->where('status', '1')->get();
            	 }else{
            	 	$existUser = DB::table('clients')
                     ->where('email', $email)->where('status', '1')->get();
            	 }
               

                if (count($existUser) > 0) {

                    $customers_id = $existUser[0]->id;

                   
                    //check if already login or not
                    $already_login = DB::table('whos_online')->where('client_id', '=', $customers_id)->get();

                    if (count($already_login) > 0) {
                        DB::table('whos_online')
                            ->where('client_id', $customers_id)
                            ->update([
                                'full_name' => $existUser[0]->first_name . ' ' . $existUser[0]->last_name,
                                'time_entry' => date('Y-m-d H:i:s'),
                            ]);
                    } else {
                        DB::table('whos_online')
                            ->insert([
                                'full_name' => $existUser[0]->first_name . ' ' . $existUser[0]->last_name,
                                'time_entry' => date('Y-m-d H:i:s'),
                                'customer_id' => $customers_id,
                            ]);
                    }


                    $responseData = array('success' => '1', 'data' => $existUser, 'message' => 'Data has been returned successfully!');

                } else {
                    $responseData = array('success' => '0', 'data' => array(), 'message' => "Your account has been deactivated.");

                }
            } else {
                $existUser = array();
                $responseData = array('success' => '0', 'data' => array(), 'message' => "Invalid email or password.");

            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }
    
     public static function getAllPackages($request)
    {

        $language_id = $request->language_id;
        $postData = array();

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            
            $packages = ServicePackage::where('status' , 1)->where('package_for' , 1)->where('slug','!=' ,'custom-package')
             ->with('packageFeatures')
            ->get();
            
            $data = [];
            $sections = [];
            foreach( $packages as  $package){
            
            	$temp= [];
            	 $sectionsData = DB::table('sections_description')->select('sections_name')
            	 ->where('language_id', $language_id)->where('sections_id', $package->section_id)->first();
            	 
            	 $package->sections_name = $sectionsData->sections_name;
            	 $temp['section_id'] = $package->section_id;
            	 $sections[$package->section_id] = $sectionsData->sections_name;
            	 
            	 $temp['sections_name'] = $sectionsData->sections_name;
            	 $temp['price'] = $package->price;
            	 $temp['promo_price'] = $package->promo_price;
            	 $temp['period'] = $package->period;
            	 
            	 if($language_id == 1){
            	 	$temp['service_package_name'] = $package->name;
            	 }else{
            	 	$temp['service_package_name'] = $package->name_ar;
            	 }
            	 
            	 //$service_package_feature = [];
            	 foreach($package->packageFeatures as $features){
            	 	 $temp1 = [];
            	 	 if($language_id == 1){
            	 	 	$temp1['service_package_feature_name'] = $features['feature_name'];
            	 		$temp1['service_package_feature_value'] = $features['feature_value'];
            	 	 }else{
            	 	 	$temp1['service_package_feature_name'] = $features['feature_name_ar'];
            	 		$temp1['service_package_feature_value'] =  $features['feature_value_ar'];
            	 	 }
            	 	  $temp['service_package_feature'][] = $temp1;
            	 }
            	 //$temp['service_package_feature'] = $service_package_feature;
            	 $data[$package->section_id][] = $temp; 
            }
            
            //dd($data);die;
           
            if(!empty($packages) && count($packages) > 0){
            	$finalData = [
            		'sections' => $sections,
            		'packages' => $data
            	];
                $responseData = array('success' => '1', 'data' => $finalData , 'message' => "Records Found.");
            }else{
                $responseData = array('success' => '2', 'data' => $packages, 'message' => "No record found.");
            }    
           
            
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }

    public static function processforgotpassword($request)
    {

        $email = $request->email;
        $postData = array();

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            //check email exist
            $existUser = DB::table('clients')->where('email', $email)->get();

            if (count($existUser) > 0) {
                $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);

                DB::table('clients')->where('email', $email)->update([
                    'password' => Hash::make($password),
                ]);

                $existUser[0]->password = $password;

                $myVar = new AlertController();
                $alertSetting = $myVar->forgotPasswordAlert($existUser);
                $responseData = array('success' => '1', 'data' => $postData, 'message' => "Your password has been sent to your email address.");
            } else {
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Email address doesn't exist!");
            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }

      public static function processregistration($request)
    {
        $customers_firstname = $request->customers_firstname;
        $customers_lastname = $request->customers_lastname;
        $email = $request->email;
        $password = $request->password;
        $customers_telephone = $request->customers_telephone;
        $country = $request->customers_country_id;
        $city = $request->customers_city_id;
        $address= $request->customers_address;
        $postal = $request->customers_postal;
        $username = $request->customers_username;
         $gender = $request->customers_gender;
        $customers_info_date_account_created = date('y-m-d h:i:s');

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        $extensions = array('gif', 'jpg', 'jpeg', 'png');

        if ($authenticate == 1) {

            //check email existance
            $existUser = DB::table('clients')->where('email', $email)->get();
            $existUsername = DB::table('clients')->where('username', $username)->get();

            if (count($existUser) > 0) {
                //response if email already exit
                $postData = array();
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Email address is already exist");
            }

            if (count($existUsername) > 0) {
            	$postData = array();
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Username is already exist");
            }

            if(count($existUser)  == 0 && count($existUsername)  == 0) {
			   

                //insert data into customer
                $customers_id = DB::table('clients')->insertGetId([
                    'username'=> $username,
                    'first_name' => $customers_firstname,
                    'last_name' => $customers_lastname,
                    'phone' => $customers_telephone,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'status' => '1',
                    'remember_token' => null,
                    'gender' => $gender,
                    'address' => $address,
                    'city' => $city,
                    'country' => $country,
                    'postal' => $postal,
                    'created_at' => date('y-m-d h:i:s'),
                ]);

                $userData = DB::table('clients')
                    ->where('clients.id', '=', $customers_id)->where('status', '1')->get();
                $responseData = array('success' => '1', 'data' => $userData, 'message' => "Sign Up successfully!");
            }

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }



    public static function updategaragecustomerinfo($request)
    {
        $customers_id                       =   $request->customers_id;
        $customers_firstname                =   $request->customers_firstname;
        $customers_lastname                 =   $request->customers_lastname;
        $customers_telephone                =   $request->phone;
        //$customers_gender                     =   $request->customers_gender;
        //$customers_dob                        =   $request->customers_dob;
        $customers_info_date_account_last_modified  =   date('y-m-d h:i:s');
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']     = request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if($authenticate==1){
        $cehckexist = DB::table('clients')->where('id', $customers_id)->where('role', 4)->first();
            if($cehckexist){

                $customer_data = array(
                    'role' => 4,
                    'first_name'             =>  $customers_firstname,
                    'last_name'          =>  $customers_lastname,
                    'phone'          =>  $customers_telephone,
                    //'gender'               =>  $customers_gender,
                   // 'dob'                  =>  $customers_dob,
                );


            //update into customer
            DB::table('clients')->where('id', $customers_id)->update($customer_data);

            $userData = DB::table('clients')
                ->select('clients.*')->where('clients.id', '=', $customers_id)->get();

            $responseData = array('success'=>'1', 'data'=>$userData, 'message'=>"Customer information has been Updated successfully");


            }else{
            $responseData = array('success'=>'3', 'data'=>array(),  'message'=>"Record not found.");
            }

        }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }

    public static function getAllMapGarages($request){
        
        $language_id = $request->language_id;
        $skip = $request->page_number . '0';
        $currentDate = time();
        $type = $request->type;
        $userLat = $request->latitude;
        $userLong = $request->longitude;
        $distance_filters = 100;
     
        //filter
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

      if ($authenticate == 1) {

       
        $garages =  Garage::query()
                ->join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                ->join('garages_description','garages_description.garages_id' , 'garages.id')
                ->join('cities','cities.id' , 'garages.city_id')
                ->join('countries','countries.id' , 'garages.country_id')
                ->select('garages.id','garages.profile_image as image','garages_description.garages_name','garages_description.garages_description','cities.name as city_name', 'countries.countries_name as country_name','garages.address as address','garages.postal','garages.latitude','garages.longitude')
                ->where('garages.status', 1)
                ->where('garages_description.language_id', $language_id);
        
       
       
       // $data = $garages->skip($skip)->take(10)->get();
        $data = $garages->get();

        if($type == 'nearBy'){
            $c_latitude =  $userLat; 
            $c_longitude =  $userLong; 
    
            foreach($data as $key => $garage){
               // print_r($garage);
                $g_latitude = $garage->latitude; 
                $g_longitude = $garage->longitude; 
    
                $distanceInKm = self::calculateDistanceBetweenTwoPoints( $c_latitude, $c_longitude , $g_latitude,$g_longitude);
               
                if((int)$distanceInKm > (int)$distance_filters){
                    $data->forget($key);
                }
            }
        }

         //count
        $total_record =count($data);

        //check if record exist
        if (count($data) > 0) {
            $responseData = array('success' => '1', 'garage_data' => $data, 'message' => "Returned all garages.", 'total_record' => $total_record);
        } else {
          $responseData = array('success' => '0', 'garage_data' => $data, 'message' => "Empty record.", 'total_record' => count($data));
        }
          
      } else {
          $responseData = array('success' => '0', 'garage_data' => array(), 'message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);

      return $categoryResponse;
  }




	
	
	 public static function getAllGarages($request){
	 	
        $language_id = $request->language_id;
        $skip = $request->page_number . '0';
        $currentDate = time();
        $type = $request->type;
        $userLat = null;
        $userLong = null;
        $loadingSearchData  = $request->loadingSearchData; // garage list show based on home page search 
        
        // hack for all garage
        $isAllGarageRequest = false;
        if(!$request->has('formdata')){
            $isAllGarageRequest = true;
        }
        
        
        if($loadingSearchData){
            $formdata = $request->formdata;
            $userLat = $formdata['latitude'];
            $userLong = $formdata['longitude'];
            $distance = $formdata['distance'];
        }else{
            $userLat = $request->latitude;
            $userLong = $request->longitude;
            $distance = $request->distance;
        }
        
        if(!empty($distance)){
            $distance_filters = $distance;
        }else{
            $distance_filters = 100;
        }

        //filter
        $minDistance = $request->distance['min'];
        $maxDistance = $request->distance['max'];
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

      if ($authenticate == 1) {
        
        

        $serviceRequestIds = [];
        $city_ids = [];
        if (!empty($request->filters)) {
            foreach ($request->filters as  $filters_attribute) {
                if($filters_attribute['name'] == 'city'){
                    $city_ids[] = $filters_attribute['value'];
                }

                 if($filters_attribute['name'] == 'ServiceRequest'){
                    $serviceRequestIds[] = $filters_attribute['value'];
                }
            }
        }
        
        if($loadingSearchData){
            foreach($formdata['category'] as $category){
                $serviceRequestIds[] = $category;
            }
        }
        
        
        // if all garage is set , then remob=ve any condition
         if($isAllGarageRequest){
             $serviceRequestIds = [];
            $city_ids = [];
         }
        
        

		$garages =  Garage::query()
                ->join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
				->join('garages_description','garages_description.garages_id' , 'garages.id')
				->join('cities','cities.id' , 'garages.city_id')
				->join('countries','countries.id' , 'garages.country_id')
				->select('garages.id','garages.profile_image as image','garages_description.garages_name','garages_description.garages_description','cities.name as city_name', 'countries.countries_name as country_name','garages.address as address','garages.postal','garages.latitude','garages.longitude')
				->where('garages.status', 1)
				->where('garages_description.language_id', $language_id);
				
		/*if($distance_filters && $userLat && $userLong){
            $c_latitude =  $userLat; 
            $c_longitude =  $userLong; 
            
            $dist1 = " ( 6371 * acos( cos( radians($c_latitude) ) *
                            cos( radians( garages.latitude ) )
                            * cos( radians( garages.longitude ) - radians($c_longitude)
                            ) + sin( radians($c_latitude) ) *
                            sin( radians( garages.latitude ) ) )
                          )";
            
            $dist = "(6371 * acos(cos(radians($c_latitude)) 
                     * cos(radians(garages.latitude)) 
                     * cos(radians(garages.longitude) 
                     - radians($c_longitude)) 
                     + sin(radians($c_latitude)) 
                     * sin(radians(garages.latitude))))";
            $garages->where(function($query) use($dist , $distance_filters) {
                 return $query->selectRaw("{$dist} AS distance")
                        ->whereRaw("{$dist} < $distance_filters");
            });
            
        }*/

        if(count($city_ids) > 0){
            $garages->where(function($query) use($city_ids) {
                 return $query->whereIn('garages.city_id' , $city_ids);
            });
        }

        if(count($serviceRequestIds) > 0){
            $garages->where(function($query) use($serviceRequestIds) {
                  foreach($serviceRequestIds as $cf){
                    return $query->whereRaw("FIND_IN_SET($cf,garage_services.cat_id)")
                            ->orWhereRaw("FIND_IN_SET($cf,garage_services.sub_cat_id)");
                  }
            });
        }
       
        

        if ($type == "a to z") {
            $garages->orderBy('garages_description.garages_name' , 'ASC');
          //$sortby = "garages_name";
          //$order = "ASC";
        } elseif ($type == "z to a") {
           $garages->orderBy('garages_description.garages_name' , 'DESC');
        } elseif($type == 'latest') {
          $garages->orderBy('garages.created_at' , 'DESC');
        }elseif($type == 'feature') {
            $garages->where('garages.is_feature', 1);
        }else{
             $garages->orderBy('garages.created_at' , 'DESC');
        }
              
		//count
        $total_record = $garages->get();
        //$data = $garages->skip($skip)->take(10)->get();
        $data = $garages->get();
        
        
        
       // $c_latitude = '25.2048'; // $userLat; 
       // $c_longitude = '55.2708' ; //$userLong; 
        if(!$isAllGarageRequest){
            $c_latitude =  $userLat; 
            $c_longitude =  $userLong; 
    
            foreach($data as $key => $garage){
               // print_r($garage);
                $g_latitude = $garage->latitude; 
                $g_longitude = $garage->longitude; 
    
                $distanceInKm = self::calculateDistanceBetweenTwoPoints( $c_latitude, $c_longitude , $g_latitude,$g_longitude);
               
                if((int)$distanceInKm > (int)$distance_filters){
                    $data->forget($key);
                }
            }
        }
        

		$result = array();
		
		//check if record exist
		if (count($data) > 0) {
			$index = 0;
			foreach ($data as $garage_data) {
				
				$garageServices = GarageService::where('garage_id', $garage_data->id)->first();
				// get the garage services
	            $garage_cat_ids = $garage_sub_cat_ids = [];
	            if(!is_null($garageServices)){

	                $db_cat_ids = $garageServices['cat_id'];
	                $db_sub_cat_ids = $garageServices['sub_cat_id'];

	                
	               
	                if(stripos($db_cat_ids , ',') !== false) {
	                    $cat_id_arr[] = explode(',', $db_cat_ids);
	                    $garage_cat_ids = array_values($cat_id_arr[0]);
	                }else{
	                    $garage_cat_ids[] = $db_cat_ids;
	                }

	                if(stripos($db_sub_cat_ids , ',') !== false) {
	                    $sub_cat_id_arr[] = explode(',', $db_sub_cat_ids);
	                    $garage_sub_cat_ids = array_values($sub_cat_id_arr[0]);
	                }else{
	                    $garage_sub_cat_ids[] = $db_sub_cat_ids;
	                }
	            }
	             //dump( $garage_sub_cat_ids);
	            // dump( $garage_cat_ids);

	            // get the database categories
	            $finalGarageCategories = $finalGarageSubCategories = [];
	            if(isset($cat_id_arr) && count($cat_id_arr) > 0 && count($sub_cat_id_arr) > 0){
	                $subCats = $mainCats = [];
	                $categories = Section::where('status', 1)->get();
	                if(!$categories->isEmpty()){
	                    $categories = $categories->toArray();
	                    $i = 0;
	                    foreach ($categories as $cat) {
	                        if($cat['parent'] == 0){
	                            if(in_array($cat['id'], $garage_cat_ids)){
	                                $finalGarageCategories[$cat['id']] = $cat['name'];
	                            }
	                        }

	                        if($cat['parent'] != 0){
	                            if(in_array($cat['id'], $garage_sub_cat_ids)){
	                                $finalGarageSubCategories[$cat['parent']][$cat['id']] = $cat['name'];
	                            }
	                        }
	                    }
	                }
	            }
	          
	            $garage_data->mainCats = $finalGarageCategories;
	            $garage_data->subCats = $finalGarageSubCategories;

	            $garage_data->garageimages = GarageImage::where('garage_id', $garage_data->id)->get();  
	            $garage_data->garageVideos = GarageVideo::where('garage_id', $garage_data->id)->get();  
	          
	            $garage_data->garageworkingHours = GarageWorkingHour::where('garage_id', $garage_data->id)->select('mon as Monday', 'tue as Tuesday','wed as Wednesday','thu as Thursday','fri as Friday','sat as Saturday', 'sun as Sunday')->first();
				

	            array_push($result, $garage_data);
				
                $index++;
            }

            $responseData = array('success' => '1', 'garage_data' => $result, 'message' => "Returned all garages.", 'total_record' => $total_record);
		} else {
		  $responseData = array('success' => '0', 'garage_data' => $result, 'message' => "Empty record.", 'total_record' => count($data));
		}
          
      } else {
          $responseData = array('success' => '0', 'garage_data' => array(), 'message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);

      return $categoryResponse;
  }

  public static function calculateDistanceBetweenTwoPoints($latitudeOne='', $longitudeOne='', $latitudeTwo='', $longitudeTwo='',$distanceUnit ='',$round=false,$decimalPoints='')
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

  public static function getFeaturedGarages($request){

      $language_id = $request->language_id;
      $skip = $request->page_number . '0';
      $currentDate = time();
      $type = $request->type;

      //filter
      //return 'test';
      if(isset($request->distance['minDistance'])) {
          $minDistance = $request->distance['minDistance'];
      } else {
          $minDistance = '';
      }
      if(isset($request->distance['maxDistance'])) {
          $maxDistance = $request->distance['maxDistance'];
      } else {
          $maxDistance = '';
      }
      //$maxDistance = $request->distance['maxDistance'];
      $consumer_data = array();
      $consumer_data['consumer_key'] = request()->header('consumer-key');
      $consumer_data['consumer_secret'] = request()->header('consumer-secret');
      $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
      $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
      $consumer_data['consumer_ip'] = request()->header('consumer-ip');
      $consumer_data['consumer_url'] = __FUNCTION__;

      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);

      if ($authenticate == 1) {

        if ($type == "a to z") {
          $sortby = "garages_name";
          $order = "ASC";
        } elseif ($type == "z to a") {
          $sortby = "garages_name";
          $order = "DESC";
        } else {
          $sortby = "garages.id";
          $order = "desc";
        }

        $garages =  Garage::query()
                ->join('garages_description','garages_description.garages_id' , 'garages.id')
                ->join('cities','cities.id' , 'garages.city_id')
                ->join('countries','countries.id' , 'garages.country_id')
                ->select('garages.id','garages.profile_image as image','garages_description.garages_name','garages_description.garages_description','cities.name as city_name', 'countries.countries_name as country_name','garages.address as address','garages.postal')
                ->where('garages.status', 1)
                ->where('garages.is_feature', 1)
                ->where('garages_description.language_id', $language_id);
              
        //count
        $total_record = $garages->get();
        $data = $garages->skip($skip)->take(10)->get();
        $result = array();

        //check if record exist
        if (count($data) > 0) {
            $index = 0;
            foreach ($data as $garage_data) {
                
                $garageServices = GarageService::where('garage_id', $garage_data->id)->first();
                // get the garage services
                $garage_cat_ids = $garage_sub_cat_ids = [];
                if(!is_null($garageServices)){

                    $db_cat_ids = $garageServices['cat_id'];
                    $db_sub_cat_ids = $garageServices['sub_cat_id'];

                    
                   
                    if(stripos($db_cat_ids , ',') !== false) {
                        $cat_id_arr[] = explode(',', $db_cat_ids);
                        $garage_cat_ids = array_values($cat_id_arr[0]);
                    }else{
                        $garage_cat_ids[] = $db_cat_ids;
                    }

                    if(stripos($db_sub_cat_ids , ',') !== false) {
                        $sub_cat_id_arr[] = explode(',', $db_sub_cat_ids);
                        $garage_sub_cat_ids = array_values($sub_cat_id_arr[0]);
                    }else{
                        $garage_sub_cat_ids[] = $db_sub_cat_ids;
                    }
                }
                 //dump( $garage_sub_cat_ids);
                // dump( $garage_cat_ids);

                // get the database categories
                $finalGarageCategories = $finalGarageSubCategories = [];
                if(isset($cat_id_arr) && count($cat_id_arr) > 0 && count($sub_cat_id_arr) > 0){
                    $subCats = $mainCats = [];
                    $categories = Section::where('status', 1)->get();
                    if(!$categories->isEmpty()){
                        $categories = $categories->toArray();
                        $i = 0;
                        foreach ($categories as $cat) {
                            if($cat['parent'] == 0){
                                if(in_array($cat['id'], $garage_cat_ids)){
                                    $finalGarageCategories[$cat['id']] = $cat['name'];
                                }
                            }

                            if($cat['parent'] != 0){
                                if(in_array($cat['id'], $garage_sub_cat_ids)){
                                    $finalGarageSubCategories[$cat['parent']][$cat['id']] = $cat['name'];
                                }
                            }
                        }
                    }
                }
              
                $garage_data->mainCats = $finalGarageCategories;
                $garage_data->subCats = $finalGarageSubCategories;

                $garage_data->garageimages = GarageImage::where('garage_id', $garage_data->id)->get();  
                $garage_data->garageVideos = GarageVideo::where('garage_id', $garage_data->id)->get();  
              
                $garage_data->garageworkingHours = GarageWorkingHour::where('garage_id', $garage_data->id)->select('mon as Monday', 'tue as Tuesday','wed as Wednesday','thu as Thrusday','fri as Friday','sat as Saturday', 'sun as Sunday')->first();
                

                array_push($result, $garage_data);
                
                $index++;
            }

            $responseData = array('success' => '1', 'garage_data' => $result, 'message' => "Returned all garages.", 'total_record' => count($total_record));
        } else {
          $responseData = array('success' => '0', 'garage_data' => $result, 'message' => "Empty record.", 'total_record' => count($total_record));
        }
          
      } else {
          $responseData = array('success' => '0', 'garage_data' => array(), 'message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);

      return $categoryResponse;
  }

    public static function getClientID($user_id){
         $client = Client::where('user_id', $user_id)->first();
         if(!empty($client)){
             return $client->id;
         }else{
             return null;
         }
    }



    public static function mypayments($request)
    {
        $client_id = self::getClientID($request->client_id);
       
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        $extensions = array('gif', 'jpg', 'jpeg', 'png');

        if ($authenticate == 1) {

            $sr_payment = ServiceRequestPayment::join('service_request','service_request_payment.service_request_id','service_request.id')
                            ->where('service_request.client_id', $client_id)
                            ->orderBy('date' , 'DESC')
                            ->get();

            $ps_payment =  ClientPackageSubscribePayment::join('service_request','client_package_subscribe_payments.client_package_subscribe_id','service_request.id')
                                   ->where('service_request.client_id', $client_id)->orderBy('date' , 'DESC')->get();

            $payments = array_merge($sr_payment->toArray(), $ps_payment->toArray() );
            
            if(count($payments) > 0 )
                $responseData = array('success' => '1', 'data' => $payments, 'message' => "Return All Payments!");
            else
                 $responseData = array('success' => '1', 'data' => $payments, 'message' => "Return No Records!");
            

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function getVehicles($request)
    {
        //echo $request->client_id;die;
        $client_id = self::getClientID($request->client_id);
       
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        $extensions = array('gif', 'jpg', 'jpeg', 'png');

        if ($authenticate == 1) {

            $vehicles = Vehicle::query()->where('client_id', $client_id)->with('vmake','vmodel')->where('status', '=', 1 )->get();
            
            if(count($vehicles) > 0 )
                $responseData = array('success' => '1', 'data' => $vehicles, 'message' => "Return All Vehicles!");
            else
                 $responseData = array('success' => '1', 'data' => $vehicles, 'message' => "Return No Records!");
            

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function addVehicle($request)
    {
       $client_id = self::getClientID($request->client_id);
       
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $vehicle = new Vehicle();
            $vehicle->client_id = $client_id;
            $vehicle->registration_no = !empty($request->registration_no) ? $request->registration_no : null;
            $vehicle->chassis_no = !empty($request->chassis_no) ? $request->chassis_no : null;
            $vehicle->plate_no = !empty($request->plate_no) ? $request->plate_no : null;
            $vehicle->make = $request->make;
            $vehicle->model = $request->model;
            $vehicle->color = !empty($request->color) ? $request->color : null;
            $vehicle->year = $request->year;
            $vehicle->current_mileage = !empty($request->current_mileage) ? $request->current_mileage : null;
            $vehicle->status = $request->status;

            if($vehicle->save()){
                $responseData = array('success' => '1', 'data' => array(), 'message' => "New vehicle saved successfully.");
            }else{
                 $responseData = array('success' => '0', 'data' => array(), 'message' => "Something went wrong! Failed to save new vehicle data.");
            }

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }


    public static function updateVehicle($request)
    {
        $vehicle_id = $request->vehicle_id;

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            Vehicle::where('id', $vehicle_id)
            ->update([
                'registration_no' => !empty($request->registration_no) ? $request->registration_no : null,
                'chassis_no' => !empty($request->chassis_no) ? $request->chassis_no : null,
                'plate_no' => !empty($request->plate_no) ? $request->plate_no : null,
                'make' => $request->make,
                'model' => $request->model,
                'color' => !empty($request->color) ? $request->color : null,
                'year' => $request->year,
                'current_mileage' => !empty($request->current_mileage) ? $request->current_mileage : null,
                'status' => $request->status
            ]);
            
             $responseData = array('success' => '1', 'data' => array(), 'message' => "Update vehicle successfully!");
            

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function deleteVehicle($request)
    {
        $vehicle_id = $request->vehicle_id;
       
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            Vehicle::where('id', $vehicle_id)->update(['status' => 2]);
            $responseData = array('success' => '1', 'data' => array(), 'message' => "Vehicle deleted successfully!");

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function deleteClientLocation($request)
    {
        /*$responseData = array('success' => '1', 'data' => array(), 'message' => "hello!");
        $userResponse = json_encode($responseData);
        print $userResponse;
        die();*/
        $location_id = $request->location_id;

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            ClientLocation::where('id', $location_id)->update(['status' => 'Inactive']);
            $responseData = array('success' => '1', 'data' => array(), 'message' => "Location deleted successfully!");

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function getVehicleMakes($request)
    {
        
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $VehicleMake = VehicleMake::where('active' , 1)->get();
            if(count($VehicleMake) > 0){
                $responseData = array('success' => '1', 'makes' => $VehicleMake , 'message' => "Return all vehicle makes");
            }else{
                $responseData = array('success' => '0', 'makes' => array() , 'message' => "Return no records.");
            }

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function getVehicleModels($request)
    {
        $vehicle_make_id = $request->vehicle_make_id;
       
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $VehicleModels  =  VehicleModel::query()->where('vehicle_make_id', $vehicle_make_id)->where('active' , 1)->get();

            if(count($VehicleModels) > 0){
                $responseData = array('success' => '1', 'models' => $VehicleModels , 'message' => "Return all vehicle models");
            }else{
                $responseData = array('success' => '0', 'models' => array() , 'message' => "Return no records.");
            }
            

        } else {
            $responseData = array('success' => '0', 'models' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function getSingleVehicle($request)
    {
        $client_id = self::getClientID($request->client_id);
        $vehicle_id = $request->vehicle_id;
       
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $vehicles = Vehicle::where('id', $vehicle_id)->where('client_id', $client_id)->with('vmake','vmodel')->get();
            
            if(count($vehicles) > 0 )
                $responseData = array('success' => '1', 'data' => $vehicles, 'message' => "Return All Vehicles!");
            else
                 $responseData = array('success' => '1', 'data' => $vehicles, 'message' => "Return No Records!");
            

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

}
