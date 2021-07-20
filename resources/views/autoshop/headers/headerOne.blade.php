<!-- //header style One -->
<header id="headerOne" class="header-area header-one header-desktop d-none d-lg-block d-xl-block sticky-top">
    <div class="header-mini bg-top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <nav id="navbar_0_2" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

                @if(count($languages) > 1)
                <div class="dropdown">

                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <img src="{{asset('').session('language_image')}}" width="17px" />
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
                  
              </div>
              <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                            <div class="nav-avatar nav-link">
                              <span>
                                @if(auth()->guard('customer')->check()) 
                                  <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;@lang('labels.Hi')&nbsp;
                                  {{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}}
                                
                                @endif 
                             
                                @if(auth()->guard('vendor')->check())  
                                   <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;@lang('labels.Hi')&nbsp;
                                  {{auth()->guard('vendor')->user()->first_name}} {{auth()->guard('vendor')->user()->last_name}}
                                   
                                @endif 

                              
                                @if(auth()->check() && auth()->user()->role_id == 1 ) 
                                 <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;@lang('labels.Hi')&nbsp;
                                  {{auth()->user()->first_name}} {{auth()->user()->last_name}}
                                  
                                @endif 
                              
                            </span>
                        </div>
                      </li>
                      @if(auth()->guard('customer')->check())
                        <li class="nav-item"> <a href="{{url('dashboard')}}" class="nav-link" ><i class="fa fa-home" aria-hidden="true"></i> @lang('website.My Account')</a> </li>
                        
                        <li class="nav-item"> <a href="{{url('logout')}}" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a> </li>

                      @elseif(auth()->guard('vendor')->check())
                        <li class="nav-item"> <a href="{{ URL::to('/garage/dashboard')}}" class="nav-link" ><i class="fa fa-home" aria-hidden="true"></i> @lang('website.My Account')</a> </li>

                        <li class="nav-item"> <a href="{{url('vlogout')}}" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a> </li>

                      @elseif(auth()->check() && auth()->user()->role_id == 1 )          
                        <li class="nav-item"> <a href="{{ URL::to('/admin/dashboard/this_month')}}" class="nav-link"><i class="fa fa-home" aria-hidden="true"></i> @lang('website.My Account')</a> </li>

                        <li class="nav-item"> <a href="{{url('vlogout')}}" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a> </li>

                      @else

                        <li class="nav-item"><div class="nav-link">@lang('website.Welcome')!</div></li>
                        <li class="nav-item"> <a href="{{ URL::to('/login')}}" class="nav-link -before"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login')</a> </li>
                        <li class="nav-item"> <a href="{{ URL::to('/register')}}" class="nav-link -before">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;@lang('website.register')</a> </li>

                      @endif
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="header-navbar logo-nav bg-menu-bar">
      <div class="container">
        <nav id="navbar_1_2" class="navbar navbar-expand-lg  bg-nav-bar">
        <a href="{{ URL::to('/autoshop')}}" class="logo">
    @if($result['commonContent']['setting'][77]->value=='name')
    <?=stripslashes($result['commonContent']['setting'][78]->value)?>
    @endif

    @if($result['commonContent']['setting'][77]->value=='logo')
    <img src="{{asset('').$result['commonContent']['setting'][15]->value}}" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
    @endif
    <!--span class="autoshop-logo-text">@lang('website.autoshop')</span-->
    </a>
          <div class=" navbar-collapse">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link " href="{{ route('page.homepage')}}" >
                    @lang('website.Home')
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="{{url('/shop')}}"  >
                    @lang('labels.link_products')
                    <span class="badge badge-secondary">@lang('website.browse')</span>
                  </a>

                </li>
               
              <li class="nav-item ">
              <a href="{{ route('page.about-us') }}"class="nav-link">@lang('website.about_g2g')</a>
              </li>
              <li class="nav-item ">
             <!--a href="javascript:void(0)" onclick="getAllGarageList()" class="nav-link">@lang('website.workshop_&_garages')</a-->
              <a href="{{ URL::to('listings/workshops-garages/near-by-garages')}}" class="nav-link">@lang('website.workshop_&_garages')</a>
              </li>
              <li class="nav-item ">
              <a href="{{ route('page.package-price') }}"class="nav-link">@lang('website.packages')</a>
              </li>
              <li class="nav-item ">
              <a href="{{ route('page.faq') }}"class="nav-link">@lang('website.faq')</a>
              </li>
               <li class="nav-item dropdown">
                <a class="nav-link" href="{{url('contact')}}" >
                  @lang('website.Contact Us')
                </a>
              </li>
           
              </ul>
            </div>

        </nav>
      </div>
    </div>
    @if(!\Request::is('login') && !\Request::is('register') && !\Request::is('resend-verification-email') && !\Request::is('forgotPassword') && !\Request::is('recoverPassword')) 
    <div class="header-maxi bg-header-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-lg-8">

            <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">
              <div class="search">
                  <div class="select-control">
                    <select class="form-control" id="searchCategory" name="category">
                     @include('autoshop.common.HeaderCategories')
                     @php    productCategories(); @endphp
                    </select>
                  </div>

                  @if ( Config::get('app.locale') == 'en')
                     <input type="search"  name="search" class="typeahead" placeholder="@lang('website.Search entire store here')..." value="{{ app('request')->input('search') }}" aria-label="@lang('website.Search entire store here')...">
                  @else
                     <input type="search"  name="search" class="typeahead" dir="rtl" placeholder="@lang('website.Search entire store here')..." value="{{ app('request')->input('search') }}" aria-label="@lang('website.Search entire store here')...">
                  @endif
                   
                  <button class="btn btn-secondary" type="submit">
                  <i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
          <div class="col-12 col-lg-4">
            <ul class="top-right-list">
              <li class="nav-item ">
                      <a href="{{url('shop?type=special')}}"class="btn btn-secondary btn-lg" >
                      <i class="fa fa-tags" style="color: #fff;"></i>&nbsp;
                      @lang('website.SPECIAL DEALS')</a>
                    </li>
              <li class="cart-header dropdown head-cart-content d-none d-md-block">
                <?php $qunatity=0; ?>
                                @foreach($result['commonContent']['cart'] as $cart_data)
                                	<?php $qunatity += $cart_data->customers_basket_quantity; ?>
                                @endforeach

                                <a href="#" id="dropdownMenuButton" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!--span class="badge badge-secondary">{{ $qunatity }}</span-->
                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                    <!--<img class="img-fluid" src="{{asset('').'public/images/shopping_cart.png'}}" alt="icon">-->

                                    <span class="block">
                                    	<span class="title">@lang('website.My Cart')</span>
                                        @if(count($result['commonContent']['cart'])>0)
                                            <span class="items">{{ count($result['commonContent']['cart']) }}&nbsp;@lang('website.items')</span>
                                        @else
                                            <span class="items">(0)&nbsp;@lang('website.item')</span>
                                        @endif
                                    </span>
                                </a>

                                @if(count($result['commonContent']['cart'])>0)
                                @php
                                $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                if($default_currency->id == Session::get('currency_id')){

                                  $currency_value = 1;
                                }else{
                                  $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

                                  $currency_value = $session_currency->value;
                                }
                                @endphp
                                <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCartButton_9">
                                    <ul class="shopping-cart-items">
                                        <?php
                                            $total_amount=0;
                                            $qunatity=0;
                                        ?>
                                        @foreach($result['commonContent']['cart'] as $cart_data)

                                        <?php
                                          
                					             	$total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
                					            	$qunatity 	  += $cart_data->customers_basket_quantity; ?>
                                        <li>
                                            <div class="item-thumb">
                                            	<a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}" class="icon" ><img class="img-fluid" src="{{asset('').'web/images/close.png'}}" alt="icon"></a>
                                            	<div class="image">
                                                	<img class="img-fluid" src="{{asset('').$cart_data->image}}" alt="{{$cart_data->products_name}}"/>
                                                </div>
                                            </div>
                                            <div class="item-detail">
                                              <h2 class="item-name">
                                                  <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}">{{$cart_data->products_name}}</a></h2>
                                              <span class="item-quantity">@lang('website.Qty')&nbsp;:&nbsp;{{$cart_data->customers_basket_quantity}}</span>
                                              <span class="item-price">{{Session::get('symbol_left')}}{{$cart_data->final_price*$cart_data->customers_basket_quantity*$currency_value}}{{Session::get('symbol_right')}}</span>
                                           </div>
                                        </li>
                                        @endforeach
                                    <li>
                                      <div class="tt-summary">
                                      	  <p>@lang('website.items')<span>{{ $qunatity }}</span></p>
                                        	<p>@lang('website.SubTotal')<span>{{Session::get('symbol_left')}}{{ $total_amount*$currency_value }}{{Session::get('symbol_right')}}</span></p>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="buttons">
                                          <a class="btn btn-dark" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>
                                          <a class="btn btn-secondary" href="{{ URL::to('/checkout')}}">@lang('website.Checkout')</a>
                                      </div>
                                   </li>
                                 </ul>

                                </div>

                				@else

                          <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                              <ul class="shopping-cart-items">
                                  <li>@lang('website.You have no items in your shopping cart')</li>
                              </ul>
                          </div>
                        @endif

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    @endif
  </header>
