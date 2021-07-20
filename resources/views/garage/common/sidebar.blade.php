<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">




      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

       

        <li class="treeview {{ Request::is('/') ? 'active' : '' }}">
          <a href="{{ URL::to('/')}}" target="_blank">
            <i class="fa fa-desktop"></i> <span>{{ trans('labels.view_website') }}</span>
          </a>
        </li>

        <li class="treeview {{ Request::is('garage/dashboard') ? 'active' : '' }}">
          <a href="{{ route('garage.dashboard')}}">
            <i class="fa fa-home"></i> <span>{{ trans('labels.header_dashboard') }}</span>
          </a>
        </li>

        
        @if(\Auth()->user()->garage_vendor_type != 2)

         <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">Customer</li>

        <li class="treeview {{ Request::is('garage/customer-service-request/*') ? 'active' : '' }}">
          <a href="{{ route('garage.customers.service-request') }}">
            <i class="fa fa-list"></i> <span> Customer Service Requests</span>
          </a>
        </li>

        <li class="treeview {{ Request::is('garage/customer-package-subscription*') ? 'active' : '' }}">
          <a href="{{ route('garage.customers.packages-subscribed') }}" >
            <i class="fa fa-file"></i> <span> Customer Package Subscribed</span>
          </a>
        </li>

         <li class="treeview {{ Request::is('garage/customer-payments') ? 'active' : '' }}">
          <a href="{{ route('garage.customers.payments')}}" >
            <i class="fa fa-money"></i> <span>Customer Transactions</span>
          </a>
        </li>

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">My Package Subscription</li>

           <li class="treeview {{ Request::is('partner/packages') ? 'active' : '' }}">
            <a href="{{ route('garage.packages')}}" >
              <i class="fa fa-file"></i> <span>Package Subscription</span>
            </a>
          </li>

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">{{ trans('labels.Garage') }}</li>

          <li class="treeview {{ Request::is('partner/garage/edit') ? 'active' : '' }}">
            <a href="{{ route('garage.information')}}" >
              <i class="fa fa-money"></i> <span>Garage Information</span>
            </a>
          </li>

          <li class="treeview {{ Request::is('partner/garage/image/view') ? 'active' : '' }}">
            <a href="{{ route('garage.image.view')}}" >
              <i class="fa fa-money"></i> <span>Garage Images</span>
            </a>
          </li>


          <li class="treeview {{ Request::is('partner/garage/service/view') ? 'active' : '' }}">
            <a href="{{ route('garage.services.view')}}" >
              <i class="fa fa-money"></i> <span>Garage Service</span>
            </a>
          </li>

          <li class="treeview {{ Request::is('partner/garage/members/view') ? 'active' : '' }}">
            <a href="{{ route('garage.team.view')}}" >
              <i class="fa fa-money"></i> <span>Garage Team</span>
            </a>
          </li>

          <li class="treeview {{ Request::is('partner/garage/videos/view') ? 'active' : '' }}">
            <a href="{{ route('garage.video.view')}}" >
              <i class="fa fa-money"></i> <span>Garage Video</span>
            </a>
          </li>

           <li class="treeview {{ Request::is('partner/garage/working-hour/view') ? 'active' : '' }}">
            <a href="{{ route('garage.working-hours.view')}}" >
              <i class="fa fa-money"></i> <span>Garage Working Hours</span>
            </a>
          </li>

        @endif


       

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">{{ trans('labels.manage_autoshop') }}</li>
       

      
      <li class="treeview {{ Request::is('partner/media/add') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span>{{ trans('labels.media') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('partner/media/add') ? 'active' : '' }} ">
              <a href="{{url('partner/media/add')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.media') }} </span>
              </a>
          </li>
        </ul>
      </li>

      
      
   
     
        <li class="treeview {{ Request::is('partner/reviews/display') ? 'active' : '' }} {{ Request::is('partner/manufacturers/display') ? 'active' : '' }} {{ Request::is('partner/manufacturers/add') ? 'active' : '' }} {{ Request::is('partner/manufacturers/edit/*') ? 'active' : '' }} {{ Request::is('partner/units') ? 'active' : '' }} {{ Request::is('partner/addunit') ? 'active' : '' }} {{ Request::is('partner/editunit/*') ? 'active' : '' }} {{ Request::is('partner/products/display') ? 'active' : '' }} {{ Request::is('partner/products/add') ? 'active' : '' }} {{ Request::is('partner/products/edit/*') ? 'active' : '' }} {{ Request::is('partner/editattributes/*') ? 'active' : '' }} {{ Request::is('partner/products/attributes/display') ? 'active' : '' }}  {{ Request::is('partner/products/attributes/add') ? 'active' : '' }} {{ Request::is('partner/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('partner/addinventory/*') ? 'active' : '' }} {{ Request::is('partner/addproductimages/*') ? 'active' : '' }} {{ Request::is('partner/categories/display') ? 'active' : '' }} {{ Request::is('partner/categories/add') ? 'active' : '' }} {{ Request::is('partner/categories/edit/*') ? 'active' : '' }} {{ Request::is('partner/categories/filter') ? 'active' : '' }} {{ Request::is('partner/products/inventory/display') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-database"></i> <span>{{ trans('labels.Catalog') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           

         
            
              <li class="{{ Request::is('partner/products/display') ? 'active' : '' }} {{ Request::is('partner/products/add') ? 'active' : '' }} {{ Request::is('partner/products/edit/*') ? 'active' : '' }} {{ Request::is('partner/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('partner/addinventory/*') ? 'active' : '' }} {{ Request::is('partner/addproductimages/*') ? 'active' : '' }}"><a href="{{ URL::to('partner/products/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_all_products') }}</a></li>
              <li class="{{ Request::is('partner/products/inventory/display') ? 'active' : '' }}"><a href="{{ URL::to('partner/products/inventory/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.inventory') }}</a></li>
           
            
          </ul>
        </li>
     
    
        <li class="treeview {{ Request::is('partner/orderstatus') ? 'active' : '' }} {{ Request::is('partner/addorderstatus') ? 'active' : '' }} {{ Request::is('partner/editorderstatus/*') ? 'active' : '' }} {{ Request::is('partner/orders/display') ? 'active' : '' }} {{ Request::is('partner/orders/vieworder/*') ? 'active' : '' }}">
          <a href="#" ><i class="fa fa-list-ul" aria-hidden="true"></i> <span> {{ trans('labels.link_orders') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

         
          <li class="{{ Request::is('partner/orders/display') ? 'active' : '' }} {{ Request::is('partner/orders/vieworder/*') ? 'active' : '' }}">
            <a href="{{ URL::to('partner/orders/display')}}" >
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.link_orders') }}</span>
            </a>
          </li>
          </ul>
        </li>
      
        @if(\Auth()->user()->garage_vendor_type == 2)
       <li class="treeview  
           {{ Request::is('partner/transactions/withdrawMethod') ? 'active' : '' }} 
           {{ Request::is('partner/transactions/withdrawLog') ? 'active' : '' }}
           {{ Request::is('partner/transactions/refundedLog') ? 'active' : '' }}
           {{ Request::is('partner/transactions/successLog') ? 'active' : '' }}
           {{ Request::is('partner/transactions/pendingLog') ? 'active' : '' }}
           {{ Request::is('partner/vendor/transactions/withdrawMoney') ? 'active' : '' }}
           ">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>Vendors Transactions</span> <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
             
                <li class="{{ Request::is('partner/vendor/transactions/withdrawMoney') ? 'active' : '' }}"><a href="{{ URL::to('partner/vendor/transactions/withdrawMoney')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawMoney') }}</a></li>

                 <li class="{{ Request::is('partner/transactions/withdrawLog') ? 'active' : '' }}"><a href="{{ URL::to('partner/vendor/transactions/withdrawLog')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.WithdrawLog') }}</a></li>
            
             
            </ul>
          </li>
          @endif






        <li class="treeview {{ Request::is('partner/statscustomers') ? 'active' : '' }} {{ Request::is('partner/outofstock') ? 'active' : '' }} {{ Request::is('partner/statsproductspurchased') ? 'active' : '' }} {{ Request::is('partner/statsproductsliked') ? 'active' : '' }} {{ Request::is('partner/lowinstock') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
              <span>{{ trans('labels.link_reports') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('partner/lowinstock') ? 'active' : '' }} "><a href="{{ URL::to('partner/lowinstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_products_low_stock') }}</a></li>
            <li class="{{ Request::is('partner/outofstock') ? 'active' : '' }} "><a href="{{ URL::to('partner/outofstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_out_of_stock_products') }}</a></li>
            @if(Auth()->user()->role_id != 3)
              <li class="{{ Request::is('partner/statscustomers') ? 'active' : '' }} "><a href="{{ URL::to('partner/statscustomers')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_customer_orders_total') }}</a></li>
            @endif
            <li class="{{ Request::is('partner/statsproductspurchased') ? 'active' : '' }}"><a href="{{ URL::to('partner/statsproductspurchased')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_total_purchased') }}</a></li>
            <li class="{{ Request::is('partner/statsproductsliked') ? 'active' : '' }}"><a href="{{ URL::to('partner/statsproductsliked')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_products_liked') }}</a></li>
          </ul>
        </li>
      
  
      
     
      
        <li class="treeview {{ Request::is('partner/coupons/display') ? 'active' : '' }} {{ Request::is('partner/editcoupons/*') ? 'active' : '' }}">
          <a href="{{ URL::to('partner/coupons/display')}}" ><i class="fa fa-tablet" aria-hidden="true"></i> <span>{{ trans('labels.link_coupons') }}</span></a>
        </li>
     



       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
