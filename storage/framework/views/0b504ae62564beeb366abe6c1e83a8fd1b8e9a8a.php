<?php $__env->startSection('content'); ?>

<section class="profile-content">
   <div class="container">
         <ol class="breadcrumb padding_bottom">
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('client.dashboard')); ?>"><?php echo app('translator')->get('website.dashboard'); ?></a>
          </li>
           <li class="breadcrumb-item">
            <a href="<?php echo e(route('client.vehicles')); ?>"><?php echo app('translator')->get('website.Vehicle'); ?></a>
          </li>
          <li class="breadcrumb-item active"><?php echo app('translator')->get('website.View'); ?> <?php echo app('translator')->get('website.Vehicle'); ?></li>
        </ol>
        <br/>
     <div class="row">
        
         
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

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-car"></i> <?php echo app('translator')->get('website.View'); ?> <?php echo app('translator')->get('website.Vehicle'); ?></p>
          </div>
         

          <div class="card-body table-responsive p-0">
           
              <div class="card-body">

                 <div class="row">

                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Plate No'); ?></label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="<?php echo e($vehicles->plate_no); ?>" readonly="" />
                            </div>
                          </div>
                      </div>

                       <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Make'); ?></label>
                          <div class="col-12">
                             <input type="text" class="form-control" name="plate_no" id="plate_no" value="<?php echo e($vehicles->vmake->name); ?>" readonly="" />
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Model'); ?> ( <?php echo app('translator')->get('website.Selected'); ?> : <?php echo e($vehicles->vmodel->name); ?>)</label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="<?php echo e($vehicles->vmodel->name); ?>" readonly="" />
                            </div>
                          </div>
                    </div>

                    
                     
                </div>
               

                <div class="row">

                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Year'); ?></label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="year" id="year" value="<?php echo e($vehicles->year); ?>" readonly=""  />
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Registration No'); ?></label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" value="<?php echo e($vehicles->registration_no); ?>" readonly="" />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Chassis No'); ?></label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" value="<?php echo e($vehicles->chassis_no); ?>"  readonly="" />
                            </div>
                          </div>
                     </div>

                     
                </div>
               

               

               
                <div class="row">

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Color'); ?></label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="color" id="color" value="<?php echo e($vehicles->color); ?>"  readonly="" />
                            </div>
                          </div>
                    </div>

                   

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Current Mileage'); ?></label>
                           <div class="col-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" value="<?php echo e($vehicles->current_mileage); ?>" readonly="" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Status'); ?></label>
                          <div class="col-12">
                             <input type="text" class="form-control" name="current_mileage" id="current_mileage" 
                             value="
                              <?php if( $vehicles->status == 1): ?> <?php echo app('translator')->get('website.Active'); ?> <?php endif; ?>
                              <?php if( $vehicles->status == 3): ?> <?php echo app('translator')->get('website.Hold'); ?> <?php endif; ?>
                              <?php if( $vehicles->status == 2): ?> <?php echo app('translator')->get('website.Delete'); ?> <?php endif; ?>
                             " readonly="" />
                          </div>
                        </div>
                    </div>
                </div>

                
            </div>
          </div>
        </div>
    </div>
    </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/vehicles/view.blade.php ENDPATH**/ ?>