<?php $__env->startSection('content'); ?>
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.WithdrawLog')); ?> <small><?php echo e($pageTitle); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/vendors/active')); ?>"><i class="fa fa-users"></i> <?php echo e(trans('labels.Active Vendors')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Add Vendors')); ?></li>
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
            <h3 class="box-title"><?php echo e($pageTitle); ?> </h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                  <div class="box box-info">
                        <br>                       
                        
                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-success" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <?php echo e(session()->get('message')); ?>

                            </div>
                        <?php endif; ?>
                        
                        <?php if(session()->has('errorMessage')): ?>
                            <div class="alert alert-danger" role="alert">
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('errorMessage')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($errors->any()): ?>
                         <div class="alert alert-danger" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <ul>
                                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <li><?php echo e($error); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                          </div>
                        <?php endif; ?>
                        
                        <!-- form start -->                        
                         <div class="box-body">

                          <?php if(Auth()->user()->role_id === 1): ?>

                            <div class="row">
                              <div class="col-md-6"><h4 class="text-red text-uppercase"><b><?php echo e(trans('labels.Withdraw Request')); ?></b></h4>
                            <hr> 
                            <table class="table table-bordered table-striped">
                              <tbody>
                                 <tr class="bg-blue">
                                  <td width="30%"><b><?php echo e(trans('labels.Requested By')); ?></b></td>
                                  <td><?php echo e($result['admins']->shop_name); ?> ( <?php echo e($result['admins']->user_email); ?>)</td>
                                 
                                </tr>
                                <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Requested On')); ?></b></td>
                                  <td><?php echo e(date('l jS \\of F Y h:i:s A' , strtotime($result['admins']->created_at))); ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Transaction #')); ?></b></td>
                                  <td><?php echo e($result['admins']->trx); ?></td>
                                </tr>
                                <tr class="bg-blue">
                                  <td width="30%"><b><?php echo e(trans('labels.Methods')); ?></b></td>
                                  <td><?php echo e($result['admins']->name); ?></td>
                                </tr>
                                 <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Amount')); ?></b></td>
                                  <td><?php echo e($result['admins']->amount); ?></td>
                                </tr>
                                  <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Charge')); ?></b></td>
                                  <td><?php echo e($result['admins']->charge); ?></td>
                                </tr>
                                <tr class="bg-yellow">
                                  <td width="30%"><b><?php echo e(trans('labels.Status')); ?></b></td>
                                  <td><?php echo e($result['admins']->status); ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Details')); ?></b></td>
                                  <td><?php echo e($result['admins']->details); ?></td>
                                </tr>
                              </tbody>
                            </table></div>
                              <div class="col-md-6"><?php echo Form::open(array('url' =>'admin/transactions/withdrawLog/message/store', 'method'=>'post', 'class' => 'form-horizontal form-validate')); ?>

                              <?php echo Form::hidden('wID',  $result['wID'], array('id'=>'wID')); ?>

                            
                            
                            <h4 class="text-red text-uppercase"><b><?php echo e(trans('labels.Take Action')); ?></b></h4>
                            <hr> 
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 control-label"><?php echo e(trans('labels.Message or Reason')); ?> *</label>
                                  <div class="col-sm-10 ">
                                    <?php echo Form::textarea('message',  '', array('class'=>'form-control field-validate', 'id'=>'message')); ?>

                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Enter message or reason about money transfer')); ?></span>
                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                                </div>
                               
                               
                            
                                
                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" name="status" value="processed" class="btn btn-primary"><?php echo e(trans('labels.Processed')); ?></button>

                                 <button type="submit" name="status" value="refunded" class="btn btn-danger"><?php echo e(trans('labels.Refund')); ?></button>

                                <a href="<?php echo e(URL::to('admin/transactions/withdrawLog')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                              </div>
                              <!-- /.box-footer -->
                            <?php echo Form::close(); ?></div>
                            </div>


                            
                            <?php else: ?>

                              <h4 class="text-red text-uppercase"><b><?php echo e(trans('labels.Withdraw Request')); ?></b></h4>
                            <hr> 
                            <table class="table table-bordered table-striped">
                              <tbody>
                                 <tr class="bg-blue">
                                  <td width="30%"><b><?php echo e(trans('labels.Requested By')); ?></b></td>
                                  <td><?php echo e($result['admins']->shop_name); ?> ( <?php echo e($result['admins']->user_email); ?>)</td>
                                 
                                </tr>
                                <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Requested On')); ?></b></td>
                                  <td><?php echo e(date('l jS \\of F Y h:i:s A' , strtotime($result['admins']->created_at))); ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Transaction #')); ?></b></td>
                                  <td><?php echo e($result['admins']->trx); ?></td>
                                </tr>
                                <tr class="bg-blue">
                                  <td width="30%"><b><?php echo e(trans('labels.Methods')); ?></b></td>
                                  <td><?php echo e($result['admins']->name); ?></td>
                                </tr>
                                 <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Amount')); ?></b></td>
                                  <td><?php echo e($result['admins']->amount); ?></td>
                                </tr>
                                  <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Charge')); ?></b></td>
                                  <td><?php echo e($result['admins']->charge); ?></td>
                                </tr>
                                <tr class="bg-yellow">
                                  <td width="30%"><b><?php echo e(trans('labels.Status')); ?></b></td>
                                  <td><?php echo e($result['admins']->status); ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b><?php echo e(trans('labels.Details')); ?></b></td>
                                  <td><?php echo e($result['admins']->details); ?></td>
                                </tr>
                              </tbody>
                            </table>

                            <?php endif; ?>


                            
                        </div>
                  </div>
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
    
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/withdraw/withdrawLog/show.blade.php ENDPATH**/ ?>