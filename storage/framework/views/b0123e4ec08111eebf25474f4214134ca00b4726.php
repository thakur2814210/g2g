<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">




      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

       

        <li class="treeview <?php echo e(Request::is('/') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('/')); ?>" target="_blank">
            <i class="fa fa-desktop"></i> <span><?php echo e(trans('labels.view_website')); ?></span>
          </a>
        </li>

        <li class="treeview <?php echo e(Request::is('garage/dashboard') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('garage.dashboard')); ?>">
            <i class="fa fa-home"></i> <span><?php echo e(trans('labels.header_dashboard')); ?></span>
          </a>
        </li>

        
        <?php if(\Auth()->user()->garage_vendor_type != 2): ?>

         <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">Customer</li>

        <li class="treeview <?php echo e(Request::is('garage/customer-service-request/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('garage.customers.service-request')); ?>">
            <i class="fa fa-list"></i> <span> Customer Service Requests</span>
          </a>
        </li>

        <li class="treeview <?php echo e(Request::is('garage/customer-package-subscription*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('garage.customers.packages-subscribed')); ?>" >
            <i class="fa fa-file"></i> <span> Customer Package Subscribed</span>
          </a>
        </li>

         <li class="treeview <?php echo e(Request::is('garage/customer-payments') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('garage.customers.payments')); ?>" >
            <i class="fa fa-money"></i> <span>Customer Transactions</span>
          </a>
        </li>

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;">My Package Subscription</li>

           <li class="treeview <?php echo e(Request::is('partner/packages') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('garage.packages')); ?>" >
              <i class="fa fa-file"></i> <span>Package Subscription</span>
            </a>
          </li>

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;"><?php echo e(trans('labels.Garage')); ?></li>

          <li class="treeview <?php echo e(Request::is('partner/garage/edit') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('garage.information')); ?>" >
              <i class="fa fa-money"></i> <span>Garage Information</span>
            </a>
          </li>

          <li class="treeview <?php echo e(Request::is('partner/garage/image/view') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('garage.image.view')); ?>" >
              <i class="fa fa-money"></i> <span>Garage Images</span>
            </a>
          </li>


          <li class="treeview <?php echo e(Request::is('partner/garage/service/view') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('garage.services.view')); ?>" >
              <i class="fa fa-money"></i> <span>Garage Service</span>
            </a>
          </li>

          <li class="treeview <?php echo e(Request::is('partner/garage/members/view') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('garage.team.view')); ?>" >
              <i class="fa fa-money"></i> <span>Garage Team</span>
            </a>
          </li>

          <li class="treeview <?php echo e(Request::is('partner/garage/videos/view') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('garage.video.view')); ?>" >
              <i class="fa fa-money"></i> <span>Garage Video</span>
            </a>
          </li>

           <li class="treeview <?php echo e(Request::is('partner/garage/working-hour/view') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('garage.working-hours.view')); ?>" >
              <i class="fa fa-money"></i> <span>Garage Working Hours</span>
            </a>
          </li>

        <?php endif; ?>


       

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;"><?php echo e(trans('labels.manage_autoshop')); ?></li>
       

      
      <li class="treeview <?php echo e(Request::is('partner/media/add') ? 'active' : ''); ?>">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span><?php echo e(trans('labels.media')); ?></span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?php echo e(Request::is('partner/media/add') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('partner/media/add')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.media')); ?> </span>
              </a>
          </li>
        </ul>
      </li>

      
      
   
     
        <li class="treeview <?php echo e(Request::is('partner/reviews/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('partner/manufacturers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/units') ? 'active' : ''); ?> <?php echo e(Request::is('partner/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('partner/editunit/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/editattributes/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('partner/products/attributes/add') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/addproductimages/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('partner/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/categories/filter') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/inventory/display') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo e(trans('labels.Catalog')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           

         
            
              <li class="<?php echo e(Request::is('partner/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/addproductimages/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('partner/products/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_all_products')); ?></a></li>
              <li class="<?php echo e(Request::is('partner/products/inventory/display') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('partner/products/inventory/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.inventory')); ?></a></li>
           
            
          </ul>
        </li>
     
    
        <li class="treeview <?php echo e(Request::is('partner/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('partner/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('partner/editorderstatus/*') ? 'active' : ''); ?> <?php echo e(Request::is('partner/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/orders/vieworder/*') ? 'active' : ''); ?>">
          <a href="#" ><i class="fa fa-list-ul" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_orders')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

         
          <li class="<?php echo e(Request::is('partner/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/orders/vieworder/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(URL::to('partner/orders/display')); ?>" >
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_orders')); ?></span>
            </a>
          </li>
          </ul>
        </li>
      
        <?php if(\Auth()->user()->garage_vendor_type == 2): ?>
       <li class="treeview  
           <?php echo e(Request::is('partner/transactions/withdrawMethod') ? 'active' : ''); ?> 
           <?php echo e(Request::is('partner/transactions/withdrawLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('partner/transactions/refundedLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('partner/transactions/successLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('partner/transactions/pendingLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('partner/vendor/transactions/withdrawMoney') ? 'active' : ''); ?>

           ">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>Vendors Transactions</span> <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
             
                <li class="<?php echo e(Request::is('partner/vendor/transactions/withdrawMoney') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('partner/vendor/transactions/withdrawMoney')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.WithdrawMoney')); ?></a></li>

                 <li class="<?php echo e(Request::is('partner/transactions/withdrawLog') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('partner/vendor/transactions/withdrawLog')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.WithdrawLog')); ?></a></li>
            
             
            </ul>
          </li>
          <?php endif; ?>






        <li class="treeview <?php echo e(Request::is('partner/statscustomers') ? 'active' : ''); ?> <?php echo e(Request::is('partner/outofstock') ? 'active' : ''); ?> <?php echo e(Request::is('partner/statsproductspurchased') ? 'active' : ''); ?> <?php echo e(Request::is('partner/statsproductsliked') ? 'active' : ''); ?> <?php echo e(Request::is('partner/lowinstock') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
              <span><?php echo e(trans('labels.link_reports')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('partner/lowinstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('partner/lowinstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_low_stock')); ?></a></li>
            <li class="<?php echo e(Request::is('partner/outofstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('partner/outofstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_out_of_stock_products')); ?></a></li>
            <?php if(Auth()->user()->role_id != 3): ?>
              <li class="<?php echo e(Request::is('partner/statscustomers') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('partner/statscustomers')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_customer_orders_total')); ?></a></li>
            <?php endif; ?>
            <li class="<?php echo e(Request::is('partner/statsproductspurchased') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('partner/statsproductspurchased')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_total_purchased')); ?></a></li>
            <li class="<?php echo e(Request::is('partner/statsproductsliked') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('partner/statsproductsliked')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_liked')); ?></a></li>
          </ul>
        </li>
      
  
      
     
      
        <li class="treeview <?php echo e(Request::is('partner/coupons/display') ? 'active' : ''); ?> <?php echo e(Request::is('partner/editcoupons/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('partner/coupons/display')); ?>" ><i class="fa fa-tablet" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_coupons')); ?></span></a>
        </li>
     



       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH D:\xampp74\htdocs\g2g\resources\views/garage/common/sidebar.blade.php ENDPATH**/ ?>