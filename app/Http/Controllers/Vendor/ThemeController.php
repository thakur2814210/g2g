<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\Theme;
use DB;
use Illuminate\Http\Request;
use Lang;
use View;
use App\Models\Core\Setting;

class ThemeController extends Controller
{
    //

    public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

    public function moveToBanners($banner_id)
    {
        $result = array();
        $images = new Images();
        $theme = new Theme();
        $allimage = $images->getimages();
        $result['images'] = $allimage;
        $homeBanners = $theme->getBanners($banner_id);
        $result['languages'] = $homeBanners;
        if ($banner_id == 1) {
            $banner = (string) View::make('admin.banners_views.banner1', ['result' => $result])->render();
        } elseif ($banner_id == 2) {
            $banner = (string) View::make('admin.banners_views.banner2', ['result' => $result])->render();
        } elseif ($banner_id == 3) {
            $banner = (string) View::make('admin.banners_views.banner3', ['result' => $result])->render();
        } elseif ($banner_id == 4) {
            $banner = (string) View::make('admin.banners_views.banner4', ['result' => $result])->render();
        } elseif ($banner_id == 5) {
            $banner = (string) View::make('admin.banners_views.banner5', ['result' => $result])->render();
        } elseif ($banner_id == 6) {
            $banner = (string) View::make('admin.banners_views.banner6', ['result' => $result])->render();
        } elseif ($banner_id == 7) {
            $banner = (string) View::make('admin.banners_views.banner7', ['result' => $result])->render();
        } elseif ($banner_id == 8) {
            $banner = (string) View::make('admin.banners_views.banner8', ['result' => $result])->render();
        } elseif ($banner_id == 9) {
            $banner = (string) View::make('admin.banners_views.banner9', ['result' => $result])->render();
        } elseif ($banner_id == 10) {
            $banner = (string) View::make('admin.banners_views.banner10', ['result' => $result])->render();
        } elseif ($banner_id == 11) {
            $banner = (string) View::make('admin.banners_views.banner11', ['result' => $result])->render();
        } elseif ($banner_id == 12) {
            $banner = (string) View::make('admin.banners_views.banner12', ['result' => $result])->render();
        } elseif ($banner_id == 13) {
            $banner = (string) View::make('admin.banners_views.banner13', ['result' => $result])->render();
        } elseif ($banner_id == 14) {
            $banner = (string) View::make('admin.banners_views.banner14', ['result' => $result])->render();
        } elseif ($banner_id == 15) {
            $banner = (string) View::make('admin.banners_views.banner15', ['result' => $result])->render();
        } elseif ($banner_id == 16) {
            $banner = (string) View::make('admin.banners_views.banner16', ['result' => $result])->render();
        } elseif ($banner_id == 17) {
            $banner = (string) View::make('admin.banners_views.banner17', ['result' => $result])->render();
        } elseif ($banner_id == 18) {
            $banner = (string) View::make('admin.banners_views.banner18', ['result' => $result])->render();
        } elseif ($banner_id == 19) {
            $banner = (string) View::make('admin.banners_views.banner19', ['result' => $result])->render();
        } elseif ($banner_id == 20) {
            $banner = (string) View::make('admin.banners_views.carousal_banner1', ['result' => $result])->render();
        } elseif ($banner_id == 21) {
            $banner = (string) View::make('admin.banners_views.ad_banner1', ['result' => $result])->render();        
        } elseif ($banner_id == 41) {
            $banner = (string) View::make('admin.banners_views.ad_banner3', ['result' => $result])->render();
        }
        else {
            $banner = (string) View::make('admin.banners_views.ad_banner2', ['result' => $result])->render();
        }

        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin.theme.banner_images')->with('banner', $banner)->with('result', $result);
    }

