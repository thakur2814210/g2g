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




class ThemeController extends Controller
{

	public function theme(){
		$index = new Index();
		$data = $index->finalTheme();
		$header_id = $data->header;
		$carousel_id = $data->carousel;
		$banner_id = $data->banner;
		$footer_id = $data->footer;
		$cart= $data->cart;
		$blog = $data->news;
		$detail = $data->detail;
		$shop = $data->shop;
		$contact = $data->contact;
		$product_section_order = $data->product_section_order;
		$header =  $this->setHeader($header_id);
		$mobileheader =  $this->mobileHeader();
		$carousel =  $this->setCarousal($carousel_id);
		$banner =  $this->setBanner($banner_id);
		$footer =  $this->setFooter($footer_id);
		$mobilefooter =  $this->mobileFooter();
		$final_theme = array();
		$final_theme = array('header' => $header,
	                       'mobile_header' => $mobileheader,
												 'carousel' => $carousel,
												 'banner' => $banner,
												 'footer' => $footer,
												 'mobile_footer' => $mobilefooter,
												 'cart' => $cart,
												 'blog' => $blog,
												 'detail' => $detail,
												 'shop' => $shop,
												 'contact' => $contact,
												 'product_section_order' => $product_section_order
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
			$productcategories = $products->productCategories();
			if(Auth::guard('customer')->check()){
			$count	= $index->compareCount();
		}else{
			$count="";
		}
			$title = array('pageTitle' => Lang::get("website.Home"));
			$result = array();
			$result['commonContent'] = $index->commonContent();

			if($header_id == 1){

				$header = (string)View::make('autoshop.headers.headerOne',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 2) {
				$header = (string)View::make('autoshop.headers.headerTwo',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 3) {
				$header = (string)View::make('autoshop.headers.headerThree',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 4) {
				$header = (string)View::make('autoshop.headers.headerFour',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 5) {
				$header = (string)View::make('autoshop.headers.headerFive',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 6) {
				$header = (string)View::make('autoshop.headers.headerSix',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 7) {
				$header = (string)View::make('autoshop.headers.headerSeven',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 8) {
				$header = (string)View::make('autoshop.headers.headerEight',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			elseif ($header_id == 9) {
				$header = (string)View::make('autoshop.headers.headerNine',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
			else{
				$header = (string)View::make('autoshop.headers.headerTen',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			}
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
			$header = (string)View::make('autoshop.headers.mobile',['count'=>$count,'currencies'=> $currencies,'languages' => $languages,'productcategories' => $productcategories,'result' => $result])->render();
			return $header;
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
			$carousel = (string)View::make('autoshop.carousels.boot-carousel-content-full-screen',['result' => $result])->render();
		}
		elseif ($carousel_id == 2) {
			$carousel = (string)View::make('autoshop.carousels.boot-carousel-content-full-width',['result' => $result])->render();
		}
		elseif ($carousel_id == 3) {
			$carousel = (string)View::make('autoshop.carousels.boot-carousel-content-with-left-banner',['result' => $result])->render();
		}
		elseif ($carousel_id == 4) {

			$carousel = (string)View::make('autoshop.carousels.boot-carousel-content-with-navigation',['result' => $result])->render();
		}
		else{
			$carousel = (string)View::make('autoshop.carousels.boot-carousel-content-with-right-banner',['result' => $result])->render();
		}
		return $carousel;
	}

	private function setBanner($banner_id){
		$index = new Index();
		$result['commonContent'] = $index->commonContent();

		if($banner_id == 1){
			$banner = (string)View::make('autoshop.banners.banner1',['result' => $result])->render();
		}
		elseif ($banner_id == 2) {
			$banner = (string)View::make('autoshop.banners.banner2',['result' => $result])->render();
		}
		elseif ($banner_id == 3) {
			$banner = (string)View::make('autoshop.banners.banner3',['result' => $result])->render();
		}
		elseif ($banner_id == 4) {
			$banner = (string)View::make('autoshop.banners.banner4',['result' => $result])->render();
		}
		elseif ($banner_id == 5) {
			$banner = (string)View::make('autoshop.banners.banner5',['result' => $result])->render();
		}
		elseif ($banner_id == 6) {
			$banner = (string)View::make('autoshop.banners.banner6',['result' => $result])->render();
		}
		elseif ($banner_id == 7) {
			$banner = (string)View::make('autoshop.banners.banner7',['result' => $result])->render();
		}
		elseif ($banner_id == 8) {
			$banner = (string)View::make('autoshop.banners.banner8',['result' => $result])->render();
		}
		elseif ($banner_id == 9) {
			$banner = (string)View::make('autoshop.banners.banner9',['result' => $result])->render();
		}
		elseif ($banner_id == 10) {
			$banner = (string)View::make('autoshop.banners.banner10',['result' => $result])->render();
		}
		elseif ($banner_id == 11) {
			$banner = (string)View::make('autoshop.banners.banner11',['result' => $result])->render();
		}
		elseif ($banner_id == 12) {
			$banner = (string)View::make('autoshop.banners.banner12',['result' => $result])->render();
		}
		elseif ($banner_id == 13) {
			$banner = (string)View::make('autoshop.banners.banner13',['result' => $result])->render();
		}
		elseif ($banner_id == 14) {
			$banner = (string)View::make('autoshop.banners.banner14',['result' => $result])->render();
		}
		elseif ($banner_id == 15) {
			$banner = (string)View::make('autoshop.banners.banner15',['result' => $result])->render();
		}
		elseif ($banner_id == 16) {
			$banner = (string)View::make('autoshop.banners.banner16',['result' => $result])->render();
		}
		elseif ($banner_id == 17) {
			$banner = (string)View::make('autoshop.banners.banner17',['result' => $result])->render();
		}
		elseif ($banner_id == 18) {
			$banner = (string)View::make('autoshop.banners.banner18',['result' => $result])->render();
		}
		elseif ($banner_id == 19) {
			$banner = (string)View::make('autoshop.banners.banner19',['result' => $result])->render();
		}
		else{
			$banner = (string)View::make('autoshop.banners.banner20',['result' => $result])->render();
		}
		return $banner;
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

		if($footer_id == 1){
			$footer = (string)View::make('autoshop.footers.footer1',['result' => $result])->render();
		}
		elseif ($footer_id == 2) {
			$footer = (string)View::make('autoshop.footers.footer2',['result' => $result])->render();
		}
		elseif ($footer_id == 3) {
			$footer = (string)View::make('autoshop.footers.footer3',['result' => $result])->render();
		}
		elseif ($footer_id == 4) {
			$footer = (string)View::make('autoshop.footers.footer4',['result' => $result])->render();
		}
		elseif ($footer_id == 5) {
			$footer = (string)View::make('autoshop.footers.footer5',['result' => $result])->render();
		}
		elseif ($footer_id == 6) {
			$footer = (string)View::make('autoshop.footers.footer6',['result' => $result])->render();
		}
		elseif ($footer_id == 7) {
			$footer = (string)View::make('autoshop.footers.footer7',['result' => $result])->render();
		}
		elseif ($footer_id == 8) {
			$footer = (string)View::make('autoshop.footers.footer8',['result' => $result])->render();
		}
		elseif ($footer_id == 9) {
			$footer = (string)View::make('autoshop.footers.footer9',['result' => $result])->render();
		}
		else{
			$footer = (string)View::make('autoshop.footers.footer10',['result' => $result])->render();
		}
		return $footer;
	}

	private function mobileFooter(){
		$index = new Index();
		$result['commonContent'] = $index->commonContent();
		$footer = (string)View::make('autoshop.footers.mobile',['result' => $result])->render();
		return $footer;
	}

}
