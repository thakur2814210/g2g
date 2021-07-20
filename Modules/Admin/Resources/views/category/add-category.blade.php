@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Section List</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.category.list') }}">Section List</a>
        </li>
      <li class="active">Add Section</li>
    </ol>
  </section>





  <!-- Main content -->
  <section class="content">

    


    <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title">Add New Section</h3>
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
                              <form class="form-horizontal" method="POST" action="{{ route('superadmin.category.save')}}" enctype="multipart/form-data">
                                 {{ csrf_field() }}
                                <div class="box-body">

                                  <div class="form-group row">
                                    <label for="tag_name" class="col-sm-2 col-form-label">Name (English)</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Enter Category Name (English)" required="required" />
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_name" class="col-sm-2 col-form-label">Name (Arabic)</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Enter Category Name (Arabic)" required="required" />
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Category Slug" required="required" />
                                      <p class="text-sm text-danger"> please eneter in small character and replace space with hyphen.</p>
                                    </div>

                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="description" id="description" placeholder="Enter Category Description" required="required" />
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_status" class="col-sm-2 col-form-label">Category Type</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="type" id="type" required="required">
                                          <option value="">Select category type</option>
                                          <option value="1">Quote</option>
                                          <option value="2">Package</option>
                                      </select>
                                    </div>
                                  </div>


                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Icon</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="cat_icon" id="cat_icon" placeholder="Enter Category Fa Icon" required="required" />
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
                                <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Save</button>
                                <button type="submit" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
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

