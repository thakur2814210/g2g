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
use App\WithdrawMethod as WM;
use App\Withdraw as Withdraw;
use App\VendorDetails as VendorDetails;

class WithdrawController extends Controller
{
	private $domain;
    public function __construct(Admin $admin, Setting $setting, Order $order, Customers $customers)
    {
        $this->Setting = $setting;
        $this->Admin = $admin;
        $this->Order = $order;
		$this->Customers = $customers;
    }


    // list all the withdraw methods...
    public function withdrawMethod() {

    	$title = array('pageTitle' => Lang::get('labels.withdrawMethod'));
		$language_id  =   '1';
		$result = array();
		$vendors_id = (Auth()->user()->role_id == 3) ? Auth()->user()->id : null;
      	
      	$wms = WM::query()->paginate(10);
      	
      	$result['admins'] = $wms;
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.withdraw.withdrawMethod",$title)->with('result', $result);
      	
    }

    public function addWithdrawMethod() {

    	$title = array('pageTitle' => Lang::get('labels.Add Withdraw Method'));
		$language_id  =   '1';
		$result = array();
		
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.withdraw.addWithdrawMethod",$title)->with('result', $result);
      	
    }

    public function editWithdrawMethod($id) {
      	
      	$title = array('pageTitle' => Lang::get('labels.Update Withdraw Method'));
		$language_id  =   '1';
		$result = array();
		 $wm = WM::find($id);
		$result['admins'] = $wm;
		//dd($result['admins']);die;
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.withdraw.editWithdrawMethod",$title)->with('result', $result);
    }

    public function storeWithdrawMethod(Request $request) {
      	//return $request->all();

		$rules = [
			'methodName' => 'required',
			'minimum' => 'required|numeric',
			'maximum' => 'required|numeric',
			'charged' => 'required|numeric',
			'chargep' => 'required|numeric',
			'processTime' => 'required'
		];

		$messages = [
			'methodName.required' => 'Method Name field is required',
			'minimum.required' => 'Set an minimum transaction limit',
			'minimum.numeric' => 'Minimum transaction must be a number',
			'maximum.required' => 'Set an maximum transaction limit',
			'maximum.numeric' => 'maximum transaction must be a number',
			'charged.required' => 'Set a fixed charge for per transaction',
			'charged.numeric' => 'Fixed charge per transaction is a number',
			'chargep.required' => 'Set a charge percentage for per transaction',
			'chargep.numeric' => 'Charge percentage per transaction is a number',
		];


		$validatedRequest = $request->validate($rules, $messages);

		$wm = new WM;
		$wm->name = $request->methodName;
		$wm->min_limit = $request->minimum;
		$wm->max_limit = $request->maximum;
		$wm->fixed_charge = $request->charged;
		$wm->percentage_charge = $request->chargep;
		$wm->process_time = $request->processTime;
		$wm->save();

	
		$message = Lang::get("labels.AddWithdrawMethod");
		return redirect()->back()->with('message', $message);
    }

    

    public function updateWithdrawMethod(Request $request) {
      // return $request->all();
		$rules = [
			'methodName' => 'required',
			'minimum' => 'required|numeric',
			'maximum' => 'required|numeric',
			'charged' => 'required|numeric',
			'chargep' => 'required|numeric',
			'processTime' => 'required'
		];

		$messages = [
			'methodName.required' => 'Method Name field is required',
			'minimum.required' => 'Set an minimum transaction limit',
			'minimum.numeric' => 'Minimum transaction must be a number',
			'maximum.required' => 'Set an maximum transaction limit',
			'maximum.numeric' => 'maximum transaction must be a number',
			'charged.required' => 'Set a fixed charge for per transaction',
			'charged.numeric' => 'Fixed charge per transaction is a number',
			'chargep.required' => 'Set a charge percentage for per transaction',
			'chargep.numeric' => 'Charge percentage per transaction is a number',
		];

		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
		$validator->errors()->add('error', 'true');
		return response()->json($validator->errors());
		}

		$wm = WM::find($request->wmID);
		$wm->name = $request->methodName;
		$wm->min_limit = $request->minimum;
		$wm->max_limit = $request->maximum;
		$wm->fixed_charge = $request->charged;
		$wm->percentage_charge = $request->chargep;
		$wm->process_time = $request->processTime;
		$wm->save();

