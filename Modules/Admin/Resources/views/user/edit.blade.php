@extends('adminlte::page')

@section('title', 'Manage Users')

@section('content_header')
    <h1>Manage Users</h1>
    <hr/>
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
            <h3 class="card-title">Edit User Information</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form class="form-horizontal" method="POST" action="{{ route('admin.user.update')}}">
               {{ csrf_field() }}
               <input type="hidden" name="id" value="{{ $users->id }}">
            <div class="card-body">
                <div class="form-group row">
                  <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $users->name }}" required="required" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tag_slug" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="{{ $users->email }}" required="required" />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tag_slug" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $users->phone }}" required="required" />
                  </div>
                </div>

                <div class="form-group row">
                <label for="tag_status" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <select class="form-control" name="role" id="role" required="required">
                      <option value="4" @if($users->role == 4) selected @endif >Client</option>
                      <option value="3"  @if($users->role == 3) selected @endif >Garage</option>
                    </select>
                </div>
              </div>


               <div class="form-group row">
                <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" name="status" id="status" required="required">
                      <option value="1"  @if($users->status == 1) selected @endif>Active</option>
                      <option value="2"  @if($users->status == 2) selected @endif>Delete</option>
                      <option value="3"  @if($users->status == 3) selected @endif="">Pending</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Update User Info</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
@stop
