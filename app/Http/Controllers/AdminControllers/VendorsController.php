<?php
namespace App\Http\Controllers\AdminControllers;
use App\Models\Core\Languages;
use App\Models\Core\Setting;
use App\Models\Admin\Admin;
use App\Models\Core\Order;
use App\Models\Core\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

use Exception;
use App\Models\Core\Images;
use Validator;
use Hash;
use Auth;
use ZipArchive;
use File;
use Mail;

class VendorsController extends Controller
{
	private $domain;
    public function __construct(Admin $admin, Setting $setting, Order $order, Customers $customers)
    {
        $this->Setting = $setting;
        $this->Admin = $admin;
        $this->Order = $order;
		$this->Customers = $customers;
    }

    public function doSignUp(){
    	if (Auth::check()) {
		  return redirect('/admin/dashboard/this_month');
		}else{
			$title = array('pageTitle' => Lang::get("labels.login_page_name"));
			return view("admin.vendor_sign_up",$title);
		}
    }

    public function forgetPassword(){
    	if (Auth::check()) {
		  return redirect('/admin/dashboard/this_month');
		}else{
			$title = array('pageTitle' => Lang::get("labels.login_page_name"));
			return view("admin.vendor_forget_password",$title);
		}
    }

    function createRandomPassword() {
		$pass = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
		return $pass;
	}


