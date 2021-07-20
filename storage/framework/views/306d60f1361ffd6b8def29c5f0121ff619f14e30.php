<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo e(trans('labels.navigation')); ?></li>
        <li class="treeview <?php echo e(Request::is('vendor/dashboard/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('vendor/dashboard/this_month')); ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('labels.header_dashboard')); ?></span>
          </a>
        </li>
      
    

        <li class="treeview <?php echo e(Request::is('vendor/packages') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('vendor/packages')); ?>">
            <i class="fa fa-tags" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Packages')); ?> </span>
          </a>
        </li>


      

       <li class="treeview <?php echo e(Request::is('vendor/withdrawMoney') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('vendor/withdrawMoney')); ?>">
            <i class="fa fa-money" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Withdraw')); ?> </span>
          </a>
        </li>


        <li class="treeview <?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/units') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editunit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editattributes/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo e(trans('labels.Products')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           
              <li class="<?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_all_products')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/inventory/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.inventory')); ?></a></li>
           
              <li class="<?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?>">
                <a href="<?php echo e(URL::to('admin/reviews/display')); ?>">
                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span><?php echo e(trans('labels.reviews')); ?></span><?php if($result['commonContent']['new_reviews']>0): ?><span class="label label-success pull-right"><?php echo e($result['commonContent']['new_reviews']); ?> <?php echo e(trans('labels.new')); ?></span><?php endif; ?>
                </a>
              </li>
           
          </ul>
        </li>
     


        <li class="treeview <?php echo e(Request::is('vendor/orders') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('vendor/orders')); ?>">
            <i class="fa fa-list" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Orders')); ?> </span>
          </a>
        </li>

      
      <li class="treeview <?php echo e(Request::is('vendor/product/*') ? 'active' : ''); ?>">
        <a href="#">
          <i class="fa fa-shopping-cart"></i> <span><?php echo e(trans('labels.Products')); ?></span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?php echo e(Request::is('vendor/product/manage') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('vendor/product/manage')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.ManageProducts')); ?> </span>
              </a>
          </li>

          <li class="treeview <?php echo e(Request::is('vendor/product/create') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('vendor/product/add')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.UploadProduct')); ?> </span>
              </a>
          </li>
        </ul>
      </li>

       <li class="treeview <?php echo e(Request::is('vendor/transactions') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('vendor/transactions')); ?>">
            <i class="fa fa-dollar" aria-hidden="true"></i> <span> <?php echo e(trans('labels.TransactionLog')); ?> </span>
          </a>
        </li>

        <li class="treeview <?php echo e(Request::is('vendor/account/*') ? 'active' : ''); ?>">
        <a href="#">
          <i class="fa fa-cogs"></i> <span><?php echo e(trans('labels.Setting')); ?></span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?php echo e(Request::is('vendor/product/manage') ? 'active' : ''); ?> ">
               <a href="<?php echo e(URL::to('vendor/account/profile')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.profile_link')); ?> </span>
              </a>
          </li>

          <li class="treeview <?php echo e(Request::is('vendor/logout') ? 'active' : ''); ?> ">
              <a href="<?php echo e(URL::to('vendor/logout')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.sign_out')); ?> </span>
              </a>
          </li>
        </ul>
      </li>


     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/vendor/common/sidebar.blade.php ENDPATH**/ ?>