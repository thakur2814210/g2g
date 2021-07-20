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
        <li class="breadcrumb-item active">Assign Role To User</li>
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
            Assign Role To User
          </div>
         
          <div class="card-body table-responsive p-0" style="height: 500px;">
            <form class="form-horizontal" method="POST" action="{{ route('superadmin.role.assign-user.save')}}">
              
              {{ csrf_field() }}
              <div class="card-body">
                
                <div class="form-group row">
                  <label for="tag_status" class="col-sm-2 col-form-label">Select User</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="user_id" id="user_id" required="required">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tag_status" class="col-sm-2 col-form-label">Select Role</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="role_id" id="role_id" required="required">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>
            
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Assing Role To User</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
