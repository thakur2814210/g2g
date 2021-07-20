<!-- //footer style One -->
 <footer id="footerOne" class="footer-area footer-one footer-desktop ">
    <div class="wrapper">
		<div class="container">
		  <div class="row">
			<div class="col-12 col-lg-3">
			  <div class="single-footer">
				<h5>@lang('website.footer_contact_info')</h5>
				<div class="row">
				  <div class="col-12 col-lg-8">
					<hr>
				  </div>
				</div>
				@php $contactusinfo = \DB::table('contact_us')->first(); @endphp
				<ul class="contact-list  pl-0 mb-0">
					  <li> <i class="fas fa-map-marker"></i>&nbsp;&nbsp;&nbsp;<span>{{( \Config::get('app.locale') == 'en' ) ? $contactusinfo->address_en : $contactusinfo->address_ar }}</span> </li>
				  <li> <i class="fas fa-phone"></i><span>Office: {{$contactusinfo->phone}}<br>Mobile: {{$contactusinfo->mobile}}</span> </li>
				  <li> <i class="fas fa-envelope"></i><span> <a href="mailto:info@g2g.ae">{{$contactusinfo->email}}</a> </span> </li>

				</ul>
			  </div>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
			  <div class="footer-block">
				  <div class="single-footer single-footer-left">
					<h5>@lang('website.Our Services')</h5>
					<div class="row">
						<div class="col-12 col-lg-8">
						  <hr>
						</div>
					  </div>
					<ul class="links-list pl-0 mb-0">
					<li> <a href="{{ URL::to('/shop')}}"><i class="fa fa-angle-right"></i>@lang('website.Shop')</a> </li>
					<li> <a href="{{ URL::to('/orders')}}"><i class="fa fa-angle-right"></i>@lang('website.Orders')</a> </li>
					<li> <a href="{{ URL::to('/viewcart')}}"><i class="fa fa-angle-right"></i>@lang('website.Shopping Cart')</a> </li>
					<li> <a href="{{ URL::to('/wishlist')}}"><i class="fa fa-angle-right"></i>@lang('website.Wishlist')</a> </li>
					</ul>
				  </div>

			  </div>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
			  <div class="single-footer single-footer-right">
				<h5>@lang('website.Information')</h5>
				<div class="row">
					<div class="col-12 col-lg-8">
					  <hr>
					</div>
				  </div>
				<ul class="links-list pl-0 mb-0">
				  @if(count($result['commonContent']['pages']))
					  @foreach($result['commonContent']['pages'] as $page)
						  <li> <a href="{{ URL::to('/page?name='.$page->slug)}}"><i class="fa fa-angle-right"></i>{{$page->name}}</a> </li>
					  @endforeach
				  @endif
					  <li> <a href="{{ route('page.term-and-condtions') }}"><i class="fa fa-angle-right"></i>@lang('website.terms_and_conditions')</a> </li>
					  <li><a href="{{ route('page.faq') }}"><i class="fa fa-angle-right"></i>@lang('website.faq')</a></li>
					  <li><a href="{{ route('page.privacy') }}"><i class="fa fa-angle-right"></i>@lang('website.privacy')</a></li>
					  <li><a href="{{ route('page.contact-us') }}"><i class="fa fa-angle-right"></i>@lang('website.contact_us')</a></li>
				</ul>
			  </div>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
			  <div class="single-footer single-footer-right">
				<h5>@lang('website.footer_quick_links')</h5>
				<div class="row">
					<div class="col-12 col-lg-8">
					  <hr>
					</div>
				  </div>
				<ul class="links-list pl-0 mb-0">
					<li> <a href="{{ URL::to('/')}}"><i class="fa fa-angle-right"></i>@lang('website.Home')</a> </li>
					<li><a href="{{ route('page.about-us') }}"><i class="fa fa-angle-right"></i>@lang('website.about_us')</a></li>
					<li><a href="{{ route('listings.workshops-garages',['category' => 'all']) }}"><i class="fa fa-angle-right"></i>@lang('website.workshop_garage')</a></li>
					<li><a href="{{ route('page.package-price') }}"><i class="fa fa-angle-right"></i>@lang('website.packages')</a></li>
				</ul>
			  </div>
			</div>

			{{--<div class="col-12 col-lg-3">
			  <div class="single-footer">
				@if(!empty($result['commonContent']['setting'][89]) and $result['commonContent']['setting'][89]->value==1)
				  <div class="newsletter">
					  <h5>@lang('website.Subscribe for Newsletter')</h5>
					  <div class="row">
						  <div class="col-12 col-lg-8">
							<hr>
						  </div>
						</div>
					  <div class="block">
						  <form class="form-inline">
							  <div class="search">
								<input type="email" name="email" id="email" placeholder="@lang('website.Your email address here')">
								<button type="button" id="subscribe" class="btn btn-secondary">@lang('website.Subscribe')</button>
								  @lang('website.Subscribe')
								  </button>
								  <button class="btn-secondary fas fa-location-arrow" type="submit">
								  </button>
								  <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>

								  <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
							  </div>
							</form>
					  </div>
				  </div>
				  @endif
				  <div class="socials">
					  <h5>@lang('website.Follow Us')</h5>
					  <div class="row">
						  <div class="col-12 col-lg-8">
							<hr>
						  </div>
						</div>
					  <ul class="list">
						<li>
							@if(!empty($result['commonContent']['setting'][50]->value))
							  <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fa-facebook-f" target="_blank"></a>
							  @else
								<a href="#" class="fab fa-facebook-f"></a>
							  @endif
						  </li>
						  <li>
						  @if(!empty($result['commonContent']['setting'][52]->value))
							  <a href="{{$result['commonContent']['setting'][52]->value}}" class="fab fa-twitter" target="_blank"></a>
						  @else
							  <a href="#" class="fab fa-twitter"></a>
						  @endif</li>
						  <li>
						  @if(!empty($result['commonContent']['setting'][51]->value))
							  <a href="{{$result['commonContent']['setting'][51]->value}}"  target="_blank"><i class="fab fa-google"></i></a>
						  @else
							  <a href="#"><i class="fab fa-google"></i></a>
						  @endif
						  </li>
						  <li>
						  @if(!empty($result['commonContent']['setting'][53]->value))
							  <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab fa-linkedin-in" target="_blank"></a>
						  @else
							  <a href="#" class="fab fa-linkedin-in"></a>
						  @endif
						  </li>
					  </ul>
				  </div>

			  </div>
			</div>--}}
		  </div>
		</div>
		<div class="container-fluid p-0">
			<div class="copyright-content">
				<div class="container">
				  <div class="row align-items-center">
					  <div class="col-12 col-md-6">
						<div class="footer-image">
							<img class="img-fluid" src="{{asset('web/images/miscellaneous/payments.png')}}">
						</div>

					  </div>
					  <div class="col-12 col-md-6">
						<div class="footer-info">
						{{--© @lang('website.Copy Rights').  <a href="{{url('/page?name=refund-policy')}}">@lang('website.Privacy')</a>&nbsp;&bull;&nbsp;<a href="term.html">@lang('website.Terms')</a>--}}G2G©@php echo date('Y'); @endphp
						</div>

					  </div>
				  </div>
				</div>
			  </div>
		</div>
    </div>
</footer>
