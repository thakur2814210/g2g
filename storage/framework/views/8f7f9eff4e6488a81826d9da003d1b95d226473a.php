<?php $__env->startSection('content'); ?>
<style>
	.wrapper{
		display:  none !important;
	}
</style>
<div class="login-box">
  <div class="login-logo">

  	<?php if(empty($web_setting[15]->value)): ?>
        <?php if($web_setting[66]->value=='1' and $web_setting[67]->value=='0'): ?>
      		<img src="<?php echo e(asset('images/admin_logo/logo-android-blue-v1.png')); ?>" class="ionic-hide">
        	<img src="<?php echo e(asset('images/admin_logo/logo-ionic-blue-v1.png')); ?>" class="android-hide">
        <?php elseif($web_setting[66]->value=='1' and $web_setting[67]->value=='1' or $web_setting[66]->value=='0' and $web_setting[67]->value=='1'): ?>
   			<img src="<?php echo e(asset('images/admin_logo/logo-laravel-blue-v1.png')); ?>" class="website-hide">
    	<?php endif; ?>
    <?php else: ?>
    	<img style="width: 60%" src="<?php echo e(asset('').$web_setting[15]->value); ?>">
    <?php endif; ?>

   
  </div>

   <?php if( count($errors) > 0): ?>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                  <?php echo e($error); ?>

            </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>


  <!-- /.login-logo -->
  <div class="login-box-body">
    
     <div>
      <p class="text-center"><b> <?php echo e(trans('labels.Vendor Change Password')); ?></b></p>
    </div>


    <!-- if email or password are not correct -->
    <?php if( count($errors) > 0): ?>
    	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                  <?php echo e($error); ?>

            </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

   


    <?php echo Form::open(array('url' =>'vendor/processPassword', 'method'=>'post', 'class'=>'form-validate')); ?>


       <div class="form-group has-feedback">
        <?php echo Form::email('email', '', array('class'=>'form-control email-validate', 'id'=>'email')); ?>

        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     <?php echo e(trans('labels.AdminEmailText')); ?></span>
       <span class="help-block hidden"> <?php echo e(trans('labels.AdminEmailText')); ?></span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
  	  
      <div class="row">
        <div class="col-xs-12">
          <?php echo Form::submit(trans('website.Send'), array('id'=>'login', 'class'=>'btn btn-primary btn-block btn-flat' )); ?>

        </div>
      </div>

       <br/>
             <div class="row">
              <div class="col-xs-12">
                <b><?php echo e(trans("Already have an account")); ?></b> <a href="<?php echo e(URL::to('admin/login')); ?>"><?php echo e(trans("Click here to login")); ?></a>
              </div>
    <?php echo Form::close(); ?>


  </div>

  <!-- /.login-box-body -->
</div>
<?php echo $__env->make('admin.layoutLlogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/admin/vendor_forget_password.blade.php ENDPATH**/ ?>