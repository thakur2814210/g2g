<?php $__env->startSection('title', 'Client Dashboard'); ?>

<?php $__env->startSection('website_css'); ?>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

   <ol class="breadcrumb padding_bottom">
      <li class="breadcrumb-item">
        <a href="<?php echo e(route('client.dashboard')); ?>">Dashboard</a>
      </li>
       <li class="breadcrumb-item">
        <a href="<?php echo e(route('client.vehicles')); ?>">Vehicles</a>
      </li>
      <li class="breadcrumb-item active">Add Vehicle</li>
    </ol>
   
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
            <p class="card-title"><i class="fa fas fa-car"></i> Add Vehicle </p>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

            <form class="form-horizontal" method="POST" action="<?php echo e(route('client.vehicle.save')); ?>">
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
                                <option value="<?php echo e($make->id); ?>" data-url="<?php echo e(route('client.vehicle.model',['id' => $make->id])); ?>"  ><?php echo e($make->name); ?></option>
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

               
                <div class="form-group row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Save New Vehicle</button>
                     <button type="reset" class="btn btn-success float-right"><i class="fa fa-times" ></i> Reset</button>
                  </div>
                </div>
          </form>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>
  <script type="text/javascript">
    $(document).ready(function ()
    {
      $('select[name="make"]').on('change',function(){
         var makeId = $(this).val();
         var dataUrl = $('#make option:selected').attr('data-url');
        $('select[name="model"]').html('<option>PLEASE WAIT . . .</option>');
        
        // tis url not working on live
         if(makeId){
            $.ajax({
               url : dataUrl,
               type : "GET",
               dataType : "json",
               success:function(data)
               {
                  $('select[name="model"]').empty();
                  $.each(data, function(key,value){
                     $('select[name="model"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
               }
            });
         }
         else{
          $('select[name="state"]').empty();
         }
      });
    });
  </script>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Client/Resources/views/vehicle/add.blade.php ENDPATH**/ ?>