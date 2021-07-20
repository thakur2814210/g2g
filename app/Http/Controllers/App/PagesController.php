<?php
namespace App\Http\Controllers\App;

//validator is builtin class in laravel
use Validator;

use DB;
//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//for Carbon a value
use Carbon;

class PagesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

	//getAllPages
	public function getallpages(Request $request){
		$language_id            				=   $request->language_id;
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  	  = request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);

		if($authenticate==1){

			$data = DB::table('page_contents')->get();




			/*$data = DB::table('pages')
				->LeftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
				->where('pages_description.language_id', '=', $language_id)->get();*/

			$result = array();
			$index = 0;
			foreach($data as $pd){

				if($language_id == 1){
					$result['aboutUs'] = $pd->about_us_content_en;
					$result['privacyPolicy'] = $pd->privacy_policy_en;
					$result['termServices'] = $pd->terms_conditions_en;
				}else{
					$result['aboutUs'] = $pd->about_us_content_ar;
					$result['privacyPolicy'] = $pd->privacy_policy_ar;
					$result['termServices'] = $pd->terms_conditions_ar;
				}
			}
			
			
			$sponsors = DB::table('sponsors')->where('status', 1)->select('logo','name as name_en','name_ar')->get();
			foreach($sponsors as $sd){
			    if($language_id == '1'){
			        $sd->name = $sd->name_en;
			    }else{
			         $sd->name = $sd->name_ar;
			    }
			}
            $result['sponsors'] = $sponsors;
            
			$faqs = [];
        	$catNames = [];
        	$categories = [];

			if($language_id == '1'){
	             $allFaqsArr = DB::table('faq')->where('status', 1)->select('cat_name_en','heading_en','answer_en','status')->get();
	        }else{
	             $allFaqsArr = DB::table('faq')->where('status', 1)->select('cat_name_ar','heading_ar','answer_ar','status')->get();
	        }

	       	if(!empty($allFaqsArr->count())){
		        $data = json_decode($allFaqsArr, true);
		        foreach ($data as $faq) {
		        	if($language_id == '1'){
		        		
		        		if(!in_array($faq['cat_name_en'], $catNames)){
	                    	$catNames[] = $faq['cat_name_en'];
	                	}
	                    
	                     $faqs[] = [
		                	'name' =>$faq['heading_en'],
		                	'category' => $faq['cat_name_en'],
		                	'expanded' =>false,
		                	'items' => $faq['answer_en']
		                	
		                ];


	                }else{
	                    if(!in_array($faq['cat_name_ar'], $catNames)){
	                    	$catNames[] = $faq['cat_name_ar'];
	                	}
	                     $faqs[] = [
		                	'name' =>$faq['heading_ar'],
		                	'category' => $faq['cat_name_ar'],
		                	'expanded' =>false,
		                	'items' => $faq['answer_ar']
		                ];
	                }
		        }

		        
		        /*foreach($catNames as $cat){
		        	$temp = [];
		        	$temp['name'] = $cat;
		        	$temp['items'] = $faqs[$cat];
		        	$temp['expanded'] = false;
		        	$categories[] = $temp;
		        }*/
	    	}

			
			$result['faq'] = $faqs;
			$result['contactus'] = DB::table('contact_us')->get()->toArray();

			if($language_id == '1'){
	             $result['testimonials'] = DB::table('testimonials')->where('status', 1)->select('name_en as name','designation_en as designation','remarks_en as remarks','image')->get();
	        
	            $result['how_it_works'] = [
    	        	'name' => 'How G2G Works',
    	        	'sub_heading' => 'Simple Steps To Service Your Car',
    	        	'items' => [
    	        		[
    	        			'title' => 'Register & Login',
    	        			'icon' => 'home',
    	        			'description' => 'Enter mobile number and register your vehicle - up to 10 vehicles per Customer.'
    	        		],
    	        		[
    	        			'title' => 'Choose your service',
    	        			'icon' => 'home',
    	        			'description' => 'Select the service you need & fill in the details required for the service.'
    	        		],
    	        		[
    	        			'title' => 'Buy or Request Quotation',
    	        			'icon' => 'home',
    	        			'description' => 'Your selected garage will automatically send you the quotation, customer can either approve or reject.'
    	        		],
    	        		[
    	        			'title' => 'See updates online',
    	        			'icon' => 'home',
    	        			'description' => 'All invoices, payment receipts, quotations and workshop feedback are visible in my account once you log in.'
    	        		]
    	        	]
    	        ];
			    
			}else{
	             $result['testimonials'] = DB::table('testimonials')->where('status', 1)->select('name_ar as name','designation_ar as designation','remarks_ar as remarks','image')->get();
	        
			     $result['how_it_works'] = [
    	        	'name' => 'كيف يعمل G2G',
    	        	'sub_heading' => 'خطوات بسيطة لخدمة سيارتك',
    	        	'items' => [
    	        		[
    	        			'title' => 'تسجيل الدخول',
    	        			'icon' => 'home',
    	        			'description' => 'أدخل رقم الهاتف المحمول وقم بتسجيل مركبتك - حتى 10 مركبات لكل عميل'
    	        		],
    	        		[
    	        			'title' => 'اختر خدمتك',
    	        			'icon' => 'home',
    	        			'description' => 'حدد الخدمة التي تريدها واملأ التفاصيل المطلوبة للخدمة'
    	        		],
    	        		[
    	        			'title' => 'شراء أو طلب تسعير',
    	        			'icon' => 'home',
    	        			'description' => 'سيرسل لك المرآب الذي اخترته عرض الأسعار تلقائيًا ، ويمكن للعميل إما الموافقة أو الرفض'
    	        		],
    	        		[
    	        			'title' => 'رؤية التحديثات على الإنترنت',
    	        			'icon' => 'home',
    	        			'description' => 'تظهر جميع الفواتير وإيصالات الدفع وعروض الأسعار وملاحظات ورشة العمل في حسابي بمجرد تسجيل الدخول'
    	        		]
    	        	]
    	        ];
			}

			//check if record exist
			if(count($data)>0){
				$responseData = array('success'=>'1', 'pages_data'=>$result,  'message'=>"Returned all products.");
			}else{
				$responseData = array('success'=>'0', 'pages_data'=>array(),  'message'=>"Empty record.");
			}
		}else{
			$responseData = array('success'=>'0', 'pages_data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$categoryResponse = json_encode($responseData);
		print $categoryResponse;
	}

}
