<?php
namespace App\Http\Controllers\Autoshop;
use App\User;
use Socialite;
use Validator;
use Services;
use File;
use App\Http\Controllers\Autoshop\AlertController;
use Illuminate\Contracts\Auth\Authenticatable;
use Hash;
use DB;
//use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;
use Lang;
use Illuminate\Support\Facades\Mail;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Languages;
use App\Models\Autoshop\Products;
use App\Models\Autoshop\Currency;
use App\Models\Autoshop\Customer;



use App\Vehicle;
use App\VehicleMake;
use App\VehicleModel;
use App\Client;

class VehicleController extends Controller
{

	public function __construct(
		Index $index,
		Languages $languages,
		Products $products,
		Currency $currency,
		Customer $customer
	)
	{
		$this->index = $index;
		$this->languages = $languages;
		$this->products = $products;
		$this->currencies = $currency;
		$this->customer = $customer;
		$this->theme = new ThemeController();
	}

	public function index(){
    	$data = [];
    	$title = array('pageTitle' => Lang::get("website.Dashboard"));
		$result['commonContent'] = $this->index->commonContent();
		$final_theme = $this->theme->theme();
		$customer = auth()->guard('customer')->user();
		$client = Client::where('user_id',$customer->id)->first();
    	
    	$vehicles = Vehicle::where('client_id' ,$client->id)->with('vmake','vmodel')->paginate(10);
    	return view('autoshop.vehicles.index', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'vehicles' => $vehicles]);
    }



    public function view($id){

    	$title = array('pageTitle' => Lang::get("website.Dashboard"));
		$result['commonContent'] = $this->index->commonContent();
		 $final_theme = $this->theme->theme();

        if(!empty($id)){
            $data = [];
            $vehicles = Vehicle::where('id', $id)->with('vmake','vmodel')->first();
            if(!empty($vehicles)){
                $vehicle_makes = VehicleMake::active()->get();
                return view('autoshop.vehicles.view', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'vehicles' => $vehicles,'vehicle_makes' => $vehicle_makes]);
            }
        }
        return  \Redirect::back()->with('status', 'Vehicle does not exit !!!');
    }

    public function add(){
    	$title = array('pageTitle' => Lang::get("website.Dashboard"));
		$result['commonContent'] = $this->index->commonContent();
		 $final_theme = $this->theme->theme();
        $vehicle_makes = VehicleMake::active()->get();
    	return view('autoshop.vehicles.add', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'vehicle_makes' => $vehicle_makes]);
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
            return  \Redirect::back()->with('status',Lang::get("website.New vehicle saved successfully"));
        }
        return  \Redirect::back()->with('status',  Lang::get("website.something_went_wrong"));
    }

    public function edit($id){

    	$title = array('pageTitle' => Lang::get("website.Dashboard"));
		$result['commonContent'] = $this->index->commonContent();
		 $final_theme = $this->theme->theme();
    	
        if(!empty($id)){
           
            $vehicles = Vehicle::where('id', $id)->with('vmake','vmodel')->first();
            if(!empty($vehicles)){
                 $vehicle_makes = VehicleMake::active()->get();
                return view('autoshop.vehicles.edit', ['result' =>$result,'title' => $title,'final_theme' => $final_theme,'vehicles' => $vehicles,'vehicle_makes' => $vehicle_makes]);
            }
        }
        return  \Redirect::back()->with('status', Lang::get("website.Vehicle does not exit"));
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

            return  \Redirect::back()->with('status', Lang::get("website.Update vehicle saved successfully"));
        }
        return  \Redirect::back()->with('status', Lang::get("website.something_went_wrong"));
    }

    public function delete($id){
    	
        if(!empty($id)){
            Vehicle::where('id', $id)->update(['status' => 2]);
             return  \Redirect::back()->with('status', Lang::get("website.Vehicle deleted successfully"));
        }
        return  \Redirect::back()->with('status', Lang::get("website.Vehicle does not exit"));
    }

     public function getModels($id){
        $models = VehicleModel::where("vehicle_make_id",$id)->pluck("name","id");
        return json_encode($models);
    }


	

}
