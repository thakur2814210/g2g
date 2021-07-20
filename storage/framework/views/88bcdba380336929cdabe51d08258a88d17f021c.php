<!-- login Content -->
<div class="container-fuild">
	<nav aria-label="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
			  <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.Login'); ?></li>

			</ol>
		</div>
	  </nav>
  </div> 

<section class="page-area pro-content">
	<div class="container">


			<div class="row">
				<div class="col-12 col-sm-12 col-md-6">
					<?php if(Session::has('loginError')): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class=""><?php echo app('translator')->get('website.Error'); ?>:</span>
									<?php echo session('loginError'); ?>


									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
					<?php endif; ?>
					<?php if(Session::has('success')): ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class=""><?php echo app('translator')->get('website.success'); ?>:</span>
									<?php echo session('success'); ?>


									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
					<?php endif; ?>
					<div class="col-12"><h4 class="heading login-heading"><?php echo app('translator')->get('website.LOGIN'); ?></h4></div>
					<div class="registration-process">

						<form  enctype="multipart/form-data"   action="<?php echo e(URL::to('/process-login')); ?>" method="post">
							<?php echo e(csrf_field()); ?>

								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup"><?php echo app('translator')->get('website.Email'); ?></label></div>
									<div class="input-group col-12">
										<input type="email" name="email" id="email" placeholder="<?php echo app('translator')->get('website.Please enter your valid email address'); ?>"class="form-control email-validate">
										<span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>
								 </div>
								</div>
								<div class="from-group mb-3">
										<div class="col-12"> <label for="inlineFormInputGroup"><?php echo app('translator')->get('website.Password'); ?></label></div>
										<div class="input-group col-12">
											<input type="password" name="password" id="password" placeholder="Please Enter Password" class="form-control field-validate">
											<span class="help-block" hidden><?php echo app('translator')->get('website.This field is required'); ?></span>										</div>
									</div>

									<div class="col-12 col-sm-12">
										<button type="submit" class="btn btn-secondary"><?php echo app('translator')->get('website.Login'); ?></button>
									<a href="<?php echo e(URL::to('/forgotPassword')); ?>" class="btn btn-link"><?php echo app('translator')->get('website.Forgot Password'); ?></a>
									
								</div>
						</form>
					</div>
				</div>

				<div class="col-12 col-sm-12 col-md-6">
						<div class="col-12"><h4 class="heading login-heading"><?php echo app('translator')->get('website.NEW CUSTOMER'); ?></h4></div>
						<div class="registration-process">
							<?php if( count($errors) > 0): ?>
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
										<span class="sr-only"><?php echo app('translator')->get('website.Error'); ?>:</span>
										<?php echo e($error); ?>

										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>

							<?php if(Session::has('error')): ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only"><?php echo app('translator')->get('website.Error'); ?>:</span>
									<?php echo session('error'); ?>


									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif; ?>

							<form name="signup" enctype="multipart/form-data"  action="<?php echo e(URL::to('/signupProcess')); ?>" method="post">
								<?php echo e(csrf_field()); ?>

								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.First Name'); ?></label></div>
									<div class="input-group col-12">
										<input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('firstName')); ?>">
										<span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your first name'); ?></span>
									</div>
								</div>
								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Last Name'); ?></label></div>
									<div class="input-group col-12">										
										<input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('lastName')); ?>">
										<span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your last name'); ?></span>
									</div>
								</div>
									<div class="from-group mb-3">
										<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Email Adrress'); ?></label></div>
										<div class="input-group col-12">
											<input  name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter Your Email or Username" value="<?php echo e(old('email')); ?>">
											<span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>
										</div>
									</div>
									<div class="from-group mb-3">
											<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Password'); ?></label></div>
											<div class="input-group col-12">
												<input name="password" id="password" type="password" class="form-control"  placeholder="<?php echo app('translator')->get('website.Please enter your password'); ?>">
												<span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your password'); ?></span>

											</div>
										</div>
										<div class="from-group mb-3">
												<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Confirm Password'); ?></label></div>
												<div class="input-group col-12">
													<input type="password" class="form-control" id="re_password" name="re_password" placeholder="Enter Your Password">
													<span class="help-block" hidden><?php echo app('translator')->get('website.Please re-enter your password'); ?></span>
													<span class="help-block" hidden><?php echo app('translator')->get('website.Password does not match the confirm password'); ?></span>
												</div>
											</div>
											<div class="from-group mb-3">
												<div class="col-12" > <label for="inlineFormInputGroup"><strong  style="color: red;">*</strong><?php echo app('translator')->get('website.Gender'); ?></label></div>
												<div class="input-group col-12">
													<select class="form-control field-validate" name="gender" id="inlineFormCustomSelect">
														<option selected value=""><?php echo app('translator')->get('website.Choose...'); ?></option>
														<option value="0" <?php if(!empty(old('gender')) and old('gender')==0): ?> selected <?php endif; ?>)><?php echo app('translator')->get('website.Male'); ?></option>
														<option value="1" <?php if(!empty(old('gender')) and old('gender')==1): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Female'); ?></option>
													</select>
													<span class="help-block" hidden><?php echo app('translator')->get('website.Please select your gender'); ?></span>
												</div>
											</div>
											<div class="from-group mb-3">
													<div class="input-group col-12">
														<input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
														<?php echo app('translator')->get('website.Creating an account means you are okay with our'); ?>  &nbsp;<a href="<?php echo e(route('page.term-and-condtions')); ?>" target="_blank"><?php echo app('translator')->get('website.Terms and Services'); ?></a>
														<span class="help-block" hidden><?php echo app('translator')->get('website.Please accept our terms and conditions'); ?></span>
													</div>
												</div>
										<div class="col-12 col-sm-12">
												<button type="submit" class="btn btn-light swipe-to-top"><?php echo app('translator')->get('website.Create an Account'); ?></button>

										</div>
							</form>
						</div>
				</div>
				
			</div>

	</div>
</section>
<?php /**PATH /home/g2g/public_html/resources/views/auth/logins/login1.blade.php ENDPATH**/ ?>