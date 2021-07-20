<?php $__env->startSection('content'); ?>

<!-- page Content -->
<section class="page-area">
  <div class="container">
      <div class="row justify-content-center">
         
        <div class="col-12 col-sm-12 col-md-6">
            <div class="col-12 my-5">
                <div class="card ">
                    <div class="card-header text-center" style="background:#cc0000;color:#fff">
                      <h4 style="margin:0px"><?php echo e(trans('website.Resend verification email')); ?></h4>
                    </div>
                    <div class="card-body"> 
                         <?php if(Session::has('error')): ?>
                            <div class="card bg-danger text-white">
                                <div class="card-body">	<?php echo session('error'); ?></div>
                            </div>
                            <br/>
                         <?php endif; ?>
                        
                  	    <?php if( count($errors) > 0): ?>
            				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            				 <div class="card bg-danger text-white">
                                <div class="card-body"><?php echo e($error); ?></div>
                            </div>
            				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            				<br/>
            			<?php endif; ?>
                         <form name="signup" enctype="multipart/form-data" class="form-validate"  action="<?php echo e(URL::to('/processResendVerificationEmail')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                              <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><?php echo app('translator')->get('website.Email'); ?></label></div>
                                <div class="input-group col-12">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                  </div>
                                  <input class="form-control" type="email" name="email" id="email"placeholder="<?php echo app('translator')->get('website.Please enter your valid email address'); ?>">
                                  <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>                            </div>
                              </div>
                                <div class="col-12 col-sm-12">
                                    <button type="submit"  class="btn-block btn btn-secondary"><?php echo app('translator')->get('website.Send'); ?></button>
                                </div>
                          </form>
                    </div>
                </div>
          </div>
        </div>

      </div>
  </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/auth/resend_email_verification.blade.php ENDPATH**/ ?>