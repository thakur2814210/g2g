@extends('client::layouts.master')

@section('title', 'Client Dashboard')



@section('content')

    <ol class="breadcrumb padding_bottom">
      <li class="breadcrumb-item">
        <a href="{{ route('client.dashboard') }}">Dashboard</a>
      </li>
       <li class="breadcrumb-item">
        <a href="{{ route('client.vehicles') }}">Vehicles</a>
      </li>
      <li class="breadcrumb-item active">View Vehicle</li>
    </ol>
   
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
            <p class="card-title"><i class="fa fas fa-car"></i> View Vehicle</p>
          </div>
         

          <div class="card-body table-responsive p-0">
           
              <div class="card-body">

                 <div class="row">

                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> *Plate No</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{ $vehicles->plate_no }}" readonly="" />
                            </div>
                          </div>
                      </div>

                       <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *Make</label>
                          <div class="col-12">
                             <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{$vehicles->vmake->name}}" readonly="" />
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *Model ( Selected : {{$vehicles->vmodel->name}})</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="{{$vehicles->vmodel->name}}" readonly="" />
                            </div>
                          </div>
                    </div>

                    
                     
                </div>
               

                <div class="row">

                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-12 col-form-label text-danger"> *Year</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="year" id="year" value="{{ $vehicles->year }}" readonly=""  />
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> Registration No</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" value="{{ $vehicles->registration_no }}" readonly="" />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> Chassis No</label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" value="{{ $vehicles->chassis_no }}"  readonly="" />
                            </div>
                          </div>
                     </div>

                     
                </div>
               

               

               
                <div class="row">

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> Color</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="color" id="color" value="{{ $vehicles->color }}"  readonly="" />
                            </div>
                          </div>
                    </div>

                   

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> Current Mileage</label>
                           <div class="col-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" value="{{ $vehicles->current_mileage }}" readonly="" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> *Status</label>
                          <div class="col-12">
                             <input type="text" class="form-control" name="current_mileage" id="current_mileage" 
                             value="
                              @if( $vehicles->status == 1) Active @endif
                              @if( $vehicles->status == 3) Hold @endif
                              @if( $vehicles->status == 2) Delete @endif
                             " readonly="" />
                          </div>
                        </div>
                    </div>
                </div>

                
            </div>
          </div>
@stop


