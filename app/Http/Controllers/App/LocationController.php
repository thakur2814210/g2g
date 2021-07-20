<?php
namespace App\Http\Controllers\App;

use Validator;
use DB;
use DateTime;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\AppModels\Location;

class LocationController extends Controller
{

	public function getcountries(Request $request){
		$response = Location::countries($request);
		print $response;
	}

	public function getzones(Request $request){
		$response = Location::zones($request);
		print $response;
	}

	public function addshippingaddress(Request $request){
    	$shippingResponse = Location::addshippingaddress($request);
		print $shippingResponse;
	}

	public function updateshippingaddress(Request $request){
    	$shippingResponse = Location::updateshippingaddress($request);
		print $shippingResponse;

	}

	public function deleteshippingaddress(Request $request){
    	$shippingResponse = Location::deleteshippingaddress($request);
		print $shippingResponse;

	}

	public function getalladdress(Request $request){
    	$shippingResponse = Location::getalladdress($request);
		print $shippingResponse;

	}

	public function updatedefaultaddress(Request $request){
    	$responseData = Location::updatedefaultaddress($request);
		print $responseData;
	}

	public function getTaxRate(Request $request){
    	$responseData = Location::getTaxRate($request);
		print $responseData;
	}
	
	public function getClientLocation(Request $request){
    	$responseData = Location::getClientLocation($request);
		print $responseData;
	}
	
	public function addClientLocation(Request $request){
    	$responseData = Location::addClientLocation($request);
		print $responseData;
	}
	
	public function updateClientLocation(Request $request){
    	$responseData = Location::updateClientLocation($request);
		print $responseData;
	}
	
	public function deleteClientLocation(Request $request){
    	$responseData = Location::deleteClientLocation($request);
		print $responseData;
	}

}
