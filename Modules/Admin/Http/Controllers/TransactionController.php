<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ServiceRequestLog;

use App\GaragePackageSubscribe;
use App\GaragePackageSubscribeLog;
use App\GaragePackageSubscribePayment;

use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;
use App\Commission;

use DB;
use App\Models\Core\Setting;
use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang;

class TransactionController extends Controller{

    public function __construct( Setting $setting){
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
    }

    public function customers_package_subscription(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['clientPackageSubscribes'] = ClientPackageSubscribe::join('client_package_subscribe_payments' , 'client_package_subscribe_payments.client_package_subscribe_id' , 'client_package_subscribe.id')
                                ->select('client_package_subscribe_payments.*', 'client_package_subscribe.id as cps_id')
                                ->with('client')
                                ->paginate(10);
        $data['commission'] = Commission::first();
        return view('admin::transaction.customers_package_subscription' , $data)->with('result', $result);
    }

    public function customers_service_request(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['serviceRequests'] = ServiceRequest::join('service_request_payment' , 'service_request_payment.service_request_id' , 'service_request.id')
                                ->select('service_request_payment.*', 'service_request.id as cps_id')
                                ->with('client')
                                 ->paginate(10);
        $data['commission'] = Commission::first();
        return view('admin::transaction.customers_service_request' , $data)->with('result', $result);
    }

    public function garages_package_subscription(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

         $data['garagePackageSubscribes'] = GaragePackageSubscribe::join('garage_package_subscribe_payments' , 'garage_package_subscribe_payments.garage_package_subscribe_id' , 'garage_package_subscribe.id')
                                ->select('garage_package_subscribe_payments.*', 'garage_package_subscribe_payments.id as gps_id')
                                ->with('garage')
                                ->paginate(10);
        $data['commission'] = Commission::first();
        return view('admin::transaction.garages_package_subscription' , $data)->with('result', $result);
    }
}