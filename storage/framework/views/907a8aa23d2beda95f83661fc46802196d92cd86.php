<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
        <ol class="breadcrumb padding_bottom">
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('client.dashboard')); ?>"><?php echo app('translator')->get('website.dashboard'); ?></a>
          </li>
           <li class="breadcrumb-item">
            <a href="<?php echo e(route('client.vehicles')); ?>"><?php echo app('translator')->get('website.Vehicle'); ?></a>
          </li>
          <li class="breadcrumb-item active"><?php echo app('translator')->get('website.Add'); ?> <?php echo app('translator')->get('website.Vehicle'); ?></li>
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

          <div class="box_general">
            <div class="row">
      <div class="col-12">
        <div class="card">
         <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-car"></i> <?php echo app('translator')->get('website.Add'); ?> <?php echo app('translator')->get('website.Vehicle'); ?> </p>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

            <form class="form-horizontal" method="POST" action="<?php echo e(URL::to('/vehicles/save')); ?>">
              <?php echo e(csrf_field()); ?>


               <div class="card-body">

                 <div class="row">
                   <div class="col-12">
                      <p class="text-danger">* <?php echo app('translator')->get('website.fields are mandatory'); ?> </p> 
                  </div>
                </div>


                <div class="row">


                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Plate No'); ?></label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" placeholder="<?php echo app('translator')->get('website.Enter Plate No'); ?>" required="required" />
                            </div>
                          </div>
                      </div>

                      <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Make'); ?></label>
                          <div class="col-12">
                            <select class="form-control" name="make" id="make" required="required">
                               <option value=""><?php echo app('translator')->get('website.Select Vehicle Make'); ?></option>
                               <?php $__currentLoopData = $vehicle_makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($make->id); ?>" data-url="<?php echo e(URL::to('/vehicles/model/' .$make->id )); ?>"  ><?php echo e($make->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Model'); ?></label>
                            <div class="col-12">
                              <select class="form-control" name="model" id="model" required="required">
                                 <option><?php echo app('translator')->get('website.Please wait'); ?> </option>
                              </select>
                            </div>
                          </div>
                    </div>

                </div>
               

               

               
                 <div class="row">


                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-sm-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Year'); ?></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="year" id="year" placeholder="<?php echo app('translator')->get('website.Enter Year'); ?>" required="Year" />
                        </div>
                      </div>
                    </div>

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger"><?php echo app('translator')->get('website.Registration No'); ?></label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" placeholder="<?php echo app('translator')->get('website.Enter Registration No'); ?>"  />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger">><?php echo app('translator')->get('website.Chassis No'); ?></label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" placeholder="<?php echo app('translator')->get('website.Enter Chassis No'); ?>"  />
                            </div>
                          </div>
                     </div>
                   
                </div>

               
               

               

                <div class="row">

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger"><?php echo app('translator')->get('website.Color'); ?></label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="color" id="color" placeholder="<?php echo app('translator')->get('website.Enter Color'); ?>"  />
                            </div>
                          </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-sm-12 col-form-label text-danger">><?php echo app('translator')->get('website.Current Mileage'); ?></label>
                           <div class="col-sm-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" placeholder="<?php echo app('translator')->get('website.Enter Current Mileage'); ?>" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-sm-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Status'); ?></label>
                          <div class="col-sm-12">
                            <select class="form-control" name="status" id="status" required="required">
                              <option value="1" ><?php echo app('translator')->get('website.Active'); ?></option>
                                <option value="2" ><?php echo app('translator')->get('website.Delete'); ?></option>
                                <option value="3" ><?php echo app('translator')->get('website.Hold'); ?></option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>

               
                <div class="form-group">
                    <button type="submit" class="btn btn-danger <?php if( \Config::get('app.locale') == 'en' ): ?> pull-left <?php else: ?> pull-right <?php endif; ?>"><i class="fa fa-save" ></i> <?php echo app('translator')->get('website.Save New Vehicle'); ?></button>
                </div>
          </form>
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

<?php $__env->startSection('js'); ?>
  <script type="text/javascript">
    jQuery(document).ready(function ()
    {
      jQuery('select[name="make"]').on('change',function(){
       
         var makeId = jQuery(this).val();
         var dataUrl = jQuery('#make option:selected').attr('data-url');
        jQuery('select[name="model"]').html('<option>PLEASE WAIT . . .</option>');
        
        // tis url not working on live
         if(makeId){
            jQuery.ajax({
               url : dataUrl,
               type : "GET",
               dataType : "json",
               success:function(data)
               {
                  jQuery('select[name="model"]').empty();
                  jQuery.each(data, function(key,value){
                     jQuery('select[name="model"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
               }
            });
         }
         else{
          jQuery('select[name="state"]').empty();
         }
      });
    });
  </script>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/vehicles/add.blade.php ENDPATH**/ ?>