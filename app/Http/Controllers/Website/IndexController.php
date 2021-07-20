<?php
namespace App\Http\Controllers\Website;
use Validator;
use DB;
use Hash;
use Auth;
use App\Http\Controllers\Autoshop\AlertController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
use Carbon;
use Illuminate\Support\Facades\Mail;
use Session;
use View;
use Config;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Languages;
use App\Models\Autoshop\Products;
use App\Models\Autoshop\Currency;
use App\Models\Autoshop\News;
use App\Models\Autoshop\Order;
use App\Faq;
use App\ContactUs;
use App\Client;
use App\Garage;
use App\GarageTeam;
use App\GarageImage;
use App\GarageVideo;
use App\PageContent;
use App\Testimonial;
use App\ServicePackage;
use App\Country;

use App\GarageService;
use App\GarageWorkingHour;
use App\ServicePackageFeature;
use App\Section;
use App\City;

use Illuminate\Pagination\LengthAwarePaginator;


class IndexController extends Controller
{

	public function __construct(
		                  Index $index,
											News $news,
											Languages $languages,
											Products $products,
											Currency $currency,
											Order $order
											)
	{
		$this->index = $index;
		$this->order = $order;
		$this->news = $news;
		$this->languages = $languages;
		$this->products = $products;
		$this->currencies = $currency;
		$this->theme = new ThemeController();
	}

    public function login(Request $request){
        if(auth()->guard('customer')->check()){
            return redirect('/');
        }elseif (auth()->guard('vendor')->check()) {
            return redirect('/');
        }
        else{
            $previous_url = Session::get('_previous.url');

            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $ref = rtrim($ref, '/');


            session(['previous'=> $previous_url]);

            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();

            $result = array();
            $result['commonContent'] = $this->index->commonContent();

            return view("auth.login", ['title'=>$title,'final_theme' => $final_theme])->with('result', $result);
        }

    }

