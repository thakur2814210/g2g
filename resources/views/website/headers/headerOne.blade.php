<!-- //header style One -->
<header id="headerOne" class="header-area header-one header-desktop d-none d-lg-block d-xl-block sticky-top">
    <div class="header-mini bg-top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <nav id="navbar_0_2" class="navbar navbar-expand-md navbar-dark navbar-0">
              
              <div class="navbar-lang">

                @if(count($languages) > 1)

               

                <div class="dropdown changeLanguageBtn">

                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <img src="{{asset('').session('language_image')}}" width="17px" />
                     {{	session('language_name')}}
                    </button>
                    <ul class="dropdown-menu" style="min-width: 12rem;">
                      @foreach($languages as $language)
                      <li  @if(session('locale')==$language->code) style="background:lightgrey;" @endif>
                        <button  onclick="myFunction1({{$language->languages_id}})" class="btn" style="background:none;" href="#">
                          <img style="margin-left:10px; margin-right:10px;"src="{{asset('').$language->image_path}}" width="17px" />
                          <span>{{trans('website.'.$language->name)}} - {{$language->name}}</span>
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
                                  <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;@lang('labels.Hi'),&nbsp;
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
                        
                        <li class="nav-item"> <a href="{{url('logout')}}" class="nav-link padding-r0" ><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a> </li>

                      @elseif(auth()->guard('vendor')->check())
                        <li class="nav-item"> <a href="{{ route('garage.dashboard')}}" class="nav-link" ><i class="fa fa-home" aria-hidden="true"></i> @lang('website.My Account')</a> </li>

                        <li class="nav-item"> <a href="{{route('garage.logout')}}" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a> </li>

                      @elseif(auth()->check() && auth()->user()->role_id == 1 )          
                        <li class="nav-item"> <a href="{{ route('superadmin.dashboard')}}" class="nav-link"><i class="fa fa-home" aria-hidden="true"></i> @lang('website.My Account')</a> </li>

                        <li class="nav-item"> <a href="{{url('logout')}}" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('website.Logout')</a> </li>

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
        <a href="{{ URL::to('/')}}" class="logo">
    @if($result['commonContent']['setting'][77]->value=='name')
    <?=stripslashes($result['commonContent']['setting'][78]->value)?>
    @endif

    @if($result['commonContent']['setting'][77]->value=='logo')
    <img src="{{asset('').$result['commonContent']['setting'][15]->value}}" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
    @endif
    </a>
          <div class=" navbar-collapse">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link " href="{{ route('page.homepage')}}" >
                    @lang('website.Home')
                  </a>
                </li>

              <li class="nav-item ">
              <a href="{{ route('page.about-us') }}" class="nav-link">@lang('website.about_g2g')</a>
              </li>
              <li class="nav-item ">
              <a href="{{ URL::to('listings/workshops-garages/near-by-garages')}}" class="nav-link">@lang('website.workshop_&_garages')</a>
              </li>
              <li class="nav-item ">
              <a href="{{ route('page.package-price') }}" class="nav-link">@lang('website.packages')</a>
              </li>
              <li class="nav-item ">
              <a href="{{ route('page.faq') }}"class="nav-link">@lang('website.faq')</a>
              </li>
               <li class="nav-item dropdown">
                <a class="nav-link" href="{{url('contact')}}" >
                  @lang('website.Contact Us')
                </a>
              </li>
                <li class="nav-item ">
                      <a href="{{url('/autoshop')}}" target="_blank"  class="btn btn-secondary"> 
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;@lang('website.autoshop')</a>
                    </li>
              </ul>
            </div>

        </nav>
      </div>
    </div>
  </header>
