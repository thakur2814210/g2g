<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;
use Auth;
use App\User;
use App\Section;
use App\City;
use App\Country;
use App\Garage;
use App\GaragesDescription;
use App\Language;
use App\GarageTeam;
use App\GarageImage;
use App\GarageVideo;
use App\GarageWorkingHour;
use App\GarageService;
use Image;

use DB;
use App\Models\Core\Setting;
//use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang As Lang;

class GarageController extends Controller
{

    public function __construct( Setting $setting){
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
    }




    public function activeGarages()
    {
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['garages'] = Garage::join('garages_description','garages_description.garages_id' , 'garages.id')
        ->join('users','garages.user_id' , 'users.id')
        ->where('garages.status', 1)
        ->where('garages_description.language_id', 1)
        ->select('garages.id','garages.type','users.user_name as username', 'garages.address' ,'garages_description.garages_name' )
        ->orderBy('garages.created_at', 'DESC')->get();
        
        return view('admin::garage.garage-active-list', $data)->with('result', $result);
    }

    //
    public function deleteGarages()
    {
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

       $data['garages'] = Garage::join('garages_description','garages_description.garages_id' , 'garages.id')
        ->join('users','garages.user_id' , 'users.id')
        ->where('garages.status', 2)
        ->where('garages_description.language_id', 1)
        ->select('garages.id','garages.type','users.user_name as username', 'garages.address' ,'garages_description.garages_name' )
        ->orderBy('garages.created_at', 'DESC')->get();
        return view('admin::garage.garage-delete-list', $data)->with('result', $result);
    }

    //
    public function pendingGarages()
    {
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['garages'] = Garage::join('garages_description','garages_description.garages_id' , 'garages.id')
        ->join('users','garages.user_id' , 'users.id')
        ->where('garages.status', 3)
        ->where('garages_description.language_id', 1)
        ->select('garages.id','garages.type','users.user_name as username', 'garages.address' ,'garages_description.garages_name' )
        ->orderBy('garages.created_at', 'DESC')->get();
        
        return view('admin::garage.garage-pending-list', $data)->with('result', $result);
    }

     public function add()
    {
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
        return view('admin::garage.add-garage', $data)->with('result', $result);
    }

    public function edit($id){
      
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $language_id = 1;
        $garages = Garage::where('garages.id', $id)->first();
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
            $data['garage_working_hours'] = GarageWorkingHour::where('garage_id', $id)->first();
            $data['garage_services'] = GarageService::where('garage_id', $id)->first();
            $data['garage'] = $garages;
            $garagesDescriptions = GaragesDescription::where('garages_id', $id)->get();
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
           
            return view('admin::garage.garage_details', $data)->with('result', $result);
        }
        return \Redirect::back()->with('status', 'Garage does not exist !!!');

    }

    
