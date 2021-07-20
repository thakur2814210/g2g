<?php
namespace App\Http\Controllers\App\Garage;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Mail;
use DateTime;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\AppModels\Garage;

class CustomersController extends Controller
{

	//login
	public function processlogin(Request $request){
    $userResponse = Garage::processlogin($request);
		print $userResponse;
	}

	//registration
	public function processregistration(Request $request){
    $userResponse = Garage::processregistration($request);
		print $userResponse;
	}

	//notify_me
	public function notify_me(Request $request){
    $categoryResponse = Garage::notify_me($request);
		print $categoryResponse;
	}

	//update profile
	public function updatecustomerinfo(Request $request){
    $userResponse = Garage::updatecustomerinfo($request);
		print $userResponse;

	}

	//processforgotPassword
	public function processforgotpassword(Request $request){
    $userResponse = Garage::processforgotpassword($request);
		print $userResponse;
	}

	
	//generate random password
	function createRandomPassword() {
		$pass = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
		return $pass;
	}

	//generate random password
	function registerdevices(Request $request) {
    	$userResponse = Garage::registerdevices($request);
		print $userResponse;
	}

	function updatepassword(Request $request) {
		$userResponse = Garage::updatepassword($request);
		print $userResponse;
	}

	function mypayments(Request $request){
		$userResponse = Garage::mypayments($request);
		print $userResponse;
	}

	function getVehicles(Request $request){
		$userResponse = Garage::getVehicles($request);
		print $userResponse;
	}

	function addVehicle(Request $request){
		$userResponse = Garage::addVehicle($request);
		print $userResponse;
	}

	function updateVehicle(Request $request){
		$userResponse = Garage::updateVehicle($request);
		print $userResponse;
	}

	function deleteVehicle(Request $request){
		$userResponse = Garage::deleteVehicle($request);
		print $userResponse;
	}

	function deleteClientLocation(Request $request){
		$userResponse = Garage::deleteClientLocation($request);
		print $userResponse;
	}

	function getVehicleMakes(Request $request){
		$userResponse = Garage::getVehicleMakes($request);
		print $userResponse;
	}

	function getVehicleModels(Request $request){
		$userResponse = Garage::getVehicleModels($request);
		print $userResponse;
	}

	function getSingleVehicle(Request $request){
		$userResponse = Garage::getSingleVehicle($request);
		print $userResponse;
	}

	//update profile
	public function updategaragecustomerinfo(Request $request){
    $userResponse = Garage::updategaragecustomerinfo($request);
		print $userResponse;

	}


}
