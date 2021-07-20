<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;
use Auth;
use App\User;
use App\Vehicle;
use App\VehicleMake;

class VehicleController extends Controller
{
    
  

    public function index(){
    	$data = [];
    	$data['vehicles'] = Vehicle::with('vmake','vmodel')->paginate(10);
        return view('client::vehicle.index', $data);
    }

    public function view($id){
        if(!empty($id)){
            $data = [];
            $data['vehicles'] = Vehicle::where('id', $id)->with('vmake','vmodel')->first();
            if(!empty($data['vehicles'])){
                 $data['vehicle_makes'] = VehicleMake::active()->get();
                return view('client::vehicle.view', $data);
            }
        }
        return  \Redirect::back()->with('status', 'Vehicle does not exit !!!');
    }

    public function add(){
        $data['vehicle_makes'] = VehicleMake::active()->get();
    	return view('client::vehicle.add' , $data);
    }

    public function save(Request $request){

    
        $validator = Validator::make($request->all(), [
            'plate_no' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return  \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $vehicle = new Vehicle();
        $vehicle->client_id = $request->client_id;
        //$vehicle->name = !empty($request->name) ? $request->name : null;
        $vehicle->registration_no = !empty($request->registration_no) ? $request->registration_no : null;
        $vehicle->chassis_no = !empty($request->chassis_no) ? $request->chassis_no : null;
        $vehicle->plate_no = !empty($request->plate_no) ? $request->plate_no : null;
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->color = !empty($request->color) ? $request->color : null;
        $vehicle->year = $request->year;
        $vehicle->current_mileage = !empty($request->current_mileage) ? $request->current_mileage : null;
        $vehicle->status = $request->status;

        if($vehicle->save()){
            return  \Redirect::back()->with('status', 'New vehicle saved successfully !!!');
        }
        return  \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function edit($id){
    	
        if(!empty($id)){
            $data = [];
            $data['vehicles'] = Vehicle::where('id', $id)->with('vmake','vmodel')->first();
            if(!empty($data['vehicles'])){
                 $data['vehicle_makes'] = VehicleMake::active()->get();
                return view('client::vehicle.edit', $data);
            }
        }
        return  \Redirect::back()->with('status', 'Vehicle does not exit !!!');
    }

    public function update(Request $request){
    	
        $id = $request->id;

        $validator = Validator::make($request->all(), [
            'plate_no' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return  \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $vehicles = Vehicle::where('id', '=', $id)->first();
        if(!empty($vehicles)){
            Vehicle::where('id', $id)
                ->update([
                	'registration_no' => !empty($request->registration_no) ? $request->registration_no : null,
                    'chassis_no' => !empty($request->chassis_no) ? $request->chassis_no : null,
                    'plate_no' => !empty($request->plate_no) ? $request->plate_no : null,
                    'make' => $request->make,
                    'model' => $request->model,
                    'color' => !empty($request->color) ? $request->color : null,
                    'year' => $request->year,
                    'current_mileage' => !empty($request->current_mileage) ? $request->current_mileage : null,
                    'status' => $request->status
                ]);

            return  \Redirect::back()->with('status', 'Update vehicle saved successfully !!!');
        }
        return  \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function delete($id){
    	
        if(!empty($id)){
            Vehicle::where('id', $id)->update(['status' => 2]);
             return  \Redirect::back()->with('status', 'Vehicle deleted successfully !!!');
        }
        return  \Redirect::back()->with('status', 'Vehicle does not exit !!!');
    }


}
