<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Working Hours</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.active')); ?>">Active Garage/Vendor</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.pending')); ?>">Pending Garage/Vendor</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garage/Vendor</a>
        </li>
        
      <li class="active">Garage Working Hours</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
               <div class="box-header">
                 <ul class="nav table-nav pull-right">
                    <li class="dropdown btn-danger">
                        <a class="dropdown-toggle btn-info btn-sm" data-toggle="dropdown" href="#">
                            Garage Information <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.edit',['id' => $garage->id])); ?>">Information</a></li>

                              <li role="presentation" class="divider"></li>

                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.working-hours.view',['id' => $garage->id])); ?>">Working Hours</a></li>

                              <li role="presentation" class="divider"></li>

                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.services.view',['id' => $garage->id])); ?>">Services</a></li>

                              <li role="presentation" class="divider"></li>

                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.team.view',['id' => $garage->id])); ?>">Members</a></li>

                              <li role="presentation" class="divider"></li>

                               <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.image.view',['id' => $garage->id])); ?>">Images</a></li>

                              <li role="presentation" class="divider"></li>
                              
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.video.view',['id' => $garage->id])); ?>">Videos</a></li>
                          </ul>
                    </li>
                </ul>
                   
                </div>
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

                              <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.garage.working-hours.update')); ?>"  enctype="multipart/form-data">
                                
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($garage->id); ?>" />

                                 <input type="hidden" name="form_action" value="<?php echo e(!empty($garage_working_hours) ? 'update' : 'insert'); ?>" />

                                <div class="box-body">


                               
                                    <?php
                                    $days = [
                                        'mon' => 'Monday',
                                        'tue' => 'Tuesday',
                                        'wed' => 'Wednessday',
                                        'thu' => 'Thrusday',
                                        'fri' => 'Friday',
                                        'sat' => 'Saturday',
                                        'sun' => 'Sunday',
                                      ];
                                      $optionTime = [
                                        'Closed', 
                                        '12:00 AM',
                                        '00:30 AM',
                                        '01:00 AM',
                                        '01:30 AM',
                                        '02:00 AM',
                                        '02:30 AM',
                                        '03:00 AM',
                                        '03:30 AM',
                                        '04:00 AM',
                                        '04:30 AM',
                                        '05:00 AM',
                                        '05:30 AM',
                                        '06:00 AM',
                                        '06:30 AM',
                                        '07:00 AM',
                                        '07:30 AM',
                                        '08:00 AM',
                                        '08:30 AM',
                                        '09:00 AM',
                                        '09:30 AM',
                                        '10:00 AM',
                                        '10:30 AM',
                                        '11:00 AM',
                                        '11:30 AM',
                                        '12:00 PM',
                                        '00:30 PM',  
                                        '01:00 PM',
                                        '01:30 PM',
                                        '02:00 PM',
                                        '02:30 PM',
                                        '03:00 PM',
                                        '03:30 PM',
                                        '04:00 PM',
                                        '04:30 PM',
                                        '05:00 PM',
                                        '05:30 PM',
                                        '06:00 PM',
                                        '06:30 PM',
                                        '07:00 PM',
                                        '07:30 PM',
                                        '08:00 PM',
                                        '08:30 PM',
                                        '09:00 PM',
                                        '09:30 PM',
                                        '10:00 PM',
                                        '10:30 PM',
                                        '11:00 PM',
                                        '11:30 PM',
                                      ];
                                 ?>

                                  <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                   
                                      <?php
                                        $open_time = $close_time = null;
                                        if(!empty($garage_working_hours) && isset($garage_working_hours[$index])){
                                          $tims_str = $garage_working_hours[$index];
                                          if (strpos($tims_str, '-') !== FALSE){
                                            $time_arr = explode("-",$tims_str);
                                            $open_time = $time_arr[0];
                                            $close_time = $time_arr[1];
                                          }else{
                                            $open_time = $tims_str;
                                            $close_time = $tims_str;
                                          }
                                        }
                                      ?>
                                    <!-- /row-->
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label class="fix_spacing"><?php echo e($day); ?></label>
                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                          <select name="ot_<?php echo e($index); ?>" class='form-control' required>
                                            <?php $__currentLoopData = $optionTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($value); ?>" <?php if(strcasecmp($open_time, $value) == 0): ?> selected="selected" <?php endif; ?>><?php echo e($value); ?></option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                       <div class="col-md-1"></div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                           <select name="ct_<?php echo e($index); ?>" class='form-control' required>
                                            <?php $__currentLoopData = $optionTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($value); ?>" <?php if(strcasecmp($close_time, $value) == 0): ?> selected="selected" <?php endif; ?>><?php echo e($value); ?></option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /row-->
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                  
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


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/garage/garage_workign_hours.blade.php ENDPATH**/ ?>