@extends('client::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
   <link rel="stylesheet" href="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css') }}">
   <style type="text/css">
     select.form-control:not([size]):not([multiple]){
      height: 30px;
     }
     .form-control-sm, .input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn{
        padding: .25rem .5rem !important;
     }
   </style>
@stop



@section('content')

  <ol class="breadcrumb">
       <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Package Subscription List</li>
    </ol>

    <div class="row">
      <div class="col-12">
          @if (session('status'))
              <div class="alert alert-warning">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>

    <div class="box_general padding_bottom">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> Package Subscription List</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr style="background: #e9ecef">
                  <th>Id</th>
                  <th>Amount</th>
                  <th>Vehicle</th>
                  <th>Package</th>
                  <th>Garage</th>
                  <th>Duration</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Id</th>
                    <th>Amount</th>
                    <th>Vehicle</th>
                    <th>Package</th>
                    <th>Garage</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th width="20%">Action</th>
                </tr>
              </tfoot>
              <tbody>
              @if(!empty($packages) && count($packages) > 0)
                @foreach($packages as $package)
                  <tr>
                    <td>{{ $package->id }}</td>
                    <td>AED {{ $package->amount }}</td>
                    <td>{{ $package->vehicle->make }} | {{ $package->vehicle->model }}</td>
                    <td>{{ $package->servicePackage->name }}</td>
                    <td>{{ $package->garage->defaultGarageDescription[0]->garages_name }}</td>
                    <td>
                          @if(!empty($package->subscription_start_at) && !empty($package->subscription_start_at))
                            {{ date('M d, Y', strtotime($package->subscription_start_at)) }} - {{ date('M d, Y', strtotime($package->subscription_start_at)) }}
                          @else
                            {{ '--'}}
                          @endif
                    </td>
                    <td>
                      {{ $packageStatus[$package->status] }}
                    </td>
                    <td>

                            @if($package->servicePackage->slug == 'custom-package')
                              <a class="btn btn-sm btn-outline-danger "  href="{{route('client.custom-package.settings',['id' => $package->id])}}">
                                Update
                              </a>
                            @else
                              <a class="btn btn-sm btn-outline-danger "  href="{{route('client.packages.settings',['id' => $package->id])}}">
                                Update
                              </a>
                            @endif
                            &nbsp;
                            <a  class="btn btn-sm btn-outline-danger" href="{{route('client.packages.logs',['id' => $package->id])}}">
                              Log
                            </a>
                    </td>
                  </tr>
                 @endforeach
              @else
                <tr>
                  <td colspan="7">
                     No Customer subscription found.
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


@section('js')
    <script src="{{ asset('website-theme/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  
    
    <script src="{{ asset('website-theme/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('website-theme/admin/vendor/jquery.selectbox-0.2.js') }}"></script>  
    <script src="{{ asset('website-theme/admin/vendor/retina-replace.min.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery.magnific-popup.min.js') }}"></script>
    

     <script src="{{ asset('website-theme/admin/js/admin-datatables.js') }}"></script>

      <script >
    $(document).ready(function() {

      $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

        var data_id = '';

        if (typeof $(this).data('id') !== 'undefined') {

          data_id = $(this).data('id');
        }

        $('#modal_client_id').val(data_id);
      })
    });
     </script>
   
@stop