    public function processPassword(Request $request){
    	$title = array('pageTitle' => Lang::get("website.Forgot Password"));

		$password = $this->createRandomPassword();
		$email    =   $request->email;
		$postData = array();

		//check email exist
		$existUser = DB::table('users')
			->where('users.role_id','=',3)
			->where('users.email','=', $email)
			->get();

		if(count($existUser)>0){
      		
      		DB::table('users')->where('email', $email)->update([
		        'password'	=>	Hash::make($password)
		    ]);
			$existUser[0]->password = $password;

			Mail::send('/mail/recoverPassword', ['existUser' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("labels.fogotPasswordEmailTitle"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});

			return redirect('admin/login')->with('loginError', Lang::get("website.Password has been sent to your email address"));
		}else{
			return redirect('vendor/forget-password')->with('loginError', Lang::get("website.Email address does not exist"));
		}
    }

    public function signupProcess(Request $request){
    	
    }

    public function login(){

		if (Auth::check()) {
		  return redirect('/admin/dashboard/this_month');
		}else{
			$title = array('pageTitle' => Lang::get("labels.login_page_name"));
			return view("admin.vendor_login",$title);
		}
	}

	public function checkLogin(Request $request){
		$validator = Validator::make(
			array(
					'email'    => $request->email,
					'password' => $request->password
				),
			array(
					'email'    => 'required | email',
					'password' => 'required',
				)
		);
		//check validation
		if($validator->fails()){
			return redirect('vendor/login')->withErrors($validator)->withInput();
		}else{
			//check authentication of email and password
			$adminInfo = array("email" => $request->email, "password" => $request->password);

			if(auth()->attempt($adminInfo)) {
				$admin = auth()->user();

				$administrators = DB::table('users')->where('id', $admin->myid)->get();



				$categories_id = '';
				//admin category role
				if(auth()->user()->adminType != '1'){
					$categories_role = DB::table('categories_role')->where('admin_id', auth()->user()->myid)->get();
					if(!empty($categories_role) and count($categories_role)>0){
						$categories_id = $categories_role[0]->categories_ids;
					}else{
						$categories_id = '';
					}
				}

				session(['categories_id' => $categories_id]);
				return redirect()->intended('admin/dashboard/this_month')->with('administrators', $administrators);
			}else{
				return redirect('vendor/login')->with('loginError',Lang::get("labels.EmailPasswordIncorrectText"));
			}

		}

	}

	//logout
	public function logout(){
		\Auth::guard(\Auth::getDefaultDriver())->logout();
        return redirect('/');
	}

    
	

  //admins
	public function vendors($type, Request $request){


		if($type == 'active'){
			$lbl_trans = 'labels.Active Vendors';
			$vendor_status = 1;

		}elseif($type == 'pending'){
			$lbl_trans = 'labels.Pending Vendors';
			$vendor_status = 2;

		}elseif($type == 'inactive'){
			$lbl_trans = 'labels.Inactive Vendors';
			$vendor_status = 3;
		}

		$title = array('pageTitle' => Lang::get($lbl_trans));
		$language_id  =   '1';

		$result = array();
		$message = array();
		$errorMessage = array();

		$admins = DB::table('users')
			->leftJoin('user_types','user_types.user_types_id','=','users.role_id')
			->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
			->select('users.*','user_types.*','vendor_details.shop_name')
			->where('users.role_id','=','3')
			->when($type, function($query) use ($type , $vendor_status){
		        return $query->where('users.status', $vendor_status);
		    })
			->paginate(50);


		$result['message'] = $message;
		$result['errorMessage'] = $errorMessage;
		$result['admins'] = $admins;
		$result['commonContent'] = $this->Setting->commonContent();
		//dd($result);die;
		return view("admin.vendors.index",$title)->with('result', $result);

	}


	//add admins
	public function addvendors(Request $request){

		$title = array('pageTitle' => Lang::get("labels.Add Vendors"));

		$result = array();
		$message = array();
		$errorMessage = array();

		//get function from ManufacturerController controller
		$myVar = new AddressController();
		$result['countries'] = $myVar->getAllCountries();
		$result['commonContent'] = $this->Setting->commonContent();

		return view("admin.vendors.add",$title)->with('result', $result);

	}

	

  	//addnewadmin
	public function addnewvendor(Request $request){

		//get function from other controller
		$myVar = new SiteSettingController();
		$extensions = $myVar->imageType();

		$result = array();
		$message = array();
		$errorMessage = array();

		//check email already exists
		$existEmail = DB::table('users')->where('email', '=', $request->email)->get();
		if(count($existEmail)>0){
			$errorMessage = Lang::get("labels.Email address already exist");
			return redirect()->back()->with('errorMessage', $errorMessage);
		}else{

			$uploadImage = '';

			$customers_id = DB::table('users')->insertGetId([
						'user_name'		 		    =>   $request->first_name.'_'.$request->last_name.time(),
						'first_name'		 		=>   $request->first_name,
						'last_name'			 		=>   $request->last_name,
						'phone'	 					=>	 $request->phone,
						'email'	 					=>   $request->email,
						'password'		 			=>   Hash::make($request->password),
						'status'		 	 		=>   $request->isActive,
						'avatar'	 				=>	 $uploadImage,
						'role_id'					=>	 3
						]);
			
			$vendor_details_id = DB::table('vendor_details')->insertGetId([
						'vendors_id'		 		=>   $customers_id,
						'shop_name'		 			=>   $request->shop_name,
						]);


			$message = Lang::get("labels.New vendor has been added successfully");
			return redirect()->back()->with('message', $message);

		}
	}
  //editadmin
	public function editvendor(Request $request){

		$title = array('pageTitle' => Lang::get("labels.EditVendor"));
		$myid        	 =   $request->id;

		$result = array();
		$message = array();
		$errorMessage = array();

		//get function from other controller
		$myVar = new AddressController();
		$result['countries'] = $myVar->getAllCountries();

		$result['myid'] = $myid;

		$admins = DB::table('users')
			->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
			->select('users.*','vendor_details.shop_name')
			->where('users.id','=', $myid)->get();
		$zones = 0;

		if($zones>0){
			$result['zones'] = $zones;
		}else{
			$zones = new \stdClass;
			$zones->zone_id = "others";
			$zones->zone_name = "Others";
			$result['zones'][0] = $zones;
		}


		$result['admins'] = $admins;
		$result['commonContent'] = $this->Setting->commonContent();

		return view("admin.vendors.edit",$title)->with('result', $result);
	}

  //update admin
	public function updatevendor(Request $request){

		//get function from other controller
		$myVar = new SiteSettingController();
		$extensions = $myVar->imageType();
		$myid = $request->myid;
		$result = array();
		$message = array();
		$errorMessage = array();

		//check email already exists
		$existEmail = DB::table('users')->where([['email','=',$request->email],['id','!=',$myid]])->get();
		if(count($existEmail)>0){
			$errorMessage = Lang::get("labels.Email address already exist");
			return redirect()->back()->with('errorMessage', $errorMessage);
		}else{

			$uploadImage = '';

			$admin_data = array(
				'first_name'		 		=>   $request->first_name,
				'last_name'			 		=>   $request->last_name,
				'phone'	 					=>	 $request->phone,
				'email'	 					=>   $request->email,
				'status'		 	 		=>   $request->isActive,
				'avatar'	 				=>	 $uploadImage,
				'role_id'	 				=>	 3,
			);

			if($request->changePassword == 'yes'){
				$admin_data['password'] = Hash::make($request->password);
			}

			$customers_id = DB::table('users')->where('id', '=', $myid)->update($admin_data);
			$customers_id = DB::table('vendor_details')->where('vendors_id', '=', $myid)->update(['shop_name' => $request->shop_name]);


			$message = Lang::get("labels.Vendor has been updated successfully");
			return redirect()->back()->with('message', $message);
		}

	}

	public function deletevendor(Request $request){

		$myid = $request->users_id;
		DB::table('users')->where('id', '=', $myid)->update(['status' => 3]);
		//DB::table('users')->where('id','=', $myid)->delete();
		//DB::table('vendor_details')->where('vendors_id','=', $myid)->delete();

		return redirect()->back()->withErrors([Lang::get("labels.DeleteVendorMessage")]);

	}
}
