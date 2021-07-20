@extends('client::layouts.master')

@section('title', 'Client Dashboard')

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
   
    

   <ol class="breadcrumb padding_bottom">
      <li class="breadcrumb-item">
        <a href="{{ route('client.dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active"> Service Request List</li>
    </ol>

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


    <div class="box_general padding_bottom">
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> Service Request List</div>
        <div class="card-body">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>Code/Date</th>
                  <th>Category</th>
                  <th>Vehicle</th>
                  <th>Quote Amount(AED)</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>Code/Date</th>
                  <th>Category</th>
                  <th>Vehicle</th>
                  <th>Quote Amount(AED)</th>
                  <th>Status</th>
                  <th width="20%">Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($serviceRequests) && count($serviceRequests) > 0)
                  @foreach($serviceRequests as $index => $serviceRequest)
                    <tr>
                      <td class="text-center">{{ $index + 1 }}</td>
                      <td>
                          <label>{{ $serviceRequest->sr_code }}</label><br/>
                          <small>( {{ date('M d,Y', strtotime($serviceRequest->created_at)) }} )</small>
                      </td>

                      <td>{{ $serviceRequest->category->name }}</td>

                      <td><a href="{{ route('client.vehicle.view',['id' => $serviceRequest->vehicle->id ])}}">{{ $serviceRequest->vehicle->plate_no }}</a></td>
                       
                       <td class="text-center">
                           {{ (!empty($serviceRequest->quote_amount) ? 'AED '. $serviceRequest->quote_amount : 'Not Available' )}}
                        </td>
                       
                         <td class="text-center text-uppercase">
                          @if( $serviceRequest->status == 'cancel')
                            <label class="unread text-large">{{ $serviceRequest->status }}</label>
                          @elseif( $serviceRequest->status == 'new' || $serviceRequest->status == 'request-payment')
                           <label class="pending">{{ $serviceRequest->status }}</label>
                          @else
                             <label class="read">{{ $serviceRequest->status }}</label>
                          @endif

                        </td>
                       
                       <td>
                          <a class="btn btn-sm btn-outline-danger "  href="{{route('client.service-request.settings',['id' => $serviceRequest->id])}}">
                            Update
                          </a>
                          &nbsp;
                          <a  class="btn btn-sm btn-outline-danger" href="{{route('client.service-request.logs',['id' => $serviceRequest->id])}}">
                            Log
                          </a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        No Service Request Found.
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
