@extends('autoshop.layout')
@section('content')
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
     <div class="row">
         
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   @lang('website.My Address')
               </h2>
               <hr >
             </div>

            @include('autoshop.common.sidebar')
       </div>
       <div class="col-12 col-lg-9 ">
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
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
          </div>

           <div class="box_general padding_bottom">
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> @lang('website.My Address')
        </div>
        <div class="card-body">
          <div style="padding-bottom: 10px;">
            <a class="btn btn-sm btn-outline-danger "  href="{{ URL::to('/my-address/add')}}">
            <i class="fa fa-plus"></i> @lang('website.Add') @lang('website.Address')</a>
           <a class="btn btn-sm btn-outline-danger "  href="{{ URL::to('/my-address')}}">
            <i class="fa fa-list"></i>  @lang('website.Address') @lang('website.List')</a>
           </div>
            <form class="form-horizontal" method="POST" action="{{  URL::to('/my-address/update')}}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$result['clientLocation']['id']}}">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                    <label class="text-danger"> {{trans('website.Location/City/Address')}} *</label>
                    <input type="text"  name="address" id="autocomplete" class="form-control" value="{{$result['clientLocation']['address']}}">
                </div>
              </div>

              
              <div class="col-12 col-md-6">
                <div class="form-group" id="lat_area">
                    <label class="text-danger"> {{trans('website.Latitude')}} *</label>
                    <input type="text" name="latitude" id="latitude" class="form-control" value="{{$result['clientLocation']['latitude']}}" readonly="" >
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group" id="long_area">
                    <label class="text-danger"> {{trans('website.Longitude')}} *</label>
                    <input type="text" name="longitude" id="longitude" value="{{$result['clientLocation']['longitude']}}" class="form-control" readonly="">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> {{trans('website.City')}} *</label>
                     <select class="form-control" name="city_id" id="city" required="required">
                        <option value="">{{trans('website.Select City')}}</option>
                        @foreach($result['cities'] as $city)
                          <option value="{{$city->id }}" @if($result['clientLocation']['city_id'] == $city->id) selected @endif>{{ $city->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> {{trans('website.Country')}} *</label>
                     <select class="form-control" name="country_id" id="country" required="required">
                        @foreach($result['countries'] as $country)
                          <option value="{{$country->id }}" selected="">{{ $country->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> {{trans('website.Pobox')}} *</label>
                    <input type="number" class="form-control" name="pobox" id="pobox" value="{{$result['clientLocation']['pobox']}}">
                  </div>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> {{trans('website.Status')}} *</label>
                     <select class="form-control" name="status" id="status" required="required">
                       <option value="Active" @if($result['clientLocation']['status'] == 'Active') selected @endif >@lang('website.Active')</option>
                       <option value="Inactive" @if($result['clientLocation']['status'] == 'Inactive') selected @endif >@lang('website.Inactive')</option>
                      </select>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-12 ">
                  <div class="form-group">
                    <div class="col-12 ">
                      <button type="submit" class="btn btn-success"><i class="fa fa-car" ></i> {{trans('website.Update Address')}}</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
        </div>
      </div>
     </div>
   </div>
 </section>

@stop


@section('js')

<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&sensor=false&&callback=initialize" type="text/javascript"></script>

<script>

    var language = "{{\Config::get("app.locale")}}";
    
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




