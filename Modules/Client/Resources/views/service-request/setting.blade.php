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
   
   

    <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="{{ route('client.dashboard') }}"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="{{ route('client.service-request') }}">Service Request List</a></li>
        </li>
        <li class="breadcrumb-item"><i class="fa fas fa-lock"></i> Service Request Settings</li>
       
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

        <div class="row">
          <div class="col-6 ">

            <div class="card">

              <div class="card-header card-header-custom">
                <p class="card-title"><i class="fa fas fa-tags"></i> Service Request Information</p>
              </div>
               <div class="card-body">

                 <div class="jumbotron p-2">
                      <div class="row text-center">
                        <div class="col-6 ">
                            <h6 >Service Request Status</h6>
                            @if(in_array($sr->status, ['new' , 'request-payment'])) 
                               <label class="pending text-uppercase text-white p-2">
                            @elseif(in_array($sr->status, ['received-payment'])) 
                              <label class="read text-uppercase text-white p-2">
                            @elseif(in_array($sr->status, ['in-progress'])) 
                               <label class="read text-uppercase text-white p-2">
                            @elseif(in_array($sr->status, ['cancel'])) 
                                <label class="unread text-uppercase text-white p-2">
                            @else
                              <label class="read text-uppercase text-white p-2">
                            @endif
                              {{ $sr->status }}
                            </label>
                           
                        </div>
                        <div class="col-6 ">
                            <h6 >Quote Amount AED</h6>
                            <label class="read text-uppercase text-white p-2">
                              {{ (!empty($sr->quote_amount) ? 'AED '. $sr->quote_amount : ' Not Available ' )}}
                            </label>
                        </div>
                      </div>
                    </div>


                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                         <label class="text-danger">Faults/Remarks</label>
                        <p>
                          {{ $sr->faults_remarks }}
                           <a href="#" class="floar-right"><i class="fa fa-image"></i> View Images</a>
                        </p>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                          <label class="text-danger">Garage Name</label>
                        <p>{{ $sr->garage->defaultGarageDescription[0]->garages_name }}</p>
                      </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="form-group">
                          <label class="text-danger">Garage Address</label>
                        <p>{{ $sr->garage->address }}, {{ $sr->garage->city->name }}, {{ $sr->garage->country->name }}, POBOX-{{ $sr->garage->postal }}</p>
                      </div>
                    </div>
                   
                    <div class="col-6">
                        <div class="form-group">
                            <label class="text-danger">Garage Email</label>
                          <p>{{ $sr->garage->email }}</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                            <label class="text-danger">Garage Phone</label>
                          <p>{{ $sr->garage->phone }}</p>
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Category</label>
                        <p>{{ $sr->category->name }}
                        </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Vehicle Information</label>
                        <p ><i class="fa fa-car"></i> {{  $sr->vehicle->plate_no }}
                        <a href="{{ route('client.vehicle.view',['id' => $sr->vehicle->id ])}}" class="floar-right">(Click Here)</a>
                        </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Created At</label>
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($sr->created_at)) }}</p>
                        </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Last Updated At</label>
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($sr->updated_at)) }}</p>
                      </div>
                    </div>
                  </div>
               </div>
              </div>
            </div>
          

          <div class="col-6">
            <div class="card">
             <div class="card-header card-header-custom">
                <p class="card-title"><i class="fa fas fa-money"></i> Payment Information</p>               
              </div>
              <div class="card-body table-responsive">
                    

                  @if($sr->status == 'request-payment')

                    <form class="form-horizontal" method="POST" action="{{ route('client.service-request.update-sr-payment-status')}}">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $sr->id }}">
                        <div class="form-group">
                            <h6 >Quote Amount AED</h6>
                            <label class="read text-uppercase text-white p-2">
                              AED {{  $sr->quote_amount }}
                            </label>
                        </div>
                        <div class="form-group">
                           <h6 >Make Payment</h6>
                          <select class="form-control" name="payment_type" id="payment_type" >
                             <option value="cod" selected="">Cash On Delivery</option>
                             <option value="telr" disabled="">Telr</option>
                          </select>
                        </div>

                        <div class="form-group">
                           <button type="submit" class="btn btn-success" data-dismiss="modal">Submit Payment</button>
                        </div>
                      
                    </form>
                 
                   @elseif($sr->status == 'new')
                      <label class="text-danger"><b>Information:</b><br/> Service request create and waiting for the Garage quote amount.</label>
                    @elseif($sr->status == 'cancel' || $sr->status == 'delete')
                      <label class="text-danger">Not required! Service request has cancel or deleted.</label>
                    @else

                      @if(!empty($sr_payment))

                      <div class="jumbotron p-2">
                        <div class="row text-center">
                          <div class="col-6 ">
                            <h6 >Payment amount</h6>
                            <label class="read text-uppercase text-white p-2">
                              AED {{ $sr_payment->amount }}
                            </label>
                          </div>
                          <div class="col-6 ">
                            <h6>Payment Status</h6>
                            <label class="read text-uppercase text-white p-2">
                              @if(!empty($sr_payment->status == 1))
                                Success
                              @elseif(!empty($sr_payment->status == 2))
                                Failed
                              @else
                                Pending
                              @endif
                            </label>
                          </div>
                        </div>
                      </div>


                        <div class="row text-center">
                          <div class="col-6 ">
                            <div class="form-group">
                              <label>Payment Date</label>
                              <p> {{ $sr_payment->date }}</p>
                            </div>
                          </div>
                          <div class="col-6 ">
                           <div class="form-group">
                              <label>Payment Type</label>
                              <p> {{ $sr_payment->payment_type }}</p>
                            </div>
                          </div>
                        </div>
                      @endif
                    @endif
                </div>

               
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
