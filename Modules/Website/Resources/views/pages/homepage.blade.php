@extends('website::layouts.homepage')

@section('website_css_pre')

@stop

@section('website_css')
    <style>
         #error-in-dialog{
            background: #fff;
            padding: 30px;
            padding-top: 0;
            text-align: left;
            max-width: 400px;
            margin: 40px auto;
            position: relative;
            box-sizing: border-box;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            border-radius: 4px;
        }
    </style>

    @if(\Config::get('app.locale') == 'ar')
        <style>
            .owl-carousel,
            .bx-wrapper { direction: ltr; }
            .owl-carousel .owl-item { direction: rtl; }
        </style>
    @endif

@stop

@section('content')

	<main class="pattern">
        		
		<section class="hero_single version_5">
			<div class="wrapper">
				<div class="container">
					<div class="row justify-content-center pt-lg-5">
						<div class="col-xl-6 col-lg-6">
							<h3>@lang('website::default.homapage_slider_text_1')</h3>
							<p>@lang('website::default.homapage_slider_text_2')</p>
							<form method="get" action="{{ route('listings.search-by-location')}}">
								<input type="hidden" name="latitude" id="latitude" value="">
								<input type="hidden" name="longitude" id="longitude" value="">
								<div class="custom-search-input-2">
									<div class="form-group">
										<input type="text" name="address" id="autocomplete" class="form-control" placeholder="Location/City/Address">
										<i class="pe-7s-edit toogle-distance-slider"></i>
										<div class="distance-slider" style="display: none;">
										<div class="text-primary mb-2">Distance: <span id="distance-value">5</span>KM</div>
    										<input id="thedistance" name="distance" type="range" min="0" max="1000" step="5" value="5" >
    									</div>
									</div>
									<select class="wide" name="category">
										<option value="all">All Categories</option>	
										@foreach($all_categories as $cat)
											<option value="{{ $cat->id }}">{{ $cat->name }}</option>
										@endforeach
									</select>
									<input type="submit" value="Search" style="background-color: #fb8d00;">
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
                               
                        <a href="{{ route('autoshop.homepage')}}" >
                            <i class="ti-shopping-cart"></i>
                            <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">@lang('website::default.auto_shop')</label>
                        </a>
                        <p><small>@lang('website::default.auto_shop')</small></p>
                    </li>
                	@foreach($sections as $category)
                        @if($category->type == 1 && $category->slug != 'custom-request')
                            <li class="col-6 col-md-3 col-lg-2">
                                @if(Auth::guard('client')->check())
                                    <a href="{{ route('client.service-request.create',['category' => $category->slug])}}">
                                @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                    <a href="#error-in-dialog"  class="login error-in-modal">
                                @else
                                    <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="service-request"  class="login sign-in-modal" >
                                @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</label>
                                </a>
                                <p><small>@lang('website::default.Service Request')</small></p>
                            </li>
                        @endif
                	@endforeach

                    @foreach($sections as $category)
                        @if($category->type == 1 && $category->slug == 'custom-request')
                            <li class="col-6 col-md-3 col-lg-2">
                            @if(Auth::guard('client')->check())
                                <a href="{{ route('client.service-request.create',['category' => $category->slug])}}">
                            @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            @else
                                <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="service-request"  class="login sign-in-modal" >
                            @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</label>
                                </a>
                                <p><small>@lang('website::default.Service Request')</small></p>
                            </li>
                        @endif
                    @endforeach


                    @foreach($sections as $category)
                        @if($category->type == 2 && $category->slug != 'custom-package')
                            <li class="col-6 col-md-3 col-lg-2">
                            @if(Auth::guard('client')->check())
                                <a href="{{ route('client.package-subscription.create',['category' => $category->slug])}}">
                            @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            @else
                                <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="client-package-subscription"  class="login sign-in-modal">
                            @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</label>
                                </a>
                                <p><small>@lang('website::default.Package Subscription')</small></p>
                            </li>
                        @endif
                    @endforeach

                    @foreach($sections as $category)
                        @if($category->type == 2 && $category->slug == 'custom-package')
                            <li class="col-6 col-md-3 col-lg-2">
                            @if(Auth::guard('client')->check())
                                <a href="{{ route('client.package-subscription.create',['category' => $category->slug])}}">
                            @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            @else
                                <a href="#sign-in-dialog" data-slug="{{$category->slug}}" data-page="client-package-subscription"  class="login sign-in-modal">
                            @endif
                                    <i class="{{ $category->cat_icon }}"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600">{{$category->sections_name}}</label>
                                </a>
                                <p><small>@lang('website::default.Package Subscription')</small></p>
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
				<h2>@lang('website::default.workshop_and_garage')</h2>
				<p>@lang('website::default.recommended')</p>
			</div>
			@if(count($featureGarages) && !empty($featureGarages))

				<div id="reccomended" class="owl-carousel owl-theme">
					@foreach($featureGarages as $featureGarage)
						<div class="item">
							<div class="strip grid">
								<figure>
									<a href="#" class="wish_bt"></a>
									<a href="{{ route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])}}">
										<img src="{{ asset($featureGarage['profile_image'] ) }}" class="img-fluid" alt="" width="400" height="266">
										<div class="read_more"><span>Read more</span></div>
									</a>
									<small>Garage</small>
								</figure>
								<div class="wrapper">
									<h3><a href="{{ route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])}}">{{ $featureGarage['garages_name'] }}</a></h3>
									<p> <b>Address:</b>
                                   
									{{ $featureGarage['address'] }}, {{ $allCities[$featureGarage['city_id']]['name'] }}, {{ $countries[$featureGarage['country_id']]['name'] }}, {{ $featureGarage['postal'] }}</p>
								</div>
								{{--<ul>
									<li><span class="loc_open">Now Open</span></li>
									<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
								</ul>--}}
							</div>
						</div>
					@endforeach
				</div>
				<div class="container">
					<div class="btn_home_align text-center mt-3"><a href="{{ route('listings.workshops-garages',['category' => 'featured'])}}" class="btn_1 rounded">@lang('website::default.view_all')</a></div>
				</div>
			@endif
		</div>
		<!-- /container -->
		
		<div class="call_section">
            <div class="wrapper">
                <div class="container margin_80_55">
                    <div class="main_title_2">
                        <span><em></em></span>
                        <h2>@lang('website::default.how_it_works_title')</h2>
                        <p>@lang('website::default.how_it_works_text')</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-mouse"></i>
                                <h3>@lang('website::default.how_it_works_choose_service_title')</h3>
                                <p>@lang('website::default.how_it_works_choose_service_text')</p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-tools"></i>
                                <h3>@lang('website::default.how_it_works_select_garage_title')</h3>
                                <p>@lang('website::default.how_it_works_select_garage_text')</p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-photo"></i>
                                <h3>@lang('website::default.how_it_works_take_photo_send_title')</h3>
                                <p>@lang('website::default.how_it_works_take_photo_send_text')<br><small>(For fixed services, packages & auto spare parts, costumer can directly buy online.)</small></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-like2"></i>
                                <h3>@lang('website::default.how_it_works_easy_payment_title')</h3>
                                <p>@lang('website::default.how_it_works_easy_payment_text')</p>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <p class="text-center add_top_30 wow bounceIn" data-wow-delay="0.5s"><a href="{{ route('client.login')}}" class="btn_1 rounded">@lang('website::default.register_now')</a></p>
                </div>
                <canvas id="hero-canvas" width="1920" height="1080"></canvas>
            </div>
            <!-- /wrapper -->
        </div>
        <!--/call_section-->
		
		<div class="container-fluid margin_80_55">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>@lang('website::default.g2g_latest')</h2>
                <p>@lang('website::default.recommended')</p>
			</div>
			@if(count($latestGarages) && !empty($latestGarages))
				<div id="latest" class="owl-carousel owl-theme reccomended11">
					@foreach($latestGarages as $latestGarage)
						<div class="item">
							<div class="strip grid">
								<figure>
									<a href="#" class="wish_bt"></a>
									<a href="{{ route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])}}">
										<img src="{{asset( $latestGarage['profile_image'] ) }}" class="img-fluid" alt="" width="400" height="266">
										<div class="read_more"><span>Read more</span></div>
									</a>
									<small>Garage</small>
								</figure>
								<div class="wrapper">
									<h3><a href="{{ route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])}}"> {{ $latestGarage['garages_name'] }}</a></h3>
									<p> <b>Address:</b>
									{{ $latestGarage['address'] }}, {{ $allCities[$latestGarage['city_id']]['name'] }}, {{ $countries[$latestGarage['country_id']]['name'] }}, {{ $latestGarage['postal'] }}</p>
								</div>
								{{--<ul>
									<li><span class="loc_open">Now Open</span></li>
									<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
								</ul>--}}
							</div>
						</div>
					@endforeach
				</div>
				<div class="container">
					<div class="btn_home_align text-center mt-3"><a href="{{ route('listings.workshops-garages',['category' => 'latest'])}}" class="btn_1 rounded">@lang('website::default.view_all')</a></div>
				</div>
			@endif
		</div>
		<!-- /container -->
		@if(!empty($testimonials)))
		<div class="container-fluid margin_80_55 px-0 testimonials-wrapper">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>@lang('website::default.testimonials_title')</h2>
				<p>@lang('website::default.testimonials_text')</p>
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
                <h2>@lang('website::default.mobile_app_title')</h2>
                <p>@lang('website::default.mobile_app_text')</p>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <img src="{{ asset('website-theme/img/g2g-phone.png') }}" alt="" class="img-fluid add_bottom_45" style="max-height: 500px;">
                    <div class="app_icons">
                        <a href="javascript:void(0)" class="pr-lg-2"><img src="{{ asset('website-theme/img/app_android.svg') }}" alt=""></a>
                        <a href="javascript:void(0)" class="pl-lg-2"><img src="{{ asset('website-theme/img/app_apple.svg') }}" alt=""></a>
                    </div>
                    <div class="add_bottom_15"><small>@lang('website::default.mobile_app_coming_soon')</small></div>
                </div>
            </div>
        </div>
        <!-- /container -->
    </main>
@stop

@section('website_js')
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
       
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
    </script>
@stop

