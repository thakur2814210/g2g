@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
   
@stop

@section('breadcrumb')
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Manage Roles</li>
    </ol>
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
              <div class="card-header">
                Roles List
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed table-striped table-bordered">
                  <thead>
                    <tr> 
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($roles) && count($roles) > 0)
                      @foreach($roles as $role)
                        <tr>
                          <td>
                              {{ $role->id }}
                          </td>
                          <td>{{ $role->name }}</td>
                          <td>{{ $role->slug }}</td>
                          <td>
                            @if($role->status == 1)
                              <span class="badge bg-success text-white">Active</span>
                            @elseif($role->status == 3)
                              <span class="badge bg-warning text-white">Hold</span>
                            @else
                              <span class="badge bg-danger text-white">Delete</span>
                            @endif
                          </td>
                          <td>
                              <a href="{{ route('superadmin.role.edit',['id' => $role->id]) }}"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> View</button></a>
                              <a href="{{ route('superadmin.role.delete',['id' => $role->id]) }}"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
                          </td>
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="7">
                            No Garage Found.
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                  <div class="row" style="padding: 20px;">
                     @if(!empty($garages) && count($garages) > 0)
                       {{ $garages->links() }}
                     @endif
                 </div>
              </div>
            </div>
          </div>
        </div>
@stop


