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
//use Auth;
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




use App\Vehicle;
use App\Section;
use App\Garage;

use App\GarageService;
use App\ClientLocation;

use App\ServicePackage;
use App\ClientPackageSubscribe;
use App\VehicleMake;
use App\VehicleModel;
use App\City;
use App\Country;

use App\ServiceRequest;
use App\ServiceRequestPayment;
use App\ServiceRequestLog;
use App\Client;


class ServiceRequestController extends Controller
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

	
    public function index()
    {   
        
        $title = array('pageTitle' => Lang::get("website.Dashboard"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        $customer = auth()->guard('customer')->user();
        $client = Client::where('user_id',$customer->id)->first();

        $serviceRequests = ServiceRequest::where('client_id', $client->id)
                        ->orderBy('service_request.id','desc')
                        ->with('category' , 'garage','vehicle')
                        ->get();
      //dd($serviceRequests);
        return view('autoshop.service-request.index', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'serviceRequests' => $serviceRequests]);
        
    }

   public function logs($id){
        if(!empty($id)){

            $title = array('pageTitle' => Lang::get("website.Dashboard"));
            $result['commonContent'] = $this->index->commonContent();
            $final_theme = $this->theme->theme();

            $sr = ServiceRequest::where('id' , $id)->with('client')->first();
            if(!empty($sr)){
                $logs = ServiceRequestLog::where('service_request_id' , $id)->get();
                
                 return view('autoshop.service-request.logs', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'sr' => $sr, 'logs' => $logs]);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

     public function settings($id){
        if(!empty($id)){
            $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
            $title = array('pageTitle' => Lang::get("website.Dashboard"));
            $result['commonContent'] = $this->index->commonContent();
            $final_theme = $this->theme->theme();

            $sr = ServiceRequest::where('service_request.id' , $id)
                    ->with('client','category','vehicle','garage')
                    ->select("service_request.*",\DB::raw("GROUP_CONCAT(sections_description.sections_name) as section_name"))
                    ->leftjoin("sections_description",\DB::raw("FIND_IN_SET(sections_description.sections_id,service_request.section_ids)"),">",\DB::raw("'0'"))
                    ->where('sections_description.language_id', $language_id)
                    ->first();
           // dd($sr);
            if(!empty($sr)){
               
                $sr_payment = ServiceRequestPayment::where('service_request_id', $id)->first();
                

                return view('autoshop.service-request.setting', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'sr' => $sr, 'sr_payment' => $sr_payment]);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }


	

}
