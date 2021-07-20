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
        <li class="breadcrumb-item active">Edit Role</li>
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
               Edit Roles: {{ $roles->name }}
              </div>
              
              <div class="card-body table-responsive p-0">
                <form class="form-horizontal" method="POST" action="{{ route('superadmin.role.update')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$roles->id}}">
                    
                    <div class="card-body">
                      
                      <div class="form-group row">
                        <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="name" value="{{ $roles->name }}" required="required" />
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="slug" id="slug" value="{{ $roles->slug }}" required="required" />
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="status" id="status" required="required">
                              <option value="1" @if( $roles->status == 1) selected @endif >Active</option>
                              <option value="2" @if( $roles->status == 2) selected @endif >Delete</option>
                              <option value="3" @if( $roles->status == 3) selected @endif >Hold</option>
                            </select>
                        </div>
                      </div>
                    </div>
               
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Save</button>
                  </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
@stop

@section('css')
   
@stop

@section('js')
    
@stop