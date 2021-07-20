<?php
namespace App\Http\Controllers\Autoshop;
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
	/*********************************************************************/
 /**                   GENERAL CONTENT TO DISPLAY                    **/
/*********************************************************************/
		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$title = array('pageTitle' => Lang::get("website.Home"));
/********************************************************************/

/*********************************************************************/
/**                   GENERAL SETTINGS TO FETCH PRODUCTS           **/
/*******************************************************************/

	  /**  SET LIMIT OF PRODUCTS  **/
		if(!empty($request->limit)){
			$limit = $request->limit;
		}else{
			$limit = 12;
		}

		/**  MINIMUM PRICE **/
		if(!empty($request->min_price)){
			$min_price = $request->min_price;
		}else{
			$min_price = '';
		}

		/**  MAXIMUM PRICE  **/
		if(!empty($request->max_price)){
			$max_price = $request->max_price;
		}else{
			$max_price = '';
		}
/*************************************************************************/
		/*********************************************************************/
	 /**                     FETCH NEWEST PRODUCTS                       **/
	/*********************************************************************/

		$data = array('page_number'=>'0', 'type'=>'', 'limit'=>12, 'min_price'=>$min_price, 'max_price'=>$max_price );
		$newest_products = $this->products->products($data);
		$result['products'] = $newest_products;
		/*********************************************************************/
	 /**                     Compare Counts                              **/
	/*********************************************************************/

/*********************************************************************/

   /***************************************************************/
	/**   CART ARRAY RECORDS TO CHECK WETHER OR NOT DISPLAYED--   **/
 /**  --PRODUCT HAS BEEN ALREADY ADDE TO CART OR NOT           **/
/***************************************************************/
		$cart = '';
		$result['cartArray'] = $this->products->cartIdArray($cart);
/**************************************************************/

//special products
$data = array('page_number'=>'0', 'type'=>'special', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price );
$special_products = $this->products->products($data);
$result['special'] = $special_products;
//Flash sale

$data = array('page_number'=>'0', 'type'=>'flashsale', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price );
$flash_sale = $this->products->products($data);
$result['flash_sale'] = $flash_sale;
// //top seller
$data = array('page_number'=>'0', 'type'=>'topseller', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price );
$top_seller = $this->products->products($data);
$result['top_seller'] = $top_seller;

//most liked
$data = array('page_number'=>'0', 'type'=>'mostliked', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price );
$most_liked = $this->products->products($data);
$result['most_liked'] = $most_liked;


//is feature
$data = array('page_number'=>'0', 'type'=>'is_feature', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price );
$featured = $this->products->products($data);
$result['featured'] = $featured;

$data = array('page_number'=>'0', 'type'=>'', 'limit'=>3, 'is_feature'=>1);
$news =$this->news->getAllNews($data);
$result['news'] = $news;
//current time

