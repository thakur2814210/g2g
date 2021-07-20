<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\VehicleMake;
use App\VehicleModel;
use App\Commission;
use App\Setting;
//use App\Language;

use DB;
use App\Models\Core\Setting as WebSetting;
use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang;

class GeneralSettingController extends Controller
{

    public function __construct( WebSetting $setting)
    {
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
    }

    public function setting(){
    	$data['setting'] = Setting::first();
        return view('admin::general-setting.setting', $data);
    }

    public function updateSetting(Request $request){
       
        Setting::where('id', 1)
        ->update([
            'google_map_key' => $request->google_map_key,

        ]);
        return \Redirect::back()->with('status', 'Settings Update successfully!');

    }

   


    /**
     * Vehicel Make
     */

    public function vehicleMake(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	$data['lists'] = VehicleMake::get();
        return view('admin::general-setting.vehicle-make-list', $data)->with('result', $result);
    }

    public function addVehicleMake(){

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin::general-setting.vehicle-make-add')->with('result', $result);
    }

    public function saveVehicleMake(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'active' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $v_make = new VehicleMake();
        $v_make->name = $request->name;
        $v_make->active = $request->active;
        if($v_make->save()){
            return \Redirect::back()->with('status', 'New vehicle make saved successfully !!!');
        }

        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function editVehicleMake($id){

         $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	$vehicleMake = VehicleMake::where('id' , $id)->first();
    	if(!empty($vehicleMake)){
    		$data['vehicleMake'] = $vehicleMake;
    		return view('admin::general-setting.vehicle-make-edit', $data)->with('result', $result);
    	}
    	return \Redirect::back()->with('status', 'Something went wrong !!!');
       
    }

    public function updateVehicleMake(Request $request){
       
       $validator = Validator::make($request->all(), [
       	 	'id' => 'required',
            'name' => 'required',
            'active' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
         
         VehicleMake::where('id', $request->id)
                    ->update([
                    	'name' => $request->name,
				        'active' => $request->active,
                    ]);
        return \Redirect::back()->with('status', 'Update make successfully!');
    }

    public function deleteVehicleMake($id){
        if(!empty($id)){
        	$vehicleMake = VehicleMake::find($id);
        	if(!empty($vehicleMake)){
                VehicleMake::where('id', $id)->update(['active' => 0]);
                //VehicleModel::where('vehicle_make_id', $id)->update(['active' => 0]);
        		//VehicleMake::where('id',$id)->delete();
        		return \Redirect::back()->with('status', 'Make deleted successfully!');
        	}else{
        		return \Redirect::back()->with('status', 'Make deleted failed!');
        	}
        }
        return \Redirect::back()->with('status', 'Make does not exit!');
    }

     /**
     * Vehicel Modal
     */

    public function vehicleModal(){

         $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	$data['lists'] = VehicleModel::with('make')->paginate(20);
        //dd($data);die;
        return view('admin::general-setting.vehicle-modal-list' ,$data)->with('result', $result);
    }

    public function addVehicleModal(){

         $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	$data['vehicleMakes'] = VehicleMake::get();
        return view('admin::general-setting.vehicle-modal-add', $data)->with('result', $result);
    }

    public function saveVehicleModal(Request $request){
        
        $validator = Validator::make($request->all(), [
        	'vehicle_make_id' => 'required',
            'name' => 'required',
            'active' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $v_make = new VehicleModel();
        $v_make->vehicle_make_id = $request->vehicle_make_id;
        $v_make->name = $request->name;
        $v_make->active = $request->active;
        if($v_make->save()){
            return \Redirect::back()->with('status', 'New vehicle make saved successfully !!!');
        }

        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function editVehicleModal($id){

         $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

    	
    	$vehicleModal = VehicleModel::where('id' , $id)->first();
    	if(!empty($vehicleModal)){
    		$data['vehicleMakes'] = VehicleMake::get();
    		$data['vehicleModal'] = $vehicleModal;
    		return view('admin::general-setting.vehicle-modal-edit', $data)->with('result', $result);
    	}
    	return \Redirect::back()->with('status', 'Something went wrong !!!');
        return view('admin::general-setting.vehicle-modal-edit');
    }

    public function updateVehicleModal(Request $request){
        
        $validator = Validator::make($request->all(), [
       	 	'id' => 'required',
       	 	'vehicle_make_id' => 'required',
            'name' => 'required',
            'active' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
         
         VehicleModel::where('id', $request->id)
                    ->update([
                    	'vehicle_make_id' => $request->vehicle_make_id,
                    	'name' => $request->name,
				        'active' => $request->active,
                    ]);
        return \Redirect::back()->with('status', 'Update make successfully!');
    }

    public function deleteVehicleModal($id){
       if(!empty($id)){
        	if(!empty(VehicleModel::find($id))){
        		VehicleModel::where('id', $id)->update(['active' => 0]);
        		return \Redirect::back()->with('status', 'Vehicle Modal deleted successfully!');
        	}else{
        		return \Redirect::back()->with('status', 'Vehicle Modal deleted failed!');
        	}
        }
        return \Redirect::back()->with('status', 'Make does not exit!');
    }



     /**
     * Commissions
     */
    
    public function commission(){
        
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();

        $data['commission'] = Commission::first();
        return view('admin::general-setting.commission' , $data)->with('result', $result);
    }

    public function updateCommission(Request $request){
       
        Commission::where('id', 1)
        ->update([
            'service_request' => $request->service_request,
            'client_package_subscription' => $request->client_package_subscription,
            'garage_package_subscription' => $request->garage_package_subscription,
        ]);
        return \Redirect::back()->with('status', 'Commissions Update successfully!');

    }

}