<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Garage Team</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(route('garage.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       
      <li class="active">Manage Garage Team</li>
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
                <div class="row">
                <div class="col-md-12">
                   <table class="table table-striped table-condensed table-bordered">
                  <thead>
                    <tr style="background: #e9ecef">
                      <th>#</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($garageTeams) && count($garageTeams) > 0): ?>
                      <?php $__currentLoopData = $garageTeams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageTeam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($garageTeam->id); ?></td>
                          <td><?php echo e($garageTeam->first_name); ?> <?php echo e($garageTeam->last_name); ?></td>
                          <td>
                            <?php if($garageTeam->gender == 1): ?>
                              <span class=" text-success">Male</span>
                            <?php else: ?>
                              <span class=" text-success">Female</span>
                            <?php endif; ?>
                          </td>
                           <td><?php echo e($garageTeam->phone); ?></td>
                            <td><?php echo e($garageTeam->address); ?></td>
                          <td>
                            <a href="<?php echo e(route('garage.team.delete',['id' => $garageTeam->id])); ?>">
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
                            No garage team member found.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                 <div class="row" style="padding: 20px;">
                     <?php if(!empty($garageTeams) && count($garageTeams) > 0): ?>
                       <?php echo e($garageTeams->links()); ?>

                     <?php endif; ?>
                 </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
        <?php if(!empty($garageTeams) && count($garageTeams) > 0): ?>
            <div class="box box-solid box-primary">
              <div class="box-header">
                Team Member Images
              </div>
              <div class="box-body">
                <div class="row text-center">
                  <?php $__currentLoopData = $garageTeams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageTeam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6">
                      <img src="<?php echo e(asset('uploads/garage_images/'. $garageTeam->image)); ?>" height="80" width="80" alt="<?php echo e($garageTeam->first_name); ?>">
                      <p class=""><?php echo e($garageTeam->first_name); ?> <?php echo e($garageTeam->last_name); ?></p>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </div>
              </div>
            </div>
        <?php endif; ?>
    </div>
  </div>

   

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid box-primary">
        <div class="box-header">
         Add New Team Member
        </div>

        <div class="box-body">


            <div class="row p-3">
                <div class="col-md-12">
                   <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.team.update')); ?>" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="garage_id" value="<?php echo e($garage->id); ?>">
                    <div class="row">

                      <div class="col-sm-4">
                          <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">First Name</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" required="required" />
                            </div>
                          </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">Last Name</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" required="required" />
                            </div>
                          </div>
                      </div>

                       <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">Phone</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" required="required" />
                            </div>
                          </div>
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-sm-4">
                          <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">Email</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required="required" />
                            </div>
                          </div>
                      </div>

                      <div class="col-sm-4">
                          <div class="form-group">
                            <label for="tag_status" class="col-sm-12 col-form-label">Gender</label>
                            <div class="col-sm-12">
                              <select class="form-control" name="gender" id="gender" required="required">
                                  <option value="">Select</option>
                                  <option value="1">Male</option>
                                  <option value="2">Female</option>
                                </select>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleInputFile">Image </label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file"  id="cover_photo" name="cover_photo">
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                     <div class="row">

                      <div class="col-sm-12">
                          <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">Address</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required="required" />
                            </div>
                          </div>
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-sm-4">
                          <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">City</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" required="required" />
                            </div>
                          </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">Country</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="country" id="country" placeholder="Enter Country" required="required" />
                            </div>
                          </div>
                      </div>

                       <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tag_name" class="col-sm-12 col-form-label">Postal</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="postal" id="postal" placeholder="Enter Postal" required="required" />
                            </div>
                          </div>
                      </div>

                    </div>

                     


                      

                      <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Update New Team Member</button>
                      </div>
                    </form>
                </div>
            </div>


        </div>
      </div>
    </div>
  </div>
</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/garage_teams.blade.php ENDPATH**/ ?>