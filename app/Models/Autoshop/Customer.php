<?php

namespace App\Models\Autoshop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Lang;
use App\User;
use Socialite;
use Validator;
use Services;

use File;
use Session;
use Auth;
use Hash;
use App\Http\Controllers\Autoshop\AlertController;
use App\Models\Autoshop\Products;
use App\Models\Autoshop\Index;

class Customer extends Model
{

  public function addToCompare($request){
			if(!empty(auth()->guard('customer')->user()->id)){
			$check = DB::table('compare')->where('product_ids',$request->product_id)->where('customer_id',auth()->guard('customer')->user()->id)->first();
			if(!$check){
				$id = DB::table('compare')
							 ->insertGetId([
								 'product_ids' => $request->product_id,
								 'customer_id' => auth()->guard('customer')->user()->id
							 ]);
			}
			$count	= DB::table('compare')->where('customer_id',auth()->guard('customer')->user()->id)->count();
			return $count;
		}else{
			$responseData = array('success'=>'0', 'message'=>Lang::get("website.Please login first to like this product"));
		}
		$cartResponse = json_encode($responseData);
		return $cartResponse;
	}

  public function DeleteCompare($id){
    DB::table('compare')->where('product_ids',$id)->where('customer_id',auth()->guard('customer')->user()->id)->delete();
    $responseData = array('success'=>'1', 'message'=>Lang::get("website.Removed Successfully"));
    return $responseData;
  }

  public function updateMyProfile($request){

    $customers_id								=	auth()->guard('customer')->user()->id;
    $customers_firstname            			=   $request->customers_firstname;
    $customers_lastname           				=   $request->customers_lastname;
    //$customers_email_address    		   		=   $request->customers_email_address;
    $customers_fax          		   			=   $request->fax;
    $customers_newsletter          		   		=   $request->newsletter;
    $customers_telephone          		   		=   $request->customers_telephone;
    $customers_gender          		   			=   $request->gender;
    $customers_dob          		   			=   $request->customers_dob;
    $customers_info_date_account_last_modified 	=   date('y-m-d h:i:s');

    $extensions = array('gif','jpg','jpeg','png');
    if($request->hasFile('picture') and in_array($request->picture->extension(), $extensions)){
      $image = $request->picture;
      $fileName = time().'.'.$image->getClientOriginalName();
      $image->move('resources/assets/images/user_profile/', $fileName);
      $customers_picture = 'resources/assets/images/user_profile/'.$fileName;
    }	else{
      $customers_picture = $request->customers_old_picture;;
    }

    $customer_data = array(
      'first_name'			 =>  $customers_firstname,
      'last_name'			 =>  $customers_lastname,
      'phone'			 =>  $customers_telephone,
      'gender'				 =>  $customers_gender,
      'dob'					 =>  $customers_dob,
      'avatar'				 =>  $customers_picture
    );

    //update into customer
    DB::table('users')->where('id', $customers_id)->update($customer_data);

    DB::table('customers_info')->where('customers_info_id', $customers_id)->update(['customers_info_date_account_last_modified'   => $customers_info_date_account_last_modified]);
    $message = Lang::get("website.Profile has been updated successfully");

    return $message;

  }

  public function updateMyPassword($request){
    $old_session = Session::getId();
    $customers_id            					=   auth()->guard('customer')->user()->id;
    $new_password								=   $request->new_password;
    $old_password								=   $request->old_password;
    //$customers_email_address    		   		=   $request->customers_email_address;
    $updated_at 								=   date('y-m-d h:i:s');
    $customers_info_date_account_last_modified 	=   date('y-m-d h:i:s');


    $customer_data = array(
      'password'			=>  bcrypt($new_password),
      'updated_at'		=>  date('y-m-d h:i:s'),
    );

    $userData = DB::table('users')->where('id', $customers_id)->update($customer_data);
    $user = DB::table('users')->where('id', $customers_id)->get();

    DB::table('customers_info')->where('customers_info_id', $customers_id)->update(['customers_info_date_account_last_modified'   =>   $customers_info_date_account_last_modified]);

    $message = Lang::get("website.Password has been updated successfully");
      return  $message;

  }

