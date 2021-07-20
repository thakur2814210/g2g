@extends('garage.layout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Garage Team</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
       <li>
          <a href="{{ route('garage.packages') }}">My Packages</a>
        </li>
      <li class="active">Package Subscribe</li>
    </ol>
  </section>

    <!-- Main content -->
  <section class="content">
      
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
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">

            <div class="box box-info">

              <div class="box-header">
                <i class="fa fas fa-tags"></i>
                    {{ $ps->servicePackage->name }}
              </div>

              <div class="box-body">

                    <div class="jumbotron p-2 bg-success text-white">
                      <div class="row text-center">
                        <div class="col-md-6 ">
                            <h6 class="text-white">Package Status</h6>
                            <h5 class="text-white" >{{ $packageStatus }}</h5>
                        </div>
                        <div class="col-md-6 ">
                            <h6 class="text-white">Package Amount</h6>
                            <h5 class="text-white" >{{  'AED '. number_format($ps->amount,2) }}</h5>
                        </div>
                      </div>
                    </div>
 
                    <div class="clearfix"></div>
                  
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Subscription Start At</label>
                              @if($ps->subscription_start_at)
                                <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($ps->subscription_start_at)) }}</p>
                              @else
                                 <p class="text-uppercase">Not Available</p>
                              @endif
                            </p>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Subscription End At</label>
                              @if($ps->subscription_end_at)
                                <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($ps->subscription_end_at)) }}</p>
                             @else
                                <p class="text-uppercase">Not Available</p>
                              @endif
                          </div>
                        </div>
                  
                    
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Created At</label>
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($ps->created_at)) }}</p>
                        </p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Last Updated At</label>
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($ps->updated_at)) }}</p>
                      </div>
                    </div>
                  </div>
              </div>
             </div>
            </div>
          

           <div class="col-md-6">

              <div class="box">
                <div class="box-header">
                  <i class="fa fas fa-money"></i> Payment Information
                </div>

               @if(!empty($ps_payment) )

                <div class="box-body table-responsive p-3">

                  <div class="jumbotron bg-success p-2 text-white">
                    <div class="row text-center">
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Amount</h6>
                        <h5 class="text-white" >AED {{ number_format($ps_payment->amount,2) }}</h5>
                      </div>
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Status</h6>
                        <h5 class="text-white" >{{ $paymentStatus }}</h5>
                      </div>
                    </div>
                  </div>

                  @if(!empty($ps_payment->date) && !empty($ps_payment->payment_type) && $ps->status != 3)
                  <div class="clearfix"></div>
                  <div class="row text-center">
                      <div class="col-md-6 ">
                        <div class="form-group">
                          <label>Payment Date</label>
                          <p> {{ $ps_payment->date }}</p>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                       <div class="form-group">
                          <label>Payment Type</label>
                          <p> {{ $ps_payment->payment_type }}</p>
                        </div>
                      </div>
                    </div> 
                  @endif

                  @if($ps_payment->status == 4) 
                   
                          <div class="alert alert-warning text-center p-3">
                            <p class="text-uppercase text-danger m-0">
                              Note: Cash on Delievery need to verify from the Admin.
                            </p>
                            <small class="text-danger">
                              Wait for the Admin approval Or conatct supports for further assistance.
                            </small>
                          </div>
                        
                          <form  method="POST" action="{{ route('garage.packages.cancel-subscribe-request')}}">
                            <div class="modal-body text-center p-3">
                                {{ csrf_field() }}
                                <input type="hidden" name="id"  value="{{ $ps->id }}">
                                <label> Are you sure want to delete this request?</label><br/>
                                <button type="submit" class="btn btn-danger">Cancel Request</button>
                            </div>
                          </form>
                        
                 @endif
                 
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
@stop