    public function register(Request $request){

        $final_theme = $this->theme->theme();
        if(auth()->guard('customer')->check()){
            return redirect('/');
        }elseif (auth()->guard('vendor')->check()) {
            return redirect('/');
        }
        else{
            
            if(session('active_reg_tab') == 'garage')
                session(['active_reg_tab'=> 'garage']);
            else
                session(['active_reg_tab'=> 'customer']);
                
            $title = array('pageTitle' => Lang::get("website.Sign Up"));
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            return view("auth.register", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
        }
    }

	public function index(){



		$title = array('pageTitle' => Lang::get("website.Home"));
		$final_theme = $this->theme->theme();
 
		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$title = array('pageTitle' => Lang::get("website.Home"));

        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
		
        $allGarageList = Garage::join('users','users.id' , 'garages.user_id')
        ->join('garages_description','garages_description.garages_id' , 'garages.id')
        ->where('garages.status', 1)
        ->where('garages.type','!=', 2)
        ->where('garages_description.language_id', $language_id)
        ->select('garages_description.garages_name', 'garages.id', 'garages.user_id', 'garages.slug', 'garages.address', 'garages.city_id', 'garages.country_id', 'garages.postal','garages.profile_image', 'garages.is_feature')
        ->orderBy('garages.created_at', 'DESC')
        ->get();
        
        //dd($allGarageList);

        $featureGarages = $latestGarages = [];
        if($allGarageList->count()){
            $allGarageList = $allGarageList->toArray();
            foreach ($allGarageList as  $garage) {
                if($garage['is_feature'] == 1){
                    $featureGarages[] = $garage;
                    continue;
                }
                $latestGarages[] = $garage;
            }
        }
        
        $sponsors = DB::table('sponsors')->where('status', 1)->get();
       // dd($sponsors);
       
        $testimonials = Testimonial::where('status', 1)->get();
        if( $testimonials->isEmpty()){
             $testimonials = [];
        }else{
            $testimonials = $testimonials->toArray();
        }
        
        $sections = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->where('sections_description.language_id', $language_id)
            ->where('parent' , 0)->where('status', 1)
            ->orderBy('type')
            ->orderBy('sections_name')->get();
        
        $all_sections = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
                ->select('sections_description.sections_name as name', 'sections.id', 'sections.parent')
                ->where('sections_description.language_id', $language_id)
                ->where('status', 1)->where('type', '!=' , 2)->orderBy('name')->get();
                
        $allCitiesList = City::where('status', 1)->get()->toArray();
        foreach ($allCitiesList as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $allCities[$value['id']] = $value;
        }
        
        $allCountries = Country::where('status', 1)->get()->toArray();
        foreach ($allCountries as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $countries[$value['id']] = $value;
        }


		
		return view("website.index",[
		    'title' => $title,
		    'final_theme' => $final_theme,
		    'sections' => $sections, 
		    'all_sections' => $all_sections, 
		    'allCities' => $allCities,
		    'countries' => $countries,
		    'featureGarages' => $featureGarages,
		    'latestGarages'=> $latestGarages, 
		    'testimonials' => $testimonials,
		    'sponsors' => $sponsors
		])->with(['result' => $result]);
	}

	public function maintance(){
		return view('errors.maintance');
	}

	public function error(){
		return view('errors.general_error',['msg' => $msg]);
	}

	public function logout(){
		Auth::guard(\Auth::getDefaultDriver())->logout();
        return redirect('/');
	}
	public function test(){
		$productcategories = $this->products->productCategories1();
		echo print_r($productcategories);

	}

	// set header ...
	private function setHeader($header_id){
		$count	= $this->order->countCompare();
		$languages = $this->languages->languages();
		$currencies = $this->currencies->getter();
		$productcategories = $this->products->productCategories();
		$title = array('pageTitle' => Lang::get("website.Home"));
		$result = array();
		$result['commonContent'] = $this->index->commonContent();

		$header = (string)View::make('autoshop.headers.headerOne',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();

		return $header;
	}

	
	// set footer ...
	private function setFooter($footer_id){
		$footer = (string)View::make('autoshop.footers.footer1')->render();
		return $footer;
	}


	
	//faq
	public function faq(Request $request){
		$title = array('pageTitle' => Lang::get("website.faq"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

		$faq_all = [];
        $catNames = [];

        if(\Config::get('app.locale') == 'en'){
             $allFaqsArr = Faq::where('status', 1)->select('id','cat_name_en','heading_en','answer_en','status')->get();
        }else{
             $allFaqsArr = Faq::where('status', 1)->select('id','cat_name_ar','heading_ar','answer_ar','status')->get();
        }
       
        

        if(!empty($allFaqsArr->count())){
            $allFaqsArr = $allFaqsArr->toArray();
           
            foreach ($allFaqsArr as $faq) {
                    if(\Config::get('app.locale') == 'en'){
                        
                        if(!in_array($faq['cat_name_en'], $catNames)){
                            $catNames[] = $faq['cat_name_en'];
                        }
                        
                        $faqs[$faq['cat_name_en']][] = [
                            'id' => $faq['id'],
                            'category' =>$faq['cat_name_en'],
                            'header' => $faq['heading_en'],
                            'answer' => $faq['answer_en']
                        ];


                    }else{
                        if(!in_array($faq['cat_name_ar'], $catNames)){
                            $catNames[] = $faq['cat_name_ar'];
                        }
                         $faqs[$faq['cat_name_ar']][] = [
                             'id' => $faq['id'],
                            'category' =>$faq['cat_name_ar'],
                            'header' => $faq['heading_ar'],
                            'answer' => $faq['answer_ar']
                        ];
                    }

                }
        }       
		return view("website.faq", ['title' => $title,'final_theme' => $final_theme , 'cat_names' => $catNames, 'faqs' =>  $faqs ])->with('result', $result);
	}

	// about-us
	public function aboutUs(Request $request){
		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

        $aboutUs = PageContent::select('about_us_content_en','about_us_content_ar')->first();

		return view("website.about-us", ['aboutUs' => $aboutUs, 'title' => $title,'final_theme' => $final_theme])->with('result', $result);
	}

	// term and condition
	public function termAndCondtions(Request $request){
		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

		$pageContnet = PageContent::select('terms_conditions_en','terms_conditions_ar')->first();

		return view("website.term-and-conditions", ['title' => $title,'final_theme' => $final_theme, 'pageContnet' => $pageContnet])->with('result', $result);
	}

	// privacy
	public function privacy(Request $request){
		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();
		$pageContnet = PageContent::select('privacy_policy_en','privacy_policy_ar')->first();

		return view("website.privacy", ['title' => $title,'final_theme' => $final_theme, 'pageContnet' => $pageContnet])->with('result', $result);
	}

	// package Price
	public function packagePrice(Request $request){
		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
        
        
        if($language_id == 2){
            $all_sections = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
                    ->select('sections_description.sections_name as name','sections_description.sections_id')
                    //->where('sections_description.language_id', $language_id)
                    ->where('status', 1)->where('parent', 0)->where('type', 2)->get();
            
            $temp_sections = $sections = [];  
            foreach($all_sections as $section){
               $temp_sections[$section['sections_id']][]  = $section['name'];
            }
            foreach($temp_sections as $section){
               $sections[$section[0]]  = $section[1];
            }
        }
        
        
		$packages = ServicePackage::where('status' , 1)
		        ->with('packageFeatures','section')
		        ->get();

        $clinet_packages = $garage_packages = [];
        foreach ($packages as $package) {
            //dd($package['section']['name']);die;
            //echo $sections[trim($package['section']['name'])];
            //echo $package['section']['name'];die;
            if(isset($sections[trim($package['section']['name'])]) && $language_id == 2)
                $package['section']['name'] = $sections[trim($package['section']['name'])];
            if($package['package_for'] == 1 && $package['slug'] != 'custom-package') $clinet_packages[$package['id']] = $package;
            if($package['package_for'] == 2) $garage_packages[$package['id']] = $package;
        }
        
		return view("website.package-price", [
		    'title' => $title,
		    'final_theme' => $final_theme, 
		    'clientPackageData' => $clinet_packages , 
		    'garagePackageData' => $garage_packages
		])->with('result', $result);
	}



	//myContactUs
	public function contactus(Request $request){

		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();
        	$contactusinfo = ContactUs::first();


		return view("website.contact-us", ['title' => $title,'final_theme' => $final_theme ,'contactusinfo' => $contactusinfo])->with('result', $result);
	}



	//processContactUs
	public function processContactUs(Request $request){
		$name 		=  $request->name;
		$email 		=  $request->email;
		$subject 	=  $request->subject;
		$message 	=  $request->message;

		$result['commonContent'] = $this->index->commonContent();

		$data = array('name'=>$name, 'email'=>$email, 'subject'=>$subject, 'message'=>$message, 'adminEmail'=>'info@g2g.ae');

		Mail::send('/mail/contactUs', ['data' => $data], function($m) use ($data){
			$m->to($data['adminEmail'])->subject(Lang::get("website.contact us title"))->getSwiftMessage()
			->getHeaders()
			->addTextHeader('x-mailgun-native-send', 'true');
		});

		return redirect()->back()->with('success', Lang::get("website.contact us message"));
	}


	//All workshop/garages listings...
	public function allworkshopsGarages($category = null){

		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

        $data = [];
        $listCount = 10;
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
        $garages = $countries = $allCities = [];
        
        $all_categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->select('sections_description.sections_name as name', 'sections.id', 'sections.parent')
            ->where('sections_description.language_id', $language_id)
            ->where('status', 1)->where('type', '!=' , 2)->orderBy('name')->get();
            
        $allCitiesList = City::where('status', 1)->get()->toArray();
        foreach ($allCitiesList as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $allCities[$value['id']] = $value;
        }
        
        $allCountries = Country::where('status', 1)->get()->toArray();
        foreach ($allCountries as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
            $countries[$value['id']] = $value;
        }
        

        if(!empty($category)){

            switch ($category) {
                case 'all':
              
                    $garages = Garage::query()
                    ->join('garages_description','garages_description.garages_id' , 'garages.id')
                    ->where('garages.status', 1)
                    ->where('garages.type','!=', 2)
                    ->where('garages_description.language_id', $language_id)
                    ->orderBy('garages.created_at', 'DESC')
                    ->paginate($listCount);
                    $per_page = ($garages->total() > $listCount) ? $listCount : $garages->total();
                  
                    break;

                case 'featured':
                      
                    $garages = Garage::featuredGarage()
                    ->join('garages_description','garages_description.garages_id' , 'garages.id')
                    ->where('garages.status', 1)
                    ->where('garages.type','!=', 2)
                    ->where('garages_description.language_id', $language_id)
                    ->orderBy('garages.created_at', 'DESC')
                    ->paginate($listCount);
                    $per_page = ($garages->total() > $listCount) ? $listCount : $garages->total();

                    break;

                case 'latest':
                    $garages = Garage::query()
                    ->join('garages_description','garages_description.garages_id' , 'garages.id')
                    ->where('garages.status', 1)
                    ->where('garages.type','!=', 2)
                    ->where('garages_description.language_id', $language_id)
                    ->orderBy('garages.created_at', 'DESC')
                    ->paginate($listCount);
                    $per_page = ($garages->total() > $listCount) ? $listCount : $garages->total();
                        
                    break;

                case 'near-by-garages':
                        //$data['garages'] =Garage::where('status', 1)->orderBy('created_at', 'DESC')
                        $garages = [];
                        $per_page = $listCount;
                    break;
                
                default:
                    
                    $garages = Garage::featuredGarage()
                    ->join('garages_description','garages_description.garages_id' , 'garages.id')
                    ->where('garages.status', 1)
                    ->where('garages.type','!=', 2)
                    ->where('garages_description.language_id', $language_id)
                    ->orderBy('garages.created_at', 'DESC')
                    ->paginate($listCount);
                    $per_page = ($garages->total() > $listCount) ? $listCount :  $garages->total();

                    break;
            }
        }

         $s_address = null;
        $city_filters = 'all';
        $distance_filters = 100;
        $category_filters = ['all'];
        
        
        if($category == 'near-by-garages'){
            $view = "website.garages.byLocation";
        }else{
            $view = "website.garages.listings";
        }
        
        return view($view, [
                'title' => $title,
                'final_theme' => $final_theme,
                'per_page' => $per_page,
                'category_filters' => $category_filters,
                'distance_filters' => $distance_filters,
                'city_filters' => $city_filters,
                's_address' => $s_address,
                'garages' => $garages,
                'all_categories' => $all_categories,
                'allCities' => $allCities,
                'countries' => $countries
            ])->with('result', $result);

		    
	}

	//single workshop/garages listings...
	public function singleWorkshopsGarages($slug){

		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
        
        $all_categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->select('sections_description.sections_name as name', 'sections.id', 'sections.parent')
            ->where('sections_description.language_id', $language_id)
            ->where('status', 1)->where('type', '!=' , 2)->orderBy('name')->get();
            
        $allCitiesList = City::where('status', 1)->get()->toArray();
        foreach ($allCitiesList as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $allCities[$value['id']] = $value;
        }
        
        $allCountries = Country::where('status', 1)->get()->toArray();
        foreach ($allCountries as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $countries[$value['id']] = $value;
        }

        $garage = Garage::join('users','users.id' , 'garages.user_id')
                ->join('garages_description','garages_description.garages_id' , 'garages.id')
                ->where('garages.status', 1)
                ->where('garages.type','!=', 2)
                ->where('garages_description.language_id', $language_id)
                 ->select('garages_description.garages_name','garages_description.garages_description', 'garages.id', 'garages.user_id', 'garages.slug', 'garages.address', 'garages.city_id', 'garages.country_id', 'garages.postal','garages.profile_image', 'garages.is_feature','garages.longitude','garages.latitude')
                ->where('slug', $slug)->first();

        if(!empty($garage)){

            $garageServices = GarageService::where('garage_id', $garage->id)->first();
           
             // get the garage services
            $garage_cat_ids = $garage_sub_cat_ids = [];
            if(!is_null($garageServices)){

                $db_cat_ids = $garageServices['cat_id'];
                $db_sub_cat_ids = $garageServices['sub_cat_id'];

                
               
                if(stripos($db_cat_ids , ',') !== false) {
                    $cat_id_arr[] = explode(',', $db_cat_ids);
                    $garage_cat_ids = array_values($cat_id_arr[0]);
                }else{
                    $garage_cat_ids[] = $db_cat_ids;
                }

                if(stripos($db_sub_cat_ids , ',') !== false) {
                    $sub_cat_id_arr[] = explode(',', $db_sub_cat_ids);
                    $garage_sub_cat_ids = array_values($sub_cat_id_arr[0]);
                }else{
                    $garage_sub_cat_ids[] = $db_sub_cat_ids;
                }
            }
         
            // get the database categories
            $finalGarageCategories = $finalGarageSubCategories = [];
            if(isset($cat_id_arr) && count($cat_id_arr) > 0 && count($sub_cat_id_arr) > 0){
                $subCats = $mainCats = [];
                $categories = Section::join('sections_description', 'sections_description.sections_id', 'sections.id')
                            ->select('sections_description.sections_name as name', 'sections.id', 'sections.parent')
                            ->where('sections_description.language_id',$language_id) 
                            ->where('status', 1)->get();
                if(!$categories->isEmpty()){
                    $categories = $categories->toArray();
                    $i = 0;
                    foreach ($categories as $cat) {
                        if($cat['parent'] == 0){
                            if(in_array($cat['id'], $garage_cat_ids)){
                                $finalGarageCategories[$cat['id']] = $cat['name'];
                            }
                        }

                        if($cat['parent'] != 0){
                            if(in_array($cat['id'], $garage_sub_cat_ids)){
                                $finalGarageSubCategories[$cat['parent']][$cat['id']] = $cat['name'];
                            }
                        }
                    }
                }
            }
            //dump($finalGarageCategories);
            //dump($finalGarageSubCategories);die;
               
            $garageServices = [
                'mainCats' => $finalGarageCategories,
                'subCats' => $finalGarageSubCategories,
            ];
            $garageimages = GarageImage::where('garage_id', $garage->id)->get();  
            $garageVideos = GarageVideo::where('garage_id', $garage->id)->get();  
            $garageworkingHours = GarageWorkingHour::where('garage_id', $garage->id)->first();
            //dump($garageimages);die;
            return view("website.garages.single", [
                'title' => $title,
                'final_theme' => $final_theme,
                'garageServices' => $garageServices,
                'garageimages' => $garageimages,
                'garageVideos' => $garageVideos,
                'garageworkingHours' => $garageworkingHours,
                'garage' => $garage,
                 'all_categories' => $all_categories,
                'allCities' => $allCities,
                'countries' => $countries
            ])->with('result', $result);
        }
        return view('website::pages.404');

		
	}


	public function getQuerryArray($str){
        $return = [];
         if(strpos($str, ',')){
             $return  = explode(',', $str);
        }else{
             $return[] = $str;
        }
        return $return;
    }

    public function searchByLocationListings(Request $request){

        $s_latitude =  $s_longitude = $s_distance = $s_category = [];
        $s_address = null;

        $data = [];
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;

        $listCount = 10;
        $data['garages'] = [];
        $data['per_page'] =  $listCount;

        if($request->has('address')){
            $s_address = $request->address;
        }



        if($request->has('latitude')){
            $s_latitude = $request->latitude;
        }

        if($request->has('longitude')){
            $s_longitude = $request->longitude;
        }

        if($request->has('distance')){
            $s_distance = $request->distance;
        }

        if($request->has('category')){
            $s_category = $request->category;
        }

        if(empty($s_latitude) &&  empty($s_longitude) && empty($s_distance) && empty($s_category)){
            $garages = Garage::where('status', 1)->where('garages.type','!=', 2)->orderBy('created_at', 'DESC')->paginate($listCount);
        }else{

            $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->join('garages_description','garages_description.garages_id' , 'garages.id')
                        ->select('garages.*')
                        ->where(function($query) use($s_category) {
                            if($s_category !== 'all'){
                                return $query->whereRaw("FIND_IN_SET($s_category,garage_services.cat_id)")
                                        ->orWhereRaw("FIND_IN_SET($s_category,garage_services.sub_cat_id)");
                            }
                        })
                        ->where('garages_description.language_id', $language_id)
                        ->where('garages.type','!=', 2)
                        ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                         ->select('garages_description.garages_name','garages_description.garages_description', 'garages.id', 'garages.user_id', 'garages.slug', 'garages.address', 'garages.city_id', 'garages.country_id', 'garages.postal','garages.profile_image', 'garages.is_feature','garages.longitude','garages.latitude')
                        ->get();
           
           
            if(!empty($garages) && count($garages) > 0){

                foreach($garages as $key => $garage){
                    $g_latitude = $garage->latitude; 
                    $g_longitude = $garage->longitude; 

                    $distanceInKm = $this->calculateDistanceBetweenTwoPoints( $s_latitude, $s_longitude , $g_latitude,$g_longitude);
                    if((int)$distanceInKm > (int)$s_distance){
                        $garages->forget($key);
                    }
                }
            }
        }   
        
        //dd($garages);
       

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($garages);
 
        // Define how many items we want to be visible in each page
        $perPage = 10;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
       
        $garages = $paginatedItems;
        $per_page =  ($garages->total() >  $listCount) ? $listCount :  $garages->total();
        
        $s_address = $s_address;
        $city_filters = 'all';
        $distance_filters = $s_distance;
        $category_filters = [$s_category];
        $allCities = $countries = [];
        
        $all_categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->select('sections_description.sections_name as name', 'sections.id', 'sections.parent')
            ->where('sections_description.language_id', $language_id)
            ->where('status', 1)->where('type', '!=' , 2)->orderBy('name')->get();
            
        $allCitiesList = City::where('status', 1)->get()->toArray();
        foreach ($allCitiesList as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
             // as per chnages , if lat and long is set then sshow the garage acc. to lat and long
            if($request->has('city')){
               //check city iss listed in cities table
               if( strcasecmp($request->city,$value['name'] ) == 0 || strcasecmp($request->city,$value['name_ar'] ) == 0){
                    $city_filters = $value['id'];
               }
            }
           $allCities[$value['id']] = $value;
        }
        
        $allCountries = Country::where('status', 1)->get()->toArray();
        foreach ($allCountries as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $countries[$value['id']] = $value;
        }


        return view("website.garages.listings", [
                'final_theme' => $final_theme,
                'per_page' => $per_page,
                'category_filters' => $category_filters,
                'distance_filters' => $distance_filters,
                'city_filters' => $city_filters,
                's_address' => $s_address,
                'garages' => $garages,
                'all_categories' => $all_categories,
                'allCities' => $allCities,
                'countries' => $countries
            ])->with('result', $result);

        

    }
    
    public function searchListings(Request $request){

        $category_filters =  $distance_filters = $city_filters = [];

        $data = [];
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
        

        $listCount = 10;
        $garages = [];
        $per_page =  $listCount;

        if($request->has('category_filter')){
            $category_filters = $this->getQuerryArray($request->category_filter);
        }else{
            $category_filters = ['all'];
        }

        if($request->has('distance_filter')){
            $distance_filters = $request->distance_filter;
        }else{
            $distance_filters = 100;
        }

        if($request->has('city_filter')){
            $city_filters = $request->city_filter;
        }else{
           $city_filters ='all';
        }
        
        $allCities = $countries = [];
        
        $all_categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->select('sections_description.sections_name as name', 'sections.id', 'sections.parent')
            ->where('sections_description.language_id', $language_id)
            ->where('status', 1)->where('type', '!=' , 2)->orderBy('name')->get();
            
        $allCitiesList = City::where('status', 1)->get()->toArray();
        foreach ($allCitiesList as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $allCities[$value['id']] = $value;
        }
        
        $allCountries = Country::where('status', 1)->get()->toArray();
        foreach ($allCountries as $value){
            if($language_id == 2){
                $value['name'] =  $value['name_ar'];
            }else{
                 $value['name'] =  $value['name'];
            }
           $countries[$value['id']] = $value;
        }



        if(empty($category_filters) &&  empty($distance_filters) && empty($city_filters)){
            $garages = Garage::where('status', 1)->where('garages.type','!=', 2)->orderBy('created_at', 'DESC')->paginate($listCount);
        }else{

            $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->join('cities', 'cities.id', '=', 'garages.city_id')
                        ->select('garages.*', 'cities.name as city_name', 'cities.id as city_id', 'cities.latitude as city_latitude' , 'cities.longitude as city_longitude')
                        ->whereHas('city', function ($query) use ($city_filters) {
                            if($city_filters !== 'all'){
                                $query->where('garages.city_id', $city_filters);
                            }
                        })
                       ->where(function($query) use($category_filters) {
                            if(!in_array('all', $category_filters) !== false){
                              foreach($category_filters as $cf){
                                return $query->whereRaw("FIND_IN_SET($cf,garage_services.cat_id)")
                                        ->orWhereRaw("FIND_IN_SET($cf,garage_services.sub_cat_id)");
                              }
                            }
                        })
                       ->where('garages.type','!=', 2)
                        ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                        ->get();


            if(!empty($garages) && count($garages) > 0){

                // get the lat city filter
                if($distance_filters !== 'no' && $city_filters !== 'all'){
                    
                    $city = City::where('id',$city_filters )->where('status' ,1)->select('latitude','longitude')->first();
                    
                    if(!is_null($city)){
                        $c_latitude = $city->latitude; 
                        $c_longitude = $city->longitude; 
                    }


                    foreach($garages as $key => $garage){
                        $g_latitude = $garage->latitude; 
                        $g_longitude = $garage->longitude; 

                        $distanceInKm = $this->calculateDistanceBetweenTwoPoints( $c_latitude, $c_longitude , $g_latitude,$g_longitude);
                        if((int)$distanceInKm > (int)$distance_filters){
                            $garages->forget($key);
                        }
                    }
                }
            }
        }   
        
        //dd($garages);
       

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($garages);
 
        // Define how many items we want to be visible in each page
        $perPage = 10;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
       
        $garages = $paginatedItems;
        $per_page =  ($garages->total() >  $listCount) ? $listCount :  $garages->total();
        //dd($data);die;

       
        $s_address = null;
        $city_filters = $city_filters;
        $distance_filters = $distance_filters;
        $category_filters = $category_filters;

       return view("website.garages.listings", [
               
                'final_theme' => $final_theme,
                'per_page' => $per_page,
                's_address' => $s_address,
                'category_filters' => $category_filters,
                'distance_filters' => $distance_filters,
                'city_filters' => $city_filters,
                'garages' => $garages,
                'all_categories' => $all_categories,
                'allCities' => $allCities,
                'countries' => $countries
            ])->with('result', $result);
       
       
    }

    public function calculateDistanceBetweenTwoPoints($latitudeOne='', $longitudeOne='', $latitudeTwo='', $longitudeTwo='')
    {
        $decimalPoints = '3';
        $distanceUnit = 'KM';
        $distanceUnit = strtolower($distanceUnit);
        $pointDifference = $longitudeOne - $longitudeTwo;
        $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
        $toAcos = acos($toSin);
        $toRad2Deg = rad2deg($toAcos);

        $toMiles  =  $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        return round($toKilometers, $decimalPoints);
    }

    public function ajaxSignInModalLogin(Request $request){


        

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

         
        if($request->has('slug') && $request->has('page')){

            $page = $request->get('page');
            $gaurd = 'customer';

            $login = $request->email;
            if(is_numeric($login)){
               $loginInfo = array("phone" => $request->email, "password" => $request->password);
            } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $loginInfo = array("email" => $request->email, "password" => $request->password);
            } else {
                $loginInfo = array("user_name" => $request->email, "password" => $request->password);
            }   


            if($page == 'service-request'){
                $loginInfo['role_id'] = 2;
                $routePage = 'client.service-request.create';
                if( Auth::guard($gaurd)->attempt($loginInfo) ) {
                   return redirect()->route($routePage,['category' => $request->slug ]);
                }else{
                    return redirect('login')->with('loginError','Unauthorized access! Only valid Customer can access this feature.');
                }

            }elseif ($page == 'garage-package-subscription'){
              
                $gaurd = 'vendor';
                $loginInfo['role_id'] = 3;
                $routePage = 'garage.packages.buy_or_upgrade';
                if( Auth::guard($gaurd)->attempt($loginInfo) ) {
                    if(Auth::guard($gaurd)->user()->garage_vendor_type != 2){
                         return redirect()->route($routePage,['slug' => $request->slug ]);
                    }else{
                        Auth::guard($gaurd)->logout();
                    }
                }
                return redirect('login')->with('loginError','Unauthorized access! Only valid Garage user can access this feature.');
                
            }elseif ($page == 'client-package-subscription') {
                $loginInfo['role_id'] = 2;
                $routePage = 'client.package-subscription.create';
                if( Auth::guard($gaurd)->attempt($loginInfo) ) {
                   return redirect()->route($routePage,['category' => $request->slug ]);
                }else{
                    return redirect('login')->with('loginError','Unauthorized access! Only valid Customer can access this feature.');
                }
            }
        }
        return redirect('login')->with('loginError','Something went wrong! please contact admin for further assistance.');
  }
  
    public function verifyEmailAddress($token){
        
        $message = $customers  = $valid_token = null;
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();

        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        if(!empty($token)){
            $customers = DB::table('users')->where('email_verified_token', '=', trim($token))->get();
            if(!empty($customers)){
                DB::table('users')->where('id', $customers[0]->id)->update([
                    'email_verified' => 1,
                    'email_verified_at' => now()
                ]);
                $myVar = new AlertController();
                $alertSetting = $myVar->accountSuccessAlert($customers);
            }
        }
        return view("website.thank-you-sign-up",['customers' => $customers, 'title' => $title,'final_theme' => $final_theme])->with('result', $result);
    }

    


}
