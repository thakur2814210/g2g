@extends('autoshop.layout')
@section('content')
       
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
        <ol class="breadcrumb padding_bottom">
          <li class="breadcrumb-item">
            <a href="{{ route('client.dashboard') }}">@lang('website.dashboard')</a>
          </li>
           <li class="breadcrumb-item">
            <a href="{{ route('client.vehicles') }}">@lang('website.Vehicle')</a>
          </li>
          <li class="breadcrumb-item active">@lang('website.Edit') @lang('website.Vehicle')</li>
        </ol>
        <br/>
     <div class="row">
        
         
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   @lang('website.My Account')
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

          <div class="box_general">
            <div class="card">
          <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-car"></i> @lang('website.Edit') @lang('website.Vehicle'): {{ $vehicles->plate_no }}</p>
          </div>
         

          <div class="card-body table-responsive p-0">
            <form class="form-horizontal" method="POST" action="{{ URL::to('/vehicles/update')}}">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $vehicles->id }}">
              <div class="card-body">

                 <div class="row">

                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> *@lang('website.Plate No')</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{ $vehicles->plate_no }}" required="required" />
                            </div>
                          </div>
                      </div>

                       <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *@lang('website.Make') ( @lang('website.Selected') : {{ !empty($vehicles->vmake->name) ? $vehicles->vmake->name : null }})</label>
                          <div class="col-12">
                            <select class="form-control" name="make" id="make" required="required">
                               <option value="">@lang('website.Select Vehicle Make')</option>
                               @foreach($vehicle_makes as $make)
                                <option value="{{$make->id}}" @if($make->id == $vehicles->make) selected @endif data-url="{{ URL::to('/vehicles/model/' .$make->id )}}"  >{{$make->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *@lang('website.Model') ( *@lang('website.Selected') : {{ !empty($vehicles->vmodel->name) ? $vehicles->vmodel->name : null }})</label>
                            <div class="col-12">
                              <select class="form-control" name="model" id="model" required="required">
                                 <option>@lang('website.Please wait')</option>
                              </select>
                            </div>
                          </div>
                    </div>

                    
                     
                </div>
               

                <div class="row">

                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-12 col-form-label text-danger"> *@lang('website.Year')</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="year" id="year" value="{{ $vehicles->year }}" required="required" />
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> @lang('website.Registration No')</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" value="{{ $vehicles->registration_no }}" />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> @lang('website.Chassis No')</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" value="{{ $vehicles->chassis_no }}"  />
                            </div>
                          </div>
                     </div>

                     
                </div>
               

               

               
                <div class="row">

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> @lang('website.Color')</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="color" id="color" value="{{ $vehicles->color }}"  />
                            </div>
                          </div>
                    </div>

                   

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> @lang('website.Current Mileage')</label>
                           <div class="col-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" value="{{ $vehicles->current_mileage }}" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> *@lang('website.Status')</label>
                          <div class="col-12">
                            <select class="form-control" name="status" id="status" required="required">
                              <option value="1"  @if( $vehicles->status == 1) selected @endif >@lang('website.Active')</option>
                              <option value="3" @if( $vehicles->status == 3) selected @endif >@lang('website.Hold')</option>
                              <option value="2" @if( $vehicles->status == 2) selected @endif >@lang('website.Delete')</option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <button type="submit" class="btn btn-danger @if( \Config::get('app.locale') == 'en' ) pull-left @else pull-right @endif"><i class="fa fa-save" ></i> @lang('website.Update Vehicle Information')</button>
                </div>

            </div>
            
          </form>
          </div>
        </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  

@stop


@section('js')
  <script type="text/javascript">
    jQuery(document).ready(function ()
    {
      jQuery('select[name="make"]').on('change',function(){
       
         var makeId = jQuery(this).val();
         var dataUrl = jQuery('#make option:selected').attr('data-url');
        jQuery('select[name="model"]').html("<option>@lang('website.Please wait')</option>");
        
        // tis url not working on live
         if(makeId){
            jQuery.ajax({
               url : dataUrl,
               type : "GET",
               dataType : "json",
               success:function(data)
               {
                  jQuery('select[name="model"]').empty();
                  jQuery.each(data, function(key,value){
                     jQuery('select[name="model"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
               }
            });
         }
         else{
          jQuery('select[name="state"]').empty();
         }
      });
    });
  </script>
   
@stop
