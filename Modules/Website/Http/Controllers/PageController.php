<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
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


class PageController extends Controller
{

    /*
        Hompage 
    */
    public function index()
    {   
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
       
        //dd($allGarageList);die;

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

        //dump($latestGarages);die;
       
        $testimonials = Testimonial::where('status', 1)->get();
        if( $testimonials->isEmpty()){
             $testimonials = [];
        }else{
            $testimonials = $testimonials->toArray();
        }
        //dump($testimonials);die;
        $data['testimonials'] = $testimonials;
        $data['latestGarages'] = $latestGarages;
        $data['featureGarages'] = $featureGarages;
        $sections = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->where('sections_description.language_id', $language_id)
            ->where('parent' , 0)->where('status', 1)
            ->orderBy('type')
            ->orderBy('sections_name')->get();
        $data['sections'] = $sections;

      

        return view('website::pages.homepage', $data);
    }

    

    public function faq()
    {
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
        $data['cat_names'] = $catNames;
        $data['faqs'] = $faq_all;
        //dd($data);
        return view('website::pages.faq', $data);
    }

    

    public function contactUs()
    {
        $data['contactusinfo'] = ContactUs::first();
        return view('website::pages.contact-us', $data);
    }

    public function aboutUs()
    {
        $data['aboutUs'] = PageContent::select('about_us_image','about_us_content_en','about_us_content_ar')->first();
        return view('website::pages.about-us', $data);
    }
    
    public function termAndCondtions(){
        $data = [];
        $data['pageContnet'] = PageContent::select('terms_conditions_en','terms_conditions_ar')->first();
        return view('website::pages.term-and-conditions', $data);
    }

    public function privacy(){
        $data = [];
        $data['pageContnet'] = PageContent::select('privacy_policy_en','privacy_policy_ar')->first();
        return view('website::pages.privacy', $data);
    }

    public function packagePrice()
    {

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

        

        $data['clientPackageData'] = $clinet_packages;
        $data['garagePackageData'] = $garage_packages;
        //dd($data);
        return view('website::pages.package-price', $data);
    }


   
}
