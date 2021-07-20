

<?php $__env->startSection('content'); ?>


<section class="page-area pro-content">
    <div class="container">
        <div class="row justify-content-center
            <div class="col-12 col-sm-12 col-md-12 justify-content-center" style"padding-top:30px;">
                <?php if(empty($customers)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class=""><?php echo app('translator')->get('website.Error'); ?>:</span>
                       <?php echo app('translator')->get('website.failedConfirmEmail'); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php elseif(!empty($customers)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class=""><?php echo app('translator')->get('website.success'); ?>:</span>
                        
                        <?php echo app('translator')->get('website.successConfirmEmail'); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
    
            
<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/auth/email_verify.blade.php ENDPATH**/ ?>