$currentDate = Carbon\Carbon::now();
$currentDate = $currentDate->toDateTimeString();


    $slides = $this->index->slides($currentDate);
    $result['slides'] = $slides;
		//liked products
		$result['liked_products'] = $this->products->likedProducts();

    $orders = $this->order->getOrders();
		if(count($orders)>0){
			$allOrders = $orders;
		}else{
			$allOrders =  $this->order->allOrders();
		}

		$temp_i = array();
		foreach($allOrders as $orders_data){
			$mostOrdered = $this->order->mostOrders($orders_data);
			foreach($mostOrdered as $mostOrderedData){
				$temp_i[] = $mostOrderedData->products_id;
			}
		}
		$detail = array();
		$temp_i = array_unique($temp_i);
		foreach($temp_i as $temp_data){
			$data = array('page_number'=>'0', 'type'=>'', 'products_id'=>$temp_data, 'limit'=>7, 'min_price'=>'', 'max_price'=>'');
			$single_product = $this->products->products($data);
			if(!empty($single_product['product_data'][0])){
				$detail[] = $single_product['product_data'][0];
			}
		}

		$result['weeklySoldProducts'] = array('success'=>'1', 'product_data'=>$detail,  'message'=>"Returned all products.", 'total_record'=>count($detail));
		return view("autoshop.index",['title' => $title,'final_theme' => $final_theme])->with(['result' => $result]);
	}

	public function maintance(){
		return view('errors.maintance');
	}

	public function error(){
		return view('errors.general_error',['msg' => $msg]);
	}

	public function logout(){
		Auth::guard('customer')->logout();
		return redirect()->back();
	}
	public function test(){
		$productcategories = $this->products->productCategories1();
		echo print_r($productcategories);

	}

	private function setHeader($header_id){
		$count	= $this->order->countCompare();
		$languages = $this->languages->languages();
		$currencies = $this->currencies->getter();
		$productcategories = $this->products->productCategories();
		$title = array('pageTitle' => Lang::get("website.Home"));
		$result = array();
		$result['commonContent'] = $this->index->commonContent();

		if($header_id == 1){

			$header = (string)View::make('autoshop.headers.headerOne',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
		}
		elseif ($header_id == 2) {
			$header = (string)View::make('autoshop.headers.headerTwo');
		}
		elseif ($header_id == 3) {
			$header = (string)View::make('autoshop.headers.headerThree')->render();
		}
		elseif ($header_id == 4) {
			$header = (string)View::make('autoshop.headers.headerFour')->render();
		}
		elseif ($header_id == 5) {
			$header = (string)View::make('autoshop.headers.headerFive')->render();
		}
		elseif ($header_id == 6) {
			$header = (string)View::make('autoshop.headers.headerSix')->render();
		}
		elseif ($header_id == 7) {
			$header = (string)View::make('autoshop.headers.headerSeven')->render();
		}
		elseif ($header_id == 8) {
			$header = (string)View::make('autoshop.headers.headerEight')->render();
		}
		elseif ($header_id == 9) {
			$header = (string)View::make('autoshop.headers.headerNine')->render();
		}
		else{
			$header = (string)View::make('autoshop.headers.headerTen')->render();
		}
		return $header;
	}

	private function setBanner($banner_id){
		if($banner_id == 1){
			$banner = (string)View::make('autoshop.banners.banner1')->render();
		}
		elseif ($banner_id == 2) {
			$banner = (string)View::make('autoshop.banners.banner2')->render();
		}
		elseif ($banner_id == 3) {
			$banner = (string)View::make('autoshop.banners.banner3')->render();
		}
		elseif ($banner_id == 4) {
			$banner = (string)View::make('autoshop.banners.banner4')->render();
		}
		elseif ($banner_id == 5) {
			$banner = (string)View::make('autoshop.banners.banner5')->render();
		}
		elseif ($banner_id == 6) {
			$banner = (string)View::make('autoshop.banners.banner6')->render();
		}
		elseif ($banner_id == 7) {
			$banner = (string)View::make('autoshop.banners.banner7')->render();
		}
		elseif ($banner_id == 8) {
			$banner = (string)View::make('autoshop.banners.banner8')->render();
		}
		elseif ($banner_id == 9) {
			$banner = (string)View::make('autoshop.banners.banner9')->render();
		}
		elseif ($banner_id == 10) {
			$banner = (string)View::make('autoshop.banners.banner10')->render();
		}
		elseif ($banner_id == 11) {
			$banner = (string)View::make('autoshop.banners.banner11')->render();
		}
		elseif ($banner_id == 12) {
			$banner = (string)View::make('autoshop.banners.banner12')->render();
		}
		elseif ($banner_id == 13) {
			$banner = (string)View::make('autoshop.banners.banner13')->render();
		}
		elseif ($banner_id == 14) {
			$banner = (string)View::make('autoshop.banners.banner14')->render();
		}
		elseif ($banner_id == 15) {
			$banner = (string)View::make('autoshop.banners.banner15')->render();
		}
		elseif ($banner_id == 16) {
			$banner = (string)View::make('autoshop.banners.banner16')->render();
		}
		elseif ($banner_id == 17) {
			$banner = (string)View::make('autoshop.banners.banner17')->render();
		}
		elseif ($banner_id == 18) {
			$banner = (string)View::make('autoshop.banners.banner18')->render();
		}
		elseif ($banner_id == 19) {
			$banner = (string)View::make('autoshop.banners.banner19')->render();
		}
		else{
			$banner = (string)View::make('autoshop.banners.banner20')->render();
		}
		return $banner;
	}

	private function setFooter($footer_id){
		if($footer_id == 1){
			$footer = (string)View::make('autoshop.footers.footer1')->render();
		}
		elseif ($footer_id == 2) {
			$footer = (string)View::make('autoshop.footers.footer2')->render();
		}
		elseif ($footer_id == 3) {
			$footer = (string)View::make('autoshop.footers.footer3')->render();
		}
		elseif ($footer_id == 4) {
			$footer = (string)View::make('autoshop.footers.footer4')->render();
		}
		elseif ($footer_id == 5) {
			$footer = (string)View::make('autoshop.footers.footer5')->render();
		}
		elseif ($footer_id == 6) {
			$footer = (string)View::make('autoshop.footers.footer6')->render();
		}
		elseif ($footer_id == 7) {
			$footer = (string)View::make('autoshop.footers.footer7')->render();
		}
		elseif ($footer_id == 8) {
			$footer = (string)View::make('autoshop.footers.footer8')->render();
		}
		elseif ($footer_id == 9) {
			$footer = (string)View::make('autoshop.footers.footer9')->render();
		}
		else{
			$footer = (string)View::make('autoshop.footers.footer10')->render();
		}
		return $footer;
	}
	//page
	public function page(Request $request){

		$pages = $this->order->getPages($request);
		if(count($pages)>0){
			$title = array('pageTitle' => $pages[0]->name);
			$final_theme = $this->theme->theme();
			$result['commonContent'] = $this->index->commonContent();
			$result['pages'] = $pages;
			return view("autoshop.page", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);

		}else{
			return redirect()->intended('/') ;
		}
	}
	//myContactUs
	public function contactus(Request $request){
		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();
		$final_theme = $this->theme->theme();
		$result['commonContent'] = $this->index->commonContent();

		return view("autoshop.contact-us", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
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

}
