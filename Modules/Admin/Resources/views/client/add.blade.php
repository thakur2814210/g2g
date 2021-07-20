@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
   
@stop

@section('breadcrumb')
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.clients.active-list') }}">Active Customers List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.clients.delete-list') }}">Delete Customers List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.clients.pending-list') }}">Pending Customers List</a>
        </li>
        <li class="breadcrumb-item active">Manage Roles</li>
    </ol>
@stop

@section('content')

  <div class="row">
        <div class="col-12">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
           @if (session('status'))
              <div class="alert alert-warning">
                  {{ session('status') }}
              </div>
          @endif
        </div>
  </div>

  <div class="box_general">
    <div class="header_box version_2">
      <h2  class="text-danger"><i class="fa fa-user text-danger"></i>Add New Client</h2>
    </div>
      <form class="form-horizontal" method="POST" action="{{ route('superadmin.client.save')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-3">
          <div class="text-center">
           
          
               <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar  img-thumbnail" alt="client_image">
              <div class="form-group">
                <label for="exampleInputFile">Upload a different photo...</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" id="cover_photo" name="cover_photo">
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="col-sm-9">

          <div class="row">

            <div class="col-6">
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Username</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="username" placeholder="Enter Username" required="" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Email</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="email" placeholder="Enter Email" required="" />
                </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-6">
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Password</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="password" placeholder="Enter Password" required="" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Phone</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone" required="" />
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    <div class="header_box version_2">
      <h2  class="text-danger"><i class="fa fa-user text-danger"></i>Enter Client Details:</h2>
    </div>

    <div class="row padding_bottom">
      <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group ">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *First name</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="first_name" placeholder="Enter First name" required="" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Last name</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="last_name" placeholder="Enter Last name" required="" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label for="tag_status" class="col-12 col-form-label text-danger"> *Gender</label>
                <div class="col-sm-12">
                  <select class="form-control" name="gender" id="gender" required="required">
                      <option value="">Select Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Address</label>
                  <div class="col-sm-12">
                     <div class="card shadow">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="autocomplete" class="text-danger"> *Location/City/Address </label>
                                <input type="text"  name="address" id="autocomplete" class="form-control" placeholder="Select Location" required="">
                            </div>

                            <div class="form-group" id="lat_area">
                                <label for="latitude" class="text-danger"> *Latitude </label>
                                <input type="text" name="latitude" id="latitude" class="form-control" readonly="">
                            </div>

                            <div class="form-group" id="long_area">
                                <label for="latitude" class="text-danger"> *Longitude </label>
                                <input type="text" name="longitude" id="longitude" class="form-control" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *City</label>
                  <div class="col-sm-12">
                     <select class="form-control" name="city" id="city" required="required">
                      <option value="">Select City</option>
                      @foreach($cities as $city)
                        <option value="{{$city->id }}">{{ $city->name }}</option>
                      @endforeach
                    </select>
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Country</label>
                  <div class="col-sm-12">
                    <select class="form-control" name="country" id="country" required="required">
                      <option value="">Select Country</option>
                      @foreach($countries as $country)
                        <option value="{{$country->id }}">{{ $country->name }}</option>
                      @endforeach
                    </select>
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Pobox</label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" name="postal" placeholder="Enter Postal" required="" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger">Fax</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="fax" placeholder="Enter Fax"/>
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger">Mobile 2</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="mobile2" placeholder="Enter Mobile"  />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger">Phone 2</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="phone2" placeholder="Enter Phone"/>
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 text-center">
              <div class="form-group">
                <div class="col-xs-12">
                <button class="btn btn-danger" type="submit"><i class="fa fa-save"></i> Create New Client</button>
                </div>
              </div>
            </div>
          </div>
         
        </div>
      </form>
    </div>
  </div>


   

@stop

@section('js')
<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
            google.maps.event.addDomListener(window, 'load', initialize);
       });
  

       function initialize() {
       
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
    </script>
@stop

