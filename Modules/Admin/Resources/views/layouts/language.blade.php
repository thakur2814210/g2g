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
    <style type="text/css">
       
        /***    left menu ****/

        /***********************  TOP Bar ********************/
        .sidebar-active{background-color:#dc3545 !important; color: #fff !important;}
        .sidebar{  background-color:#000; }
        .bg-defoult{background-color:#fff;}
        .sidebar ul{ list-style:none; margin:0px; padding:0px; }
        .sidebar li a,.sidebar li a.collapsed.active{ display:block; padding:12px; color:#666;border-left:0px solid #dedede;  text-decoration:none}
        .sidebar li a.active{background-color:#fff;border-left:5px solid #dedede; }
        .sidebar li a:hover{background-color:#dc3545 !important; color: #fff !important; }
        .sidebar li a i{ padding-right:5px;}
        .sidebar ul li .sub-menu li a{ position:relative}
        .sidebar ul li .sub-menu li a:before{
            font-family: FontAwesome;
            content: "\f105";
            display: inline-block;
            padding-left: 0px;
            padding-right: 10px;
            vertical-align: middle;
        }
        .sidebar ul li .sub-menu li a:hover:after {
            content: "";
            position: absolute;
            left: -5px;
            top: 0;
            width: 5px;
            background-color: #111;
            height: 100%;
        }
        .sidebar ul li .sub-menu li a:hover{ background-color:#222; padding-left:20px;}
        .sub-menu{ border-left:5px solid #dedede;}
            .sidebar li a .nav-label,.sidebar li a .nav-label+span{ }
            

            .sidebar.fliph li a .nav-label,.sidebar.fliph li a .nav-label+span{ display:none;}
            .sidebar.fliph {
            width: 42px;transition: all 0.5s  ease-in-out;
           
        }
            
        .sidebar.fliph li{ position:relative}
        .sidebar.fliph .sub-menu {
            position: absolute;
            left: 39px;
            top: 0;
            background-color: #fff;
            width: 150px;
            z-index: 100;
        }
            

        .user-panel {
            clear: left;
            display: block;
            float: left;
        }
        .user-panel>.image>img {
            width: 100%;
            max-width: 45px;
            height: auto;
        }
        .user-panel>.info,  .user-panel>.info>a {
            color: #222;
        }
        .user-panel>.info>p {
            font-weight: 600;
            margin-bottom: 9px;
        }
        .user-panel {
            clear: left;
            display: block;
            float: left;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px 15px;
            border-bottom: 1px solid;
        }
        .user-panel>.info {
            padding: 5px 5px 5px 15px;
            line-height: 1;
            position: absolute;
            left: 30%;
        }

        .fliph .user-panel{ display: none; }


        .sidebar-divider{
            border-bottom: 1px solid #ddd;
        }

        .box_general{
            padding: 10px 0px 0px 10px !important;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
     <style>
        a.status-1{
            font-weight: bold;
        }
        .main-menu > ul > li span > a {
            font-size: 14px;
        }
    </style>

    @yield('css')

</head>

<body class="@if(\Config::get('app.locale') == 'ar') rtl @endif ">
        
    <div id="page">
        
        @include('website::include.home-header')

        <main>
            <div class="" style="padding: 10px;">
                <div class="row margin_60_35">
                    <aside class="col-3">

                        <div class="sidebar left ">

                            <div class="user-panel bg-danger">
                              <div class="pull-left image">
                                <img src="http://via.placeholder.com/160x160" class="rounded-circle" alt="User Image">
                              </div>
                              <div class="pull-left info p-2 text-white">
                                <p>{{ Auth::user()->username }}</p>
                                <a href="#" class="text-white"><i class="fa fa-circle text-success"></i> Online</a>
                              </div>
                            </div>
                            
                            <ul class="list-sidebar bg-defoult">

                                <li class="sidebar-divider"> 
                                    <a href="{{ route('superadmin.dashboard') }}" data-toggle="collapse" data-target="#dashboard" class="collapsed active" > 
                                        <i class="fa fa-th-large"></i> 
                                        <span class="nav-label"> Manage Website </span> 
                                        <span class="fa fa-chevron-left pull-right"></span> 
                                    </a>
                                  <ul class="sub-menu collapse" id="dashboard">
                                    <li class="active"><a href="#">AutoShop Homepage</a></li>
                                    <li><a href="{{ route('admin.dashboard')}}" >AutoShop Admin Panel</a></li>
                                    <li><a href="{{ route('page.homepage')}}">Website Homepage</a></li>
                                  </ul>
                                </li>
                                 <li style="background: #ddd;padding: 1px;"></li>

                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/dashboard') ? 'sidebar-active' : '' }}" href="{{ route('superadmin.dashboard') }}" ><i class="fa fa-dashboard"></i> <span class="nav-label">Manage Dashboard</span> </a></li>

                                <li style="background: #ddd;" class="p-2 text-center text-danger"> <label> Manage Customers & Garages</label></li>
                                
                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/clients/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#customers" class="collapsed active" > <i class="fa fa-users"></i> <span class="nav-label">Manage Customers</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu {{ Request::is('administrator/clients/*') ? 'show' : 'collapse' }}" id="customers">
                                      <li class="active"><a href="{{ route('superadmin.clients.active-list')}}">Active Customers</a></li>
                                      <li><a href="{{ route('superadmin.clients.pending-list')}}">Pending Customers</a></li>
                                      <li><a href="{{ route('superadmin.clients.delete-list')}}">Delete Customers</a></li>
                                     
                                    </ul>
                                </li>

                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/garages/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#garages" class="collapsed active" > <i class="fa fa-building"></i> <span class="nav-label">Manage Garages</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu {{ Request::is('administrator/garages/*') ? 'show' : 'collapse' }}" id="garages">
                                      <li class="active"><a href="{{ route('superadmin.garages.active')}}">Active Garages</a></li>
                                      <li><a href="{{ route('superadmin.garages.pending')}}">Pending Garages</a></li>
                                      <li><a href="{{ route('superadmin.garages.delete')}}">Delete Garages</a></li>
                                     
                                    </ul>
                                </li>

                                <li style="background: #ddd;" class="p-2 text-center text-danger"> <label>Manage Subscription, Requests & Transaction</label></li>

                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/subscriptions/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#package-subscription" class="collapsed active" > <i class="fa fa-shopping-cart"></i> <span class="nav-label">Package Subscription</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu {{ Request::is('administrator/subscriptions/*') ? 'show' : 'collapse' }}" id="package-subscription">
                                      <li class="active"><a href="{{ route('superadmin.subscriptions.clients.list') }}"> Customers</a></li>
                                      <li><a href="{{ route('superadmin.subscriptions.garages.list') }}"> Garages</a></li>
                                     
                                    </ul>
                                </li>

                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/service-request/*') ? 'sidebar-active' : '' }}" href="{{ route('superadmin.service-requests') }}" ><i class="fa fa-car"></i> <span class="nav-label"> Service Requests</span> </a></li>
                                
                                
                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/transactions/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#transactions" class="collapsed active" > <i class="fa fa-money"></i> <span class="nav-label">All Transactions</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu {{ Request::is('administrator/transactions/*') ? 'show' : 'collapse' }}" id="transactions">
                                        <li class="sidebar-divider"> <a  href="#" data-toggle="collapse" data-target="#c_transactions" class="collapsed active" > <span class="nav-label">Customers Transaction</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                            <ul class="sub-menu {{ Request::is('administrator/transactions/customers/*') ? 'show' : 'collapse' }}" id="c_transactions">
                                              <li class="active"><a href="{{ route('superadmin.transactions.customers_package_subscription') }}"> Package Subscription</a></li>
                                              <li><a href="{{ route('superadmin.transactions.customers_service_request') }}"> Service Requests</a></li>
                                             
                                            </ul>
                                        </li>
                                      <li><a href="{{ route('superadmin.transactions.garages_package_subscription') }}"> Garages Transaction</a></li>
                                     
                                    </ul>
                                </li>
    

                                <li style="background: #ddd;" class="p-2 text-center text-danger"> <label>Manage Vehicle, Section & Package</label></li>

                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/settings/vehicle*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#manage-vehicle" class="collapsed active" > <i class="fa fa-car"></i> <span class="nav-label">Manage Vehicle</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu {{ Request::is('administrator/settings/vehicle*') ? 'show' : 'collapse' }}" id="manage-vehicle">
                                      <li class="active"><a href="{{ route('superadmin.settings.vehicle-make')}}">Vehicle Make</a></li>
                                      <li><a href="{{ route('superadmin.settings.vehicle-modal')}}">Vehicle Model</a></li>
                                     
                                    </ul>
                                </li>

                                 <li class="sidebar-divider"> <a class="{{ Request::is('administrator/category/*') || Request::is('administrator/subcategory/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#sections" class="collapsed active" > <i class="fa fa-diamond"></i> <span class="nav-label">Manage Sections</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu {{ Request::is('administrator/subcategory/*') || Request::is('administrator/subcategory/*') ? 'show' : 'collapse' }}" id="sections">
                                      <li class="active"><a href="{{ route('superadmin.category.list')}}">Section Category</a></li>
                                      <li><a href="{{ route('superadmin.subcategory.list')}}">Section Sub-Category </a></li>
                                     
                                    </ul>
                                </li>

                                 <li class="sidebar-divider"> <a class="{{ Request::is('administrator/service-package/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#packages" class="collapsed active" > <i class="fa fa-tags"></i> <span class="nav-label">Manage Packages</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu {{ Request::is('administrator/service-package/*') ? 'show' : 'collapse' }}" id="packages">
                                      <li class="active"><a href="{{ route('superadmin.service-package')}}">List</a></li>
                                      <li><a href="{{ route('superadmin.service-package.features')}}">Feature</a></li>
                                     
                                    </ul>
                                </li>
                               

                                
                                <li style="background: #ddd;" class="p-2 text-center text-danger"> <label>Manage Profiles & Web Settings</label></li>
                               
                                
                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/pages/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#ManagePages" class="collapsed active" ><i class="fa fa-file-o"></i> <span class="nav-label">Manage Pages</span><span class="fa fa-chevron-left pull-right"></span></a>
                                  <ul  class="sub-menu {{ Request::is('administrator/pages/*') ? 'show' : 'collapse' }}" id="ManagePages" >
                                    <li><a href="{{ route('superadmin.pages.aboutus')}}"> About Us</a></li>
                                    <li><a href="{{ route('superadmin.pages.contactus')}}"> Contact Us</a></li>
                                    <li><a href="{{ route('superadmin.pages.termsconditions')}}"> Terms and conditions</a></li>
                                    <li><a href="{{ route('superadmin.pages.privacy-policy')}}"> Privacy Policy</a></li>
                                    <li><a href="{{ route('superadmin.pages.faq')}}"> FAQ</a></li>
                                    <li><a href="{{ route('superadmin.pages.testimonial')}}"> Testimonials</a></li>
                                    <li><a href="{{ route('superadmin.pages.seo')}}"> SEO Manager</a></li>
                                  </ul>
                                </li>

                               
                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/general-settings') || Request::is('administrator/settings/commissions') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#general-settings" class="collapsed active" ><i class="fa fa-cogs"></i> <span class="nav-label">General Settings</span><span class="fa fa-chevron-left pull-right"></span></a>
                                    <ul  class="sub-menu {{ Request::is('administrator/general-settings') || Request::is('administrator/settings/commissions') ? 'show' : 'collapse' }}" id="general-settings" >
                                      <li><a href="{{ route('superadmin.general-settings')}}"> Web Setting</a></li>
                                      <li><a href="{{ route('superadmin.settings.commissions')}}"> Commissions</a></li>
                                    </ul>
                                </li>

                                 <li class="sidebar-divider"> <a class="{{ Request::is('administrator/settings/langauges') || Request::is('administrator/translations') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#langauges" class="collapsed active" ><i class="fa fa-cogs"></i> <span class="nav-label">Manage Langauges</span><span class="fa fa-chevron-left pull-right"></span></a>
                                    <ul  class="sub-menu {{ Request::is('administrator/settings/langauges') || Request::is('administrator/translations') ? 'show' : 'collapse' }}" id="langauges" >
                                      <li><a href="{{ route('superadmin.settings.languages')}}"> Langauges List</a></li>
                                       <li><a  href="<?php echo action('\Barryvdh\TranslationManager\Controller@getIndex') ?>"> Translation Manager</a></li>
                                    </ul>
                                </li>

                                

                                <li class="sidebar-divider"> <a class="{{ Request::is('administrator/profile/*') ? 'sidebar-active' : '' }}" href="#" data-toggle="collapse" data-target="#profile" class="collapsed active" ><i class="fa fa-user-circle"></i> <span class="nav-label">Manage Profile</span><span class="fa fa-chevron-left pull-right"></span></a>
                                    <ul  class="sub-menu {{ Request::is('administrator/profile/*') ? 'show' : 'collapse' }}" id="profile" >
                                      <li><a href="{{ route('superadmin.view-profile')}}"> View Profile</a></li>
                                      <li><a href="{{ route('superadmin.change-password')}}"> Change Password</a></li>
                                    </ul>
                                </li>

                                 <li class="nav-item"  data-toggle="tooltip" data-placement="right" title="Dashboard">
                                  <a class="nav-link" data-toggle="modal" data-target="#logoutModal" data-backdrop="false">
                                     <i class="fa fa-fw fa-sign-out"></i>
                                    <span class="nav-link-text">Logout</span>
                                  </a>
                                </li>
                              
                            </ul>
                        </div>

                            
                    </aside>

                    <div class="col-9">
                        <!-- Breadcrumbs-->
                        @yield('breadcrumb')
                        
                        @yield('content')
                    </div>
                     @include('admin::modals.logout')
                </div>

            </div>

        @include('website::include.footer')
        </main>
       
    
    </div>
   
   
    
    
    <div id="toTop"></div><!-- Back to top button -->
    
    <!-- COMMON SCRIPTS -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script>//https://github.com/rails/jquery-ujs/blob/master/src/rails.js
        (function(e,t){if(e.rails!==t){e.error("jquery-ujs has already been loaded!")}var n;var r=e(document);e.rails=n={linkClickSelector:"a[data-confirm], a[data-method], a[data-remote], a[data-disable-with]",buttonClickSelector:"button[data-remote], button[data-confirm]",inputChangeSelector:"select[data-remote], input[data-remote], textarea[data-remote]",formSubmitSelector:"form",formInputClickSelector:"form input[type=submit], form input[type=image], form button[type=submit], form button:not([type])",disableSelector:"input[data-disable-with], button[data-disable-with], textarea[data-disable-with]",enableSelector:"input[data-disable-with]:disabled, button[data-disable-with]:disabled, textarea[data-disable-with]:disabled",requiredInputSelector:"input[name][required]:not([disabled]),textarea[name][required]:not([disabled])",fileInputSelector:"input[type=file]",linkDisableSelector:"a[data-disable-with]",buttonDisableSelector:"button[data-remote][data-disable-with]",CSRFProtection:function(t){var n=e('meta[name="csrf-token"]').attr("content");if(n)t.setRequestHeader("X-CSRF-Token",n)},refreshCSRFTokens:function(){var t=e("meta[name=csrf-token]").attr("content");var n=e("meta[name=csrf-param]").attr("content");e('form input[name="'+n+'"]').val(t)},fire:function(t,n,r){var i=e.Event(n);t.trigger(i,r);return i.result!==false},confirm:function(e){return confirm(e)},ajax:function(t){return e.ajax(t)},href:function(e){return e.attr("href")},handleRemote:function(r){var i,s,o,u,a,f,l,c;if(n.fire(r,"ajax:before")){u=r.data("cross-domain");a=u===t?null:u;f=r.data("with-credentials")||null;l=r.data("type")||e.ajaxSettings&&e.ajaxSettings.dataType;if(r.is("form")){i=r.attr("method");s=r.attr("action");o=r.serializeArray();var h=r.data("ujs:submit-button");if(h){o.push(h);r.data("ujs:submit-button",null)}}else if(r.is(n.inputChangeSelector)){i=r.data("method");s=r.data("url");o=r.serialize();if(r.data("params"))o=o+"&"+r.data("params")}else if(r.is(n.buttonClickSelector)){i=r.data("method")||"get";s=r.data("url");o=r.serialize();if(r.data("params"))o=o+"&"+r.data("params")}else{i=r.data("method");s=n.href(r);o=r.data("params")||null}c={type:i||"GET",data:o,dataType:l,beforeSend:function(e,i){if(i.dataType===t){e.setRequestHeader("accept","*/*;q=0.5, "+i.accepts.script)}if(n.fire(r,"ajax:beforeSend",[e,i])){r.trigger("ajax:send",e)}else{return false}},success:function(e,t,n){r.trigger("ajax:success",[e,t,n])},complete:function(e,t){r.trigger("ajax:complete",[e,t])},error:function(e,t,n){r.trigger("ajax:error",[e,t,n])},crossDomain:a};if(f){c.xhrFields={withCredentials:f}}if(s){c.url=s}return n.ajax(c)}else{return false}},handleMethod:function(r){var i=n.href(r),s=r.data("method"),o=r.attr("target"),u=e("meta[name=csrf-token]").attr("content"),a=e("meta[name=csrf-param]").attr("content"),f=e('<form method="post" action="'+i+'"></form>'),l='<input name="_method" value="'+s+'" type="hidden" />';if(a!==t&&u!==t){l+='<input name="'+a+'" value="'+u+'" type="hidden" />'}if(o){f.attr("target",o)}f.hide().append(l).appendTo("body");f.submit()},formElements:function(t,n){return t.is("form")?e(t[0].elements).filter(n):t.find(n)},disableFormElements:function(t){n.formElements(t,n.disableSelector).each(function(){n.disableFormElement(e(this))})},disableFormElement:function(e){var t=e.is("button")?"html":"val";e.data("ujs:enable-with",e[t]());e[t](e.data("disable-with"));e.prop("disabled",true)},enableFormElements:function(t){n.formElements(t,n.enableSelector).each(function(){n.enableFormElement(e(this))})},enableFormElement:function(e){var t=e.is("button")?"html":"val";if(e.data("ujs:enable-with"))e[t](e.data("ujs:enable-with"));e.prop("disabled",false)},allowAction:function(e){var t=e.data("confirm"),r=false,i;if(!t){return true}if(n.fire(e,"confirm")){r=n.confirm(t);i=n.fire(e,"confirm:complete",[r])}return r&&i},blankInputs:function(t,n,r){var i=e(),s,o,u=n||"input,textarea",a=t.find(u);a.each(function(){s=e(this);o=s.is("input[type=checkbox],input[type=radio]")?s.is(":checked"):s.val();if(!o===!r){if(s.is("input[type=radio]")&&a.filter('input[type=radio]:checked[name="'+s.attr("name")+'"]').length){return true}i=i.add(s)}});return i.length?i:false},nonBlankInputs:function(e,t){return n.blankInputs(e,t,true)},stopEverything:function(t){e(t.target).trigger("ujs:everythingStopped");t.stopImmediatePropagation();return false},disableElement:function(e){e.data("ujs:enable-with",e.html());e.html(e.data("disable-with"));e.bind("click.railsDisable",function(e){return n.stopEverything(e)})},enableElement:function(e){if(e.data("ujs:enable-with")!==t){e.html(e.data("ujs:enable-with"));e.removeData("ujs:enable-with")}e.unbind("click.railsDisable")}};if(n.fire(r,"rails:attachBindings")){e.ajaxPrefilter(function(e,t,r){if(!e.crossDomain){n.CSRFProtection(r)}});r.delegate(n.linkDisableSelector,"ajax:complete",function(){n.enableElement(e(this))});r.delegate(n.buttonDisableSelector,"ajax:complete",function(){n.enableFormElement(e(this))});r.delegate(n.linkClickSelector,"click.rails",function(r){var i=e(this),s=i.data("method"),o=i.data("params"),u=r.metaKey||r.ctrlKey;if(!n.allowAction(i))return n.stopEverything(r);if(!u&&i.is(n.linkDisableSelector))n.disableElement(i);if(i.data("remote")!==t){if(u&&(!s||s==="GET")&&!o){return true}var a=n.handleRemote(i);if(a===false){n.enableElement(i)}else{a.error(function(){n.enableElement(i)})}return false}else if(i.data("method")){n.handleMethod(i);return false}});r.delegate(n.buttonClickSelector,"click.rails",function(t){var r=e(this);if(!n.allowAction(r))return n.stopEverything(t);if(r.is(n.buttonDisableSelector))n.disableFormElement(r);var i=n.handleRemote(r);if(i===false){n.enableFormElement(r)}else{i.error(function(){n.enableFormElement(r)})}return false});r.delegate(n.inputChangeSelector,"change.rails",function(t){var r=e(this);if(!n.allowAction(r))return n.stopEverything(t);n.handleRemote(r);return false});r.delegate(n.formSubmitSelector,"submit.rails",function(r){var i=e(this),s=i.data("remote")!==t,o,u;if(!n.allowAction(i))return n.stopEverything(r);if(i.attr("novalidate")==t){o=n.blankInputs(i,n.requiredInputSelector);if(o&&n.fire(i,"ajax:aborted:required",[o])){return n.stopEverything(r)}}if(s){u=n.nonBlankInputs(i,n.fileInputSelector);if(u){setTimeout(function(){n.disableFormElements(i)},13);var a=n.fire(i,"ajax:aborted:file",[u]);if(!a){setTimeout(function(){n.enableFormElements(i)},13)}return a}n.handleRemote(i);return false}else{setTimeout(function(){n.disableFormElements(i)},13)}});r.delegate(n.formInputClickSelector,"click.rails",function(t){var r=e(this);if(!n.allowAction(r))return n.stopEverything(t);var i=r.attr("name"),s=i?{name:i,value:r.val()}:null;r.closest("form").data("ujs:submit-button",s)});r.delegate(n.formSubmitSelector,"ajax:send.rails",function(t){if(this==t.target)n.disableFormElements(e(this))});r.delegate(n.formSubmitSelector,"ajax:complete.rails",function(t){if(this==t.target)n.enableFormElements(e(this))});e(function(){n.refreshCSRFTokens()})}})(jQuery)
    </script>
   
    <script>
        jQuery(document).ready(function($){

            $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    console.log('beforesend');
                    settings.data += "&_token=<?php echo csrf_token() ?>";
                }
            });

            $('.editable').editable().on('hidden', function(e, reason){
                var locale = $(this).data('locale');
                if(reason === 'save'){
                    $(this).removeClass('status-0').addClass('status-1');
                }
                if(reason === 'save' || reason === 'nochange') {
                    var $next = $(this).closest('tr').next().find('.editable.locale-'+locale);
                    setTimeout(function() {
                        $next.editable('show');
                    }, 300);
                }
            });

            $('.group-select').on('change', function(){
                var group = $(this).val();
                if (group) {
                    window.location.href = '<?php echo action('\Barryvdh\TranslationManager\Controller@getView') ?>/'+$(this).val();
                } else {
                    window.location.href = '<?php echo action('\Barryvdh\TranslationManager\Controller@getIndex') ?>';
                }
            });

            $("a.delete-key").click(function(event){
              event.preventDefault();
              var row = $(this).closest('tr');
              var url = $(this).attr('href');
              var id = row.attr('id');
              $.post( url, {id: id}, function(){
                  row.remove();
              } );
            });

            $('.form-import').on('ajax:success', function (e, data) {
                $('div.success-import strong.counter').text(data.counter);
                $('div.success-import').slideDown();
                window.location.reload();
            });

            $('.form-find').on('ajax:success', function (e, data) {
                $('div.success-find strong.counter').text(data.counter);
                $('div.success-find').slideDown();
                window.location.reload();
            });

            $('.form-publish').on('ajax:success', function (e, data) {
                $('div.success-publish').slideDown();
            });

            $('.form-publish-all').on('ajax:success', function (e, data) {
                $('div.success-publish-all').slideDown();
            });
            $('.enable-auto-translate-group').click(function (event) {
                event.preventDefault();
                $('.autotranslate-block-group').removeClass('hidden');
                $('.enable-auto-translate-group').addClass('hidden');
            })
            $('#base-locale').change(function (event) {
                console.log($(this).val());
                $.cookie('base_locale', $(this).val());
            })
            if (typeof $.cookie('base_locale') !== 'undefined') {
                $('#base-locale').val($.cookie('base_locale'));
            }

        })
    </script>
    

   

    @yield('js')

</body>
</html>