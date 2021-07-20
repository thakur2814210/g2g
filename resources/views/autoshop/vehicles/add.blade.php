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
          <li class="breadcrumb-item active">@lang('website.Add') @lang('website.Vehicle')</li>
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
            <div class="row">
      <div class="col-12">
        <div class="card">
         <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-car"></i> @lang('website.Add') @lang('website.Vehicle') </p>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

            <form class="form-horizontal" method="POST" action="{{ URL::to('/vehicles/save')}}">
              {{ csrf_field() }}

               <div class="card-body">

                 <div class="row">
                   <div class="col-12">
                      <p class="text-danger">* @lang('website.fields are mandatory') </p> 
                  </div>
                </div>


                <div class="row">


                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger"> *@lang('website.Plate No')</label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" placeholder="@lang('website.Enter Plate No')" required="required" />
                            </div>
                          </div>
                      </div>

                      <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *@lang('website.Make')</label>
                          <div class="col-12">
                            <select class="form-control" name="make" id="make" required="required">
                               <option value="">@lang('website.Select Vehicle Make')</option>
                               @foreach($vehicle_makes as $make)
                                <option value="{{$make->id}}" data-url="{{ URL::to('/vehicles/model/' .$make->id )}}"  >{{$make->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *@lang('website.Model')</label>
                            <div class="col-12">
                              <select class="form-control" name="model" id="model" required="required">
                                 <option>@lang('website.Please wait') </option>
                              </select>
                            </div>
                          </div>
                    </div>

                </div>
               

               

               
                 <div class="row">


                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-sm-12 col-form-label text-danger"> *@lang('website.Year')</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="year" id="year" placeholder="@lang('website.Enter Year')" required="Year" />
                        </div>
                      </div>
                    </div>

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger">@lang('website.Registration No')</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" placeholder="@lang('website.Enter Registration No')"  />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger">>@lang('website.Chassis No')</label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" placeholder="@lang('website.Enter Chassis No')"  />
                            </div>
                          </div>
                     </div>
                   
                </div>

               
               

               

                <div class="row">

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger">@lang('website.Color')</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="color" id="color" placeholder="@lang('website.Enter Color')"  />
                            </div>
                          </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-sm-12 col-form-label text-danger">>@lang('website.Current Mileage')</label>
                           <div class="col-sm-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" placeholder="@lang('website.Enter Current Mileage')" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-sm-12 col-form-label text-danger"> *@lang('website.Status')</label>
                          <div class="col-sm-12">
                            <select class="form-control" name="status" id="status" required="required">
                              <option value="1" >@lang('website.Active')</option>
                                <option value="2" >@lang('website.Delete')</option>
                                <option value="3" >@lang('website.Hold')</option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>

               
                <div class="form-group">
                    <button type="submit" class="btn btn-danger @if( \Config::get('app.locale') == 'en' ) pull-left @else pull-right @endif"><i class="fa fa-save" ></i> @lang('website.Save New Vehicle')</button>
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
  </section>
@stop

@section('js')
  <script type="text/javascript">
    jQuery(document).ready(function ()
    {
      jQuery('select[name="make"]').on('change',function(){
       
         var makeId = jQuery(this).val();
         var dataUrl = jQuery('#make option:selected').attr('data-url');
        jQuery('select[name="model"]').html('<option>PLEASE WAIT . . .</option>');
        
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
