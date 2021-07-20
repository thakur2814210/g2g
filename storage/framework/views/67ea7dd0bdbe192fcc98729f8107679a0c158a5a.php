<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
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
            <p class="card-title"><i class="fa fas fa-car"></i> Add Vehicle </p>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

            <form class="form-horizontal" method="POST" action="<?php echo e(URL::to('/vehicles/save')); ?>">
              <?php echo e(csrf_field()); ?>


               <div class="card-body">

                 <div class="row">
                   <div class="col-12">
                      <small class="text-danger">* fields are mandatory </small> 
                  </div>
                </div>


                <div class="row">


                      <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger"> *Plate No</label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" name="plate_no" id="plate_no" placeholder="Enter Plate No" required="required" />
                            </div>
                          </div>
                      </div>

                      <div class="col-4">
                         <div class="form-group">
                          <label for="tag_slug" class="col-12 col-form-label text-danger"> *Make</label>
                          <div class="col-12">
                            <select class="form-control" name="make" id="make" required="required">
                               <option value="">Select Vehicle Make</option>
                               <?php $__currentLoopData = $vehicle_makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($make->id); ?>" data-url="<?php echo e(URL::to('/vehicles/model/' .$make->id )); ?>"  ><?php echo e($make->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="col-4">
                         <div class="form-group">
                            <label for="tag_slug" class="col-12 col-form-label text-danger"> *Model</label>
                            <div class="col-12">
                              <select class="form-control" name="model" id="model" required="required">
                                 <option>PLEASE WAIT . . .</option>
                              </select>
                            </div>
                          </div>
                    </div>

                </div>
               

               

               
                 <div class="row">


                   <div class="col-4">
                      <div class="form-group">
                        <label class="col-sm-12 col-form-label text-danger"> *Year</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="year" id="year" placeholder="Enter Year" required="Year" />
                        </div>
                      </div>
                    </div>

                   <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger">Registration No</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="registration_no" id="registration_no" placeholder="Enter Registration No"  />
                            </div>
                          </div>
                    </div>

                     <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger">Chassis No</label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" name="chassis_no" id="chassis_no" placeholder="Enter Chassis No"  />
                            </div>
                          </div>
                     </div>
                   
                </div>

               
               

               

                <div class="row">

                    <div class="col-4">
                         <div class="form-group">
                            <label class="col-sm-12 col-form-label text-danger">Color</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="color" id="color" placeholder="Enter Color"  />
                            </div>
                          </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-sm-12 col-form-label text-danger">Current Mileage</label>
                           <div class="col-sm-12">
                            <input type="text" class="form-control" name="current_mileage" id="current_mileage" placeholder="Enter Current Mileage" />
                          </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                          <label class="col-sm-12 col-form-label text-danger"> *Status</label>
                          <div class="col-sm-12">
                            <select class="form-control" name="status" id="status" required="required">
                              <option value="1" >Active</option>
                                <option value="2" >Delete</option>
                                <option value="3" >Hold</option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>

               
                <div class="form-group pull-left">
                    <button type="submit" class="btn btn-danger pull-left"><i class="fa fa-save" ></i> Save New Vehicle</button>
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

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/autoshop/vehicles/add.blade.php ENDPATH**/ ?>