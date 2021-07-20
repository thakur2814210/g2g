<?php
namespace App\Http\Controllers\Autoshop;
use App\User;
use Socialite;
use Validator;
use Services;
use File;
use App\Http\Controllers\Autoshop\AlertController;
use Illuminate\Contracts\Auth\Authenticatable;
use Hash;
use DB;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;
use Lang;
use Illuminate\Support\Facades\Mail;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Languages;
use App\Models\Autoshop\Products;
use App\Models\Autoshop\Currency;
use App\Models\Autoshop\Customer;


use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;

use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ServiceRequestLog;
use App\Client;
use App\ClientLocation;
use App\Language;
use App\GaragesDescription;


class CustomersController extends Controller
{

	public function __construct(
		                  Index $index,
						Languages $languages,
						Products $products,
						Currency $currency,
						Customer $customer
						)
	{
		$this->index = $index;
		$this->languages = $languages;
		$this->products = $products;
		$this->currencies = $currency;
		$this->customer = $customer;
		$this->theme = new ThemeController();
	}

	public function signup(Request $request){
		$final_theme = $this->theme->theme();
		if(auth()->guard('customer')->check()){
			return redirect('/');
		}
		else{
			$title = array('pageTitle' => Lang::get("website.Sign Up"));
			$result = array();
			$result['commonContent'] = $this->index->commonContent();
			return view("login", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
		}
	}

	

	public function processLogin(Request $request){
		
		$result = array();
		$old_session = Session::getId();
		$user_type = $request->user_type;
		$login = $request->email;

		if(is_numeric($login)){
		     $firstCharacter = substr($login, 0, 1);
                if($firstCharacter != 0)
                    $login = '0'.$login;
                
           $loginInfo = array("phone" => $login, "password" => $request->password);
           $userData = \DB::table('users')->where('phone', $login)->first();
        } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $loginInfo = array("email" => $login, "password" => $request->password);
            $userData = \DB::table('users')->where('email', $login)->first();
        } else {
            $loginInfo = array("user_name" => $login, "password" => $request->password);
            $userData = \DB::table('users')->where('user_name', $login)->first();
        }	
        
        
        // first check user have verify the mail.
        if(!empty($userData)){
            if(!$userData->email_verified){
                return redirect('login')->with('email_verified',Lang::get("website.authentication_issue_mail_verify"));
            }
        }else{
            return redirect('login')->with('loginError',Lang::get("website.authentication_issue_user_not_exist"));
        }

        // check login with credentials
		if($user_type === 'customer'){
			if(auth()->guard('customer')->attempt($loginInfo)) {
				$customer = auth()->guard('customer')->user();
				if($customer->role_id != 2){
					$record = DB::table('settings')->where('id', 94)->first();
					 if($record->value == 'Maintenance' && $customer->role_id == 1){
						auth()->attempt($customerInfoEmail);
					 }
					else{
           				Auth::guard('customer')->logout();
					 return redirect('login')->with('loginError',Lang::get("website.authentication_issue_credetilas_not_exist"));
				   }
				}
				$result = $this->customer->processLogin($request,$old_session);
				if(!empty( session('previous'))){
						return Redirect::to( session('previous'));
					}else{
						return redirect('/')->with('result', $result);
					}
			}
		}elseif($user_type === 'garage'){
			if(auth()->guard('vendor')->attempt($loginInfo)) {
				$garage = auth()->guard('vendor')->user();
				if($garage->role_id != 3){
					$record = DB::table('settings')->where('id', 94)->first();
					 if($record->value == 'Maintenance' && $customer->role_id == 1){
						auth()->attempt($customerInfoEmail);
					 }
					else{
           				Auth::guard('vendor')->logout();
					 return redirect('login')->with('loginError',Lang::get("website.authentication_issue_credetilas_not_exist"));
				   }
				}

				$result = \DB::table('users')->where('id', $garage->id)->get();
				return redirect('/')->with('result', $result);
			}
		}else{
			return redirect('login')->with('loginError',Lang::get("website.Invalid User type, please select correct user type."));
		}
		
		return redirect('login')->with('loginError',Lang::get("website.Email or password is incorrect"));
		
	}

