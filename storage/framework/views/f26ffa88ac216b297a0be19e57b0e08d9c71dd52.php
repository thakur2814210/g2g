
<div class="card">
   <div class="card-header bg-gray">
    <i class="fa fas fa-users"></i> Manage Garage Media Image
  </div>

  <div class="card-body table-responsive p-0">
    <div class="row p-3">
        <!-- image listing -->
        <div class="col-md-8">
          <table class="table table-striped table-condensed table-bordered">
            <thead class="">
              <tr>
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
                          <i class="fas fa fa-trash"></i>
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
        <!-- add image . -->
        <div class="col-md-4">
           <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.image.update')); ?>" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="garage_id" value="<?php echo e($garagedetails['id']); ?>">
              <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="cover_photo" name="cover_photo">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Update Image Gallery</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          Existing Garage Image Gallery
        </div>

        <div class="card-body table-responsive p-2">
          <?php if(!empty($garageimages) && count($garageimages) > 0): ?>
             <div class="row">
                <?php $__currentLoopData = $garageimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-sm-2">
                    <a href="<?php echo e(asset($garageimage->image)); ?>" data-toggle="lightbox" data-title="Garage Image <?php echo e($garageimage->id); ?>" data-gallery="gallery">
                      <img src="<?php echo e(asset($garageimage->image)); ?>" class="img-fluid mb-2" alt="Garage Image <?php echo e($garageimage->id); ?>">
                    </a>
                  </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          <?php else: ?>
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-info"></i> Alert!</h5>
              No Image preview Exist.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>


  <?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/partials/garage-image.blade.php ENDPATH**/ ?>