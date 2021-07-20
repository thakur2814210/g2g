<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
        <ol class="breadcrumb padding_bottom">
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('client.dashboard')); ?>"><?php echo app('translator')->get('website.dashboard'); ?></a>
          </li>
          <li class="breadcrumb-item active"><?php echo app('translator')->get('website.Registered'); ?> <?php echo app('translator')->get('website.Vehicle'); ?></li>
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
        <div class="card-header">
          <i class="fa fa-list"></i>  <?php echo app('translator')->get('website.Registered'); ?> <?php echo app('translator')->get('website.Vehicle'); ?>
          <div class="card-tools float-right">
            <div class="input-group input-group-sm " style="width: 150px;">
              <div class="input-group-append">
                <a href="<?php echo e(URL::to('/vehicles/add')); ?>"><button type="button" class="btn btn-block btn-secondary"><i class="fa faw fa-plus"></i><?php echo app('translator')->get('website.Add'); ?> <?php echo app('translator')->get('website.Vehicle'); ?></button></a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body card-body-custom">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr >
                  <th>#</th>
                  <th><?php echo app('translator')->get('website.Plate No'); ?></th>
                  <th><?php echo app('translator')->get('website.Make'); ?></th>
                  <th><?php echo app('translator')->get('website.Model'); ?></th>
                  <th><?php echo app('translator')->get('website.Status'); ?></th>
                  <th><?php echo app('translator')->get('website.Action'); ?></th>
                </tr>
              </thead>
              <tfoot>
                <tr >
                    <th>#</th>
                   <th><?php echo app('translator')->get('website.Plate No'); ?></th>
                  <th><?php echo app('translator')->get('website.Make'); ?></th>
                  <th><?php echo app('translator')->get('website.Model'); ?></th>
                  <th><?php echo app('translator')->get('website.Status'); ?></th>
                  <th><?php echo app('translator')->get('website.Action'); ?></th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($vehicles) && count($vehicles) > 0): ?>
                  <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($index + 1); ?></td>
                      <td><?php echo e($vehicle->plate_no); ?></td>
                      <td><?php echo e(!empty($vehicle->vmake->name) ? $vehicle->vmake->name : null); ?></td>
                      <td><?php echo e(!empty($vehicle->vmodel->name) ? $vehicle->vmodel->name : null); ?></td>
                      
                      <td>
                        <?php if($vehicle->status == 1): ?>
                          <span class="read"><?php echo app('translator')->get('website.Active'); ?></span>
                        <?php elseif($vehicle->status == 3): ?>
                          <span class="pending"><?php echo app('translator')->get('website.Hold'); ?></span>
                        <?php else: ?>
                          <span class="unread"><?php echo app('translator')->get('website.Delete'); ?></span>
                        <?php endif; ?>
                      </td>
                      <td>
                          
                          <a href="<?php echo e(URL::to('/vehicles/edit/'.$vehicle->id)); ?>" title="Edit Vehicle" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> <?php echo app('translator')->get('website.Update'); ?> </a>
                          <a href="<?php echo e(URL::to('/vehicles/delete/'.$vehicle->id)); ?>" title="Delete Vehicle" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> <?php echo app('translator')->get('website.Delete'); ?></a>
                      </td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6">
                        No Vehicle Found.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
       </div>
     </div>
   </div>
 </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/vehicles/index.blade.php ENDPATH**/ ?>