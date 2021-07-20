<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<main style="padding-top: 5%">

		<div class="container margin_60">
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-6 col-md-8">
					<div class="card">
			          <div class="card-header p-0 text-center" style="padding:0px;">
			            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="pills-signin-tab" data-toggle="pill" href="#pills-signin" role="tab" aria-controls="pills-signin" aria-selected="true"><i class="fa fas fa-sign-in"></i> <?php echo app('translator')->get('website::default.garage'); ?> <?php echo app('translator')->get('website::default.sign_in'); ?></a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="pills-register-tab" data-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false"><i class="fa fas fa-registered"></i> <?php echo app('translator')->get('website::default.garage'); ?> <?php echo app('translator')->get('website::default.register'); ?></a>
						  </li>
						</ul>
			          </div>

			        <div class="card-body table-responsive p-3">

						<div class="tab-content" id="pills-tabContent">
						  
							<div class="tab-pane fade show active" id="pills-signin" role="tabpanel" aria-labelledby="pills-signin-tab">

								<div class="box_account">
									<h3 class="client"><?php echo app('translator')->get('website::default.already_account'); ?></h3>
									<form action="<?php echo e(route('garage.authenticate')); ?>" method="post">
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
										                  <div class="alert alert-success">
										                      <?php echo e(session('status')); ?>

										                  </div>
										              <?php endif; ?>
										          </div>
										        </div>
										     <?php endif; ?>

											<div class="form-group mb-3">
						                        <input id="email" type="text" class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" placeholder="<?php echo app('translator')->get('website::default.enter_email_phone'); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
						                        <!--input type="email" name="email" class="form-control " value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('adminlte::adminlte.email')); ?>" autofocus-->
						                        <?php if($errors->has('email')): ?>
						                            <div class="invalid-feedback">
						                                <?php echo e($errors->first('email')); ?>

						                            </div>
						                        <?php endif; ?>
						                    </div>
						                    <div class="form-group mb-3">
						                        <input type="password" name="password" class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>" placeholder="<?php echo app('translator')->get('website::default.password'); ?>">
						                        <?php if($errors->has('password')): ?>
						                            <div class="invalid-feedback">
						                                <?php echo e($errors->first('password')); ?>

						                            </div>
						                        <?php endif; ?>
						                    </div>

											<div class="clearfix add_bottom_15">
												<div class="checkboxes float-left">
													<label class="container_check"><?php echo app('translator')->get('website::default.remember_me'); ?>
														<input type="checkbox" name="remember" id="remember">
														<span class="checkmark"></span>
													</label>
												</div>
												<div class="float-right"><a id="forgot" href="javascript:void(0);"><?php echo app('translator')->get('website::default.lost_password'); ?></a></div>
											</div>

											<div class="text-center">
												<input type="submit" value="<?php echo app('translator')->get('website::default.sign_in'); ?>" class="btn_1 full-width">
											</div>
											
											<!--div id="forgot_pw">
												<div class="form-group">
													<input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
												</div>
												<p>A new password will be sent shortly.</p>
												<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
											</div-->

										</div>
									</form>
								</div>
							</div>
						  
							<div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
								<div class="box_account">
									<h3 class="new_client"><?php echo app('translator')->get('website::default.register_account'); ?></h3> <small class="float-right pt-2">* <?php echo app('translator')->get('website::default.required_fields'); ?></small>
									<div class="form_container">
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
									      </div>
									    </div>
										<form action="<?php echo e(route('garage.register')); ?>" method="post">
											<?php echo e(csrf_field()); ?>

											<div class="form-group">
												<input type="text" class="form-control" name="username" id="username" placeholder="* <?php echo app('translator')->get('website::default.username'); ?>" value="<?php echo e(Request::old('name')); ?>" required="">
											</div>
											<div class="form-group">
												<input type="email" class="form-control" name="email" id="email" placeholder="* <?php echo app('translator')->get('website::default.email'); ?>" value="<?php echo e(Request::old('email')); ?>" required="">
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" id="password" value="<?php echo e(Request::old('password')); ?>" placeholder="* <?php echo app('translator')->get('website::default.password'); ?>" required="">
											</div>
											
											<div class="row ">
												<div class="col-3">
													<div class="form-group">
														<input type="text" class="form-control"  value="971-5" readonly="">
													</div>
												</div>
												<div class="col-9">
													<div class="form-group">
														<input type="number" class="form-control" name="phone" id="phone" max="8" min="8" value="" placeholder="* <?php echo app('translator')->get('website::default.enter_phone'); ?>" value="<?php echo e(Request::old('phone')); ?>" required="">
													</div>
												</div>
											</div>

											<div class="form-group">
												<input type="text" class="form-control" name="name" id="name" value="" placeholder="* <?php echo app('translator')->get('website::default.garage_name'); ?>" value="<?php echo e(Request::old('garage_name')); ?>" required="">
											</div>

											 <div class="form-group">
								               <div class="card shadow">
								                        <div class="card-body">
								                            <div class="form-group">
								                                <label for="autocomplete">* Location/City/Address </label>
								                                <input type="text"  name="address" id="autocomplete" class="form-control" placeholder="Select Location" required="">
								                            </div>

								                            <div class="form-group" id="lat_area">
								                                <label for="latitude">* Latitude </label>
								                                <input type="text" name="latitude" id="latitude" class="form-control" readonly="" required="">
								                            </div>

								                            <div class="form-group" id="long_area">
								                                <label for="latitude">* Longitude </label>
								                                <input type="text" name="longitude" id="longitude" class="form-control" readonly="" required="">
								                            </div>

								                            <div class="form-group">
																<select class="form-control" name="city_id" id="city_id" required="required">
															      <option value="">* Select City</option>
															      <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															        <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
															      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															    </select>
															</div>

															<div class="form-group">
																<select class="form-control" name="country_id" id="country_id" required="required">
															      <option value="">* Select Country</option>
															      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
															      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															    </select>
															</div>

															<div class="form-group">
																  <input type="number" class="form-control" name="postal" placeholder="* <?php echo app('translator')->get('website::default.enter_postal'); ?>" required="" />
															</div>
								                        </div>
								                    </div>
								              </div>

										
											<div style="clear:both"></div>
											<div class="form-group">
												<label class="container_check"><?php echo app('translator')->get('website::default.accept'); ?> <a href="<?php echo e(route('page.term-and-condtions')); ?>" target="_blank"><?php echo app('translator')->get('website::default.terms_and_conditions'); ?></a>
													<input type="checkbox">
													<span class="checkmark"></span>
												</label>
											</div>
											<div class="text-center">
												<input type="submit" value="<?php echo app('translator')->get('website::default.register'); ?>" class="btn_1 full-width">
											</div>
										</form>
									</div>
									<!-- /form_container -->
								</div>	
							</div>
							<!-- /box_account -->
								<div class="row hidden_tablet">
									<div class="col-md-6">
										<ul class="list_ok">
											<li><?php echo app('translator')->get('website::default.feature_1'); ?></li>
											<li><?php echo app('translator')->get('website::default.feature_2'); ?></li>
											<li><?php echo app('translator')->get('website::default.feature_3'); ?></li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list_ok">
											<li><?php echo app('translator')->get('website::default.feature_4'); ?></li>
											<li><?php echo app('translator')->get('website::default.feature_5'); ?></li>
										</ul>
									</div>
								</div>
						</div>
			        </div>
			    </div>
			</div>
		</div>
	</main>
	
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>

	<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&language=<?php echo e($language); ?>" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
            google.maps.event.addDomListener(window, 'load', initialize);
       });
  

       function initialize() {
       
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('website::layouts.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Website/Resources/views/auth/garage.blade.php ENDPATH**/ ?>