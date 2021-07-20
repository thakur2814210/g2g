<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.active')); ?>">Active Garage List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garage List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.pending')); ?>">Pending Garage List</a>
        </li>
        <li class="breadcrumb-item active">Garage Images</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
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
      <div class="card-tools float-right">
        <div class="input-group input-group-sm" style="width: 200px;">
          <div class="input-group-append">
            <div class="btn-group">
              <div class="btn-group">
                <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tags"></i> Garage Information&nbsp;</button>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-116px, -84px, 0px);">
                   <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.edit',['id' => $garage->id])); ?>">Garage Details</a>
                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.team.view',['id' => $garage->id])); ?>">Garage Teams</a>
                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.video.view',['id' => $garage->id])); ?>">Garage Videos</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
         Manage Garage Images
        </div>

        <div class="card-body table-responsive">

          
            <div class="row p-3">
                <div class="col-md-8">
                   <table class="table table-striped table-condensed table-bordered">
                  <thead>
                     <tr style="background: #e9ecef">
                      <th>#</th>
                      <th>Image Path</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($garageimages) && count($garageimages) > 0): ?>
                      <?php $__currentLoopData = $garageimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($garageimage->id); ?></td>
                          <td><?php echo e($garageimage->image); ?></td>
                          <td>
                            <a href="<?php echo e(route('superadmin.garage.image.delete',['id' => $garageimage->id])); ?>">
                              <button type="button" class="btn btn-sm btn-danger">
                                <i class="fa fa-fw fa-trash"></i>
                              </button>
                            </a>
                          </td>
                        </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="9">
                            No Garage Image Found.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                 <div class="row" style="padding: 20px;">
                     <?php if(!empty($garageimages) && count($garageimages) > 0): ?>
                       <?php echo e($garageimages->links()); ?>

                     <?php endif; ?>
                 </div>
                </div>


                <div class="col-md-4">
                   <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.garage.image.update')); ?>" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="garage_id" value="<?php echo e($garage->id); ?>">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" id="cover_photo" name="cover_photo">
                          </div>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Update Image Gallery</button>
                      </div>
                    </form>
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gray">
         Existing Garage Image Gallery( Click to see in Pop up.)
        </div>

        <div class="card-body table-responsive p-2">
          <?php if(!empty($garageimages) && count($garageimages) > 0): ?>
             <div class="row">
                <?php $__currentLoopData = $garageimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-sm-2">
                    <a href="<?php echo e(asset('assets/uploads/garage_images/'.$garageimage->image)); ?>" data-toggle="lightbox" data-title="<?php echo e($garageimage->id); ?>" data-gallery="gallery">
                      <img src="<?php echo e(asset('assets/uploads/garage_images/'.$garageimage->image)); ?>" class="img-fluid mb-2" alt="Garage Image <?php echo e($garageimage->id); ?>">
                    </a>
                  </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          <?php else: ?>
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fa fa-info"></i> Alert!</h5>
              No Image preview Exist.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/vendor/ekko-lightbox/ekko-lightbox.min.js')); ?>"></script>
    <script>
      $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });
      })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/garage/garage_images.blade.php ENDPATH**/ ?>