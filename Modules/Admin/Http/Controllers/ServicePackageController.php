<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\ServicePackage;
use App\ServicePackageFeature;
use App\ServicePackageTransaction;
use App\Section;


use DB;
use App\Models\Core\Setting;
use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang;

class ServicePackageController extends Controller
{

    public function __construct( Setting $setting){
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
   }


    // get service package List
    public function index(){
    	$data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	$data['categories'] = Section::where('status', 1)->get();
        $data['packages'] = ServicePackage::orderBy('created_at', 'DESC')->get();
        return view('admin::servicepackage.package-list', $data)->with('result', $result);
    }

    
    public function servicepackageAdd(){

    	$data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
    	$data['categories'] = Section::where('parent', 0)->where('status', 1)->where('type', 2)->get();
    	return view('admin::servicepackage.package-add', $data)->with('result', $result);
    }

    public function servicepackageSave(Request $request){
    	
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:service_package|max:255',
            'status' => 'required',
            'price' => 'required',
            'period' => 'required',
            'package_for' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

       
        $package = new ServicePackage();
        $package->name = !empty($request->name) ? $request->name : null;
        $package->slug =!empty($request->slug) ? $request->slug : null;
        $package->status = !empty($request->status) ? $request->status : null;

        $package->section_id = !empty($request->section_id) ? $request->section_id : null;
        
        $package->price = $request->price;
        $package->promo_price = !empty($promo_price) ? $promo_price : null;
        $package->period = $request->period;
        $package->package_for = $request->package_for;
        $package->description = !empty($request->description) ? $request->description : null;


        if($package->save()){
            return \Redirect::back()->with('status', 'New service package saved successfully !!!');
        }else{
            return \Redirect::back()->with('status', 'Something went wrong !!!');
        }
    }

    public function servicepackageEdit($id){
        $data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        if(!empty($id)){
            $data['packages'] = [];
            $data['packages'] = ServicePackage::where('id', $id)->first();
            if(!empty($data['packages'])){
            	$data['categories'] = Section::where('parent', 0)->where('status', 1)->where('type', 2)->get();
                return view('admin::servicepackage.package-edit', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Service Package does not exit !!!');
    }

    public function servicepackageUpdate(Request $request){

        $id = $request->id;
        $packages = ServicePackage::where('id', '=', $id)->first();
        if(!empty($packages)){


                $validator = Validator::make($request->all(), [
                    'name'   =>  ['required'],
                    'slug'   =>  ['required','max:255',Rule::unique('service_package')->ignore($id)],
                    'status' => ['required'],
		            'price' => ['required'],
		            'period' => ['required'],
                ]);

                if ($validator->fails()) {
                    return \Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                }


                ServicePackage::where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'slug' => $request->slug,
                        'status' => $request->status,
                        'description' =>$request->description,
                        'price' =>  $request->price,
                        'promo_price' =>  $request->promo_price,
                        'period' =>  $request->period,
                    ]);

                 return \Redirect::back()->with('status', 'Update package successfully !!!');
        }
         return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function servicepackageDelete($id){
        if(!empty($id)){
            ServicePackage::where('id', $id)->update(['status' => 2]);
            return \Redirect::back()->with('status', 'Package deleted successfully !!!');
        }
        return \Redirect::back()->with('status', 'Package does not exit !!!');
    }








    public function servicepackageFeature($service_package_id = null){
    	$data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $data['packages'] = ServicePackage::get();
        if(!empty($service_package_id)){
            $data['packagefeatures'] = ServicePackageFeature::where('service_package_id', $service_package_id)->get();
        }else{
            $data['packagefeatures'] = ServicePackageFeature::get();
        }
        return view('admin::servicepackage.package-features', $data)->with('result', $result);
    }


    public function servicepackageFeatureAdd(){

    	$data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
    	$data['packages'] = ServicePackage::get();
    	return view('admin::servicepackage.package-featutre-add', $data)->with('result', $result);
    }

    public function servicepackageFeatureSave(Request $request){

        $validator = Validator::make($request->all(), [
            'feature_name' => 'required',
            'feature_value' => 'required',
            'service_package_id' => 'required',
            'status' => 'required'
        ]);

       if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $packagefeatures = new ServicePackageFeature();
        $packagefeatures->service_package_id = $request->service_package_id;
        $packagefeatures->feature_name = $request->feature_name;
        $packagefeatures->feature_value =$request->feature_value;
        $packagefeatures->status = $request->status;
        if($packagefeatures->save()){
            return \Redirect::back()->with('status', 'New package feature saved successfully !!!');
        }else{
            return \Redirect::back()->with('status', 'Something went wrong !!!');
        }
    }

    public function servicepackageFeatureEdit($id){
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
    	
        if(!empty($id)){
            $data = [];
            $data['packagefeatures'] = ServicePackageFeature::where('id', $id)->first();
            if(!empty($data['packagefeatures'])){
            	$data['packages'] = ServicePackage::get();
                return view('admin::servicepackage.package-featutre-edit', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Package feature does not exit !!!');
    	
    }

    public function servicepackageFeatureUpdate(Request $request){

    	

        $id = $request->id;
        $packageFeature = ServicePackageFeature::where('id', '=', $id)->first();
        if(!empty($packageFeature)){

        		// validate 
                $validator = Validator::make($request->all(), [
                    'feature_name'   =>  ['required'],
                    'feature_value'   =>  ['required'],
                    'status'   =>  ['required'],
                    'service_package_id'   =>  ['required'],
                ]);

                if ($validator->fails()) {
                    return redirect('admin/role/edit/'.$id)
                                ->withErrors($validator)
                                ->withInput();
                }


                ServicePackageFeature::where('id', $id)
                    ->update([
                        'feature_name' => $request->feature_name,
                        'feature_value' => $request->feature_value,
                        'status' => $request->status,
                        'service_package_id' => $request->service_package_id
                    ]);

                return \Redirect::back()->with('status', 'Update package feature saved successfully !!!');
        }
        return redirect('admin/packages/features')->with('status', 'Something went wrong !!!');
    }

    public function servicepackageFeatureDelete($id){

    	
        if(!empty($id)){
            ServicePackageFeature::where('id', $id)->update(['status' => 2]);
            return \Redirect::back()->with('status', 'Package feature deleted successfully !!!');
        }
        return \Redirect::back()->with('status', 'Package feature does not exit !!!');
    }






    public function servicepackageTransaction(){

    	$data = [];
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $data['packagelogs'] = ServicePackageTransaction::get();
        return view('admin::servicepackage.package-logs', $data)->with('result', $result);
    }

}