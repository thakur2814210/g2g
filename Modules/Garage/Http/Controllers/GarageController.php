<?php

namespace Modules\Garage\Http\Controllers;

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
use App\Models\Autoshop\Currency;

use App\Models\Core\Setting;
use App\Language;
use App\Faq;
use App\ContactUs;
use App\Client;
use App\Garage;
use App\GaragesDescription;
use App\GarageTeam;
use App\GarageImage;
use App\GarageVideo;
use App\GarageService;
use App\GarageWorkingHour;
use App\PageContent;
use App\Testimonial;
use App\ServicePackage;
use App\Country;
use App\ServicePackageFeature;
use App\Section;
use App\City;
use App\ClientPackageSubscribe;
use App\GaragePackageSubscribe;
use App\Models\Core\User;
use Image;
use Illuminate\Pagination\LengthAwarePaginator;

class GarageController extends Controller
{
    public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }
    // Garage Dahsboard
    public function dashboard()
    {

        $result = array();
        $pageTitle  =  Lang::get("labels.title_dashboard");
        $language_id = '1';

        $loggedInUser = auth()->user();

        //$garage_vendor_relation = 
        $garages = DB::table('garages')->where('user_id',$loggedInUser->id)->first();
        if(empty($garages))
            abort(403);

        $result['garage_vendor_type'] = $garages->type;
        $result['c_clientPackageSubscribe'] = ClientPackageSubscribe::where('garage_id', $garages->id)->count();
        $result['c_garagePackageSubscribe'] = GaragePackageSubscribe::where('garage_id', $garages->id)->count();

        
        //$vendors = auth()->guard('vendor')->user();
        $vendors_id =  $loggedInUser->id;
        $vendor = DB::table('vendor_details')->where('user_id', $loggedInUser->id)->first();
        $result['current_balance'] = isset($vendor->balance) ? number_format($vendor->balance,2): '0.00';

        //recently order placed
        $orders = DB::table('orders')
            ->LeftJoin('currencies', 'currencies.code', '=', 'orders.currency')
            ->LeftJoin('orders_products', 'orders_products.orders_id', '=', 'orders.orders_id')
             ->when($vendors_id, function($query) use ($vendors_id){
                    if(!is_null($vendors_id))
                        return $query->where('orders_products.vendors_id', $vendors_id);
                })
            ->where('customers_id','!=','')
            ->orderBy('date_purchased','DESC')
            ->get();


        $index = 0;
        $purchased_price = 0;
        $sold_cost = 0;
        
        foreach($orders as $orders_data){

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status_description.language_id', '=', $language_id)
                ->orderby('orders_status_history.date_added', 'DESC')->first();

            $orders[$index]->orders_status_id = $orders_status_history->orders_status_id;
            $orders[$index]->orders_status = $orders_status_history->orders_status_name;

            

            $orders_products = DB::table('orders_products')
                ->select('final_price', DB::raw('SUM(final_price) as total_price') ,'products_id','products_quantity' )
                ->where('orders_id', '=' ,$orders_data->orders_id)
                ->when($vendors_id, function($query) use ($vendors_id){
                    if(!is_null($vendors_id))
                        return $query->where('orders_products.vendors_id', $vendors_id);
                })
                ->groupBy('final_price')
                ->get();

            
            if(count($orders_products)>0 and !empty($orders_products[0]->total_price)){
                $orders[$index]->total_price = $orders_products[0]->total_price;
            }else{
                $orders[$index]->total_price = 0;
            }

            if($orders_status_history->orders_status_id != 3 and $orders_status_history->orders_status_id != 4){
                foreach($orders_products as $orders_product){
                    $sold_cost += $orders_product->total_price;
                    $single_purchased_price = DB::table('inventory')->where('products_id',$orders_product->products_id)->sum('purchase_price');
                    $single_stock = DB::table('inventory')->where('products_id',$orders_product->products_id)->where('stock_type','in')->sum('stock');
                    if($single_stock>0){
                        $single_product_purchase_price = $single_purchased_price/$single_stock;
                    }else{
                        $single_product_purchase_price = 0;
                    }
                    $purchased_price += $single_product_purchase_price*$orders_product->products_quantity;
    
                }   
            }
            
            $index++;

          }
          

        //products profit
        if($purchased_price==0){
            $profit = 0;
        }else{
            $profit = abs($purchased_price - $sold_cost);
        }
        

        $result['profit'] = number_format($profit,2);
        $result['total_money'] = number_format($purchased_price,2);


        // anand 
        $result['total_sales_amount'] = number_format($sold_cost,2);

        //recently order placed
        $total_purchased_price = DB::table('products')
            ->join('inventory', 'inventory.products_id', '=', 'products.products_id')
            ->when($vendors_id, function($query) use ($vendors_id){
                if(!is_null($vendors_id))
                    return $query->where('products.vendors_id', $vendors_id);
            })
            ->where('stock_type', 'in')
            ->sum('inventory.purchase_price');

        $result['total_purchased_price'] = number_format($total_purchased_price,2);
        
        $compeleted_orders = 0;
        $pending_orders = 0;
        foreach($orders as $orders_data){

            if($orders_data->orders_status_id=='2')
            {
                $compeleted_orders++;
            }
            if($orders_data->orders_status_id=='1')
            {
                $pending_orders++;
            }
          }
        
        
        $result['orders'] = $orders->chunk(10);
        $result['pending_orders'] = $pending_orders;
        $result['compeleted_orders'] = $compeleted_orders;
        $result['total_orders'] = count($orders);
          

        $result['inprocess'] = count($orders)-$pending_orders-$compeleted_orders;
        //add to cart orders
        $cart = DB::table('customers_basket')->get();

        $result['cart'] = count($cart);
          
        //Rencently added products
        $recentProducts = DB::table('products')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->leftJoin('products_description','products_description.products_id','=','products.products_id')
            ->select('products.*', 'products_description.*', 'image_categories.path as products_image')
            ->where('products_description.language_id','=', $language_id)
            ->when($vendors_id, function($query) use ($vendors_id){
                if(!is_null($vendors_id))
                    return $query->where('products.vendors_id', $vendors_id);
            })
            ->orderBy('products.products_id', 'DESC')
            ->paginate(8);

        $result['recentProducts'] = $recentProducts;
          
        //products
        $products = DB::table('products')
            ->leftJoin('products_description','products_description.products_id','=','products.products_id')
            ->where('products_description.language_id','=', $language_id)
            ->orderBy('products.products_id', 'DESC')
            ->when($vendors_id, function($query) use ($vendors_id){
                if(!is_null($vendors_id))
                    return $query->where('products.vendors_id', $vendors_id);
            })
            ->get();

            
        //low products & out of stock
        $lowLimit = 0;
        $outOfStock = 0;
        //$total_money = 0;
        $products_ids = array();
        $data = array();
        foreach($products as $products_data){
            $currentStocks = DB::table('inventory')->where('products_id',$products_data->products_id)->get();
            if(count($currentStocks)>0){
                if($products_data->products_type!=1){
                    $c_stock_in = DB::table('inventory')->where('products_id',$products_data->products_id)->where('stock_type','in')->sum('stock');
                    $c_stock_out = DB::table('inventory')->where('products_id',$products_data->products_id)->where('stock_type','out')->sum('stock');

                    if(($c_stock_in-$c_stock_out)==0){
                        if(!in_array($products_data->products_id, $products_ids)){
                            $products_ids[] = $products_data->products_id;

                            array_push($data,$products_data);
                            $outOfStock++;
                        }
                    }
                }

            }else{
                $outOfStock++;
            }
        }
          
        $result['lowLimit'] = $lowLimit;
        $result['outOfStock'] = $outOfStock;
        $result['totalProducts'] = count($products);
        
        $result['reportBase'] = null;

        $result['commonContent'] = $this->Setting->commonContent();

       
        return view("garage::dashboard.index",['pageTitle' => $pageTitle])->with('result', $result);

        /*
        // let get the count...
        $sr_customer_count = ServiceRequest::where('garage_id', Auth::user()->id)
                                    ->select('client_id', \DB::raw('count(*) as total'))
                                    ->groupBy('client_id')
                                    ->get();
        $ps_customer_count = ClientPackageSubscribe::where('garage_id', Auth::user()->id)
                                    ->select('client_id', \DB::raw('count(*) as total'))
                                    ->groupBy('client_id')
                                    ->get();


        $data['sr_customer_count'] = $sr_customer_count->count();
        $data['ps_customer_count'] = $ps_customer_count->count();


        // get total unique customers....
        $sr_customers = ServiceRequest::where('garage_id', Auth::user()->id)->get();
        $ps_customers = ClientPackageSubscribe::where('garage_id', Auth::user()->id)->get();

        $unique_customer_ids = [];
        foreach ( $sr_customers as  $sr_customer) {
            if(!in_array($sr_customer->client_id, $unique_customer_ids)){
                $unique_customer_ids[] = $sr_customer->client_id;
            }
        }

        foreach ( $ps_customers as  $ps_customer) {
            if(!in_array($ps_customer->client_id, $unique_customer_ids)){
                $unique_customer_ids[] = $ps_customer->client_id;
            }
        }
        $data['total_customer'] = count($unique_customer_ids);

        // get total payments
        $cps_payments = ClientPackageSubscribe::where('garage_id', Auth::user()->id)
                        ->join('client_package_subscribe_payments' , 'client_package_subscribe_payments.client_package_subscribe_id' , 'client_package_subscribe.id')
                        ->where('client_package_subscribe_payments.status' , 1)->sum('client_package_subscribe_payments.amount');

        $csr_payments = ServiceRequest::where('garage_id', Auth::user()->id)
                        ->join('service_request_payment' , 'service_request_payment.service_request_id' , 'service_request.id')
                        ->where('service_request_payment.status' , 1)->sum('service_request_payment.amount');

        $data['payments_recieved'] = number_format(round($cps_payments, 2) + round($csr_payments, 2), 2) ;
        return view('garage::dashboard.index', $data);
        */
    }

    public function logout(){
        Auth::guard(\Auth::getDefaultDriver())->logout();
        return redirect('/');
    }

    public function garage(){
        
        $user_id =  Auth::user()->id;
        $garage = Garage::where('user_id',$user_id )->where('type','!=',2)->first();
        if(!empty($garage)){
            return \Redirect::route('garage.edit');
        }else{
            return \Redirect::route('garage.add');
        }

    }

    public function add()
    {

        $garage = Garage::where('user_id', Auth::user()->id )->where('type','!=',2)->first();
        if(!empty($garage)){
            return \Redirect::route('garage.edit');
        }



        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['cities'] = City::where('status',1)->get();
        $data['countries'] = Country::where('status',1)->get();

        $subCats = $mainCats = [];
        $categories = Section::where('status', 1)->get();
        if(!$categories->isEmpty()){
            $categories = $categories->toArray();
            foreach ($categories as $cat) {
                if($cat['parent'] == 0){
                    $mainCats[$cat['id']] =  $cat;
                }else{
                     $subCats[$cat['parent']][] = $cat;
                }
            }
        }
        $data['catList'] = [
            'mainCats' => $mainCats,
            'subCats' => $subCats,
        ];
        return view('garage::garage.add-garage', $data)->with('result', $result);
    }

    public function edit(){
      
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $language_id = 1;
        $garages = Garage::where('garages.user_id', Auth::user()->id)->first();
        //dd($garages );
        //dd($garages);die;
        if(!empty($garages)){

            
            $data['cities'] = City::where('status',1)->get();
            $data['countries'] = Country::where('status',1)->get();

            $subCats = $mainCats = [];
            $categories = Section::where('status', 1)->get();
            if(!$categories->isEmpty()){
                $categories = $categories->toArray();
                foreach ($categories as $cat) {
                    if($cat['parent'] == 0){
                        $mainCats[$cat['id']] =  $cat;
                    }else{
                         $subCats[$cat['parent']][] = $cat;
                    }
                }
            }
           $data['catList'] = [
                'mainCats' => $mainCats,
                'subCats' => $subCats,
           ];

           
            // 
            $data['garage_working_hours'] = GarageWorkingHour::where('garage_id', $garages->id)->first();
            $data['garage_services'] = GarageService::where('garage_id',  $garages->id)->first();
            $data['garage'] = $garages;
            $garagesDescriptions = GaragesDescription::where('garages_id',  $garages->id)->get();
           // dd($garagesDescriptions);die;
           foreach ($garagesDescriptions as  $gd) {
               if($gd->language_id == 1){
                    $data['garage']['garages_name_en'] = $gd->garages_name;
                    $data['garage']['description_en'] = $gd->garages_description;
               }
               if($gd->language_id == 2){
                
                    $data['garage']['garages_name_ar'] = $gd->garages_name;
                    $data['garage']['description_ar'] = $gd->garages_description;
               }
           }
           // dd($data['garage']);die;
           
            return view('garage::garage.garage_details', $data)->with('result', $result);
        }
        return \Redirect::back()->with('status', 'Garage does not exist !!!');

    }

 
    public function update(Request $request){
       
        $id = $request->id;
        $garage = Garage::where('id', '=', $id)->first();
        if(!empty($garage)){

            $validator = Validator::make($request->all(), [
                'garage_name_en'   =>  ['required'],
                'garage_name_ar'   =>  ['required'],
                'description_en'   =>  ['required'],
                'description_ar'   =>  ['required'],
                'slug'   =>  ['required'],
                'address'   =>  ['required'],
                'city_id'   =>  ['required'],
                'postal'   =>  ['required'],
                'country_id'   =>  ['required'],
                'latitude'   =>  ['required'],
                'longitude'   =>  ['required'],
                'owner_name'   =>  ['required'],
                'owner_phone'   =>  ['required'],
                'owner_email'   =>  ['required'],
                'owner_address'   =>  ['required']
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            $profile_image_path = $thumbnail_image_path = null;

            if ($request->hasFile('image')) {
               
                $image = request()->image;
                $input['imagename'] = 'garage-image-'.time().'.'.$image->extension();
               
                $destinationPath = public_path('uploads/garage_images/thumbnail');
                $thumbnailImage = Image::make($image->path(), array(
                    'width' => 325,
                    'height' => 215,
                    'grayscale' => false));
                $thumbnailImage->save($destinationPath.'/'.$input['imagename']);
                $thumbnail_image_path =  'uploads/garage_images/thumbnail/'.$input['imagename'];

                $destinationPath = public_path('uploads/garage_images/profile');
                $thumbnailImage = Image::make($image->path(), array(
                    'width' => 2000,
                    'height' => 600,
                    'grayscale' => false));
                $thumbnailImage->save($destinationPath.'/'.$input['imagename']);
                $profile_image_path =   'uploads/garage_images/profile/'.$input['imagename'];           

            }
               

            Garage::where('id', '=', $garage->id)
                ->update([
                'slug' =>  $request->slug,
                'address' =>  $request->address,
                'city_id' =>  $request->city_id,
                'country_id' =>  $request->country_id,
                'postal' =>  $request->postal,
                'latitude' =>  !empty($request->latitude) ? $request->latitude : null,
                'longitude' =>  !empty($request->longitude) ? $request->longitude : null,
                'owner_name' => !empty($request->owner_name) ? $request->owner_name : null,
                'owner_phone' => !empty($request->owner_phone) ? $request->owner_phone : null,
                'owner_email' => !empty($request->owner_email) ? $request->owner_email : null,
                'owner_address' => !empty($request->owner_address) ? $request->owner_address : null,
                'thumbnail_image' => !empty($thumbnail_image_path) ? $thumbnail_image_path : $garage->thumbnail_image,
                'profile_image' => !empty($profile_image_path) ? $profile_image_path : $garage->profile_image,
            ]);

            // get languages
            $languages = Language::get();
            foreach ($languages as $language) {

                $garages_name = 'garage_name_' . $language->code;
                $garages_description = 'description_' . $language->code;

                GaragesDescription::where('garages_id', '=', $garage->id)
                  ->where('language_id', '=', $language->languages_id)->update([
                      'garages_name' => $request->$garages_name,
                      'garages_description' => $request->$garages_description
                  ]);
            }

            

            return \Redirect::back()->with('status', 'Update garage information successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong! Please contact administrator.');
    }

    public function updateGarageWorkingHours(Request $request){

            $form_action = $request->form_action;
            $garage_id = $request->id;
            $mon = trim($request->ot_mon). '-' .trim($request->ct_mon);
            $tue = trim($request->ot_tue). '-' .trim($request->ct_tue);
            $wed = trim($request->ot_wed). '-' .trim($request->ct_wed);
            $thu = trim($request->ot_thu). '-' .trim($request->ct_thu);
            $fri = trim($request->ot_fri). '-' .trim($request->ct_fri);
            $sat = trim($request->ot_sat). '-' .trim($request->ct_sat);
            $sun = trim($request->ot_sun). '-' .trim($request->ct_sun);

            if($form_action == 'insert'){
               

                // create rocords for working hours
                $GarageworkingHour = new GarageWorkingHour();
                $GarageworkingHour->mon = $mon;
                $GarageworkingHour->tue = $tue;
                $GarageworkingHour->wed = $wed;
                $GarageworkingHour->thu = $thu;
                $GarageworkingHour->fri = $fri;
                $GarageworkingHour->sat = $sat;
                $GarageworkingHour->sun = $sun;
                $GarageworkingHour->garage_id = $garage_id;
                $GarageworkingHour->save();

            }elseif ($form_action == 'update') {
               GarageWorkingHour::where('garage_id', $garage_id)
                 ->update([
                    'sun' =>  $sun,
                    'mon' =>  $mon,
                    'tue' =>  $tue,
                    'wed' =>  $wed,
                    'thu' =>  $thu,
                    'fri' =>  $fri,
                    'sat' =>  $sat,
                    'sun' =>  $sun
                ]);

            }

           return \Redirect::back()->with('status', 'Update garage information successfully !!!');
    }

    public function updateGarageServices(Request $request){

            $form_action = $request->form_action;
            $garage_id = $request->id;
            // dump($request->cat_id);die;
             $cat_id = $sub_cat_id = null;
             if(!empty($request->cat_id)){
                $cat_id = (count($request->cat_id) > 0) ? implode(',', $request->cat_id) : null;
             }

            if(!empty($request->sub_cat_id)){
                $sub_cat_id = (count($request->sub_cat_id) > 0) ? implode(',', $request->sub_cat_id) : null;
            }

            if($form_action == 'insert'){

                // create garage service
                $GarageService = new GarageService();
                $GarageService->garage_id = $garage_id;
                $GarageService->cat_id = $cat_id;
                $GarageService->sub_cat_id = $sub_cat_id;
                $GarageService->save();


            }elseif ($form_action == 'update') {
                
                GarageService::where('garage_id', '=', $garage_id)
                 ->update([
                    'cat_id' =>  $cat_id ,
                    'sub_cat_id' =>  $sub_cat_id,
                ]);

            }

           return \Redirect::back()->with('status', 'Update garage information successfully !!!');
    }

    public function save(Request $request){

        
        $validator = Validator::make($request->all(), [
           
            'slug'   =>  ['required'],
            'garage_name_en'   =>  ['required'],
            'garage_name_ar'   =>  ['required'],
            'description_en'   =>  ['required'],
            'description_ar'   =>  ['required'],
            

            'address'   =>  ['required'],
            'city_id'   =>  ['required'],
            'postal'   =>  ['required'],
            'country_id'   =>  ['required'],
            'latitude'   =>  ['required'],
            'longitude'   =>  ['required'],

            'owner_name'   =>  ['required'],
            'owner_phone'   =>  ['required'],
            'owner_email'   =>  ['required'],
            'owner_address'   =>  ['required'],
            
           
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

        // Handling image...
        $profile_image_path = $thumbnail_image_path = null;
        if(!empty(request()->image)){
           
            $image = request()->image;
            $input['imagename'] = 'garage-image-'.time().'.'.$image->extension();
           
            $destinationPath = public_path('uploads/garage_images/thumbnail');
            $thumbnailImage = Image::make($image->path(), array(
                'width' => 325,
                'height' => 215,
                'grayscale' => false));
            $thumbnailImage->save($destinationPath.'/'.$input['imagename']);
            $thumbnail_image_path =  'uploads/garage_images/thumbnail/'.$input['imagename'];

            $destinationPath = public_path('uploads/garage_images/profile');
            $thumbnailImage = Image::make($image->path(), array(
                'width' => 2000,
                'height' => 600,
                'grayscale' => false));
            $thumbnailImage->save($destinationPath.'/'.$input['imagename']);
            $profile_image_path =   'uploads/garage_images/profile/'.$input['imagename'];           

        }

        // create records in garage table
        $garage = new Garage();
        $garage->user_id = auth()->user()->id;
        $garage->slug = $request->slug;
        $garage->address = $request->address;
        $garage->city_id = $request->city_id;
        $garage->postal = $request->postal;
        $garage->country_id = $request->country_id;
        $garage->latitude = $request->latitude;
        $garage->longitude = $request->longitude;

        $garage->owner_name = $request->owner_name;
        $garage->owner_phone = $request->owner_phone;
        $garage->owner_email = $request->owner_email;
        $garage->owner_address = $request->owner_address;

        $garage->status = 3;
        $garage->type = auth()->user()->garage_vendor_type;

        $garage->thumbnail_image = !empty($thumbnail_image_path) ? $thumbnail_image_path : null;
        $garage->profile_image = !empty($profile_image_path) ? $profile_image_path : null;

        if($garage->save()){

            // save name in garage description table....
            // get languages
            $languages = Language::get();
            foreach ($languages as $language) {
                
                $garagesDescription = new GaragesDescription();
                $garagesDescription->garages_id = $garage->id;
                $garagesDescription->language_id = $language->languages_id;

                $garages_name = 'garage_name_' . $language->code;
                $garages_description = 'description_' . $language->code;

                $garagesDescription->garages_name = $request->$garages_name;
                $garagesDescription->garages_description = $request->$garages_description;
                $garagesDescription->save();
            }

            return \Redirect::route('garage.information')->with('status', 'New garage created successfully !!!');
        }

        return \Redirect::back()->with('status', 'Something went wrong! Please contact administrator.');
    }

    public function viewGarageWorkingHours(){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $garage = Garage::where('garages.user_id', Auth::user()->id)->first();
        if(!empty($garage)){
            $data['garage'] = $garage;
            if(!empty($data['garage'])){
                $data['garage_working_hours'] = GarageWorkingHour::where('garage_id', $garage->id)->first();
                return view('garage::garage.garage_workign_hours', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Garage details does not exist! Please fill Garage details first.');
    }

    public function viewGarageServices(){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $garage = Garage::where('garages.user_id', Auth::user()->id)->first();
        if(!empty($garage)){
            $data['garage'] = $garage;
            if(!empty($data['garage'])){
                $subCats = $mainCats = [];
                $categories = Section::where('status', 1)->get();
                if(!$categories->isEmpty()){
                    $categories = $categories->toArray();
                    foreach ($categories as $cat) {
                        if($cat['parent'] == 0){
                            $mainCats[$cat['id']] =  $cat;
                        }else{
                             $subCats[$cat['parent']][] = $cat;
                        }
                    }
                }
                $data['catList'] = [
                    'mainCats' => $mainCats,
                    'subCats' => $subCats,
                ];
                $data['garage_services'] = GarageService::where('garage_id', $garage->id)->first();
                return view('garage::garage.garage_services', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Garage details does not exist! Please fill Garage details first.');
    }
   



    public function viewGarageTeam(){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $garage = Garage::where('garages.user_id', Auth::user()->id)->first();
        if(!empty($garage)){
            $data['garage'] = $garage;
            if(!empty($data['garage'])){
                $data['garageTeams'] = GarageTeam::where('garage_id', $garage->id)->paginate(10);
                return view('garage::garage.garage_teams', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Garage details does not exist! Please fill Garage details first.');
    }

    public function updateGarageTeam(Request $request){
        
        $garage_id = $request->garage_id;
        if(!empty($garage_id)){
            $Garage = Garage::where('id', $garage_id)->first();
            if(!empty($Garage)){

                $validator = Validator::make($request->all(), [
                    'cover_photo'   => 'required', // 'mimes:jpeg,bmp,png,gif,svg,pdf',
                    'garage_id' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'gender' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                    'postal' => 'required',
                ]);

                if ($validator->fails()) {
                    return \Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
                }

                 $imgLocations = 'assets/uploads/garage_images';
                if(!empty(request()->cover_photo)){
                    $imageName = 'galery-team-member-'.time().'.'.request()->cover_photo->getClientOriginalExtension();
                    $request->cover_photo->move($imgLocations , $imageName);
                    $cover_photo = $imageName;
                }else{
                    return \Redirect::back()->with('status', 'Image is missing.');
                }

              


                $garageTeam = new GarageTeam();
                $garageTeam->image = $cover_photo;
                $garageTeam->garage_id = $garage_id;
                $garageTeam->first_name = $request->first_name;
                $garageTeam->last_name = $request->last_name;
                $garageTeam->gender = $request->gender;
                $garageTeam->phone = $request->phone;
                $garageTeam->email = $request->email;
                $garageTeam->address = $request->address;
                $garageTeam->city = $request->city;
                $garageTeam->country = $request->country;
                $garageTeam->postal = $request->postal;

                if($garageTeam->save()){
                    return \Redirect::back()->with('status', 'New garage team member saved successfully !!!');
                }
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Garage detail id does not exist.');
    }



    public function viewGarageImage(){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $garage = Garage::where('garages.user_id', Auth::user()->id)->first();
        if(!empty($garage)){
            $data['garage'] = $garage;
            if(!empty($data['garage'])){
                $data['garageimages'] = GarageImage::where('garage_id', $garage->id)->paginate(10);
                return view('garage::garage.garage_images', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Garage details does not exist! Please fill Garage details first.');
    }

    public function updateGarageImage(Request $request){
        
        $garage_id = $request->garage_id;
        if(!empty($garage_id)){
            $Garage = Garage::where('id', $garage_id)->first();
            if(!empty($Garage)){

                $validator = Validator::make($request->all(), [
                    'cover_photo'   =>  'required',//'mimes:jpeg,bmp,png,gif,svg,pdf'
                ]);

                if ($validator->fails()) {
                    return \Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
                }

                $imgLocations = 'assets/uploads/garage_images';
                if(!empty(request()->cover_photo)){
                    $imageName = 'galery-image-'.time().'.'.request()->cover_photo->getClientOriginalExtension();
                    $request->cover_photo->move($imgLocations , $imageName);
                    $cover_photo = $imageName;
                }else{
                    return \Redirect::back()->with('status', 'Image is missing.');
                }

               /* if(!empty(request()->cover_photo)){
                    $imageName = 'galery-image-'.time().'.'.request()->cover_photo->getClientOriginalExtension();
                    $request->cover_photo->move('/assets/uploads/garage_images', $imageName);
                    $cover_photo = '/assets/uploads/garage_images/'.$imageName;
                }else{
                    return \Redirect::back()->with('status', 'Image is missing.');
                }*/


                $garageImage = new GarageImage();
                $garageImage->image = $cover_photo;
                $garageImage->garage_id = $garage_id;

                if($garageImage->save()){
                    return \Redirect::back()->with('status', 'New garage image saved successfully !!!');
                }
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Garage detail id does not exist.');
    }

    public function deleteGarageImage($id){
         
         if(!empty($id)){

            $garageImage = GarageImage::where('id', $id)->first();
            if(!empty($garageImage)){

                // delete the image from upload folder
                $old_image = 'assets/uploads/garage_images/'.$garageImage->image;
                if(\File::exists($old_image)) {
                     @unlink($old_image);
                }

                // Delete from table
                if(\DB::table('garage_images')->delete($id)){
                    return \Redirect::back()->with('status', 'Garage image deleted successfully !!!');
                }
            }
         }
         return \Redirect::back()->with('status', 'Something went wrong! Garage detail id does not exist.');
    }





    public function viewGarageVideo(){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $garage = Garage::where('garages.user_id', Auth::user()->id)->first();
        if(!empty($garage)){
            $data['garage'] = $garage;
            if(!empty($data['garage'])){
                $data['garageVideos'] = GarageVideo::where('garage_id', $garage->id)->paginate(10);
                return view('garage::garage.garage_videos', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Garage details does not exist! Please fill Garage details first.');
    }

    public function updateGarageVideo(Request $request){
        
        $garage_id = $request->garage_id;
        if(!empty($garage_id)){
            $Garage = Garage::where('id', $garage_id)->first();
            if(!empty($Garage)){

                $validator = Validator::make($request->all(), [
                    'yt_video_id'   =>  'required'
                ]);

                if ($validator->fails()) {
                    return \Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
                }

                $garageVideo = new GarageVideo();
                $garageVideo->yt_video_id = $request->yt_video_id;
                $garageVideo->garage_id = $garage_id;

                if($garageVideo->save()){
                    return \Redirect::back()->with('status', 'New garage video saved successfully !!!');
                }
            }
        }
        return \Redirect::back()->with('status', 'Something went wrong! Garage detail id does not exist.');
    }

    public function deleteGarageVideo($id){
        
        if(!empty($id)){
            $garageVideo = GarageVideo::where('id', $id)->first();
            if(!empty($garageVideo)){
                if(\DB::table('garage_videos')->delete($id)){
                    return \Redirect::back()->with('status', 'Garage video deleted successfully !!!');
                }
            }
         }
         return \Redirect::back()->with('status', 'Something went wrong! Garage detail id does not exist.');
    }




    

    


}
