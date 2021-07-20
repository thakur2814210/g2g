<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <small><?php echo e(trans('labels.title_dashboard')); ?></small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></li>
            </ol>
        </section>
       
        <!-- Main content -->
        <section class="content">
          
            <div class="row">

                <?php if($result['garage_vendor_type'] ==! 2): ?>
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3><?php echo e($result['c_clientPackageSubscribe']); ?></h3>
                                <p><?php echo e(trans('labels.ClientPackageSubscribe')); ?></p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                      </div>
                    </div>
                   
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3><?php echo e($result['c_garagePackageSubscribe']); ?></h3>
                                <p><?php echo e(trans('labels.GaragePackageSubscribe')); ?></p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                      </div>
                    </div>
                 <?php endif; ?>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3><?php echo e($result['total_orders']); ?></h3>
                            <p><?php echo e(trans('labels.NewOrders')); ?></p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->

                 <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3><?php echo e($result['totalProducts']); ?></h3>

                      <p><?php echo e(trans('labels.totalProducts')); ?></p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->

                 <div class="col-lg-3 col-xs-6">

                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3><?php echo e($result['outOfStock']); ?> </h3>
                      <p><?php echo e(trans('labels.outOfStock')); ?></p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-light-blue">
                    <div class="inner">
                      <h3><?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($result['total_sales_amount']); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></h3>
                      <p><?php echo e(trans('labels.TotalSalesAmount')); ?></p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                  </div>
                </div>


                <?php if($result['garage_vendor_type'] == 2): ?>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-light-blue">
                    <div class="inner">
                      <h3><?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($result['current_balance']); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></h3>
                      <p><?php echo e(trans('labels.CurrentBalance')); ?></p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                  </div>
                </div>
                <?php endif; ?>

              </div>

         

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-6">
                    <!-- MAP & BOX PANE -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo e(trans('labels.NewOrders')); ?></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(trans('labels.OrderID')); ?></th>
                                        <th><?php echo e(trans('labels.CustomerName')); ?></th>
                                        <th><?php echo e(trans('labels.TotalPrice')); ?></th>
                                        <th><?php echo e(trans('labels.Status')); ?> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($result['orders'])>0): ?>
                                        <?php $__currentLoopData = $result['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $total_orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $total_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key<=10): ?>
                                                    <tr>
                                                        <td><a href="<?php echo e(URL::to('partner/orders/vieworder/')); ?>/<?php echo e($orders->orders_id); ?>" data-toggle="tooltip" data-placement="bottom" title="Go to detail"><?php echo e($orders->orders_id); ?></a></td>
                                                        <td><?php echo e($orders->customers_name); ?></td>
                                                        <td>
                                                            <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e(floatval($orders->total_price)); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($orders->orders_status_id==1): ?>
                                                                <span class="label label-warning"></span>
                            <?php elseif($orders->orders_status_id==2): ?>
                                                                  <span class="label label-success">
                            <?php elseif($orders->orders_status_id==3): ?>
                                                                </span>  <span class="label label-danger"></span>
                            <?php else: ?>
                                                                  <span class="label label-primary">
                            <?php endif; ?>
                                                                                            <?php echo e($orders->orders_status); ?>

                                 </span>


                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4"><?php echo e(trans('labels.noOrderPlaced')); ?></td>

                                        </tr>
                                    <?php endif; ?>


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-6">

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo e(trans('labels.RecentlyAddedProducts')); ?></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                <?php $__currentLoopData = $result['recentProducts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentProducts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="<?php echo e(asset('').$recentProducts->products_image); ?>" alt="" width=" 100px" height="100px">
                                        </div>
                                        <div class="product-info">
                                            <a href="<?php echo e(URL::to('partner/products/edit')); ?>/<?php echo e($recentProducts->products_id); ?>" class="product-title"><?php echo e($recentProducts->products_name); ?>

                                                <span class="label label-warning label-succes pull-right">
                                                    <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e(floatval($recentProducts->products_price)); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?>
                                                    </span></a>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/dashboard/index.blade.php ENDPATH**/ ?>