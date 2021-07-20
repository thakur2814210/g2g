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

        $data['packages'] = ClientPackageSubscribe::where('client_id', Auth::user()->id)
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
        return view('client::package.booking-confimation');
    }

    public function create($slug){
        $data = [];
        if(!empty($slug)){
            $data['cat_slug'] = $slug;

            if($slug == 'custom-package'){
                return $this->customPackage();
            }else{
                $category = Section::where('status', 1)->where('slug', $slug)->first();
                if(!empty($category)){
                    $data['categories'] = $category;

                    $packages = ServicePackage::active()
                                ->where('section_id' , $category->id)
                                ->with('packageFeatures','section')
                                ->get();
                   
                    if(empty($packages) || $packages->count() == 0){
                       return  redirect()->back()->with('status', "No Package Exist!!! - We don't have any packages in that category, so nothing is displayed. Please contact admin for further assistance.");
                    }

                    $data['packages'] = $packages;

                    $data['vehicles'] = Vehicle::where('client_id' , Auth::user()->id)->where('status' ,1)->get();
                    $data['vehicle_makes'] = VehicleMake::active()->get();
                    $data['cities'] = City::active()->get();
                    $data['countries'] = Country::active()->get();
                    $data['client'] = Client::where('id' , Auth::user()->id)->where('status' ,1)->first();
                    $data['c_locations'] = ClientLocation::active()->where('client_id' , Auth::user()->id)->get();
                    return view('client::package.add-package', $data);
                }
            }
            
        }
        return view('client::error' , ['message' =>'Category does not exist !!!' ]);
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


    // currently payment is cod
    // Garage confirmation required...
    public function save(Request $request){

        $validator = Validator::make($request->all(), [
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


        $client = Client::where('id', Auth::user()->id)->first();
        if(!empty($client)){

           
            $service_package = ServicePackage::where('id' , $request->package_id)->first();
            if(!empty( $service_package)){

                 // check if already any package is active for the same
                /*$is_allowed = ClientPackageSubscribe::where('vehicle_id',$request->vehicle_id )
                                                     ->where('client_id' , $client->id)
                                                     ->where('status' ,1)
                                                 ->first();*/

                // TODO
                // for temperory we allow multple pckage for same vehicle
                $is_allowed = null;


                if(is_null($is_allowed)){

                    $clientPackageSubscribe = new ClientPackageSubscribe();
                    $clientPackageSubscribe->client_id = $client->id;
                    $clientPackageSubscribe->vehicle_id = $request->vehicle_id;
                    $clientPackageSubscribe->service_package_id = $service_package->id;
                    $clientPackageSubscribe->garage_id = $request->garage_id;
                    $clientPackageSubscribe->address = $request->address;
                    $clientPackageSubscribe->latitude = $request->latitude;
                    $clientPackageSubscribe->longitude = $request->longitude;
                    $clientPackageSubscribe->city_id = $request->city_id;
                    $clientPackageSubscribe->country_id = $request->country_id;
                    $clientPackageSubscribe->pobox = $request->pobox;
                    
                    $clientPackageSubscribe->status = 3; // pending...
                    $clientPackageSubscribe->amount = $service_package->price;  

                    if($clientPackageSubscribe->save()){

                        $clientPackageSubscribePayment = new ClientPackageSubscribePayment();
                        $clientPackageSubscribePayment->client_package_subscribe_id = $clientPackageSubscribe->id;
                        $clientPackageSubscribePayment->amount = $service_package->price;  
                        $clientPackageSubscribePayment->payment_type = 'cod';  
                        $clientPackageSubscribePayment->status = 3;  
                        $clientPackageSubscribePayment->save();


                        $clientPackageSubscribeLog = new ClientPackageSubscribeLog();
                        $clientPackageSubscribeLog->client_package_subscribe_id = $clientPackageSubscribe->id;
                        $clientPackageSubscribeLog->description = ' Package Subscription requested!!! - Customer subscribe the package but Payment approval required by the Garage.';
                        $clientPackageSubscribeLog->save();

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
          $data = [];
        $category_ids = [];
        $category_checkbox = $request->category_checkbox;
        if(!empty($category_checkbox)){
            $category_ids = explode(',', $category_checkbox);

            $customer = Client::where('id', Auth::user()->id)->first();
            if(is_null($customer)){
                 return response()->json(['html' => 'Someting went wrong!!! Customer does not exist.']);
            }

            $s_latitude = $customer->latitude;
            $s_longitude = $customer->longitude;
            $s_city_id = $customer->city;
            $s_country_id = $customer->country;
       
          
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
    }



    public function getGarageByCategory( Request $request){
        
        $cat_slug = $request->category;
        $category = Section::where('status', 1)->where('slug', $cat_slug)->first();
        if(is_null($category)){
             return response()->json(['html' => 'Someting went wrong!!! Service is not found in our database.']);
        }else{
            $s_category = $category->id;
        }

        $customer = Client::where('id', Auth::user()->id)->first();
        if(is_null($customer)){
             return response()->json(['html' => 'Someting went wrong!!! Customer does not exist.']);
        }

        $s_latitude = $customer->latitude;
        $s_longitude = $customer->longitude;
        $s_city_id = $customer->city;
        $s_country_id = $customer->country;

        if(!empty($s_latitude) && !empty($s_longitude) && !empty($s_city_id) && !empty($s_country_id)){

             $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->select('garages.*')
                        ->where(function($query) use($s_category) {
                            return $query->whereRaw("FIND_IN_SET($s_category,garage_services.cat_id)")
                                        ->orWhereRaw("FIND_IN_SET($s_category,garage_services.sub_cat_id)");
                            
                        })
                        ->where('garages.city_id', $s_city_id)
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
                    if(round($distanceInKm,2) > round(10.00,2)){
                        $garages->forget($key);
                    }
                }
            }
            $data['garages'] = $garages;
            $view  = (string)\View::make('client::service-request.includes.garage-list',$data);
            return response()->json(['html' => $view]);

        }
        return response()->json(['html' => 'Someting went wrong!!! Customer address not found, Please go through profile and updated address.']);



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
        $data['cat_slug'] = 'custom-package';

        $subCats = $mainCats = [];
        $categories = Section::where('status', 1)->get();
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

        $data['vehicles'] = Vehicle::where('client_id' , Auth::user()->id)->where('status' ,1)->get();
        $data['vehicle_makes'] = VehicleMake::active()->get();
        $data['cities'] = City::active()->get();
        $data['countries'] = Country::active()->get();
        $data['client'] = Client::where('id' , Auth::user()->id)->where('status' ,1)->first();
        $data['c_locations'] = ClientLocation::active()->where('client_id' , Auth::user()->id)->get();
                
        //dd($data);
        return view('client::package.custom-package.add-custom-package', $data);
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

        $client = Client::where('id', Auth::user()->id)->first();
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
