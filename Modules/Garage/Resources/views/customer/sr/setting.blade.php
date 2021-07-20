@extends('garage.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Service Request Update</h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li class="breadcrumb-item">
            <a href="{{ route('garage.customers.service-request') }}">Customers Service Request List</a></li>
        <li class="active">Service Request Update</li>
      </ol>
    </section>

     <section class="content">
   

    
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

          <div class="col-md-6 ">
             <div class="box box-solid box-info">
                <div class="box-header">
                <p class="box-title"><i class="fa fas fa-tags"></i> Service Request Information</p>
              </div>
               <div class="box-body">
                  <div class="jumbotron p-2">
                      <div class="row text-center">
                        <div class="col-md-6 ">
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
                        <div class="col-md-6 ">
                            <h6 >Quote Amount AED</h6>
                            <label class="read text-uppercase text-white p-2">
                              {{ (!empty($sr->quote_amount) ? 'AED '. $sr->quote_amount : ' Not Available ' )}}
                            </label>
                        </div>
                      </div>
                    </div>
  
                    @if($sr->status !== 'completed' ) 
                    <div class="row text-center">
                      <div class="col-md-12 ">
                        <form class="form-horizontal" method="POST" action="{{ route('garage.customers.service-requestd.update-sr-status')}}">
                          {{ csrf_field() }}
                          <input type="hidden" name="id" value="{{ $sr->id }}">
                          <div class="form-group">
                             <h6 >Manage/ Update Status</h6>
                             
                             @if(in_array($sr->status, ['new' , 'request-payment'])) 
                                <input type="hidden" name="status" value="cancel">
                                <button class="btn btn-sm btn-outline-danger" title="Cancel Service can resume again">
                                    <i class=" fa fa-times"></i> Cancel Service Request
                                </button>  
                              @elseif(in_array($sr->status, ['received-payment'])) 
                                <input type="hidden" name="status" value="in-progress">
                                 <button class="btn btn-sm btn-outline-success ">
                                     <i class=" fa fa-check-circle"></i> Mark As Working
                                </button>  
                              @elseif(in_array($sr->status, ['in-progress'])) 
                                <input type="hidden" name="status" value="completed">
                                  <button class="btn btn-sm btn-outline-success ">
                                    <i class=" fa fa-check-circle"></i> Mark As Complete
                                </button> 
                              @else
                                <h4 class="text-danger m-0">Service request has cancelled</h4>
                              @endif
                          </div>
                     </form>
                      </div>
                    </div>
                    @endif

                   <div class="form-group">
                      <label>Faults Remarks | Additional Information</label>
                      <p>{{ $sr->faults_remarks }} </p>
                    </div>

                    @if(!empty($sr->image))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset($sr->image1 )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image1))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset($sr->image1 )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image2))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset($sr->image2 )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image3))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset($sr->image3 )}}" height="200" width="320" />
                      </div>
                    @endif


                    @if(!empty($sr->image4))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset($sr->image4 )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image5))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset($sr->image5 )}}" height="200" width="320" />
                      </div>
                    @endif



                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Category</label>
                          <p>{{ $sr->category->name }}
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Appointment At</label>
                           @if(!empty($sr->appointment_at))
                              <p>{{ date('Y-m-d h:i:s a' , strtotime($sr->appointment_at)) }}
                          @else
                            <p>NULL</p>
                          @endif
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Created At</label>
                          <p>{{ date('Y-m-d h:i:s a' , strtotime($sr->created_at)) }}
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Updated At</label>
                          <p>{{ date('Y-m-d h:i:s a' , strtotime($sr->updated_at)) }}
                          </p>
                        </div>
                      </div>
                    </div>

                   <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>V.I.P Pickup Opted?</label>
                          <p>
                              {{ $sr->vip_pickup_opted === 1 ? "Yes" : "No" }}
                          </p>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>V.I.P Pickup Amount</label>
                          <p>                             {{ $sr->vip_pickup_opted === 1 ? 'AED '.$sr->vip_pickup_price : "N/A" }}
                          </p>
                        </div>
                      </div>
                    </div>
                    
                     
               </div>
             </div>
          </div>

          <div class="col-md-6 ">
              <div class="box box-solid box-info">
                <div class="box-header ">
                  <p class="box-title"><i class="fa fas fa-money "></i> Payment Information</p>
                </div>

                <div class="box-body table-responsive">
                    

                   @if($sr->status == 'new')

                      <div class="jumbotron">
                       <label class="text-danger" style="padding: 10px;">Customer Request for Quote Amount</label>
                        <form class="form-horizontal" style="padding: 10px;" method="POST" action="{{ route('garage.customers.service-request.update-quote-amount')}}">
                          <div class="modal-body">
                              {{ csrf_field() }}
                              <input type="hidden" name="id" value="{{ $sr->id }}">

                              <div class="repeatable-container"></div>
                              <div class="row">
                                  <div class="col-md-5">
                                      <div class="dashed-separator hidden-xs"></div>
                                  </div>
                                  <div class="col-md-2 text-center">
                                      <input type="button" value="Add Row" class="add btn btn-info btn-sm" />
                                  </div>
                                  <div class="col-md-5">
                                      <div class="dashed-separator hidden-xs"></div>
                                  </div>
                              </div>

                              <br>
                              <br>

                              <div class="row mt-3 mb-3">
                                  <div class="col-md-7">
                                  </div>
                                  <div class="col-md-4 col-xs-10">
                                      <div class="row">
                                          <div class="col-md-4 col-xs-3 text-right text-success">
                                              <h4><strong>Total</strong></h4>
                                          </div>
                                          <div class="col-md-8 col-xs-9">
                                              <div class="form-group no-margin">
                                                  <input class="form-control sr_quote_total" type="text" name="amount" readonly>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-1 col-xs-2">
                                      <h4><strong>AED</strong></h4>
                                  </div>
                              </div>

                              <br><br>
                              <div class="row">
                                  <div class="col-md-12 text-center">
                                      <div class="form-group">
                                          <button type="submit" class="btn btn-success btn-lg" data-dismiss="modal">Submit</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </form>
                      </div>
                    @elseif($sr->status == 'cancel')
                      <label class="text-danger">Not required! Service request is cancelled.</label>
                    @else

                       @if(!empty($sr->amount_json))
                           <div class="table-responsive">
                               <table class="table table-bordered">
                                   <thead>
                                    <tr>
                                        <th>Particular</th>
                                        <th>Amount</th>
                                    </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($sr->amount_json as $key=>$val)
                                       <tr>
                                           <th>{{$val['particular']}}</th>
                                           <td>AED {{$val['amount']}}</td>
                                       </tr>
                                   @endforeach
                                   </tbody>
                                   <tfoot>
                                    <th>Total</th>
                                    <th>AED {{$sr->quote_amount}}</th>
                                   </tfoot>
                               </table>
                           </div>
                        @endif

                      @if(!empty($sr_payment))

                      <div class="jumbotron p-2">
                        <div class="row text-center">
                          <div class="col-md-6 ">
                            <h6 >Payment amount</h6>
                            <label class="read text-uppercase text-white p-2">
                              AED {{ $sr_payment->amount }}
                            </label>
                          </div>
                          <div class="col-md-6 ">
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

                      @if(!empty($sr_payment->status == 1))
                        <div class="row text-center">
                          <div class="col-md-6 ">
                            <div class="form-group">
                              <label>Payment Date</label>
                              <p> {{ $sr_payment->date }}</p>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                           <div class="form-group">
                              <label>Payment Type</label>
                              <p> {{ $sr_payment->payment_type }}</p>
                            </div>
                          </div>
                        </div>
                       @endif
                      @endif
                    @endif
                </div>
              </div>
          </div>
        </div>

        <br/>

  
        <div class="row">

          <div class="col-md-6">

            <div class="box box-solid box-info">

              <div class="box-header">
                <p class="box-title"><i class="fa fas fa-user-circle"></i> Customer Information</p>
              </div>
               <div class="box-body">

                   


                    <div class="form-group">
                      <label>Customer Name</label>
                      <p>{{ $sr->client->user->first_name }} {{ $sr->client->user->last_name }}</p>
                    </div>

                    <div class="form-group">
                      <label>Phone</label>
                      <p>{{ $sr->client->user->phone }}</p>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <p>{{ $sr->client->user->email }}</p>
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                      <p>{{ $sr->address }}</p>
                    </div>

                     <div class="form-group">
                        <label>City</label>
                          <p>{{ $sr->t_city->name }}</p>
                      </div>

                    <div class="form-group">
                       <label>Pobox</label>
                         <p>{{ $sr->pobox }}</p>
                    </div>

                   

                </div>
               </div>
              </div>
         
          

           <div class="col-md-6">
             <div class="box box-solid box-info">
            <div class="box-header">
                <p class="box-title"><i class="fa fas fa-car"></i> Vehicle Information</p>               
              </div>

                <div class="box-body">
                 


                     @if($sr->vehicle->vmake->name)
                      <div class="form-group">
                        <label>Make</label>
                        <p>{{ $sr->vehicle->vmake->name }}</p>
                      </div>
                    @endif

                     @if( $sr->vehicle->vmodel->name)
                      <div class="form-group">
                        <label>Model</label>
                        <p>{{ $sr->vehicle->vmodel->name }}</p>
                      </div>
                     @endif


                       @if($sr->vehicle->plate_no)
                        <div class="form-group">
                          <label>Plate No.</label>
                          <p>{{ $sr->vehicle->plate_no }}</p>
                        </div>
                       @endif


                       @if($sr->vehicle->registration_no)
                        <div class="form-group">
                          <label>Registration No</label>
                          <p>{{ $sr->vehicle->registration_no }}</p>
                        </div>
                       @endif


                       @if($sr->vehicle->chassis_no)
                        <div class="form-group">
                          <label>Chassis No</label>
                          <p>{{ $sr->vehicle->chassis_no }}</p>
                        </div>
                       @endif

                       @if($sr->vehicle->color)
                        <div class="form-group">
                          <label>Color</label>
                          <p>{{ $sr->vehicle->color }}</p>
                        </div>
                       @endif

                      @if($sr->vehicle->year)
                        <div class="form-group">
                          <label>Year</label>
                          <p>{{ $sr->vehicle->year }}</p>
                        </div>
                      @endif

                       @if($sr->vehicle->current_mileage)
                         <div class="form-group">
                          <label>Current Mileage</label>
                          <p>{{ $sr->vehicle->current_mileage }}</p>
                        </div>
                      @endif

                 
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>

    <style>
        .dashed-separator {
            border-bottom: 1px dashed #999;
            width: 100%;
            clear: both;
            margin-top: 15px;
        }
    </style>
      
          
@stop