/*
   
    public function viewGarageDetail($id){
      
        $data = [];
        if(!empty($id)){
            
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
            
            $garages = Garage::where('id', $id)->first();
            
            
            if(is_null($garages )){
                $data['form_action'] = 'insert';
                $data['isGarageDetailExist'] = false;
            }else{

                $data['garage_working_hours'] = GarageWorkingHour::where('garage_id', $id)->first();
                $data['garage_services'] = GarageService::where('garage_id', $id)->first();
                $data['garage'] = $garages;
                $data['form_action'] = 'update'; 
                $data['isGarageDetailExist'] = true;
            }
           // dd($data);die;
            return view('admin::garage.garage_details', $data);
        }
        return \Redirect::back()->with('status', 'Garage does not exist !!!');

    }

    */

    public function update(Request $request){
       
        $id = $request->id;
        $garage = Garage::where('id', '=', $id)->first();
        if(!empty($garage)){

            $validator = Validator::make($request->all(), [
                'garage_name_en'   =>  ['required'],
                'garage_name_ar'   =>  ['required'],
                'description_en'   =>  ['required'],
                'description_ar'   =>  ['required'],
                'garage_vendor_type' => ['required'], 

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
                'owner_address'   =>  ['required'],
                'status' => ['required'],
                'is_feature'       => ['required']
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
                'status' => !empty($request->status) ? $request->status : 3,
                'type' => $request->garage_vendor_type,
                'is_feature' => !empty($request->is_feature) ? $request->is_feature : 2,
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

            User::where('id', $garage->user_id)->update([
                'garage_vendor_type' => $request->garage_vendor_type,
            ]);

             /*GarageWorkingHour::where('garage_id', '=', $garage->id)
                 ->update([
                    'sun' =>  $request->sun,
                    'mon' =>  $request->mon,
                    'tue' => $request->tue,
                    'wed' =>  $request->wed,
                    'thu' =>  $request->thu,
                    'fri' =>  $request->fri,
                    'sat' =>  $request->sat,
                    'sun' =>  $request->sun
                ]);

            // dump($request->cat_id);die;
             $cat_id = $sub_cat_id = null;
             if(!empty($request->cat_id)){
                $cat_id = (count($request->cat_id) > 0) ? implode(',', $request->cat_id) : null;
             }

            if(!empty($request->sub_cat_id)){
                $sub_cat_id = (count($request->sub_cat_id) > 0) ? implode(',', $request->sub_cat_id) : null;
             }
             GarageService::where('garage_id', '=', $garage->id)
             ->update([
                'cat_id' =>  $cat_id ,
                'sub_cat_id' =>  $sub_cat_id,
            ]);
            */

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
           
            'username' =>  ['required'],
            'first_name' =>  ['required'],
            'last_name' =>  ['required'],
            'email' =>  ['required'],
            'password' =>  ['required'],
            'phone' =>  ['required'],
            'status' => ['required'],
            'slug'   =>  ['required'],
            'is_feature'  => ['required'],
            'garage_vendor_type' => ['required'], 

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

        // Create User
        $res = array();
        $res['email'] =  "false";
        $res['user_name'] =  "false";
        $res['user_phone'] =  "false";
        $res['user_exist'] =  "false";
        $date = date('y-md h:i:s');
        

        //eheck email already exit
        if(\DB::table('users')->where('role_id', 2)->where('email', $request->email)->count() > 0){
          $res['email'] =  "true";
          $res['user_exist'] =  "true";
        }

        //eheck email already exit
        if(\DB::table('users')->where('role_id', 2)->where('phone', $request->phone)->count() > 0){
          $res['user_phone'] =  "true";
           $res['user_exist'] =  "true";
        }

        //eheck user name already exit
        if(\DB::table('users')->where('role_id', 2)->where('user_name', $request->username)->count() > 0){
           $res['user_name'] =  "true";
           $res['user_exist'] =  "true";
        }
            
        
        if( $res['user_exist'] ==  "false"){

            // create user 
            $user = new User();
            $user->user_name = $request->username;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->role_id = 3;
            $user->garage_vendor_type = $request->garage_vendor_type;
            $user->email = $request->email;
            $user->password = \Hash::make(trim($request->password));
            $res['insert'] = "true";



            
            if($user->save()){

                // create records in garage table
                $garage = new Garage();
                $garage->user_id = $user->id;
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

                $garage->status = $request->status;
                $garage->is_feature = $request->is_feature;
                $garage->type = $request->garage_vendor_type;

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

                    if($request->garage_vendor_type != 1){
                        $vendor_id = DB::table('vendor_details')->insertGetId(
                            ['user_id' =>auth()->user()->id,
                            'shop_name' => $request->garage_name_en,
                            'created_at' => $date,
                            'updated_at' => $date]);
                    }else{
                        $vendor_id = null;
                    }


                    if($request->status == 1){
                     return \Redirect::route('superadmin.garages.active')->with('status', 'New garage created successfully !!!');
                    }elseif($request->status == 2){
                         return \Redirect::route('superadmin.garages.delete')->with('status', 'New garage created successfully !!!');
                    }else{
                         return \Redirect::route('superadmin.garages.pending')->with('status', 'New garage created successfully !!!');
                    }
                }
            }
        }

        if($res['user_exist'] == "true"){
            if($res['email'] == "true"){
                return \Redirect::back()->with('status', Lang::get("website.Email already exist"));
            }elseif ($res['user_phone'] == "true"){
                return \Redirect::back()->with('status', Lang::get("website.Phone already exist"));
            }else{
                return \Redirect::back()->with('status', Lang::get("website.Username already exist"));
            }
        }




        /*
        
        if($garage->save()){

            $last_save_id = $garage->id;

            


            $mon = $request->ot_mon. ' - ' .$request->ct_mon;
            $tue = $request->ot_tue. ' - ' .$request->ct_tue;
            $wed = $request->ot_wed. ' - ' .$request->ct_wed;
            $thu = $request->ot_thu. ' - ' .$request->ct_thu;
            $fri = $request->ot_fri. ' - ' .$request->ct_fri;
            $sat = $request->ot_sat. ' - ' .$request->ct_sat;
            $sun = $request->ot_sun. ' - ' .$request->ct_sun;

            // create rocords for working hours
            $GarageworkingHour = new GarageWorkingHour();
            $GarageworkingHour->mon = $mon;
            $GarageworkingHour->tue = $tue;
            $GarageworkingHour->wed = $wed;
            $GarageworkingHour->thu = $thu;
            $GarageworkingHour->fri = $fri;
            $GarageworkingHour->sat = $sat;
            $GarageworkingHour->sun = $sun;
            $GarageworkingHour->garage_id = $last_save_id;
            $GarageworkingHour->save();

            // dump($request->cat_id);die;
             $cat_id = $sub_cat_id = null;
             if(!empty($request->cat_id)){
                $cat_id = (count($request->cat_id) > 0) ? implode(',', $request->cat_id) : null;
             }

            if(!empty($request->sub_cat_id)){
                $sub_cat_id = (count($request->sub_cat_id) > 0) ? implode(',', $request->sub_cat_id) : null;
             }


            // create garage service
            $GarageService = new GarageService();
            $GarageService->garage_id = $last_save_id;
            $GarageService->cat_id = $cat_id;
            $GarageService->sub_cat_id = $sub_cat_id;
            $GarageService->save();


            
           
        }*/

        return \Redirect::back()->with('status', 'Something went wrong! Please contact administrator.');
    }

    public function viewGarageWorkingHours($id){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $data['garage'] = Garage::where('id', $id)->first();
            if(!empty($data['garage'])){
                $data['garage_working_hours'] = GarageWorkingHour::where('garage_id', $id)->first();
                //dd($data['garage_working_hours']);die;
            //$data['garage_services'] = GarageService::where('garage_id', $id)->first();
              //  $data['garage_working_hours'] = GarageTeam::where('garage_id', $data['garage']->id)->paginate(10);
                return view('admin::garage.garage_workign_hours', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Garage details does not exist! Please fill Garage details first.');
    }

    public function viewGarageServices($id){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $data['garage'] = Garage::where('id', $id)->first();
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
                $data['garage_services'] = GarageService::where('garage_id', $id)->first();
                return view('admin::garage.garage_services', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Garage details does not exist! Please fill Garage details first.');
    }
   



    public function viewGarageTeam($id){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $data['garage'] = Garage::where('id', $id)->first();
            if(!empty($data['garage'])){
                $data['garageTeams'] = GarageTeam::where('garage_id', $data['garage']->id)->paginate(10);
                return view('admin::garage.garage_teams', $data)->with('result', $result);
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

    public function deleteGarageTeam($id){
         
         if(!empty($id)){
            $garageTeam = GarageTeam::where('id', $id)->first();
            if(!empty($garageTeam)){

                // delete the image from upload folder
                $old_image = 'assets/uploads/garage_images/'.$garageTeam->image;
                if(\File::exists($old_image)) {
                     @unlink($old_image);
                }

                // Delete from table
                if(\DB::table('garage_teams')->delete($id)){
                    return \Redirect::back()->with('status', 'Garage team member deleted successfully !!!');
                }
            }
         }
         return \Redirect::back()->with('status', 'Something went wrong! Garage detail id does not exist.');
    }





    public function viewGarageImage($id){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $data['garage'] = Garage::where('id', $id)->first();
            if(!empty($data['garage'])){
                $data['garageimages'] = GarageImage::where('garage_id', $data['garage']->id)->paginate(10);
                return view('admin::garage.garage_images', $data)->with('result', $result);
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





    public function viewGarageVideo($id){
        
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        if(!empty($id)){
            $data['garage'] = Garage::where('id', $id)->first();
            if(!empty($data['garage'])){
                $data['users'] = User::where('id', '=', $data['garage']->user_id)->first();
                $data['garageVideos'] = GarageVideo::where('garage_id', $data['garage']->id)->paginate(10);
                return view('admin::garage.garage_videos', $data)->with('result', $result);
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
