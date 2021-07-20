<?php $__env->startSection('content'); ?>
<!-- contact Content -->
<section class="contact-content contact-two-content">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12">
          <div class="row justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>

                  <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.Contact Us'); ?></li>
                </ol>
              </nav>
          </div>
      </div>
      <div class="col-12 col-sm-12">
        <div class="row">
            <div class="col-12 col-lg-8">
              <div class="form-start">
                <?php if(session()->has('success') ): ?>
                   <div class="alert alert-success">
                       <?php echo e(session()->get('success')); ?>

                   </div>
                <?php endif; ?>
                  <form enctype="multipart/form-data" action="<?php echo e(URL::to('/processContactUs')); ?>" method="post">
                    <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden">

                    <label class="first-label" for="email"><?php echo app('translator')->get('website.Full Name'); ?></label>
                    <div class="input-group">

                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo app('translator')->get('website.Please enter your name'); ?>" aria-describedby="inputGroupPrepend" required>
                        <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your name'); ?></span>
                    </div>
                    <label for="email"><?php echo app('translator')->get('website.Email'); ?></label>
                    <div class="input-group">

                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="email"  name="email" class="form-control" id="validationCustomUsername" placeholder="Enter Email here.." aria-describedby="inputGroupPrepend" required>
                        <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>

                    </div>
                    <label for="email"><?php echo app('translator')->get('website.Message'); ?></label>
                    <textarea type="text" name="message"  placeholder="write your message here..." rows="5" cols="56"></textarea>
                    <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your message'); ?></span>
                    <button type="submit" class="btn btn-secondary"><?php echo app('translator')->get('website.Send'); ?> <i class="fas fa-location-arrow"></i></button>
                  </form>
              </div>
          </div>
          <div class="col-12 col-lg-4 contact-main">
            <div class="row">
              <div class="col-12">
                  <ul class="contact-logo">
                    <li> <i class="fas fa-mobile-alt"></i><br>CONTACT US<br/>
                        Mobile: <?php echo e($contactusinfo->phone); ?><br/>
                        Office: <?php echo e($contactusinfo->mobile); ?>

                    </li>
                     <br/><br/>
                    <li> <i class="fas fa-map-marker"></i><br>ADDRESS <br/>
                      <?php echo e(( \Config::get('app.locale') == 'en' ) ? $contactusinfo->address_en : $contactusinfo->address_ar); ?>

                    </li>
                    <br/><br/>
                    <li> <i class="fas fa-envelope"></i><br>EMAIL ADDRESS<br/> 
                    <a href="mailto:<?php echo e($contactusinfo->email); ?>"><?php echo e($contactusinfo->email); ?></a></li>
                   
                  </ul>
              </div>
            </div>


             <p style="margin-top:30px;">
              <?php echo e($result['commonContent']['setting'][112]->value); ?>

             </p>
          </div>


        </div>
      </div>
    </div>

  </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/website/contact-us.blade.php ENDPATH**/ ?>