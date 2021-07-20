@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Add New Service Package </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li class="breadcrumb-item">
          <a href="{{ route('superadmin.service-package') }}">Service Packages List</a>
        </li>
      <li class="active">Add New Service Package</li>
    </ol>
  </section>

   <!-- Main content -->
  <section class="content">

    <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title">Add New Service Package</h3>
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

                              <form class="form-horizontal" method="POST" action="{{ route('superadmin.service-package.save')}}" enctype="multipart/form-data">
                                 {{ csrf_field() }}
                              <div class="card-body">

                                  <div class="form-group row">
                                    <label for="tag_status" class="col-sm-2 col-form-label">Package For</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="package_for" id="package_for" required="required">
                                          <option value="">Select Package For</option>
                                          <option value="1">Client</option>
                                          <option value="2">Garage</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row " id="select_category">
                                    <label for="tag_status" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="section_id" id="section_id" >
                                          <option value="">Select category</option>
                                          @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Package Name" required="required" />
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Package Slug" required="required" />
                                      <p class="text-sm text-danger"> please eneter in small character and replace space with hyphen.</p>
                                    </div>

                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="description" id="description" placeholder="Enter Package Description" />
                                    </div>
                                  </div>

                                  

                                   <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="price" id="price" placeholder="Enter Package Price" required="required" />
                                    </div>
                                  </div>

                                   <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Promo Price</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="promo_price" id="promo_price" placeholder="Enter Package Promo Price" />
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Period</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="period" id="period" placeholder="Enter Package Period in days (15,30,365 example)" required="required" />
                                    </div>
                                  </div>

                                 
                                  <div class="form-group row">
                                    <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="status" id="status" required="required">
                                          <option value="">Select</option>
                                          <option value="1">Active</option>
                                          <option value="2">Delete</option>
                                          <option value="3">Unpublished</option>
                                      </select>
                                    </div>
                                  </div>
                                
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Create New Package</button>
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
   <script> 
        $('#select_category').show();
        $('#package_for').on('change', function() {
          if(this.value == 1){
             $('#select_category').show();
          }else{
            $('#select_category').hide();
          }
        });
  </script>
@stop
