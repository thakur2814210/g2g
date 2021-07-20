<header class="header_in is_sticky">
	<div class="container">
		<div id="logo">
			<a href="{{ route('page.homepage')}}" title="G2G">
				<img src="{{ asset('website-theme/img/logo/logo-g2g.png') }}" height="44" alt="" class="logo_sticky">
			</a>
		</div>
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<nav id="menu" class="main-menu">
			
			<ul>
				<li><span><a href="{{ route('page.homepage')}}"> @lang('website::default.home') </a></span></li>
				<li><span><a href="{{ route('page.about-us') }}">@lang('website::default.about_us')</a></span></li>
				<li><span><a href="{{ route('listings.workshops-garages',['category' => 'all']) }}">@lang('website::default.workshop_garage')</a></span></li>
				<li><span><a href="{{ route('page.package-price') }}"> @lang('website::default.packages')</a></span></li>
				<li><span><a href="{{ route('page.faq') }}"> @lang('website::default.faq')</a></span></li>
				<li><span><a href="{{ route('page.contact-us') }}"> @lang('website::default.contact_us')</a></span></li>
				
	             <li>
	             	@if(\Config::get('app.locale') == 'en')
						<a href="javascript:void(0)"><img height="20" width="20" src="{{ asset('website-theme/img/uk.png') }}" /> English (En)</a>
	             	@elseif(\Config::get('app.locale') == 'ar')
						<a href="javascript:void(0)"><img height="20" width="20" src="{{ asset('website-theme/img/uae.png') }}" /> عربى (Ar)</a>
	             	@endif
	             	
					<ul>
                        <li><a href="{{ route('lang.switch', ['lang' => 'en']) }}"><img height="20" width="20" src="{{ asset('website-theme/img/uk.png') }}" /> English (En)</a></li>
                        <li><a href="{{ route('lang.switch', ['lang' => 'ar']) }}"><img height="20" width="20" src="{{ asset('website-theme/img/uae.png') }}" /> عربى (Ar)</a></li>
                    </ul>
				</li>

				@if(
	           		Auth::guard('admin')->check() || 
	           		Auth::guard('client')->check() || 
	           		Auth::guard('vendor')->check()
	           		)
	            	<li><span>
		            		<a href="javascript:void(0)" class="text-danger btn_add">
		            			My Account
		            		</a>
	            		</span>
						<ul>
							@if(Auth::guard('admin')->check())
			                    <li><a href="{{ route('superadmin.dashboard')}}">SuperAdmin: {{Auth::guard('admin')->user()->username}}</a></li>
			                    <li><a href="{{ route('superadmin.logout')}}" >@lang('website::default.logout')</a></li>
			                @elseif(Auth::guard('vendor')->check())
			                    <li><a href="{{ route('garage.dashboard')}}" >Garage: {{Auth::guard('vendor')->user()->username}}</a></li>
			                    <li><a href="{{ route('garage.logout')}}" >@lang('website::default.logout')</a></li>
			                @elseif(Auth::guard('client')->check())
			                    <li><a href="{{ route('client.dashboard')}}" >Customer: {{Auth::guard('client')->user()->username}}</a></li>
			                     <li><a href="{{ route('client.logout')}}" >@lang('website::default.logout')</a></li>
			                @endif
		            	</ul>
		            </li>
				@else
					 <li><span><a href="javascript:void(0)" class="text-danger btn_add">@lang('website::default.sign_in')</a></span>
	                    <ul>
	                        <li><a href="{{ route('client.login') }}">@lang('website::default.customer')</a></li>
	                        <li><a href="{{ route('garage.login') }}">@lang('website::default.garage')</a></li>
	                    </ul>
	                </li>
	            @endif
	            <li><a class="text-danger btn_add" href="{{ route('autoshop.homepage')}}"> @lang('website::default.auto_shop')</a></li>
			</ul>
		</nav>
	</div>
</header>
    <!-- /header -->