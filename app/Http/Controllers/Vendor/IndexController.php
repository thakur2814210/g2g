<?php
namespace App\Http\Controllers\Vendor;
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

use App\GarageService;
use App\GarageWorkingHour;
use App\ServicePackageFeature;
use App\Section;
use App\City;
use App\ClientPackageSubscribe;
use App\GaragePackageSubscribe;
use App\Models\Core\User;

use Illuminate\Pagination\LengthAwarePaginator;


class IndexController extends Controller
{

	public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

	public function index(){


      
		$pageTitle              =      Lang::get("labels.title_dashboard");
        $language_id      =     '1';

        $result           =     array();
        $vendors = auth()->guard('vendor')->user();
        $vendors_id =  $vendors->id;
        $vendor = DB::table('vendor_details')->where('vendor_details.user_id', $vendors->id)->first();
        $result['current_balance'] = number_format($vendor->balance,2);

        //recently order placed
        $orders = DB::table('orders')
            ->LeftJoin('currencies', 'currencies.code', '=', 'orders.currency')
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
        
        $users = array();         
         
        $result['customers'] = $users;//->chunk(21);
        $result['totalCustomers'] = count($users);
        $result['reportBase'] = null;

        $result['commonContent'] = $this->Setting->commonContent();

        $data = [];
        $garage = Garage::where('user_id', $vendors_id)->first();
        $c_clientPackageSubscribe = ClientPackageSubscribe::where('garage_id', $garage->id)->count();
        $c_garagePackageSubscribe = GaragePackageSubscribe::where('garage_id', $garage->id)->count();

        $count = [
                'c_clientPackageSubscribe' => $c_clientPackageSubscribe,
                'c_garagePackageSubscribe' => $c_garagePackageSubscribe,
        ];
       
        return view("garage.dashboard",['pageTitle' => $pageTitle , 'counts' => $count])->with('result', $result);
        
	}

	public function maintance(){
		return view('errors.maintance');
	}

	public function error(){
		return view('errors.general_error',['msg' => $msg]);
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

    //logout
    public function logout(){
        \Auth::guard(\Auth::getDefaultDriver())->logout();
        return redirect('/');
    }


    


	
	
    


}
