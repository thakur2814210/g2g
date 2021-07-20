<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">




      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;"><?php echo e(trans('labels.common_settings')); ?></li>

        <li class="treeview <?php echo e(Request::is('/') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('/')); ?>" target="_blank">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('labels.view_website')); ?></span>
          </a>
        </li>

        <li class="treeview <?php echo e(Request::is('garage/dashboard') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('garage/dashboard')); ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('labels.header_dashboard')); ?></span>
          </a>
        </li>
  
           

        <!-- G2G WEBSITE -->
        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;"><?php echo e(trans('labels.manage_g2g')); ?></li>
       
        <li class="treeview <?php echo e(Request::is('garage/customer-service-request/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('garage.customers.service-request')); ?>">
            <i class="fa fa-dashboard"></i> <span> Customer Service Requests</span>
          </a>
        </li>


        <li class="treeview <?php echo e(Request::is('garage/customer-package-subscription*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('garage.customers.packages-subscribed')); ?>" >
            <i class="fa fa-dashboard"></i> <span> Customer Package Subscribed</span>
          </a>
        </li>

         <li class="treeview <?php echo e(Request::is('garage/customer-payments') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('garage.customers.payments')); ?>" >
            <i class="fa fa-dashboard"></i> <span>Customer Transactions</span>
          </a>
        </li>


        

        



     


        <br/>

        
        <!-- G2G Auto Shop -->

        <li class="header" style="color: #fff;font-size: 16px;font-weight: bold;"><?php echo e(trans('labels.manage_autoshop')); ?></li>
       

     
      
   
     
        <li class="treeview <?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/units') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editunit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editattributes/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo e(trans('labels.Catalog')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           

         
            
              <li class="<?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_all_products')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/inventory/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.inventory')); ?></a></li>
           
            
          </ul>
        </li>
     
    
        <li class="treeview <?php echo e(Request::is('admin/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editorderstatus/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/vieworder/*') ? 'active' : ''); ?>">
          <a href="#" ><i class="fa fa-list-ul" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_orders')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

         
          <li class="<?php echo e(Request::is('admin/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/vieworder/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(URL::to('admin/orders/display')); ?>" >
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_orders')); ?></span>
            </a>
          </li>
          </ul>
        </li>
      

       <li class="treeview  
           <?php echo e(Request::is('admin/transactions/withdrawMethod') ? 'active' : ''); ?> 
           <?php echo e(Request::is('admin/transactions/withdrawLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('admin/transactions/refundedLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('admin/transactions/successLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('admin/transactions/pendingLog') ? 'active' : ''); ?>

           <?php echo e(Request::is('admin/vendor/transactions/withdrawMoney') ? 'active' : ''); ?>

           ">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>Vendors Transactions</span> <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
             
                <li class="<?php echo e(Request::is('admin/vendor/transactions/withdrawMoney') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/vendor/transactions/withdrawMoney')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.WithdrawMoney')); ?></a></li>

                 <li class="<?php echo e(Request::is('admin/transactions/withdrawLog') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/transactions/withdrawLog')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.WithdrawLog')); ?></a></li>
            
             
            </ul>
          </li>






        <li class="treeview <?php echo e(Request::is('admin/statscustomers') ? 'active' : ''); ?> <?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductspurchased') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?> <?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
  <span><?php echo e(trans('labels.link_reports')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/lowinstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_low_stock')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/outofstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_out_of_stock_products')); ?></a></li>
           <!-- <li class="<?php echo e(Request::is('admin/productsstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/stockin')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.stockin')); ?></a></li>-->
            <?php if(Auth()->user()->role_id != 3): ?>
              <li class="<?php echo e(Request::is('admin/statscustomers') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/statscustomers')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_customer_orders_total')); ?></a></li>
            <?php endif; ?>
            <li class="<?php echo e(Request::is('admin/statsproductspurchased') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/statsproductspurchased')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_total_purchased')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/statsproductsliked')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_liked')); ?></a></li>
          </ul>
        </li>
      
  
      
     
      
        <li class="treeview <?php echo e(Request::is('admin/coupons/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editcoupons/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/coupons/display')); ?>" ><i class="fa fa-tablet" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_coupons')); ?></span></a>
        </li>
     



       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/garage/common/sidebar.blade.php ENDPATH**/ ?>