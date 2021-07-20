<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Garage Videos</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.active')); ?>">Active Garages</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.pending')); ?>">Pending Garages</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garages</a>
        </li>
        
      <li class="active">Manage Garage Videos</li>
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
                        <a class="dropdown-toggle btn-danger" data-toggle="dropdown" href="#">
                            Garage Information <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
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
                        </ul>
                    </li>
                </ul>
                   
                </div>
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
         Manage Garage Video
        </div>

        <div class="box-body">
            
          
            <div class="row p-3">
                <div class="col-md-7">
                   <table class="table table-striped table-condensed table-bordered">
                  <thead class="">
                   <tr style="background: #e9ecef">
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
                            <a href="<?php echo e(route('superadmin.garage.video.delete',['id' => $garageVideo->id])); ?>">
                              <button type="button" class="btn btn-sm btn-danger">
                                <i class="fa fa-fw fa-trash"></i> Delete
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
                    
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.garage.video.update')); ?>" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="garage_id" value="<?php echo e($garage->id); ?>">
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
    </div>
  </div>


  <div class="row">
    <div class="col-12">
      <div class="box box-solid box-primary">
        <div class="box-header">
         Existing Garage Video
        </div>

        <div class="box-body">
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
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin_bk/Resources/views/garage/garage_videos.blade.php ENDPATH**/ ?>