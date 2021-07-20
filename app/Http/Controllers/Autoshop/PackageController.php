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
use App\VehicleMake;
use App\VehicleModel;
use App\Client;
use App\ClientPackageSubscribe;
use App\ClientPackageSubscribeLog;
use App\ClientPackageSubscribePayment;

class PackageController extends Controller
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

	public function getPackageSubscribeStatusName($key){
        $arr =  [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending', 
            '4' => 'Inactive',
            '5' => 'Request-Payemnt', 
            '6' => 'Received-Payment',
            '7' => 'Required-Payment-Approval' 
        ];

        return $arr[$key];
    }

    public function getPackageSubscribeStatusArr(){
       return  [
            '1' => 'Active',
            '2' => 'Cancel',
            '3' => 'Pending', 
            '4' => 'Inactive',
            '5' => 'Request-Payemnt', 
            '6' => 'Received-Payment',
            '7' => 'Required-Payment-Approval' 
        ];
    }

     public function getPackagePaymentStatusName($key){
        $arr =  [
            '1' => 'Success',
            '2' => 'Failed',
            '3' => 'Pending', 
            '4' => 'Required-Payment-Approval' 
        ];

        return $arr[$key];
    }

    public function getPackagePaymentStatusArr(){
       return  [
            '1' => 'Success',
            '2' => 'Failed',
            '3' => 'Pending', 
            '4' => 'Required-Payment-Approval' 
        ];
    }


    public function index(){

        $title = array('pageTitle' => Lang::get("website.Dashboard"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;

        $customer = auth()->guard('customer')->user();
        $client = Client::where('user_id',$customer->id)->firstOrFail();

        $packages = ClientPackageSubscribe::join('service_package', 'service_package.id', 'client_package_subscribe.service_package_id')
                    ->join('garages_description', 'garages_description.garages_id', 'client_package_subscribe.garage_id')
                    ->join('vehicles', 'vehicles.id', 'client_package_subscribe.vehicle_id')
                    ->select('client_package_subscribe.*','garages_description.garages_name as garage','vehicles.registration_no',
                    'service_package.slug as service_package_slug','service_package.name as service_package_name',  'service_package.name_ar as service_package_name_ar')
                    ->where('client_package_subscribe.client_id', $client->id)
                    ->where('garages_description.language_id', $language_id)
                    ->orderBy('client_package_subscribe.updated_at', 'desc')
                    ->with('vehicle')
                    ->get();
        $packageStatus = $this->getPackageSubscribeStatusArr();
       

        return view('autoshop.package.index', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'packages' => $packages, 'packageStatus' => $packageStatus]);
    }

    public function logs($id){

        $title = array('pageTitle' => Lang::get("website.Dashboard"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();


        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->with('client')->first();
            if(!empty($clientPackageSubscribe)){
                $logs = ClientPackageSubscribeLog::where('client_package_subscribe_id' , $clientPackageSubscribe->id)->get();
                return view('autoshop.package.logs', ['result' =>$result,'title' => $title,'final_theme' => $final_theme, 'clientPackageSubscribe' => $clientPackageSubscribe]);
               
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function settings($id){

        $title = array('pageTitle' => Lang::get("website.Dashboard"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();


        if(!empty($id)){
            $clientPackageSubscribe = ClientPackageSubscribe::where('id' , $id)->with('servicePackage','garage','vehicle')->first();

            //dd($clientPackageSubscribe->garage->defaultGarageDescription[0]->garages_name);

            if(!empty($clientPackageSubscribe)){
               
                $packageStatus = $this->getPackageSubscribeStatusName($clientPackageSubscribe->status);
                $clientPackageSubscribePayment = ClientPackageSubscribePayment::where('client_package_subscribe_id', $id)->first();
                $paymentStatus = $this->getPackagePaymentStatusName($clientPackageSubscribePayment->status);
               

                 return view('autoshop.package.setting', ['result' =>$result,'title' => $title,'final_theme' => $final_theme, 'clientPackageSubscribe' => $clientPackageSubscribe,'packageStatus' => $packageStatus, 'clientPackageSubscribePayment' => $clientPackageSubscribePayment, 'paymentStatus' => $paymentStatus]);
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');
    }

    public function customPackageSettings($id){ 
        return \Redirect::back()->with('status', 'Something went wrong! Data does does not exist.');

    }

	

}
