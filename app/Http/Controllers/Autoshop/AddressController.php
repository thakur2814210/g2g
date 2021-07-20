<?php
namespace App\Http\Controllers\Autoshop;

use Validator;
use DB;
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//for Carbon a value
use Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;
use Lang;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Languages;
use App\Models\Autoshop\Products;
use App\Models\Autoshop\Currency;
use App\ClientLocation;
use App\Country;
use App\City;
use App\Client;

//email
use Illuminate\Support\Facades\Mail;

class AddressController extends Controller
{
	public function __construct(
		Index $index,
		Languages $languages,
		Products $products,
		Currency $currency,
		ClientLocation $clientLocation

	)
	{
		$this->index = $index;
		$this->languages = $languages;
		$this->products = $products;
		$this->currencies = $currency;
		$this->clientLocation = $clientLocation;
		$this->theme = new ThemeController();
	}



	//get all zones
	public function index(){

		$title = array('pageTitle' => Lang::get("website.My Address"));
		$final_theme = $this->theme->theme();
		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$client = Client::where('user_id', Auth::guard('customer')->user()->id)->firstOrFail();
		$result['clientLocation'] = ClientLocation::where('client_id', $client->id)->get();

		return view("autoshop.address.index", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);

	}

	public function add(){

    	$title = array('pageTitle' => Lang::get("website.My Address"));
		$final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;

        $allCitiesList = City::active()->get();
        foreach ($allCitiesList as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $result['cities'][$value['id']] = $value;
        }

        $allCitiesList = Country::active()->get();
        foreach ($allCitiesList as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                $value['name'] =  $value['name'];
            }
           $result['countries'][$value['id']] = $value;
        }


    	return view("autoshop.address.add", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
    }

   public function save(Request $request){
       
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'pobox' => 'required', 
            'status' => 'required', 
        ]);


        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }
       
        $client = Client::where('user_id', Auth::guard('customer')->user()->id)->firstOrFail();
        if(!empty($client)){
            $clientLocation = new ClientLocation();
            $clientLocation->client_id = $client->id;
            $clientLocation->address = $request->address;
            $clientLocation->latitude = $request->latitude;
            $clientLocation->longitude = $request->longitude;
            $clientLocation->city_id = $request->city_id;
            $clientLocation->country_id = $request->country_id;
            $clientLocation->pobox = $request->pobox;
            $clientLocation->status = $request->status;
            if($clientLocation->save()){
                return \Redirect::back()->with('status', 'Update new location successfully!!!');
            }

        }
        return \Redirect::back()->with('status', 'Something went wrong!!!');
    }

    public function edit($id){

    	$data = [];
    	$title = array('pageTitle' => Lang::get("website.My Address"));
		$final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $client = Client::where('user_id', Auth::guard('customer')->user()->id)->firstOrFail();
        if(!empty($id) && !empty($client)){

        	$language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;

	        $allCitiesList = City::active()->get();
	        foreach ($allCitiesList as $value){
	            if($language_id == 2){
	                $value['name'] =  $value['name_ar'];
	            }else{
	                 $value['name'] =  $value['name'];
	            }
	           $result['cities'][$value['id']] = $value;
	        }

	        $allCitiesList = Country::active()->get();
	        foreach ($allCitiesList as $value){
	            if($language_id == 2){
	                $value['name'] =  $value['name_ar'];
	            }else{
	                $value['name'] =  $value['name'];
	            }
	           $result['countries'][$value['id']] = $value;
	        }
	       
    		$result['clientLocation'] = ClientLocation::where('client_id', $client->id)->where('id',$id)->firstOrFail();

    		//dd($result['clientLocation']);

    		return view("autoshop.address.edit", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
	    	
    	}
    	return \Redirect::back()->with('status', 'Something went wrong !!!');


    	$data['categories'] = Section::where('parent', 0)->where('status', 1)->where('type', 2)->get();
    	return view('admin::servicepackage.package-add', $data)->with('result', $result);
    }


    public function update(Request $request){


    	$validator = Validator::make($request->all(), [
    		'id' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'pobox' => 'required', 
            'status' => 'required', 
        ]);


        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

       

        $client = Client::where('user_id', Auth::guard('customer')->user()->id)->firstOrFail();
        $clientLocation = ClientLocation::where('client_id', $client->id)->where('id',$request->id)->firstOrFail();

        if(!empty($client)){

        	ClientLocation::where('id', $request->id)->where('client_id', $client->id)->update([
        		'client_id' => $client->id,
        		'address' => $request->address,
        		'latitude' => $request->latitude,
        		'longitude' => $request->longitude,
        		'city_id' => $request->city_id,
        		'country_id' => $request->country_id,
        		'pobox' => $request->pobox,
        		'status' => $request->status,
	        ]);
            return \Redirect::back()->with('status', 'Update location successfully!!!');
          
        }
        return \Redirect::back()->with('status', 'Something went wrong!!!');
    }

}
