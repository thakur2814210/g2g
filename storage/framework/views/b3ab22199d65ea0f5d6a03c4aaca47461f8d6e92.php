<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Garage Images</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(route('garage.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Manage Garage Images</li>
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





  

  <div class="row">
    <div class="col-12">
      <div class="box box-solid box-primary">
        <div class="box-header">
         Manage Garage Images
        </div>

        <div class="box-body">

          
            <div class="row">
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
                            <a href="<?php echo e(route('garage.image.delete',['id' => $garageimage->id])); ?>">
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
                   <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.image.update')); ?>" enctype="multipart/form-data">
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
      <div class="box box-solid box-primary">
        <div class="box-header">
         Existing Garage Image Gallery( Click to see in Pop up.)
        </div>

        <div class="box-body">
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

<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/garage_images.blade.php ENDPATH**/ ?>