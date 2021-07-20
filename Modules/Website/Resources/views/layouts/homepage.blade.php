<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G2G | Homepage.</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

     @yield('website_css_pre')

    <!-- BASE CSS  <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css" media="screen"> -->

   <link rel="stylesheet" href="{{ asset('website-theme/css/bootstrap.min.css') }}">
    @if(\Config::get('app.locale') == 'ar')
         <link rel="stylesheet" href="{{ asset('website-theme/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css') }}">
    @endif
   
   
    <link rel="stylesheet" href="{{ asset('website-theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/color-red.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/custom.css') }}">

     @yield('website_css')

</head>

<body>
    
    @php
    /*
        add rtl to body class when arabic language implement...
        remove when Englicj locale is implemented...

     */
      //echo \Config::get('app.locale') . ' chekc homepage';
    @endphp
    <div id="page"  class=" @if(\Config::get('app.locale') == 'ar') rtl @endif ">
        
        @include('website::include.home-header')

        @yield('content')

        @include('website::include.footer')
    
    </div>
   
    @include('website::include.signin-modal')
    @include('website::include.errorin-modal')
    
    
    <div id="toTop"></div><!-- Back to top button -->
    
    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('website-theme/js/common_scripts.js') }}"></script>
    <script src="{{ asset('website-theme/js/functions.js') }}"></script>
    <script src="{{ asset('website-theme/assets/validate.js') }}"></script>
    

    @yield('website_js')

</body>
</html>