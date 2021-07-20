<?php

namespace Modules\Garage\Http\Controllers;

use Validator;
use DB;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
use Carbon;
use Illuminate\Support\Facades\Mail;
use Session;
use View;
use Config;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Languages;
use App\Models\Autoshop\Currency;

use App\Models\Core\Setting;

use App\User;
use App\Section;
use App\Garage;
use App\ServicePackage;
use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ServiceRequestLog;

use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;


use App\Http\Controllers\App\AlertController;


class CustomerController extends Controller
{   

    public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

    
    public function updateClientPackageSubscription($id, $data){
        return ClientPackageSubscribe::where('id' , $id)->update($data);
    }

    public function insertClientPackageSubscribePayment($client_package_subscribe_id,$amount , $status, $date, $payment_type ){

        $clientPackageSubscribePayment = new ClientPackageSubscribePayment();
        $clientPackageSubscribePayment->client_package_subscribe_id = $client_package_subscribe_id;
        $clientPackageSubscribePayment->amount = $amount;  
        $clientPackageSubscribePayment->status = $status;  
        $clientPackageSubscribePayment->date = $date;  
        $clientPackageSubscribePayment->payment_type = $payment_type;  
        $clientPackageSubscribePayment->save();

    }

    public function upadteClientPackageSubscribePayment($clientPackageSubscribePayment, $data){
        return $clientPackageSubscribePayment->update([$data]);
    }
    
    public function updateClientPackageSubscribeLog($id, $description){
        $clientPackageSubscribeLog = new ClientPackageSubscribeLog();
        $clientPackageSubscribeLog->client_package_subscribe_id = $id;
        $clientPackageSubscribeLog->description = $description;
        $clientPackageSubscribeLog->save();
    }

    public function getPackageSubscribeUser($id , $is_custom = 0){
        return ClientPackageSubscribe::where('id' , $id)->where('is_custom' , $is_custom)->first();
    }


    public function getSubscriptionEndDate($subscription_start_at , $duration){
        $daystosum = (int)$duration;
        return date('Y-m-d', strtotime($subscription_start_at.' + '.$daystosum.' days'));
    }