  function createRandomPassword() {
    $pass = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
    return $pass;
  }

  public function handleSocialLoginCallback($social){
					$old_session = Session::getId();

					$user = Socialite::driver($social)->stateless()->user();
					$password = $this->createRandomPassword();
					// OAuth Two Providers
					$token = $user->token;
					if(!empty($user['gender'])){
						if($user['gender']=='male'){
							$customers_gender = '0';
						}else{
							$customers_gender = '1';
						}
					}else{
						$customers_gender = '0';
					}

					// All Providers
					$social_id = $user->getId();

					$customers_firstname = substr($user->getName(), 0, strpos($user->getName(), ' '));
					$customers_lastname = str_replace($customers_firstname.' ', '', $user->getName());

					$email = $user->getEmail();
					if(empty($email)){
						$email = '';
					}

					if($social == 'facebook'){

            $existUser = DB::table('customers')
                          ->leftJoin('users','customers.customers_id','=','users.id')
                          ->where('customers.fb_id', '=', $social_id)
                          ->orWhere('users.email', '=', $email)->get();

											if(count($existUser)>0){

												$customers_id = $existUser[0]->user_id;

												//update data of customer
												DB::table('users')->where('id','=',$customers_id)->update([
													'first_name' => $customers_firstname,
													'last_name' => $customers_lastname,
													'email' => $email,
                          'password' => Hash::make($password),
													'status' => '1',
													'created_at' =>	 time()
												]);
												DB::table('customers')->where('user_id','=',$customers_id)->update([
													'fb_id' => $social_id,
												]);
											}else{
												//insert data of customer
												$customers_id = DB::table('users')->insertGetId([
													'role_id' => 2,
													'first_name' => $customers_firstname,
													'last_name' => $customers_lastname,
													'email' => $email,
                          'password' =>  Hash::make($password),
													'status' => '1',
													'created_at' =>	 time()
												]);
												$customers_id = DB::table('customers')->insertGetId([
													'user_id' => $customers_id,
													'fb_id' => $social_id,
												]);
											}
					}

					if($social == 'google'){

						$existUser = DB::table('customers')
                          ->leftJoin('users','customers.customers_id','=','users.id')
                          ->where('customers.google_id', '=', $social_id)
                          ->orWhere('users.email', '=', $email)->get();

											if(count($existUser)>0){

												$customers_id = $existUser[0]->user_id;

												//update data of customer
												DB::table('users')->where('id','=',$customers_id)->update([
													'first_name' => $customers_firstname,
													'last_name' => $customers_lastname,
													'email' => $email,
                          'password' =>  Hash::make($password),
													'status' => '1',
													'created_at' =>	 time()
												]);
												DB::table('customers')->where('user_id','=',$customers_id)->update([
													'google_id' => $social_id,
												]);
											}else{
												//insert data of customer
												$customers_id = DB::table('users')->insertGetId([
													'role_id' => 2,
													'first_name' => $customers_firstname,
													'last_name' => $customers_lastname,
													'email' => $email,
                          'password' => Hash::make($password),
													'status' => '1',
													'created_at' =>	 time()
												]);
												$customers_id = DB::table('customers')->insertGetId([
													'user_id' => $customers_id,
													'google_id' => $social_id,
												]);
											}
					}


					$userData = DB::table('users')->where('id', '=', $customers_id)->get();

					$existUserInfo = DB::table('customers_info')->where('customers_info_id', $customers_id)->get();
					$customers_info_id 							= $customers_id;
					$customers_info_date_of_last_logon  		= date('Y-m-d H:i:s');
					$customers_info_number_of_logons     		= '1';
					$customers_info_date_account_created 		= date('Y-m-d H:i:s');
					$global_product_notifications 				= '1';

					if(count($existUserInfo)>0){
						//update customers_info table
						DB::table('customers_info')->where('customers_info_id', $customers_info_id)->update([
							'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
							'global_product_notifications' => $global_product_notifications,
							'customers_info_number_of_logons'=> DB::raw('customers_info_number_of_logons + 1')
						]);

					}else{

						//insert customers_info table
						$customers_default_address_id = DB::table('customers_info')->insertGetId([
								'customers_info_id' => $customers_info_id,
								'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
								'customers_info_number_of_logons' =>  $customers_info_number_of_logons,
								'customers_info_date_account_created' => $customers_info_date_account_created,
								'global_product_notifications' => $global_product_notifications
						]);

					}

					//check if already login or not
					$already_login = DB::table('whos_online')->where('customer_id', '=', $customers_id)->get();
					if(count($already_login)>0){
						DB::table('whos_online')
							->where('customer_id', $customers_id)
							->update([
									'full_name'  => $userData[0]->first_name.' '.$userData[0]->last_name,
									'time_entry'   => date('Y-m-d H:i:s'),
							]);
					}else{
						DB::table('whos_online')
							->insert([
									'full_name'  => $userData[0]->first_name.' '.$userData[0]->last_name,
									'time_entry' => date('Y-m-d H:i:s'),
									'customer_id'    => $customers_id
							]);
					}

					$customerInfo = array("email" => $email, "password" => $password);
          //dd($customerInfo);
					$old_session = Session::getId();

					if(auth()->guard('customer')->attempt($customerInfo)) {
							$customer = auth()->guard('customer')->user();

							//set session
							session(['customers_id' => $customer->id]);

							//cart
							$cart = DB::table('customers_basket')->where([
								['session_id', '=', $old_session],
							])->get();

							if(count($cart)>0){
								foreach($cart as $cart_data){
									$exist = DB::table('customers_basket')->where([
										['customers_id', '=', $customer->id],
										['products_id', '=', $cart_data->products_id],
										['is_order', '=', '0'],
									])->delete();
								}
							}

							DB::table('customers_basket')->where('session_id','=', $old_session)->update([
								'customers_id'	=>	$customer->id
								]);

							DB::table('customers_basket_attributes')->where('session_id','=', $old_session)->update([
								'customers_id'	=>	$customer->id
								]);


							//insert device id
							if(!empty(session('device_id'))){
								DB::table('devices')->where('device_id', session('device_id'))->update(['customers_id'	=>	$customer->id]);
							}

							$result['customers'] = DB::table('users')->where('id', $customer->id)->get();
							return  $result;
						}
            $result="";
            return  $result;

    }

