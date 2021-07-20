@extends('autoshop.layout')
@section('content')

<!-- checkout Content -->
<section class="checkout-area">



 <div class="container">
   <div class="row">
     <div class="col-12 col-sm-12">
         <div class="row justify-content-end">
             <nav aria-label="breadcrumb">
                 <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
                   <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('website.Checkout')</a></li>
                   <li class="breadcrumb-item">
                     <a href="javascript:void(0)">
                       @if(session('step')==0)
                             @lang('website.Shipping Address')
                           @elseif(session('step')==1)
                             @lang('website.Billing Address')
                           @elseif(session('step')==2)
                             @lang('website.Shipping Methods')
                           @elseif(session('step')==3)
                             @lang('website.Order Detail')
                           @endif
                     </a>
                   </li>
                 </ol>
               </nav>
         </div>
     </div>
     <div class="col-12 col-xl-9 checkout-left">
       <input type="hidden" id="hyperpayresponse" value="@if(!empty(session('paymentResponse'))) @if(session('paymentResponse')=='success') {{session('paymentResponse')}} @else {{session('paymentResponse')}}  @endif @endif">
       <div class="alert alert-danger alert-dismissible" id="paymentError" role="alert" style="display:none;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           @if(!empty(session('paymentResponse')) and session('paymentResponse')=='error') {{session('paymentResponseData') }} @endif
       </div>
         <div class="row">
           <div class="checkout-module">
             <ul class="nav nav-pills mb-3 checkoutd-nav d-none d-lg-flex" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">@lang('website.Shipping Address')</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >@lang('website.Billing Address')</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif> @lang('website.Shipping Methods')</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) active-check @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>@lang('website.Order Detail')</a>
                   </li>
               </ul>
               <ul class="nav nav-pills mb-3 checkoutm-nav d-flex d-lg-none" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">1</a>
                 </li>
                 <li class="nav-item second">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >2</a>
                 </li>
                 <li class="nav-item third">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif>3</a>
                 </li>
                 <li class="nav-item fourth">
                   <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) active-check @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>4</a>
                   </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                 <div class="tab-pane fade @if(session('step') == 0) show active @endif" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                   <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/checkout_shipping_address')}}" method="post">
                     <input type="hidden" required name="_token" id="csrf-token" value="{{ Session::token() }}" />
                     <div class="form-group">
                       <label for="firstName">@lang('website.First Name') *</label>
                       <input type="text"  required class="form-control field-validate" id="firstname" name="firstname" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->firstname}} @else {{ auth()->guard('customer')->user()->first_name }} @endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                     </div>
                     <div class="form-group">
                       <label for="lastName">@lang('website.Last Name') *</label>
                       <input type="text" required class="form-control field-validate" id="lastname" name="lastname" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->lastname}} @else {{ auth()->guard('customer')->user()->last_name }}  @endif" aria-describedby="NameHelp1" placeholder="Enter Your Last Name">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                     </div>
                     <?php //if(Session::get('guest_checkout') == 1){ ?>
                     <div class="form-group">
                       <label for="lastName">@lang('website.Email') *</label>
                       <input type="text" required class="form-control field-validate" id="email" name="email" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->email}} @else {{ auth()->guard('customer')->user()->email }}  @endif" aria-describedby="NameHelp1" placeholder="Enter Your Email">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your email')</span>
                     </div>
                     <?php //} ?>
                     <div class="form-group">
                       <label for="firstName">@lang('website.Company')</label>
                       <input type="text" required class="form-control field-validate" id="company" aria-describedby="companyHelp" placeholder="Enter Your Company Name" name="company" value="@if(!empty(session('shipping_address'))>0) {{session('shipping_address')->company}}@endif">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                     </div>

                     <div class="form-group">
                       <label for="exampleInputAddress1">@lang('website.Address')</label>
                       <input type="text" required class="form-control field-validate" name="street" id="street" aria-describedby="addressHelp" placeholder="@lang('website.Please enter your address')">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                     </div>
                     <div class="form-group">
                       <label for="exampleSelectCountry1">@lang('website.Country') *</label>
                       <div class="select-control">
                           <select required class="form-control field-validate" id="entry_country_id" onChange="getZones();" name="countries_id" aria-describedby="countryHelp">
                             <option value="" selected>@lang('website.Select Country')</option>
                             @if(!empty($result['countries'])>0)
                               @foreach($result['countries'] as $countries)
                                   <option value="{{$countries->countries_id}}" @if(!empty(session('shipping_address'))>0) @if(session('shipping_address')->countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                               @endforeach
                             @endif
                             </select>
                       </div>
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                     </div>
                     {{--
                     <div class="form-group">
                       <label for="exampleSelectState1">@lang('website.State')</label>
                       <div class="select-control">
                           <select required class="form-control field-validate" id="entry_zone_id"  name="zone_id" aria-describedby="stateHelp">
                             <option value="">@lang('website.Select State')</option>
                              @if(!empty($result['zones'])>0)
                               @foreach($result['zones'] as $zones)
                                   <option value="{{$zones->zone_id}}" @if(!empty(session('shipping_address'))>0) @if(session('shipping_address')->zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                               @endforeach
                             @endif

                              <option value="-1" @if(!empty(session('shipping_address'))>0) @if(session('shipping_address')->zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                             </select>
                       </div>
                        <small id="stateHelp" class="form-text text-muted"></small>
                       </div>
                       
                       <div class="form-group">
                           <label for="exampleSelectCity1">City</label>
                           <input required type="text" class="form-control field-validate" id="city" name="city" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->city}}@endif" placeholder="Enter Your City">
                           <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                       </div>
                       --}}
                       @php 
                        $cities = \DB::table('cities')->where('status',1)->pluck('name');
                       @endphp
                       
                       <div class="form-group">
                           <label for="exampleSelectCountry1">@lang('website.City') *</label>
                           <div class="select-control">
                               <select required class="form-control field-validate" id="city" name="city" aria-describedby="countryHelp">
                                 @if(!empty($cities))
                                   @foreach($cities as $city)
                                       <option value="{{$city}}" @if(!empty(session('shipping_address'))>0) @if(session('shipping_address')->city == $city) selected @endif @endif >{{$city}}</option>
                                   @endforeach
                                 @endif
                                 </select>
                           </div>
                           <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                        </div>
                       <div class="form-group">
                         <label for="exampleInputZpCode1">@lang('website.Zip/Postal Code')</label>
                         <input type="number" class="form-control" id="postcode" aria-describedby="zpcodeHelp" placeholder="Enter Your Zip / Postal Code" name="postcode" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->postcode}}@endif">
                         <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your Zip/Postal Code')</span>
                       </div>
                       <div class="form-group">
                         <label for="exampleInputNumber1">@lang('website.Phone Number') *</label>
                         <input required type="text" class="form-control field-validate" id="delivery_phone" aria-describedby="numberHelp" placeholder="Enter Your Phone Number" name="delivery_phone" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->delivery_phone}}@endif">
                         <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                       </div>
                       <div class="col-12 col-sm-12">
                         <div class="row">
                           <button type="submit"  class="btn btn-secondary">@lang('website.Continue')</button>
                         </div>
                       </div>
                   </form>
                 </div>
                 <div class="tab-pane fade @if(session('step') == 1) show active @endif"  id="pills-billing" role="tabpanel" aria-labelledby="pills-billing-tab">
                     <form name="signup" enctype="multipart/form-data" action="{{ URL::to('/checkout_billing_address')}}" method="post">
                       <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                         <div class="form-group">
                             <label for="exampleInputName1">@lang('website.First Name') *</label>
                             <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_firstname" name="billing_firstname" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_firstname}} @else {{ auth()->guard('customer')->user()->first_name }} @endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                           </div>
                           <div class="form-group">
                             <label for="exampleInputName2">@lang('website.Last Name') *</label>
                             <input type="text" class="form-control same_address" id="exampleInputName2" aria-describedby="NameHelp2" placeholder="Enter Your Name" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_lastname" name="billing_lastname" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_lastname}} @else {{ auth()->guard('customer')->user()->last_name }} @endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                           </div>
                           
                            <div class="form-group">
                             <label for="exampleInputName2">@lang('website.Email') *</label>
                             <input type="text" class="form-control same_address" id="exampleInputName2" aria-describedby="NameHelp2" placeholder="Enter Your Email" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_email" name="billing_email" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_email}} @else {{ auth()->guard('customer')->user()->email }} @endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your email')</span>
                           </div>

                           <div class="form-group">
                             <label for="exampleInputCompany1">@lang('website.Company')</label>
                             <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_company" name="billing_company" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_company}}@endif" id="exampleInputCompany1" aria-describedby="companyHelp" placeholder="Enter Your Company Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                           </div>

                           <div class="form-group">
                             <label for="exampleInputAddress1">@lang('website.Address') *</label>
                             <input type="text" class="form-control same_address" id="exampleInputAddress1" aria-describedby="addressHelp" placeholder="Enter Your Address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_street" name="billing_street" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_street}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                           </div>
                           <div class="form-group">
                             <label for="exampleSelectCountry1">@lang('website.Country') *</label>
                             <div class="select-control">
                                 <select required class="form-control same_address_select" id="billing_countries_id" aria-describedby="countryHelp" onChange="getBillingZones();" name="billing_countries_id" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) disabled @endif @else disabled @endif>
                                   <option value=""  >@lang('website.Select Country')</option>
                                   @if(!empty($result['countries'])>0)
                                     @foreach($result['countries'] as $countries)
                                         <option value="{{$countries->countries_id}}" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->billing_countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                                     @endforeach
                                   @endif
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                           </div>
                           {{--
                           <div class="form-group">
                             <label for="exampleSelectState1">@lang('website.State')</label>
                             <div class="select-control">
                                 <select required class="form-control same_address_select" name="billing_zone_id" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) disabled @endif @else disabled @endif id="billing_zone_id" aria-describedby="stateHelp">
                                   <option value="" >@lang('website.Select State')</option>
                                   @if(!empty($result['zones'])>0)
                                     @foreach($result['zones'] as $key=>$zones)
                                         <option value="{{$zones->zone_id}}" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->billing_zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                                     @endforeach
                                   @endif
                                     <option value="-1" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->billing_zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden>@lang('website.Please select your state')</span>
                           </div>
                           
                           <div class="form-group">
                               <label for="exampleSelectCity1">@lang('website.City')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_city" name="billing_city" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_city}}@endif" placeholder="Enter Your City">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                           </div>
                           --}}
                         
                           <div class="form-group">
                               <label for="exampleSelectCountry1">@lang('website.City') *</label>
                               <div class="select-control">
                                   <select required class="form-control same_address_select" id="billing_city" name="billing_city" aria-describedby="countryHelp" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) disabled @endif @else disabled @endif>
                                     @if(!empty($cities))
                                       @foreach($cities as $city)
                                           <option value="{{$city}}" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->billing_city == $city) selected @endif @endif >{{$city}}</option>
                                       @endforeach
                                     @endif
                                     </select>
                               </div>
                               <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                            </div>

                           
                             <div class="form-group">
                               <label for="exampleInputZpCode1">@lang('website.Zip/Postal Code')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_zip" name="billing_zip" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_zip}}@endif" aria-describedby="zpcodeHelp" placeholder="Enter Your Zip / Postal Code">
                               <small id="zpcodeHelp" class="form-text text-muted"></small>
                             </div>
                             <div class="form-group">
                               <label for="exampleInputNumber1">@lang('website.Phone Number') *</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_phone" name="billing_phone" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_phone}}@endif" aria-describedby="numberHelp" placeholder="Enter Your Phone Number">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                             </div>
                             <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="same_billing_address" value="1" name="same_billing_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) checked @endif @else checked  @endif > @lang('website.Same shipping and billing address')>

                                     <small id="checkboxHelp" class="form-text text-muted"></small>
                                   </div>
                             </div>

                             <div class="col-12 col-sm-12">
                             <div class="row">
                               <button type="submit"  class="btn btn-secondary"><span>@lang('website.Continue')<i class="fas fa-caret-right"></i></span></button>
                               </div>
                             </div>
                       </form>
                 </div>
                 <div class="tab-pane fade  @if(session('step') == 2) show active @endif" id="pills-method" role="tabpanel" aria-labelledby="pills-method-tab">

                             <div class="col-12 col-sm-12 ">
                                <div class="row"> <p>@lang('website.Please select a prefered shipping method to use on this order')</p></div>
                             </div>
                             <form name="shipping_mehtods" method="post" id="shipping_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/checkout_payment_method')}}">
                               <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                 @if(!empty($result['shipping_methods'])>0)
                                     <input type="hidden" name="mehtod_name" id="mehtod_name">
                                     <input type="hidden" name="shipping_price" id="shipping_price">

                                @foreach($result['shipping_methods'] as $shipping_methods)
                                         <div class="heading">
                                             <h2>{{$shipping_methods['name']}}</h2>
                                             <hr>
                                         </div>
                                         <div class="form-check">

                                             <div class="form-row">
                                                 @if($shipping_methods['success']==1)
                                                 <ul class="list"style="list-style:none; padding: 0px;">
                                                     @foreach($shipping_methods['services'] as $services)
                                                      <?php
                                                          if($services['shipping_method']=='upsShipping')
                                                             $method_name=$shipping_methods['name'].'('.$services['name'].')';
                                                          else{
                                                             $method_name=$services['name'];
                                                             }
                                                         ?>
                                                         <li>
                                                           @php
                                                           $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                                           if($default_currency->id == Session::get('currency_id')){

                                                             $currency_value = 1;
                                                           }else{
                                                             $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

                                                             $currency_value = $session_currency->value;
                                                           }
                                                           @endphp
                                                         <input class="shipping_data" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0)
                                                         @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif
                                                         @elseif($shipping_methods['is_default']==1) checked @endif
                                                         >
                                                          <label for="{{$method_name}}">{{$services['name']}} --- {{Session::get('symbol_left')}}{{$services['rate']* $currency_value}}{{Session::get('symbol_right')}}</label>
                                                         </li>
                                                     @endforeach
                                                 </ul>
                                                 @else
                                                     <ul class="list"style="list-style:none; padding: 0px;">
                                                         <li>@lang('website.Your location does not support this') {{$shipping_methods['name']}}.</li>
                                                     </ul>
                                                 @endif
                                             </div>
                                         </div>
                                     @endforeach
                                 @endif
                                 <div class="alert alert-danger alert-dismissible error_shipping" role="alert" style="display:none;">
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                     @lang('website.Please select your shipping method')
                                 </div>
                                 <div class="row">
                                   <button type="button"class="btn btn-secondary" id="shippingMethodBtn"><span>CONTINUE<i class="fas fa-caret-right"></i></span></button>
                                   </div>
                               </form>


                 </div>
                 <div class="tab-pane fade @if(session('step') == 3) show active @endif" id="pills-order" role="tabpanel" aria-labelledby="pills-method-order">
                               <?php
                                   $price = 0;
                               ?>
                               <form method='POST' id="update_cart_form" action='{{ URL::to('/place_order')}}' >
                                 {!! csrf_field() !!}

                                       <table class="table top-table">
                                           <thead>
                                               <tr class="d-flex">
                                                   <th class="col-12 col-md-2">@lang('website.items')</th>
                                                   <th class="col-12 col-md-4"></th>
                                                   <th class="col-12 col-md-2">@lang('website.Price')</th>
                                                   <th class="col-12 col-md-2">@lang('website.Qty')</th>
                                                   <th class="col-12 col-md-2">@lang('website.SubTotal')</th>
                                               </tr>
                                           </thead>

                                           @foreach( $result['cart'] as $products)
                                           <?php
                                              $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                              if($default_currency->id == Session::get('currency_id')){
                                                $orignal_price = $products->final_price;
                                              }else{
                                                $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                                $orignal_price = $products->final_price * $session_currency->value;
                                              }

                                               $price+= $orignal_price * $products->customers_basket_quantity;
                                           ?>

                                           <tbody>
                                               <tr class="d-flex">
                                                   <td class="col-12 col-md-2 item">
                                                       <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
                                                         <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-thumb">
                                                             <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}" alt="">
                                                         </a>
                                                   </td>
                                                   <td class="col-12 col-md-4 item-detail-left">
                                                     <div class="item-detail">
                                                         <h4>{{$products->products_name}}</h4>
                                                         <div class="item-attributes"></div>
                                                       </div>
                                                   </td>

                                                   <?php
                                                      $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                                      if($default_currency->id == Session::get('currency_id')){
                                                        $orignal_price = $products->final_price;
                                                      }else{
                                                        $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                                        $orignal_price = $products->final_price * $session_currency->value;
                                                      }
                                                   ?>

                                                   <td class="item-price col-12 col-md-2"><span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span></td>
                                                   <td class="col-12 col-md-2">
                                                     <div class="input-group item-quantity">

                                                       <input type="text" id="quantity" readonly name="quantity" class="form-control input-number" value="{{$products->customers_basket_quantity}}">

                                                   </td>
                                                   <td class="align-middle item-total col-12 col-md-2 subtotal" align="center"><span class="cart_price_{{$products->customers_basket_id}}">{{Session::get('symbol_left')}}{{$orignal_price * $products->customers_basket_quantity}}{{Session::get('symbol_right')}}</span>
                                                   </td>
                                               </tr>
                                               <tr class="d-flex">
                                                   <td class="col-12 col-md-2 p-0">
                                                     <div class="item-controls">
                                                         <button  type="button" class="btn" >
                                                             <a  href="{{ URL::to('/product-detail/'.$products->products_slug)}}"><span class="fas fa-pencil-alt"></span></a>
                                                         </button>
                                                         <button  type="button" class="btn" >
                                                             <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}"><span class="fas fa-times"></span></a>
                                                         </button>
                                                     </div>
                                                   </td>
                                                   <td class="col-12 col-md-10 d-none d-md-block">
                                                       @foreach($other_charges as $index => $oc)
                                                        @if($oc->categories_id == $products->categories_id)
                                                        
                                                            @php
                                                                ///now handleother chrages baskets
                                                                $other_charges_baskets = 	\DB::table('other_charges_baskets')->where('customers_basket_id', '=', $products->customers_basket_id)->first();
                                                                //dd($other_charges_baskets);
                                                                //echo $other_charges_baskets->other_charges_id;
                                                            @endphp
                                                            
                                                            <input type="checkbox" id="{{'oc_'.$index.'_'.$oc->id.'_'.$products->customers_basket_id}}" 
                                                                 @if($oc->is_disabled == 1) disabled @endif
                                                                    @if(!empty($other_charges_baskets) && $other_charges_baskets->is_checked == 1 &&  $oc->id == $other_charges_baskets->other_charges_id )  checked @endif  name="other_charges[]" value="{{$oc->id}}" 
                                                                    onClick="redirect('{{$index}}','{{$oc->id}}','{{$products->customers_basket_id}}')"> 
                                                                {{$oc->name}}
                                                            {{ 'AED '. $oc->amount}} (<small color="danger">{{'Only this price is applicable and Product price will be zero.'}}</small>)
                                                            <br/>
                                                        @endif
                                                      @endforeach
                                                   </td>
                                               </tr>

                                           </tbody>
                                           @endforeach
                                       </table>
                                                   <?php
                                                       if(!empty(session('shipping_detail')) and !empty(session('shipping_detail'))>0){
                                                           $shipping_price = session('shipping_detail')->shipping_price;
                                         $shipping_name = session('shipping_detail')->mehtod_name;
                                                       }else{
                                                           $shipping_price = 0;
                                         $shipping_name = '';
                                                       }
                                                       $tax_rate = number_format((float)session('tax_rate'), 2, '.', '');
                                                       $coupon_discount = number_format((float)session('coupon_discount'), 2, '.', '');
                                                       $total_price = ($price+$tax_rate+$shipping_price)-$coupon_discount;
                                       session(['total_price'=>$total_price]);

                                        ?>
                               </form>
                                   <div class="col-12 col-sm-12">
                                       <div class="row">
                                         <div class="heading">
                                           <h2>@lang('website.orderNotesandSummary')</h2>
                                           <hr>
                                         </div>
                                         <div class="form-group" style="width:100%; padding:0;">
                                             <label for="exampleFormControlTextarea1">@lang('website.Please write notes of your order')</label>
                                             <textarea name="comments" class="form-control" id="order_comments" rows="3">@if(!empty(session('order_comments'))){{session('order_comments')}}@endif</textarea>
                                           </div>
                                       </div>

                                   </div>
                                   <div class="col-12 col-sm-12 mb-3">
                                       <div class="row">
                                         <div class="heading">
                                           <h2>@lang('website.Payment Methods')</h2>
                                           <hr>
                                         </div>

                                           <div class="form-group" style="width:100%; padding:0;">
                                               <p class="title">@lang('website.Please select a prefered payment method to use on this order')</p>

                                               <div class="alert alert-danger error_payment" style="display:none" role="alert">
                                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                   @lang('website.Please select your payment method')
                                               </div>

                                               <form name="shipping_mehtods" method="post" id="payment_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/order_detail')}}">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                   <ul class="list"style="list-style:none; padding: 0px;">
                                                       @foreach($result['payment_methods'] as $payment_methods)
                                                           @if($payment_methods['active']==1)
                                                               <input id="payment_currency" type="hidden" onClick="paymentMethods();" name="payment_currency" value="{{$payment_methods['payment_currency']}}">
                                                               @if($payment_methods['payment_method']=='cash_on_delivery')

                                                                  <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                                   <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">

                                                                   <li>
                                                                    <input onClick="paymentMethods();" type="radio" name="payment_method" class="payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                                    <label for="{{$payment_methods['payment_method']}}">{{$payment_methods['name']}} (@lang('website.addtianal_cost') AED 15)</label>
                                                                   </li>
                                                               @endif

                                                                @if($payment_methods['payment_method']=='telr')
                                                                   <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                                   <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">

                                                                   <li>
                                                                    <input onClick="paymentMethods();" type="radio" name="payment_method" class="payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                                    <label for="{{$payment_methods['payment_method']}}">{{$payment_methods['name']}}</label>
                                                                   </li>
                                                                   
                                                               @endif

                                                           @endif
                                                       @endforeach
                                                   </ul>
                                               </form>
                                           </div>
                                           <div class="button">

                                               <button id="cash_on_delivery_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>
                                               
                                               <button id="telr_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

                                          </div>
                                       </div>
                                   </div>

                 </div>
               </div>
         </div>
         </div>
     </div>
     @php
     $default_currency = DB::table('currencies')->where('is_default',1)->first();
     if($default_currency->id == Session::get('currency_id')){

       $currency_value = 1;
     }else{
       $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

       $currency_value = $session_currency->value;
     }
     @endphp
     <div class="col-12 col-xl-3 checkout-right">
       <table class="table right-table">
         <thead>
           <tr>
             <th scope="col" colspan="2" align="center">@lang('website.Order Summary')</th>

           </tr>
         </thead>
         <tbody>
           <tr>
             <th scope="row">@lang('website.SubTotal')</th>
             <td align="right">{{Session::get('symbol_left')}}{{$price+0}}{{Session::get('symbol_right')}}</td>

           </tr>
           <tr>
             <th scope="row">@lang('website.Discount')</th>
             <td align="right">{{Session::get('symbol_left')}}{{number_format((float)session('coupon_discount'), 2, '.', '')+0*$currency_value}}{{Session::get('symbol_right')}}</td>

           </tr>
           <tr>
               <th scope="row">@lang('website.Tax')</th>
               <td align="right">{{Session::get('symbol_left')}}{{$tax_rate*$currency_value}}{{Session::get('symbol_right')}}</td>

             </tr>
             <tr>
                 <th scope="row">@lang('website.Shipping Cost')</th>
                 <td align="right">{{Session::get('symbol_left')}}{{$shipping_price*$currency_value}}{{Session::get('symbol_right')}}</td>

               </tr>


         
             <tr class="others_charge_cod" style="display: none">
               <th scope="row">@lang('website.Others Charge')</th>
               <td align="right" >{{Session::get('symbol_left')}}{{'15.00'}}{{Session::get('symbol_right')}}</td>
            </tr>
            <tr class="item-price others_charge_cod"  style="display: none">
               <th scope="row">@lang('website.Total')</th>
               <td align="right" >{{Session::get('symbol_left')}}{{number_format((float)$total_price+15, 2, '.', '')+0*$currency_value}}{{Session::get('symbol_right')}}</td>
             </tr>
         

          
            <tr class="item-price others_charge_telr"  style="display: none">
               <th scope="row">@lang('website.Total')</th>
               <td align="right" >{{Session::get('symbol_left')}}{{number_format((float)$total_price+0, 2, '.', '')+0*$currency_value}}{{Session::get('symbol_right')}}</td>
            </tr>
          


          
         
         </tbody>
       </table>
       </div>
   </div>
 </div>
 </div>
 
 
 <div class="modal fade in" id="telrModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-body text-center">
                   <div id="telrDiv1" class="text-center" style="min-height:100px;"><h2>Please wait...</h2></div>
                        <div id="telrDiv2" style="min-height:150px;">
                         <h2>{{trans('website.Are you Sure?')}}</h2>
                         <p>{{trans('website.Please complete the transaction in new tab and be back to Submit the form to conitune')}}...</p>
                         <p>{{trans('website.Once it is cancelled, please refresh the page to try again')}}</p>
                         <p><small style="color:#d30000">* {{trans('website.Please make sure your pop-up blocker is turned off')}}</small></p>
                         <button type="button" class="btn btn-danger text-uppercase" onclick="closeTelrModal()">{{trans('website.Cancel')}}</button>
                         <a id="telrIframe" href="" class="btn btn-success text-uppercase" target="_blank"> {{trans('website.Pay')}}</a>
                         <br/><br/>
                         <p>{{trans('website.this page will automatically timeout in')}} <h2 id="counter"></h2> {{trans('website.minutes')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</section>

<!-- Latest compiled and minified CSS
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
 -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

    var language = "{{\Config::get("app.locale")}}";
    var floatDir = (language == 'en') ? 'float-right' : 'float-left';
    $('#others_charge').hide();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    checkCOD();
    // jQuery(".others_charge_cod").hide();
    jQuery('input[type=radio][name=payment_method]').change(function() {
      checkCOD();
    });


    function checkCOD(){
      //alert('checkCOD');
      //jQuery('#loader').css('display','flex');
      var payment_method = jQuery(".payment_method:checked").val();
      jQuery(".payment_btns").hide();
        console.log(payment_method);

        if(payment_method == 'cash_on_delivery'){
          jQuery(".others_charge_cod").show();
          jQuery(".others_charge_telr").hide();
        }

        if(payment_method == 'telr'){
          jQuery(".others_charge_cod").hide();
          jQuery(".others_charge_telr").show();
        }
    }

    
    
    jQuery(document).on('click', '#cash_on_delivery_button', function(e){
      jQuery("#update_cart_form").submit();

    });

    //telr_button
    jQuery(document).on('click', '#telr_button', function(e){
        
        $('#telrDiv1').show();
        $('#telrDiv2').hide();
       

       
        $('#telrModal').modal({backdrop: 'static',keyboard: false});
        // lets get the garage list
        
        var param = {
            'language_id' : (language == 'en') ? 1: 2,
            'amount': {{$total_price}},
            '_token' : '<?php echo csrf_token() ?>',
        }
        $.ajax({
           type:'POST',
           url:'/checkout_telr_method',
           data: param,
           success:function(data) {
               let resp = JSON.parse(data);
               if(resp.success ==1){
                    telrCode = resp.data.webview.code;
                    $('#telrIframe').attr('href', resp.data.webview.start);
                    $('#telrDiv1').hide();
                    $('#telrDiv2').show();
                    showDialog();
               }else{
                   $('#telrModal').modal('hide');
                   alert('Something went wrong!!!');
               }
                
           }
        }); 
    	//submit the form 
    	//
    });

    var telrCode = null;
    var telrAbort = "https://secure.telr.com/gateway/webview_abort.html";
    var interval;
    
    function closeTelrModal(){
       $('#telrModal').modal('hide');
    }
    
    var secsToRemainingTime = function secsToRemainingTime(secs) {
          var mm = ('0'+~~(secs / 60)).slice(-2);
          var ss = ('0'+(secs % 60)).slice(-2);
          return mm + ':' + ss;
        };
  
    function showDialog() {
        var time = 5 * 60;
        console.log('start');
        $('#counter').html(secsToRemainingTime(time));
        
        
        interval = setInterval(function () {
          if (time == 0) {
            clearInterval(interval);
            interval = undefined;
            
            // invlaid the token
            if(telrCode){
                $('#telrIframe').attr('href', telrAbort);
                $('#telrIframe').attr('target', '_blank').get(0).click();
            }
               
            // hide the modal
                closeTelrModal();
                
            return;
          }
          if(time%5 == 0){
            $.ajax({
                type:'POST',
                url:'{{ URL::to('/telr-payment-status')}}',
                data: {'refrenceCode' : telrCode, '_token' : '<?php echo csrf_token() ?>'},
                success:function(data) {
                    let resp = JSON.parse(data);
                    if(resp.success == '1'){
                        closeTelrModal();
                        jQuery("#update_cart_form").submit();
                        return;
                    }
                }
            });   
          } // if closed here
          console.log(secsToRemainingTime(--time));
          $('#counter').html(secsToRemainingTime(--time));
        }, 1000);
    }
    
    
    $('#telrModal').on('hidden.bs.modal', function () {
      console.log('modal closed');
      if (interval) {
          clearInterval(interval);
          interval = undefined;
        }
        window.open(telrAbort, '_blank');
    })
    
    $(document).ready(function (){
        //$('#telrModal').modal('hide');
    });
    
</script>
<script>
 function redirect(i, a , b){
         var c_id = 'oc_'+i+'_'+a+'_'+b;
         var url;
         if(document.getElementById(c_id).checked){
             url = "{{ URL::to('/apply_other_charge')}}" + '?id='+a+'&bid='+b;
         }else{
             url = "{{ URL::to('/remove_other_charge/')}}" + '?id='+a+'&bid='+b;
         }
         //alert(url);
        window.location.href = url;
    }
</script>

@endsection
