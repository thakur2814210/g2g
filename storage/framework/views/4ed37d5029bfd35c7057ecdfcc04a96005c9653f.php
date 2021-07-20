<?php $__env->startSection('content'); ?>

<!-- login Content -->


<section class="page-area pro-content">
	<div class="container"> 

		<div class="row justify-content-center">	   
		  
		
		  <div class="col-12 col-sm-12 col-md-6">
			  
			<div class="col-12 my-5 px-0">

				<div class="justify-content-center">
				<?php if(Session::has('loginError')): ?>
				    <div class="card bg-danger text-white">
                        <div class="card-body">	<?php echo session('loginError'); ?></div>
                     </div>
				<?php endif; ?>

				<?php if(Session::has('success')): ?>
				 <div class="card bg-success text-white">
                    <div class="card-body">	<?php echo session('success'); ?></div>
                  </div>
				<?php endif; ?>

				<?php if( count($errors) > 0): ?>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					     <div class="card bg-danger text-white">
                            <div class="card-body"><?php echo e($error); ?></div>
                         </div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<?php if(Session::has('error')): ?>
				    <div class="card bg-danger text-white">
                        <div class="card-body">	<?php echo session('error'); ?></div>
                     </div>
				<?php endif; ?>

				<?php if(Session::has('email_verified')): ?>
				    <div class="card bg-danger text-white">
                        <div class="card-body">	<?php echo session('email_verified'); ?></div>
                     </div>
                     <div class="col-12 text-center p-3">
                     <a href="<?php echo e(URL::to('/resend-verification-email')); ?>" class="btn btn-outline-secondary"><?php echo app('translator')->get('website.Resend verification email'); ?></a>
                     </div>
				<?php endif; ?>

			</div>
				
				 
				  <div class="tab-content" id="registerTabContent">
					<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">




						<div class="registration-process">
							<div class="col-12 text-center">
								<h4 class="heading login-heading"> <i class="fa fa-universal-access" aria-hidden="true"></i> <?php echo e(trans('labels.login_text')); ?></h4>
								<hr/>
								<br/>
							</div>

						<form  enctype="multipart/form-data"   action="<?php echo e(URL::to('/process-login')); ?>" method="post">
							<?php echo e(csrf_field()); ?>



							<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo app('translator')->get('website.User Type'); ?></label></div>
								 <div class="input-group col-12">
								  <label><input type="radio" name="user_type" value="customer" checked>
								  	&nbsp;<i class="fa fa-users" aria-hidden="true"></i>
								  	<?php echo e(trans('website.customer')); ?></label>
								  &nbsp;&nbsp;&nbsp;&nbsp;
								  <label><input type="radio" name="user_type" value="garage">
								  	&nbsp;<i class="fa fa-building" aria-hidden="true"></i>
								  	<?php echo e(trans('website.Garage/Vendor')); ?></label>
								 </div>
							</div>


							<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo app('translator')->get('website.Email'); ?>/<?php echo app('translator')->get('website.phone'); ?></label></div>
								<div class="input-group col-12">
									<input type="text" name="email" id="email" placeholder="<?php echo app('translator')->get('website.Please enter your valid email address'); ?>"class="form-control">
									<span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>
								</div>
							</div>
						<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup"><i class="fa fa-key" aria-hidden="true"></i> <?php echo app('translator')->get('website.Password'); ?></label></div>
								<div class="input-group col-12">
									<input type="password" name="password" id="password" placeholder="<?php echo e(trans('website.Please Enter Password')); ?>" class="form-control field-validate">
									<span class="help-block" hidden><?php echo app('translator')->get('website.This field is required'); ?></span>										</div>
							</div>
							  <div class="col-12 col-sm-12 text-center">
								  <button class="btn btn-secondary btn-block swipe-to-top"><?php echo app('translator')->get('website.Login'); ?></button>
								<a href="<?php echo e(URL::to('/forgotPassword')); ?>" class="btn btn-link"><?php echo app('translator')->get('website.Forgot Password'); ?></a>

								
							  </div>
						</form>
						</div>
						
					</div>
				  </div>
			</div>
		  </div>

		</div>
	</div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>