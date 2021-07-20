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
use App\Garage;
use App\User;
use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ClientPackageSubscribe;
use App\ClientPackageSubscribePayment;

class PaymentController extends Controller
{
       public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

    public function index(){

        $pageTitle =      Lang::get("labels.title_dashboard");
        $language_id =     '1';
        $result =     array();
        $result['commonContent'] = $this->Setting->commonContent();

        $garage_users = auth()->guard('vendor')->user();
        $garage = Garage::where('user_id',$garage_users->id)->firstOrFail();

        $customersIDs = User::where('role_id', 2)->pluck('id')->toArray();


    	$cps_total_amount = 0; //->sum('client_package_subscribe_payments.amount');
    	$cps_payments = ClientPackageSubscribe::where('garage_id', $garage->id)
    							->join('client_package_subscribe_payments' , 'client_package_subscribe_payments.client_package_subscribe_id' , 'client_package_subscribe.id')
    							->select('client_package_subscribe_payments.*', 'client_package_subscribe.id as cps_id','client_package_subscribe.client_id')
    							->with('client')
    							->get();


        foreach ($cps_payments as $key => $value) {
            if(isset($value->client->user_id) && !in_array($value->client->user_id, $customersIDs))
                unset($cps_payments[$key]);

             $cps_total_amount += $value->amount;
        }

    	
    	$sr_total_amount = 0; // ->sum('service_request_payment.amount
    	$csr_payments = ServiceRequest::where('garage_id', $garage->id)
    							->join('service_request_payment' , 'service_request_payment.service_request_id' , 'service_request.id')
    							->select('service_request_payment.*', 'service_request.id as cps_id' , 'service_request.client_id')
    							->with('client')
    							->get();

        

        foreach ($csr_payments as $key => $value) {
            if(isset($value->client->user_id) && !in_array($value->client->user_id, $customersIDs))
                unset($csr_payments[$key]);

            $sr_total_amount += $value->amount;
        }
    	

        return view("garage::payment.index",['pageTitle' => $pageTitle , 'cps_total_amount' => $cps_total_amount,'cps_payments' => $cps_payments, 'sr_total_amount' => $sr_total_amount,'csr_payments' => $csr_payments ])->with('result', $result);

        
    }

}
