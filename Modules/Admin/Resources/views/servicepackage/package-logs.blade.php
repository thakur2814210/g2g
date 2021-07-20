@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
   <link rel="stylesheet" href="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css') }}">
@stop

@section('breadcrumb')
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="{{ route('superadmin.service-package') }}">Service Packages List</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('superadmin.service-package.features') }}">Service Packages Features</a>
        </li>
        <li class="breadcrumb-item active">Service Package Transaction</li>
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
         @if (session('status'))
              <div class="alert alert-warning">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>

    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gray">
              Service Package Transaction
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                      <th>User</th>
                      <th>Package</th>
                      <th>Activation Date</th>
                      <th>Expiration Date</th>
                      <th>Enable Disable Date</th>
                      <th>Transaction Type</th>
                      <th>Transaction Amount</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                      <th>User</th>
                      <th>Package</th>
                      <th>Activation Date</th>
                      <th>Expiration Date</th>
                      <th>Enable Disable Date</th>
                      <th>Transaction Type</th>
                      <th>Transaction Amount</th>
                      <th>Action</th>
                      </tr>
                    </tfoot>
                  <tbody>
                    @if(!empty($packagelogs) && count($packagelogs) > 0)
                      @foreach($packagelogs as $packagelog)
                        <tr>
                          <td>{{ $packagelog->id }}</td>
                          <td>{{ $packagelog->id }}</td>
                          <td>{{ $packagelog->id }}</td>
                          <td>{{ $packagelog->id }}</td>
                          <td>{{ $packagelog->id }}</td>
                          <td>{{ $packagelog->id }}</td>
                          <td>{{ $packagelog->id }}</td>
                          <td>{{ $packagelog->id }}</td>
                          <td>
                              <a href="" title="Edit Package"><button type="button" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i> View</button></a>
                          </td>
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="11">
                            No Package Logs Found.
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                  <div class="row" style="padding: 20px;">
                     @if(!empty($packagelogs) && count($packagelogs) > 0)
                       {{ $packagelogs->links() }}
                     @endif
                 </div>
              </div>
            </div>
          </div>
        </div>
@stop


@section('js')
    <script src="{{ asset('website-theme/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  
    
    <script src="{{ asset('website-theme/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('website-theme/admin/vendor/jquery.selectbox-0.2.js') }}"></script>  
    <script src="{{ asset('website-theme/admin/vendor/retina-replace.min.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery.magnific-popup.min.js') }}"></script>
    

     <script src="{{ asset('website-theme/admin/js/admin-datatables.js') }}"></script>

   
@stop