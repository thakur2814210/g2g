@extends('adminlte::page')

@section('title', 'manage users')

@section('content_header')
    <h1>Manage Users</h1>
    <hr/>
@stop

@section('content')

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
              <h3 class="card-title ">Users Delete List</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed table-striped table-bordered">
                  <thead>
                    <tr> 
                      <th>Id</th>
                      <th>Username</th>
                      <th>Primary Email</th>
                      <th>Primary Phone</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($users) && count($users) > 0)
                      @foreach($users as $user)
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->phone }}</td>
                          <td>
                             @if($user->role == 3)
                              <span class="badge bg-info text-bold"> Garage</span>
                            @elseif($user->role == 4)
                               <span class="badge bg-warning text-bold"> Client</span>
                            @endif
                          </td>
                          <td>
                              <div class="btn-group">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-cogs"></i> Settings&nbsp;</button>
                                  <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-116px, -84px, 0px);">
                                    <a class="dropdown-item" href="{{ route('admin.user.edit',['id' => $user->id]) }}">Edit User Info</a>
                                    <a class="dropdown-item" href="{{ route('admin.user.change-password',['id' => $user->id]) }}">Update Password</a>
                                    <a class="dropdown-item" href="{{ route('admin.user.change-status',['id' => $user->id]) }}">Update Status</a>
                                  </div>
                                </div>
                              </div>
                          </td>
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="7">
                            No Deleted User Found.
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                  <div class="row" style="padding: 20px;">
                     @if(!empty($users) && count($users) > 0)
                       {{ $users->links() }}
                     @endif
                 </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@stop

@section('css')
    <!--link rel="stylesheet" href="/css/admin_custom.css"-->
@stop

