<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G2G | Client</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

     @yield('website_css_pre')

    <!-- BASE CSS -->
    <link rel="stylesheet" href="{{ asset('website-theme/css/bootstrap.min.css') }}"> 
    @if(\Config::get('app.locale') == 'ar')
       <link rel="stylesheet" href="{{ asset('website-theme/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css') }}">
    @endif
     <link rel="stylesheet" href="{{ asset('website-theme/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/color-red.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/custom.css') }}">
   

    <link rel="stylesheet" href="{{ asset('website-theme/admin/vendor/font-awesome/css/font-awesome.min.css')}} " rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="{{ asset('website-theme/admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/admin/css/date_picker.css') }}">
     @yield('website_css')

</head>

<body class="@if(\Config::get('app.locale') == 'ar') rtl @endif ">
        
    <div id="page">
        
        @include('website::include.home-header')


        <main>
            <div class="" style="padding: 10px;">
                <div class="row margin_60_35">
                    <aside class="col-lg-3">
                            <div class="box_style_cat">
                              <div class="card flex-row flex-wrap m-0">
                                  <div class="card-header border-0">
                                       <i class="fa fa-2x fa-user-circle"></i>  
                                  </div>
                                  <div class="card-block px-2">
                                      <h6 style="margin: 0px;" class="card-title m-0 text-danger">{{ Auth::user()->username }}</h6>
                                        Customer Admin Panel
                                  </div>
                              </div> 
                            </div>
                            
                            <div class="box_style_cat">
                                 <ul id="cat_nav">
                                    <li><a href="{{ route('client.dashboard')}}" class="{{ request()->is('client/dashboard') ? 'active' : '' }}"><i class="fa fas fa-home"></i>Dashboard</a></li>
                                </ul>
                            </div>
                            <div class="box_style_cat">
                                <ul id="cat_nav">
                                     <li style="background: #ddd;" class="text-center p-2">
                                        Manage Request,Package & Payments
                                    </li>
                                    <li><a href="{{ route('client.service-request')}}" class="{{ request()->is('client/service-request/*') ? 'active' : '' }}"><i class="fa fas fa-tasks"></i>Service Request</a></li>
                                    <li><a href="{{ route('client.packages')}}" class="{{ request()->is('client/package-subscription/*') ? 'active' : '' }}"><i class="fa fas fa-tags"></i>Packages Subscription</a></li>
                                    <li><a href="{{ route('client.payments')}}" class="{{ request()->is('client/payments') ? 'active' : '' }}"><i class="fa fas fa-money"></i>Payments</a></li>
                                    
                                </ul>
                            </div>
                            <div class="box_style_cat">
                               
                                 <ul id="cat_nav">
                                    <li style="background: #ddd;" class="text-center p-2">
                                       Manage Accounts
                                    </li>
                                    <li><a href="{{ route('client.vehicles') }}" class="{{ request()->is('client/accounts/vehicles/*') ? 'active' : '' }}"><i class="fa fas fa-car"></i>Registered Vehicles</a></li>
                                    <li><a href="{{ route('client.profile.edit') }}" class="{{ request()->is('client/accounts/view-profile') ? 'active' : '' }}"><i class="fa fas fa-user-circle"></i>Update Profile</a></li>
                                    <li><a class="dropdown-item" href="{{route('client.logout')}}"><i class="fas fa-sign-out-alt fa-lg"></i> Logout</a>
                                </ul>
                            </div>
                            <!--/sticky -->
                    </aside>

                    <div class="col-lg-9">
                         @yield('content')
                    </div>
                </div>
            </div>
        </main>

        @include('website::include.footer')
    
    </div>
   
    @include('website::include.signin-modal')
    
    
    <div id="toTop"></div><!-- Back to top button -->
    
    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('website-theme/js/common_scripts.js') }}"></script>
    <script src="{{ asset('website-theme/js/functions.js') }}"></script>
    <script src="{{ asset('website-theme/assets/validate.js') }}"></script>

    

   

    @yield('website_js')

</body>
</html>