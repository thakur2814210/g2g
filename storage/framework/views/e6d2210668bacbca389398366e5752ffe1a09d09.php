<?php $__env->startSection('content'); ?>


  <main>
    <div class="container p-2">
        <div class="container-fluid">
            <div class="card  text-white">
              <div class="card-header bg-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error!</div>
              <div class="card-body">
                 <div class="row">
                    <div class="col-12 text-center">
                          <div class="alert alert-danger">
                              <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo e($message); ?>

                          </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
  </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Client/Resources/views/error.blade.php ENDPATH**/ ?>