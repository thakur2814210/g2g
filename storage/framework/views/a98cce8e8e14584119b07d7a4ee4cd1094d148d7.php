
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.Theme Setting')); ?> <small><?php echo e(trans('labels.Home Page Customization')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li ><?php echo e(trans('labels.link_site_settings')); ?></li>
            <li ><?php echo e(trans('labels.Theme Setting')); ?></li>
            <li class="active"><?php echo e(trans('labels.Home Page')); ?></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                    <!-- /.box-header -->
                    <div id="app">
                      <?php  echo $banner; ?>
                    </div>
                    <script>
                    window.onload=function(){
                      document.getElementById("linkid").click();
                    };
                    </script>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/admin/theme/banner_images.blade.php ENDPATH**/ ?>