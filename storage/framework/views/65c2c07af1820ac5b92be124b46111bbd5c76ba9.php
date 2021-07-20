<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Contact Us</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Contact Us</li>
    </ol>
  </section>

    <!-- Main content -->
  <section class="content">

    <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-body">
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
                  </div>
                </div>
                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.pages.contactus.update')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                  <input type="hidden" name="id"  value="<?php echo e(!is_null($contactUs) ? $contactUs->id : 1); ?>" />
                  <div class="card-body">

                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Contact Form Mail Address</label>
                      <div class="col-sm-12">
                        <input type="email" class="form-control" name="contact_form_mail_address" id="contact_form_mail_address" value="<?php echo e(!is_null($contactUs) ? $contactUs->contact_form_mail_address : null); ?>" required />
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Phone</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo e(!is_null($contactUs) ? $contactUs->phone : null); ?>" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Mobile</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo e(!is_null($contactUs) ? $contactUs->mobile : null); ?>" required />
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Email</label>
                      <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo e(!is_null($contactUs) ? $contactUs->email : null); ?>" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Address(English)</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="address_en" id="address_en" value="<?php echo e(!is_null($contactUs) ? $contactUs->address_en : null); ?>" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Address(Arabic)</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="address_ar" id="address_ar" value="<?php echo e(!is_null($contactUs) ? $contactUs->address_ar : null); ?>" required />
                      </div>
                    </div>

                    
                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Latitude</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="latitude" id="latitude"  value="<?php echo e(!is_null($contactUs) ? $contactUs->latitude : null); ?>" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Longitude</label>
                      <div class="col-sm-12">
                       <input type="text" class="form-control" name="longitude" id="longitude"  value="<?php echo e(!is_null($contactUs) ? $contactUs->longitude : null); ?>" required />
                      </div>
                    </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Upadte Contact Us Info</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/page/contact-us.blade.php ENDPATH**/ ?>