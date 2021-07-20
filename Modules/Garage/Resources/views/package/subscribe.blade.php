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
                          <div class="alert alert-warning">
                              {{ session('status') }}
                          </div>
                      @endif
                       @if (isset($status))
                          <div class="alert alert-warning">
                              {{ $status }}
                          </div>
                      @endif
                    </div>
                  </div>
    <div class="row">
          <div class="col-md-12">
              <div class="box box-info">
                  <div class="box-header" style="background: #ddd;">
                     <h3 class="box-title"><i class="fa fa-tags text-danger"></i> Buy Package: {{ $package['name']}} ( {{$package['period'] . ' Days'}} )</h3>
                  </div>
                  <div class="box-body">
                    <form id="msform" method="POST" action="{{ route('garage.packages.subscribe')}}">
                     {{ csrf_field() }}

                    <input type="hidden" name="service_package_id" value="{{$package['id']}}">
                    <div class="container ">
                      <div class="row">
                        
                        <div class="col-lg-6 col-md-6">
                          <div class="step last">
                          <div class="alert alert-warning"><span style="font-size: 18px;">Order Summary</span></div>
                          <div class="well summary">
                            <ul>
                              @php 
                                $starDate = date('d-m-Y');
                                $daystosum = $package['period'];
                                $endDate = date('d-m-Y', strtotime($starDate.' + '.$daystosum.' days'));

                              @endphp
                            
                              <li><b>Package</b> <span class="float-right">{{ $package['name']}} </span></li>
                              <li><b>Time Period </b><span class="float-right">{{$package['period'] . ' Days'}}</span></li>
                              <li><b>Subscription Start At</b> <span class="float-right">{{$starDate}}</span></li>
                              <li><b>Subscription End At</b> <span class="float-right">{{$endDate}}</span></li>
                              <li><b>TOTAL COST</b><span class="float-right">AED {{ $package['price'] }}</span></li>
                            </ul>
                          </div>
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="step first">
                             <div class="alert alert-warning"><span style="font-size: 18px;">Payment Method</span></div>
                            <div class="payments">
                              <div class="radio">
                                <label><input type="radio" name="payment_type" checked>Cash On Delievery</label>
                              </div>
                              <div class="radio">
                                <label><input type="radio" name="payment_type">Credit/Debit Card </label>
                              </div>
                              <!--ul>
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
                              </ul-->
                              <div class="form-group">
                                <label class="container_check">Please accepts <a target="_blank" href="#0">Terms and conditions</a>.
                                  <input type="checkbox" checked>
                                  <span class="checkmark"></span>
                                </label>
                              </div>
                            
                            <button type="submit" class="btn btn-success full-width cart">CONFIRM AND PAY
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                     </form>
                  </div>
                </div>
              </div>
            </div>
            </section>
          </div>

@stop


@section('js')

   
    
@stop
