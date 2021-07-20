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




class ThemeController extends Controller
{

	public function theme(){
		$index = new Index();
		$data = $index->finalTheme();
		$header_id = $data->header;
		//$carousel_id = $data->carousel;
		//$banner_id = $data->banner;
		$footer_id = $data->footer;
		$cart= $data->cart;
		$blog = $data->news;
		$detail = $data->detail;
		$shop = $data->shop;
		$contact = $data->contact;
		//$product_section_order = $data->product_section_order;
		$header =  $this->setHeader(1);
		$mobileheader =  $this->mobileHeader();
		//$carousel =  $this->setCarousal($carousel_id);
		//$banner =  $this->setBanner($banner_id);
		$footer =  $this->setFooter(1);
		$mobilefooter =  $this->mobileFooter();
		$final_theme = array();
		$final_theme = array('header' => $header,
	                       'mobile_header' => $mobileheader,
												// 'carousel' => $carousel,
												// 'banner' => $banner,
												 'footer' => $footer,
												 'mobile_footer' => $mobilefooter,
												 'cart' => $cart,
												 'blog' => $blog,
												 'detail' => $detail,
												 'shop' => $shop,
												 'contact' => $contact,
												// 'product_section_order' => $product_section_order
												 );

		return $final_theme;
	}


	private function setHeader($header_id){
			$index = new Index();
			$languages = new Languages();
			$products = new Products();
			$currencies = new Currency();

			$languages = $languages->languages();
			$currencies = $currencies->getter();
			//$productcategories = $products->productCategories();
			if(Auth::guard('customer')->check()){
				$count	= $index->compareCount();
			}else{
				$count="";
			}
			$title = array('pageTitle' => Lang::get("website.Home"));
			$result = array();
			$result['commonContent'] = $index->commonContent();

			$header = (string)View::make('website.headers.headerOne',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'result' => $result])->render();

			return $header;
	}

	private function mobileHeader(){
			$index = new Index();
			$languages = new Languages();
			$products = new Products();
			$currencies = new Currency();

			$languages = $languages->languages();
			$currencies = $currencies->getter();
			$productcategories = $products->productCategories();
			if(Auth::guard('customer')->check()){
			$count	= $index->compareCount();
		}else{
			$count="";
		}
			$title = array('pageTitle' => Lang::get("website.Home"));
			$result = array();
			$result['commonContent'] = $index->commonContent();
			$header = (string)View::make('website.headers.mobile',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			return $header;
	}

	private function setFooter($footer_id){
		$index = new Index();
		$newss = new News();
		$products = new Products();
		$result['commonContent'] = $index->commonContent();
		$categories_id = '';
		$categories_name = '';
		$limit = 16;
    	$type = '';
		$data = array('page_number'=>0, 'type'=>$type, 'is_feature'=>'', 'limit'=>$limit, 'categories_id'=>$categories_id, 'load_news'=>0);
		$news = $newss->getAllNews($data);
		$result['news'] = $news;
		$result['categories'] = $products->categories();

		$footer = (string)View::make('website.footers.footer1',['result' => $result])->render();
		return $footer;
	}

	private function mobileFooter(){
		$index = new Index();
		$result['commonContent'] = $index->commonContent();
		$footer = (string)View::make('website.footers.mobile',['result' => $result])->render();
		return $footer;
	}

	private function setCarousal($carousel_id){
		$languages = new Languages();
		$products = new Products();
		$currencies = new Currency();
		$index = new Index();
		$result['commonContent'] = $index->commonContent();
		$currentDate = Carbon\Carbon::now();
		$currentDate = $currentDate->toDateTimeString();
		$slides = $index->slidesByCarousel($currentDate,$carousel_id);
		$cates = $products->productCategories1();
		$result['cat'] = $cates;

		$result['slides'] = $slides;
		if($carousel_id == 1){
			$carousel = (string)View::make('website.carousels.boot-carousel-content-full-screen',['result' => $result])->render();
		}
		elseif ($carousel_id == 2) {
			$carousel = (string)View::make('website.carousels.boot-carousel-content-full-width',['result' => $result])->render();
		}
		elseif ($carousel_id == 3) {
			$carousel = (string)View::make('website.carousels.boot-carousel-content-with-left-banner',['result' => $result])->render();
		}
		elseif ($carousel_id == 4) {

			$carousel = (string)View::make('website.carousels.boot-carousel-content-with-navigation',['result' => $result])->render();
		}
		else{
			$carousel = (string)View::make('website.carousels.boot-carousel-content-with-right-banner',['result' => $result])->render();
		}
		return $carousel;
	}

	private function setBanner($banner_id){
		$index = new Index();
		$result['commonContent'] = $index->commonContent();

		if($banner_id == 1){
			$banner = (string)View::make('website.banners.banner1',['result' => $result])->render();
		}
		elseif ($banner_id == 2) {
			$banner = (string)View::make('website.banners.banner2',['result' => $result])->render();
		}
		elseif ($banner_id == 3) {
			$banner = (string)View::make('website.banners.banner3',['result' => $result])->render();
		}
		elseif ($banner_id == 4) {
			$banner = (string)View::make('website.banners.banner4',['result' => $result])->render();
		}
		elseif ($banner_id == 5) {
			$banner = (string)View::make('website.banners.banner5',['result' => $result])->render();
		}
		elseif ($banner_id == 6) {
			$banner = (string)View::make('website.banners.banner6',['result' => $result])->render();
		}
		elseif ($banner_id == 7) {
			$banner = (string)View::make('website.banners.banner7',['result' => $result])->render();
		}
		elseif ($banner_id == 8) {
			$banner = (string)View::make('website.banners.banner8',['result' => $result])->render();
		}
		elseif ($banner_id == 9) {
			$banner = (string)View::make('website.banners.banner9',['result' => $result])->render();
		}
		elseif ($banner_id == 10) {
			$banner = (string)View::make('website.banners.banner10',['result' => $result])->render();
		}
		elseif ($banner_id == 11) {
			$banner = (string)View::make('website.banners.banner11',['result' => $result])->render();
		}
		elseif ($banner_id == 12) {
			$banner = (string)View::make('website.banners.banner12',['result' => $result])->render();
		}
		elseif ($banner_id == 13) {
			$banner = (string)View::make('website.banners.banner13',['result' => $result])->render();
		}
		elseif ($banner_id == 14) {
			$banner = (string)View::make('website.banners.banner14',['result' => $result])->render();
		}
		elseif ($banner_id == 15) {
			$banner = (string)View::make('website.banners.banner15',['result' => $result])->render();
		}
		elseif ($banner_id == 16) {
			$banner = (string)View::make('website.banners.banner16',['result' => $result])->render();
		}
		elseif ($banner_id == 17) {
			$banner = (string)View::make('website.banners.banner17',['result' => $result])->render();
		}
		elseif ($banner_id == 18) {
			$banner = (string)View::make('website.banners.banner18',['result' => $result])->render();
		}
		elseif ($banner_id == 19) {
			$banner = (string)View::make('website.banners.banner19',['result' => $result])->render();
		}
		else{
			$banner = (string)View::make('website.banners.banner20',['result' => $result])->render();
		}
		return $banner;
	}


}
