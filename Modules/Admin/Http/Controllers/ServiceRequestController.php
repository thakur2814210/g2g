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

use DB;
use App\Models\Core\Setting;
use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang;


class ServiceRequestController extends Controller
{

    public function __construct( Setting $setting){
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
    }

	 public function list(){
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $data['serviceRequests'] = ServiceRequest::with(['client','garage','vehicle'])->orderBy('id', 'DESC')->paginate(10);
        return view('admin::servicerequest.index', $data)->with('result', $result);
    }
   

    public function view($id){
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        if(!empty($id)){
            $serviceRequest = ServiceRequest::where('id' , $id)->first();
            if(!empty($serviceRequest)){
                $data['sr'] = $serviceRequest;
                $data['sr_payment'] = ServiceRequestPayment::where('service_request_id', $id)->first();
                return view('admin::servicerequest.view', $data)->with('result', $result);
            }
        }

        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }
   
}