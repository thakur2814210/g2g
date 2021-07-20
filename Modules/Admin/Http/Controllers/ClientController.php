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
use App\Client;
use App\City;
use App\Country;

class ClientController extends Controller
{

   

    public function activeClientList()
    {
        $data['clients'] = Client::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin::client.client-active-list', $data);
    }

    public function deletedClientList()
    {   
       
        $data = [];
        $data['clients'] = Client::where('status', 2)->orderBy('created_at', 'DESC')->get();
        return view('admin::client.client-delete-list', $data);
    }

     public function pendingClientList()
    {   
       
        $data = [];
        $data['clients'] = Client::where('status', 3)->orderBy('created_at', 'DESC')->get();
        return view('admin::client.client-pending-list', $data);
    }

    
    public function viewClient($id)
    {   
        if(!empty($id)){
            $data['client'] = Client::where('id', $id)->first();
            if(!empty($data['client'])){
                $data['cities'] = City::where('status', 1)->get();
                $data['countries'] = Country::where('status', 1)->get();
                return view('admin::client.view', $data);
            }
        }
        return \Redirect::back()->with('status', 'Client does not exist !!!');
    }

    public function add()
    {   
        $data = [];
        $data['cities'] = City::where('status', 1)->get();
        $data['countries'] = Country::where('status', 1)->get();
        return view('admin::client.add', $data);
    }

    public function clientDetails($action , $id){
       
        if(!empty($id) && !empty($action)){
            $data['client'] = Client::where('id', $id)->first();
            if(!empty($data['client'])){
                $data['cities'] = City::where('status', 1)->get();
                $data['countries'] = Country::where('status', 1)->get();
                if($action == 'add'){
                    return view('admin::client.add', $data);
                }elseif ($action == 'edit') {
                    return view('admin::client.edit', $data);
                }
            }
        }
        return \Redirect::back()->with('status', 'Client does not exit !!!');
    }
   
    public function save(Request $request){

       
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'username' => 'required|unique:clients|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
            
         // lets save the photo
        $imgLocations = 'assets/uploads/clients';
        if(!empty(request()->cover_photo)){
            $imageName = $request->username.'-'.time().'.'.request()->cover_photo->getClientOriginalExtension();
            $request->cover_photo->move($imgLocations , $imageName);
            $cover_photo = $imageName;
        }else{
            $cover_photo = null;
        }


        $userdetail = new Client();
        $userdetail->username = $request->username;
        $userdetail->phone = $request->phone;
        $userdetail->email = $request->email;
        $userdetail->password = \Hash::make($request->password);
        $userdetail->remember_token = null;
        $userdetail->first_name = $request->first_name;
        $userdetail->last_name =  $request->last_name;
        $userdetail->gender =  $request->gender;
        $userdetail->address =  $request->address;
        $userdetail->city =  $request->city;
        $userdetail->country =  $request->country;
        $userdetail->postal =  $request->postal;
        $userdetail->fax =  !empty($request->fax) ? $request->fax : null;
        $userdetail->phone2 =  !empty($request->phone2) ? $request->phone2 : null;
        $userdetail->mobile2 =  !empty($request->mobile2) ? $request->mobile2 : null;
        $userdetail->latitude =  !empty($request->latitude) ? $request->latitude : null;
        $userdetail->longitude =  !empty($request->longitude) ? $request->longitude : null;
        $userdetail->image = $cover_photo;
        if($userdetail->save()){
            return \Redirect::route('superadmin.clients.pending-list')->with('status', 'New client with status pending created successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }


    public function update(Request $request){

       
        $id = $request->id;
        $client = Client::where('id', $id)->first();
        if(!empty($client)){
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'phone' => 'required',
                'username' =>  [
                        'required',
                        'max:255',
                         Rule::unique('clients')->ignore($id),
                    ],
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
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

            Client::where('id', '=', $id)
                ->update([
                    'username' => $request->username,
                    'phone' => $request->phone,
                     'email' => $request->email,
                     'status' => $request->status,
                    'first_name' =>  $request->first_name,
                    'last_name' =>  $request->last_name,
                    'gender' =>  $request->gender,
                    'address' =>  $request->address,
                    'city' =>  $request->city,
                    'country' =>  $request->country,
                    'postal' =>  $request->postal,
                    'fax' =>  !empty($request->fax) ? $request->fax : null,
                    'phone2' =>  !empty($request->phone2) ? $request->phone2 : null,
                    'mobile2' => !empty($request->mobile2) ? $request->mobile2 : null,
                    'latitude' => !empty($request->latitude) ? $request->latitude : null,
                    'longitude' => !empty($request->longitude) ? $request->longitude : null,
                ]);

            if($request->status == 1){
                return \Redirect::route('superadmin.clients.active-list')->with('status', 'Update client password successfully !!!');
            }elseif($request->status == 2){
                return \Redirect::route('superadmin.clients.delete-list')->with('status', 'Update client password successfully !!!');
            }else{
                return \Redirect::route('superadmin.clients.pending-list')->with('status', 'Update client password successfully !!!');
            }
            
        }
        return redirect('admin/clients/active/list')->with('status', 'Client does not exist !!!');
    }
    

    public function updateClientImage(Request $request){

       
        $id = $request->id;
        $client = Client::where('id', $id)->first();
        if(!empty($client)){
            $validator = Validator::make($request->all(), [
                'cover_photo'   =>  'required'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }
        
              // lets save the photo
            $imgLocations = 'assets/uploads/clients';
            if(!empty(request()->cover_photo)){
                $imageName = $client->username.'-'.time().'.'.request()->cover_photo->getClientOriginalExtension();
                $request->cover_photo->move($imgLocations , $imageName);
                $cover_photo = $imageName;
            }else{
                $cover_photo = null;
            }

            Client::where('id', '=', $id)
                ->update([
                    'image' => $cover_photo,
                ]);
            return \Redirect::back()->with('status', 'Update client infromation successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function clientStatusUpdate(Request $request){

        $id = $request->modal_client_id;
        $client = Client::where('id', $id)->first();
        if(!empty($client)){

            $validator = Validator::make($request->all(), [
                'status'   =>  'required'
            ]);

            if ($validator->fails()) {
                return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            Client::where('id', '=', $id)
                ->update([
                    'status' => $request->status,
                ]);
            return \Redirect::back()->with('status', 'Update client infromation successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }


}