	public function addToCompare(Request $request){
    $cartResponse = $this->customer->addToCompare($request);
		return $cartResponse;
	}

	public function DeleteCompare($id){
		$Response = $this->customer->DeleteCompare($id);
		return redirect()->back()->with($Response);
	}

	public function Compare(){
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();
		$compare = $this->customer->Compare();
		$results = array();
		foreach($compare as $com){
			$data = array('products_id'=>$com->product_ids,'page_number'=>'0', 'type'=>'compare', 'limit'=>'15', 'min_price'=>'', 'max_price'=>'');
			$newest_products = $this->products->products($data);
			array_push($results,$newest_products);
		}
		$result['products'] = $results;
		return view('autoshop.compare',['result' =>$result,'final_theme'=>$final_theme]);
	}

	public function dashboard(){
		$title = array('pageTitle' => Lang::get("website.Dashboard"));
		$result['commonContent'] = $this->index->commonContent();
		$final_theme = $this->theme->theme();

		$customer = auth()->guard('customer')->user();
		$client = Client::where('user_id',$customer->id)->first();

		//$client = Client::where('id', Auth::guard('customer')->user()->id)->first();
        $sr_customer = ServiceRequest::where('client_id', $client->id)
                                    ->get();
        $ps_customer = ClientPackageSubscribe::where('client_id', $client->id)
                                    ->get();


       

		return view('autoshop.dashboard', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'sr_customer' => $sr_customer , 'ps_customer' => $ps_customer ]);
	}

	public function profile(){
		$title = array('pageTitle' => Lang::get("website.Profile"));
		$result['commonContent'] = $this->index->commonContent();
		$final_theme = $this->theme->theme();
		return view('autoshop.profile', ['result' =>$result,'title' => $title,'final_theme' => $final_theme]);
	}

	public function updateMyProfile(Request $request){
    $message =  $this->customer->updateMyProfile($request);
		return redirect()->back()->with('success', $message);

	}

	public function updateMyPassword(Request $request){

		$validator = Validator::make(
			array(
				'new_password' => $request->new_password,
				'confirm_password' => $request->confirm_password
			),array(
				'new_password' => 'required',
				'confirm_password' => 'required|same:new_password',
			)
		);

		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput();
		}else{
			
			$customer_data = array(
		      'password'			=>  bcrypt($request->new_password),
		      'updated_at'		=>  date('y-m-d h:i:s'),
		    );
			$customers_id            					=   auth()->guard('customer')->user()->id;
			$customers_info_date_account_last_modified 	=   date('y-m-d h:i:s');


		    $userData = DB::table('users')->where('id', $customers_id)->update($customer_data);
		    $user = DB::table('users')->where('id', $customers_id)->get();

		    DB::table('customers_info')->where('customers_info_id', $customers_id)->update(['customers_info_date_account_last_modified'   =>   $customers_info_date_account_last_modified]);

		    $message = Lang::get("website.Password has been updated successfully");
		    return redirect()->back()->with('success', $message);
		}

	}

	public function logout(REQUEST $request){

		\Auth::guard(\Auth::getDefaultDriver())->logout();
		session()->flush();
		$request->session()->forget('customers_id');
		$request->session()->regenerate();
		return redirect()->intended('/');
	}

	public function logout1(REQUEST $request){
		
		\Auth::guard(\Auth::getDefaultDriver())->logout();
		$request->session()->regenerate();
		return redirect()->intended('/');
	}

  public function socialLogin($social){
        return Socialite::driver($social)->redirect();
    }

  public function handleSocialLoginCallback($social){
		  $result =  $this->customer->handleSocialLoginCallback($social);
			if(!empty($result)){
				return redirect()->intended('/')->with('result', $result);
			}
    }

	function createRandomPassword() {
		$pass = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
		return $pass;
	}

	public function likeMyProduct(Request $request){
		$cartResponse = $this->customer->likeMyProduct($request);
		return $cartResponse;
	}

	public function unlikeMyProduct(Request $request,$id){

		if(!empty(auth()->guard('customer')->user()->id)){
      $this->customer->unlikeMyProduct($id);
			$message = Lang::get("website.Product is unliked");
			return redirect()->back()->with('success', $message);
		}else{
			return redirect('login')->with('loginError','Please login to like product!');
		}

	}

	public function wishlist(Request $request){
		$title = array('pageTitle' => Lang::get("website.Wishlist"));
		$final_theme = $this->theme->theme();
    $result = $this->customer->wishlist($request);
		return view("autoshop.wishlist", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
	}

	public function loadMoreWishlist(Request $request){

		$limit = $request->limit;

		$data = array('page_number'=>$request->page_number, 'type'=>'wishlist', 'limit'=>$limit, 'categories_id'=>'', 'search'=>'', 'min_price'=>'', 'max_price'=>'' );
		$products = $this->products->products($data);
		$result['products'] = $products;

		$cart = '';
		$myVar = new CartController();
		$result['cartArray'] = $this->products->cartIdArray($cart);
		$result['limit'] = $limit;
		return view("autoshop.wishlistproducts")->with('result', $result);

	}

	public function forgotPassword(){
		if(auth()->guard('customer')->check()){
			return redirect('/');
		}
		else{

			$title = array('pageTitle' => Lang::get("website.Forgot Password"));
			$final_theme = $this->theme->theme();
			$result = array();
			$result['commonContent'] = $this->index->commonContent();
			return view("autoshop.forgotpassword", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
		}
	}

	public function processPassword(Request $request){
		$title = array('pageTitle' => Lang::get("website.Forgot Password"));

		$password = $this->createRandomPassword();

		$email    		  =   $request->email;
		$postData = array();

		//check email exist
		$existUser = $this->customer->ExistUser($email);
		if(count($existUser)>0){
      $this->customer->UpdateExistUser($email,$password);
			$existUser[0]->password = $password;

			$myVar = new AlertController();
			$alertSetting = $myVar->forgotPasswordAlert($existUser);

			return redirect('login')->with('success', Lang::get("website.Password has been sent to your email address"));
		}else{
			return redirect('forgotPassword')->with('error', Lang::get("website.Email address does not exist"));
		}

	}

	public function recoverPassword(){
		$title = array('pageTitle' => Lang::get("website.Forgot Password"));
		$final_theme = $this->theme->theme();
		return view("autoshop.recoverPassword", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
	}
	
	public function resendVerificationEmail(){
		if(auth()->guard('customer')->check() ||auth()->guard('vendor')->check() ){
			return redirect('/');
		}
		else{

			$title = array('pageTitle' => Lang::get("website.Forgot Password"));
			$final_theme = $this->theme->theme();
			$result = array();
			$result['commonContent'] = $this->index->commonContent();
			return view("auth.resend_email_verification", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
		}
	}
	
	public function processResendVerificationEmail(Request $request){
		
		$email = $request->email;
		$validator = Validator::make(
			array(
				'email' => $request->email
			),array(
				'email' => 'required'
			)
		);

		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput();
		}
		
		//check email exist
		$existUser = $this->customer->ExistUser($email);
		if(count($existUser)>0){
		    
		    $email_verified_token =  sha1(time());
		    DB::table('users')->where('id', $existUser[0]->id)->update(['email_verified_token'	=>	$email_verified_token]);
		    
           
			$myVar = new AlertController();
			$alertSetting = $myVar->resendVerificationEmail($existUser);
			return redirect('login')->with('success', Lang::get("website.confirm_email_address"));
		}else{
			return redirect('resend-verification-email')->with('error', Lang::get("website.Email address does not exist"));
		}

	}

	function subscribeNotification(Request $request) {

		$setting = $this->index->commonContent();

		/* Desktop */
		$type = 3;

		session(['device_id' => $request->device_id]);

		if(!empty(auth()->guard('customers')->user()->id)){

			$device_data = array(
				'device_id' => $request->device_id,
				'device_type' =>  $type,
				'register_date' => time(),
				'update_date' => time(),
				'ram' =>  '',
				'status' => '1',
				'processor' => '',
				'device_os' => '',
				'location' => '',
				'device_model'=>'',
				'customers_id'=>auth()->guard('customers')->user()->id,
				'manufacturer'=>'',
				$setting['setting'][54]->value=>'1'
			);


		}else{

			$device_data = array(
				'device_id' => $request->device_id,
				'device_type' =>  $type,
				'register_date' => time(),
				'update_date' => time(),
				'ram' =>  '',
				'status' => '1',
				'processor' => '',
				'device_os' => '',
				'location' => '',
				'device_model'=>'',
				'manufacturer'=>'',
				$setting['setting'][54]->value=>'1'
			);

		}
    $this->customer->updateDevice($request,$device_data);
		print 'success';
	}

	public function signupProcess(Request $request){
	    
        $old_session = Session::getId();
        $company = $request->company;
        $userName = $request->userName;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $gender = $request->gender;
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;
        $date = date('y-md h:i:s');
        session(['active_reg_tab'=> 'customer']);
        //		//validation start
        $validator = Validator::make(
            array(
                
                'userName' => $request->userName,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'customers_gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                're_password' => $request->re_password,
            
            ),array(
                
                'userName' => 'required ',
                'firstName' => 'required ',
                'lastName'  => 'required',
                'customers_gender' 	=> 'required',
                'email' 	=> 'required | email',
                'phone' => 'required',
                'password'  => 'required',
                're_password' => 'required | same:password',
            )
        );
        if($validator->fails()){
            return redirect('/register')->withErrors($validator)->withInput();
            
        }else{
            
             if($phone){
                $firstCharacter = substr($phone, 0, 1);
                if($firstCharacter != 0)
                    $phone = '0'.$phone;
            }
            
            // validate email, phone and username uniqueness
            // if all good, insert data in users and client table.
            $res = $this->customer->signupProcess($request);
            
            // action failed , user already exist. . .
            if( $res['action_insert_data'] == "false" && $res['user_exist'] == "true"){
                
                if($res['email'] == "true"){
                	return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Email already exist"));
                	
                }elseif ($res['user_phone'] == "true"){
                	return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Phone already exist"));
                	
                }elseif($res['user_name'] == "true"){
                	return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Username already exist"));
                }else{
                    return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.User already exist"));
                }
            
             // action success , user data inserted ssuccessfully. . .
            }elseif( $res['action_insert_data'] == "true" && $res['user_exist'] == "false"){
                return redirect('/register')->with('error', Lang::get("website.confirm_email_address"));
            
            // something went wrong . . .
            }else{
                return redirect('/register')->with('error', Lang::get("website.something_went_wrong"));
            }
		}
	}

	public function signupProcessVendor(Request $request){
	    
	    $res = array();
	    $userName = $request->userName;
        $email = $request->email;
        $phone = $request->phone;
    	$res['email'] =  "false";
        $res['user_name'] =  "false";
        $res['user_phone'] =  "false";
        $res['user_exist'] =  "false";
        $res['action_insert_data'] = "false";
        session(['active_reg_tab'=> 'garage']);
	    
		//validation start
		$validator = Validator::make(
			array(
				'userName' => $request->userName,
				'company' => $request->company,
				'firstName' => $request->firstName,
				'lastName' => $request->lastName,
				'email' => $request->email,
				'phone' => $request->phone,
				'password' => $request->password,
				're_password' => $request->re_password,
				'garage_vendor_type' => $request->garage_vendor_type

			),array(
				'userName' => 'garage_vendor_type ',
				'userName' => 'required ',
				'company' => 'required',
				'firstName' => 'required ',
				'lastName'  => 'required',
				'email' 	=> 'required | email',
				'password'  => 'required',
				'phone'  => 'required',
				're_password' => 'required | same:password',
			)
		);


		if($validator->fails()){
			return redirect('login')->withErrors($validator)->withInput();
		}else{
		    
		     if($phone){
                $firstCharacter = substr($phone, 0, 1);
                if($firstCharacter != 0)
                    $phone = '0'.$phone;
            }

        	$userData = \DB::table('users')->where('email', $email)->orWhere('phone', $phone)->orWhere('user_name', $userName)->first();
            if(!empty($userData)){
                
                if($userData->email ==  $email) $res['email'] =  "true";
                if($userData->phone ==  $phone) $res['user_phone'] =  "true";
                if($userData->user_name ==  $userName) $res['user_name'] =  "true";
                $res['user_exist'] =  "true";
                
            }else{
               
        		$userName = $request->userName;
        		$company = ($request->company) ? $request->company : null;
        		$firstName = $request->firstName;
        		$lastName = $request->lastName;
        		$email = $request->email;
        		$phone = $request->phone;
        		$password = $request->password;
        		$date = date('y-m-d h:i:s');
        		$email_verified_token =  sha1(time());
          
                $data = array(
                    'user_name' => $userName,
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'role_id' => 3,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'created_at' => $date,
                    'updated_at' => $date,
                    'email_verified_token' => $email_verified_token,
                    'garage_vendor_type' => $request->garage_vendor_type,
                );
                $users_id = DB::table('users')->insertGetId($data);

                $garage_id = DB::table('garages')->insertGetId([
                	'user_id' =>$users_id,
                	'company' =>  $company,
                	'status' => 1 ,
                	'type' => $request->garage_vendor_type,
                	'created_at' => $date,
                	'updated_at' => $date]);

                $languages = Language::get();
	            foreach ($languages as $language) {

	                  DB::table('garages_description')->insert([
    	            		'garages_id' => $garage_id,
                          	'garages_name' => 'Default_' . time(),
                          	'garages_description' => 'Default_' . time(),
                          	'language_id' =>  $language->languages_id
    	            	]);
	            }

                if($request->garage_vendor_type != 1){
                	 $vendor_id = DB::table('vendor_details')->insertGetId(
			        	['user_id' =>$users_id,
			        	'shop_name' => $company,
			        	'created_at' => $date,
			        	'updated_at' => $date]);
                	}else{
                		$vendor_id = null;
                	}

		       

		        DB::table('garage_vendor_relations')->insertGetId(
		        	['user_id' =>$users_id,
		        	'garage_id' => $garage_id,
		        	'vendor_id' => $vendor_id]);
		        
		        $res['action_insert_data'] = "true";
		        
		        
                //email and notification
                $garages = DB::table('users')->where('id',  $users_id)->get();
                $myVar = new AlertController();
                $alertSetting = $myVar->createUserAlert($garages);
            
            }
            
            // action failed , user already exist. . .
            if( $res['action_insert_data'] == "false" && $res['user_exist'] == "true"){
                
                if($res['email'] == "true"){
                	return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Email already exist"));
                	
                }elseif ($res['user_phone'] == "true"){
                	return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Phone already exist"));
                	
                }elseif($res['user_name'] == "true"){
                	return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Username already exist"));
                }else{
                    return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.User already exist"));
                }
            
             // action success , user data inserted ssuccessfully. . .
            }elseif( $res['action_insert_data'] == "true" && $res['user_exist'] == "false"){
                return redirect('/register')->with('error', Lang::get("website.confirm_email_address"));
            
            // something went wrong . . .
            }else{
                return redirect('/register')->with('error', Lang::get("website.something_went_wrong"));
            }
		}

			
                /*
        	
	        if( $res['user_exist'] ==  "false"){
			   DB::table('users')->insert([
							          'user_name' => $request->userName,
							          'first_name' => $request->firstName,
							          'last_name'  => $request->lastName,
							          'role_id' => 3,
							          'phone' => $request->phone,
							          'email' => $request->email,
							          'password' => Hash::make($password),
							          'created_at' => $date,
							          'updated_at' => $date,
							          ]);
	           $res['insert'] = "true";

	          //check authentication of email and password
		        if(auth()->guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password])){
		            $res['auth'] = "true";
		            $garage = auth()->guard('vendor')->user();

		            DB::table('garages')->insert(['user_id' =>$garage->id, 'status' => 1 ,'created_at' => $date,'updated_at' => $date,]);
		            
		            DB::table('vendor_details')->insert(['user_id' =>$garage->id,'created_at' => $date,'updated_at' => $date,]);
		           
		            //insert device id
		            if(!empty(session('device_id'))){
		              DB::table('devices')->where('device_id', session('device_id'))->update(['customers_id'	=>	$garage->id]);
		            }

	            	$customers = DB::table('users')->where('id', $garage->id)->get();
	            	$result['customers'] = $customers;

		            //email and notification
		            $myVar = new AlertController();
		            $alertSetting = $myVar->createUserAlert($customers);
		            $res['result'] = $result;
		        }else{
		            $res['auth'] = "true";
		        }
	        }else{
	           $res['insert'] = "false";
	        }
	    }

		//eheck email already exit
		if($res['user_exist'] == "true"){
			if($res['email'] == "true"){
				return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Email already exist"));
			}elseif ($res['user_phone'] == "true"){
				return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Phone already exist"));
			}else{
				return redirect('/register')->withInput($request->input())->with('error', Lang::get("website.Username already exist"));
			}
		}else{
			if( $res['insert'] == "true"){
				if($res['auth'] == "true"){
					$result = $res['result'];
					return redirect()->intended('/')->with('result', $result);
				}else{
					return redirect('register')->with('loginError', Lang::get("website.Email or password is incorrect"));
				}
			}else{
				return redirect('/register')->with('error', Lang::get("website.something is wrong"));
			}
		}
		*/
		
	}


	public function transactions()
    {

    	$title = array('pageTitle' => Lang::get("website.Forgot Password"));
		$final_theme = $this->theme->theme();
		$result = array();
		$result['commonContent'] = $this->index->commonContent();


    	$customer = auth()->guard('customer')->user();
		$client = Client::where('user_id',$customer->id)->first();

    	$sr_payment = ServiceRequestPayment::join('service_request','service_request_payment.service_request_id','service_request.id')
                            ->where('service_request.client_id', $client->id)
                            ->get();

        $ps_payment =  ClientPackageSubscribePayment::join('service_request','client_package_subscribe_payments.client_package_subscribe_id','service_request.id')
                               ->where('service_request.client_id', $client->id)->get();

        $payments = array_merge($sr_payment->toArray(), $ps_payment->toArray() );


			return view("autoshop.transactions", ['title' => $title,'final_theme' => $final_theme,'payments' => $payments])->with('result', $result);
        
    	
    }
    
    public function addNewLocations(Request $request){
       
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'pobox' => 'required', 
        ]);


        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }
       
        $client = Client::where('user_id', Auth::guard('customer')->user()->id)->first();
        if(!empty($client)){
            $clientLocation = new ClientLocation();
            $clientLocation->client_id = $client->id;
            $clientLocation->address = $request->address;
            $clientLocation->latitude = $request->latitude;
            $clientLocation->longitude = $request->longitude;
            $clientLocation->city_id = $request->city_id;
            $clientLocation->country_id = $request->country_id;
            $clientLocation->pobox = $request->pobox;
            if($clientLocation->save()){
                return \Redirect::back()->with('status', 'Update new location successfully!!!');
            }

        }
        return \Redirect::back()->with('status', 'Something went wrong!!!');
    }

	

}
