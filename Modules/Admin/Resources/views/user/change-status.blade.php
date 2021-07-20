@extends('adminlte::page')

@section('title', 'manage users')

@section('content_header')
    <h1>Manage Users</h1>
    <hr/>
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
          <div class="card-header bg-gray">
            <h3 class="card-title">Change Password: {{ $users->email }}</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <form class="form-horizontal" method="POST" action="{{ route('admin.user.update-status')}}">
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
                <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" name="status" id="status" required="required">
                      <option value="1" @if($users->status == 1) selected @endif>Active</option>
                      <option value="2" @if($users->status == 2) selected @endif>Delete</option>
                      <option value="3" @if($users->status == 3) selected @endif>Pending</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-key" ></i> Update Password</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
@stop
