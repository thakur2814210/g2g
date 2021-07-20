<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\Role;
use App\User;
use App\Faq;
use App\Testimonial;
use App\ContactUs;
use App\Helpers\Helper;
use App\PageContent;
use App\SeoPage;

use DB;
use App\Models\Core\Setting;
use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang;

class PageController extends Controller
{


    public function __construct( Setting $setting){
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
    }

   

    public function aboutUs(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['aboutUs'] = PageContent::first();
        return view('admin::page.about-us', $data)->with('result', $result);
    }

     public function termsConditions(){
        

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $termsConditions = PageContent::first();
        return view('admin::page.terms-conditions', ['termsConditions' => $termsConditions])->with('result', $result);
    }

    public function privacyPolicy(){
        
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $privacyPolicy = PageContent::first();
        return view('admin::page.privacy-policy' , ['privacyPolicy' => $privacyPolicy])->with('result', $result);
    }


    public function updatePageContent(Request $request){
      
         $page_type = $request->page_type;
         if(!empty($page_type)){

            $data = [];
            switch ($page_type) {
                case 'about-us':
                    $data = [
                        'about_us_image' =>  $request->cover_photo,
                        'about_us_content_en' =>  $request->about_us_content_en,
                        'about_us_content_ar' => $request->about_us_content_ar,
                    ];
                    break;

                case 'privacy-policy':
                    $data = [
                        'privacy_policy_en' =>  $request->privacy_policy_en,
                        'privacy_policy_ar' => $request->privacy_policy_ar,
                    ];
                    break;

                case 'terms-conditions':
                    $data = [
                        'terms_conditions_en' =>  $request->terms_conditions_en,
                        'terms_conditions_ar' => $request->terms_conditions_ar,
                    ];
                    break;
            }
            PageContent::where('id', '=', 1)->update($data);
            return \Redirect::back()->with('status', 'Page content updated successfully.');
         }
         return \Redirect::back()->with('status', 'Something went wrong.');
    }












    public function contactUs(){
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        
        $data['contactUs'] = ContactUs::first();
        return view('admin::page.contact-us',$data)->with('result', $result);
    }

    public function updateContactUs(Request $request){
        $id = $request->id;
        ContactUs::where('id', '=', $id)
            ->update([
                'phone' =>  !empty($request->phone) ? $request->phone : null,
                'mobile' =>  !empty($request->mobile) ? $request->mobile : null,
                'email' =>  !empty($request->email) ? $request->email : null,
                'address_en' => !empty($request->address_en) ? $request->address_en : null,
                'address_ar' => !empty($request->address_ar) ? $request->address_ar : null,
                'contact_form_mail_address' =>  !empty($request->contact_form_mail_address) ? $request->contact_form_mail_address : null,
                'latitude' => !empty($request->latitude) ? $request->latitude : null,
                'longitude' =>  !empty($request->longitude) ? $request->longitude : null,
            ]);
        return \Redirect::back()->with('status', 'Update contact information successfully !!!');
    }











    public function faq(){
      
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['faqs'] = Faq::paginate(20);
        return view('admin::page.faq.index', $data)->with('result', $result);
    }

    public function faqAdd(){
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        return view('admin::page.faq.add')->with('result', $result);
    }

