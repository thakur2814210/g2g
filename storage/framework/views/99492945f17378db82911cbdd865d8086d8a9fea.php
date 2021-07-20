
<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
     <div class="row">
         <div class="col-12 col-sm-12">
             <div class="row justify-content-end">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="#"><?php echo app('translator')->get('website.Home'); ?></a></li>
                       <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.myProfile'); ?></li>
                     </ol>
                   </nav>
             </div>
         </div>
         <div class="col-12 media-main">
             <div class="media">
                 <img src="<?php echo e(auth()->guard('customer')->user()->avatar); ?>" alt="avatar">
                 <div class="media-body">
                   <div class="row">
                     <div class="col-12 col-sm-4 col-md-6">
                       <h4><?php echo e(auth()->guard('customer')->user()->first_name); ?> <?php echo e(auth()->guard('customer')->user()->last_name); ?><br>
                         <small><?php echo e(auth()->guard('customer')->user()->email); ?> </small></h4>
                     </div>
                     <div class="col-12 col-sm-8 col-md-6 detail">

                       <p>E-mail:<span><a href="#"><?php echo e(auth()->guard('customer')->user()->email); ?></a></span></p>
                     </div>
                     </div>
                 </div>

             </div>
         </div>
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   <?php echo app('translator')->get('website.My Account'); ?>
               </h2>
               <hr >
             </div>

            <?php echo $__env->make('autoshop.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       </div>
       <div class="col-12 col-lg-9 ">
           <div class="heading">
               <h2>
                   <?php echo app('translator')->get('website.Personal Information'); ?>
               </h2>
               <hr >
             </div>
             <form name="updateMyProfile" class="align-items-center" enctype="multipart/form-data" action="<?php echo e(URL::to('updateMyProfile')); ?>" method="post">
               <?php echo csrf_field(); ?>
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

                <?php if(session()->has('error')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session()->get('error')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only"><?php echo app('translator')->get('website.Error'); ?>:</span>
                        <?php echo e(session()->get('error')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only"><?php echo app('translator')->get('website.Error'); ?>:</span>
                        <?php echo session('loginError'); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(session()->has('success') ): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session()->get('success')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="form-group row justify-content-center">
                  <div class="col-12 media-main">
                      <div class="media">
                        <?php if(!empty(auth()->guard('customer')->user()->avatar)): ?>
                            <input type="hidden" name="customers_old_picture" value="<?php echo e(auth()->guard('customer')->user()->avatar); ?>">
                        <?php else: ?>
                          <input type="hidden" name="customers_old_picture" value="">
                        <?php endif; ?>
                          <img style="margin-bottom:-50px;" src="<?php echo e(auth()->guard('customer')->user()->avatar); ?>" alt="avatar">
                          <div class="media-body"style="margin-left:70px; margin-bottom:-50px;">
                            <div class="row">
                              <div class="col-12 col-sm-4 col-md-6">
                                 <input name="picture" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" /><br>
                              </div>
                            </div>
                          </div>

                      </div>
                  </div>
                </div>

                 <div class="form-group row">
                   <label for="firstName" class="col-sm-2 col-form-label"><?php echo app('translator')->get('website.First Name'); ?></label>
                   <div class="col-sm-10">
                     <input type="text" required name="customers_firstname" class="form-control" id="inputName" value="<?php echo e(auth()->guard('customer')->user()->first_name); ?>" placeholder="<?php echo app('translator')->get('website.First Name'); ?>">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="lastName" class="col-sm-2 col-form-label"><?php echo app('translator')->get('website.Last Name'); ?></label>
                   <div class="col-sm-10">
                     <input type="text" required name="customers_lastname" placeholder="<?php echo app('translator')->get('website.Last Name'); ?>" class="form-control field-validate" id="lastName" value="<?php echo e(auth()->guard('customer')->user()->last_name); ?>">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="gender"  class="col-sm-2 col-form-label"><?php echo app('translator')->get('website.Gender'); ?></label>
                     <div class="col-5 col-sm-5">
                         <div class="select-control">
                             <select name="gender" required class="form-control" id="exampleSelectGender1" aria-describedby="genderHelp">
                               <option value="0" <?php if(auth()->guard('customer')->user()->gender == 0): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Male'); ?></option>
                               <option value="1"  <?php if(auth()->guard('customer')->user()->gender == 1): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Female'); ?></option>
                              </select>
                         </div>
                     </div>
                     <div class="col-7 col-sm-5">
                         <div class="input-group date">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-phone"></i></span>
                             </div>
                             <input name="customers_telephone" type="tel"  placeholder="<?php echo app('translator')->get('website.Phone Number'); ?>" value="<?php echo e(auth()->guard('customer')->user()->phone); ?>" class="form-control">
                           </div>
                     </div>

                   </div>
                   <div class="form-group row">
                       <label for="inputPassword" class="col-sm-2 col-form-label"><?php echo app('translator')->get('website.Date of Birth'); ?></label>
                       <div class="col-7 col-sm-5">
                           <div class="input-group date">
                               <input readonly name="customers_dob" type="text" data-provide="datepicker" class="form-control" placeholder="<?php echo app('translator')->get('website.Date of Birth'); ?>" value="<?php echo e(auth()->guard('customer')->user()->dob); ?>" aria-label="date-picker" aria-describedby="date-picker-addon1">

                               <div class="input-group-prepend">
                                   <span class="input-group-text" id="date-picker-addon1"><i class="fas fa-calendar-alt"></i></span>
                                 </div>
                             </div>

                       </div>
                     </div>

                   <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('website.Update'); ?></button>
             </form>

         <!-- ............the end..... -->
       </div>
       <div style="margin-top:20px;"class="col-12 col-lg-9 offset-3 ">
           <div class="heading">
               <h2>
                   <?php echo app('translator')->get('website.Change Password'); ?>
               </h2>
               <hr >
             </div>
             <form name="updateMyPassword" class="" enctype="multipart/form-data" action="<?php echo e(URL::to('/updateMyPassword')); ?>" method="post">
                 <?php echo csrf_field(); ?>
               
                 <div class="form-group row">
                     <label for="new_password" class="col-sm-4 col-form-label"><?php echo app('translator')->get('website.New Password'); ?></label>
                     <div class="col-sm-8">
                         <input name="new_password" type="password" class="form-control" id="new_password" placeholder="<?php echo app('translator')->get('website.New Password'); ?>">
                         <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your password and should be at least 6 characters long'); ?></span>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="confirm_password" class="col-sm-4 col-form-label"><?php echo app('translator')->get('website.Confirm Password'); ?></label>
                     <div class="col-sm-8">
                         <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="<?php echo app('translator')->get('website.Confirm Password'); ?>">
                         <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your password and should be at least 6 characters long'); ?></span>
                     </div>
                 </div>
                 <div class="button">
                     <button type="submit" class="btn btn-dark"><?php echo app('translator')->get('website.Update'); ?></button>
                 </div>
             </form>

         <!-- ............the end..... -->
       </div>
     </div>
   </div>
 </section>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/profile.blade.php ENDPATH**/ ?>