  public function likeMyProduct($request){

      if(!empty(auth()->guard('customer')->user()->id)){
        $liked_products_id  = $request->products_id;

        $liked_customers_id = auth()->guard('customer')->user()->id;
        $date_liked			= date('Y-m-d H:i:s');

        //to avoide duplicate record
        $record = DB::table('liked_products')->where([
            'liked_products_id'  => $liked_products_id,
            'liked_customers_id' => $liked_customers_id
          ])->get();


        if(count($record)>0){

          DB::table('liked_products')->where([
            'liked_products_id'  => $liked_products_id,
            'liked_customers_id' => $liked_customers_id
          ])->delete();



          DB::table('products')->where('products_id','=',$liked_products_id)->decrement('products_liked');
          $products = DB::table('products')->where('products_id','=',$liked_products_id)->get();

          $responseData = array('success'=>'1', 'message'=>Lang::get("website.Product is disliked"), 'total_likes' => $products[0]->products_liked,'id' => 'like_count_'.$liked_products_id);
        }else{

          DB::table('liked_products')->insert([
            'liked_products_id'  => $liked_products_id,
            'liked_customers_id' => $liked_customers_id,
            'date_liked' 		 => $date_liked
          ]);
          DB::table('products')->where('products_id','=',$liked_products_id)->increment('products_liked');
          $products = DB::table('products')->where('products_id','=',$liked_products_id)->get();

          $responseData = array('success'=>'2', 'message'=>Lang::get("website.Product is liked"), 'total_likes' => $products[0]->products_liked,'id' => 'like_count_'.$liked_products_id);

        }


      }else{
        $responseData = array('success'=>'0', 'message'=>Lang::get("website.Please login first to like this product"));
      }
      $cartResponse = json_encode($responseData);
      return $cartResponse;
    }

