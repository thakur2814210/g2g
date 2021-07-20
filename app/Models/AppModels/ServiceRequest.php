<?php
namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\AppModels\Product;
use DB;
use Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon;
use Hash;

class ServiceRequest extends Model{



	public static function allservicerequests($request){
		$language_id            			  =   $request->language_id;
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  	  = request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
      	$authController = new AppSettingController();
      	$authenticate = $authController->apiAuthenticate($consumer_data);

      if ($authenticate == 1) {

          $item  = DB::table('sections')
			  ->leftJoin('sections_description','sections_description.sections_id', '=', 'sections.id')
			  ->select('sections.id','sections.parent','sections.type', 'sections.cat_icon as image',  'sections.created_at as date_added', 'sections.updated_at as last_modified', 'sections_description.sections_name as name')
			  ->where('sections_description.language_id', $language_id);

          $sections = $item->where('sections.status', '1')
              ->orderby('id', 'ASC')
              ->groupby('id')
              ->get();

          if (count($sections) > 0) {

              $items = array();
              $index = 0;
              foreach ($sections as $section) {
                  array_push($items, $section);
              }

              $responseData = array('success' => '1', 'data' => $items, 'message' => "Returned all serviceRequest.", 'serviceRequest' => count($sections));
          } else {
              $responseData = array('success' => '0', 'data' => array(), 'message' => "No serviceRequest found.", 'serviceRequest' => array());
          }
      } else {
          $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);
      return $categoryResponse;
  }

}