    public function moveToSliders($carousal_id)
    {
        $result = array();
        $images = new Images();
        $theme = new Theme();
        $allimage = $images->getimages();
        $result['images'] = $allimage;
        $sliders = $theme->getSliders($carousal_id);
        $result['languages'] = $sliders;
        if ($carousal_id == 1) {
            $slider = (string) View::make('admin.sliders_view.carousal1', ['result' => $result])->render();
        } elseif ($carousal_id == 2) {
            $slider = (string) View::make('admin.sliders_view.carousal2', ['result' => $result])->render();
        } elseif ($carousal_id == 3) {
            $slider = (string) View::make('admin.sliders_view.carousal3', ['result' => $result])->render();
        } elseif ($carousal_id == 4) {
            $slider = (string) View::make('admin.sliders_view.carousal4', ['result' => $result])->render();
        } else {
            $slider = (string) View::make('admin.sliders_view.carousal5', ['result' => $result])->render();
        }
        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin.theme.slider_images')->with('slider', $slider)->with('result', $result);
    }

    public function updatebanner(Request $request)
    {
        $theme = new Theme();
        $theme->updateBanners($request);
        $homeBanners = $theme->getBannersForUpdate($request->style);
        return $homeBanners;
    }

    public function updateslider(Request $request)
    {
        $theme = new Theme();
        $theme->updateSliders($request);
        $sliders = $theme->getSlidersForUpdate($request->carousel_id);
        return $sliders;
    }
    public function index2($id)
    {
        $current_theme = DB::table('current_theme')->first();
        $data = DB::table('front_end_theme_content')->first();
        //dd($data);
        $settings = DB::table('settings')->get();
        $top_offers = json_decode($data->top_offers, true);
        $headers = json_decode($data->headers, true);
        $carousels = json_decode($data->carousels, true);
        $banners = json_decode($data->banners, true);
        $banners_two = json_decode($data->banners_two, true);
        $footers = json_decode($data->footers, true);
        $cart = json_decode($data->cart, true);
        $news = json_decode($data->news, true);
        $detail = json_decode($data->detail, true);
        $shop = json_decode($data->shop, true);
        $contact = json_decode($data->contact, true);
        $login = json_decode($data->login, true);
        $news = json_decode($data->news, true);
        //$news = json_decode($data->news, true);
        $transitions = json_decode($data->transitions, true);

        $product_section_order = json_decode($data->product_section_order, true);
        $data = array();
        $data['top_offers'] = $top_offers;
        $data['headers'] = $headers;
        $data['carousels'] = $carousels;
        $data['banners'] = $banners;
        $data['banners_two'] = $banners_two;
        $data['footers'] = $footers;
        $data['product_section_order'] = $product_section_order;
        $data['cart'] = $cart;
        //$data['blog'] = $news;
        $data['detail'] = $detail;
        $data['shop'] = $shop;
        $data['contact'] = $contact;
        $data['section_id'] = $id;
        $data['settings'] = $settings;
        $data['login'] = $login;
        $data['news'] = $news;
        $data['transitions'] = $transitions;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.index")->with(['data' => $data, 'result' => $result, 'current_theme' => $current_theme]);
    }

    public function index()
    {
        $current_theme = DB::table('current_theme')->first();
        $data = DB::table('front_end_theme_content')->first();
        $headers = json_decode($data->headers, true);
        $carousels = json_decode($data->carousels, true);
        $banners = json_decode($data->banners, true);
        $footers = json_decode($data->footers, true);
        $cart = json_decode($data->cart, true);
        $news = json_decode($data->news, true);
        $detail = json_decode($data->detail, true);
        $shop = json_decode($data->shop, true);
        $contact = json_decode($data->contact, true);
        $login = json_decode($data->login, true);
        $banners_two = json_decode($data->banners_two, true);

        $product_section_order = json_decode($data->product_section_order, true);
        $data = array();
        $data['headers'] = $headers;
        $data['carousels'] = $carousels;
        $data['banners'] = $banners;
        $data['footers'] = $footers;
        $data['product_section_order'] = $product_section_order;
        $data['cart'] = $cart;
        $data['blog'] = $news;
        $data['detail'] = $detail;
        $data['shop'] = $shop;
        $data['contact'] = $contact;
        $data['login'] = $login;
        $data['banners_two'] = $banners_two;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.index")->with(['data' => $data, 'result' => $result, 'current_theme' => $current_theme]);
    }

   
   
    
}
