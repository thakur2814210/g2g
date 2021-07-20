@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Detail</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
       <li class="breadcrumb-item">
            <a href="{{ route('superadmin.garages.active') }}">Active Garages</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.garages.pending') }}">Pending Garages</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.garages.delete') }}">Delete Garages</a>
        </li>
        
      <li class="active">Garage Detail</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
               <div class="box-header">
                 <ul class="nav table-nav pull-right">
                    <li class="dropdown btn-danger">
                        <a class="dropdown-toggle btn-info btn-sm" data-toggle="dropdown" href="#">
                            Garage Information <span class="caret"></span>
                        </a>
                         <ul class="dropdown-menu">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('superadmin.garage.edit',['id' => $garage->id]) }}">Information</a></li>

                              <li role="presentation" class="divider"></li>

                              <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('superadmin.garage.working-hours.view',['id' => $garage->id]) }}">Working Hours</a></li>

                              <li role="presentation" class="divider"></li>

                              <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('superadmin.garage.services.view',['id' => $garage->id]) }}">Services</a></li>

                              <li role="presentation" class="divider"></li>

                              <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('superadmin.garage.team.view',['id' => $garage->id]) }}">Members</a></li>

                              <li role="presentation" class="divider"></li>

                               <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('superadmin.garage.image.view',['id' => $garage->id]) }}">Images</a></li>

                              <li role="presentation" class="divider"></li>
                              
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('superadmin.garage.video.view',['id' => $garage->id]) }}">Videos</a></li>
                          </ul>
                    </li>
                </ul>
                   
                </div>
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

                              <form class="form-horizontal" method="POST" action="{{ route('superadmin.garage.services.update')}}"  enctype="multipart/form-data">
                                
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $garage->id }}" />

                                <input type="hidden" name="form_action" value="{{!empty($garage_services) ? 'update' : 'insert'}}" />


                                
                                  @if(isset($catList['subCats']))
                                 

                                   <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i> Garage Services
                                    </div>
                                    <div class="box-body">


                                    @php
                                      $cat_id_arr = $sub_cat_id_arr = [];
                                      if($garage_services && count($garage_services->toArray())){
                                        $cat_id =  $garage_services->cat_id;
                                        $sub_cat_id = $garage_services->sub_cat_id;

                                        if(stripos($cat_id , ',') !== false) {
                                           $cat_id_arr[] = explode(',', $cat_id);
                                            $cat_id_arr = array_values($cat_id_arr[0]);
                                        }else{
                                           $cat_id_arr[] = $cat_id;
                                        }

                                       

                                        if(stripos($sub_cat_id , ',') !== false) {
                                           $sub_cat_id_arr[] = explode(',', $sub_cat_id);
                                            $sub_cat_id_arr = array_values($sub_cat_id_arr[0]);
                                        }else{
                                          $sub_cat_id_arr[] = $sub_cat_id;
                                        }

                                       
                                      }
                                      //dump($cat_id_arr);die;
                                     @endphp
                                    <div style="padding-left: 30px;">
                                     @foreach($catList['mainCats'] as $cat)

                                      
                                        <br/>
                                      <p class="text-red"><input class="form-check-input" type="checkbox" name="cat_id[]" value="{{ $cat['id'] }}" @if(in_array($cat['id'], $cat_id_arr)) checked @endif><b> Main Category :{{ $cat['name'] }}</b></p>
                                        @if(isset($catList['subCats'][$cat['id']]))
                                          <div class="row">
                                           @foreach($catList['subCats'][$cat['id']] as $subcat)
                                            <div class="col-sm-12 col-md-4">
                                              <div class="form-check d-inline">
                                                <input class="form-check-input" type="checkbox" name="sub_cat_id[]" value="{{ $subcat['id'] }}" @if(in_array($subcat["id"], $sub_cat_id_arr)) checked @endif> {{ $subcat['name'] }}
                                              </div>
                                          </div>
                                          @endforeach
                                        </div>
                                        @else
                                        <p>No Sub Category.</p>
                                        @endif
                                        <div style="clear:both"><br/></div>
                                    @endforeach
                                     </div>
                                    </div>
                                  </div>

                                   @endif



                                  
                                  
                                   


                                  
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Update Garage Information</button>
                                 
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

