@extends('garage.layout')

@section('title', 'Garage Dashboard')

@section('website_css')
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
          <a href="{{ route('garage.dashboard') }}"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Customer List</li>
      </ol>

     
       <div class="card">
        <div class="card-header">
         Customers List
       </div>
       
          <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                   <th>User</th>
                  <th>Code</th>
                   <th>Type</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Date</th>
                    <th>User</th>
                     <th>Code</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($customers) && count($customers) > 0)
                  @foreach($customers as $customer)
                    <tr>
                      <td>{{ $customer['updated_at'] }}</td>
                       <td>{{ $customer['client']['username'] }}</td>
                      <td>
                          @if(isset($customer['sr_code']))
                            {{ $customer['sr_code'] }}
                          @elseif(isset($customer['ps_code']))
                             {{ $customer['ps_code'] }}
                          @endif
                      </td>
                        <td>
                          @if(isset($customer['sr_code']))
                            Service Request
                          @elseif(isset($customer['ps_code']))
                            Package Subscribed
                          @endif
                      </td>
                     
                      <td>{{ $customer['category']['name'] }}</td>
                    
                      <td>
                          {{ $customer['status']['name'] }}
                      </td>
                      <td>
                          <a href="#" title="View Vehicle"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-eye"></i></button></a>
                      </td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        No customers Found.
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
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
