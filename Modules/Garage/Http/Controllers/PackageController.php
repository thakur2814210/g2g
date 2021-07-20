<?php

namespace Modules\Garage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;
use Auth;
use App\ServicePackage;
use App\GaragePackageSubscribe;
use App\GaragePackageSubscribeLog;
use App\GaragePackageSubscribePayment;

class PackageController extends Controller
{

     public function getPackageSubscribeStatusName($key){
        $arr =  [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending', 
            '4' => 'Inactive'
        ];

        return $arr[$key];
    }

    public function getPackageSubscribeStatusArr(){
       return  [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending', 
            '4' => 'Inactive',
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

        $garagePackageSubscribes = GaragePackageSubscribe::where('garage_id', Auth::user()->id)->with('servicePackage')->get();
        $data['garagePackageSubscribes'] = $garagePackageSubscribes;
        $data['packageStatus'] = $this->getPackageSubscribeStatusArr();
        return view('garage::package.index' , $data);

       /*

        if(!empty($garagePackageSubscribe)){
            
            // garage service package detail...
            $garage_servicePackage_id = $garagePackageSubscribe->servicePackage->id;
            $garage_servicePackage_price = $garagePackageSubscribe->servicePackage->price;
            
            // show higher packae to upgrade ...
            if($garagePackageSubscribe->status == 1){
                $f_packeges = [];
                foreach ($packages as $package) {

                    if( ( (int) $package->price > (int)$garage_servicePackage_price ) && ( $package->id != $garage_servicePackage_id) ){
                        $f_packeges[] = $package;
                    }else{
                        continue;
                    }
                }
                $data['packages'] = $f_packeges;
            }
           
            $data['garagePackageSubscribe'] = $garagePackageSubscribe;
        }else{
            $data['garagePackageSubscribe'] = null;
        }
        
        $data['packages'] =  $packages;
        */
        
    }

    
    public function settings($id){
        if(!empty($id)){
            $packagesSubscribed = GaragePackageSubscribe::where('id' , $id)->with('servicePackage')->first();
            if(!empty($packagesSubscribed)){
                $data['ps'] = $packagesSubscribed;
                $data['packageStatus'] = $this->getPackageSubscribeStatusName($packagesSubscribed->status);
                $data['ps_payment'] = GaragePackageSubscribePayment::where('garage_package_subscribe_id', $id)->first();
                $data['paymentStatus'] = $this->getPackagePaymentStatusName($data['ps_payment']->status);
                return view('garage::package.settings', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    
    public function logs($id){
        if(!empty($id)){
            $packagesSubscribed = GaragePackageSubscribe::where('id' , $id)->with('servicePackage')->first();
            if(!empty($packagesSubscribed)){
                $data['ps'] = $packagesSubscribed;
                $data['logs'] = GaragePackageSubscribeLog::where('garage_package_subscribe_id' , $id)->get();
                return view('garage::package.logs', $data);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }


   
    public function buyPackage($slug){

        $data = [];
        // check package exist...
        if(!empty($slug)){
            $data['package'] =  ServicePackage::active() ->where('package_for' , 2)->where('slug' , $slug)
                                ->with('packageFeatures','section')
                                ->first();

            if(!empty($data['package'])){

                $data['error'] = false;
                $garageSubscribedPackage = GaragePackageSubscribe::where('garage_id', Auth::user()->id)
                                            ->with('servicePackage')
                                            ->get();


                if($garageSubscribedPackage->count() == 0){
                     return view('garage::package.subscribe' , $data);
                }else{
                    $is_active_package = false;
                    $is_pending_package = false;
                    foreach ($garageSubscribedPackage as $packageVal) {
                        
                        if($packageVal->status == 1){
                            $is_active_package = true;
                            break;
                        }

                        if($packageVal->status == 3){
                            $is_pending_package = true;
                            break;
                        }
                    }
                }
               
                if($is_active_package){
                   return \Redirect::route('garage.packages')->with('status','You have already active subscription. Please conatct Admin support for further assistance.');
                }

                if($is_pending_package){
                   return \Redirect::route('garage.packages')->with('status','You have pending subscription. So need to cancel this package request and then allowed to continue to buy any package. Or Please contact Admin support for further assistance.');
                }

                return view('garage::package.subscribe' , $data);
            }
        }
        return \Redirect::back()->with('status','The request is not valid or authenticate. Please try again Or Please conatct Admin support for further assistance.');
    }




    public function buyPackagesave(Request $request){

         $validator = Validator::make($request->all(), [
            'service_package_id' => 'required',
            'payment_type' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Get package details...
        $package = ServicePackage::where('id' , $request->service_package_id)->first();
        if(!empty($package)){

            //if($request->buy_or_upgrade  == 'Buy'){

                $garagePackageSubscribe = new GaragePackageSubscribe();
                $garagePackageSubscribe->service_package_id = $package->id;
                $garagePackageSubscribe->garage_id = Auth::user()->id;
                $garagePackageSubscribe->amount = $package->price;
                $garagePackageSubscribe->status = 3;

                if($garagePackageSubscribe->save()){

                    //payment update
                    $garagePackageSubscribePayment = new GaragePackageSubscribePayment();
                    $garagePackageSubscribePayment->garage_package_subscribe_id = $garagePackageSubscribe->id;
                    $garagePackageSubscribePayment->amount = $package->price;
                    $garagePackageSubscribePayment->status = 4; // 
                    $garagePackageSubscribePayment->payment_type = 'cod';
                    $garagePackageSubscribePayment->save();

                    // update log...
                    $garagePackageSubscribeLog = new GaragePackageSubscribeLog();
                    $garagePackageSubscribeLog->garage_package_subscribe_id = $garagePackageSubscribe->id;
                    $garagePackageSubscribeLog->description = 'GARAGE PACKAGE SUBSCRIPTION REQUESTED!!! - wait for the admin approval and package actiavtion.' ;
                    $garagePackageSubscribeLog->save();

                    return \Redirect::route('garage.packages')->with('status', ' Package subscription in process and will be verified by Admin and inform activation by the mail ');
                }

            //}
/*
            elseif($request->buy_or_upgrade  == 'Upgrade'){


                $garageSubscribedPackage = GaragePackageSubscribe::where('id', $request->garageSubscribedPackageId )->first();

                if($garageSubscribedPackage){

                    // cancel the previous package
                   GaragePackageSubscribe::where('id', '=', $garageSubscribedPackage->id)
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
               

            }*/
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

        $garagePackageSubscribe = GaragePackageSubscribe::where('id' , $request->id)->first();
        if(!empty($garagePackageSubscribe)){
            GaragePackageSubscribe::where('id' , $garagePackageSubscribe->id)->update([
                'status' => 2,
                'cancelled_at' => date('Y-m-d')
            ]);

            //payment update
            GaragePackageSubscribePayment::where('id' , $garagePackageSubscribe->id)->update(['status' => 2]);

            // update log...
            $garagePackageSubscribeLog = new GaragePackageSubscribeLog();
            $garagePackageSubscribeLog->garage_package_subscribe_id = $garagePackageSubscribe->id;
            $garagePackageSubscribeLog->description = 'GARAGE CANCEL SUBSCRIPTION!!! - Garage has cancel the subscription successfully.' ;
            $garagePackageSubscribeLog->save();
                
            return \Redirect::back()->with('status', 'Cancel Package Subscription successfully and shortly inform by Email.');
        }
        return \Redirect::back()->with('status', 'Error!!! - Something went wrong or please contact support for further assistance.');
    }
   

}
