@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
  
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Profile</li>
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
               My Profile
              </div>
            
              <div class="card-body">
              <div class="row">
                

                <div class="col-sm-12">
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group ">
                          <label for="tag_name" class="col-sm-3 col-form-label">User Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $users->name }}" readonly />
                          </div>
                        </div>
                      </div>

                       <div class="col-sm-6">
                          <div class="form-group ">
                              <label for="tag_name" class="col-sm-3 col-form-label">Email</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ $users->email }}" readonly />
                              </div>
                          </div>
                       </div>
                   </div>


                   <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group ">
                          <label for="tag_name" class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $users->phone }}" readonly />
                          </div>
                        </div>
                      </div>

                       <div class="col-sm-6">
                          <div class="form-group ">
                              <label for="tag_name" class="col-sm-3 col-form-label">Created At</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ $users->created_at }}" readonly />
                              </div>
                          </div>
                       </div>
                   </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@stop