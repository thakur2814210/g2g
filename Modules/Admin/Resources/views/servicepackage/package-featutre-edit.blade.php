@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Service Package Feature</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
       <li class="breadcrumb-item">
          <a href="{{ route('superadmin.service-package') }}">Service Packages List</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('superadmin.service-package.features') }}">Service Packages Features</a>
        </li>
      <li class="active">Edit Service Package Feature</li>
    </ol>
  </section>

       <!-- Main content -->
  <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title"> Edit Service Package Feature: {{$packagefeatures->feature_name}}</h3>
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

                      <form class="form-horizontal" method="POST" action="{{ route('superadmin.service-package.features.update')}}" enctype="multipart/form-data">
                         {{ csrf_field() }}
                         <input type="hidden" name="id" value="{{ $packagefeatures->id }}">
                      <div class="card-body">

                          <div class="form-group row">
                            <label for="tag_status" class="col-sm-2 col-form-label">Package</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="service_package_id" id="service_package_id" required="required">
                                  <option value="">Select package</option>
                                  @foreach($packages as $package)
                                     <option value="{{ $package->id }}"  @if( $packagefeatures->service_package_id == $package->id) selected @endif>{{ $package->slug }}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>


                          <div class="form-group row">
                            <label for="tag_name" class="col-sm-2 col-form-label">Feature Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="feature_name" id="feature_name" value="{{$packagefeatures->feature_name }}"  required="required" />
                            </div>
                          </div>
        
                          <div class="form-group row">
                            <label for="tag_name" class="col-sm-2 col-form-label">Feature Value</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="feature_value" id="feature_value" value="{{ $packagefeatures->feature_value }}" required="required" />
                            </div>
                          </div>   

                          <div class="form-group row">
                            <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="status" id="status" required="required">
                                <option value="1"  @if( $packagefeatures->status == 1) selected @endif >Active</option>
                                <option value="2" @if( $packagefeatures->status == 2) selected @endif >Disable</option>
                              </select>
                            </div>
                          </div>
                        
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-save" ></i> Update Service Package Feature</button>
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
