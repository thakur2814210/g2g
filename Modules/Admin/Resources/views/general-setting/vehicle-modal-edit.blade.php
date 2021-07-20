@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Vehicle Model</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="breadcrumb-item">
            <a href="{{ route('superadmin.settings.vehicle-modal') }}">Vehicle Model List</a>
        </li>
      <li class="active">Edit Vehicle Model</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title"> Edit: {{$vehicleModal->name}}</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
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
                          <div class="box-body">

                            <form class="form-horizontal" method="POST" action="{{ route('superadmin.settings.vehicle-modal.update')}}" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               <input type="hidden" name="id" value="{{$vehicleModal->id}}" />
                              <div class="card-body">
                                
                                 <div class="form-group row">
                                  <label for="tag_status" class="col-sm-2 col-form-label">Make</label>
                                  <div class="col-sm-10">
                                    <select class="form-control" name="vehicle_make_id" id="vehicle_make_id" required="required">
                                        <option value="">Select Make</option>
                                        @foreach($vehicleMakes as $vehicleMake)
                                          <option value="{{ $vehicleMake->id }}" @if($vehicleModal->make->id == $vehicleMake->id ) selected @endif>{{ $vehicleMake->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                  </div>
                                </div>


                                <div class="form-group row">
                                  <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" value=" {{$vehicleModal->name}}" required="required" />
                                  </div>
                                </div>
                              
                                <div class="form-group row">
                                  <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                                  <div class="col-sm-10">
                                    <select class="form-control" name="active" id="active" required="required">
                                      
                                      <option value="1" @if($vehicleModal->active == 1) selected @endif>Yes</option>
                                    <option value="0" @if($vehicleModal->active == 0) selected @endif>No</option>
                                    </select>
                                  </div>
                                </div>
                              
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Update {{$vehicleModal->name}}</button>
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

