@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Service Request Update</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
       <li class="breadcrumb-item">
          <a href="{{ route('superadmin.service-requests') }}">Service Request List</a></li>
        </li>
      <li class="active">Service Request Update</li>
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

          <div class="col-md-6 ">
             <div class="box box-solid box-primary">
                <div class="box-header ">
                <p class="box-title"><i class="fa fas fa-tags"></i> Service Request Information</span>
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
                            @elseif(in_array($sr->status, ['delete'])) 
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

                    
                    <div class="form-group">
                      <label>faults_remarks</label>
                      <span>{{ $sr->faults_remarks }}</span>
                    </div>

                    @if(!empty($sr->image))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset('assets/uploads/service-request/' .$sr->image )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image1))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset('assets/uploads/service-request/' .$sr->image1 )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image2))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset('assets/uploads/service-request/' .$sr->image2 )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image3))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset('assets/uploads/service-request/' .$sr->image3 )}}" height="200" width="320" />
                      </div>
                    @endif


                    @if(!empty($sr->image4))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset('assets/uploads/service-request/' .$sr->image4 )}}" height="200" width="320" />
                      </div>
                    @endif

                    @if(!empty($sr->image5))
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="{{asset('assets/uploads/service-request/' .$sr->image5 )}}" height="200" width="320" />
                      </div>
                    @endif


                     <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage</label>
                          <span>{{ $sr->garage->defaultGarageDescription[0]->garages_name  }}
                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage Username</label>
                          <span>{{ $sr->garage->user->user_name }}
                          </span>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage User</label>
                          <span>{{ $sr->garage->user->first_name }} {{ $sr->garage->user->last_name }}
                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage Email</label>
                          <span>{{ $sr->garage->user->email }}
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Category</label>
                          <span>{{ $sr->category->name }}
                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Appointment At</label>
                          <span>{{ isset($sr->appointment_at) ? date('Y-m-d h:i:s a' , strtotime($sr->appointment_at)) : 'N/A' }}
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Created At</label>
                          <span>{{ date('Y-m-d h:i:s a' , strtotime($sr->created_at)) }}
                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Updated At</label>
                          <span>{{ date('Y-m-d h:i:s a' , strtotime($sr->updated_at)) }}
                          </span>
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
              <div class="box box-solid box-primary">
                <div class="box-header">
                  <p class="box-title"><i class="fa fas fa-money "></i> Payment Information</span>
                </div>

                <div class="box-body">
                    

                   @if($sr->status == 'new')
                       <label class="text-danger">Garage has not send the quote amount yet to the Customer.</label>
                    @elseif($sr->status == 'cancel' || $sr->status == 'delete')
                      <label class="text-danger">Not required! Service request has cancel or deleted.</label>
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


                        <div class="row text-center">
                          <div class="col-md-6 ">
                            <div class="form-group">
                              <label>Payment Date</label>
                              <span> {{ $sr_payment->date }}</span>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                           <div class="form-group">
                              <label>Payment Type</label>
                              <span> {{ $sr_payment->payment_type }}</span>
                            </div>
                          </div>
                        </div>
                      @endif
                    @endif
                </div>
              </div>
          </div>
        </div>

        <br/>

  
        <div class="row">

          <div class="col-md-6">

            <div class="box box-solid box-primary">

              <div class="box-header card-header-custom">
                <p class="box-title"><i class="fa fa-user"></i> Customer Information</span>
              </div>
               <div class="box-body">

                    <div class="form-group">
                      <label>Customer Name</label>
                      <span>{{ $sr->client->user->first_name }} {{ $sr->client->user->last_name }}</span>
                    </div>

                     <div class="form-group">
                      <label>Customer Email</label>
                      <span>{{ $sr->client->user->email }}</span>
                    </div>

                     <div class="form-group">
                      <label>Customer Phone</label>
                      <span>{{ $sr->client->user->phone }}</span>
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                      <span>{{ $sr->address }}</span>
                    </div>
                     <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                            <label>City</label>
                              <span>{{ $sr->t_city->name }}</span>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Country</label>
                             <span>{{ $sr->t_country->name }}</span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Pobox</label>
                             <span>{{ $sr->pobox }}</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label>Latitude</label>
                              <span>{{ $sr->latitude }}</span>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Longitude</label>
                             <span>{{ $sr->longitude }}</span>
                        </div>
                      </div>
                    </div>
               </div>
              </div>
            </div>
         
          

           <div class="col-md-6">
             <div class="box box-solid box-primary">
            <div class="box-header card-header-custom">
                <p class="box-title"><i class="fa fas fa-car"></i> Vehicle Information</span>               
              </div>

                <div class="box-body">
                 
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Make</label>
                          <span>{{ $sr->vehicle->vmake->name }}</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Model</label>
                          <span>{{ $sr->vehicle->vmodel->name }}</span>
                        </div>
                      </div>
                    
                       <div class="col-md-4">
                        <div class="form-group">
                          <label>Plate No.</label>
                          <span>{{ isset($sr->vehicle->plate_no) ? $sr->vehicle->plate_no : 'N/A' }}</span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Registration No</label>
                          <span>{{ isset($sr->vehicle->registration_no) ? $sr->vehicle->registration_no : 'N/A'}}</span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Chassis No</label>
                          <span>{{ isset($sr->vehicle->chassis_no) ? $sr->vehicle->chassis_no : 'N/A'}}</span>
                        </div>
                      </div>
                   
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Color</label>
                          <span>{{ isset($sr->vehicle->color) ? $sr->vehicle->color : 'N/A'}}</span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Year</label>
                          <span>{{ isset($sr->vehicle->year) ? $sr->vehicle->year : 'N/A'}}</span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Current Mileage</label>
                           <span>{{ isset($sr->vehicle->current_mileage) ? $sr->vehicle->current_mileage : 'N/A'}}</span>
                        </div>
                      </div>
                    </div>
              </div>
          </div>
        </div>
      </div>

      
          
@stop
