<?php
namespace App\Http\Controllers\Website;
use Validator;
use DB;
use Hash;
use Auth;
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
use App\ServicePackageFeature;
use App\Section;



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

	public function index(){

		$title = array('pageTitle' => Lang::get("website.Home"));
		$final_theme = $this->theme->theme();

		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$title = array('pageTitle' => Lang::get("website.Home"));

		 //echo \Config::get('app.locale');die;
        if(\Config::get('app.locale') == 'en'){
            $language_id = 1;
        }else{
            $language_id = 2;
        }
        $allGarageList = Garage::join('garages_description','garages_description.garages_id' , 'garages.id')
        ->where('garages.status', 1)
        ->where('garages_description.language_id', $language_id)
        ->where('role' , 3)
        ->orderBy('garages.created_at', 'DESC')
        ->get();
       
        //dump($allGarageList->toArray());die;

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
		
		return view("website.index",['title' => $title,'final_theme' => $final_theme,'sections' => $sections, 'featureGarages' => $featureGarages,'latestGarages'=> $latestGarages, 'testimonials' => $testimonials])->with(['result' => $result]);
	}

	public function maintance(){
		return view('errors.maintance');
	}

	public function error(){
		return view('errors.general_error',['msg' => $msg]);
	}

	public function logout(){
		\Auth::guard(\Auth::getDefaultDriver())->logout();
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
             $allFaqsArr = Faq::where('status', 1)->select('cat_name_en','heading_en','answer_en','status')->get();
        }else{
             $allFaqsArr = Faq::where('status', 1)->select('cat_name_ar','heading_ar','answer_ar','status')->get();
        }
       
        

        if(!empty($allFaqsArr->count())){
            $allFaqsArr = $allFaqsArr->toArray();
            foreach ($allFaqsArr as $value) {
                if(\Config::get('app.locale') == 'en'){
                     $cat_name = $value['cat_name_en'];
                }else{
                     $cat_name = $value['cat_name_ar'];
                }
               
                if(!in_array($cat_name, $catNames)){
                    $catNames[] =$cat_name;
                }
                $faq_all[$cat_name][] = $value;
            }
        }
       
		return view("website.faq", ['title' => $title,'final_theme' => $final_theme , 'cat_names' => $catNames, 'faqs' =>  $faq_all ])->with('result', $result);
	}

	// about-us
	public function aboutUs(Request $request){
		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

		return view("website.about-us", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
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

		$packages = ServicePackage::where('status' , 1)->with('packageFeatures','section')->get();
       

        $clinet_packages = $garage_packages = [];
        foreach ($packages as $package) {
            
            if($package['package_for'] == 1 && $package['slug'] != 'custom-package'){
                $clinet_packages[$package['id']] = $package;
            }
            
            if($package['package_for'] == 2){
                $garage_packages[$package['id']] = $package;
            }

        }


		return view("website.package-price", ['title' => $title,'final_theme' => $final_theme, 'clientPackageData' => $clinet_packages , 'garagePackageData' => $garage_packages])->with('result', $result);
	}



	//myContactUs
	public function contactus(Request $request){

		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

		return view("website.contact-us", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
	}



	//processContactUs
	public function processContactUs(Request $request){
		$name 		=  $request->name;
		$email 		=  $request->email;
		$subject 	=  $request->subject;
		$message 	=  $request->message;

		$result['commonContent'] = $this->index->commonContent();

		$data = array('name'=>$name, 'email'=>$email, 'subject'=>$subject, 'message'=>$message, 'adminEmail'=>$result['commonContent']['setting'][3]->value);

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

		return view("website.garages.listings", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
	}

	//single workshop/garages listings...
	public function singleWorkshopsGarages($slug){

		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

		return view("website.garages.single", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
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

    public function searchByLocationListings1(Request $request){

        $s_latitude =  $s_longitude = $s_distance = $s_category = [];

        $data = [];
        $listCount = 6;
        $data['garages'] = [];
        $data['per_page'] =  $listCount;

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
            $garages = Garage::where('status', 1)->orderBy('created_at', 'DESC')->paginate($listCount);
        }else{

            $garages =  Garage::join('garage_services', 'garage_services.garage_id', '=', 'garages.id')
                        ->select('garages.*')
                        ->where(function($query) use($s_category) {
                            if($s_category !== 'all'){
                                return $query->whereRaw("FIND_IN_SET($s_category,garage_services.cat_id)")
                                        ->orWhereRaw("FIND_IN_SET($s_category,garage_services.sub_cat_id)");
                            }
                        })
                        ->where('garages.status', 1)->orderBy('garages.created_at', 'DESC')
                        ->get();

           // die('dsadsa');
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
        $perPage = 6;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
       
        $data['garages'] = $paginatedItems;
        $data['per_page'] =  ($data['garages']->total() >  $listCount) ? $listCount :  $data['garages']->total();
        //dd($data);die;

       

        $data['city_filters'] = 'all';
        $data['distance_filters'] = $s_distance;
        $data['category_filters'] = [$s_category];
        return view('website::listings.garage-list-by-search-header' , $data);

    }
    
    public function searchListings1(Request $request){



        $category_filters =  $distance_filters = $city_filters = [];

        $data = [];
        $listCount = 6;
        $data['garages'] = [];
        $data['per_page'] =  $listCount;

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



        if(empty($category_filters) &&  empty($distance_filters) && empty($city_filters)){
            $garages = Garage::where('status', 1)->orderBy('created_at', 'DESC')->paginate($listCount);
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
        $perPage = 6;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
       
        $data['garages'] = $paginatedItems;
        $data['per_page'] =  ($data['garages']->total() >  $listCount) ? $listCount :  $data['garages']->total();
        //dd($data);die;

       

        $data['city_filters'] = $city_filters;
        $data['distance_filters'] = $distance_filters;
        $data['category_filters'] = $category_filters;
       // dd($data);
       
        return view('website::listings.search-listings' , $data);
    }

    public function calculateDistanceBetweenTwoPoints($latitudeOne='', $longitudeOne='', $latitudeTwo='', $longitudeTwo='',$distanceUnit ='',$round=false,$decimalPoints='')
    {
        if (empty($decimalPoints)) 
        {
            $decimalPoints = '3';
        }
        if (empty($distanceUnit)) {
            $distanceUnit = 'KM';
        }
        $distanceUnit = strtolower($distanceUnit);
        $pointDifference = $longitudeOne - $longitudeTwo;
        $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
        $toAcos = acos($toSin);
        $toRad2Deg = rad2deg($toAcos);

        $toMiles  =  $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        $toNauticalMiles = $toMiles * 0.8684;
        $toMeters = $toKilometers * 1000;
        $toFeets = $toMiles * 5280;
        $toYards = $toFeets / 3;


              switch (strtoupper($distanceUnit)) 
              {
                  case 'ML'://miles
                         $toMiles  = ($round == true ? round($toMiles) : round($toMiles, $decimalPoints));
                         return $toMiles;
                      break;
                  case 'KM'://Kilometers
                        $toKilometers  = ($round == true ? round($toKilometers) : round($toKilometers, $decimalPoints));
                        return $toKilometers;
                      break;
                  case 'MT'://Meters
                        $toMeters  = ($round == true ? round($toMeters) : round($toMeters, $decimalPoints));
                        return $toMeters;
                      break;
                  case 'FT'://feets
                        $toFeets  = ($round == true ? round($toFeets) : round($toFeets, $decimalPoints));
                        return $toFeets;
                      break;
                  case 'YD'://yards
                        $toYards  = ($round == true ? round($toYards) : round($toYards, $decimalPoints));
                        return $toYards;
                      break;
                  case 'NM'://Nautical miles
                        $toNauticalMiles  = ($round == true ? round($toNauticalMiles) : round($toNauticalMiles, $decimalPoints));
                        return $toNauticalMiles;
                      break;
              }


    }

    public function allworkshopsGarages1($category = null){

        $data = [];
        $listCount = 6;
        if(\Config::get('app.locale') == 'en'){
            $language_id = 1;
        }else{
            $language_id = 2;
        }

        $data['garages'] = [];



        if(!empty($category)){

            switch ($category) {
                case 'all':
               
                    $data['garages'] = Garage::query()
                    ->join('garages_description','garages_description.garages_id' , 'garages.id')
                    ->where('garages.status', 1)
                    ->where('garages_description.language_id', $language_id)
                    ->orderBy('garages.created_at', 'DESC')
                    ->paginate($listCount);
                    //$data['garages'] =Garage::where('status', 1)->paginate($listCount);
                    break;

                case 'featured':
                       //$data['garages'] =Garage::where('status', 1)->featuredGarage()->orderBy('created_at', 'DESC')
                        $data['garages'] = Garage::featuredGarage()
                        ->join('garages_description','garages_description.garages_id' , 'garages.id')
                        ->where('garages.status', 1)
                        ->where('garages_description.language_id', $language_id)
                        ->orderBy('garages.created_at', 'DESC')
                        ->paginate($listCount);
                    break;

                case 'latest':
                        //$data['garages'] =Garage::where('status', 1)->orderBy('created_at', 'DESC')
                        $data['garages'] = Garage::featuredGarage()
                        ->join('garages_description','garages_description.garages_id' , 'garages.id')
                        ->where('garages.status', 1)
                        ->where('garages_description.language_id', $language_id)
                        ->orderBy('garages.created_at', 'DESC')
                       ->paginate($listCount);
                        
                    break;
                
                default:
                    
                     $data['garages'] = Garage::featuredGarage()
                        ->join('garages_description','garages_description.garages_id' , 'garages.id')
                        ->where('garages.status', 1)
                        ->where('garages_description.language_id', $language_id)
                        ->orderBy('garages.created_at', 'DESC')
                       ->paginate($listCount);

                    break;
            }
        }
        $data['city_filters'] = 'all';
        $data['distance_filters'] = 100;
        $data['category_filters'] = ['all'];
        $data['per_page'] =  ($data['garages']->total() >  $listCount) ? $listCount :  $data['garages']->total();
    	return view('website::listings.all-workshops-garages', $data);
    }

    public function singleWorkshopsGarages1($slug = null){

    	
		$garage = Garage::where('slug', $slug)->first();
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
             //dump( $garage_sub_cat_ids);
            // dump( $garage_cat_ids);

            // get the database categories
            $finalGarageCategories = $finalGarageSubCategories = [];
            if(isset($cat_id_arr) && count($cat_id_arr) > 0 && count($sub_cat_id_arr) > 0){
                $subCats = $mainCats = [];
                $categories = Section::where('status', 1)->get();
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
               
            $data['garageServices'] = [
                'mainCats' => $finalGarageCategories,
                'subCats' => $finalGarageSubCategories,
            ];
            $data['garageimages'] = GarageImage::where('garage_id', $garage->id)->get();  
            $data['garageVideos'] = GarageVideo::where('garage_id', $garage->id)->get();  
            //dump($garageimages);
            // dump($data['garageVideos']);die;
            $data['garageworkingHours'] = GarageWorkingHour::where('garage_id', $garage->id)->first();
			$data['garage'] = $garage;
			return view('website::listings.single-workshops-garages', $data);
		}
    	return view('website::pages.404');
    	
    }


}
