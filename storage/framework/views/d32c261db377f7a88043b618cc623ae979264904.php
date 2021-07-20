<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Detail</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(route('garage.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Garage Detail</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
                          <div class="row">
                              <div class="col-md-12">
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
                                    <div class="alert alert-warning">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>
                                 <?php if(isset($status)): ?>
                                    <div class="alert alert-warning">
                                        <?php echo e($status); ?>

                                    </div>
                                <?php endif; ?>
                              </div>
                            </div>
              
                            <div class="box-body">

                              <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.services.update')); ?>"  enctype="multipart/form-data">
                                
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($garage->id); ?>" />

                                <input type="hidden" name="form_action" value="<?php echo e(!empty($garage_services) ? 'update' : 'insert'); ?>" />


                                
                                  <?php if(isset($catList['subCats'])): ?>
                                 

                                   <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i> Garage Services
                                    </div>
                                    <div class="box-body">


                                    <?php
                                      $cat_id_arr = $sub_cat_id_arr = [];
                                      if($garage_services && count($garage_services->toArray())){
                                        $cat_id =  $garage_services->cat_id;
                                        $sub_cat_id = $garage_services->sub_cat_id;

                                        if(stripos($cat_id , ',') !== false) {
                                           $cat_id_arr[] = explode(',', $cat_id);
                                            $cat_id_arr = array_values($cat_id_arr[0]);
                                        }else{
                                           $cat_id_arr[] = $cat_id;
                                        }

                                       

                                        if(stripos($sub_cat_id , ',') !== false) {
                                           $sub_cat_id_arr[] = explode(',', $sub_cat_id);
                                            $sub_cat_id_arr = array_values($sub_cat_id_arr[0]);
                                        }else{
                                          $sub_cat_id_arr[] = $sub_cat_id;
                                        }

                                       
                                      }
                                      //dump($cat_id_arr);die;
                                     ?>
                                    <div style="padding-left: 30px;">
                                     <?php $__currentLoopData = $catList['mainCats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                      
                                        <br/>
                                      <p class="text-red"><input class="form-check-input" type="checkbox" name="cat_id[]" value="<?php echo e($cat['id']); ?>" <?php if(in_array($cat['id'], $cat_id_arr)): ?> checked <?php endif; ?>><b> Main Category :<?php echo e($cat['name']); ?></b></p>
                                        <?php if(isset($catList['subCats'][$cat['id']])): ?>
                                          <div class="row">
                                           <?php $__currentLoopData = $catList['subCats'][$cat['id']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-sm-12 col-md-4">
                                              <div class="form-check d-inline">
                                                <input class="form-check-input" type="checkbox" name="sub_cat_id[]" value="<?php echo e($subcat['id']); ?>" <?php if(in_array($subcat["id"], $sub_cat_id_arr)): ?> checked <?php endif; ?>> <?php echo e($subcat['name']); ?>

                                              </div>
                                          </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php else: ?>
                                        <p>No Sub Category.</p>
                                        <?php endif; ?>
                                        <div style="clear:both"><br/></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     </div>
                                    </div>
                                  </div>

                                   <?php endif; ?>



                                  
                                  
                                   


                                  
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Update Garage Information</button>
                                 
                                </div>
                                <!-- /.card-footer -->
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
          </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            google.maps.event.addDomListener(window, 'load', initialize);
       });
  

       function initialize() {
       
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());
           });
       }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/garage_services.blade.php ENDPATH**/ ?>