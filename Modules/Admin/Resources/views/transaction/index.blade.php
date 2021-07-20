@extends('admin::layouts.master')

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
        <li class="breadcrumb-item active">Payment List</li>
      </ol>

     
       
      <div class="row">
        <div class="col-6">
          <div class="card">
            <div class="card-header">Customers Package Subscription Payment</div>
              <div class="card-body table-responsive">
                <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr style="background: #e9ecef">
                       <th>Date</th>
                      <th>Amount</th>
                      <th>Commission</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr style="background: #e9ecef">
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Commission</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if(!empty($clientPackageSubscribes) && count($clientPackageSubscribes) > 0)
                      @foreach($clientPackageSubscribes as $clientPackageSubscribe)
                        <tr>
                           <td>{{ date('Y-m-d', strtotime($clientPackageSubscribe->date)) }}</td>
                          <td>AED {{ number_format($clientPackageSubscribe->amount,2) }}</td>
                          <td>
                            @php
                                  $commission_amount = $commission->client_package_subscription;
                                  if($commission_amount > 0)
                                    $f_amount = (float) ($clientPackageSubscribe->amount / $commission_amount);
                                  else
                                    $f_amount = 0;
                            @endphp
                            AED {{ number_format($f_amount,2) }}

                          </td>
                          <td>
                               @if($clientPackageSubscribe->status == 1)
                                  Success
                                @elseif($clientPackageSubscribe->status == 2)
                                  Failed
                                @elseif($clientPackageSubscribe->status == 3)
                                  Pending
                                @elseif($clientPackageSubscribe->status == 4)
                                  Required-Payment-Approval
                                @endif
                          </td>
                           <td>
                            <a class="btn btn-sm btn-outline-danger "  href="{{route('superadmin.subscriptions.clients.settings',['id' => $clientPackageSubscribe->id])}}">
                              View
                            </a>
                          </td>
                          
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="4">
                            No payment Found.
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
        </div>


        <div class="col-6">
          <div class="card">
            <div class="card-header">Customer Service Request Payment</div>
              <div class="card-body table-responsive">
                <table class="table table-head-fixed table-striped table-bordered" id="scrp" width="100%" cellspacing="0">
                  <thead>
                      <tr style="background: #e9ecef">
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Commission</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr style="background: #e9ecef">
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Commission</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if(!empty($serviceRequests) && count($serviceRequests) > 0)
                      @foreach($serviceRequests as $serviceRequest)
                        <tr>
                          <td>{{ date('Y-m-d', strtotime($serviceRequest->date)) }}</td>
                          <td>AED {{ number_format($serviceRequest->amount,2) }}</td>
                          <td>
                            @php
                                  $commission_amount = $commission->service_request;
                                  if($commission_amount > 0)
                                    $f_amount = (float) ($serviceRequest->amount / $commission_amount);
                                  else
                                    $f_amount = 0;
                            @endphp
                            AED {{ number_format($f_amount,2) }}
                          </td>
                          <td>
                               @if($serviceRequest->status == 1)
                                  Success
                                @elseif($serviceRequest->status == 2)
                                  Failed
                                @elseif($serviceRequest->status == 3)
                                  Pending
                                @elseif($serviceRequest->status == 4)
                                  Required-Payment-Approval
                                @endif
                          </td>
                          <td>
                             <a class="btn btn-sm btn-outline-danger "  href="{{ route('superadmin.service-requests.view',['id' => $serviceRequest->id]) }}">
                            View
                          </a>
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
      </div>




      
        <br/>
      
    
        <br/>
        <div class="card">
        <div class="card-header">
          Garage Package Subscription Payment
       </div>
       
          <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="gpsp" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Commission</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Commission</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($garagePackageSubscribes) && count($garagePackageSubscribes) > 0)
                  @foreach($garagePackageSubscribes as $garagePackageSubscribe)
                    <tr>
                      <td>{{ $garagePackageSubscribe->date }}</td>
                      <td>AED {{ number_format($garagePackageSubscribe->amount,2) }}</td>
                      <td>
                        @php
                              $commission_amount = $commission->garage_package_subscription;
                              if($commission_amount > 0)
                                $f_amount = (float) ($garagePackageSubscribe->amount / $commission_amount);
                              else
                                $f_amount = (float) ($garagePackageSubscribe->amount);
                        @endphp
                            AED {{ number_format($f_amount,2) }}
                      </td>
                      <td>
                           @if($garagePackageSubscribe->status == 1)
                              Success
                            @elseif($garagePackageSubscribe->status == 2)
                              Failed
                            @elseif($garagePackageSubscribe->status == 3)
                              Pending
                            @elseif($garagePackageSubscribe->status == 4)
                              Required-Payment-Approval
                            @endif
                      </td>
                      <td>
                        <a class="btn btn-sm btn-outline-danger "  href="{{route('superadmin.subscriptions.garages.settings',['id' => $garagePackageSubscribe->id])}}">
                          Settings
                        </a>
                      </td>
                      
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="4">
                        No payment Found.
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        <br/>

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
