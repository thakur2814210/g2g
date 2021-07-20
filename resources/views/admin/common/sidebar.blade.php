<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">




      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">{{ trans('labels.common_settings') }}</li>

        <li class="treeview {{ Request::is('/') ? 'active' : '' }}">
          <a href="{{ URL::to('/')}}" target="_blank">
            <i class="fa fa-dashboard"></i> <span>{{ trans('labels.view_website') }}</span>
          </a>
        </li>

        <li class="treeview {{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/dashboard/this_month')}}">
            <i class="fa fa-dashboard"></i> <span>{{ trans('labels.header_dashboard') }}</span>
          </a>
        </li>

         @if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->customers_view == 1)
          <li class="treeview {{ Request::is('admin/customers/display') ? 'active' : '' }}  {{ Request::is('admin/customers/add') ? 'active' : '' }}  {{ Request::is('admin/customers/edit/*') ? 'active' : '' }} {{ Request::is('admin/customers/address/display/*') ? 'active' : '' }} {{ Request::is('admin/customers/filter') ? 'active' : '' }} ">
            <a href="{{ URL::to('admin/customers/display')}}">
              <i class="fa fa-users" aria-hidden="true"></i> <span>{{ trans('labels.link_customers') }}</span>
            </a>
          </li>
        @endif

        @if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manage_admins_view == 1)

         <li class="treeview {{ Request::is('administrator/garage/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>Garages/Vendors</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('administrator/garage/active/list') ? 'active' : '' }} {{ Request::is('admin/updatevendor') ? 'active' : '' }} {{ Request::is('admin/editvendor/*') ? 'active' : '' }}">
              <a href="{{ route('superadmin.garages.active')}}">
                <i class="fa fa-circle-o"></i> Active
              </a>
            </li>

            <li class="{{ Request::is('administrator/garage/pending/list') ? 'active' : '' }} ">
              <a href="{{ route('superadmin.garages.pending')}}">
                <i class="fa fa-circle-o"></i> Pending
              </a>
            </li>

            <li class="{{ Request::is('administrator/garage/delete/list') ? 'active' : '' }} ">
              <a href="{{ route('superadmin.garages.delete')}}">
                <i class="fa fa-circle-o"></i> Delete
              </a>
            </li>
         
            <!--li class="{{ Request::is('admin/addvendors') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/addvendors')}}">
                <i class="fa fa-circle-o"></i> {{ trans('labels.Add Vendors') }}
              </a>
            </li-->
          </ul>
        </li>
      @endif

        

         <!--li class="treeview {{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }} {{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadminType') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span> {{ trans('labels.Manage Vendors') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('admin/vendors/active') ? 'active' : '' }} {{ Request::is('admin/updatevendor') ? 'active' : '' }} {{ Request::is('admin/editvendor/*') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/vendors/active')}}">
                <i class="fa fa-circle-o"></i> {{ trans('labels.Active Vendors') }}
              </a>
            </li>

            <li class="{{ Request::is('admin/vendors/pending') ? 'active' : '' }} ">
              <a href="{{ URL::to('admin/vendors/pending')}}">
                <i class="fa fa-circle-o"></i> {{ trans('labels.Pending Vendors') }}
              </a>
            </li>

            <li class="{{ Request::is('admin/vendors/inactive') ? 'active' : '' }} ">
              <a href="{{ URL::to('admin/vendors/inactive')}}">
                <i class="fa fa-circle-o"></i> {{ trans('labels.Inactive Vendors') }}
              </a>
            </li>
         
            <li class="{{ Request::is('admin/addvendors') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/addvendors')}}">
                <i class="fa fa-circle-o"></i> {{ trans('labels.Add Vendors') }}
              </a>
            </l>
          </ul>
        </li-->
      


      
         
         
           

        <!-- G2G WEBSITE -->
        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">{{ trans('labels.manage_g2g') }}</li>
       

      @if ( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->language_view == 1)
        
       <!-- Vehicles List -->
        <li class="treeview {{ Request::is('administrator/vehicles/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-car"></i> <span>{{ trans('labels.manage_vehicle') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview {{ Request::is('administrator/vehicles/vehicle-ma*') ? 'active' : '' }} ">
                <a href="{{url('administrator/vehicles/vehicle-make')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.vehicle_make') }} </span>
                </a>
            </li>

            <li class="treeview {{ Request::is('administrator/vehicles/vehicle-mo*') ? 'active' : '' }}">
                <a href="{{url('administrator/vehicles/vehicle-modal')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.vehicle_model') }} </span>
                </a>
            </li>
          </ul>
        </li>

        <!-- Section List -->
        <li class="treeview {{ Request::is('administrator/sections/*') ? 'active' : '' }}  {{ Request::is('administrator/subsections/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-list"></i> <span>{{ trans('labels.Manage Sections') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview {{ Request::is('administrator/sections/list') ? 'active' : '' }} ">
                <a href="{{url('administrator/sections/list')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.Sections List') }} </span>
                </a>
            </li>

            <li class="treeview {{ Request::is('administrator/subsections/list') ? 'active' : '' }}">
                <a href="{{url('administrator/subsections/list')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.Sub Sections List') }} </span>
                </a>
            </li>
          </ul>
        </li>


        <li class="treeview {{ Request::is('administrator/service-package/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-tags"></i> <span>{{ trans('labels.Manage Package') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview {{ Request::is('administrator/service-package/*') ? 'active' : '' }} ">
                <a href="{{ route('superadmin.service-package')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.Package List') }} </span>
                </a>
            </li>

            <li class="treeview {{ Request::is('administrator/service-package/*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.service-package.features')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.Package Feature') }} </span>
                </a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ Request::is('administrator/service-request/*') ? 'active' : '' }}">
          <a href="{{ route('superadmin.service-requests') }}">
            <i class="fa fa-dashboard"></i> <span>{{ trans('labels.manage_servive_request') }}</span>
          </a>
        </li>

        <li class="treeview {{ Request::is('administrator/subscriptions/customers/list') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/garages/list') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/customers/settings/*') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/garages/settings/*') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/garages/logs/*') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/customers/logs/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-tags"></i> <span>Package Subscription</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview {{ Request::is('administrator/subscriptions/customers/list') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/customers/settings/*') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/customers/logs/*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.subscriptions.clients.list') }}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>By Customers</span>
                </a>
            </li>

            <li class="treeview {{ Request::is('administrator/subscriptions/garages/list') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/garages/settings/*') ? 'active' : '' }} {{ Request::is('administrator/subscriptions/garages/logs/*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.subscriptions.garages.list') }}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>By Garages</span>
                </a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ Request::is('administrator/transactions/garages/package-subscription') ? 'active' : '' }} {{ Request::is('administrator/transactions/customers/package-subscription') ? 'active' : '' }} {{ Request::is('administrator/transactions/customers/service-request') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-tags"></i> <span>G2G Web Transactions</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">

            <li class="treeview {{ Request::is('administrator/transactions/customers/*') ? 'active' : '' }}">
              <a href="#">
                <i class="fa fa-circle-o"></i> <span>Customers Transactions</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview {{ Request::is('administrator/transactions/customers/package-subscription') ? 'active' : '' }} ">
                    <a href="{{ route('superadmin.transactions.customers_package_subscription') }}">
                        <i class="fa fa-circle-o" aria-hidden="true"></i> <span>By Package Subscription</span>
                    </a>
                </li>

                <li class="treeview {{ Request::is('administrator/transactions/customers/service-request') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.transactions.customers_service_request') }}">
                        <i class="fa fa-circle-o" aria-hidden="true"></i> <span>By Service Requests</span>
                    </a>
                </li>
              </ul>
            </li>

            <li class="treeview {{ Request::is('administrator/transactions/garages/package-subscription') ? 'active' : '' }}">
                <a href="{{ route('superadmin.transactions.garages_package_subscription') }}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Garages Transactions</span>
                </a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ Request::is('administrator/pages/faq/list') ? 'active' : '' }} {{ Request::is('administrator/pages/faq/add') ? 'active' : '' }} {{ Request::is('administrator/pages/faq/edit/*') ? 'active' : '' }} {{ Request::is('administrator/pages/about-us') ? 'active' : '' }} {{ Request::is('administrator/pages/terms-conditions') ? 'active' : '' }} {{ Request::is('administrator/pages/privacy-policy') ? 'active' : '' }} {{ Request::is('administrator/pages/contact-us') ? 'active' : '' }} {{ Request::is('administrator/pages/testimonial') ? 'active' : '' }}">


          <a href="#">
            <i class="fa fa-tags"></i> <span>Manage Pages</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">

             <li class="treeview {{ Request::is('administrator/pages/contact-us') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pages.contactus')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Contact Us</span>
                </a>
            </li>

             <li class="treeview {{ Request::is('administrator/pages/about-us') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pages.aboutus')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>About Us</span>
                </a>
            </li>

             <li class="treeview {{ Request::is('administrator/pages/terms-conditions') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pages.termsconditions')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Terms and conditions</span>
                </a>
            </li>

             <li class="treeview {{ Request::is('administrator/pages/privacy-policy') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pages.privacy-policy')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Privacy Policy</span>
                </a>
            </li>

             <li class="treeview {{ Request::is('administrator/pages/testimonial/list') ? 'active' : '' }} {{ Request::is('administrator/pages/testimonial/add') ? 'active' : '' }} {{ Request::is('administrator/pages/testimonial/edit/*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pages.testimonial')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Testimonials</span>
                </a>
            </li>
           
            <li class="treeview {{ Request::is('administrator/pages/faq/list') ? 'active' : '' }} {{ Request::is('administrator/pages/faq/add') ? 'active' : '' }} {{ Request::is('administrator/pages/faq/edit/*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pages.faq')}}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> <span>FAQ</span>
                </a>
            </li>
          </ul>
        </li>

         <li class="treeview {{ Request::is('administrator/settings/commissions') ? 'active' : '' }}">
          <a href="{{ route('superadmin.settings.commissions')}}">
            <i class="fa fa-money"></i> <span> Set Commissions</span>
          </a>
        </li>



      @endif



        <br/>

        
        <!-- G2G Auto Shop -->

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">{{ trans('labels.manage_autoshop') }}</li>
       

      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->language_view == 1){
      ?>
      <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span>{{ trans('labels.media') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }} ">
              <a href="{{url('admin/media/add')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.media') }} </span>
              </a>
          </li>

          <li class="treeview {{ Request::is('admin/media/display') ? 'active' : '' }} {{ Request::is('admin/addimages') ? 'active' : '' }} {{ Request::is('admin/uploadimage/*') ? 'active' : '' }} ">
              <a href="{{url('admin/media/display')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.Media Setings') }} </span>
              </a>
          </li>
        </ul>
      </li>

      <?php } ?>
      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->language_view == 1){
      ?>

        <li class="treeview {{ Request::is('admin/languages/display') ? 'active' : '' }} {{ Request::is('admin/languages/add') ? 'active' : '' }} {{ Request::is('admin/languages/edit/*') ? 'active' : '' }} ">
          <a href="{{ URL::to('admin/languages/display')}}">
            <i class="fa fa-language" aria-hidden="true"></i> <span> {{ trans('labels.languages') }} </span>
          </a>
        </li>

      <?php } ?>
      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>

      <li class="treeview {{ Request::is('admin/currencies/display') ? 'active' : '' }} {{ Request::is('admin/currencies/add') ? 'active' : '' }} {{ Request::is('admin/currencies/edit/*') ? 'active' : '' }} {{ Request::is('admin/currencies/filter') ? 'active' : '' }}">
        <a href="{{ URL::to('admin/currencies/display')}}">
          <i class="fa fa-circle-o"></i> {{ trans('labels.currency') }}
        </a>
      </li>
      <?php } ?>    
     

   
      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1 or $result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1 ){
      ?>
        <li class="treeview {{ Request::is('admin/reviews/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/add') ? 'active' : '' }} {{ Request::is('admin/manufacturers/edit/*') ? 'active' : '' }} {{ Request::is('admin/units') ? 'active' : '' }} {{ Request::is('admin/addunit') ? 'active' : '' }} {{ Request::is('admin/editunit/*') ? 'active' : '' }} {{ Request::is('admin/products/display') ? 'active' : '' }} {{ Request::is('admin/products/add') ? 'active' : '' }} {{ Request::is('admin/products/edit/*') ? 'active' : '' }} {{ Request::is('admin/editattributes/*') ? 'active' : '' }} {{ Request::is('admin/products/attributes/display') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/add') ? 'active' : '' }} {{ Request::is('admin/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('admin/addinventory/*') ? 'active' : '' }} {{ Request::is('admin/addproductimages/*') ? 'active' : '' }} {{ Request::is('admin/categories/display') ? 'active' : '' }} {{ Request::is('admin/categories/add') ? 'active' : '' }} {{ Request::is('admin/categories/edit/*') ? 'active' : '' }} {{ Request::is('admin/categories/filter') ? 'active' : '' }} {{ Request::is('admin/products/inventory/display') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-database"></i> <span>{{ trans('labels.Catalog') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manufacturer_view == 1)
              <li class="{{ Request::is('admin/manufacturers/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/add') ? 'active' : '' }} {{ Request::is('admin/manufacturers/edit/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/manufacturers/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_manufacturer') }}</a></li>
            @endif
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1)
              <li class="{{ Request::is('admin/categories/display') ? 'active' : '' }} {{ Request::is('admin/categories/add') ? 'active' : '' }} {{ Request::is('admin/categories/edit/*') ? 'active' : '' }} {{ Request::is('admin/categories/filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/categories/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_main_categories') }}</a></li>
               <li class="{{ Request::is('admin/products/attributes/display') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/add') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/*') ? 'active' : '' }}" ><a href="{{ URL::to('admin/products/attributes/display' )}}"><i class="fa fa-circle-o"></i> {{ trans('labels.products_attributes') }}</a></li>
                 <li class="{{ Request::is('admin/units') ? 'active' : '' }} {{ Request::is('admin/addunit') ? 'active' : '' }} {{ Request::is('admin/editunit/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/units')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_units') }}</a></li>
            @endif

            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1)
             
            
              <li class="{{ Request::is('admin/products/display') ? 'active' : '' }} {{ Request::is('admin/products/add') ? 'active' : '' }} {{ Request::is('admin/products/edit/*') ? 'active' : '' }} {{ Request::is('admin/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('admin/addinventory/*') ? 'active' : '' }} {{ Request::is('admin/addproductimages/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/products/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_all_products') }}</a></li>
              <li class="{{ Request::is('admin/products/inventory/display') ? 'active' : '' }}"><a href="{{ URL::to('admin/products/inventory/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.inventory') }}</a></li>
            @endif
            <?php
              $status_check = DB::table('reviews')->where('reviews_read',0)->first();
              if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->reviews_view == 1){
            ?>
              <li class="{{ Request::is('admin/reviews/display') ? 'active' : '' }}">
                <a href="{{ URL::to('admin/reviews/display')}}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span>{{ trans('labels.reviews') }}</span>@if($result['commonContent']['new_reviews']>0)<span class="label label-success pull-right">{{$result['commonContent']['new_reviews']}} {{ trans('labels.new') }}</span>@endif
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->orders_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/orderstatus') ? 'active' : '' }} {{ Request::is('admin/addorderstatus') ? 'active' : '' }} {{ Request::is('admin/editorderstatus/*') ? 'active' : '' }} {{ Request::is('admin/orders/display') ? 'active' : '' }} {{ Request::is('admin/orders/vieworder/*') ? 'active' : '' }}">
          <a href="#" ><i class="fa fa-list-ul" aria-hidden="true"></i> <span> {{ trans('labels.link_orders') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

          @if(Auth()->user()->role_id != 3)
            <li class="{{ Request::is('admin/orderstatus') ? 'active' : '' }} {{ Request::is('admin/addorderstatus') ? 'active' : '' }} {{ Request::is('admin/editorderstatus/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/orderstatus')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_order_status') }}</a></li>
          @endif

          <li class="{{ Request::is('admin/orders/display') ? 'active' : '' }} {{ Request::is('admin/orders/vieworder/*') ? 'active' : '' }}">
            <a href="{{ URL::to('admin/orders/display')}}" >
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.link_orders') }}</span>
            </a>
          </li>
          </ul>
        </li>
      <?php } ?>

       <li class="treeview  
           {{ Request::is('admin/transactions/withdrawMethod') ? 'active' : '' }} 
           {{ Request::is('admin/transactions/withdrawLog') ? 'active' : '' }}
           {{ Request::is('admin/transactions/refundedLog') ? 'active' : '' }}
           {{ Request::is('admin/transactions/successLog') ? 'active' : '' }}
           {{ Request::is('admin/transactions/pendingLog') ? 'active' : '' }}
           {{ Request::is('admin/vendor/transactions/withdrawMoney') ? 'active' : '' }}
           ">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>Vendors Transactions</span> <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
            

              @if(Auth()->user()->role_id != 3)
                 

                  <li class="{{ Request::is('admin/transactions/withdrawMethod') ? 'active' : '' }}"><a href="{{ URL::to('admin/transactions/withdrawMethod')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.withdrawMethod') }}</a></li>

                  <li class="{{ Request::is('admin/transactions/withdrawLog') ? 'active' : '' }}"><a href="{{ URL::to('admin/transactions/withdrawLog')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawLog') }}</a></li>

                  <li class="{{ Request::is('admin/transactions/pendingLog') ? 'active' : '' }}"><a href="{{ URL::to('admin/transactions/pendingLog')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawPendingRequestLog') }}</a></li>

                  <li class="{{ Request::is('admin/transactions/successLog') ? 'active' : '' }}"><a href="{{ URL::to('admin/transactions/successLog')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawSuccessLog') }}</a></li>

                  <li class="{{ Request::is('admin/transactions/refundedLog') ? 'active' : '' }}"><a href="{{ URL::to('admin/transactions/refundedLog')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawRefundedLog') }}</a></li>
                 
              @else
                <li class="{{ Request::is('admin/vendor/transactions/withdrawMoney') ? 'active' : '' }}"><a href="{{ URL::to('admin/vendor/transactions/withdrawMoney')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawMoney') }}</a></li>

                 <li class="{{ Request::is('admin/transactions/withdrawLog') ? 'active' : '' }}"><a href="{{ URL::to('admin/transactions/withdrawLog')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawLog') }}</a></li>
              @endif
             
            </ul>
          </li>






      <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->reports_view == 1){
          ?>
        <li class="treeview {{ Request::is('admin/statscustomers') ? 'active' : '' }} {{ Request::is('admin/outofstock') ? 'active' : '' }} {{ Request::is('admin/statsproductspurchased') ? 'active' : '' }} {{ Request::is('admin/statsproductsliked') ? 'active' : '' }} {{ Request::is('admin/lowinstock') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
  <span>{{ trans('labels.link_reports') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/lowinstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/lowinstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_products_low_stock') }}</a></li>
            <li class="{{ Request::is('admin/outofstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/outofstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_out_of_stock_products') }}</a></li>
           <!-- <li class="{{ Request::is('admin/productsstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/stockin')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.stockin') }}</a></li>-->
            @if(Auth()->user()->role_id != 3)
              <li class="{{ Request::is('admin/statscustomers') ? 'active' : '' }} "><a href="{{ URL::to('admin/statscustomers')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_customer_orders_total') }}</a></li>
            @endif
            <li class="{{ Request::is('admin/statsproductspurchased') ? 'active' : '' }}"><a href="{{ URL::to('admin/statsproductspurchased')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_total_purchased') }}</a></li>
            <li class="{{ Request::is('admin/statsproductsliked') ? 'active' : '' }}"><a href="{{ URL::to('admin/statsproductsliked')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_products_liked') }}</a></li>
          </ul>
        </li>
      <?php } ?>
     
  
      
      <?php
          if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->tax_location_view == 1){
        ?>
          <li class="treeview {{ Request::is('admin/countries/display') ? 'active' : '' }} {{ Request::is('admin/countries/add') ? 'active' : '' }} {{ Request::is('admin/countries/edit/*') ? 'active' : '' }} {{ Request::is('admin/zones/display') ? 'active' : '' }} {{ Request::is('admin/zones/add') ? 'active' : '' }} {{ Request::is('admin/zones/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/edit/*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>{{ trans('labels.link_tax_location') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('admin/countries/display') ? 'active' : '' }} {{ Request::is('admin/countries/add') ? 'active' : '' }} {{ Request::is('admin/countries/edit/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/countries/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_countries') }}</a></li>
              <li class="{{ Request::is('admin/zones/display') ? 'active' : '' }} {{ Request::is('admin/zones/add') ? 'active' : '' }} {{ Request::is('admin/zones/edit/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/zones/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_zones') }}</a></li>
              <li class="{{ Request::is('admin/tax/taxclass/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/edit/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/tax/taxclass/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_tax_class') }}</a></li>
              <li class="{{ Request::is('admin/tax/taxrates/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/edit/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/tax/taxrates/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_tax_rates') }}</a></li>
              </ul>
          </li>
        <?php } ?>
        <?php
          if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->coupons_view ==1){
        ?>
        <li class="treeview {{ Request::is('admin/coupons/display') ? 'active' : '' }} {{ Request::is('admin/editcoupons/*') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/coupons/display')}}" ><i class="fa fa-tablet" aria-hidden="true"></i> <span>{{ trans('labels.link_coupons') }}</span></a>
        </li>
      <?php } ?>
      <?php

        if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->shipping_methods_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/shippingmethods/display') ? 'active' : '' }} {{ Request::is('admin/shippingmethods/upsShipping/display') ? 'active' : '' }} {{ Request::is('admin/shippingmethods/flateRate/display') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/shippingmethods/display')}}"><i class="fa fa-truck" aria-hidden="true"></i> <span> {{ trans('labels.link_shipping_methods') }}</span>
          </a>
        </li>
          <?php } ?>
          <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->payment_methods_view == 1){
          ?>
            <li class="treeview {{ Request::is('admin/paymentmethods/index') ? 'active' : '' }} {{ Request::is('admin/paymentmethods/display/*') ? 'active' : '' }}">
              <a  href="{{ URL::to('admin/paymentmethods/index')}}"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>
              {{ trans('labels.link_payment_methods') }}</span>
              </a>
            </li>
          <?php } ?>
          <?php

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->news_view == 1){
      ?>
        <!--li class="treeview {{ Request::is('admin/newscategories/display') ? 'active' : '' }} {{ Request::is('admin/newscategories/add') ? 'active' : '' }} {{ Request::is('admin/newscategories/edit/*') ? 'active' : '' }} {{ Request::is('admin/news/display') ? 'active' : '' }}  {{ Request::is('admin/news/add') ? 'active' : '' }}  {{ Request::is('admin/news/edit/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-database" aria-hidden="true"></i>
<span>      {{ trans('labels.Blog') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          	<li class="{{ Request::is('admin/newscategories/display') ? 'active' : '' }} {{ Request::is('admin/newscategories/add') ? 'active' : '' }} {{ Request::is('admin/newscategories/edit/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/newscategories/display')}}"><i class="fa fa-circle-o"></i>{{ trans('labels.link_news_categories') }}</a></li>
            <li class="{{ Request::is('admin/news/display') ? 'active' : '' }}  {{ Request::is('admin/news/add') ? 'active' : '' }}  {{ Request::is('admin/news/edit/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/news/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_sub_news') }}</a></li>
          </ul>
        </li-->
      <?php } ?> 
      @if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->notifications_view == 1)
      <li class="treeview {{ Request::is('admin/pushnotification') ? 'active' : '' }}{{ Request::is('admin/devices/display') ? 'active' : '' }} {{ Request::is('admin/devices/viewdevices/*') ? 'active' : '' }} {{ Request::is('admin/devices/notifications') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/devices/display')}} ">
            <i class="fa fa-bell-o" aria-hidden="true"></i>
<span>{{ trans('labels.link_notifications') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li class="{{ Request::is('admin/pushnotification') ? 'active' : '' }}"><a href="{{ URL::to('admin/pushnotification')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>
            <li class="{{ Request::is('admin/devices/display') ? 'active' : '' }} {{ Request::is('admin/devices/viewdevices/*') ? 'active' : '' }}">
          		<a href="{{ URL::to('admin/devices/display')}}"><i class="fa fa-circle-o"></i>{{ trans('labels.link_devices') }} </a>
            </li>
            <li class="{{ Request::is('admin/devices/notifications') ? 'active' : '' }} ">
            	<a href="{{ URL::to('admin/devices/notifications') }}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_send_notifications') }}</a>
            </li>
          </ul>
        </li>
        @endif
        <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>

        <li class="treeview {{ Request::is('admin/facebooksettings') ? 'active' : '' }} {{ Request::is('admin/setting') ? 'active' : '' }} {{ Request::is('admin/googlesettings') ? 'active' : '' }}  {{ Request::is('admin/alertsetting') ? 'active' : '' }}  ">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> {{ trans('labels.link_general_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            
          <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a href="{{ URL::to('admin/setting')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_store_setting') }}</a></li>
            <li class="{{ Request::is('admin/facebooksettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/facebooksettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_facebook') }}</a></li>
            <li class="{{ Request::is('admin/googlesettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/googlesettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_google') }}</a></li>
            
            <li class="{{ Request::is('admin/alertsetting') ? 'active' : '' }}"><a href="{{ URL::to('admin/alertsetting')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.alertSetting') }}</a></li>
            
            
          </ul>
        </li>
      <?php } ?>
      <?php

      $route =  DB::table('settings')
                 ->where('name','is_web_purchased')
                 ->where('value', 1)
                 ->first();
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->website_setting_view == 1 and $route != null){
      ?>

        <li class="treeview {{ Request::is('admin/menus') ? 'active' : '' }} {{ Request::is('admin/mailchimp') ? 'active' : '' }} {{ Request::is('admin/topoffer/display') ? 'active' : '' }} {{ Request::is('admin/webPagesSettings/*') ? 'active' : '' }} {{ Request::is('admin/homebanners') ? 'active' : '' }} {{ Request::is('admin/sliders') ? 'active' : '' }} {{ Request::is('admin/addsliderimage') ? 'active' : '' }} {{ Request::is('admin/editslide/*') ? 'active' : '' }} {{ Request::is('admin/webpages') ? 'active' : '' }}  {{ Request::is('admin/addwebpage') ? 'active' : '' }}  {{ Request::is('admin/editwebpage/*') ? 'active' : '' }} {{ Request::is('admin/websettings') ? 'active' : '' }} {{ Request::is('admin/webthemes') ? 'active' : '' }} {{ Request::is('admin/customstyle') ? 'active' : '' }} {{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/addconstantbanner') ? 'active' : '' }} {{ Request::is('admin/editconstantbanner/*') ? 'active' : '' }}" >
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> AutoShop Web Settings</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview {{ Request::is('admin/topoffer/display') ? 'active' : '' }} {{ Request::is('admin/webPagesSettings/*') ? 'active' : '' }}">
              <a href="#">
                <i class="fa fa-picture-o"></i> <span>{{ trans('labels.Theme Setting') }}</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview {{ Request::is('admin/topoffer/display') ? 'active' : '' }} ">
                    <a href="{{url('admin/topoffer/display')}}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Top Offer') }} </span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/webPagesSettings/1') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/1">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Home Page') }} </span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/webPagesSettings/8') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/8">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.login') }} </span>
                    </a>
                </li>
                
                <li class="treeview {{ Request::is('admin/webPagesSettings/9') ? 'active' : '' }} ">
                  <a href="{{url('admin/webPagesSettings')}}/9">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.News') }} </span>
                    </a>
                </li>

                <li class="treeview {{ Request::is('admin/webPagesSettings/5') ? 'active' : '' }} ">
                  <a href="{{url('admin/webPagesSettings')}}/5">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Shop Page Settings') }} </span>
                  </a>
               </li>

                <li class="treeview {{ Request::is('admin/webPagesSettings/2') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/2">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Cart Page Settings') }} </span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/webPagesSettings/6') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/6">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Contact Page Settings') }}</span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/webPagesSettings/7') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/7">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Colors Settings') }}</span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/webPagesSettings/10') ? 'active' : '' }} ">
                  <a href="{{url('admin/webPagesSettings')}}/10">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Banner Transition Settings') }} </span>
                  </a>
              </li>
                <li class="treeview {{ Request::is('admin/webPagesSettings/4') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/4">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Product Page Settings') }} </span>
                    </a>
                </li>
              </ul>
            </li>
           
            <li class="{{ Request::is('admin/sliders') ? 'active' : '' }} {{ Request::is('admin/addsliderimage') ? 'active' : '' }} {{ Request::is('admin/editslide/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/sliders')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_Sliders') }}</a></li>
            <li class="{{ Request::is('admin/homebanners') ? 'active' : '' }} "><a href="{{ URL::to('admin/homebanners')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Parallax Banners') }}</a></li>
            <li class="{{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/constantbanners/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/constantbanners')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_Banners') }}</a></li>
           
            <li class="{{ Request::is('admin/menus') ? 'active' : '' }}  {{ Request::is('admin/addmenus') ? 'active' : '' }}  {{ Request::is('admin/editmenus/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/menus')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.menus') }}</a></li>

            <li class="{{ Request::is('admin/webpages') ? 'active' : '' }}  {{ Request::is('admin/addwebpage') ? 'active' : '' }}  {{ Request::is('admin/editwebpage/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/webpages')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.content_pages') }}</a></li>

            <!-- <li class="{{ Request::is('admin/webthemes') ? 'active' : '' }} "><a href="{{ URL::to('admin/webthemes')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.website_themes') }}</a></li> -->

            <li class="{{ Request::is('admin/seo') ? 'active' : '' }} "><a href="{{ URL::to('admin/seo')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.seo content') }}</a></li>

            <li class="{{ Request::is('admin/customstyle') ? 'active' : '' }} "><a href="{{ URL::to('admin/customstyle')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.custom_style_js') }}</a></li>
            <li class="{{ Request::is('admin/newsletter') ? 'active' : '' }}"><a href="{{ URL::to('admin/newsletter')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.mailchimp') }}</a></li>
            <li class="{{ Request::is('admin/websettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/websettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>
          </ul>
        </li>
      <?php } ?>
      <?php
      $route =  DB::table('settings')
                 ->where('name','is_app_purchased')
                 ->where('value', 1)
                 ->first();

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->application_setting_view == 1 and $route != null){
      ?>

        <li class="treeview {{ Request::is('admin/banners') ? 'active' : '' }} {{ Request::is('admin/addbanner') ? 'active' : '' }} {{ Request::is('admin/editbanner/*') ? 'active' : '' }} {{ Request::is('admin/pages') ? 'active' : '' }}  {{ Request::is('admin/addpage') ? 'active' : '' }}  {{ Request::is('admin/editpage/*') ? 'active' : '' }}  {{ Request::is('admin/appSettings') ? 'active' : '' }} {{ Request::is('admin/admobSettings') ? 'active' : '' }} {{ Request::is('admin/applabel') ? 'active' : '' }} {{ Request::is('admin/addappkey') ? 'active' : '' }} {{ Request::is('admin/applicationapi') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> {{ trans('labels.link_app_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/banners') ? 'active' : '' }} {{ Request::is('admin/addbanner') ? 'active' : '' }} {{ Request::is('admin/editbanner/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/banners')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_Banners') }}</a></li>

            <li class="{{ Request::is('admin/pages') ? 'active' : '' }}  {{ Request::is('admin/addpage') ? 'active' : '' }}  {{ Request::is('admin/editpage/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/pages')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.content_pages') }}</a></li>

            <li class="{{ Request::is('admin/admobSettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/admobSettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_admob') }}</a></li>

            <li class="android-hide {{ Request::is('admin/applabel') ? 'active' : '' }} {{ Request::is('admin/addappkey') ? 'active' : '' }}"><a href="{{ URL::to('admin/applabel')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.labels') }}</a></li>

            <li class="{{ Request::is('admin/applicationapi') ? 'active' : '' }}"><a href="{{ URL::to('admin/applicationapi')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.applicationApi') }}</a></li>

            <li class="{{ Request::is('admin/appsettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/appsettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>

          </ul>
        </li>
      <?php } ?>

         @php
        /* Not used
     
      @if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manage_admins_view == 1)

         <li class="treeview {{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }} {{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadminType') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span> {{ trans('labels.link_manage_roles') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/admins')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_admins') }}</a></li>

            <li class="{{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadminType') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/manageroles')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_manage_roles') }}</a></li>
          </ul>
        </li>
      @endif

     

     


        @if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->edit_management == 1)
   

          <!--------create middlewares -------->
        <li class="treeview {{ Request::is('admin/managements/merge') ? 'active' : '' }} {{ Request::is('admin/managements/updater') ? 'active' : '' }} {{ Request::is('admin/managements/restore') ? 'active' : '' }} {{ Request::is('admin/managements/backup') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> {{ trans('labels.Code Manager') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/managements/merge') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/merge')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_merge') }}</a></li>
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/updater')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_updater') }}</a></li>
          </ul>
        </li>
       
       @endif
        
        @if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->edit_management == 1)

          <!--------create middlewares -------->
        <li class="treeview  {{ Request::is('admin/managements/restore') ? 'active' : '' }} {{ Request::is('admin/managements/backup') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> {{ trans('labels.Backup / Restore') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/backup')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.backup') }}</a></li>
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/import')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.restore') }}</a></li>
           
          </ul>
        </li>
        @endif

        */
        @endphp




       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
