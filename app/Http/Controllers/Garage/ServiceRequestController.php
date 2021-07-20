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

class ServiceRequestController extends Controller
{

  

    public function index()
    {	
        $serviceRequests = ServiceRequest::where('client_id', Auth::user()->id)
                        ->orderBy('updated_at','desc')
                        ->with('category' , 'garage')
                        ->get();
        $data['serviceRequests'] =  $serviceRequests;
        return view('client::service-request.index', $data);
    }

   public function logs($id){
        if(!empty($id)){
            $serviceRequest = ServiceRequest::where('id' , $id)->with('client')->first();
            if(!empty($serviceRequest)){
                $data['sr'] = $serviceRequest;
                $data['logs'] = ServiceRequestLog::where('service_request_id' , $id)->get();
                return view('client::service-request.logs', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

     public function settings($id){
        if(!empty($id)){
            $serviceRequest = ServiceRequest::where('id' , $id)->with('client','category','vehicle')->first();
            if(!empty($serviceRequest)){
                $data['sr'] = $serviceRequest;
                $data['sr_payment'] = ServiceRequestPayment::where('service_request_id', $id)->first();
                return view('client::service-request.setting', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    // Show service request booking confirmation...
    public function bookingConfrimed(){
        return view('client::service-request.booking-confimation');
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
        if(!empty($slug)){
            $data['cat_slug'] = $slug;
            $category = Section::where('status', 1)->where('slug', $slug)->first();
            if(!empty($category)){

                $data['categories'] = $category;
                $data['vehicles'] = Vehicle::where('client_id' , Auth::user()->id)->where('status' ,1)->get();
                $data['c_locations'] = ClientLocation::active()->where('client_id' , Auth::user()->id)->get();
                $data['vehicle_makes'] = VehicleMake::active()->get();
                $data['cities'] = City::active()->get();
                $data['countries'] = Country::active()->get();
                $data['client'] = Client::where('id' , Auth::user()->id)->where('status' ,1)->first();
                //dd( $data['vehicles']);
                return view('client::service-request.create-service-request', $data);
            }
        }
        return view('client::error' , ['message' =>'Category does not exist !!!' ]);
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
            'vehicle_id' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }


        $slug = $request->cat_id;
        $category = Section::where('status', 1)->where('slug', $slug)->first();
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
                $serviceRequest->client_id = Auth::user()->id;
                $serviceRequest->vehicle_id = $request->vehicle_id;
                $serviceRequest->garage_id = $request->garage_id;
                $serviceRequest->address = $request->address;
                $serviceRequest->latitude = $request->latitude;
                $serviceRequest->longitude = $request->longitude;
                $serviceRequest->city = $request->city;
                $serviceRequest->country = $request->country;
                $serviceRequest->status = 'new';
                $serviceRequest->pobox = $request->pobox;
                $serviceRequest->faults_remarks = $request->faults_remarks;
                $serviceRequest->image = $image_str;
                $serviceRequest->appointment_at = (!empty($request->appointment_at)) ? date('Y-m-d H:i:s', strtotime($request->appointment_at)) : null;
                if( $serviceRequest->save()){
                    // Send Mail to Admin and Garage without customer identity.
                    
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

        $category = Section::where('status', 1)->where('slug', $cat_slug)->first();
        if(is_null($category)){
             return response()->json(['html' => 'Someting went wrong!!! Service is not found in our database.']);
        }else{
            $s_category = $category->id;
        }

        if(!empty($s_latitude) && !empty($s_longitude)){

             $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->select('garages.*')
                        ->where(function($query) use($s_category , $cat_slug) {
                            if($cat_slug != 'custom-request')
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
                    if(round($distanceInKm,2) > round($s_distance,2)){
                        $garages->forget($key);
                    }
                }
            }
            $data['garages'] = $garages;
            $view  = (string)\View::make('client::service-request.includes.garage-list',$data);
            return response()->json(['html' => $view]);

        }
        return response()->json(['html' => 'Mandatory field is missing...']);
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