		$message = Lang::get("labels.UpdateWithdrawMethod");
		return redirect()->back()->with('message', $message);
    }



    public function destroyWithdrawMethod(Request $request) {
		$wm = WM::find($request->disable_withdraw_method_id);
		$wm->deleted = 1;
		$wm->save();
		return redirect()->back()->withErrors([Lang::get("labels.DisableWithdrawMethodMessage")]);
    }

    public function enableWithdrawMethod(Request $request) {
        $wm = WM::find($request->enable_withdraw_method_id);
        $wm->deleted = 0;
        $wm->save();
        return redirect()->back()->withErrors([Lang::get("labels.EnableWithdrawMethodMessage")]);
    }

	
	// list all the withdraw records...

	public function withdrawLog() {
     	$title = array('pageTitle' => Lang::get('labels.WithdrawLog'));
		$language_id  =   '1';
		$result = array();

		if(Auth()->user()->role_id == 1){

			$vendors_id = (Auth()->user()->role_id == 3) ? Auth()->user()->id : null;
	        $admins = DB::table('withdraws')
				->leftJoin('users','users.id','=','withdraws.vendor_id')
				->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
				->leftJoin('withdraw_methods','withdraw_methods.id','=','withdraws.withdraw_method_id')
				->select('withdraws.*','vendor_details.shop_name','withdraw_methods.name')
				->paginate(50);

		}else{

			$vendors_id = (Auth()->user()->role_id == 3) ? Auth()->user()->id : null;
	        $admins = DB::table('withdraws')
				->leftJoin('users','users.id','=','withdraws.vendor_id')
				->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
				->leftJoin('withdraw_methods','withdraw_methods.id','=','withdraws.withdraw_method_id')
				->select('withdraws.*','vendor_details.shop_name','withdraw_methods.name')
				->where('users.role_id','=','3')
				->when($vendors_id, function($query) use ($vendors_id ){
					if(!is_null($vendors_id))
			        	return $query->where('users.id', $vendors_id);
			    })
				->paginate(50);

		}
		
		
		
		$result['admins'] = $admins;
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.withdraw.PendingRequests",$title)->with('result', $result);
    }

    // list all the withdraw records...with status success
	public function successLog(){
		
      	$title = array('pageTitle' => Lang::get('labels.SuccessWithdrawLog'));
		$language_id  =   '1';
		$result = array();
		$vendors_id = (Auth()->user()->role_id == 3) ? Auth()->user()->id : null;
        
		$admins = DB::table('withdraws')
			->leftJoin('users','users.id','=','withdraws.vendor_id')
			->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
			->leftJoin('withdraw_methods','withdraw_methods.id','=','withdraws.withdraw_method_id')
			->select('withdraws.*','vendor_details.shop_name','withdraw_methods.name')
			->where('users.role_id','=','3')
			->where('withdraws.status','=','processed')
			->when($vendors_id, function($query) use ($vendors_id ){
				if(!is_null($vendors_id))
		        	return $query->where('users.id', $vendors_id);
		    })
			->paginate(50);
		
		$result['admins'] = $admins;
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.withdraw.successLog",$title)->with('result', $result);
	}

	 // list all the withdraw records...with status refund...
	public function refundedLog(){
		
      	$title = array('pageTitle' => Lang::get('labels.ReturnWithdrawLog'));
		$language_id  =   '1';
		$result = array();
		$vendors_id = (Auth()->user()->role_id == 3) ? Auth()->user()->id : null;
        
		$admins = DB::table('withdraws')
			->leftJoin('users','users.id','=','withdraws.vendor_id')
			->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
			->leftJoin('withdraw_methods','withdraw_methods.id','=','withdraws.withdraw_method_id')
			->select('withdraws.*','vendor_details.shop_name','withdraw_methods.name')
			->where('users.role_id','=','3')
			->where('withdraws.status','=','refunded')
			->when($vendors_id, function($query) use ($vendors_id ){
				if(!is_null($vendors_id))
		        	return $query->where('users.id', $vendors_id);
		    })
			->paginate(50);
		
		$result['admins'] = $admins;
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.withdraw.refundedLog",$title)->with('result', $result);
	}

	 // list all the withdraw records...with status pending
	public function pendingLog(){

		$title = array('pageTitle' => Lang::get('labels.PendingWithdrawLog'));
		$language_id  =   '1';
		$result = array();
		$vendors_id = (Auth()->user()->role_id == 3) ? Auth()->user()->id : null;
        
		$admins = DB::table('withdraws')
			->leftJoin('users','users.id','=','withdraws.vendor_id')
			->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
			->leftJoin('withdraw_methods','withdraw_methods.id','=','withdraws.withdraw_method_id')
			->select('withdraws.*','vendor_details.shop_name','withdraw_methods.name')
			->where('users.role_id','=','3')
			->where('withdraws.status','=','pending')
			->when($vendors_id, function($query) use ($vendors_id ){
				if(!is_null($vendors_id))
		        	return $query->where('users.id', $vendors_id);
		    })
			->paginate(50);
		//dd($admins);die;
		$result['admins'] = $admins;
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.withdraw.PendingRequests",$title)->with('result', $result);
	}

	







    public function withdrawLogShow($wID) {
		$title = array('pageTitle' => Lang::get('labels.Withdraw Details'));
		$language_id  =   '1';
		$result = array();
		$vendors_id = (Auth()->user()->role_id == 3) ? Auth()->user()->id : null;
		//$withdraw = Withdraw::find($wID);
		$admins = DB::table('withdraws')
			->leftJoin('users','users.id','=','withdraws.vendor_id')
			->leftJoin('vendor_details','vendor_details.user_id','=','users.id')
			->leftJoin('withdraw_methods','withdraw_methods.id','=','withdraws.withdraw_method_id')
			->select('withdraws.*','vendor_details.shop_name','withdraw_methods.name' , 'users.email as user_email')
			->where('users.role_id','=','3')
			->where('withdraws.id','=', $wID)
			->first();
			//echo $admins->vendor_id;
		//echo Auth()->user()->id;die;
		if(!is_null($vendors_id) && Auth()->user()->id != $admins->vendor_id){
			$message = Lang::get("labels.Not Allowed");
			return redirect()->back()->with('message', $message);
		}

		if(is_null($admins)){
			$message = Lang::get("labels.Not Found");
			return redirect()->back()->with('message', $message);
		}

		$result['admins'] = $admins;
		$result['wID'] = $wID;
		//dd($result);die;
		$result['commonContent'] = $this->Setting->commonContent();
		
		return view("admin.withdraw.withdrawLog.show",$title)->with('result', $result);
    }

    public function storeMessage(Request $request) {
     
    	//dd($request->all());die;
      $rules = [
        'message' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }
      //echo $request->wID;die;
      $withdraw = Withdraw::find($request->wID);
      $vendor = VendorDetails::where('user_id',$withdraw->vendor_id)->first();
      if(!empty($withdraw) && !empty($vendor)){
      		
      		$withdraw->status = $request->status;
	      	$withdraw->message = $request->message;
	      	$withdraw->save();
	     
	      	if ($request->status == "refunded") {
		        $vendor->balance = $vendor->balance + ($withdraw->amount+$withdraw->charge);
				$vendor->save();
		    }

		    // if email notification is on then send mail...
     		$message = Lang::get("labels.Withdraw request updated successfully");
      }else{
      	$message = 'Something went wrong, please contact support team';
      }
      
		return redirect()->back()->with('message', $message);
    }



	
	



	public function withdrawMoney() {
		
		$title 			  = 	array('pageTitle' => Lang::get("labels.WithdrawMoney"));
		$language_id      = 	'1';

		$wms = WM::where('deleted', 0)->paginate(10);
		$result['admins'] = $wms;
		$result['commonContent'] = $this->Setting->commonContent();
		return view('admin.withdraw.vendor.withdrawMoney',$title)->with('result', $result);
    }

    public function withdrawRequestStore(Request $request) {
      $wm = WM::find($request->withdraw_method_id);
      // calculating the total charge for this withdraw method and this requested amount...

       // get the balance of vendors
      $vendor = VendorDetails::where('user_id', '=', Auth()->user()->id)->firstOrFail();
      //dd($vendor->balance);die;

      $rules = [
        'amount' => [
          'required',
          'numeric',
          function($attribute, $value, $fail) use ($wm, $request, $vendor) {
            if (is_numeric($request->amount)) {
              $charge = $wm->fixed_charge + (($wm->percentage_charge*$request->amount)/100);
              // if the amount is greater than maximum limit...
              if ($value > $wm->max_limit) {
                return $fail('Maximum amount limit is '.$wm->max_limit);
              }
              // if user balance is less than (requested amount + charge)...
              if ($vendor->balance < ($value + $charge)) {
                return $fail('You dont have enough balance in your account to make this withdraw request!');
              }
              // if the amount is less than minimum limit...
              if ($value < $wm->min_limit) {
                return $fail('Minimum amount limit is '.$wm->min_limit);
              }
            }
          }
        ],
        'details' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }



      $charge = $wm->fixed_charge + (($wm->percentage_charge*$request->amount)/100);
      // if all validation passes then save the withdraw request in the database...
      $withdraw = new Withdraw;
      $withdraw->trx = str_random(12);
      $withdraw->vendor_id = Auth()->user()->id;
      $withdraw->amount = $request->amount;
      $withdraw->withdraw_method_id = $wm->id;
      $withdraw->charge = $charge;
      $withdraw->status = 'pending';
      $withdraw->details = $request->details;
      $withdraw->save();

      // cut user balance..
      $vendor->balance = $vendor->balance - ($withdraw->charge + $withdraw->amount);
      $vendor->save();

      $message = Lang::get("labels.'Withdraw request sent successfully'");
	  return redirect()->back()->with('message', $message);
    }

   

}
