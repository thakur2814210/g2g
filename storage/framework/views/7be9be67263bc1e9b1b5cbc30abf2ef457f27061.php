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
          <li class="breadcrumb-item active"><?php echo app('translator')->get('website.Edit'); ?> <?php echo app('translator')->get('website.Vehicle'); ?></li>
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
            <div class="card">
          <div class="card-header card-header-custom">
            <p class="card-title"><i class="fa fas fa-car"></i> <?php echo app('translator')->get('website.Edit'); ?> <?php echo app('translator')->get('website.Vehicle'); ?>: <?php echo e($vehicles->plate_no); ?></p>
          </div>
         

          <div class="card-body table-responsive p-0">
            <form class="form-horizontal" method="POST" action="<?php echo e(URL::to('/vehicles/update')); ?>">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="id" value="<?php echo e($vehicles->id); ?>">
              <div class="card-body">

                 <div class="row">

                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Plate No'); ?></label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" value="<?php echo e($vehicles->plate_no); ?>" required="required" />
                            </div>
                          </div>
                      </div>

                       <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Make'); ?> ( <?php echo app('translator')->get('website.Selected'); ?> : <?php echo e(!empty($vehicles->vmake->name) ? $vehicles->vmake->name : null); ?>)</label>
                          <div class="col-12">
                            <select class="form-control" name="make" id="make" required="required">
                               <option value=""><?php echo app('translator')->get('website.Select Vehicle Make'); ?></option>
                               <?php $__currentLoopData = $vehicle_makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($make->id); ?>" <?php if($make->id == $vehicles->make): ?> selected <?php endif; ?> data-url="<?php echo e(URL::to('/vehicles/model/' .$make->id )); ?>"  ><?php echo e($make->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Model'); ?> ( *<?php echo app('translator')->get('website.Selected'); ?> : <?php echo e(!empty($vehicles->vmodel->name) ? $vehicles->vmodel->name : null); ?>)</label>
                            <div class="col-12">
                              <select class="form-control" name="model" id="model" required="required">
                                 <option><?php echo app('translator')->get('website.Please wait'); ?></option>
                              </select>
                            </div>
                          </div>
                    </div>

                    
                     
                </div>
               

                <div class="row">

                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Year'); ?></label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="year" id="year" value="<?php echo e($vehicles->year); ?>" required="required" />
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Registration No'); ?></label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" value="<?php echo e($vehicles->registration_no); ?>" />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Chassis No'); ?></label>
                           <div class="col-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" value="<?php echo e($vehicles->chassis_no); ?>"  />
                            </div>
                          </div>
                     </div>

                     
                </div>
               

               

               
                <div class="row">

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Color'); ?></label>
                            <div class="col-12">
                              <input type="text" class="form-control" name="color" id="color" value="<?php echo e($vehicles->color); ?>"  />
                            </div>
                          </div>
                    </div>

                   

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> <?php echo app('translator')->get('website.Current Mileage'); ?></label>
                           <div class="col-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" value="<?php echo e($vehicles->current_mileage); ?>" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-12 col-form-label text-danger"> *<?php echo app('translator')->get('website.Status'); ?></label>
                          <div class="col-12">
                            <select class="form-control" name="status" id="status" required="required">
                              <option value="1"  <?php if( $vehicles->status == 1): ?> selected <?php endif; ?> ><?php echo app('translator')->get('website.Active'); ?></option>
                              <option value="3" <?php if( $vehicles->status == 3): ?> selected <?php endif; ?> ><?php echo app('translator')->get('website.Hold'); ?></option>
                              <option value="2" <?php if( $vehicles->status == 2): ?> selected <?php endif; ?> ><?php echo app('translator')->get('website.Delete'); ?></option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <button type="submit" class="btn btn-danger <?php if( \Config::get('app.locale') == 'en' ): ?> pull-left <?php else: ?> pull-right <?php endif; ?>"><i class="fa fa-save" ></i> <?php echo app('translator')->get('website.Update Vehicle Information'); ?></button>
                </div>

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


<?php $__env->startSection('js'); ?>
  <script type="text/javascript">
    jQuery(document).ready(function ()
    {
      jQuery('select[name="make"]').on('change',function(){
       
         var makeId = jQuery(this).val();
         var dataUrl = jQuery('#make option:selected').attr('data-url');
        jQuery('select[name="model"]').html("<option><?php echo app('translator')->get('website.Please wait'); ?></option>");
        
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

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/vehicles/edit.blade.php ENDPATH**/ ?>