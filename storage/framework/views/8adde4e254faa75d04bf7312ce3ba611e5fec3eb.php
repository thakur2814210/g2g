<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
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

          <div class="box_general padding_bottom">
            <div class="row" style="padding-top: 1%;">

               <div class="col-md-12 col-sm-12 ">
            <div class="card">
            <div class="card-header" style="background: #111;">
                <span class="card-title text-white"><i class="fa fa-money"></i><?php echo app('translator')->get('website.Service Request'); ?>  <?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Information'); ?></span>              
              </div>
              <div class="card-body table-responsive">
                    

                  <?php if($sr->status == 'request-payment'): ?>

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('client.service-request.update-sr-payment-status')); ?>">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="id" value="<?php echo e($sr->id); ?>">
                        <div class="form-group">
                          <h6 ><?php echo app('translator')->get('website.Quote Amount (AED)'); ?>: <?php echo e(number_format($sr->quote_amount,2)); ?></h6>
                        </div>
                        <div class="form-group">
                            <h6 ><?php echo app('translator')->get('website.Make'); ?> <?php echo app('translator')->get('website.Payment'); ?></h6>
                            <select class="form-control" name="payment_type" id="payment_type" >
                              <option value="cod" selected=""><?php echo app('translator')->get('website.Cash On Delivery'); ?></option>
                              <option value="telr" disabled=""><?php echo app('translator')->get('website.Telr'); ?></option>
                             </select>
                        </div>

                        <div class="form-group">
                           <button type="submit" class="btn btn-success" data-dismiss="modal"><?php echo app('translator')->get('website.Submit'); ?> <?php echo app('translator')->get('website.Payment'); ?></button>
                        </div>
                      
                    </form>
                 
                   <?php elseif($sr->status == 'new'): ?>
                      <p class="btn btn-block btn-outline-danger"><b>Information:</b><br/> <?php echo app('translator')->get('website.Service request create and waiting for the Garage quote amount'); ?></p>
                    <?php elseif($sr->status == 'cancel' || $sr->status == 'delete'): ?>
                      <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Not required! Service request has cancel or deleted'); ?></p>
                    <?php else: ?>

                      <?php if(!empty($sr_payment)): ?>

                      <div class="p-1" style="background: #999;">
                        <div class="row text-center text-white">
                          <div class="col-6 ">
                             <p class="btn btn-block btn-outline-warning"><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Amount'); ?></p>
                            <p class="read text-uppercase  p-2">
                              AED <?php echo e($sr_payment->amount); ?>

                            </p>
                          </div>
                          <div class="col-6 ">
                             <p class="btn btn-block btn-outline-warning"><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Status'); ?></p>
                            <p class="read text-uppercase text-white p-2">
                              <?php if(!empty($sr_payment->status == 1)): ?>
                                <?php echo app('translator')->get('website.Success'); ?>
                              <?php elseif(!empty($sr_payment->status == 2)): ?>
                                <?php echo app('translator')->get('website.Failed'); ?>
                              <?php else: ?>
                                <?php echo app('translator')->get('website.Pending'); ?>
                              <?php endif; ?>
                            </p>
                          </div>
                        </div>
                        <div class="row text-center text-white">
                          <div class="col-6 ">
                            <div class="form-group">
                              <p class="btn btn-block btn-outline-warning"><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Date'); ?></p>
                              <p> <?php echo e($sr_payment->date); ?></p>
                            </div>
                          </div>
                          <div class="col-6 ">
                           <div class="form-group">
                              <p class="btn btn-block btn-outline-warning"><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Type'); ?></p>
                              <p> <?php echo e($sr_payment->payment_type); ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endif; ?>
                    <?php endif; ?>
                </div>

               
            </div>
          </div>

          <div class="col-md-12 col-sm-12 ">

            <div class="card">

              <div class="card-header" style="background: #111;">
                <span class="card-title text-white"><i class="fa fas fa-tags"></i> <?php echo app('translator')->get('website.Service Request'); ?> <?php echo app('translator')->get('website.Information'); ?></span>
              </div>
               <div class="card-body">

                 <div class="p-1" style="background: #999;">
                      <div class="row text-center text-white">
                        <div class="col-sm-12 col-md-6 ">
                            <p class="btn btn-block btn-outline-warning"><?php echo app('translator')->get('website.Status'); ?></p>
                            <?php if(in_array($sr->status, ['new' , 'request-payment'])): ?> 
                               <p class="pending text-uppercase text-white p-2">
                            <?php elseif(in_array($sr->status, ['received-payment'])): ?> 
                              <p class="read text-uppercase text-white p-2">
                            <?php elseif(in_array($sr->status, ['in-progress'])): ?> 
                               <p class="read text-uppercase text-white p-2">
                            <?php elseif(in_array($sr->status, ['cancel'])): ?> 
                                <p class="unread text-uppercase text-white p-2">
                            <?php else: ?>
                              <p class="read text-uppercase text-white p-2">
                            <?php endif; ?>
                              <?php echo e(trans("website.$sr->status")); ?>

                            </p>
                           
                        </div>
                         <div class="col-sm-12 col-md-6 ">
                            <p class="btn btn-block btn-outline-warning"><?php echo app('translator')->get('website.Amount'); ?></p>
                            <p class="read text-uppercase text-white p-2">
                              <?php echo e((!empty($sr->quote_amount) ? 'AED '. $sr->quote_amount : trans('website.Not Available') )); ?>

                            </p>
                        </div>
                      </div>
                    </div>

                    <br/>

                   <?php if(!empty($sr->amount_json)): ?>
                       <div class="table-responsive">
                           <table class="table table-bordered">
                               <thead>
                               <tr>
                                   <th><?php echo app('translator')->get('website.Particular'); ?></th>
                                   <th><?php echo app('translator')->get('website.Amount'); ?></th>
                               </tr>
                               </thead>
                               <tbody>
                               <?php $__currentLoopData = $sr->amount_json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <tr>
                                       <th><?php echo e($val['particular']); ?></th>
                                       <td>AED <?php echo e($val['amount']); ?></td>
                                   </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>
                               <tfoot>
                               <th><?php echo app('translator')->get('website.Total'); ?></th>
                               <th>AED <?php echo e($sr->quote_amount); ?></th>
                               </tfoot>
                           </table>
                       </div>
                   <?php endif; ?>

                   <br>

                 
                    <div class="form-group">
                      <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Faults/Remarks'); ?></p>
                      <p><?php echo e($sr->faults_remarks); ?></p>
                    </div>

                    <?php if(!empty($sr->image)): ?>
                      <div class="form-group">
                       <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image1)): ?>
                      <div class="form-group">
                       <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image1 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image2)): ?>
                      <div class="form-group">
                       <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image2 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image3)): ?>
                      <div class="form-group">
                       <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image3 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>


                    <?php if(!empty($sr->image4)): ?>
                      <div class="form-group">
                        <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image4 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image5)): ?>
                      <div class="form-group">
                        <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image5 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                  
                   
                    <div class="form-group">
                       <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Service Request'); ?></p>
                      <p> <?php echo e($sr->section_name); ?> </p>
                    </div>

                    <?php
                        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
                        $garage_name = null;
                        foreach($sr->garage->garageDescription as $gd){

                          if($gd['language_id'] === $language_id){
                            $garage_name = $gd['garages_name'];
                          }
                        }
                    ?>
                   
                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Garage'); ?> <?php echo app('translator')->get('website.Name'); ?></p>
                      <p><?php echo e($garage_name); ?></p>
                    </div>
                    
                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Garage'); ?> <?php echo app('translator')->get('website.Address'); ?></p>
                      <p><?php echo e($sr->garage->address); ?>, <?php echo e($sr->garage->city->name); ?>, <?php echo e($sr->garage->country->name); ?>, <?php echo app('translator')->get('website.Pobox'); ?>-<?php echo e($sr->garage->postal); ?></p>
                    </div>
                   
                   
                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Garage'); ?> <?php echo app('translator')->get('website.Email'); ?></p>
                      <p><?php echo e($sr->garage->user->email); ?></p>
                    </div>

                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Garage'); ?> <?php echo app('translator')->get('website.Phone'); ?></p>
                      <p><?php echo e($sr->garage->user->phone); ?></p>
                    </div>

                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Category'); ?></p>
                      <p><?php echo e($sr->category->name); ?>

                      </p>
                    </div>

                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Vehicle'); ?> <?php echo app('translator')->get('website.Information'); ?></p>
                      <p ><i class="fa fa-car"></i> <?php echo e($sr->vehicle->plate_no); ?>

                      </p>
                    </div>

                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Created At'); ?></p>
                      <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($sr->created_at))); ?></p>
                      </p>
                    </div>

                    <div class="form-group">
                        <p class="btn btn-block btn-outline-danger"><?php echo app('translator')->get('website.Last Updated At'); ?></p>
                      <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($sr->updated_at))); ?></p>
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

        

<?php $__env->stopSection(); ?>


<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\g2g\resources\views/autoshop/service-request/setting.blade.php ENDPATH**/ ?>