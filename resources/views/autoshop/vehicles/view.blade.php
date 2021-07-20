@extends('autoshop.layout')

@section('content')

<section class="profile-content">
   <div class="container">
         <ol class="breadcrumb padding_bottom">
          <li class="breadcrumb-item">
            <a href="{{ route('client.dashboard') }}">@lang('website.dashboard')</a>
          </li>
           <li class="breadcrumb-item">
            <a href="{{ route('client.vehicles') }}">@lang('website.Vehicle')</a>
          </li>
          <li class="breadcrumb-item active">@lang('website.View') @lang('website.Vehicle')</li>
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

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-car"></i> @lang('website.View') @lang('website.Vehicle')</p>
          </div>
         

          <div class="card-body table-responsive p-0">
           
              <div class="card-body">

                 <div class="row">

                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> *@lang('website.Plate No')</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{ $vehicles->plate_no }}" readonly="" />
                            </div>
                          </div>
                      </div>

                       <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *@lang('website.Make')</label>
                          <div class="col-12">
                             <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{$vehicles->vmake->name}}" readonly="" />
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *@lang('website.Model') ( @lang('website.Selected') : {{$vehicles->vmodel->name}})</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{$vehicles->vmodel->name}}" readonly="" />
                            </div>
                          </div>
                    </div>

                    
                     
                </div>
               

                <div class="row">

                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-12 col-form-label text-danger"> *@lang('website.Year')</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="year" id="year" value="{{ $vehicles->year }}" readonly=""  />
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> @lang('website.Registration No')</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" value="{{ $vehicles->registration_no }}" readonly="" />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> @lang('website.Chassis No')</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" value="{{ $vehicles->chassis_no }}"  readonly="" />
                            </div>
                          </div>
                     </div>

                     
                </div>
               

               

               
                <div class="row">

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> @lang('website.Color')</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="color" id="color" value="{{ $vehicles->color }}"  readonly="" />
                            </div>
                          </div>
                    </div>

                   

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> @lang('website.Current Mileage')</label>
                           <div class="col-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" value="{{ $vehicles->current_mileage }}" readonly="" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> *@lang('website.Status')</label>
                          <div class="col-12">
                             <input type="text" class="form-control" name="current_mileage" id="current_mileage" 
                             value="
                              @if( $vehicles->status == 1) @lang('website.Active') @endif
                              @if( $vehicles->status == 3) @lang('website.Hold') @endif
                              @if( $vehicles->status == 2) @lang('website.Delete') @endif
                             " readonly="" />
                          </div>
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


