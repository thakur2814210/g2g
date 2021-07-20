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
        <li class="breadcrumb-item active">Edit Customers Details</li>
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

<div class="box_general padding_bottom">
  <div class="header_box version_2">
    <h2  class="text-danger"><i class="fa fa-user text-danger"></i> Edit Client Login: {{ $client->username }}</h2>
  </div>

  <form class="form-horizontal" method="POST" action="{{ route('superadmin.client.update')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
   <input type="hidden" name="user_id" value="{{$client->user_id}}">
   <input type="hidden" name="id" value="{{$client->id}}">
  <div class="row">

      <div class="col-sm-4">
        <div class="form-group">
          <label for="tag_name" class="col-12 col-form-label text-danger"> *Username</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="username" value="{{$client->username}}"  required="" />
          </div>
        </div>
      </div>
    

      <div class="col-sm-4">
        <div class="form-group">
          <label for="tag_name" class="col-12 col-form-label text-danger"> *Email</label>
          <div class="col-sm-12">
            <input type="email" class="form-control" name="email" value="{{$client->email}}" required="" />
          </div>
        </div>
      </div>

       <div class="col-sm-4">
        <div class="form-group">
          <label for="tag_name" class="col-12 col-form-label text-danger"> *Phone</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="phone" value="{{$client->phone}}" required="" />
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="tag_name" class="col-12 col-form-label text-danger"> *Status</label>
         <div class="col-sm-12">
            <select class="form-control" name="status" id="status" required="required">
                <option value="1"  @if( $client->status == 1) selected @endif >Active</option>
                <option value="2" @if( $client->status == 2) selected @endif >Delete</option>
                <option value="3" @if( $client->status == 3) selected @endif >Pending</option>
              </select>
          </div>
        </div>
      </div>

       <div class="col-sm-4">
              <div class="form-group">
                <label for="tag_status" class="col-12 col-form-label text-danger"> *Gender</label>
                <div class="col-sm-12">
                  <select class="form-control" name="gender" id="gender" required="required">
                      <option value="male"  @if( $client->gender == 'male') selected @endif >Male</option>
                      <option value="female" @if( $client->gender == 'female') selected @endif >Female</option>
                    </select>
                </div>
              </div>
            </div>

       <div class="col-sm-12">
       
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group ">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *First name</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="first_name" value="{{(!empty($client->first_name)) ? $client->first_name : '' }}" required="" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Last name</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="last_name" value="{{(!empty($client->last_name)) ? $client->last_name : '' }}" required="" />
                </div>
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
                                <label for="autocomplete" class="text-danger"> *Location/City/Address </label><br/>
                                <label>{{(!empty($client->address)) ? $client->address : '' }}</label>
                                <input type="text"  name="address" id="autocomplete" class="form-control" value="{{(!empty($client->address)) ? $client->address : '' }}">
                            </div>

                            <div class="form-group" id="lat_area">
                                <label for="latitude" class="text-danger"> *Latitude </label>
                                <input type="text" name="latitude" id="latitude" class="form-control" value="{{(!empty($client->latitude)) ? $client->latitude : '' }}">
                            </div>

                            <div class="form-group" id="long_area">
                                <label for="latitude" class="text-danger"> *Longitude </label>
                                <input type="text" name="longitude" id="longitude" class="form-control" value="{{(!empty($client->longitude)) ? $client->longitude : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
           

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *City</label>
                  <div class="col-sm-12">
                    <select class="form-control" name="city" id="city" required="required">
                      <option value="">Select City</option>
                      @foreach($cities as $city)
                        <option value="{{$city->id }}" @if($client->city == $city->id) selected @endif >{{ $city->name }} </option>
                      @endforeach
                    </select>
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Country</label>
                  <div class="col-sm-12">
                    <select class="form-control" name="country" id="country" required="required">
                      <option value="">Select Country</option>
                      @foreach($countries as $country)
                        <option value="{{$country->id }}"  @if($client->country == $country->id) selected @endif>{{ $country->name }}</option>
                      @endforeach
                    </select>
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger"> *Pobox</label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" name="postal" value="{{(!empty($client->postal)) ? $client->postal : '' }}" required="" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger">Fax</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="fax" value="{{(!empty($client->fax)) ? $client->fax : '' }}"  />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger">Mobile 2</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="mobile2" value="{{(!empty($client->mobile2)) ? $client->mobile2 : '' }}" />
                </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <div class="col-xs-6">
                  <label for="tag_name" class="col-12 col-form-label text-danger">Phone 2</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="phone2" value="{{(!empty($client->phone2)) ? $client->phone2 : '' }}" />
                </div>
                </div>
              </div>
            </div>
          </div>

           <div class="row text-center">
              <div class="col-12">
                <button class="btn btn-danger" type="submit"><i class="fa fa-save"></i> Update {{$client->username}}</button>
              </div>
            </div>
          </form>
      </div>
  </div>
</div>

<div class="box_general padding_bottom">
  <div class="header_box version_2">
    <h2  class="text-danger"><i class="fa fa-user text-danger"></i> Edit Client Profile Image: {{ $client->username }}</h2>
  </div>

   <div class="row">
      <div class="col-sm-3">
        <div class="text-center">
          @if(!empty($client->image))
            <img src="{{ asset('assets/uploads/clients/'.$client->image) }}" class="avatar img-thumbnail" height="192" width="192" alt="client_image">
          @else
            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar  img-thumbnail" alt="client_image">
          @endif
          <form class="form-horizontal" method="POST" action="{{ route('superadmin.client.update-image')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$client->id}}">
            <div class="form-group col-12">
              <div class="input-group">
                  <input type="file"  id="cover_photo" name="cover_photo">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                 <button class="btn btn-danger btn-block" type="submit"><i class="fa fa-image"></i> Update Image </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

@stop



@section('js')
<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
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
           });
       }
    </script>
@stop
