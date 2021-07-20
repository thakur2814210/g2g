<header id="headerMobile" class="header-area header-mobile d-lg-none d-xl-none">
    <div class="header-mini bg-top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">

            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">
                @if(count($languages) > 1)
                <div class="dropdown">
                    <button class="btn" style="background:none;" href="#">
                      <img style="margin-right:-30px;"src="{{asset('').session('language_image')}}" width="17px" />
                    </button>
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     {{	session('language_name')}}
                    </button>
                    <ul class="dropdown-menu">
                      @foreach($languages as $language)
                      <li  @if(session('locale')==$language->code) style="background:lightgrey;" @endif>
                        <button  onclick="myFunction1({{$language->languages_id}})" class="btn" style="background:none;" href="#">
                          <img style="margin-left:10px; margin-right:10px;"src="{{asset('').$language->image_path}}" width="17px" />
                          <span>{{$language->name}}</span>
                        </button>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                  @include('autoshop.common.scripts.changeLanguage')
                  @endif

                  <!--  CHANGE Currency CODE SECTION -->
                  @if(count($currencies) > 1)
                  <div class="dropdown">
                      <button class="btn" style="background:none;" href="#">
                       @if(session('symbol_left') != null)
                       <span style="margin-right:-30px;">{{session('symbol_left')}}</span>
                       @else
                       <span style="margin-right:-30px;">{{session('symbol_right')}}</span>
                       @endif
                      </button>
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                       {{session('currency_code')}}
                      </button>
                      <ul class="dropdown-menu">
                        @foreach($currencies as $currency)
                        <li  @if(session('currency_title')==$currency->code) style="background:lightgrey;" @endif>
                          <button  onclick="myFunction2({{$currency->id}})" class="btn" style="background:none;" href="#">
                            @if($currency->symbol_left != null)
                            <span style="margin-left:10px; margin-right:10px;">{{$currency->symbol_left}}</span>
                            <span>{{$currency->code}}</span>
                            @else
                            <span style="margin-left:10px; margin-right:10px;">{{$currency->symbol_right}}</span>
                            <span>{{$currency->code}}</span>
                            @endif
                          </button>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                    @include('autoshop.common.scripts.changeCurrency')
                    @endif
                    <!-- END  Currency LANGUAGE CODE SECTION -->
              </div>
              <div class="contact d-none d-md-block">
                <i class="fas fa-phone"></i> Call us Now 888-9636-6000
              </div>

            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="header-maxi bg-header-bar " style="background: #fff;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-2 pr-0">
              <div class="navigation-mobile-container">
                  <a href="javascript:void(0)" class="navigation-mobile-toggler">
                      <span class="fas fa-bars"></span>
                  </a>
                  <nav id="navigation-mobile">
					<div class="wrapper">
						<div class="close-mobile-menu"><i class="fa fa-times"></i></div>
                      <div class="logout-main">
						<a href="{{ URL::to('/')}}" class="logo" style="margin-bottom: 30px;">
						@if($result['commonContent']['setting'][77]->value=='name')
						<?=stripslashes($result['commonContent']['setting'][78]->value)?>
						@endif

						@if($result['commonContent']['setting'][77]->value=='logo')
						<img src="{{asset('').$result['commonContent']['setting'][15]->value}}" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
						@endif
					   </a>
					   					
						@if(auth()->guard('customer')->check())
						   
                          <div class="welcome">
                            <span>@lang('labels.Hi')&nbsp;! {{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}} </span>
                          </div>
						  
						  {{--	<div class="login">
							  <div class="row">
								<div class="col-6">
								  <a href="{{url('logout')}}" class=""><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a>
								</div>
								<div class="col-6">	
								</div>
							  </div>
                          </div> --}}
						  
						  @elseif(auth()->guard('vendor')->check())
						  
						  <div class="welcome">
                            <span>@lang('labels.Hi')&nbsp;! {{auth()->guard('vendor')->user()->first_name}} {{auth()->guard('vendor')->user()->last_name}}</span>
                          </div>
						  
						  {{--<div class="login">
							  <div class="row">
								<div class="col-6">
								  <a href="{{url('vlogout')}}" class=""><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a>
								</div>
								<div class="col-6">	
								</div>
							  </div>
                          </div>--}}
                          
						  @else
						  <div class="welcome">
                            <span>@lang('website.Welcome')&nbsp;!</span>
                          </div>
                          
                          {{-- <div class="login">
							  <div class="row">
								<div class="col-6">
								  <a href="{{URL::to('/login')}}" class=""><i class="fa fa-lock"></i> @lang('website.Login')</a>
								</div>
								<div class="col-6 pl-0">	
								  <a href="{{URL::to('/register')}}" class=""><i class="fa fa-user-circle"></i> @lang('website.register')</a>
								</div>
							  </div>
                          </div> --}}
						  @endif
						  
                      </div>
					  

                      

                      <a href="{{url('/')}}" class="main-manu btn btn-primary">
                        <i class="fa fa-home" aria-hidden="true"></i>&nbsp;
                        @lang('website.Home')
                      </a>

                       <a href="{{ route('page.about-us') }}" class="main-manu btn btn-primary">
                       <i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;
                        @lang('website.about_g2g')
                      </a>

                       <a href="{{ route('listings.workshops-garages',['category' => 'all']) }}" class="main-manu btn btn-primary">
                        <i class="fa fa-car" aria-hidden="true"></i>&nbsp;
                       @lang('website.workshop_&_garages')
                     </a>

                      <a href="{{ route('page.package-price') }}" class="main-manu btn btn-primary">
                        <i class="fa fa-tag" aria-hidden="true"></i>&nbsp;
                        @lang('website.packages')
                      </a>

                      <a href="{{ route('page.faq') }}" class="main-manu btn btn-primary">
                        <i class="fa fa-image" aria-hidden="true"></i>&nbsp;
                        @lang('website.faq')
                      </a>

                       <a href="{{url('contact')}}" class="main-manu btn btn-primary">
                        <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;
                        @lang('website.Contact Us')
                      </a>
                      
                      <a href="{{url('/autoshop')}}" class="main-manu btn btn-primary">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        @lang('website.autoshop')
                      </a>

                      @if(auth()->guard('customer')->check())
                         <a href="{{url('profile')}}" class="main-manu btn btn-primary">
							<i class="fa fa-user" aria-hidden="true"></i>
							@lang('website.Profile')
						</a>
                         <a href="{{url('wishlist')}}" class="main-manu btn btn-primary">
							<i class="fa fa-heart" aria-hidden="true"></i>
							@lang('website.Wishlist')
						</a>
                         <a href="{{url('compare')}}" class="main-manu btn btn-primary">
							<i class="fa fa-eye" aria-hidden="true"></i>
							@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)
						</a>
                         <a href="{{url('orders')}}" class="main-manu btn btn-primary">
							<i class="fa fa-list" aria-hidden="true"></i>
							@lang('website.Orders')
						 </a>
                         <a href="{{url('shipping-address')}}" class="main-manu btn btn-primary">
							<i class="fa fa-truck" aria-hidden="true"></i>
							@lang('website.Shipping Address')
						 </a>
                         <a href="{{url('logout')}}" class="main-manu btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a>
                      @elseif(auth()->guard('vendor')->check())
                        <a href="{{ URL::to('/garage/dashboard')}}" class="main-manu btn btn-primary">
							<i class="fa fa-tachometer" aria-hidden="true"></i>
							@lang('website.dashboard')
						</a> 

                        <a href="{{ URL::to('/garage/profile')}}" class="main-manu btn btn-primary">
							<i class="fa fa-user" aria-hidden="true"></i>
							@lang('website.Profile')
						</a> 
                        
						<a href="{{url('vlogout')}}" class="main-manu btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a>
						
                        {{--<a href="{{url('vlogout')}}" class="main-manu btn btn-primary"> style="border-radius: 200px;padding-top: 5px;padding-bottom: 4px;color: #fff;margin: 2px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a> --}}

                      @else


					  {{-- <div class="nav-link">@lang('website.Welcome')!</div> --}}

                        <a href="{{ URL::to('/login')}}" class="main-manu btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login')</a> 
                        
                        <a href="{{ URL::to('/register')}}" class="main-manu btn btn-primary">
					  <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;@lang('website.register')</a>

                      @endif
                    </div>
				
                  </nav>
              </div>

          </div>



          <div class="col-8">
            <a href="{{ URL::to('/')}}" class="logo">
            @if($result['commonContent']['setting'][77]->value=='name')
            <?=stripslashes($result['commonContent']['setting'][78]->value)?>
            @endif

            @if($result['commonContent']['setting'][77]->value=='logo')
            <img src="{{asset('').$result['commonContent']['setting'][15]->value}}" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
            @endif
           </a>
          </div>

          <div class="col-2 pl-0">
              <div class="cart-dropdown dropdown head-cart-content">
               @include('autoshop.headers.cartButtons.cartButton')
              </div>
          </div>
        </div>
      </div>
    </div>
    @if(!\Request::is('login') && !\Request::is('register') && !\Request::is('resend-verification-email') && !\Request::is('forgotPassword') && !\Request::is('recoverPassword')) 
      <div class="header-navbar bg-menu-bar">
        <div class="container">
          <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">
            <div class="search">
              <div class="select-control">
                <select class="form-control" name="category">
                  <?php productCategories(); ?>
                </select>
              </div>
              <input  type="search" placeholder="Search entire store here">
              <button class="btn btn-secondary" type="submit">
              <i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>
    @endif
</header>
