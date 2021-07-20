<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.constantBanners')); ?> <small><?php echo e(trans('labels.ListingConstantBanners')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Banners')); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            

            <div class="form-inline">

              <form  name='registration' id="registration" class="" method="get">
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                  <div class="input-group-form search-panel ">
                      <select id="parameter" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="bannerType">
                          <option value="" selected disabled hidden><?php echo e(trans('labels.ChooseSliderType')); ?></option>
                          <option value="banner1" <?php if(request()->get('bannerType') == 'banner1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 1'); ?></option>
                          <option value="banner2" <?php if(request()->get('bannerType') == 'banner2'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 2'); ?></option>
                          <option value="banner3" <?php if(request()->get('bannerType') == 'banner3'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 3'); ?></option>
                          <option value="banner4" <?php if(request()->get('bannerType') == 'banner4'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 4'); ?></option>
                          <option value="banner5" <?php if(request()->get('bannerType') == 'banner5'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 5'); ?></option>
                          <option value="banner6" <?php if(request()->get('bannerType') == 'banner6'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 6'); ?></option>
                          <option value="banner7" <?php if(request()->get('bannerType') == 'banner7'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 7'); ?></option>
                          <option value="banner8" <?php if(request()->get('bannerType') == 'banner8'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 8'); ?></option>
                          <option value="banner9" <?php if(request()->get('bannerType') == 'banner9'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 9'); ?></option>
                          <option value="banner10" <?php if(request()->get('bannerType') == 'banner10'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 10'); ?></option>
                          <option value="banner11" <?php if(request()->get('bannerType') == 'banner11'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 11'); ?></option>
                          <option value="banner12" <?php if(request()->get('bannerType') == 'banner12'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 12'); ?></option>
                          <option value="banner13" <?php if(request()->get('bannerType') == 'banner13'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 13'); ?></option>
                          <option value="banner14" <?php if(request()->get('bannerType') == 'banner14'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 14'); ?></option>
                          <option value="banner15" <?php if(request()->get('bannerType') == 'banner15'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 15'); ?></option>
                          <option value="banner16" <?php if(request()->get('bannerType') == 'banner16'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 16'); ?></option>
                          <option value="banner17" <?php if(request()->get('bannerType') == 'banner17'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 17'); ?></option>
                          <option value="banner19" <?php if(request()->get('bannerType') == 'banner19'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Banner Style 19'); ?></option>

                          
                          <option value="rightsliderbanner" <?php if(request()->get('bannerType') == 'rightsliderbanner'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Right Slider with Thumbs'); ?> </option>
                          <option value="leftsliderbanner" <?php if(request()->get('bannerType') == 'leftsliderbanner'): ?> selected <?php endif; ?>><?php echo app('translator')->get('labels.Left Slider with Thumbs'); ?> </option>
                      </select>
                      <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="languages_id">
                        <option value="" selected disabled hidden><?php echo e(trans('labels.ChooseLanguage')); ?></option>
                          <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($language->languages_id); ?>" <?php if(request()->get('languages_id') == $language->languages_id): ?> selected <?php endif; ?>><?php echo e($language->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                      <?php if(request()->get('bannerType')): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/constantbanners')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                  </div>
              </form>
              <div class="col-lg-4 form-inline" id="contact-form12"></div>

              <?php if(request()->get('bannerType') == 'banner1'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner1.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner2'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner2.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner3'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner3.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner4'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner4.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner5'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner5.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner6'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner6.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner7'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner7.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner8'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner8.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner9'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner9.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner10'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner10.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner11'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner11.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner11'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner11.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner12'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner12.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner13'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner13.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner14'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner14.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner15'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner15.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner16'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner16.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner17'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner17.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner19'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner18.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner19'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner19.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'rightsliderbanner'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\carousal3.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'leftsliderbanner'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\carousal5.jpg')); ?>" alt=""  width=100%>
              <?php endif; ?>
          </div>
          
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		  <?php if(count($errors) > 0): ?>
                          <?php if($errors->any()): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo e($errors->first()); ?>

                            </div>
                          <?php endif; ?>
                      <?php endif; ?>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      
                      <th><?php echo e(trans('labels.Language Name')); ?></th>
                      <th><?php echo e(trans('labels.Image')); ?></th>
                      <th><?php echo e(trans('labels.AddedModifiedDate')); ?></th>
                      <th><?php echo e(trans('labels.Action')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['banners'])>0): ?>
                    <?php $__currentLoopData = $result['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            <td><?php echo e($banners->language_name); ?></td>
                            <td><img src="<?php echo e(asset('').$banners->path); ?>" alt="" style="max-width: 300px"></td>
                            <td><strong><?php echo e(trans('labels.AddedDate')); ?>: </strong> <?php echo e(date('d M, Y', strtotime($banners->date_added))); ?><br>
                            </td>

                            <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="editconstantbanner/<?php echo e($banners->banners_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <!-- <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteBannerId" banners_id ="<?php echo e($banners->banners_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                       <tr>
                            <td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                       </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->

    <!-- deleteBannerModal -->
	<div class="modal fade" id="deleteBannerModal" tabindex="-1" role="dialog" aria-labelledby="deleteBannerModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteBannerModalLabel"><?php echo e(trans('labels.DeleteBanner')); ?></h4>
		  </div>
		  <?php echo Form::open(array('url' =>'admin/deleteconstantBanner', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

				  <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

				  <?php echo Form::hidden('banners_id',  '', array('class'=>'form-control', 'id'=>'banners_id')); ?>

		  <div class="modal-body">
			  <p><?php echo e(trans('labels.DeleteBannerText')); ?></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
			<button type="submit" class="btn btn-primary" id="deleteBanner"><?php echo e(trans('labels.Delete')); ?></button>
		  </div>
		  <?php echo Form::close(); ?>

		</div>
	  </div>
	</div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/admin/settings/web/banners/index.blade.php ENDPATH**/ ?>