    public function getSubscriptionStartDate(){
        return date('Y-m-d');
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



    // get All customers
    public function list(){  

        $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        $garage_users = auth()->guard('vendor')->user();
        $garage = Garage::where('user_id',$garage_users->id)->first();

        $sr_customers = ServiceRequest::where('garage_id', $garage->id)->with('client','category','status')->get();
        $ps_customers = ClientPackageSubscribe::where('garage_id', $garage->id )->with('client','category','status')->get();
        $customers = array_merge($sr_customers->toArray(), $ps_customers->toArray() );
        //dd($data);die;

        return view("garage::customer.list",['pageTitle' => $pageTitle , 'customers' => $customers])->with('result', $result);
       
    }

    /* Customer Package Subscription...  */
    public function customerPackagesSubscription(){

         $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        $garage_users = auth()->guard('vendor')->user();
        $garage = Garage::where('user_id',$garage_users->id)->firstOrFail();

        $customersIDs = User::where('role_id', 2)->pluck('id')->toArray();

        $customers = ClientPackageSubscribe::where('garage_id', $garage->id)->orderBy('updated_at','desc')
                    ->with('client','servicePackage')
                    ->get();

        foreach ($customers as $key => $value) {
             if(isset($value->client->user_id) && !in_array($value->client->user_id, $customersIDs))
                unset($customers[$key]);
        }

        $packageStatus = $this->getPackageSubscribeStatusArr();

        return view("garage::customer.packages-subscribed",['pageTitle' => $pageTitle , 'customers' => $customers , 'packageStatus' => $packageStatus])->with('result', $result);

        
    }


     /* Customer Package Subscription Settings...  */
    public function customerPackagesSubscriptionSettings($id){

        $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $ps = ClientPackageSubscribe::where('id' , $id)->with('client','servicePackage','vehicle')->firstOrFail();
        
            $packageStatus = $this->getPackageSubscribeStatusName($ps->status);
            $ps_payment = ClientPackageSubscribePayment::where('client_package_subscribe_id', $id)->first();
            $paymentStatus = $this->getPackagePaymentStatusName($ps_payment->status);

            return view("garage::customer.ps.setting",['pageTitle' => $pageTitle , 'ps' => $ps , 'packageStatus' => $packageStatus, 'ps_payment' => $ps_payment , 'paymentStatus' => $paymentStatus])->with('result', $result);
                
        
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

     /* Custom Customer Package Subscription Settings...  */
    public function customerCustomPackagesSubscriptionSettings($id){

        $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->with('client','servicePackage','vehicle')->first();
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
                $data['packageStatus'] = $this->getPackageSubscribeStatusName($clientPackageSubscribe->status);
                $data['ps'] = $clientPackageSubscribe;
                $data['ps_payment'] = ClientPackageSubscribePayment::where('client_package_subscribe_id', $id)->first();
                if(is_null($data['ps_payment'])){
                    $data['ps_payment'] = null;
                }else{
                    $data['paymentStatus'] = $this->getPackagePaymentStatusName($data['ps_payment']->status);
                }
                return view('garage::customer.cp.settings', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

     /*  All Customer Package Subscription Logs...  */
    public function customerPackagesSubscriptionLogs($id){

         $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $ps = ClientPackageSubscribe::where('id' , $id)->with('client')->first();
            if(!empty($ps)){
                $logs = ClientPackageSubscribeLog::where('client_package_subscribe_id' , $id)->get();
                
                return view("garage::customer.ps.logs",['pageTitle' => $pageTitle , 'ps' => $ps , 'logs' => $logs])->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    /* CUSTOM PACKAGE QUOTE AMOUNT UPADTE */
    public function customerCustomPackagesQuoteAmountUpdate(Request $request){

        $validator = Validator::make($request->all(), [
                'amount' => 'required',
                'id' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $id = $request->id;
        $clientPackageSubscribe = $this->getPackageSubscribeUser($id , 1);
        //dd($clientPackageSubscribe);
        if(!empty($clientPackageSubscribe)){

            // update client subscription table
            $this->updateClientPackageSubscription($clientPackageSubscribe->id,[
                'amount' => $request->amount,
                'status' => 5
            ]);

            // update payment transaction table
            $this->insertClientPackageSubscribePayment($clientPackageSubscribe->id,$request->amount , 3, null, null );


            $status_msg = 'Garage Quote Amount Updated. Wait for the customer to paid the quote amount.';
            
            // update log table...
            $this->updateClientPackageSubscribeLog($id, $status_msg);

            // redirect with message
            return \Redirect::back()->with('status', $status_msg);
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }


     


     public function packagesSubscribedUpdatePackageStatus(Request $request){

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'status' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $id = $request->id;
        $clientPackageSubscribe = $this->getPackageSubscribeUser($id , 0);
        if(!empty($clientPackageSubscribe)){

            $subscription_start_at = date('Y-m-d');
            $daystosum = (int)$packagesSubscribed->period;
            $subscription_end_at = date('Y-m-d', strtotime($subscription_start_at.' + '.$daystosum.' days'));

            // update client subscription table
            $this->updateClientPackageSubscription($clientPackageSubscribe->id, [
                    'status' => $request->status,
                    'subscription_start_at' => $this->getSubscriptionStartDate(),
                    'subscription_end_at' => $this->getSubscriptionEndDate($this->getSubscriptionStartDate() , $duration)

                ]);

            if( $request->status == 1){
                $st = 'Active';
            }elseif( $request->status == 2){
                $st = 'Rejected';
            }elseif( $request->status == 3){
                $st = 'Pending';
            }else{
                $st = 'Suspended';
            }


            // TODO update logs...
            $clientPackageSubscribeLog = new ClientPackageSubscribeLog();
            $clientPackageSubscribeLog->client_package_subscribe_id = $id;
            $clientPackageSubscribeLog->type = 'Package';
            $clientPackageSubscribeLog->description = 'Package status update as '.$st ;
            $clientPackageSubscribeLog->save();


            return \Redirect::back()->with('status', 'Package status updated successfully');
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function updateCodPaymentStatusPackageSubscription(Request $request){

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $id = $request->id;
        $packagesSubscribedPayment = ClientPackageSubscribePayment::where('client_package_subscribe_id' , $id)->first();
        if(!empty($packagesSubscribedPayment)){

            if( $request->status == 1){
                

                $package = ServicePackage::where('id' , $request->service_package_id)->first();
                $subscription_start_at = date('Y-m-d');
                $daystosum = (int)$package->period;
                $subscription_end_at = date('Y-m-d', strtotime($subscription_start_at.' + '.$daystosum.' days'));
                ClientPackageSubscribe::where('id', '=', $id)->update([
                    'status' => 1,
                    'subscription_start_at' => $subscription_start_at,
                    'subscription_end_at' => $subscription_end_at,
                ]);
                $status_msg = 'Package Payment Success(COD mode) !!! - Package activate successfully .';
            }elseif( $request->status == 2){
                 ClientPackageSubscribe::where('id', '=', $id)->update([
                    'status' => 2
                ]);
                $status_msg = 'Package Payment Failed(COD mode) !!! -  Package failed to activate.';
            }

            ClientPackageSubscribePayment::where('id', '=', $packagesSubscribedPayment->id)->update([
                    'status' =>  $request->status
                ]);

             // update log table...
            $this->updateClientPackageSubscribeLog($id, $status_msg);

           

            return \Redirect::back()->with('status', $status_msg);
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    



    /*
    
        Service Request....
     */
    public function serviceRequests()
    {
        $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        $garage_users = auth()->guard('vendor')->user();
        $garage = Garage::where('user_id',$garage_users->id)->firstOrFail();

        $customersIDs = User::where('role_id', 2)->pluck('id')->toArray();

        $customers = ServiceRequest::
                    where('garage_id', $garage->id)->orderBy('updated_at','desc')
                    ->with('client','category')
                    ->get();
        foreach ($customers as $key => $value) {
            if(isset($value->client->user_id) && !in_array($value->client->user_id, $customersIDs))
                unset($customers[$key]);
        }

        return view("garage::customer.service-request",['pageTitle' => $pageTitle , 'customers' => $customers])->with('result', $result);
       
    }


    public function serviceRequestLogs($id){

        $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        $loggedGarage = auth()->guard('vendor')->user();
        $garageUser = Garage::where('user_id', $loggedGarage->id)->firstOrFail();
        if(!empty(trim($id)) && !empty($garageUser)){

            $sr = ServiceRequest::where('id' , $id)->where('garage_id', $garageUser->id)->with('client')->firstOrFail();
            $user = User::findOrFail($sr->client->user_id);

            $logs = ServiceRequestLog::where('service_request_id' , $id)->get();

            return view("garage::customer.sr.logs",['pageTitle' => $pageTitle , 'logs' => $logs,'sr' => $sr])->with('result', $result);
            
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

     public function serviceRequestSettings($id){

        $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        $loggedGarage = auth()->guard('vendor')->user();
        $garageUser = Garage::where('user_id', $loggedGarage->id)->firstOrFail();
        if(!empty(trim($id)) && !empty($garageUser)){
            $sr = ServiceRequest::where('id' , $id)->where('garage_id', $garageUser->id)->with('client','category','vehicle')->firstOrFail();

            $user = User::findOrFail($sr->client->user_id);
            $sr_payment = ServiceRequestPayment::where('service_request_id', $id)->first();
            return view("garage::customer.sr.setting",['pageTitle' => $pageTitle , 'sr_payment' => $sr_payment,'sr' => $sr])->with('result', $result);
            


        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function updateserviceRequestQuoteAmount(Request $request){

        //echo '<pre>';
        //print_r($request->amount_json);


        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $id = $request->id;
        $serviceRequest = ServiceRequest::where('id' , $id)->first();

        if(!empty($serviceRequest)){
            ServiceRequest::where('id', '=', $id)
                            ->update([
                                'status' => 'request-payment',
                                'quote_amount' => $request->amount,
                                //'amount_json' => json_encode($request->amount_json),
                                'amount_json' => $request->amount_json,
                            ]);

             // transaction entry as pending
            $serviceRequestPayment = new ServiceRequestPayment();
            $serviceRequestPayment->service_request_id = $id;
            $serviceRequestPayment->amount = $request->amount;
            $serviceRequestPayment->status = 3; // pending status
            $serviceRequestPayment->save();
       
            // log entry
            $serviceRequestLog = new ServiceRequestLog();
            $serviceRequestLog->service_request_id = $id;
            $serviceRequestLog->description = 'GARAGE UPDATE. Your requested garage has sent you the quotation. Kindly check Service Request in menu.';
            $serviceRequestLog->save();
			
			$alertCont = new AlertController();
			$alertCont->garagePriceAlert($serviceRequest);

            return \Redirect::back()->with('status', 'Service request status updated successfully');
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

     public function updateServiceRequestStatus(Request $request){

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $id = $request->id;
        $serviceRequest = ServiceRequest::where('id' , $id)->first();
        if(!empty($serviceRequest)){

            ServiceRequest::where('id', '=', $id)->update(['status' => $request->status ]);

            // log entry
            $serviceRequestLog = new ServiceRequestLog();
            $serviceRequestLog->service_request_id = $id;
            $serviceRequestLog->description = 'Garage has update status as '. $request->status;
            $serviceRequestLog->save();
			
			if($request->status == 'cancel'){
				$alertCont = new AlertController();
				$alertCont->serviceRequestCancelAlert($serviceRequest);
			}

            return \Redirect::back()->with('status', 'Service request status updated successfully');
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function updateserviceRequestPaymentStatus(Request $request){

        $id = $request->id;
        $serviceRequestPayment = ServiceRequestPayment::where('service_request_id' , $id)->first();
        if(!empty($serviceRequestPayment)){

             $validator = Validator::make($request->all(), [
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                            ->withErrors($validator)
                            ->withInput();
            }

            ServiceRequestPayment::where('id', '=', $request->id)
            ->update([
                'status' => $request->status
            ]);

             if( $request->status == 1){
                $st = 'Success';
            }elseif( $request->status == 2){
                $st = 'Failed';
            }else{
                $st = 'Pending';
            }

             // TODO update logs...
            $serviceRequestLog = new ServiceRequestLog();
            $serviceRequestLog->service_request_id = $id;
            $serviceRequestLog->type = 'Payment';
            $serviceRequestLog->description = 'Package payment status update as '.$st ;
            $serviceRequestLog->save();

            return \Redirect::back()->with('status', 'Package payment status updated successfully');
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }



     // get All customers package Subscribed
    public function paymentsReceived()
    {
        $garage_users = auth()->guard('vendor')->user();
        $garage = Garage::where('user_id',$garage_users->id)->first();

        $sr_payment = ServiceRequestPayment::join('service_request','service_request_payment.service_request_id','service_request.id')
                            ->where('service_request.garage_id', $garage->id)->get();

        $ps_payment =  ClientPackageSubscribePayment::join('service_request','client_package_subscribe_payments.client_package_subscribe_id','service_request.id')
                               ->where('service_request.garage_id', $garage->id)->get();

        $data['payments'] = array_merge($sr_payment->toArray(), $ps_payment->toArray() );
        
        return view('garage::customer.payments', $data);
    }

}
