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
            <h3 class="card-title">Add New User</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 500px;">
            <form class="form-horizontal" method="POST" action="{{ route('admin.user.save')}}">
               {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                  <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter username" required="required" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tag_slug" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required="required" />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tag_slug" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone" required="required" />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tag_slug" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required="required" />
                  </div>
                </div>

                <div class="form-group row">
                <label for="tag_status" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <select class="form-control" name="role" id="role" required="required">
                      <option value="" >Select role</option>
                      <option value="4" >Client</option>
                      <option value="3" >Garage</option>
                    </select>
                </div>
              </div>


               <div class="form-group row">
                <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" name="status" id="status" required="required">
                      <option value="1" >Active</option>
                      <option value="2" >Delete</option>
                      <option value="3" selected="">Pending</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success btn-sm "><i class="fa fa-save" ></i> Create New User</button>
              <button type="reset" class="btn btn-danger btn-sm float-right"><i class="fa fa-trash  " ></i> Reset</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
@stop
