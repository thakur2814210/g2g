@extends('website.layout')
@section('css')
    <style>
        .main_categories ul li{
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
      
<main class="pattern">
            
    <section class="hero_single version_5">
      <div class="wrapper">
        <div class="container">
          <div class="row justify-content-center pt-lg-5">
            <div class="col-xl-6 col-lg-6">
              <p style="font-size: 2.25rem;text-shadow: none;color: #fff;margin: 0;text-transform: uppercase;font-weight: 700;">@lang('website.homapage_slider_text_1')</p>
              <p>@lang('website.homapage_slider_text_2')</p>
              <form method="get" action="{{ route('listings.search-by-location')}}">
                <input type="hidden" name="latitude" id="latitude" value="">
                <input type="hidden" name="longitude" id="longitude" value="">
                <input type="hidden" name="city" id="city" value="all">
                <div class="custom-search-input-2">
                  <div class="form-group">
                    <input type="text" name="address" id="autocomplete" class="form-control" placeholder="{{trans('website.Location/City/Address')}}">
                    <i class="pe-7s-edit toogle-distance-slider"></i>
                    <div class="distance-slider" style="display: none;">
                    <div class="text-primary mb-2">{{trans('website.Distance')}}: <span id="distance-value">5</span>{{trans('website.KM')}}</div>
                        <input id="thedistance" name="distance" type="range" min="0" max="100" step="5" value="5" >
                      </div>
                  </div>
                  <select class="wide" name="category">
                    <option value="all">{{trans('website.All Categories')}}</option> 
                    @foreach($all_sections as $cat)
                      <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                  </select>
                  <input type="submit" value="{{trans('website.Search')}}" style="background-color: #fb8d00;">
                </div>
              </form>
            </div>
            <div class="col-xl-4 col-lg-6 text-right d-none d-lg-block">
              <img src="{{ asset('website-theme/img/g2g-phone.png') }}" alt="" style="height: 500px; margin-top: -100px; margin-bottom: -100px;">
            </div>
          </div>

        </div>
      </div>
    </section>
        <!-- /hero_single -->
        
        <div class="main_categories">
            <div class="container">
                <ul class="clearfix row">
                    <li class="col-6 col-md-3 col-lg-2">
                               
                        <a href="{{ URL::to('/autoshop')}}" target="_blank">
                            <i class="ti-shopping-cart"></i>
                            <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">@lang('website.auto_shop')</span>
                        </a>
                        
                    </li>
                  @foreach($sections as $category)
                        @if($category->type == 1 && $category->slug != 'custom-request')
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                                @if(Auth::guard('customer')->check())
                                    <a href="{{ route('client.service-request.create',['category' => $category->slug])}}">
                                @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                    <a href="#error-in-dialog"  class="login error-in-modal">
                                @else
                                    <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="service-request"  class="login sign-in-modal" >
                                @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</span>
                                </a>
                                
                            </li>
                        @endif
                  
                        @if($category->type == 1 && $category->slug == 'custom-request')
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                            @if(Auth::guard('customer')->check())
                                <a href="{{ route('client.service-request.create',['category' => $category->slug])}}">
                            @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            @else
                                <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="service-request"  class="login sign-in-modal" >
                            @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</span>
                                </a>
                                
                            </li>
                        @endif
                    
                        @if($category->type == 2 && $category->slug != 'custom-package')
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                            @if(Auth::guard('customer')->check())
                                <a href="{{ route('client.package-subscription.create',['category' => $category->slug])}}">
                            @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            @else
                                <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="client-package-subscription"  class="login sign-in-modal">
                            @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</span>
                                </a>
                            </li>
                        @endif
                   
                        @if($category->type == 2 && $category->slug == 'custom-package')
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                            @if(Auth::guard('customer')->check())
                                <a href="{{ route('client.package-subscription.create',['category' => $category->slug])}}">
                            @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            @else
                                <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="client-package-subscription"  class="login sign-in-modal">
                            @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                   
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /main_categories -->

        
    <!-- featured garage -->
    <div class="container-fluid margin_80_55">
      <div class="main_title_2">
        <span><em></em></span>
        <h2>@lang('website.workshop_and_garage')</h2>
        <p>@lang('website.recommended')</p>
      </div>
      @if(count($featureGarages) && !empty($featureGarages))

        <div id="reccomended11" class="owl-carousel owl-theme g2gListCarousel">
          @foreach($featureGarages as $featureGarage)
            <div class="item">
              <div class="strip grid">
                <figure>
                  <a href="#" class="wish_bt"></a>
                  <a href="{{ route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])}}">
                    <img src="{{ asset($featureGarage['profile_image'] ) }}" class="img-fluid" alt="" width="400" height="266">
                    <div class="read_more"><span>{{trans('website.Read more')}}</span></div>
                  </a>
                  <small>{{trans('website.Garage')}}</small>
                </figure>
                <div class="wrapper text-center">
                  <h3><a href="{{ route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])}}">{{ $featureGarage['garages_name'] }}</a></h3>
                  <p>              
                  {{ $featureGarage['address'] }}, {{ $allCities[$featureGarage['city_id']]['name'] }}, {{ $countries[$featureGarage['country_id']]['name'] }}, {{ $featureGarage['postal'] }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="container">
          <div class="btn_home_align text-center mt-3"><a href="{{ route('listings.workshops-garages',['category' => 'featured'])}}" class="btn_1 rounded">@lang('website.view_all')</a></div>
        </div>
      @endif
    </div>
    <!-- /container -->
    
    <div class="call_section">
            <div class="wrapper">
                <div class="container margin_80_55">
                    <div class="main_title_2">
                        <span><em></em></span>
                        <h2>@lang('website.how_it_works_title')</h2>
                        <p>@lang('website.how_it_works_text')</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-mouse"></i>
                                <h3>@lang('website.how_it_works_choose_service_title')</h3>
                                <p>@lang('website.how_it_works_choose_service_text')</p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-tools"></i>
                                <h3>@lang('website.how_it_works_select_garage_title')</h3>
                                <p>@lang('website.how_it_works_select_garage_text')</p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-photo"></i>
                                <h3>@lang('website.how_it_works_take_photo_send_title')</h3>
                                <p>@lang('website.how_it_works_take_photo_send_text')<br><small>({{trans('website.For fixed services, packages & auto spare parts, costumer can directly buy online')}})</small></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-like2"></i>
                                <h3>@lang('website.how_it_works_easy_payment_title')</h3>
                                <p>@lang('website.how_it_works_easy_payment_text')</p>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <p class="text-center add_top_30 wow bounceIn" data-wow-delay="0.5s"><a href="{{URL::to('/register')}}" class="btn_1 rounded">@lang('website.register_now')</a></p>
                </div>
                <canvas id="hero-canvas" width="1920" height="1080"></canvas>
            </div>
            <!-- /wrapper -->
        </div>
        <!--/call_section-->
    
    <div class="container-fluid margin_80_55">
      <div class="main_title_2">
        <span><em></em></span>
        <h2>@lang('website.g2g_latest')</h2>
                <p>@lang('website.recommended')</p>
      </div>
      @if(count($latestGarages) && !empty($latestGarages))
        <div id="latest" class="owl-carousel owl-theme g2gListCarousel">
          @foreach($latestGarages as $latestGarage)
            @if(isset($latestGarage['garages_name']) && isset($latestGarage['address']))
            <div class="item">
              <div class="strip grid">
                <figure>
                  <a href="#" class="wish_bt"></a>
                  <a href="{{ route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])}}">
                    <img src="{{asset( $latestGarage['profile_image'] ) }}" class="img-fluid" alt="" width="400" height="266">
                    <div class="read_more"><span>@lang('website.Read more')</span></div>
                  </a>
                  <small>@lang('website.Garage')</small>
                </figure>
                <div class="wrapper text-center">
                  <h3><a href="{{ route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])}}"> {{ $latestGarage['garages_name'] }}</a></h3>
                  <p>
                  {{ $latestGarage['address'] }}, {{ $allCities[$latestGarage['city_id']]['name'] }}, {{ $countries[$latestGarage['country_id']]['name'] }}, {{ $latestGarage['postal'] }}</p>
                </div>
              </div>
            </div>
            @endif
          @endforeach
        </div>
        <div class="container">
          <div class="btn_home_align text-center mt-3"><a href="{{ route('listings.workshops-garages',['category' => 'latest'])}}" class="btn_1 rounded">@lang('website.view_all')</a></div>
        </div>
      @endif
    </div>
    <!-- /container -->
    @if(!empty($testimonials))
    <div class="container-fluid margin_80_55 px-0 testimonials-wrapper">
      <div class="main_title_2">
        <span><em></em></span>
        <h2>@lang('website.testimonials_title')</h2>
        <p>@lang('website.testimonials_text')</p>
      </div>
      <div class="utf_testimonial_carousel owl-carousel owl-theme">
        @foreach($testimonials as $testimonial)
        <div class="item">
          <div class="utf_testimonial_box">
            <div class="testimonial" style="color: #fff;">@if(\Config::get('app.locale') == 'en') {!! $testimonial['remarks_en'] !!} @else {!! $testimonial['remarks_ar'] !!} @endif</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{{ asset( $testimonial['image'] )}}" alt="image-testimonial">
            <h4>@if(\Config::get('app.locale') == 'en') {{$testimonial['name_en']}} @else {{$testimonial['name_ar']}} @endif <span>@if(\Config::get('app.locale') == 'en') {{ $testimonial['designation_en'] }} @else {{ $testimonial['designation_ar'] }} @endif</span></h4>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
    
        
        <div class="container margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h2>@lang('website.mobile_app_title')</h2>
                <p>@lang('website.mobile_app_text')</p>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <img src="{{ asset('website-theme/img/g2g-phone.png') }}" alt="" class="img-fluid add_bottom_45" style="max-height: 500px;">
                    <div class="app_icons">
                        <a href="https://play.google.com/store/apps/details?id=com.g2g.app" target="_blank" class="pr-lg-2"><img src="{{ asset('website-theme/img/app_android.svg') }}" alt=""></a>
                        <a href="https://apps.apple.com/ae/app/g2g-garage-to-go/id1530018365" target="_blank" class="pl-lg-2"><img src="{{ asset('website-theme/img/app_apple.svg') }}" alt=""></a>
                    </div>
                    {{--<div class="add_bottom_15"><small>@lang('website.mobile_app_coming_soon')</small></div>--}}
                </div>
            </div>
        </div>
        <!-- /container -->
        
        @if(count($sponsors) && !empty($sponsors))
        <div class="container-fluid margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h2>@lang('website.sponsors')</h2>
                <p>@lang('website.sponsors_text')</p>
            </div>
         
            <div id="latest" class="owl-carousel owl-theme g2gsponsors g2gListCarousel" >
              @foreach($sponsors as $sponsor)
                <div>
                    <img src="{{asset( $sponsor->logo ) }}" class="img-fluid"/>
                </div>
              @endforeach
            </div>
        </div>
        @endif
        
        
    </main>
    
    <style>
        #sign-in-dialog .form-group i{
            top:2.7rem !important;
        }
    </style>

    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
      <div class="small-dialog-header" style="width:100% !important">
          <span>{{trans('website.Sign In')}}</span>
      </div>
      <form action="{{ route('website.auth.sign-in-modal') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="slug" id="slug" value="">
          <input type="hidden" name="page" id="page" value="">
          <div class="sign-in-wrapper">
            
              <div class="form-group">
                  <p>{{trans('website.Email')}} / {{trans('website.Phone')}} / {{trans('website.Username')}}</p>
                  <input type="text" class="form-control" name="email" id="email" required>
                  <i class="icon_mail_alt"></i>
              </div>
              <div class="form-group">
                  <p>{{trans('website.Password')}}</p>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                  <i class="icon_lock_alt"></i>
              </div>
              <div class="text-center"><input type="submit" value="{{trans('website.Log In')}}" class="btn_1 full-width"></div>
          </div>
      </form>
    </div>

    <div id="error-in-dialog" class="zoom-anim-dialog mfp-hide">
      <div class="small-dialog-header">
          <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{trans('website.Error')}}</h3>
      </div>
     
      <div class="sign-in-wrapper">
          <div class="text-center">
              <p class="text-danger">@lang("website.you don't have permission to access this page")</p>
              <p>@lang("website.This page can only be accessed by customer. Please register as a Customer")</p>
          </div>
      </div>
    </div>
    
    

    <div id="error-in-dialog" class="zoom-anim-dialog mfp-hide">
      <div class="small-dialog-header">
          <h3>{{trans('website.Sign In')}}</h3>
      </div>
      <form action="{{ route('website.auth.sign-in-modal') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="slug" id="slug" value="">
          <div class="sign-in-wrapper">
            
              <div class="form-group">
                   <p>{{trans('website.Email')}} / {{trans('website.Phone')}} / {{trans('website.Username')}}</p>
                  <input type="text" class="form-control" name="email" id="email" required>
                  <i class="icon_mail_alt"></i>
              </div>
              <div class="form-group">
                  <p>{{trans('website.Password')}}</p>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                  <i class="icon_lock_alt"></i>
              </div>
              <div class="clearfix add_bottom_15">
                  <div class="checkboxes float-left">
                      <p class="container_check">{{trans('website.Remember me')}}
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </p>
                  </div>
                  <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">{{trans('website.Forgot Password?')}}</a></div>
              </div>
              <div class="text-center"><input type="submit" value="{{trans('website.Log In')}}" class="btn_1 full-width"></div>
              <div class="text-center">
                  {{trans('website.Don’t have an account?')}} <a href="register.html">{{trans('website.Sign up')}}</a>
              </div>
          </div>
      </form>
    </div>



@endsection

@section('js')
    <script type="text/javascript">
       $(function() {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.sign-in-modal').click(function(){
                $('#slug').val($(this).data('slug'));
                $('#page').val($(this).data('page'));
            });
        });
    </script>
    <script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
            initialize();
       });
  

       function initialize() {
        //  types: ['(regions)'], geocode
           var options = {
             
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               console.log(place);
               var city ="all";
               for(var i = 0; i < place.address_components.length; i += 1) {
                  var addressObj = place.address_components[i];
                  for(var j = 0; j < addressObj.types.length; j += 1) {
                    if (addressObj.types[j] === 'locality') {
                      //console.log(addressObj.types[j]); // confirm that this is 'country'
                      //console.log(addressObj.long_name); // confirm that this is the country name
                      city = addressObj.long_name;
                    }
                  }
                }
               
               
               $('#city').val(city);
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
           
            
       }
    </script>
@stop
