@extends('garage.layout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Garage</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Add Garage</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
                          <div class="row">
                              <div class="col-md-12">
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
                                 @if (isset($status))
                                    <div class="alert alert-warning">
                                        {{ $status }}
                                    </div>
                                @endif
                              </div>
                            </div>
              
                            <div class="box-body">

                              <form class="form-horizontal" method="POST" action="{{ route('garage.save')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">

                                  <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-building" ></i>Garage
                                    </div>
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                              <label for="tag_name" class="col-sm-12 col-form-label">Garage/Shop (English)</label>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" name="garage_name_en" id="garage_name"  placeholder="Enter Garage Name" required="required" />
                                              </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                              <label for="tag_name" class="col-sm-12 col-form-label">Garage/Shop (Arabic)</label>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" name="garage_name_ar" id="garage_name"  placeholder="Enter Garage Name" required="required" />
                                              </div>
                                            </div>
                                        </div>
                                      </div>

                                       <div class="row">
                                         <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="tag_slug" class="col-sm-12 col-form-label">Description (English)</label>
                                              <div class="col-sm-12">
                                                <textarea rows="5" class="form-control" name="description_en" ></textarea> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="tag_slug" class="col-sm-12 col-form-label">Description (Arabic)</label>
                                              <div class="col-sm-12">
                                                <textarea rows="5" class="form-control" name="description_ar" ></textarea> 
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                
                                      <div class="row">
                                         <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="col-sm-12 col-form-label">Feature Image Upload</label>
                                              <div class="col-sm-12">
                                                <div class="custom-file"  class="form-control">
                                                  <input type="file"  id="image" name="image">
                                                </div>
                                              </div>
                                              <div class="col-sm-12 text-danger">
                                                <p><small>Upload large Image. Prefer 2000 x 600</small></p>
                                              </div>
                                            </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="tag_slug" class="col-sm-12 col-form-label">Slug</label>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Garage Slug" required="required" />
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>


                                 <!----------------------------------------------------------------------------
                                Garage Location
                              ------------------------------------------------------------------------------->

                              <div style="clear:both"></div>

                               <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-map-marker" ></i>Address / Location
                                    </div>
                                    <div class="box-body">

                                     <div class="row">
                                        <div class="col-md-12" style="padding: 30px;">
                                          <div class="form-group" >
                                              <label for="autocomplete" class="col-sm-12 col-form-label"> Location/City/Address </label>
                                              <input type="text"  name="address" id="autocomplete" class="form-control" placeholder="Select Location">
                                          </div>

                                          <div class="form-group" id="lat_area">
                                              <label for="latitude" class="col-sm-12 col-form-label"> Latitude </label>
                                              <input type="text" name="latitude" id="latitude" class="form-control">
                                          </div>

                                          <div class="form-group" id="long_area">
                                              <label for="latitude" class="col-sm-12 col-form-label"> Longitude </label>
                                              <input type="text" name="longitude" id="longitude" class="form-control">
                                          </div>
                                        </div>
                                      </div>


                                  <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">City</label>
                                           <div class="col-sm-12">
                                            <select class="form-control" name="city_id" id="city_id" required="required">
                                                <option value="" >Select City</option>
                                                @foreach($cities as $city)
                                                  <option value="{{ $city->id }}" >{{ $city->name }}</option>
                                                @endforeach 
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">Country</label>
                                          <div class="col-sm-12">
                                           
                                              <select class="form-control" name="country_id" id="country_id" required="required">
                                                <option value="" >Select Country</option>
                                                @foreach($countries as $country)
                                                  <option value="{{ $country->id }}" >{{ $country->name }}</option>
                                                @endforeach 
                                              </select>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">Pobox</label>
                                           <div class="col-sm-12">
                                            <input type="number" class="form-control" name="postal" id="postal" placeholder="Enter Postal" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                 
                                </div>
                              </div>
                              
                             
                              <!----------------------------------------------------------------------------
                                Garage Owner Information
                              ------------------------------------------------------------------------------->


                              <div style="clear:both"></div>

                              <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>Owner Information
                                    </div>
                                    <div class="box-body">

                               

                                   <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="tag_name" class="col-sm-12 col-form-label">Owner Name</label>
                                            <div class="col-sm-12">
                                               <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Enter Garage Owner Full Name" required="required" />
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="tag_slug" class="col-sm-12 col-form-label">Owner Phone</label>
                                          <div class="col-sm-12">
                                            <input type="number" class="form-control" name="owner_phone" id="owner_phone" placeholder="Enter Garage Owner Phone" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="tag_name" class="col-sm-12 col-form-label">Owner Email</label>
                                            <div class="col-sm-12">
                                              <input type="email" class="form-control" name="owner_email" id="owner_email" placeholder="Enter Garage Owner Officail Email" required="required" />
                                            </div>
                                          </div>
                                    </div>
                                  
                                 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="tag_slug" class="col-sm-12 col-form-label">Owner Address</label>
                                          <div class="col-sm-12">
                                             <input type="text" class="form-control" name="owner_address" id="owner_address" placeholder="Enter Garage Owner Address" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              @php
                              /*
                           

                              <div style="clear:both"></div>

                             @if(isset($catList['subCats']))

                                <div class="box box-solid box-primary">
                                  <div class="box-header">
                                      <i class="fa fa-tags" ></i>Garage Services
                                  </div>
                                  <div class="box-body">
                              
                                  <div style="padding-left: 30px;">
                                   @foreach($catList['mainCats'] as $cat)
                                  
                                     <br/>
                                      <p class="text-red"><input class="form-check" type="checkbox" name="cat_id[]" value="{{ $cat['id'] }}">
                                        <b>Main Category: {{ $cat['name'] }}</b></p>
                                       
                                      @if(isset($catList['subCats'][$cat['id']]))
                                        <div class="row">
                                         @foreach($catList['subCats'][$cat['id']] as $subcat)
                                          <div class="col-sm-12 col-md-4">
                                            <div class="form-check d-inline">
                                              <input class="form-check-input" type="checkbox" name="sub_cat_id[]" value="{{ $subcat['id'] }}">
                                              {{ $subcat['name'] }}
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                      </div>

                                      @else
                                        <p>No Sub Category.</p>

                                      @endif

                                    @endforeach

                                   </div>
                                </div>
                              </div>
                              @endif

                              

                              <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-clock-o" ></i>Working Hours
                                    </div>
                                    <div class="box-body">

                               
                                  
                                    $days = [
                                        'mon' => 'Monday',
                                        'tue' => 'Tuesday',
                                        'wed' => 'Wednessday',
                                        'thu' => 'Thrusday',
                                        'fri' => 'Friday',
                                        'sat' => 'Saturday',
                                        'sun' => 'Sunday',
                                      ];
                                      $optionTime = [
                                        'Closed', 
                                        '12:00 AM',
                                        '00:30 AM',
                                        '01:00 AM',
                                        '01:30 AM',
                                        '02:00 AM',
                                        '02:30 AM',
                                        '03:00 AM',
                                        '03:30 AM',
                                        '04:00 AM',
                                        '04:30 AM',
                                        '05:00 AM',
                                        '05:30 AM',
                                        '06:00 AM',
                                        '06:30 AM',
                                        '07:00 AM',
                                        '07:30 AM',
                                        '08:00 AM',
                                        '08:30 AM',
                                        '09:00 AM',
                                        '09:30 AM',
                                        '10:00 AM',
                                        '10:30 AM',
                                        '11:00 AM',
                                        '11:30 AM',
                                        '12:00 PM',
                                        '00:30 PM',  
                                        '01:00 PM',
                                        '01:30 PM',
                                        '02:00 PM',
                                        '02:30 PM',
                                        '03:00 PM',
                                        '03:30 PM',
                                        '04:00 PM',
                                        '04:30 PM',
                                        '05:00 PM',
                                        '05:30 PM',
                                        '06:00 PM',
                                        '06:30 PM',
                                        '07:00 PM',
                                        '07:30 PM',
                                        '08:00 PM',
                                        '08:30 PM',
                                        '09:00 PM',
                                        '09:30 PM',
                                        '10:00 PM',
                                        '10:30 PM',
                                        '11:00 PM',
                                        '11:30 PM',
                                      ];
                                 

                                  @foreach($days as $index => $day )
                                    <!-- /row-->
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label class="fix_spacing">{{$day}}</label>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                          <select name="ot_{{$index}}" class='form-control' required>
                                            @foreach($optionTime as $value )
                                              <option value="{{$value}}">{{$value}}</option> 
                                            @endforeach
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                       <div class="col-md-1"></div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                           <select name="ct_{{$index}}" class='form-control' required>
                                            @foreach($optionTime as $value )
                                              <option value="{{$value}}">{{$value}}</option> 
                                            @endforeach
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /row-->
                                  @endforeach
                                </div>
                              </div>
                              */
                              @endphp
                               

                             

                               <!----------------------------------------------------------------------------
                                Admin Section
                              ------------------------------------------------------------------------------->

                             

                               
                                  </div>
                                </div>
                              </div>
                            </div>
                              <!-- /.card-body -->
                            <div class="box-footer">
                              <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Setup New Garage</button>
                              <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
                            </div>
                            <!-- /.card-footer -->
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@stop


@section('js')
<script  defer src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
          $("#lat_area").addClass("d-none");
          $("#long_area").addClass("d-none");
          initialize();
       });
  

       function initialize() {
         
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               console.log(place);
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
   
   </script>
@stop
