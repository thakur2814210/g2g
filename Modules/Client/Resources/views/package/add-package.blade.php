@extends('website.pageLayout')

@section('content')

 <link rel="stylesheet" href="{{ asset('website-theme/css/bootstrap-datetimepicker.min.css') }}">
  <style type="text/css">
    
      .pricing .card {
        border: none;
        border-radius: 1rem;
        transition: all 0.2s;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
      }

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
      

      #telr {
        width: 100%;
        min-width: 600px;
        height: 600px;
        frameborder: 0;
      }
      
    .modal-open .modal.modal-center {
        display: flex!important;
        align-items: center!important;
    }
    .modal-dialog {
        flex-grow: 1;
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
          <div class="card padding_bottom">
          <div class="card-header bg-danger text-white"><h5 class="text-white">{{trans('website.Want custom service in your package')}}?</h5> </div>
          <div class="card-body">
              <div class="row text-center">

                <div class="col-12">
                   <label>{{trans('website.No problem You can create custom package and send quote to Garage')}}</label><br/><br/>
                   <a href="{{ route('client.custom-package')}}" class="btn1 btn-success text-uppercase p-2">{{trans('website.Custom Package Subscription')}}</a>
                </div>
              </div>
          </div>
        </div>
        <div class="clearfix"><br/></div>
  
          <div class="card ">
            <div class="card-header bg-danger text-white">
              <h5 class="text-white">{{ $categories->name }} {{trans('website.Package Subscription')}}</h5>
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
                                     <input type="radio"  name="vehicle_id" value="{{ $vehicle->id }}" />
                                  </div>
                                  <div class="card-block px-2">
                                      <h6 style="margin: 0px;" class="card-title m-0 text-danger">{{$vehicle->plate_no}}</h6>
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
                             <form class="form-horizontal" method="POST" action="{{ route('client.add-new-location')}}">
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
                                        <button type="submit" class="btn btn-success"><i class="fa fa-car" ></i> {{trans('website.Update Address')}}</button>
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
                      <h5 class="text-danger"><span class="badge badge-warning">4</span> {{trans('website.Select Package')}}
                         <span class="package-change-span"></span>
                      </h5>
                    </div>
                    <div id="Package" class="collapse" data-parent="#accordion">
                      
                        <div class="form-card">   
                            @if(!empty($packages) && count($packages) > 0)
                                <div class="row">
                                   @foreach($packages as $package)
                                  <!-- Free Tier -->
                                  <div class="col-lg-4">
                                      <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                          <h4 class="card-title text-white text-uppercase text-center alert" style="background: #f0151f"> @if(\Config::get('app.locale') == 'en') {{ $package->name }}  @else {{ $package->name_ar }} @endif</h4>
                                          <h6 class="text-center p-0">{{'AED '. $package->price }}  | (<span class="period">{{ $package->period }} {{trans('website.Days')}}</span>)</h6>
                                          <hr>
                                          <ul class="fa-ul">
                                             @foreach($package->packageFeatures as $index => $features)
                                                @php
                                                  $pf_values = [];
                                                  $features->feature_value = (\Config::get('app.locale') == 'en') ? $features->feature_value : $features->feature_value_ar;
                                                  if (strpos($features->feature_value, ',') !== false) {
                                                     $pf_values = explode(',', $features->feature_value);
                                                  }else{
                                                    $pf_values[] = $features->feature_value;
                                                  }
                                                @endphp
                
                                                <li>
                                                    <h6 style="padding: 0px;">
                                                      <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> @if(\Config::get('app.locale') == 'en') {{ $features->feature_name }} @else {{ $features->feature_name_ar }} @endif
                                                    </h6>
                                                    @foreach($pf_values as $val)
                                                      <label>{{ $val }}</label><br/>
                                                    @endforeach
                                                </li>
                                                  
                                              @endforeach
                                          </ul>
                                        </div>
                                        <div class="card-footer text-center">
                                           <input type="radio" class="form-check-input" name="package_id" value="{{ $package->id}}"><span class="text-danger text-uppercase"> @lang('website.Select Package')</span>
                                        </div>
                                      </div>
                                  </div>
                                  @endforeach
                
                                </div>
                              @else
                              <p>@lang('website.No package for this request')</p>
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
                            <button type="button"  class="btn btn-danger text-uppercase btn-package-continue float-right" ><i class="fa fas fa-check-circle"></i> {{trans('website.Continue')}}</button>
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
                      <h5 class="text-danger"><span class="badge badge-warning">6</span> {{trans('website.Payment Information')}}
                         <span class="Fault-change-span"></span>
                      </h5>
                    </div>
                    <div id="Fault" class="collapse" data-parent="#accordion">
                      <form id="msform" method="POST" action="{{ route('client.package-subscription.save')}}">
                        {{ csrf_field() }}

                        <input type="hidden" name="vehicle_id" id="vehicle_id_hidden" value="">
                        <input type="hidden" name="garage_id" id="garage_id_hidden" value="">
                        <input type="hidden" name="package_id" id="package_id_hidden" value="">
                         <input type="hidden" name="address" id="address_hidden" value="">
                        <input type="hidden" name="latitude" id="latitude_hidden" value="">
                        <input type="hidden" name="longitude" id="longitude_hidden" value="">
                        <input type="hidden" name="city_id" id="city_hidden" value="">
                        <input type="hidden" name="country_id" id="country_hidden" value="">
                        <input type="hidden" name="pobox" id="pobox_hidden" value="">
                          <input type="hidden" name="vip_pickup_opted" id="vip_pickup_hidden" value="0">
                          <input type="hidden" name="vip_pickup_price" id="vip_pickup_price_hidden" value="{{$vip_pickup_amount}}">
                       
                        <div class="card-body">

                          <div class="payments">
                            <ul>
                              <li>
                                <label class="container_radio">{{trans('website.Cash On Delivery')}}
                                  <input type="radio" name="payment_type" value="cod" required>
                                  <span class="checkmark"></span>
                                </label>
                              </li>
                              <li>
                                <label class="container_radio" >{{trans('website.Credit Card')}}
                                  <input type="radio" name="payment_type" value="telr">
                                    <span class="checkmark"></span>
                                </label>
                                
                              </li>
                            </ul>
                            <button type="button" onClick='openTelrIframeModal()'  class="btn btn-success text-uppercase" name="payNow" id="payNow"> <i class="fa fas fa-save"></i> {{trans('website.Pay')}}</button>
                          </div>
                          <div id="msg"></div>
                        </div> 
                         
                          <div class="row justify-content-center">
                              <div class="col-12 text-center">
                                 <button type="button" onClick='submitDetailsForm(event)'  class="btn btn-success text-uppercase float-right" name="saveBtn" id="saveBtn"> <i class="fa fas fa-save"></i> {{trans('website.Subscribe Package')}}</button>
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
  
  
   <div class="modal fade in" id="telrModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-body text-center">
                   <div id="telrDiv1" class="text-center" style="min-height:100px;"><h2>{{trans('website.Please wait')}}...</h2></div>
                    <div id="telrDiv2" style="min-height:150px;">
                         <h2>{{trans('website.Are you Sure?')}}</h2>
                         <p>{{trans('website.Please complete the transaction in new tab and be back to Submit the form to conitune')}}...</p>
                         <p>{{trans('website.Once it is cancelled, please refresh the page to try again')}}</p>
                         <p><small style="color:#d30000">* {{trans('website.Please make sure your pop-up blocker is turned off')}}</small></p>
                         <button type="button" class="btn btn-danger btn-block text-uppercase" onclick="closeTelrModal()">{{trans('website.Cancel')}}</button>
                         <a id="telrIframe" href="" class="btn btn-success text-uppercase" target="_blank" style="display: none;"></a>
                         <br/><br/>
                         <p>{{trans('website.this page will automatically timeout in')}} <h2 id="counter"></h2> {{trans('website.minutes')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  

@stop

@section('js')

<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&sensor=false&&callback=initialize" type="text/javascript"></script>

<script>
    var language = "{{\Config::get("app.locale")}}";
    var floatDir = (language == 'en') ? 'float-right' : 'float-left';
    
    $.ajaxSetup({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

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
    
    function closeTelrModal(){
       $('#telrModal').modal('hide');
    }
    
    function opneTelrModal(){
        $('#telrModal').modal({backdrop: 'static',keyboard: false});
    }
    
    function openInNewTab(url){
        $('#telrIframe').attr('href', url);
        $('#telrIframe').get(0).click();
    }

    var telrCode = null;
    var telrAbort = "https://secure.telr.com/gateway/webview_abort.html";
    var interval;
    
    var secsToRemainingTime = function secsToRemainingTime(secs) {
      var mm = ('0'+~~(secs / 60)).slice(-2);
      var ss = ('0'+(secs % 60)).slice(-2);
      return mm + ':' + ss;
    };
    
    function showDialog() {
            var time = 2 * 60;
            console.log('start');
            $('#counter').html(secsToRemainingTime(time));
            
            
            interval = setInterval(function () {
              if (time == 0) {
                clearInterval(interval);
                interval = undefined;
                
                // invlaid the token
                if(telrCode) openInNewTab(telrCode);
                closeTelrModal();// hide the modal
                return;
              }
              if(time%5 == 0 || time == 1){
                checkPaymentStatus();
              } // if closed here
              console.log(secsToRemainingTime(--time));
              $('#counter').html(secsToRemainingTime(--time));
            }, 1000);
        }
        
    
    function openTelrIframeModal(){
        
        console.log('test ok');
        $('#telrDiv1').show();
        $('#telrDiv2').hide();
               
        // get the payment URL 
        var param = {
            'language_id' : (language == 'en') ? 1: 2,
            'requestPackage': $('#package_id_hidden').val(),
            'category' : "<?php echo $cat_slug ?>",
            '_token' : '<?php echo csrf_token() ?>',
            'location_id': $('input[name="your_location"]:checked').val(),
        }
        $.ajax({
           type:'POST',
           url:'{{ route('client.package-subscription.payment-by-telr')}}',
           data: param,
           success:function(data) {
               let resp = JSON.parse(data);
               if(resp.success ==1){
                   
                    telrCode = resp.data.webview.code;
                    openInNewTab(resp.data.webview.start);
                    
                    opneTelrModal();
                    $('#telrDiv1').hide();
                    $('#telrDiv2').show();
                   
                    // start the timer
                    showDialog();
               }else{
                   $('#telrModal').modal('hide');
                   alert('Something went wrong!!!');
               }
                
           }
        });  
    }
    
    function checkPaymentStatus(){
        // check status
        var param = {
            'refrenceCode' : telrCode,
            '_token' : '<?php echo csrf_token() ?>',
        }
        $.ajax({
           type:'POST',
           url:'{{ route('client.package-subscription.telr-payment-status')}}',
           data: param,
           success:function(data) {
                let resp = JSON.parse(data);
                console.log(data);
                if(resp.success == '1'){
                    closeTelrModal();
                    document.getElementById("msform").submit();
                }
            }
        });
        return false;
    }
    
    function submitDetailsForm(e) {
        e.preventDefault(); 
        let val_ =  $('input[name="payment_type"]:checked').val();
        if(val_ == 'telr'){ // credit card payment opted
            if(telrCode != null)  checkPaymentStatus();
        }else if(val_ == 'cod'){ // cod opted
            document.getElementById("msform").submit();
        }else{
            alert('Please select atleast one payment type.');
        }
        return;
    }
    
    
    $('#telrModal').on('hidden.bs.modal', function () {
      console.log('modal closed');
      if (interval) {
          clearInterval(interval);
          interval = undefined;
        }
        window.open(telrAbort, '_blank');
    })

    $(document).ready(function (){
       
        closeTelrModal();// hide the modal
        $('#payNow').hide(); // hide the pay button
        
        $('input[type=radio][name=payment_type]').change(function() {
            closeTelrModal();// hide the modal
            if (this.value == 'telr') $('#payNow').show();
        });
        
        
         $('select[name="make"]').on('change',function(){
             var makeId = $(this).val();
             var dataUrl = $('#make option:selected').attr('data-url');
             var pleaseWait = "{{trans('website.Please wait')}}";
            $('select[name="model"]').html('<option>'+pleaseWait+'</option>');
            
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
            }else{
              $('select[name="state"]').empty();
            }
        });
    });

  

  $('.btn-vehicle-continue').click(function(){
   
    if($('input[name="vehicle_id"]:checked').val() == undefined){
        var  alertText = "{{trans('website.Select atleast one vehicle or register your vehicle')}}";
        alert(alertText);
      return;
    }else{
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
      var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Location">{{trans("website.Change")}}</a>';
      $('.location-change-span').html(changeBtnHtml);
      $('#Location').removeClass('show');
      $('#Package').addClass('show');
    }
  });

  

  $('.btn-package-continue').click(function(){
   
    if( $("input[name='package_id']:checked").val() == undefined){
        var  alertText = "{{trans('website.Select atleast one package to continue')}}";
        alert(alertText);
        return;
    }

    var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Package">{{trans("website.Change")}}</a>';
    $('.package-change-span').html(changeBtnHtml);
    $('#Package').removeClass('show');
    $('#Garage').addClass('show');

    // lets get the garage list
    var param = {
        'language_id' : (language == 'en') ? 1: 2,
      'category' : "<?php echo $cat_slug ?>",
      'latitude' : $('input[name="your_location"]:checked').attr('data-lat'),
      'longitude': $('input[name="your_location"]:checked').attr('data-long'),
      'city_id': $('input[name="your_location"]:checked').attr('data-city'),
      'country_id' : $('input[name="your_location"]:checked').attr('data-country'),
      '_token' : '<?php echo csrf_token() ?>'
    }
    $.ajax({
       type:'POST',
       url:'{{ route('client.package-subscription.garage-list-category')}}',
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
    
    
    var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Garage">{{trans("website.Change")}}</a>';
    $('.garage-change-span').html(changeBtnHtml);
    $('#Garage').removeClass('show');
    $('#Fault').addClass('show');

    $('#package_id_hidden').val($("input[name='package_id']:checked").val());
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
