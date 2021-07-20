@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customer Package Subscription Settings</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
       <li class="breadcrumb-item">
          <a href="{{ route('superadmin.subscriptions.clients.list') }}">Package Subscription List</a></li>
        </li>
      <li class="active">Customer Package Subscription Settings</li>
    </ol>
  </section>

  <section class="content">

     <div class="row">
          <div class="col-md-12">
            <div class="box box-danger">
               <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
                          <div class="row">
                            <div class="col-md-12">
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
                         <div class="box-body">



        <div class="row">
          <div class="col-md-6 ">

            <div class="box box-solid box-primary">

              <div class="box-header">
                <p class="box-title"><i class="fa fas fa-tags"></i> {{ $clientPackageSubscribe->servicePackage->name }}</p>
              </div>
               <div class="box-body">

                <div class="jumbotron p-2 bg-success text-white">
                  <div class="row text-center">
                    <div class="col-md-6 ">
                        <h6 class="text-white">Package Status</h6>
                        <h5 class="text-white" >
                           @if($clientPackageSubscribe->status == 1)
                          Active
                        @elseif($clientPackageSubscribe->status == 2)
                          Cancel
                        @elseif($clientPackageSubscribe->status == 3)
                          Pending
                        @elseif($clientPackageSubscribe->status == 4)
                          Inactive
                        @elseif($clientPackageSubscribe->status == 5)
                          Request-Payemnt
                        @elseif($clientPackageSubscribe->status == 6)
                          Received-Payment
                        @elseif($clientPackageSubscribe->status == 7)
                          Required-Payment-Approval
                        @endif
                        </h5>
                    </div>
                    <div class="col-md-6 ">
                        <h6 class="text-white">Package Amount</h6>
                        <h5 class="text-white" >{{  'AED '. number_format($clientPackageSubscribe->amount,2) }}</h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label>Garage Name</label>
                      <p>{{ $clientPackageSubscribe->garage->defaultGarageDescription[0]->garages_name }}</p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Email</label>
                      <p>{{ $clientPackageSubscribe->garage->email }}</p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Phone</label>
                      <p>{{ $clientPackageSubscribe->garage->phone }}</p>
                    </div>
                  </div>
                
                  <div class="col-md-12">
                    <div class="form-group">
                       <label>Vehicle</label>
                      <p>{{ $clientPackageSubscribe->vehicle->vmake->name }} ( {{ $clientPackageSubscribe->vehicle->vmodel->name }} )
                     
                      </p>
                    </div>
                  </div>
               
                 <div class="col-md-6">
                  <div class="form-group">
                     <label>Subscription Start At</label>
                      @if($clientPackageSubscribe->subscription_start_at)
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_start_at)) }}</p>
                      @else
                         <p class="text-uppercase">Not Available</p>
                      @endif
                    </p>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                     <label>Subscription End At</label>
                      @if($clientPackageSubscribe->subscription_end_at)
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_end_at)) }}</p>
                     @else
                        <p class="text-uppercase">Not Available</p>
                      @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                     <label>Created At</label>
                    <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->created_at)) }}</p>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                     <label>Last Updated At</label>
                    <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->updated_at)) }}</p>
                  </div>
                </div>

                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label>V.I.P Pickup Opted?</label>
                            <p>
                                {{ $clientPackageSubscribe->vip_pickup_opted === 1 ? "Yes" : "No" }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label>V.I.P Pickup Amount</label>
                            <p>                             {{ $clientPackageSubscribe->vip_pickup_opted === 1 ? 'AED '.$clientPackageSubscribe->vip_pickup_price : "N/A" }}
                            </p>
                        </div>
                    </div>

              </div>
           </div>
          </div>
        </div>
          

          <div class="col-md-6">
            <div class="box box-solid box-primary">
             <div class="box-header">
                <p class="box-title"><i class="fa fas fa-money"></i> Payment Information</p>               
              </div>
              <div class="box-body">
                      @if(!empty($clientPackageSubscribePayment))

                        <div class="jumbotron bg-success p-2 text-white">
                          <div class="row text-center">
                            <div class="col-md-6 ">
                              <h6 class="text-white" >Payment Amount</h6>
                              <h5 class="text-white" >AED {{ number_format($clientPackageSubscribePayment->amount,2) }}</h5>
                            </div>
                            <div class="col-md-6 ">
                              <h6 class="text-white" >Payment Status</h6>
                              <h5 class="text-white">
                               @if($clientPackageSubscribePayment->status == 1)
                                Success
                              @elseif($clientPackageSubscribePayment->status == 2)
                                Failed
                              @elseif($clientPackageSubscribePayment->status == 3)
                                Pending
                              @elseif($clientPackageSubscribePayment->status == 4)
                                Required-Payment-Approval
                              @endif
                            </h5>
                            </div>
                          </div>
                        </div>

                        @if(!empty($clientPackageSubscribePayment->date) && !empty($clientPackageSubscribePayment->payment_type) && $clientPackageSubscribePayment->status != 3)
                            <div class="row text-center">
                              <div class="col-md-6 ">
                                <div class="form-group">
                                  <label>Payment Date</label>
                                  <p> {{ $clientPackageSubscribePayment->date }}</p>
                                </div>
                              </div>
                              <div class="col-md-6 ">
                               <div class="form-group">
                                  <label>Payment Type</label>
                                  <p> {{ $clientPackageSubscribePayment->payment_type }}</p>
                                </div>
                              </div>
                            </div>
                        @endif
                      @endif
                </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
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
