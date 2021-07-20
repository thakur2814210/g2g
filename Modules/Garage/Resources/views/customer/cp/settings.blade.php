@extends('garage::layouts.master')




@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Customers Packages Update</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('garage.dashboard') }}"><i class="fa fas fa-home"></i> Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('garage.customers.packages-subscribed') }}">Customers Packages Subscribed List</a>
                </li>
                <li class="breadcrumb-item"><i class="fa fas fa-lock"></i> Customers Packages Update</li>
            </ol>
        </section>


        <section class="content-header">


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

                    <div class="box box-solid box-info">

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
                                        <h5 class="text-white">{{ $packageStatus }}</h5>
                                    </div>
                                    <div class="col-md-6 ">
                                        <h6 class="text-white">Package Amount</h6>
                                        <h5 class="text-white">{{  'AED '. number_format($ps->amount,2) }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <p>{{ $ps->client->user->first_name }} {{ $ps->client->user->last_name }}</p>
                                    </div>
                                </div>
                                @if( $ps->status == 1 )
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Customer Email</label>
                                            <p>{{ $ps->client->email }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Customer Phone</label>
                                            <p>{{ $ps->client->phone }}</p>
                                        </div>
                                    </div>
                                @endif
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Updated At</label>
                                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($ps->updated_at)) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label>V.I.P Pickup Opted?</label>
                                        <p>
                                            {{ $ps->vip_pickup_opted === 1 ? "Yes" : "No" }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label>V.I.P Pickup Amount</label>
                                        <p>                             {{ $ps->vip_pickup_opted === 1 ? 'AED '.$ps->vip_pickup_price : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="box-header">
                            <p class="box-title"><i class="fa fas fa-tags"></i>Vehicle Information</p>
                        </div>

                        <div class="box-body">

                            @if( $ps->status == 3 || $ps->status == 5  )
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Make</label>
                                            <p>{{ $ps->vehicle->vmake->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Model</label>
                                            <p>{{ $ps->vehicle->vmodel->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning text-center">
                                    <label class="text-danger">Complete Vehicle information will be available only if
                                        Package is
                                        active.</label>
                                </div>



                            @else

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Make</label>
                                            <p>{{ $ps->vehicle->vmake->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Model</label>
                                            <p>{{ $ps->vehicle->vmodel->name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plate No.</label>
                                            <p>{{ $ps->vehicle->plate_no }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Registration No</label>
                                            <p>{{ $ps->vehicle->registration_no }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Chassis No</label>
                                            <p>{{ $ps->vehicle->chassis_no }}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <p>{{ $ps->vehicle->color }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <p>{{ $ps->vehicle->year }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Current Mileage</label>
                                            <p>{{ $ps->vehicle->current_mileage }}</p>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>


                <div class="col-md-6">

                    <div class="box box-solid box-info">
                        <div class="box-header">
                            <p class="box-title"><i class="fa fas fa-money"></i> Payment Information</p>
                        </div>

                        @if(!empty($ps_payment) )

                            <div class="card-body table-responsive p-3">

                                <div class="jumbotron bg-success p-2 text-white">
                                    <div class="row text-center">
                                        <div class="col-md-6 ">
                                            <h6 class="text-white">Payment Amount</h6>
                                            <h5 class="text-white">AED {{ number_format($ps_payment->amount,2) }}</h5>
                                        </div>
                                        <div class="col-md-6 ">
                                            <h6 class="text-white">Payment Status</h6>
                                            <h5 class="text-white">{{ $paymentStatus }}</h5>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($ps_payment->date) && !empty($ps_payment->payment_type))
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

                                @if($ps_payment->status == 4 ||  $ps_payment->status == 2)
                                    <div class="clearfix"></div>
                                    <div class="row p-3">
                                        <div class="col-md-12">
                                            <form class="form-horizontal" method="POST"
                                                  action="{{ route('garage.customers.packages-subscription.update-payment-status')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $ps->id }}">
                                                <input type="hidden" name="service_package_id"
                                                       value="{{ $ps->servicePackage->id }}">
                                                <div class="alert alert-success">
                                                    <label class="text-center">Customer has attempt to paid payment in
                                                        COD mode,
                                                        please upadte the payment status</label>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-outline-danger "
                                                        name="status"
                                                        value="1"><i class="fa faw fa-lock"></i> Mark as Success
                                                </button>
                                                <button type="submit" class="btn btn-sm btn-outline-danger "
                                                        name="status"
                                                        value="2"><i class="fa faw fa-lock"></i> Mark as Failed
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                @if($ps->status == 5)
                                    <div class="clearfix"></div>
                                    <div class="row p-3">
                                        <div class="col-md-12 alert alert-warning">
                                            <p class="text-uppercase text-danger m-0">
                                                Information <small class="text-uppercase text-danger">Quote Amount is
                                                    already
                                                    send, Waiting untill customer paid the quote amount.</small>
                                            </p>
                                        </div>
                                    </div>
                                @endif


                            </div>

                        @else
                            @if($ps->status == 3  )
                                <div class="jumbotron p-0">
                                    <form class="form-horizontal" method="POST"
                                          action="{{ route('garage.customers.custom-package.update-package-quote-amount')}}">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $ps->id }}">
                                            <label class="text-danger">Quote Amount for the Custom Package requested by
                                                Customer.</label>
                                            <div class="form-group">
                                                <label>Quote Amount (AED)</label>
                                                <input class="form-control" type="number" name="amount" required="">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success" data-dismiss="modal">
                                                    Submit
                                                </button>
                                            </div>
                                            <small>It will notify customer and after that you need to verify the
                                                payment.</small>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif

                    </div>
                    <div class="clearfix"></div>

                    <div class="box box-solid box-info">
                        <div class="box-header">
                            <p class="box-title"><i class="fa fas fa-list"></i> List Of Service Requested</p>
                        </div>
                        <div class="box-body">
                            <section class="pricing">
                                <div class="container">
                                    @if(isset($catList['subCats']))
                                        <div class="box_general padding_bottom">
                                            <div class="row">
                                                @foreach($catList['mainCats'] as $cat)
                                                    <div class="col-md-12">
                                                        <label class="text-uppercase"><strong><i
                                                                        class="fa fa-chevron-circle-right"
                                                                        aria-hidden="true"></i> &nbsp;Main
                                                                Category: {{ $cat['name'] }}</strong></label>
                                                    </div>

                                                    @if(isset($catList['subCats'][$cat['id']]))
                                                        <div class="row p-1  m-0">
                                                            @foreach($catList['subCats'][$cat['id']] as $subcat)
                                                                <div class="col-md-6">
                                                                    <label class="form-check-label">{{ $subcat['name'] }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="row p-1 m-0">
                                                            <div class="col-md-12">
                                                                <small>No Sub Categories available.</small>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

            </div>

@stop
