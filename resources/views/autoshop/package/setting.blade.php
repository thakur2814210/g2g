@extends('autoshop.layout')
@section('content')
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
     <div class="row">
         
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   @lang('website.My Account')
               </h2>
               <hr >
             </div>

            @include('autoshop.common.sidebar')
       </div>
       <div class="col-12 col-lg-9 ">
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
           
              <div class="row">
          <div class="col-6 ">

            <div class="card">

              <div class="card-header card-header-custom">
                <p class="card-title"><i class="fa fas fa-tags"></i> {{ $clientPackageSubscribe->servicePackage->name }}</p>
              </div>
               <div class="card-body">

                <div class="jumbotron p-2 bg-success text-white">
                  <div class="row text-center">
                    <div class="col-6 ">
                        <h6 class="text-white">@lang('website.Package') @lang('website.Status')</h6>
                        <h5 class="text-white" >{{ trans('website.'.$packageStatus) }}</h5>
                    </div>
                    <div class="col-6 ">
                        <h6 class="text-white">@lang('website.Package') @lang('website.Amount')</h6>
                        <h5 class="text-white" >{{  'AED '. number_format($clientPackageSubscribe->amount,2) }}</h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                       <p class="font-weight-bold">@lang('website.Garage')</p>
                      <p>{{ isset($clientPackageSubscribe->garage->defaultGarageDescription[0]->garages_name) ? $clientPackageSubscribe->garage->defaultGarageDescription[0]->garages_name : trans('website.Not Available') }}</p>
                    </div>
                  </div>
                
                  <div class="col-12">
                    <div class="form-group">
                       <p class="font-weight-bold">@lang('website.Vehicle')</p>
                       @if(isset($clientPackageSubscribe->vehicle->vmake->name ))
                        <p>{{ $clientPackageSubscribe->vehicle->vmake->name }}
                        <a href="{{ route('client.vehicle.view',['id' => $clientPackageSubscribe->vehicle->id ])}}" class="floar-right"><i class="fa fa-car"></i> @lang('website.VIEW')</a>
                        </p>
                      @else
                        {{ trans('website.Not Available')}}
                      @endif

                    </div>
                  </div>
               
                 <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold">@lang('website.Subscription') @lang('website.Start At')</p>
                      @if($clientPackageSubscribe->subscription_start_at)
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_start_at)) }}</p>
                      @else
                         <p class="text-uppercase">@lang('website.Not Available')</p>
                      @endif
                    </p>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold">@lang('website.Subscription') @lang('website.End At')</p>
                      @if($clientPackageSubscribe->subscription_end_at)
                        <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_end_at)) }}</p>
                     @else
                        <p class="text-uppercase">@lang('website.Not Available')</p>
                      @endif
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold">@lang('website.Created At')</p>
                    <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->created_at)) }}</p>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold">@lang('website.Last Updated At')</p>
                    <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($clientPackageSubscribe->updated_at)) }}</p>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                     <p class="font-weight-bold">@lang('website.Pick and drop your car from your location?')</p>
                      <p>
                          @if($clientPackageSubscribe->vip_pickup_opted === 1)
                              @lang('website.Yes'), AED {{$clientPackageSubscribe->vip_pickup_price}} @lang('website.payable in cash')
                          @else
                              @lang('website.No')
                          @endif
                      </p>
                  </div>
                </div>


              </div>
           </div>
          </div>
        </div>
          

          <div class="col-6">
            <div class="card">
             <div class="card-header card-header-custom">
                <p class="card-title"><i class="fa fas fa-money"></i> @lang('website.Payment') @lang('website.Information')</p>               
              </div>
              <div class="card-body table-responsive">
                      @if(!empty($clientPackageSubscribePayment))

                        <div class="jumbotron bg-success p-2 text-white">
                          <div class="row text-center">
                            <div class="col-6 ">
                              <h6 class="text-white" >@lang('website.Payment') @lang('website.Amount')</h6>
                              <h5 class="text-white" >AED {{ number_format($clientPackageSubscribePayment->amount,2) }}</h5>
                            </div>
                            <div class="col-6 ">
                              <h6 class="text-white" >@lang('website.Payment') @lang('website.Status')</h6>
                              <h5 class="text-white" >{{ trans('website.'.$paymentStatus) }}</h5>
                            </div>
                          </div>
                        </div>

                        @if(!empty($clientPackageSubscribePayment->date) && !empty($clientPackageSubscribePayment->payment_type) && $clientPackageSubscribePayment->status != 3)
                            <div class="row text-center">
                              <div class="col-6 ">
                                <div class="form-group">
                                  <p>@lang('website.Payment') @lang('website.Date')</p>
                                  <p> {{ $clientPackageSubscribePayment->date }}</p>
                                </div>
                              </div>
                              <div class="col-6 ">
                               <div class="form-group">
                                  <p>@lang('website.Payment') @lang('website.Type')</p>
                                  <p> {{ $clientPackageSubscribePayment->payment_type }}</p>
                                </div>
                              </div>
                            </div>
                        @endif

                        @if($clientPackageSubscribePayment->status == 3)
                         <p class="text-danger"><b>@lang('website.Information'):</b><br/> @lang('website.Custom Package service request already created and waiting for the Garage quote amount')</p>

                        @elseif($clientPackageSubscribe->status == 6)
                          <div class="row text-center p-3">
                            <div class="col-12 alert alert-warning">
                              <p class="text-uppercase text-danger m-0">
                                @lang('website.Note'): @lang('website.Information')
                              </p>
                              <p class="text-danger">@lang('website.Payment has already done in COD mode') </p>
                              <p class="text-danger">
                                  @lang('website.Garage will contact you soon and activate the package')
                              </p><br/>
                              <small class="text-uppercase"> @lang('website.Contact supports for further assistance')</small>
                            </div>
                          </div>
                        @elseif($clientPackageSubscribe->status == 7)
                          <div class="row text-center p-3">
                            <div class="col-12 alert alert-warning">
                              <p class="text-uppercase text-danger m-0">
                                @lang('website.Note'): @lang('website.Cash on Delievery need to verify from the Garage')
                              </p>
                              <small class="text-danger">
                                  @lang('website.Wait for the Garage approval Or conatct supports for further assistance')
                              </small>
                            </div>
                          </div>
                        @endif
                    @else
                       <p class="text-danger"><b>@lang('website.Information'):</b><br/> @lang('website.Custom Package service request already created and waiting for the Garage quote amount')</p>
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
  </section>

        

@stop



