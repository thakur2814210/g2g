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

    <div style="font-size: 25px;">
      <?php echo e(trans('labels.login_text')); ?>

    </div>

  </div>
  <!-- /.login-logo -->

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

    <?php if(Session::has('loginError')): ?>
        <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
              <?php echo session('loginError'); ?>

        </div>
    <?php endif; ?>

  
       
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#admin">Admin</a></li>
      <li><a data-toggle="tab" href="#vendor">Vendor</a></li>
    </ul>

    <div class="tab-content">

      <div id="admin" class="tab-pane fade in active">

        <div class="login-box-body">

          <p class="login-box-msg"> 
            <b> <?php echo e(trans('labels.welcome_message')); ?></b><?php echo e(trans('labels.welcome_message_to')); ?>

          </p>

          
          <?php echo Form::open(array('url' =>'admin/checkLogin', 'method'=>'post', 'class'=>'form-validate')); ?>


            <div class="form-group has-feedback">
              <?php echo Form::email('email', '', array('class'=>'form-control', 'id'=>'email')); ?>

              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           <?php echo e(trans('labels.AdminEmailText')); ?></span>
              <span class="help-block hidden"> <?php echo e(trans('labels.AdminEmailText')); ?></span>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
              <input type="password" name='password' class='form-control ' value="">
              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                       <?php echo e(trans('labels.AdminPasswordText')); ?></span>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
            </div>
         
            <div class="row">
              <div class="col-xs-12">
                <?php echo Form::submit(trans('labels.login'), array('id'=>'login', 'class'=>'btn btn-primary btn-block btn-flat' )); ?>

              </div>
            </div>
          
          <?php echo Form::close(); ?>

        </div>
      </div>

      <div id="vendor" class="tab-pane fade">
       
        <div class="login-box-body">
          
          <p class="login-box-msg"> 
            <b> <?php echo e(trans('labels.welcome_message')); ?></b><?php echo e(trans('labels.vendor_welcome_message_to')); ?>

          </p>

          <?php echo Form::open(array('url' =>'admin/checkLogin', 'method'=>'post', 'class'=>'form-validate')); ?>


             <div class="form-group has-feedback">
              <?php echo Form::email('email', '', array('class'=>'form-control ', 'id'=>'email')); ?>

              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           <?php echo e(trans('labels.AdminEmailText')); ?></span>
             <span class="help-block hidden"> <?php echo e(trans('labels.AdminEmailText')); ?></span>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
             <input type="password" name='password' class='form-control' value="">
             <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                         <?php echo e(trans('labels.AdminPasswordText')); ?></span>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
             <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>

            </div>
            <img src="">
            <div class="row">

              <div class="col-xs-6">
                <?php echo Form::submit(trans('labels.login'), array('id'=>'login', 'class'=>'btn btn-primary btn-block btn-flat' )); ?>

              </div>

              <div class="col-xs-6">
               <a href="<?php echo e(URL::to('vendor/forget-password')); ?>" class="btn btn-link"><?php echo app('translator')->get('website.Forgot Password'); ?></a>
              </div>

            </div>
            <?php
            /*
              <br/>
             <div class="row">
              <div class="col-xs-12">
                <b>{{trans("Don't have vendor account yet?")}}</b> <a href="{{ URL::to('vendor/sign-up')}}">{{trans("Click here to create one")}}</a>
              </div>

            </div>
            */
            ?>
          <?php echo Form::close(); ?>


        </div>
      </div>
      
    </div>
 

  <!-- /.login-box-body -->
 
</div>

<?php echo $__env->make('admin.layoutLlogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devhs/public_html/g2g-v3/resources/views/admin/login.blade.php ENDPATH**/ ?>