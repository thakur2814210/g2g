<div class="card">
     <div class="card-header">
      <i class="fa fas fa-youtube"></i> Manage Garage Video
    </div>

        <div class="card-body table-responsive">
            <div class="row p-3">
                <div class="col-md-7">
                   <table class="table table-striped table-condensed table-bordered">
                  <thead>
                    <tr>
                      <th width="10%">#</th>
                      <th width="70%">Yuotube Video Id</th>
                      <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($garageVideos) && count($garageVideos) > 0): ?>
                      <?php $__currentLoopData = $garageVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($garageVideo->id); ?></td>
                          <td><?php echo e($garageVideo->yt_video_id); ?></td>
                          <td>
                            <a href="<?php echo e(route('garage.video.delete',['id' => $garageVideo->id])); ?>">
                              <button type="button" class="btn btn-sm btn-danger">
                                <i class="fa fa-fw fa-trash"></i>
                              </button>
                            </a>
                          </td>
                        </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="3">
                            No Garage Video Found.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                 <div class="row" style="padding: 20px;">
                     <?php if(!empty($garageVideos) && count($garageVideos) > 0): ?>
                       <?php echo e($garageVideos->links()); ?>

                     <?php endif; ?>
                 </div>
                </div>


                <div class="col-md-5">
                    
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.video.update')); ?>" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="garage_id" value="<?php echo e($garagedetails['id']); ?>">
                      <div class="form-group">
                        <label for="tag_name" class="col-sm-12 col-form-label">Youtube Video Id</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="yt_video_id" id="yt_video_id" placeholder="Enter Youtube Video ID" required="required" />
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Update new video</button>
                      </div>
                    </form>

                </div>
            </div>

        </div>
      </div>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gray">
          <i class="fa fas fa-youtube"></i> Existing Garage Video
        </div>

        <div class="card-body table-responsive p-2">
            <?php if(!empty($garageVideos) && count($garageVideos) > 0): ?>
             <div class="row">
                <?php $__currentLoopData = $garageVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-sm-6">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo e($garageVideo->yt_video_id); ?>?rel=0" allowfullscreen></iframe>
                      </div>
                  </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          <?php else: ?>
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-info"></i> Alert!</h5>
              No Video Exist.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/partials/garage-video.blade.php ENDPATH**/ ?>