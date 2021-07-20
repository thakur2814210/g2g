@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Add Sub-Section </h1>
     <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}" >Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.category.list') }}">Section List</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.subcategory.list') }}">Sub-Section List</a>
        </li>
        <li class="breadcrumb-item active">Add Sub-Section</li>
    </ol>
  </section>





  <!-- Main content -->
  <section class="content">



    <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title">Add Sub Section</h3>
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
                <form class="form-horizontal" method="POST" action="{{ route('superadmin.subcategory.save')}}" enctype="multipart/form-data">
                   {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group row">
                      <label for="tag_status" class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="parent" id="parent" required="required">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (English)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Enter Sub Category Name (English)" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (Arabic)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Enter Sub Category Name (Arabic)" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Sub Category Slug" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter Sub Category Description" required="required" />
                      </div>
                    </div>


              

                  <div class="form-group row">
                    <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" id="status" required="required">
                          <option value="">Select</option>
                          <option value="1">Active</option>
                          <option value="2">Delete</option>
                        </select>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Save</button>
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
