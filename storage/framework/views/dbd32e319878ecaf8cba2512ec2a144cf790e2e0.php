

<?php $__env->startSection('content'); ?>


<section class="page-area pro-content">
    <div class="container"> 

<div class="row justify-content-center">       
          
        
          <div class="col-12 col-sm-12 col-md-6">
              
            <div class="col-12 my-5 px-0">

                <div class="col-12 col-sm-12 col-md-12 justify-content-center">
                <?php if(Session::has('loginError')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class=""><?php echo app('translator')->get('website.Error'); ?>:</span>
                        <?php echo session('loginError'); ?>


                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(Session::has('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class=""><?php echo app('translator')->get('website.success'); ?>:</span>
                        <?php echo session('success'); ?>


                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if( count($errors) > 0): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only"><?php echo app('translator')->get('website.Error'); ?>:</span>
                        <?php echo e($error); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only"><?php echo app('translator')->get('website.Error'); ?>:</span>
                        <?php echo session('error'); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(Session::has('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only"><?php echo app('translator')->get('website.Success'); ?>:</span>
                        <?php echo session('success'); ?>


                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

            </div>
                        
                
                <ul class="nav nav-tabs" id="registerTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="true"><?php echo app('translator')->get('website.customer'); ?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="garage-tab" data-toggle="tab" href="#garage" role="tab" aria-controls="garage" aria-selected="false"><?php echo app('translator')->get('website.garage'); ?>/<?php echo app('translator')->get('labels.vendor'); ?></a>
                    </li>
                    
                  </ul>
                  <div class="tab-content" id="registerTabContent">
                    <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                        

                        <div class="registration-process">
                        
                            <div class="col-12 text-center">
                                <h4 class="heading login-heading"> <?php echo e(trans('website.register_account')); ?></h4>
                                <hr/>
                                <br/>
                                <br/>
                            </div>
                        <form name="signup" enctype="multipart/form-data"  action="<?php echo e(URL::to('/signupProcess')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>


                             <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.username'); ?></label></div>
                                <div class="input-group col-12">
                                    <input  name="userName" type="text" class="form-control field-validate" id="userName" placeholder="<?php echo app('translator')->get('website.Please enter your user name'); ?>" value="<?php echo e(old('userName')); ?>">
                                    <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your user name'); ?></span>
                                </div>
                            </div>

                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.First Name'); ?></label></div>
                                <div class="input-group col-12">
                                    <input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('firstName')); ?>">
                                    <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your first name'); ?></span>
                                </div>
                            </div>
                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Last Name'); ?></label></div>
                                <div class="input-group col-12">
                                    <input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('lastName')); ?>">
                                    <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your last name'); ?></span>
                                </div>
                            </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Email Adrress'); ?></label></div>
                                    <div class="input-group col-12">
                                        <input  name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="<?php echo app('translator')->get('website.Please enter your valid email address'); ?>" value="<?php echo e(old('email')); ?>">
                                        <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>
                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Password'); ?></label></div>
                                    <div class="input-group col-12">
                                        <input name="password" id="password" type="password" class="form-control"  placeholder="<?php echo app('translator')->get('website.Please enter your password'); ?>">
                                        <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your password'); ?></span>

                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                        <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Confirm Password'); ?></label></div>
                                        <div class="input-group col-12">
                                            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Enter Your Password">
                                            <span class="help-block" hidden><?php echo app('translator')->get('website.Please re-enter your password'); ?></span>
                                            <span class="help-block" hidden><?php echo app('translator')->get('website.Password does not match the confirm password'); ?></span>
                                        </div>
                                    </div>
                                    <div class="from-group mb-3">
                                        <div class="col-12" > <label for="inlineFormInputGroup"><strong  style="color: red;">*</strong><?php echo app('translator')->get('website.Gender'); ?></label></div>
                                        <div class="input-group col-12">
                                            <select class="form-control field-validate" name="gender" id="inlineFormCustomSelect">
                                                <option selected value=""><?php echo app('translator')->get('website.Choose...'); ?></option>
                                                <option value="0" <?php if(!empty(old('gender')) and old('gender')==0): ?> selected <?php endif; ?>)><?php echo app('translator')->get('website.Male'); ?></option>
                                                <option value="1" <?php if(!empty(old('gender')) and old('gender')==1): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Female'); ?></option>
                                            </select>
                                            <span class="help-block" hidden><?php echo app('translator')->get('website.Please select your gender'); ?></span>
                                        </div>
                                    </div>
                                    <div class="from-group mb-3">
                                        <div class="input-group col-12">
                                            <input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
                                            <?php echo app('translator')->get('website.Creating an account means you are okay with our'); ?>  <?php if(!empty($result['commonContent']['pages'][3]->slug)): ?>&nbsp;<a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Terms and Services'); ?><?php if(!empty($result['commonContent']['pages'][3]->slug)): ?></a><?php endif; ?>, <?php if(!empty($result['commonContent']['pages'][1]->slug)): ?><a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Privacy Policy'); ?><?php if(!empty($result['commonContent']['pages'][1]->slug)): ?></a> <?php endif; ?> &nbsp; and &nbsp; <?php if(!empty($result['commonContent']['pages'][2]->slug)): ?><a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Refund Policy'); ?> <?php if(!empty($result['commonContent']['pages'][3]->slug)): ?></a><?php endif; ?>.
                                            <span class="help-block" hidden><?php echo app('translator')->get('website.Please accept our terms and conditions'); ?></span>
                                        </div>
                                    </div>

                              <div class="col-12 col-sm-12">
                                <button type="submit" class="btn btn-light swipe-to-top"><?php echo app('translator')->get('website.Create an Account'); ?> </button>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="garage" role="tabpanel" aria-labelledby="garage-tab">
                        <div class="registration-process">

                            <div class="col-12 text-center">
                                <h4 class="heading login-heading"> <?php echo e(trans('website.register_account')); ?></h4>
                                <hr/>
                                <br/>
                            </div>

                            <form name="signup" enctype="multipart/form-data"  action="<?php echo e(URL::to('/signupProcessVendor')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>


                             <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.username'); ?></label></div>
                                <div class="input-group col-12">
                                    <input  name="userName" type="text" class="form-control field-validate" id="userName" placeholder="<?php echo app('translator')->get('website.Please enter your user name'); ?>" value="<?php echo e(old('userName')); ?>">
                                    <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your user name'); ?></span>
                                </div>
                            </div>

                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.First Name'); ?></label></div>
                                <div class="input-group col-12">
                                    <input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('firstName')); ?>">
                                    <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your first name'); ?></span>
                                </div>
                            </div>
                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Last Name'); ?></label></div>
                                <div class="input-group col-12">
                                    <input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="<?php echo app('translator')->get('website.Please enter your first name'); ?>" value="<?php echo e(old('lastName')); ?>">
                                    <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your last name'); ?></span>
                                </div>
                            </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Email Adrress'); ?></label></div>
                                    <div class="input-group col-12">
                                        <input  name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter Your Email or Username" value="<?php echo e(old('email')); ?>">
                                        <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></span>
                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Password'); ?></label></div>
                                    <div class="input-group col-12">
                                        <input name="password" id="password" type="password" class="form-control"  placeholder="<?php echo app('translator')->get('website.Please enter your password'); ?>">
                                        <span class="help-block" hidden><?php echo app('translator')->get('website.Please enter your password'); ?></span>

                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                        <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong><?php echo app('translator')->get('website.Confirm Password'); ?></label></div>
                                        <div class="input-group col-12">
                                            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Enter Your Password">
                                            <span class="help-block" hidden><?php echo app('translator')->get('website.Please re-enter your password'); ?></span>
                                            <span class="help-block" hidden><?php echo app('translator')->get('website.Password does not match the confirm password'); ?></span>
                                        </div>
                                    </div>
                                   
                                    <div class="from-group mb-3">
                                        <div class="input-group col-12">
                                            <input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
                                            <?php echo app('translator')->get('website.Creating an account means you are okay with our'); ?>  <?php if(!empty($result['commonContent']['pages'][3]->slug)): ?>&nbsp;<a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Terms and Services'); ?><?php if(!empty($result['commonContent']['pages'][3]->slug)): ?></a><?php endif; ?>, <?php if(!empty($result['commonContent']['pages'][1]->slug)): ?><a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Privacy Policy'); ?><?php if(!empty($result['commonContent']['pages'][1]->slug)): ?></a> <?php endif; ?> &nbsp; and &nbsp; <?php if(!empty($result['commonContent']['pages'][2]->slug)): ?><a href="<?php echo e(URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)); ?>"><?php endif; ?> <?php echo app('translator')->get('website.Refund Policy'); ?> <?php if(!empty($result['commonContent']['pages'][3]->slug)): ?></a><?php endif; ?>.
                                            <span class="help-block" hidden><?php echo app('translator')->get('website.Please accept our terms and conditions'); ?></span>
                                        </div>
                                    </div>

                              <div class="col-12 col-sm-12">
                                <button type="submit" class="btn btn-light swipe-to-top"><?php echo app('translator')->get('website.Create an Account'); ?> </button>
                            </div>
                        </form>
                        </div>
                    </div>
                  </div>
            </div>
          </div>

        </div>
    </div>
</section>


<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Register')); ?></div>

                <div class="card-body">
                    <form method="POST" action="/" aria-label="<?php echo e(__('Register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Register')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/auth/register.blade.php ENDPATH**/ ?>