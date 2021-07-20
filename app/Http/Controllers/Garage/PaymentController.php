<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;
use Auth;
use App\User;

use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ServiceRequestLog;


use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;

class PaymentController extends Controller
{
    public function index()
    {
    	$sr_payment = ServiceRequestPayment::join('service_request','service_request_payment.service_request_id','service_request.id')
                            ->where('service_request.client_id', Auth::user()->id)
                            ->get();

        $ps_payment =  ClientPackageSubscribePayment::join('service_request','client_package_subscribe_payments.client_package_subscribe_id','service_request.id')
                               ->where('service_request.client_id', Auth::user()->id)->get();

        $data['payments'] = array_merge($sr_payment->toArray(), $ps_payment->toArray() );
        
    	return view('client::payment.index' , $data);
    }

}