  public function unlikeMyProduct($id){

      			$liked_products_id  = $id;

      			$liked_customers_id = auth()->guard('customer')->user()->id;

      			DB::table('liked_products')->where([
      				'liked_products_id'  => $liked_products_id,
      				'liked_customers_id' => $liked_customers_id
      			])->delete();

      			DB::table('products')->where('products_id','=',$liked_products_id)->decrement('products_liked');

  	}

  public function wishlist($request){
        $index = new Index();
        $productss = new Products();
        $result = array();
    		$result['commonContent'] = $index->commonContent();

    		if(!empty($request->limit)){
    			$limit = $request->limit;
    		}else{
    			$limit = 15;
    		}

    		$data = array('page_number'=>0, 'type'=>'wishlist', 'limit'=>$limit, 'categories_id'=>'', 'search'=>'', 'min_price'=>'', 'max_price'=>'' );
    		$products =  $productss->products($data);
    		$result['products'] = $products;
    		$cart = '';
    		$result['cartArray'] = $productss->cartIdArray($cart);

    		//liked products
    		$result['liked_products'] = $productss->likedProducts();
    		if($limit > $result['products']['total_record']){
    			$result['limit'] = $result['products']['total_record'];
    		}else{
    			$result['limit'] = $limit;
    		}

    		//echo '<pre>'.print_r($result['products'], true).'</pre>';
    		return  $result;
  	}

  public function processLogin($request,$old_session){
    		$result = array();
        $customer = auth()->guard('customer')->user();
        session(['guest_checkout' => 0]);

    				//set session
    				session(['customers_id' => $customer->id]);

    				//cart
    				$cart = DB::table('customers_basket')->where([
    					['session_id', '=', $old_session],
    				])->get();

    				if(count($cart)>0){
    					foreach($cart as $cart_data){
    						$exist = DB::table('customers_basket')->where([
    							['customers_id', '=', $customer->id],
    							['products_id', '=', $cart_data->products_id],
    							['is_order', '=', '0'],
    						])->delete();
    					}
    				}

    				DB::table('customers_basket')->where('session_id','=', $old_session)->update([
    					'customers_id'	=>	$customer->id
    					]);

    				DB::table('customers_basket_attributes')->where('session_id','=', $old_session)->update([
    					'customers_id'	=>	$customer->id
    					]);


    				//insert device id
    				if(!empty(session('device_id'))){
    					DB::table('devices')->where('device_id', session('device_id'))->update(['customers_id'	=>	$customer->id]);
    				}

    				$result['customers'] = DB::table('users')->where('id', $customer->id)->get();
    				return $result;

    			}

  public function Compare(){
    $compare = DB::table('compare')->where('customer_id',auth()->guard('customer')->user()->id)->get();
    return $compare;
  }

  public function ExistUser($email){
    $existUser = DB::table('users')->where('email', $email)->get();
    return $existUser;
  }

  public function UpdateExistUser($email,$password){
    DB::table('users')->where('email', $email)->update([
        'password'	=>	Hash::make($password)
        ]);
  }

    public function updateDevice($request,$device_data){
    
    }

