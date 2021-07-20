@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
  
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Change Password</li>
    </ol>
@stop

@section('content')

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="row">
    <div class="col-12">
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
              <div class="card-header">
                Change Password: {{ $users->email }}
              </div>
              <div class="card-body table-responsive">
                <form class="form-horizontal" method="POST" action="{{ route('superadmin.update-password')}}">
                   {{ csrf_field() }}
                   <input type="hidden" name="id" value="{{ $users->id }}">
                <div class="card-body">
                   <div class="form-group row">
                    <label for="tag_name" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name"  value="{{ $users->name }}" readonly="" />
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="tag_name" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" value="{{ $users->email }}" readonly="" />
                    </div>
                  </div>
                 
                  <div class="form-group row">
                    <label for="tag_name" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="password" id="password" placeholder="Enter New Password" required="required" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tag_slug" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="cpassword" placeholder="Enter Confirm Password"  required="required" />
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger"><i class="fa fa-key" ></i> Update Password</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
@stop
