@extends('garage::layouts.master')

@section('title', 'Garage Dashboard')


@section('website_css')
    <style type="text/css" media="screen">
     

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
          <a href="{{ route('client.dashboard') }}">Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="{{ route('garage.packages') }}">My Packages</a>
        </li>
        <li class="breadcrumb-item active">Package Subscribe</li>
      </ol>
  
      @if($error)

        <div class="box_general">
          <div class="header_box version_2">
            <h2  class="text-danger"><i class="fa fa-tags text-danger"></i>Error</h2>
          </div>
            <div class="alert alert-warning">
              <strong>Warning!</strong> {{$msg}}.
            </div>
        </div>


      @else
          
          @if($is_subscribed_package_exist)
            <div class="box_general">
                <div class="header_box version_2">
                  <h2  class="text-danger"><i class="fa fa-tags text-danger"></i> Current Package: {{ $garagePackageSubscribe->servicePackage->name }} ( {{ $garagePackageSubscribe->servicePackage->period. ' Days' }} )</h2>
                </div>

                <div class="box_general summary">
                  <ul>
                     <li>Package <span class="float-right">{{ $garagePackageSubscribe->servicePackage->name }} </span></li>
                    <li>Time Period <span class="float-right">{{ $garagePackageSubscribe->servicePackage->period. ' Days' }}</span></li>
                    <li>Subscription Start At <span class="float-right">{{ date('d-m-Y', strtotime($garagePackageSubscribe->subscription_start_at)) }}</span></li>
                    <li>Subscription End At <span class="float-right">{{ date('d-m-Y', strtotime($garagePackageSubscribe->subscription_end_at)) }}</span></li>
                    <li>TOTAL COST <span class="float-right">AED {{ $garagePackageSubscribe->servicePackage->price }}</span></li>
                  </ul>

                  <label>Time Duration</label>
                  <div class="progress" style="height: 2rem;">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                    aria-valuemin="0" aria-valuemax="100" style="width:40%">
                      40% Complete (success)
                    </div>
                  </div>
                </div>

            </div>
          @endif

         
            <div class="box_general">
              <div class="header_box version_2">
                <h2  class="text-danger"><i class="fa fa-tags text-danger"></i> {{ $package_buy_upgrade }} Package: {{ $package['name']}} ( {{$package['period'] . ' Days'}} ) </h2>
              </div>

            <div class="table-responsive">
               
             
                <form id="msform" method="POST" action="{{ route('garage.packages.subscribe')}}">
                   {{ csrf_field() }}

                  <input type="hidden" name="service_package_id" value="{{$package['id']}}">
                  <input type="hidden" name="buy_or_upgrade" value="{{ $package_buy_upgrade }}">
                  @if( $package_buy_upgrade == 'Upgrade')
                     <input type="hidden" name="garageSubscribedPackageId" value="{{ $garagePackageSubscribe->id }}">
                  @endif

                  <div class="container ">
                    <div class="row">
                      
                      <div class="col-lg-6 col-md-6">
                        <div class="step first">
                          <h3 class="text-white">1. Payment Method</h3>
                          <div class="payments">
                            <ul>
                              <li>
                                <label class="container_radio">Cash On Delievery
                                  <input type="radio" name="payment_type" value="cod" checked>
                                  <span class="checkmark"></span>
                                </label>
                              </li>
                              <li>
                                <label class="container_radio">Telr
                                  <input type="radio" name="payment_type" value="telr" disabled="">
                                  <span class="checkmark"></span>
                                </label>
                              </li>
                            </ul>
                          </div>
                          <div class="payment_info d-none d-sm-block">
                            <figure><img src="img/cards_all.svg" alt=""></figure>
                            <p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p>
                            <figure><img src="img/paypal.svg" alt=""></figure>
                            <p>No mel dicit perpetua indoctum, nisl repudiare ex nec. Ad usu utinam feugiat, persecuti liberavisse id pri. Elitr nonumy everti mel eu.</p>
                          </div>
                        </div>
                        <!-- /step -->
                      </div>


                      <div class="col-lg-6 col-md-6">
                        <div class="step last">
                          <h3 class="text-white">2. Order Summary</h3>
                        <div class="box_general summary">
                          <ul>
                            @php 
                              $starDate = date('d-m-Y');
                              $daystosum = $package['period'];
                              $endDate = date('d-m-Y', strtotime($starDate.' + '.$daystosum.' days'));

                            @endphp
                          
                            <li>Package <span class="float-right">{{ $package['name']}} </span></li>
                            <li>Time Period <span class="float-right">{{$package['period'] . ' Days'}}</span></li>
                            <li>Subscription Start At <span class="float-right">{{$starDate}}</span></li>
                            <li>Subscription End At <span class="float-right">{{$endDate}}</span></li>
                            <li>TOTAL COST <span class="float-right">AED {{ $package['price'] }}</span></li>
                          </ul>
                          <div class="form-group">
                              <label class="container_check">Please accepts <a target="_blank" href="#0">Terms and conditions</a>.
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          
                          <button type="submit" class="btn_1 full-width cart">CONFIRM AND PAY
                        </div>
                        <!-- /box_general -->
                        </div>
                        <!-- /step -->
                      </div>
                    </div>

                    <!-- /row -->
                  </div>
                  <!-- /container -->
                   </form>
               
            </div>


      @endif
      
       
   

@stop


@section('website_js')

   
    
@stop
