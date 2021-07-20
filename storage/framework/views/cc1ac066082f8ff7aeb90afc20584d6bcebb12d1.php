<?php $__env->startSection('content'); ?>
  <section class="blog-content">
      <div class="container">
        <div class="blog-area margin_80_55">
          <main class="content-page">
            <div class="bg_color_1">
              <div class="container ">
                <div class="row justify-content-between">
                  <div class="col-lg-12 text-center alert alert-primary">
                    <?php if(empty($customers)): ?>
                        <div class="card text-center">
                          <div class="card-body"> 
                            <h4><?php echo e(trans('website.thank-you-confirm-mail-failed-message')); ?></h4>
                            <h5><?php echo e(trans('website.thank-you-confirm-mail-try-again-text')); ?></h5>
                          </div>
                          <div class="card-footer"><a href="<?php echo e(URL::to('/register')); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website.register'); ?></a></div>
                        </div>
                    <?php elseif(!empty($customers)): ?>
                        <div class="card text-center">
                          <div class="card-body"> 
                            <h5><?php echo e(trans('website.thank-you-confirm-mail-login-text')); ?></h5>
                          </div>
                          <div class="card-footer"><a href="<?php echo e(URL::to('/login')); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website.Login'); ?></a></div>
                        </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </main>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/website/thank-you-sign-up.blade.php ENDPATH**/ ?>