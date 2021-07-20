@extends('website.layout')

@section('content')
 <link rel="stylesheet" href="{{ asset('website-theme/css/bootstrap-datetimepicker.min.css') }}">
  <style type="text/css">
    
      

      .pricing hr {
        margin: 1.5rem 0;
      }

      .pricing .card-title {
        margin: 0.5rem 0;
        font-size: 0.9rem;
        letter-spacing: .1rem;
        font-weight: bold;
      }

      .pricing .card-price {
        font-size: 2rem;
        margin: 0;
      }

      .pricing .card-price .period {
        font-size: 0.8rem;
      }

      .pricing ul li {
        margin-bottom: 1rem;
      }

      .pricing .text-muted {
        opacity: 0.7;
      }

      
      label{
        font-size: 16px;
        color: #555 !important;
      }

      /* Hover Effects on Card */

      @media (min-width: 992px) {
        .pricing .card:hover {
          margin-top: -.25rem;
          margin-bottom: .25rem;
          box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
        }
        .pricing .card:hover .btn {
          opacity: 1;
        }
      }
   </style>

  <main>

    

    <div class="row p-1">
      <div class="col-12">
        <div class="container">

           <div class="row">
            <div class="col-12">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>* {{ $error }}</li>
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


          <div class="card ">
            <div class="card-header bg-danger text-white">
              <h5 class="text-white">{{trans('website.Custom Package Subscription')}}</h5>
            </div>
            <div class="card-body">
               <div id="accordion">

                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger header-login"><span class="badge badge-warning">1</span> {{trans('website.Login')}} </h5>
                      <h6>
                        <strong class="text-danger">{{trans('website.Uername')}}:</strong> {{ Auth::user()->user_name}}
                        <strong class="text-danger">{{trans('website.Email')}}:</strong> {{ Auth::user()->email}}
                        <strong class="text-danger">{{trans('website.Phone')}}:</strong> {{ Auth::user()->phone}}
                      </h6>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">2</span> {{trans('website.Select Vehicle')}}
                        <span class="vehicle-change-span"></span>
                      </h5>
                    </div>
                    <div id="vehicle" class="collapse show" data-parent="#accordion">
                      <div class="card-body">

                        @if(!empty($vehicles) && count($vehicles) > 0)      
                          <div class="form-group">
                            <p class="text-danger">{{trans('website.Select your vehicle')}}:</p>

                            @foreach($vehicles as $vehicle)
                             <div class="card flex-row flex-wrap">
                                  <div class="card-header border-0">
                                     <input type="radio"  name="vehicle_id" data-check="{{route('client.package.check-package-running',['vehicleId' => $vehicle->id])}}" value="{{ $vehicle->id }}" />
                                  </div>
                                  <div class="card-block px-2">
                                      <h6 style="margin: 0px;" class="card-title m-0 text-danger"><i class="fa fa-car"></i> {{$vehicle->plate_no}}</h6>
                                      <small> 
                                          <b> {{trans('website.Make')}}:</b> {{!empty($vehicle->vmake->name) ? $vehicle->vmake->name : null}}
                                      </small>
                                      <small> 
                                          <b> {{trans('website.Model')}}:</b> {{!empty($vehicle->vmodel->name) ?$vehicle->vmodel->name : null }}
                                      </small>
                                      <small> 
                                          <b> {{trans('website.Year')}}:</b> {{$vehicle->year}}
                                      </small>
                                  </div>
                              </div>
                             @endforeach
                          </div>  
                          <span id="vehicleError" class="text-danger"></span>
                        @endif
                                  
                        <div class="form-group">
                          <a class="btn btn-danger text-uppercase" data-toggle="collapse" href="#RegisterNewVehicle">
                            <i class="fa fas fa-plus"></i> {{trans('website.Register New Vehicle')}}
                          </a>
                          <button type="button"  class="btn btn-danger text-uppercase float-right btn-vehicle-continue" ><i class="fa fas fa-check-circle"></i> {{trans('website.Continue')}}</button>
                        </div>
 
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div id="RegisterNewVehicle" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                          <form class="form-horizontal" method="POST" action="{{ route('client.vehicle.save')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                             <div class="card-body">

                              <div class="row">
                                     <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger">{{trans('website.Plate No')}} * </label>
                                         <div class="col-12">
                                            <input type="text" class="form-control" name="plate_no" id="plate_no" placeholder="{{trans('website.Enter Plate No')}}" required="" />
                                          </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                       <div class="form-group">
                                        <label for="tag_slug" class="col-md-12 col-form-label text-danger">{{trans('website.Make')}} *</label>
                                        <div class="col-md-12">
                                          <select class="form-control" name="make" id="make" required="required">
                                             <option value="">{{trans('website.Select Vehicle Make')}}</option>
                                             @foreach($vehicle_makes as $make)
                                              <option value="{{$make->id}}" data-url="{{ route('client.vehicle.model',['id' => $make->id])}}"  >{{$make->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger">{{trans('website.Model')}} *</label>
                                          <div class="col-12">
                                            <select class="form-control" name="model" id="model" required="required">
                                               <option>--{{trans('website.Select Vehicle Models')}}--</option>
                                            </select>
                                          </div>
                                        </div>
                                  </div>
                              </div>
                             
                               <div class="row">

                                <div class="col-12 col-md-4">
                                  <div class="form-group">
                                    <label for="tag_slug" class="col-12 col-form-label text-danger">{{trans('website.Year')}} *</label>
                                    <div class="col-12">
                                      <input type="text" class="form-control" name="year" id="year" placeholder="{{trans('website.Enter Year')}}" required="required" />
                                    </div>
                                  </div>
                                </div>

                                 <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger">{{trans('website.Registration No')}}</label>
                                          <div class="col-12">
                                            <input type="text" class="form-control" name="registration_no" id="registration_no" placeholder="{{trans('website.Enter Registration No')}}"  />
                                          </div>
                                        </div>
                                  </div>


                                 <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger">{{trans('website.Chassis No')}}</label>
                                         <div class="col-12">
                                            <input type="text" class="form-control" name="chassis_no" id="chassis_no" placeholder="{{trans('website.Enter Chassis No')}}" />
                                          </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="row">


                                  <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger">{{trans('website.Color')}}</label>
                                          <div class="col-12">
                                            <input type="text" class="form-control" name="color" id="color" placeholder="{{trans('website.Enter Color')}}"/>
                                          </div>
                                        </div>
                                  </div>
                                  
                                  <div class="col-12 col-md-4">
                                      <div class="form-group">
                                        <label for="tag_name" class="col-12 col-form-label text-danger">{{trans('website.Current Mileage')}}</label>
                                         <div class="col-12">
                                          <input type="text" class="form-control" name="current_mileage" id="current_mileage" placeholder="{{trans('website.Enter Current Mileage')}}" />
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-4">
                                      <div class="form-group">
                                        <label for="tag_status" class="col-12 col-form-label text-danger">{{trans('website.Status')}}</label>
                                        <div class="col-12">
                                          <select class="form-control" name="status" id="status" required="required">
                                            <option value="1" >{{trans('website.Active')}}</option>
                                          </select>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="row">
                                <div class="col-12 ">
                                  <div class="form-group">
                                    <div class="col-12 ">
                                      <button type="submit" class="btn btn-success"><i class="fa fa-car" ></i> {{trans('website.Save New Vehicle')}}</button>
                                      <button type="reset" class="btn btn-danger ml-2"><i class="fa fa-times" ></i> {{trans('website.Reset')}}</button>
                                      <button type="button" class="btn btn-warning float-right btn-register-vehicle-continue"><i class="fa fa-check-circle" ></i> {{trans('website.Continue')}}</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </form>
                      </div>
                    </div>
                  </div>


                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">3</span> {{trans('website.Your Location')}}
                         <span class="location-change-span"></span>
                      </h5>
                    </div>
                    <div id="Location" class="collapse" data-parent="#accordion">
                      
                      <div class="card-body">

                        @if(!empty($c_locations) && count($c_locations) > 0)      
                            @foreach($c_locations as $index => $c_location)
                             <div class="card flex-row flex-wrap">
                                  <div class="card-header border-0">
                                     <input type="radio"  name="your_location" data-lat="{{$c_location->latitude}}" data-long="{{$c_location->longitude}}" data-city="{{$c_location->city_id}}" data-country="{{$c_location->country_id}}" data-address="{{$c_location->address}}" data-pobox="{{$c_location->pobox}}" value="{{$c_location->id}}" />
                                  </div>
                                  <div class="card-block px-2">
                                      <h6 style="margin: 0px;" class="card-title m-0 text-danger">{{$c_location->address}}</h6>
                                       <small> 
                                          <b> {{trans('website.City')}}:</b> {{$c_location->city->name}}
                                      </small>
                                      <small> 
                                          <b> {{trans('website.Country')}}:</b> {{$c_location->country->name}}
                                      </small>
                                      <small> 
                                          <b> {{trans('website.Pobox')}}:</b> {{$c_location->pobox}}
                                      </small>
                                  </div>
                              </div>
                             @endforeach
                        @endif

                     
                        <div class="form-group">
                           <a class="btn btn-danger text-uppercase" data-toggle="collapse" href="#AddLocations">
                             <i class="fa fas fa-plus"></i> {{trans('website.Add Locations')}}
                          </a>
                           <button type="button"  class="btn btn-danger text-uppercase btn-location-continue float-right" ><i class="fa fas fa-check-circle"></i> {{trans('website.Continue')}}</button>
                        </div>
                       
                      </div>
                    </div>

                      <div class="card">
                        <div id="AddLocations" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                             <form class="form-horizontal" method="POST" action="{{ route('client.profile.add-locations')}}">
                              {{ csrf_field() }}
                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group">
                                      <label class="text-danger"> {{trans('website.Location/City/Address')}} *</label>
                                      <input type="text"  name="address" id="autocomplete" class="form-control" placeholder="{{trans('website.Select Location')}}">
                                  </div>
                                </div>

                                
                                <div class="col-12 col-md-6">
                                  <div class="form-group" id="lat_area">
                                      <label class="text-danger"> {{trans('website.Latitude')}} *</label>
                                      <input type="text" name="latitude" id="latitude" class="form-control" readonly="" >
                                  </div>
                                </div>

                                <div class="col-12 col-md-6">
                                  <div class="form-group" id="long_area">
                                      <label class="text-danger"> {{trans('website.Longitude')}} *</label>
                                      <input type="text" name="longitude" id="longitude" class="form-control" readonly="">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                      <label class="text-danger"> {{trans('website.City')}} *</label>
                                       <select class="form-control" name="city_id" id="city" required="required">
                                          <option value="">{{trans('website.Select City')}}</option>
                                          @foreach($cities as $city)
                                            <option value="{{$city->id }}">{{ $city->name }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-12 col-md-4">
                                    <div class="form-group">
                                      <label class="text-danger"> {{trans('website.Country')}} *</label>
                                       <select class="form-control" name="country_id" id="country" required="required">
                                          @foreach($countries as $country)
                                            <option value="{{$country->id }}" selected="">{{ $country->name }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-12 col-md-4">
                                    <div class="form-group">
                                      <label class="text-danger"> {{trans('website.Pobox')}} *</label>
                                      <input type="number" class="form-control" name="pobox" id="pobox" placeholder="{{trans('website.Your pobox(5 digit only)')}}">
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-12 ">
                                    <div class="form-group">
                                      <div class="col-12 ">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-car" ></i> {{trans('website.Update Address')}}Update Address</button>
                                        <button type="reset" class="btn btn-danger ml-2"><i class="fa fa-times" ></i> {{trans('website.Reset')}}</button>
                                        <button  class="btn btn-warning float-right btn-update-location-continue"><i class="fa fa-check-circle" ></i> {{trans('website.Continue')}}</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">4</span> {{trans('website.Service List')}}
                         <span class="location-change-span"></span>
                      </h5>
                    </div>
                    <div id="Service" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <section class="pricing">
                          <div class="container">
                            @if(isset($catList['subCats']))
                              <div class="@if(\Config::get("app.locale") == 'en') float-left @else float-right @endif p-3">
                                  <div class="row">
                                   @foreach($catList['mainCats'] as $cat)
                                      <div class="col-md-12">
                                          <div class="form-check d-inline">
                                            <input class="form-check-input category_checkbox parent_{{ $cat['id'] }}" type="checkbox" name="cat_id[]" value="{{ $cat['id'] }}">
                                            <label class="form-check-label text-uppercase"><strong>&nbsp;{{trans('website.Main Category')}}: {{ $cat['name'] }}</strong></label>
                                          </div>
                                     
                                        @if(isset($catList['subCats'][$cat['id']]))
                                          <div class="row p-3">
                                            @foreach($catList['subCats'][$cat['id']] as $subcat)
                                              <div class="col-sm-12 col-md-6">
                                                <div class="form-check d-inline">
                                                  <input class="form-check-input sub_category_checkbox child_{{ $cat['id'] }}" type="checkbox" name="sub_cat_id[]" value="{{ $subcat['id'] }}">
                                                  <label class="form-check-label">{{ $subcat['name'] }}</label>
                                                </div>
                                              </div>
                                            @endforeach
                                        </div>
                                        @else
                                          <div class="row p-3">
                                             <div class="col-sm-12 col-md-6">
                                                <small>{{trans('website.No Sub Categories available')}}</small>
                                            </div>
                                          </div>
                                        @endif
                                      </div>

                                    @endforeach
                                   </div>
                                </div>
                              @endif
                          </div>
                            <div class="clearfix"></div>
                            @if($vip_pickup_enabled == 1)
                                <div class="jumbotron">
                                    <h5>{{trans('website.Pick and drop your car from your location?')}}</h5>
                                    <h6>AED {{$vip_pickup_amount}} {{trans('website.payable in cash')}}</h6>
                                    <label class="radio-inline"><input type="radio" class="vipPickupRadio" name="vipPickup" value="1">{{trans('website.Yes')}}</label>
                                    <label class="radio-inline"><input type="radio" class="vipPickupRadio" name="vipPickup" value="0" checked>{{trans('website.No')}}</label>
                                </div>
                            @endif
                        </section>
                        <div class="form-group">
                          <button type="button"  class="btn btn-danger text-uppercase btn-service-continue float-right" ><i class="fa fas fa-check-circle"></i> {{trans('website.Continue')}}</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">5</span> {{trans('website.Garages')}}
                        <span class="garage-change-span"></span>
                      </h5>
                    </div>
                    <div id="Garage" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <p class="text-danger"> {{trans('website.Garage list shown here based on your location and in KM')}} *</p>
                        <div id="garage_list">{{trans('website.Please wait')}}....</div>
                         <div class="form-card">                 
                          <div class="form-group">
                            <button type="button"  class="btn btn-danger text-uppercase btn-garage-continue float-right" ><i class="fa fas fa-check-circle"></i> {{trans('website.Continue')}}</button>
                          </div>
                         </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">6</span> {{trans('website.Duration')}}
                         <span class="Fault-change-span"></span>
                      </h5>
                    </div>
                    <div id="Fault" class="collapse" data-parent="#accordion">
                      <form id="msform" method="POST" action="{{ route('client.custom-package.save')}}">
                        {{ csrf_field() }}

                          <input type="hidden" name="vehicle_id" id="vehicle_id_hidden" value="">
                          <input type="hidden" name="garage_id" id="garage_id_hidden" value="">
                          <input type="hidden" name="sevices" id="sevices_hidden" value="">
                          <input type="hidden" name="address" id="address_hidden" value="">
                          <input type="hidden" name="latitude" id="latitude_hidden" value="">
                          <input type="hidden" name="longitude" id="longitude_hidden" value="">
                          <input type="hidden" name="city_id" id="city_hidden" value="">
                          <input type="hidden" name="country_id" id="country_hidden" value="">
                          <input type="hidden" name="pobox" id="pobox_hidden" value="">
                          <input type="hidden" name="vip_pickup_opted" id="vip_pickup_hidden" value="0">
                          <input type="hidden" name="vip_pickup_price" id="vip_pickup_price_hidden" value="{{$vip_pickup_amount}}">
                         
                          <div class="card-body">
                            <div class="form-group">
                              <label for="tag_name" class="col-12 col-form-label">{{trans('website.Subscription Duration(No Of Days)')}}</label>
                               <div class="col-12">
                                <input type="number" class="form-control" name="subscription_duration" id="subscription_duration" placeholder="{{trans('website.Enter Duration in days')}}"  required=""/>
                              </div>
                            </div>
                          </div> 
                         
                          <div class="row justify-content-center">
                            <div class="col-12 text-center">
                               <button type="submit" class="btn btn-success text-uppercase float-right" name="submit" id="submit"> <i class="fa fas fa-save"></i> {{trans('website.Subscribe Package')}}</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  

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

    $(document).ready(function (){
      $('select[name="make"]').on('change',function(){
         var makeId = $(this).val();
         var dataUrl = $('#make option:selected').attr('data-url');
        $('select[name="model"]').html('<option>{{trans("website.Please wait")}}</option>');
        
        // tis url not working on live
         if(makeId){
            $.ajax({
               url : dataUrl,
               type : "GET",
               dataType : "json",
               success:function(data)
               {
                  $('select[name="model"]').empty();
                  $.each(data, function(key,value){
                     $('select[name="model"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
               }
            });
         }
         else{
          $('select[name="state"]').empty();
         }
      });
  });

</script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>


<script>

  $('.btn-vehicle-continue').click(function(){

    if($('input[name="vehicle_id"]:checked').val() == undefined){
        var  alertText = "{{trans('website.Select atleast one vehicle')}}";
        alert(alertText);
      return;
    }else{
         var floatDir = (language == 'en') ? 'float-right' : 'float-left';
      var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#vehicle">{{trans("website.Change")}}</a>';
      $('.vehicle-change-span').html(changeBtnHtml);
      $('#vehicle').removeClass('show');

      $('#Location').addClass('show');
    }

  });

  $('.btn-register-vehicle-continue').click(function(){
     $('#RegisterNewVehicle').removeClass('show');
    $('#vehicle').addClass('show');
  });

  $('.btn-update-location-continue').click(function(){
     $('#AddLocations').removeClass('show');
     $('#Location').addClass('show');
  });

  


  $('.btn-location-continue').click(function(){

    if($('input[name="your_location"]:checked').val() == undefined){
        var  alertText = "{{trans('website.Select atleast one location or add new location')}}";
        alert(alertText);
    }else{
        var floatDir = (language == 'en') ? 'float-right' : 'float-left';
      var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Location">{{trans("website.Change")}}</a>';
      $('.location-change-span').html(changeBtnHtml);
      $('#Location').removeClass('show');
      $('#Service').addClass('show');
    }
  });


  // Category service...
        var category_checkbox = [];

        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        $('input.category_checkbox').on('change', function() {

          var split_cls = ($(this).attr('class')).split("category_checkbox ");
          var parent_cls = (split_cls[1]).split("_");
          var parent_id = parent_cls[1];

          if($(this).is(':checked')){

             // check all child also... 
            $('.child_' + parent_id).prop('checked', true); 
            $('.child_' + parent_id + ':checked').each(function () {
              category_checkbox.push($(this).val());
            });

            // add to array
            category_checkbox.push($(this).val());

          }else{
            // remove from array
            removeA(category_checkbox, $(this).val());
            
            // uncheck all child also...
            // remove all child id 
            $('.child_' + parent_id).prop('checked', false);  
            $('.child_' + parent_id + ':not(:checked)').each(function () {
              removeA(category_checkbox, $(this).val());
            });
          }
        });

        $('input.sub_category_checkbox').on('change', function() {

          var split_cls = ($(this).attr('class')).split("sub_category_checkbox ");
          var child_cls = (split_cls[1]).split("_");
          var child_id = child_cls[1];

          if($(this).is(':checked')){
            

            category_checkbox.push($(this).val());

             // check parent and their id
            $('.parent_' + child_id).prop('checked', true); 
            category_checkbox.push($('.parent_' + child_id).val()); 

          }else{

            // remove child id
            removeA(category_checkbox, $(this).val());

            // check if all chiild is unchecked then uncheck parent and renove id from array... 
            if($('.child_' + child_id + ':checked').length == 0){
              $('.parent_' + child_id).prop('checked', false);  
              removeA(category_checkbox, $('.parent_' + child_id).val());
            }
          }

        });

  

  $('.btn-service-continue').click(function(){
   
    
    var floatDir = (language == 'en') ? 'float-right' : 'float-left';
    var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Service">{{trans("website.Change")}}</a>';
    $('.location-change-span').html(changeBtnHtml);
    $('#Service').removeClass('show');
    $('#Garage').addClass('show');

    // lets get the garage list
    var param = {
         'language_id' : (language == 'en') ? 1: 2,
      'category' : "<?php echo $cat_slug ?>",
      'latitude' : $('input[name="your_location"]:checked').attr('data-lat'),
      'longitude': $('input[name="your_location"]:checked').attr('data-long'),
      'city_id': $('input[name="your_location"]:checked').attr('data-city'),
      'country_id' : $('input[name="your_location"]:checked').attr('data-country'),
      '_token' : '<?php echo csrf_token() ?>',
      'category_checkbox': category_checkbox,
    }
    $.ajax({
       type:'POST',
       url:'{{ route('client.package.garage-list')}}',
       data: param,
       success:function(data) {
          $('#garage_list').html(data.html);
       }
    });

  });

  $('.btn-garage-continue').click(function(){
    
    if( $("input[name='garage_id']:checked").length  == 0){
        var  alertText = "{{trans('website.Select atleast one garage')}}";
        alert(alertText);
      return;
    }
    var floatDir = (language == 'en') ? 'float-right' : 'float-left';
    var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Garage">{{trans("website.Change")}}</a>';
    $('.garage-change-span').html(changeBtnHtml);
    $('#Garage').removeClass('show');
    $('#Fault').addClass('show');

    $('#sevices_hidden').val(category_checkbox);
    $('#vehicle_id_hidden').val($('input[name="vehicle_id"]:checked').val());
    $('#garage_id_hidden').val($("input[name='garage_id']:checked").val());
    $('#address_hidden').val($('input[name="your_location"]:checked').attr('data-address'));
    $('#latitude_hidden').val($('input[name="your_location"]:checked').attr('data-lat'));
    $('#longitude_hidden').val($('input[name="your_location"]:checked').attr('data-long'));
    $('#city_hidden').val($('input[name="your_location"]:checked').attr('data-city'));
    $('#country_hidden').val($('input[name="your_location"]:checked').attr('data-country'));
    $('#pobox_hidden').val($('input[name="your_location"]:checked').attr('data-pobox'));
      $('#vip_pickup_hidden').val($('input[name="vipPickup"]:checked').val());
  });

  


</script>
@stop