    public function signupProcess($request){
      
        $res = array();
        $old_session = Session::getId();
        $userName = $request->userName;
        $email = $request->email;
        $phone = $request->phone;
            
        $res['email'] =  "false";
        $res['user_name'] =  "false";
        $res['user_phone'] =  "false";
        $res['user_exist'] =  "false";
        $res['email_verified'] =  "false";
        $res['action_insert_data'] = "false";

        //eheck email already exit
        $userData = \DB::table('users')->where('role_id', 2)->where('email', $email)->orWhere('phone', $phone)->orWhere('user_name', $userName)->first();
        if(!empty($userData)){
            if($userData->email_verified ==  1) $res['email_verified'] =  "true";
            if($userData->email ==  $email) $res['email'] =  "true";
            if($userData->phone ==  $phone) $res['user_phone'] =  "true";
            if($userData->user_name ==  $userName) $res['user_name'] =  "true";
            $res['user_exist'] =  "true";
            
        }else{
            
           
            $firstName = $request->firstName;
            $lastName = $request->lastName;
            $gender = $request->gender;
            $password = $request->password;
            $company =  $request->company;
            //$token = $request->token;
            $date = date('y-m-d h:i:s');
            $profile_photo = 'images/user.png';
            $email_verified_token =  sha1(time());
          
            $data = array(
                'user_name' => $userName,
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'gender' => $gender,
                'role_id' => 2,
                'phone' => $phone,
                'email' => $email,
                'password' => Hash::make($password),
                'created_at' => $date,
                'updated_at' => $date,
                'email_verified_token' => $email_verified_token,
            );
            
            $customer_id = DB::table('users')->insertGetId($data);
            DB::table('clients')->insert([
                'user_id' => $customer_id ,
                'company' => $company, 
                'image' => $profile_photo , 
                'status' => 1 ,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            
            $res['action_insert_data'] = "true";
            
            //email and notification
            $customers = DB::table('users')->where('id',  $customer_id)->get();
            $myVar = new AlertController();
            $alertSetting = $myVar->createUserAlert($customers);
        }
        
        return $res;
        
    }
             
              /*
          if(\DB::table('users')->where('role_id', 2)->where('email', $email)->count() > 0){
            $res['email'] =  "true";
            $res['user_exist'] =  "true";

          }

          //eheck email already exit
          if(\DB::table('users')->where('role_id', 2)->where('phone', $phone)->count() > 0){
            $res['user_phone'] =  "true";
             $res['user_exist'] =  "true";
          }

          //eheck user name already exit
          if(\DB::table('users')->where('role_id', 2)->where('user_name', $userName)->count() > 0){
             $res['user_name'] =  "true";
             $res['user_exist'] =  "true";
          }
                
*/

          /*
          // No need to customer autologin - as make user user have validate their email address. 
          //check authentication of email and password
          if(auth()->guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
           
            $res['auth'] = "true";
            $customer = auth()->guard('customer')->user();

            //set session
            session(['customers_id' => $customer->id]);

            //cart
            $cart = DB::table('customers_basket')->where([
              ['session_id', '=', $old_session],
            ])->get();

            if(count($cart)>0){
              foreach($cart as $cart_data){
                $exist = DB::table('customers_basket')->where([
                  ['customers_id', '=', $customer->id],
                  ['products_id', '=', $cart_data->products_id],
                  ['is_order', '=', '0'],
                ])->delete();
              }
            }

            DB::table('customers_basket')->where('session_id','=', $old_session)->update([
              'customers_id'	=>	$customer->id
              ]);

            DB::table('customers_basket_attributes')->where('session_id','=', $old_session)->update([
              'customers_id'	=>	$customer->id
              ]);

            //insert device id
            if(!empty(session('device_id'))){
              DB::table('devices')->where('device_id', session('device_id'))->update(['customers_id'	=>	$customer->id]);
            }

            $customers = DB::table('users')->where('id', $customer->id)->get();
            $result['customers'] = $customers;
            
            //email and notification
            $myVar = new AlertController();
            $alertSetting = $myVar->createUserAlert($customers);
            
            $res['result'] = $result;
            return $res;
          }else{
            $res['auth'] = "true";
            return $res;
          }
          
          */


       

              


}
