<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<main style="padding-top: 5%;">

		<div class="container margin_60">
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">SuperAdmin Dashboard Login Here</h3>
					<form action="<?php echo e(route('superadmin.authenticate')); ?>" method="post">
                    	<?php echo e(csrf_field()); ?>

						<div class="form_container">

							<?php if($errors->any() || session('status')): ?>
						       <div class="row">
						          <div class="col-12">
						            <?php if($errors->any()): ?>
						                <div class="alert alert-danger">
						                    <ul>
						                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                            <li><?php echo e($error); ?></li>
						                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                    </ul>
						                </div>
						            <?php endif; ?>
						             <?php if(session('status')): ?>
						                  <div class="alert alert-danger">
						                      <?php echo e(session('status')); ?>

						                  </div>
						              <?php endif; ?>
						          </div>
						        </div>
						     <?php endif; ?>

							<div class="form-group mb-3">
		                        <input id="email" type="text" class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" placeholder="Enter Email Or Phone" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
		                        <!--input type="email" name="email" class="form-control " value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('adminlte::adminlte.email')); ?>" autofocus-->
		                        <?php if($errors->has('email')): ?>
		                            <div class="invalid-feedback">
		                                <?php echo e($errors->first('email')); ?>

		                            </div>
		                        <?php endif; ?>
		                    </div>
		                    <div class="form-group mb-3">
		                        <input type="password" name="password" class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(__('adminlte::adminlte.password')); ?>">
		                        <?php if($errors->has('password')): ?>
		                            <div class="invalid-feedback">
		                                <?php echo e($errors->first('password')); ?>

		                            </div>
		                        <?php endif; ?>
		                    </div>

							<div class="clearfix add_bottom_15">
								<div class="checkboxes float-left">
									<label class="container_check">Remember me
										<input type="checkbox" name="remember" id="remember">
										<span class="checkmark"></span>
									</label>
								</div>
								
							</div>

							<div class="text-center">
								<input type="submit" value="Log In" class="btn_1 full-width">
							</div>
						</div>
					</form>
				</div>
				
			</div>
		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
	
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website::layouts.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Website/Resources/views/auth/superadmin.blade.php ENDPATH**/ ?>