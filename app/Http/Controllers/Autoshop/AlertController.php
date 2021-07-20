<?php

namespace App\Http\Controllers\Autoshop;


use Validator;
use Mail;
use DB;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\Autoshop\Alert;

class AlertController extends Controller
{

	public function userDevice($customers_id){
		$alert = new Alert();
		$device = $alert->getUserDevices($customers_id);
		if(count($device)>0){
			return $device[0]->device_id;
		}
		else{
			return '';
		}
	}

	//alert Setting
	public function getAlertSetting(){
		$alert = new Alert();
		$setting = $alert->getAlertSetting();
		return $setting;
	}

	//alert Setting
	public function setting(){
		$alert = new Alert();
		$setting = $alert->setting();
		return $setting;
	}
	
	//listingDevices
	public function accountSuccessAlert($existUser){

		$alertSetting = $this->getAlertSetting();
		$setting = $this->setting();
		$existUser[0]->app_name = $setting[18]->value;
		if($alertSetting[0]->create_customer_email==1 and !empty($existUser[0]->email)){
		    
			Mail::send('/mail/createAccount', ['userData' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("labels.WelcometoEcommerce"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});
		}
    	
		if($alertSetting[0]->create_customer_notification==1 ){

			$title = Lang::get("labels.userThankYou");
			$message = Lang::get("labels.welcomeemailtext").$setting[18]->value;

			$sendData = array
				  (
					'body' 	=> $message,
					'title'	=> $title ,
					'icon'	=> 'myicon',
					'sound' => 'mySound',
					'image' => '',
				  );

			if($setting[54]->value=='fcm'){
				$functionName = 'fcmNotification';
			}elseif($setting[54]->value=='onesignal'){
				$functionName = 'onesignalNotification';
			}

			//get device id
			$device_id = $this->userDevice($existUser[0]->id);
			if(!empty($device_id)){
				$response = $this->$functionName($device_id, $sendData);
			}
		}
	}

	//listingDevices
	public function createUserAlert($existUser){

		//alert setting
		$alertSetting = $this->getAlertSetting();
		//setting
		$setting = $this->setting();
		$existUser[0]->app_name = $setting[18]->value;
		//dd($existUser);die;

		if($alertSetting[0]->create_customer_email==1 and !empty($existUser[0]->email)){
		    
		    
		    
		/*	Mail::send('/mail/createAccount', ['userData' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("labels.WelcometoEcommerce"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});*/
			
			Mail::send('/mail/confirmEmail', ['userData' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("website.confirmEmailAccount"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});
		}
    	
		if($alertSetting[0]->create_customer_notification==1 ){

			$title = Lang::get("labels.userThankYou");
			$message = Lang::get("labels.welcomeemailtext").$setting[18]->value;

			$sendData = array
				  (
					'body' 	=> $message,
					'title'	=> $title ,
							'icon'	=> 'myicon',
							'sound' => 'mySound',
							'image' => '',
				  );

			if($setting[54]->value=='fcm'){
				$functionName = 'fcmNotification';
			}elseif($setting[54]->value=='onesignal'){
				$functionName = 'onesignalNotification';
			}

			//get device id
			$device_id = $this->userDevice($existUser[0]->id);
			if(!empty($device_id)){
				$response = $this->$functionName($device_id, $sendData);
			}
		}


	}

	//orderAlert
	public function orderAlert($ordersData){

		//alert setting
		$alertSetting = $this->getAlertSetting();

		//setting
		$setting = $this->setting();
		$ordersData['app_name'] = $setting[18]->value;
		$ordersData['orders_data'][0]->admin_email = $setting[70]->value;

		if($alertSetting[0]->order_email==1){

			//admin email
			if(!empty($ordersData['orders_data'][0]->admin_email)){
				try {
				Mail::send('/mail/orderEmail', ['ordersData' => $ordersData], function($m) use ($ordersData){
					$m->to($ordersData['orders_data'][0]->admin_email)->subject(Lang::get("labels.Ecommerce App: An order has been placed"))->getSwiftMessage()
					->getHeaders()
					->addTextHeader('x-mailgun-native-send', 'true');
				});
			} catch (\Exception $e) {

					return view('errors.not_install');
			}
			}

			//customer email
			if(!empty($ordersData['orders_data'][0]->email)){
				try {

					Mail::send('/mail/orderEmail', ['ordersData' => $ordersData], function($m) use ($ordersData){
						$m->to($ordersData['orders_data'][0]->email)->subject(Lang::get("labels.Ecommerce App: An order has been placed"))->getSwiftMessage()
						->getHeaders()
						->addTextHeader('x-mailgun-native-send', 'true');
					});

					} catch (\Exception $e) {

						return view('errors.not_install');
					}
			}
		}

		if($alertSetting[0]->order_notification==1){

			$title = Lang::get("labels.OrderTitle");
			$message = Lang::get("labels.OrderDetail").$setting[18]->value;

			$sendData = array
				  (
					'body' 	=> $message,
					'title'	=> $title ,
							'icon'	=> 'myicon',/*Default Icon*/
							'sound' => 'mySound',/*Default sound*/
							'image' => '',
				  );

			if($setting[54]->value=='fcm'){
				$functionName = 'fcmNotification';
			}elseif($setting[54]->value=='onesignal'){
				$functionName = 'onesignalNotification';
			}

			//get device id
			$device_id = $this->userDevice($ordersData['orders_data'][0]->customers_id);

			if(!empty($device_id)){
				$response = $this->$functionName($device_id, $sendData);
			}
		}
	}
	
	public function resendVerificationEmail($existUser){

		//alert setting
		$alertSetting = $this->getAlertSetting();

		//setting
		$setting = $this->setting();
		$existUser[0]->app_name = $setting[18]->value;

		if($alertSetting[0]->forgot_email==1 and !empty($existUser[0]->email)){
			Mail::send('/mail/confirmEmail', ['userData' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("website.confirmEmailAccount"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});
		}

		if($alertSetting[0]->forgot_notification==1){

			$title = Lang::get("labels.resendVerificationEmailNotificationTitle");
			$message = Lang::get("labels.resendVerificationEmailNotificationMessage");

			$sendData = array
				  (
					'body' 	=> $message,
					'title'	=> $title ,
							'icon'	=> 'myicon',/*Default Icon*/
							'sound' => 'mySound',/*Default sound*/
							'image' => '',
				  );

			if($setting[54]->value=='fcm'){
				$functionName = 'fcmNotification';
			}elseif($setting[54]->value=='onesignal'){
				$functionName = 'onesignalNotification';
			}

			//get device id
			$device_id = $this->userDevice($existUser[0]->id);
			if(!empty($device_id)){
				$response = $this->$functionName($device_id, $sendData);
			}
		}


	}



	//listingDevices
	public function forgotPasswordAlert($existUser){

		//alert setting
		$alertSetting = $this->getAlertSetting();

		//setting
		$setting = $this->setting();
		$existUser[0]->app_name = $setting[18]->value;

		if($alertSetting[0]->forgot_email==1 and !empty($existUser[0]->email)){
			Mail::send('/mail/recoverPassword', ['existUser' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("labels.fogotPasswordEmailTitle"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});
		}

		if($alertSetting[0]->forgot_notification==1){

			$title = Lang::get("labels.forgotNotificationTitle");
			$message = Lang::get("labels.forgotNotificationMessage");
			$sendData = array
				  (
					'body' 	=> $message,
					'title'	=> $title ,
							'icon'	=> 'myicon',/*Default Icon*/
							'sound' => 'mySound',/*Default sound*/
							'image' => '',
				  );

			if($setting[54]->value=='fcm'){
				$functionName = 'fcmNotification';
			}elseif($setting[54]->value=='onesignal'){
				$functionName = 'onesignalNotification';
			}
			//get device id
			$device_id = $this->userDevice($existUser[0]->id);
			if(!empty($device_id)){
				$response = $this->$functionName($device_id, $sendData);
			}
		}
	}



	/**
     * Notifcation section
     *
     * @return void
     */


	public function fcmNotification($device_id, $sendData){

		//get function from other controller
		$setting = $this->setting();

		#API access key from Google API's Console
		if (!defined('API_ACCESS_KEY')){
			define('API_ACCESS_KEY', $setting[12]->value);
		}

		$fields = array
				(
					'to'		=> $device_id,
					'data'	=> $sendData
				);


		$headers = array
				(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);
		#Send Reponse To FireBase Server
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
		$data = json_decode($result);
		if($result === false)
		die('Curl failed ' . curl_error());

		curl_close($ch);

		if(!empty($data->success) and $data->success >= 1){
			$response = '1';
		}else{
			$response = '0';
		}

		//print $response;

	}

	public function onesignalNotification($device_id, $sendData){

		//get function from other controller
		$setting = $this->setting();


		$content = array(
		   "en" => $sendData['body']
		   );

		$headings = array(
		   "en" => $sendData['title']
		   );

		$big_picture = array(
		   "id1" => $sendData['image']
		   );

		$fields = array(
		   'app_id' => $setting[55]->value,
		   'include_player_ids' => array($device_id),
		   'contents' => $content,
		   'headings'=>$headings,
		   'big_picture'=>$sendData['image']
		);

		$fields = json_encode($fields);
		
		/*
		Old Auth Code:
		ZTJhZTcwNzItODQ4Ni00Y2FiLWFjZjEtMGY4ODZhZGZlMGZl
		*/

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
				   'Authorization: Basic ODlkYzg0NDQtMmVmMy00MmFlLWE2OWQtNmY5ZmMzNTA5Yzc3'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$result = curl_exec($ch);
		$data = json_decode($result);
		curl_close($ch);

		if(!empty($data->recipients) and $data->recipients >= 1){
			$response = '1';
		}else{
			$response = '0';
		}

		//print $response;

	}
	
	public function getPackageSubscribeStatusArr($key){
       $arr =   [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending', 
            '4' => 'Inactive',
            '5' => 'Request-Payemnt', 
            '6' => 'Received-Payment',
            '7' => 'Required-Payment-Approval' 
        ];
        if(!empty($key)){
            return $arr[$key]; 
        }else{
            return $arr; 
        }
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
	
		//listingDevices
	public function sendPackageSubscription($package , $type , $usertype){
	    
	    $data = new \stdClass();
	    $admin = $customres  = [];
	    $user_id = (int)$package['user_id'];
	   
	    $garageData = DB::table('garages')->where('id',(int)$package['garage_id'])->first();
	    if($garageData){
	        $garage_id = $garageData->user_id;
	    }else{
	         $garage_id = -1;
	    }
	    
	    if($user_id && $garage_id){
	        $users = DB::table('users')->whereIn('id' , [$user_id ,$garage_id , 1] )->get();  // 1 for superadmin
    	    foreach($users as $row){
    	        if($row->id == 1) $admin[] = $row;
    	        if($row->id == $user_id) $customres[] = $row;
    	        if($row->id == $garage_id) $garage[] = $row;
    	    }
    	    
    	    //dd($garage);
    	    $service_package = DB::table('service_package')->where('id' , $package['service_package_id'])->first();
    	    $vehicle = DB::table('vehicles')->where('id' , $package->vehicle_id)->first();
    	    $garages_description = DB::table('garages_description')->where('garages_id' , $package->garage_id)->where('language_id' , 1)->first();
    	    $client_package_subscribe_payments = DB::table('client_package_subscribe_payments')->where('client_package_subscribe_id', $package->id)->first();
    	    $city = DB::table('cities')->where('id', $package['city_id'])->first();
    	    $country = DB::table('countries')->where('id', $package['country_id'])->first();
    	    
    	    $data->ps_code = $package['ps_code'];
    	    $data->created_at = $service_package->created_at;
    	    $data->customers_name = $customres[0]->first_name.' '.$customres[0]->last_name;
    	    $data->customers_street_address = $package['address'];;
    	    $data->customers_city = $city->name;;
    	    $data->customers_postcode = $package['pobox'];
    	    $data->customers_country = $country->name;;
    	    $data->customers_telephone = $customres[0]->phone;
    	    $data->email = $customres[0]->email;
    	    $data->package_name = $service_package->name;
    	    $data->package_status = $this->getPackageSubscribeStatusArr($package['status']);
    	    $data->vehicle_plate_no = $vehicle->plate_no;
    	    $data->garage_name = $garages_description->garages_name;
    	    $data->subscription_start_at = $package['subscription_start_at'];;
    	    $data->subscription_end_at = $package['subscription_end_at'];
    	    $data->package_payment_amount = $client_package_subscribe_payments->amount;
    	    $data->package_payment_status = $this->getPackagePaymentStatusName($client_package_subscribe_payments->status);
    	    $data->package_payment_date = $client_package_subscribe_payments->date;
    	    $data->package_payment_type = $client_package_subscribe_payments->payment_type == 'cod' ? Lang::get("labels.cod") : Lang::get("labels.creditcard");
    	    
    	    
    	    $alertSetting = $this->getAlertSetting();
    		$setting = $this->setting();
    		$data->app_name = $setting[18]->value;
    		$data->user_device_id =  -1;
    	    
    	    if($usertype == 'customer'){
    	        if($type= 'subscribe'){
    	            $view = '/mail/packageSubscription/success';
    	            $subject = Lang::get("labels.customerSubscribeSuccessEMailTitle");
    	            $notificationTitle = Lang::get("labels.customerSubscribeSuccessNotificationTitle");
    		        $notificationMessage = Lang::get("labels.customerSubscribeSuccessNotificationMessage");
    		        
    		        // send mail to customer, garage , admin 
    		        $this->sendMail($data, $customres[0]->email, $subject , $view);
    		        $this->sendMail($data, $garage[0]->email, $subject , $view);
    		        $this->sendMail($data, $admin[0]->email, $subject, $view);
    		        
    		        $device_id = -1;
    	        }
    	        
    	    }else if($usertype == 'garage'){
    	        
    	    }
    
    	
    	   
    	
    		//send notification 
    		// get device id first
           // $this->sendMail($notificationTitle, $notificationMessage, $device_id);
	    }
	    
	}
	
	public function sendMail($data , $email , $subject , $view){
	    Mail::send($view, ['data' => $data], function($m) use ($data , $email, $subject){
			$m->to($email)->subject($subject)->getSwiftMessage()
			->getHeaders()
			->addTextHeader('x-mailgun-native-send', 'true');
		});
	}
	
	public function sendNotifiaction($notificationTitle, $notificationMessage, $device_id){
	    // send notification
		$sendData = array(
				'body' 	=> $notificationTitle,
				'title'	=> $notificationMessage ,
				'icon'	=> 'myicon',/*Default Icon*/
				'sound' => 'mySound',/*Default sound*/
				'image' => '',
			  );

		if($setting[54]->value=='fcm'){
			$functionName = 'fcmNotification';
		}elseif($setting[54]->value=='onesignal'){
			$functionName = 'onesignalNotification';
		}
		if(!empty($device_id)){
			$response = $this->$functionName($device_id, $sendData);
		}
	}
	
	public function sendCreateMailNotification($serviceRequest){
	    
	    $data = new \stdClass();
	    $admin = $customres  = [];
	    $user_id = (int)$package['user_id'];
	   
	    $garageData = DB::table('garages')->where('id',(int)$package['garage_id'])->first();
	    if($garageData){
	        $garage_id = $garageData->user_id;
	    }else{
	         $garage_id = -1;
	    }
	    
	    if($user_id && $garage_id){
	        $users = DB::table('users')->whereIn('id' , [$user_id ,$garage_id , 1] )->get();  // 1 for superadmin
    	    foreach($users as $row){
    	        if($row->id == 1) $admin[] = $row;
    	        if($row->id == $user_id) $customres[] = $row;
    	        if($row->id == $garage_id) $garage[] = $row;
    	    }
    	    
    	    //dd($garage);
    	    $service_package = DB::table('service_package')->where('id' , $package['service_package_id'])->first();
    	    $vehicle = DB::table('vehicles')->where('id' , $package->vehicle_id)->first();
    	    $garages_description = DB::table('garages_description')->where('garages_id' , $package->garage_id)->where('language_id' , 1)->first();
    	    $client_package_subscribe_payments = DB::table('client_package_subscribe_payments')->where('client_package_subscribe_id', $package->id)->first();
    	    $city = DB::table('cities')->where('id', $package['city_id'])->first();
    	    $country = DB::table('countries')->where('id', $package['country_id'])->first();
    	    
    	    $data->sr_code = $serviceRequest['sr_code'];
    	    $data->created_at = $service_package->created_at;
    	    $data->customers_name = $customres[0]->first_name.' '.$customres[0]->last_name;
    	    $data->customers_street_address = $package['address'];;
    	    $data->customers_city = $city->name;;
    	    $data->customers_postcode = $package['pobox'];
    	    $data->customers_country = $country->name;;
    	    $data->customers_telephone = $customres[0]->phone;
    	    $data->email = $customres[0]->email;
    	    $data->package_name = $service_package->name;
    	    $data->package_status = $this->getPackageSubscribeStatusArr($package['status']);
    	    $data->vehicle_plate_no = $vehicle->plate_no;
    	    $data->garage_name = $garages_description->garages_name;
    	    $data->subscription_start_at = $package['subscription_start_at'];;
    	    $data->subscription_end_at = $package['subscription_end_at'];
    	    $data->package_payment_amount = $client_package_subscribe_payments->amount;
    	    $data->package_payment_status = $this->getPackagePaymentStatusName($client_package_subscribe_payments->status);
    	    $data->package_payment_date = $client_package_subscribe_payments->date;
    	    $data->package_payment_type = $client_package_subscribe_payments->payment_type == 'cod' ? Lang::get("labels.cod") : Lang::get("labels.creditcard");
    	    
    	    
    	    $alertSetting = $this->getAlertSetting();
    		$setting = $this->setting();
    		$data->app_name = $setting[18]->value;
    		$data->user_device_id =  -1;
    	    
    	    if($usertype == 'customer'){
    	        if($type= 'subscribe'){
    	            $view = '/mail/packageSubscription/success';
    	            $subject = Lang::get("labels.customerSubscribeSuccessEMailTitle");
    	            $notificationTitle = Lang::get("labels.customerSubscribeSuccessNotificationTitle");
    		        $notificationMessage = Lang::get("labels.customerSubscribeSuccessNotificationMessage");
    		        
    		        // send mail to customer, garage , admin 
    		        $this->sendMail($data, $customres[0]->email, $subject , $view);
    		        $this->sendMail($data, $garage[0]->email, $subject , $view);
    		        $this->sendMail($data, $admin[0]->email, $subject, $view);
    		        
    		        $device_id = -1;
    	        }
    	        
    	    }else if($usertype == 'garage'){
    	        
    	    }
    
    	
    	   
    	
    		//send notification 
    		// get device id first
           // $this->sendMail($notificationTitle, $notificationMessage, $device_id);
	    }
	    
	}

}
