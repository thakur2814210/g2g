<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\GaragePackageSubscribe;
use App\GaragePackageSubscribeLog;
use App\GaragePackageSubscribePayment;

use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;

use DB;
use App\Models\Core\Setting;
use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang;


class SubscriptionController extends Controller
{
   
    public function __construct( Setting $setting){
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
    }

    public function customerSubscriptionList(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	$data['subscriptions'] = ClientPackageSubscribe::with('garage','servicePackage')
    							->orderBy('updated_at', 'DESC')
    							->get();
        return view('admin::subscription.customer_list' , $data)->with('result', $result);
    }

     public function customerSubscriptionLogs($id){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->with('client')->first();
            if(!empty($clientPackageSubscribe)){
                $data['clientPackageSubscribe'] = $clientPackageSubscribe;
                $data['logs'] = ClientPackageSubscribeLog::where('client_package_subscribe_id' , $id)->get();
                
                return view('admin::subscription.customer_logs', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function customerSubscriptionSettings($id){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->with('servicePackage','garage','vehicle')->first();
            if(!empty($clientPackageSubscribe)){
                $data['clientPackageSubscribe'] = $clientPackageSubscribe;
                $data['clientPackageSubscribePayment'] = ClientPackageSubscribePayment::where('client_package_subscribe_id', $id)->first();
                return view('admin::subscription.customer_settings', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }







   
    public function garageSubscriptionList(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	$data['subscriptions'] = GaragePackageSubscribe::with('garage','servicePackage')
    							->orderBy('updated_at', 'DESC')
    							->get();

        return view('admin::subscription.garage_list' , $data)->with('result', $result);
    }

    public function garageSubscriptionLogs($id){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $packagesSubscribed = GaragePackageSubscribe::where('id' , $id)->with('garage','servicePackage')->first();
            if(!empty($packagesSubscribed)){
                $data['ps'] = $packagesSubscribed;
                $data['logs'] = GaragePackageSubscribeLog::where('garage_package_subscribe_id' , $id)->get();
                return view('admin::subscription.garage_logs', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function garageSubscriptionSettings($id){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $packagesSubscribed = GaragePackageSubscribe::where('id' , $id)->with('garage','servicePackage')->first();
            if(!empty($packagesSubscribed)){

                $data['ps'] = $packagesSubscribed;
                $data['ps_payment'] = GaragePackageSubscribePayment::where('garage_package_subscribe_id', $id)->first();
                return view('admin::subscription.garage_settings', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }


    
  

    public function garageSubscriptionUpdateStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $packagesSubscribed = GaragePackageSubscribe::where('id' , $request->id)->with('garage','servicePackage')->first();
        if(!empty($packagesSubscribed)){

            // update log...
            $garagePackageSubscribeLog = new GaragePackageSubscribeLog();
            $garagePackageSubscribeLog->garage_package_subscribe_id = $packagesSubscribed->id;
            

            if($request->status == 1){

                 // now add new records
                $subscription_start_at = date('Y-m-d');
                $daystosum = (int)$packagesSubscribed->period + (int)$subscription_start_at;
                $subscription_end_at = date('Y-m-d', strtotime($subscription_start_at.' + '.$daystosum.' days'));


                GaragePackageSubscribe::where('id', '=', $request->id)->update([
                    'status' => 1,
                    'subscription_start_at' => $subscription_start_at,
                    'subscription_end_at' => $subscription_end_at
                ]);

                //payment update
                GaragePackageSubscribePayment::where('id' , $packagesSubscribed->id)->update(['status' => 1]);

                
                $garagePackageSubscribeLog->description = 'Payment Approve(COD mode)!!! - Admin has approve and activate package subscritpion.' ;
                $garagePackageSubscribeLog->save();
            
            }elseif($request->status == 2){
                
                //payment update
                GaragePackageSubscribePayment::where('id' , $packagesSubscribed->id)->update(['status' => 2]);

                $garagePackageSubscribeLog->description = 'Payment Failed(COD mode)!!! - Admin has declined the payment.' ;
                $garagePackageSubscribeLog->save();
            }

            return \Redirect::back()->with('status', 'Update subscription status successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong!!!');
        
    }

    public function cancelSubscription(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'page' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->page == 'garage'){
            GaragePackageSubscribe::where('id', '=', $request->id)
                ->update([
                    'description' => 'Cancel Package Subscription by the Admin.',
                    'is_cancel' => 1,
                    'is_active' => 0,
                    'cancelled_at' => date('Y-m-d')
                ]);
        }elseif($request->page == 'client'){
             ClientPackageSubscribe::where('id', '=', $request->id)
                ->update([
                    'description' => 'Cancel Package Subscription by the Admin.',
                    'status' => 3,
                    'cancelled_at' => date('Y-m-d')
                ]);
        }
        return \Redirect::route('superadmin.subscriptions.garages.cancel')->with('status', 'Cancel Package Subscription and shortly inform by Email.');

    }


}