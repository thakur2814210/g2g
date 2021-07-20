<?php
namespace App\Http\Controllers\Autoshop;
//use Mail;
//validator is builtin class in laravel
use Validator;

use DB;
//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Autoshop\CartController;
use App\Http\Controllers\Autoshop\ShippingAddressController;
use App\Http\Controllers\Autoshop\AlertController;

//for Carbon a value
use Carbon;
use Session;
use Lang;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Languages;
use App\Models\Autoshop\Products;
use App\Models\Autoshop\Currency;
use App\Models\Autoshop\Shipping;
use App\Models\Autoshop\Cart;
use App\Models\Autoshop\Order;
use App\User;


//email
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{


		public function __construct(
			                  Index $index,
							Languages $languages,
							Products $products,
							Currency $currency,
							Cart  $cart,
							Shipping $shipping,
							Order $order
							)
		{
			$this->index = $index;
			$this->languages = $languages;
			$this->products = $products;
			$this->currencies = $currency;
			$this->cart = $cart;
			$this->shipping = $shipping;
			$this->order = $order;
			$this->theme = new ThemeController();
		}

	//test stripe
	public function stripeForm(Request $request){
			$title = array('pageTitle' => Lang::get('website.Checkout'));
			$result = array();
			$result['commonContent'] = $this->index->commonContent();
			return view("stripeForm", $title)->with('result', $result);
	}

	public function guest_checkout(){
        session(['guest_checkout' => 1]);
	    return redirect('/checkout');
	}
	
	// telr method
	public static function paymentByTelr(Request $request){
 
    $language_id = $request->language_id;
    $client = $user = User::where('id', auth()->guard('customer')->user()->id)->first();
    $billing_address_line1 = $billing_address_line2 = $billing_address_line3 = null;
    $billing_address_city = $billing_address_region = $billing_address_pobox = null;
    $billing_address_country =  'ae';
    
    
   
    $store_id       = '23596';
    $auth_token     = 'ksHB^z8pGQ~NTPwJ';
    $device_type    = 'Web';
    $device_uuid    = 'Web';
    $app_name       = 'G2G Go To Garage';
    $app_version    = '1.0.0';
    $app_user       = $user->id;
    $app_id         = 'com.g2g.app';
    $cartid = 'cart_id'.time();
    $tran_description = 'G2G Go To Garage';
    $tran_amount = $request->amount;;
        
    
    
   
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
	
	
	
	
	//checkout
	public function checkout(Request $request){



		$title = array('pageTitle' => Lang::get('website.Checkout'));
		$final_theme = $this->theme->theme();
		$result = array();
		//cart data
		
			$other_charges = DB::table('other_charges')
		                ->join('other_charges_to_categories','other_charges_to_categories.other_charges_id','other_charges.id')
		                ->where('status', 1)->get();
		

		$result['cart'] = $this->cart->myCart($result);
		
		// lets check if other chrages applicable of not
		foreach($result['cart']  as $products){
		    foreach($other_charges as $othercharge){
		         if($othercharge->categories_id == $products->categories_id){
		              $baskits = 	DB::table('customers_basket')->where('customers_basket_id', '=', $products->customers_basket_id)->first();
		              if($baskits){
		                    $baskits_products_id =  (int)$baskits->products_id;
                            $baskit_id = $baskits->customers_basket_id;
                    	    $org_final_price = $baskits->final_price;
                    	    if($othercharge->is_percentage == 1){
                                $perc_amount = ($othercharge->amount / 100)  * $baskits->final_price;
                                if($othercharge->changes_on_total == 1){
                                     $products->final_price = number_format((float)($baskits->final_price + $perc_amount ), 2, '.', '');
                                }elseif($othercharge->changes_on_total == 2){
                                     $products->final_price = number_format((float)($baskits->final_price - $perc_amount), 2, '.', '');
                                }
                            }else{
                                if($othercharge->changes_on_total == 1){
                                    $products->final_price = number_format((float)($baskits->final_price + $othercharge->amount), 2, '.', '');
                                }elseif($othercharge->changes_on_total == 2){
                                    $final_price = number_format((float)($baskits->final_price - $othercharge->amount), 2, '.', '');
                                }else{
                                    $products->final_price = number_format((float)$othercharge->amount, 2, '.', '');
                                }
                            }
                            $final_price = $products->final_price;
                            $products->old_final_price = $final_price;
                            
                            DB::table('customers_basket')->where('customers_basket_id', '=', $baskits->customers_basket_id)->update([
                    		        'final_price' => $final_price,
                    		        'old_final_price' => $org_final_price,
                    		        'customers_basket_quantity' =>($baskits->customers_basket_quantity > $othercharge->qty_limit ) ?  $othercharge->qty_limit : $baskits->customers_basket_quantity
                    		]);
                    		///now handleother chrages baskets
                            $other_charges_baskets = 	DB::table('other_charges_baskets')->where('customers_basket_id', '=', $baskits->customers_basket_id)->where('products_id', '=', $baskits_products_id)->first();
                            if(empty($other_charges_baskets)){
                                DB::table('other_charges_baskets')->insert(
                    			[
                    				 'other_charges_id' => $othercharge->id,
                    				 'customers_basket_id'  => $baskit_id,
                    				 'products_id' =>$baskits_products_id,
                    				 'is_checked' => 1
                    			]);
                            }else{
                                DB::table('other_charges_baskets')->where('id', '=', $other_charges_baskets->id)->where('products_id', '=', $baskits_products_id)->update(['is_checked' => 1]);
                            }
                        
		              }
		         }
		    }
		}
       
		if(count($result['cart'])==0){
			return redirect("/autoshop");
		}else{

			//apply coupon
			if(!empty(session('coupon')) and count(session('coupon'))>0){
				$session_coupon_data = session('coupon');
				session(['coupon' => array()]);
				$response = array();
				if(!empty($session_coupon_data)){
					foreach($session_coupon_data as $key=>$session_coupon){
							$response = $this->cart->common_apply_coupon($session_coupon->code);
					}
				}
			}

			$result['commonContent'] = $this->index->commonContent();

			$address = array();


			if(empty(session('step'))){
				session(['step' => '0']);
			}


			if(!empty(auth()->guard('customer')->user()->customers_default_address_id)){

				$address_id = auth()->guard('customer')->user()->customers_default_address_id;
				$address = $this->shipping->getShippingAddress($address_id);
				if(!empty($address)){
					$address = $address[0];

					$address->delivery_phone=auth()->guard('customer')->user()->customers_telephone;
				}else{
					$address = '';
				}
			}
           
			if(empty(session('shipping_address'))){
				session(['shipping_address' => $address]);
			}

			//shipping counties
			if(!empty(session('shipping_address')->countries_id)){
				$countries_id = session('shipping_address')->countries_id;
			}else{
				$countries_id	   = '';
			}

			$result['countries'] = $this->shipping->countries();
			//$result['zones'] = $this->shipping->zones($countries_id);


			//get tax
			if(!empty(session('shipping_address')->zone_id)){
				$tax_zone_id = session('shipping_address')->zone_id;
				$tax = $this->calculateTax($tax_zone_id);
				session(['tax_rate' => $tax]);
			}else{
				session(['tax_rate' => '0']);
			}

			try{
			//shipping methods
			$result['shipping_methods'] = $this->shipping_methods();

			//payment methods
			$result['payment_methods'] = $this->getPaymentMethods();
			//dd(	$result['payment_methods']);
			}
			catch(\Exception $e){
				$msg = $e->getMessage();

				return redirect('general_error/'.$msg);
			}

			//price
			$price=0;
			if(count($result['cart']) > 0){

				foreach( $result['cart'] as $products){
					$req = array();
					$req['products_id'] = $products->products_id;
					if(isset($products->attributes)){
						foreach ($products->attributes as $key => $value) {
                            $attr[$key] = $value->products_attributes_id;
                        }
                        $req['attributes'] = $attr;
					}
					$check = $this->products->getquantity($req);
					if($products->customers_basket_quantity > $check['stock']){
						session(['out_of_stock' => 1]);
						session(['out_of_stock_product' => $products->products_id]);
			   		return redirect('viewcart');
					}

					$price+= $products->final_price * $products->customers_basket_quantity;
				}
				session(['products_price' => $price]);
			}


			//breaintree token
			$token = $this->generateBraintreeTokenWeb();
			session(['braintree_token' => $token]);
           // dd($result);
            
			return view("autoshop.checkout", ['title' =>$title,'final_theme' => $final_theme, 'other_charges' =>$other_charges])->with('result', $result);
		}

	}

	//checkout
	public function checkout_shipping_address(Request $request){

		$title = array('pageTitle' => Lang::get('website.Checkout'));
		$result = array();
		$result['commonContent'] = $this->index->commonContent();

		if(session('step')=='0'){
			session(['step' => '1']);
		}

		foreach($request->all() as $key=>$value)
		{
		  $shipping_data[$key] = $value;

		  //billing address
		  if($key=='firstname'){
			 $billing_data['billing_firstname'] = $value;
		  }else if($key=='lastname'){
			 $billing_data['billing_lastname'] = $value;
		  }else if($key=='email'){
			 $billing_data['billing_email'] = $value;
		  }else if($key=='company'){
			 $billing_data['billing_company'] = $value;
		  }else if($key=='street'){
			 $billing_data['billing_street'] = $value;
		  }else if($key=='countries_id'){
			 $billing_data['billing_countries_id'] = $value;
		  }else if($key=='zone_id'){
			 $billing_data['billing_zone_id'] = $value;
		  }else if($key=='city'){
			 $billing_data['billing_city'] = $value;
		  }else if($key=='postcode'){
			 $billing_data['billing_zip'] = $value;
		  }else if($key=='delivery_phone'){
			 $billing_data['billing_phone'] = $value;
		  }
		}

		if(empty(session('billing_address')) or session('billing_address')->same_billing_address==1){
			$billing_address = (object) $billing_data;
			$billing_address->same_billing_address = 1;
			session(['billing_address' => $billing_address]);
		}

		$address = (object) $shipping_data;
		session(['shipping_address' => $address]);

		return redirect()->back();
	}


	//checkout_billing_address
	public function checkout_billing_address(Request $request){
		if(session('step')=='1'){
			session(['step' => '2']);
		}

		if(empty($request->same_billing_address)){

			foreach($request->all() as $key=>$value)
			{
			  $billing_data[$key] = $value;
			}

			$billing_address = (object) $billing_data;
			$billing_address->same_billing_address = 0;
			session(['billing_address' => $billing_address]);
		}else{

			$billing_address = session('billing_address');
			$billing_address->same_billing_address = 1;
			session(['billing_address' => $billing_address]);
		}

		return redirect()->back();
	}

	//checkout_payment_method
	public function checkout_payment_method(Request $request){
		
		//dd($request->all());die;
		if(session('step')=='2'){
			session(['step' => '3']);
		}
		$result['commonContent'] = $this->index->commonContent();

		$shipping_detail = array();
		
		//echo session('step');
		
		foreach($request->all() as $key=>$value){

		  if($key=='shipping_price' and !empty($result['commonContent']['setting'][82]->value) and $result['commonContent']['setting'][82]->value <= session('total_price')){
			$shipping_detail['shipping_price'] = 0;
		  }else{
			$shipping_detail[$key] = $value;
		  }

		}
		session(['shipping_detail' => (object) $shipping_detail]);
		return redirect()->back();

	}

	//order_detail
	public function paymentComponent(Request $request){
		session(['payment_method' => $request->payment_method]);
		//return view('paymentComponent');
	}

	//generate token
	public function generateBraintreeTokenWeb(){

		$payments_setting = $this->order->payments_setting_for_brain_tree();
		if($payments_setting['merchant_id']->status==1){
		//braintree transaction get nonce
		$is_transaction  = '0'; 			# For payment through braintree

		if($payments_setting['merchant_id']->environment == '0'){
			$braintree_environment = 'sandbox';
		}else{
			$environment = 'production';
		}

		$braintree_merchant_id = $payments_setting['merchant_id']->value;
		$braintree_public_key  = $payments_setting['public_key']->value;
		$braintree_private_key = $payments_setting['private_key']->value;

		//for token please check braintree.php file
		require_once app_path('braintree/Braintree.php');
		}else{
			$clientToken = '';
		}
		return $clientToken;

	}

	//place_order
	public function place_order(Request $request){
		
		$payment_status = $this->order->place_order($request);
		if($payment_status=='success'){
			return redirect('orders')->with('success', Lang::get("website.Payment has been processed successfully"));
		}else {
			return redirect()->back()->with('error', Lang::get("website.Error while placing order"));
		}
	}


	//orders
	public function orders(Request $request){
	  // dd($request);
		$title = array('pageTitle' => Lang::get("website.My Orders"));
		$final_theme = $this->theme->theme();
    $result = $this->order->orders($request);
		return view("autoshop.orders", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
	}

	//viewMyOrder
	public function viewOrder(Request $request,$id){

		$title = array('pageTitle' => Lang::get("website.View Order"));
		$final_theme = $this->theme->theme();
		$result = $this->order->viewOrder($request,$id);
		if($result['res'] = "view-order"){
			return view("autoshop.view-order", $title)->with(['result' => $result,'final_theme' => $final_theme]);
		}else{
			return redirect('orders');
		}
	}



	//calculate tax
	public function calculateTax($tax_zone_id){

	  $tax = $this->order->calculateTax($tax_zone_id);
		return $tax;

	}


	//shipping methods
	public function shipping_methods(){

		$result		  = array();
		if(!empty(session('shipping_address'))){
			$countries_id = session('shipping_address')->countries_id;
			$toPostalCode = session('shipping_address')->postcode;
			$toCity		  = session('shipping_address')->city;
			$toAddress	  = 'gh';
			$countries = $this->order->getCountries($countries_id);
			$toCountry = $countries[0]->countries_iso_code_2;
			/* $zone_id = session('shipping_address')->zone_id;
			if($zone_id != -1 and !empty($zone_id)){
				$zones =  $this->order->getZones($zone_id);
				$toState = $zones[0]->zone_code;
			}*/
			$zone_id = '';
		}else{
			$countries_id = '';
			$toPostalCode = '';
			$toCity		  = '';
			$toAddress	  = '';
			$toCountry = '';
			$zone_id = '';
		}

		//product weight
		$cart = $this->cart->myCart($result);

		$index = '0';
		$total_weight = '0';

		foreach($cart as $products_data){
			if($products_data->unit=='Gram'){
				$productsWeight = $products_data->weight/453.59237;
			}else if($products_data->unit=='Kilogram'){
				$productsWeight = $products_data->weight/0.45359237;
			}else{
				$productsWeight = $products_data->weight;
			}

			$total_weight+=$productsWeight;
		}

		$products_weight = $total_weight;


		//website path
		//$websiteURL =  "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		$websiteURL =  "https://" . $_SERVER['SERVER_NAME'].'/';
		$replaceURL = str_replace('getRate','', $websiteURL);
		$requiredURL = $replaceURL.'app/ups/ups.php';

		//default shipping method
		$shippings = $this->order->getShippingMethods();
		$result = array();
		$mainIndex = 0;
		foreach($shippings as $shipping_methods){
			//dd($shipping_methods);

			$shippings_detail = $this->order->getShippingDetail($shipping_methods);

			//ups shipping rate
			if($shipping_methods->methods_type_link == 'upsShipping' and $shipping_methods->status == '1'){

				$result2= array();
				$is_transaction = '0';

				$ups_shipping = $this->order->getUpsShipping();

				//shipp from and all credentials
				$accessKey  = $ups_shipping[0]->access_key;
				$userId 	= $ups_shipping[0]->user_name;
				$password 	= $ups_shipping[0]->password;

				//ship from address
				$fromAddress  = $ups_shipping[0]->address_line_1;
				$fromPostalCode  = $ups_shipping[0]->post_code;
				$fromCity  = $ups_shipping[0]->city;
				$fromState  = $ups_shipping[0]->state;
				$fromCountry  = $ups_shipping[0]->country;

				//production or test mode
				if($ups_shipping[0]->shippingEnvironment == 1){ 			#production mode
					$useIntegration = true;
				}else{
					$useIntegration = false;								#test mode
				}

				$serviceData = explode(',',$ups_shipping[0]->serviceType);

				$index = 0;
				foreach($serviceData as $value){
					if($value == "US_01")
					{
						$name = Lang::get('website.Next Day Air');
						$serviceTtype = "1DA";
					}
					else if ($value == "US_02")
					{
						$name = Lang::get('website.2nd Day Air');
						$serviceTtype = "2DA";
					}
						else if ($value == "US_03")
					{
						$name = Lang::get('website.Ground');
						$serviceTtype = "GND";
					}
					else if ($value == "US_12")
					{
						$name = Lang::get('website.3 Day Select');
						$serviceTtype = "3DS";
					}
					else if ($value == "US_13")
					{
						$name = Lang::get('website.Next Day Air Saver');
						$serviceTtype = "1DP";
					}
					else if ($value == "US_14")
					{
						$name = Lang::get('website.Next Day Air Early A.M.');
						$serviceTtype = "1DM";
					}
					else if ($value == "US_59")
					{
						$name = Lang::get('website.2nd Day Air A.M.');
						$serviceTtype = "2DM";
					}
					else if($value == "IN_07")
					{
						$name = Lang::get('website.Worldwide Express');
						$serviceTtype = "UPSWWE";
					}
					else if ($value == "IN_08")
					{
						$name = Lang::get('website.Worldwide Expedited');
						$serviceTtype = "UPSWWX";
					}
					else if ($value == "IN_11")
					{
						$name = Lang::get('website.Standard');
						$serviceTtype = "UPSSTD";
					}
					else if ($value == "IN_54")
					{
						$name = Lang::get('website.Worldwide Express Plus');
						$serviceTtype = "UPSWWEXPP";
					}

				$some_data = array(
					'access_key' => $accessKey,  						# UPS License Number
					'user_name' => $userId,								# UPS Username
					'password' => $password, 							# UPS Password
					'pickUpType' => '03',								# Drop Off Location
					'shipToPostalCode' => $toPostalCode, 				# Destination  Postal Code
					'shipToCountryCode' => $toCountry,					# Destination  Country
					'shipFromPostalCode' => $fromPostalCode, 			# Origin Postal Code
					'shipFromCountryCode' => $fromCountry,				# Origin Country
					'residentialIndicator' => 'IN', 					# Residence Shipping and for commercial shipping "COM"
					'cServiceCodes' => $serviceTtype, 					# Sipping rate for UPS Ground
					'packagingType' => '02',
					'packageWeight' => $productsWeight
				  );

				  $curl = curl_init();
				  // You can also set the URL you want to communicate with by doing this:
				  // $curl = curl_init('http://localhost/echoservice');

				  // We POST the data
				  curl_setopt($curl, CURLOPT_POST, 1);
				  // Set the url path we want to call
				  curl_setopt($curl, CURLOPT_URL, $requiredURL);
				  // Make it so the data coming back is put into a string
				  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				  // Insert the data
				  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

				  // You can also bunch the above commands into an array if you choose using: curl_setopt_array

				  // Send the request
				  $rate = curl_exec($curl);
				  // Free up the resources $curl is using
				  curl_close($curl);

				 if (is_numeric($rate)){
					$success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$shippings_detail[0]->name, 'is_default'=>$shipping_methods->isDefault);
					$result2[$index] = array('name'=>$name,'rate'=>$rate,'currencyCode'=>'USD','shipping_method'=>'upsShipping');
					$index++;
				 }
				 else{
					$success = array('success'=>'0','message'=>"Selected regions are not supported for UPS shipping", 'name'=>$shippings_detail[0]->name);
				 }
				  $success['services'] = $result2;
				}
				$result[$mainIndex] = $success;
				$mainIndex++;


			}else if($shipping_methods->methods_type_link == 'flateRate' and $shipping_methods->status == '1'){
				$ups_shipping = $this->order->getUpsShippingRate();
				$data2 =  array('name'=>$shippings_detail[0]->name,'rate'=>$ups_shipping[0]->flate_rate,'currencyCode'=>$ups_shipping[0]->currency,'shipping_method'=>'flateRate');
				if(count($ups_shipping)>0){
					$success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$shippings_detail[0]->name, 'is_default'=>$shipping_methods->isDefault);
					$success['services'][0] = $data2;
					$result[$mainIndex] = $success;
				 	$mainIndex++;
				}


			}else if($shipping_methods->methods_type_link == 'localPickup' and $shipping_methods->status == '1') {

				$data2 =  array('name'=>$shippings_detail[0]->name, 'rate'=>'0', 'currencyCode'=>'USD', 'shipping_method'=>'localPickup');
				$success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$shippings_detail[0]->name, 'is_default'=>$shipping_methods->isDefault);
				$success['services'][0] = $data2;
				$result[$mainIndex] = $success;
				$mainIndex++;

			}else if($shipping_methods->methods_type_link == 'freeShipping'  and $shipping_methods->status == '1'){

				$data2 =  array('name'=>$shippings_detail[0]->name,'rate'=>'0','currencyCode'=>'USD','shipping_method'=>'freeShipping');
				$success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$shippings_detail[0]->name, 'is_default'=>$shipping_methods->isDefault);
				$success['services'][0] = $data2;
				$result[$mainIndex] = $success;
				$mainIndex++;
			}else if($shipping_methods->methods_type_link == 'shippingByWeight'  and $shipping_methods->status == '1'){

				//cart data
				$carts = $this->cart->myCart('');

				$weight = 0;
				foreach($carts as $cart){
					$weight += $cart->weight*$cart->customers_basket_quantity;
				}

				//check price by weight
				$priceByWeight = $this->order->priceByWeight($weight);

				if(!empty($priceByWeight) and count($priceByWeight)>0 ){
					$price = $priceByWeight[0]->weight_price;
				}else{
					$price = 0;
				}

				$data2 =  array('name'=>$shippings_detail[0]->name,'rate'=>$price,'currencyCode'=>'USD','shipping_method'=>'Shipping By Weight');
				$success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$shippings_detail[0]->name, 'is_default'=>$shipping_methods->isDefault);
				$success['services'][0] = $data2;
				$result[$mainIndex] = $success;
				$mainIndex++;
			}
		}

		return $result;
	}

	//get default payment method
	public function getPaymentMethods(){

		/**   BRAIN TREE **/
		//////////////////////
		$result = array();
		$payments_setting = $this->order->payments_setting_for_brain_tree();
		if($payments_setting['merchant_id']->environment=='0'){
			$braintree_enviroment = 'Test';
		}else{
			$braintree_enviroment = 'Live';
		}

		$braintree = array(
			'environment' => $braintree_enviroment,
			'name' => $payments_setting['merchant_id']->name,
			'public_key' => $payments_setting['public_key']->value,
			'active' => $payments_setting['merchant_id']->status,
			'payment_method'=>$payments_setting['merchant_id']->payment_method,
			'payment_currency' => Session::get('currency_code'),
		);
       /**  END BRAIN TREE **/
			 //////////////////////

			 /**   STRIPE**/
			 //////////////////////

	  $payments_setting = $this->order->payments_setting_for_stripe();
		if($payments_setting['publishable_key']->environment=='0'){
			$stripe_enviroment = 'Test';
		}else{
			$stripe_enviroment = 'Live';
		}

		$stripe = array(
			'environment' => $stripe_enviroment,
			'name' => $payments_setting['publishable_key']->name,
			'public_key' => $payments_setting['publishable_key']->value,
			'active' => $payments_setting['publishable_key']->status,
			'payment_currency' => Session::get('currency_code'),
			'payment_method'=>$payments_setting['publishable_key']->payment_method
		);

		/**   END STRIPE**/
		//////////////////////

		 /**   CASH ON DELIVERY**/
		 //////////////////////

		$payments_setting = $this->order->payments_setting_for_cod();

		$cod = array(
			'environment' => 'Live',
			'name' => $payments_setting->name,
			'public_key' => '',
			'active' => $payments_setting->status,
			'payment_currency' => Session::get('currency_code'),
			'payment_method'=>$payments_setting->payment_method
		);


		/**   END CASH ON DELIVERY**/
		/*************************/
		
		/**   TELR **/
		 //////////////////////
    	$telr = array(
			'environment' => 'Live',
			'name' => 'Credit Card',
			'public_key' => '',
			'active' => 1,
			'payment_currency' => Session::get('currency_code'),
			'payment_method'=>'telr'
		);


		/**   END TELR**/
		/*************************/

		/**   PAYPAL**/
		/*************************/
		$payments_setting = $this->order->payments_setting_for_paypal();

		if($payments_setting['id']->environment=='0'){
			$paypal_enviroment = 'Test';
		}else{
			$paypal_enviroment = 'Live';
		}

		$paypal = array(
			'environment' => $paypal_enviroment,
			'name' => $payments_setting['id']->name,
			'public_key' => $payments_setting['id']->value,
			'active' => $payments_setting['id']->status,
			'payment_method'=>$payments_setting['id']->payment_method,
			'payment_currency' => Session::get('currency_code'),

		);

		/**   END PAYPAL**/
		/*************************/

		/**   INSTAMOJO**/
		/*************************/
		$payments_setting = $this->order->payments_setting_for_instamojo();
		if($payments_setting['auth_token']->environment=='0'){
			$instamojo_enviroment = 'Test';
		}else{
			$instamojo_enviroment = 'Live';
		}

		$instamojo = array(
			'environment' => $instamojo_enviroment,
			'name' => $payments_setting['auth_token']->name,
			'public_key' => $payments_setting['api_key']->value,
			'active' => $payments_setting['api_key']->status,
			'payment_currency' => Session::get('currency_code'),
			'payment_method' => $payments_setting['api_key']->payment_method,
		);

		/**   END INSTAMOJO**/
		/*************************/

		/**   END HYPERPAY**/
		/*************************/
		$payments_setting = $this->order->payments_setting_for_hyperpay();
		//dd($payments_setting);
		if($payments_setting['userid']->environment=='0'){
			$hyperpay_enviroment = 'Test';
		}else{
			$hyperpay_enviroment = 'Live';
		}

		$hyperpay = array(
			'environment' => $hyperpay_enviroment,
			'name' => $payments_setting['userid']->name,
			'public_key' => $payments_setting['userid']->value,
			'active' => $payments_setting['userid']->status,
			'payment_currency' => Session::get('currency_code'),
			'payment_method' => $payments_setting['userid']->payment_method,
		);
		/**   END HYPERPAY**/
		/*************************/

		//$result[0] = $braintree;
	//	$result[1] = $stripe;
	
	//	$result[3] = $paypal;
	//	$result[4] = $instamojo;
	//	$result[5] = $hyperpay;
		$result[0] = $cod;
		$result[1] = $telr;

		return $result;
	}

	public function commentsOrder(Request $request){
		session(['order_comments' => $request->comments]);
	}

	public function payIinstamojo(Request $request){
		$commonContent = $this->index->commonContent();

		if(empty($commonContent['setting'][18]->value)){
			$siteName = Lang::get('website.Empty Site Name');
		}else{
			$siteName = $commonContent['setting'][18]->value;
		}

		//payment methods
		$payments_setting = $this->order->payments_setting_for_instamojo();
		$instamojo_api_key =  $payments_setting['api_key']->value;
		$instamojo_auth_token = $payments_setting['auth_token']->value;

		$websiteURL =  "http://" . $_SERVER['SERVER_NAME'].'/';
		$fullname = $request->fullname;
		$email_id = $request->email_id;
		$phone_number = $request->phone_number;
		$amount = $request->amount;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
					array("X-Api-Key:".$instamojo_api_key,
						  "X-Auth-Token:".$instamojo_auth_token));
		$payload = Array(
			'purpose' => $siteName.' Payment',
			'amount' => $amount,
			'phone' => $phone_number,
			'buyer_name' => $fullname,
			'send_email' => true,
			'send_sms' => true,
			'email' => $email_id,
			'allow_repeated_payments' => false
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch);

		session(['instamojo_info'=>$response]);

		print_r($response);

	}

	//hyperpaytoken
	public function hyperpay(Request $request){
		$title = array('pageTitle' => Lang::get('website.Checkout'));
		$result = array();
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$replaceURL = str_replace('/hyperpay','/hyperpay/checkpayment', $actual_link);

		$amount = number_format((float)session('total_price')+0, 2, '.', '');
		$payments_setting = $this->order->payments_setting_for_hyperpay();
		//check envinment
		if($payments_setting['userid']->environment == '0'){
			$env_url = "https://test.oppwa.com/v1/checkouts";
			$order_url = "test";
		}else{
			$env_url = "https://oppwa.com/v1/checkouts";
			$order_url = "live";
		}

		$url = $env_url;
		$data = "authentication.userId=" .$payments_setting['userid']->value.
			"&authentication.password=" .$payments_setting['password']->value.
			"&authentication.entityId=" .$payments_setting['entityid']->value.
			"&amount=" . $amount.
			"&currency=SAR" .
			"&paymentType=DB".
			"&customer.email=".auth()->guard('customer')->user()->email.
			"&testMode=EXTERNAL".
			"&merchantTransactionId=". uniqid();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);

		$data = json_decode($responseData);

		if($data->result->code=='000.200.100'){
			$result['token'] = $data->id;
			$result['webURL'] = $replaceURL;
			$result['order_url'] = $order_url;

			return view("autoshop.hyperpay", $title)->with('result', $result);
		}else{
			return redirect()->back()->with('error',$data->result->description);
		}
	}

	//checkpayment
	public function checkpayment(Request $request){
		$title = array('pageTitle' => Lang::get('website.Checkout'));
		$result = array();

		$payments_setting = $this->order->payments_setting_for_hyperpay();
		//check envinment
		if($payments_setting['userid']->environment=='0'){
			$env_url = "https://test.oppwa.com";
		}else{
			$env_url = "https://oppwa.com";
		}

		$url = $env_url.$request->resourcePath;
		$url .= "?authentication.userId=".$payments_setting['userid']->value;
		$url .= "&authentication.password=".$payments_setting['password']->value;
		$url .= "&authentication.entityId=".$payments_setting['entityid']->value;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);

		$data = json_decode($responseData);

		if(preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $data->result->code)){
			$transaction_id = $data->ndc;
			session(['paymentResponseData'=>$data]);
			session(['paymentResponse'=>'success']);
			return redirect('/checkout');
		}else{
			session(['paymentResponseData'=>$data->result->description]);
			session(['paymentResponse'=>'error']);
			return redirect('/checkout');
		}

	}

	//changeresponsestatus
	public function changeresponsestatus(Request $request){
		session(['paymentResponseData'=>'']);
		session(['paymentResponse'=>'']);
	}

	//updatestatus
	public function updatestatus(Request $request){
		if(!empty($request->orders_id)){
			$date_added			=    date('Y-m-d h:i:s');
			$comments			=	 '';
			$ordersCheck = $this->order->ordersCheck($request);

			if(count($ordersCheck)>0){
				$orders_history_id = $this->order->InsertOrdersCheck($request,$date_added,$comments);
				return redirect()->back()->with('message', Lang::get("labels.OrderStatusChangedMessage"));
			}else{
				return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
			}
		}else{
				return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
		}
	}

}
