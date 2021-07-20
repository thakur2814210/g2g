@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
   
@stop

@section('breadcrumb')
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard')}}">Dashboard</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('superadmin.roles') }}">Manage Role</a>
        </li>
        <li class="breadcrumb-item active">Add New Role</li>
    </ol>
@stop

@section('content')

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
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-gray">
           Add New Role
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form class="form-horizontal" method="POST" action="{{ route('superadmin.role.save')}}">
               {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                  <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Role Name" required="required" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Role Slug" required="required" />
                  </div>
                </div>


               <div class="form-group row">
                <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" name="status" id="status" required="required">
                      <option value="1" >Active</option>
                      <option value="2" >Delete</option>
                      <option value="3" >Hold</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Create New Role</button>
              <button type="submit" class="btn btn-danger btn-sm float-right"><i class="fa fa-trash  " ></i> Reset</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
@stop
