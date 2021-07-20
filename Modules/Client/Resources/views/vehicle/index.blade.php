@extends('client::layouts.master')

@section('title', 'Client Dashboard')

@section('website_css')
     <link rel="stylesheet" href="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css') }}">
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
         @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>

    <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="{{ route('client.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Registered Vehicles</li>
      </ol>

      <div class="box_general padding_bottom">
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> Registered Vehicle
          <div class="card-tools float-right">
            <div class="input-group input-group-sm " style="width: 100px;">
              <div class="input-group-append">
                <a href="{{ route('client.vehicle.add')}}"><button type="button" class="btn btn-block btn-sm"><i class="fa faw fa-plus"></i>Add Vehicle</button></a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body card-body-custom">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr >
                  <th>Id</th>
                  <th>Plate No</th>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr >
                    <th>Id</th>
                    <th>Plate No</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($vehicles) && count($vehicles) > 0)
                  @foreach($vehicles as $vehicle)
                    <tr>
                      <td>{{ $vehicle->id }}</td>
                      <td>{{ $vehicle->plate_no }}</td>
                      <td>{{ $vehicle->vmake->name }}</td>
                      <td>{{ $vehicle->vmodel->name }}</td>
                      <td>
                        @if($vehicle->status == 1)
                          <span class="read">ACTIVE</span>
                        @elseif($vehicle->status == 3)
                          <span class="pending">HOLD</span>
                        @else
                          <span class="unread">DELETE</span>
                        @endif
                      </td>
                      <td>
                          
                          <a href="{{ route('client.vehicle.edit',['id' => $vehicle->id]) }}" title="Edit Vehicle"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> UPDATE</button></a>
                          <a href="{{ route('client.vehicle.delete',['id' => $vehicle->id]) }}" title="Delete Vehicle"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> DELETE</button></a>
                      </td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        No Vehicle Found.
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
   </div>

@stop


@section('website_js')

    <script src="{{ asset('website-theme/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  
    
    <script src="{{ asset('website-theme/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('website-theme/admin/vendor/jquery.selectbox-0.2.js') }}"></script>  
    <script src="{{ asset('website-theme/admin/vendor/retina-replace.min.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery.magnific-popup.min.js') }}"></script>
    

     <script src="{{ asset('website-theme/admin/js/admin-datatables.js') }}"></script>

   
   
    
@stop

