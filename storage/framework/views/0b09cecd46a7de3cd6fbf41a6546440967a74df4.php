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
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php echo e(trans('labels.Create new vendor account here')); ?></p>

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

        <form name="signup" class="form-validate" enctype="multipart/form-data"  action="<?php echo e(URL::to('/signupProcess')); ?>" method="post">
                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                  <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.First Name'); ?></label>
                  <div class="input-group  col-md-12">
                    <input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('firstName')); ?>">
                    
                  </div>
                </div>


                <div class="form-group">
                  <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Last Name'); ?></label>
                  <div class="input-group  col-md-12">                    
                    <input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('lastName')); ?>">
                    <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your last name'); ?></span>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Email Adrress'); ?></label>
                    <div class="input-group col-md-12">
                      <input  name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter Your Email or Username" value="<?php echo e(old('email')); ?>">
                      <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Password'); ?></label>
                      <div class="input-group col-md-12">
                        <input name="password" id="password" type="password" class="form-control"  placeholder="<?php echo app('translator')->get('website.Please enter your password'); ?>">
                        <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your password'); ?></span>

                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Confirm Password'); ?></label>
                        <div class="input-group col-md-12">
                          <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Enter Your Password">
                          <span class="help-block" hidden><?php echo app('translator')->get('website.Please re-enter your password'); ?></span>
                          <span class="help-block" hidden><?php echo app('translator')->get('website.Password does not match the confirm password'); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                       <label for="inlineFormInputGroup"><strong  style="color: red;">*</strong><?php echo app('translator')->get('website.Gender'); ?></label>
                        <div class="input-group col-md-12">
                          <select class="form-control field-validate" name="gender" id="inlineFormCustomSelect">
                            <option selected value=""><?php echo app('translator')->get('website.Choose...'); ?></option>
                            <option value="0" <?php if(!empty(old('gender')) and old('gender')==0): ?> selected <?php endif; ?>)><?php echo app('translator')->get('website.Male'); ?></option>
                            <option value="1" <?php if(!empty(old('gender')) and old('gender')==1): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Female'); ?></option>
                          </select>
                          <span class="help-block" hidden><?php echo app('translator')->get('website.Please select your gender'); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group col-md-12">
                            <input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
                            <?php echo app('translator')->get('website.Creating an account means you are okay with our'); ?>  <?php if(!empty($result['commonContent']['pages'][3]->slug)): ?>&nbsp;<a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Terms and Services'); ?><?php if(!empty($result['commonContent']['pages'][3]->slug)): ?></a><?php endif; ?>, <?php if(!empty($result['commonContent']['pages'][1]->slug)): ?><a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Privacy Policy'); ?><?php if(!empty($result['commonContent']['pages'][1]->slug)): ?></a> <?php endif; ?> &nbsp; and &nbsp; <?php if(!empty($result['commonContent']['pages'][2]->slug)): ?><a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Refund Policy'); ?> <?php if(!empty($result['commonContent']['pages'][3]->slug)): ?></a><?php endif; ?>.
                            <span class="help-block" hidden><?php echo app('translator')->get('website.Please accept our terms and conditions'); ?></span>
                          </div>
                        </div>
                         <button type="submit" class="btn btn-primary btn-bllock"><?php echo app('translator')->get('website.Create an Account'); ?></button>
                  
              </form>

  </div>

  <!-- /.login-box-body -->
</div>
<?php echo $__env->make('admin.layoutLlogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/vendor_sign_up.blade.php ENDPATH**/ ?>