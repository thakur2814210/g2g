@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Packages Subscritpion Update</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
       <li class="breadcrumb-item">
          <a href="{{ route('superadmin.subscriptions.garages.list') }}">Garage Packages Subscritpion List</a></li>
        </li>
      <li class="active">Garage Packages Subscritpion Update</li>
    </ol>
  </section>

   <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
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
                         <div class="box-body">

        <div class="row">
          <div class="col-md-6">

            <div class="box box-solid box-primary">

              <div class="box-header">
                <p class="box-title"><i class="fa fas fa-tags"></i>
                    {{ $ps->servicePackage->name }}
                  </p>
              </div>

              <div class="box-body">

                    <div class="jumbotron p-2 bg-success text-white">
                      <div class="row text-center">
                        <div class="col-md-6 ">
                            <h6 class="text-white">Package Status</h6>
                            <h5 class="text-white" >
                              @if($ps->status == 1)
                                Active
                              @elseif($ps->status == 2)
                                Cancel
                              @elseif($ps->status == 3)
                                Pending
                              @elseif($ps->status == 4)
                                Inactive
                              @elseif($ps->status == 5)
                                Request-Payemnt
                              @elseif($ps->status == 6)
                                Received-Payment
                              @elseif($ps->status == 7)
                                Required-Payment-Approval
                              @endif
                            </h5>
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

                  
                  <div class="col-md-12">
                    <div class="form-group">
                       <label>Garage Name</label>
                      <p>{{ $ps->garage->defaultGarageDescription[0]->garages_name }}</p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Email</label>
                      <p>{{ $ps->garage->email }}</p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Phone</label>
                      <p>{{ $ps->garage->phone }}</p>
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

               @if(!empty($ps_payment) )

                <div class="box-body">

                  <div class="jumbotron bg-success p-2 text-white">
                    <div class="row text-center">
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Amount</h6>
                        <h5 class="text-white" >AED {{ number_format($ps_payment->amount,2) }}</h5>
                      </div>
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Status</h6>
                        <h5 class="text-white">
                           @if($ps_payment->status == 1)
                            Success
                          @elseif($ps_payment->status == 2)
                            Failed
                          @elseif($ps_payment->status == 3)
                            Pending
                          @elseif($ps_payment->status == 4)
                            Required-Payment-Approval
                          @endif
                        </h5>
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
                      <div class="clearfix"></div>
                      <div class="row p-3">
                        <div class="col-md-12">
                         <form class="form-horizontal" method="POST" action="{{ route('superadmin.subscriptions.garages.update-status')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $ps->id }}">
                              <div class="alert alert-success">
                                <label class="text-center">Customer has attempt to paid payment in COD mode, please upadte the payment status</label>
                              </div>
                              <button type="submit"  class="btn btn-sm btn-outline-danger " name="status" value="1"> <i class="fa faw fa-lock"></i> Mark as Success</button>
                              <button type="submit"  class="btn btn-sm btn-outline-danger " name="status" value="2"><i class="fa faw fa-lock"></i> Mark as Failed</button>
                          </form>
                        </div>
                      </div>
                 @endif

                
            </div>
          @endif

          </div>
          
        </div>
       
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>

          
@stop