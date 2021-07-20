<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Garage;
use App\GarageService;
use App\GarageWorkingHour;
use App\GarageTeam;
use App\GarageImage;
use App\GarageVideo;
use App\Section;
use App\City;
use App\Country;
use DB;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
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
    
    public function searchListings(Request $request){



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

    public function allworkshopsGarages($category = null){

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

    public function singleWorkshopsGarages($slug = null){

    	
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
      