    public function faqSave(Request $request){
         
        
        $validator = Validator::make($request->all(), [
            'cat_name_en' => 'required',
            'cat_name_ar' => 'required',
            'heading_en' => 'required',
            'heading_ar' => 'required',
            'answer_en' => 'required',
            'answer_ar' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $faq = new Faq();
        $faq->cat_name_en = $request->cat_name_en;
        $faq->heading_en = $request->heading_en;
        $faq->answer_en = $request->answer_en;
        $faq->cat_name_ar = $request->cat_name_ar;
        $faq->heading_ar = $request->heading_ar;
        $faq->answer_ar = $request->answer_ar;
        $faq->status = $request->status;
        if($faq->save()){
            return \Redirect::back()->with('status', 'New faq created successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function faqEdit($id){
       
        if(!empty($id)){
            $data = [];
            $result = array();
            $result['commonContent'] = $this->Setting->commonContent();

            $data['faqs'] = Faq::where('id', $id)->first();
            if(!empty($data['faqs'])){
                return view('admin::page.faq.edit', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'FAQ does not exist !!!');
    }

    public function faqUpdate(Request $request){
       
        $id = $request->id;
        $faq = Faq::where('id', '=', $id)->first();
        if(!empty($faq)){
            $validator = Validator::make($request->all(), [
                'cat_name_en' => 'required',
                'cat_name_ar' => 'required',
                'heading_en' => 'required',
                'heading_ar' => 'required',
                'answer_en' => 'required',
                'answer_ar' => 'required',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            Faq::where('id', '=', $id)
                ->update([
                    'cat_name_en' =>  $request->cat_name_en,
                    'heading_en' =>  $request->heading_en,
                    'answer_en' =>  $request->answer_en,
                    'cat_name_ar' =>  $request->cat_name_ar,
                    'heading_ar' =>  $request->heading_ar,
                    'answer_ar' =>  $request->answer_ar,
                    'status' =>  $request->status
                ]);
            return \Redirect::back()->with('status', 'Update faq successfully !!!');
        }
        return \Redirect::back()->with('status', 'FAQ does not exist !!!');
    }
















    public function testimonial(){
      
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['testimonials'] = Testimonial::paginate(10);
        return view('admin::page.testimonial.index', $data)->with('result', $result);
    }

    public function testimonialAdd(){
        
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        return view('admin::page.testimonial.add')->with('result', $result);
    }

    public function testimonialSave(Request $request){
         
      
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'remarks_en' => 'required',
            'name_ar' => 'required',
            'remarks_ar'=> 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if(!empty(request()->image)){
            $imageName = $request->name.'-'.time().'.'.request()->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/testimonial'), $imageName);
            $cover_photo = '/uploads/testimonial/'.$imageName;
        }else{
            $cover_photo = null;
        }

        $testimonial = new Testimonial();
        $testimonial->name_en = $request->name_en;
        $testimonial->remarks_en = $request->remarks_en;
        $testimonial->designation_en = !empty($request->designation_en) ? $request->designation_en : null;
        $testimonial->name_ar = $request->name_ar;
        $testimonial->remarks_ar = $request->remarks_ar;
        $testimonial->designation_ar = !empty($request->designation_ar) ? $request->designation_ar : null;
        $testimonial->image = $cover_photo;
        $testimonial->status = $request->status;
        $testimonial->ordering = !empty($request->ordering) ? $request->ordering : 99;
        if($testimonial->save()){
            return \Redirect::back()->with('status', 'New testimonial created successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function testimonialEdit($id){
       
        if(!empty($id)){
            $data = [];
            $result = array();
            $result['commonContent'] = $this->Setting->commonContent();

            $data['testimonials'] = Testimonial::where('id', $id)->first();
            if(!empty($data['testimonials'])){
                return view('admin::page.testimonial.edit', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'FAQ does not exist !!!');
    }

    public function testimonialUpdate(Request $request){
        
        $id = $request->id;
        $testimonial = Testimonial::where('id', '=', $id)->first();
        if(!empty($testimonial)){
            $validator = Validator::make($request->all(), [
                'name_en' => 'required',
                'remarks_en' => 'required',
                'name_ar' => 'required',
                'remarks_ar'=> 'required',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }


            if(!empty(request()->image)){
                $imageName = $request->name.'-'.time().'.'.request()->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/testimonial'), $imageName);
                $cover_photo = '/uploads/testimonial/'.$imageName;
            }else{
                $cover_photo = $testimonial->image;
            }

            Testimonial::where('id', '=', $id)
                ->update([
                    'name_en' =>  $request->name_en,
                    'remarks_en' =>  $request->remarks_en,
                    'designation_en' => !empty($request->designation_en) ? $request->designation_en : null,
                    'name_ar' =>  $request->name_ar,
                    'remarks_ar' =>  $request->remarks_ar,
                    'designation_ar' => !empty($request->designation_ar) ? $request->designation_ar : null,
                    'image' =>  $cover_photo,
                    'status' =>  $request->status,
                    'ordering' => !empty($request->ordering) ? $request->ordering : 99,
                    
                ]);
            return \Redirect::back()->with('status', 'Update testimonial successfully !!!');
        }
        return \Redirect::back()->with('status', 'testimonial does not exist !!!');
    }


    




   

}