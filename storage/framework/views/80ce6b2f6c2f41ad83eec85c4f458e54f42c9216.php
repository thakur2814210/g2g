
<div class="card">
     <div class="card-header bg-gray">
      <i class="fa fas fa-users"></i> Manage Garage Teams
    </div>

    <div class="card-body table-responsive p-0">
        <div class="row p-3">
            <div class="col-md-6">
               	<table class="table table-striped table-condensed table-bordered">
                  	<thead>
                  		<tr>
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
			                                	<i class="fas fa fa-trash"></i>
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
          	<div class="col-md-6">

          		 <?php if(!empty($garageTeams) && count($garageTeams) > 0): ?>
				    
				        <div class="card">
				          <div class="card-header">
				            Existing Team Members
				          </div>
				          <div class="card-body table-responsive p-2">
				              <ul class="users-list clearfix">
				                <?php $__currentLoopData = $garageTeams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageTeam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                  <li>
				                    <img src="<?php echo e(asset('assets/'.$garageTeam->image)); ?>" height="128" width="128" alt="<?php echo e($garageTeam->first_name); ?>">
				                    <p class=""><?php echo e($garageTeam->first_name); ?> <?php echo e($garageTeam->last_name); ?></p>
				                  </li>
				                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				              </ul>
				          </div>
				        </div>
				   <?php endif; ?>
			</div>

			<div class="col-md-12 clearfix">
          		<div class="card">

		          <div class="card-header">
		            Add New Team Member
		          </div>

		           <div class="card-body">
           			
               			<form class="form-horizontal" method="POST" action="<?php echo e(route('garage.team.update')); ?>" enctype="multipart/form-data">
                  			<?php echo e(csrf_field()); ?>

                  			<input type="hidden" name="garage_id" value="<?php echo e($garagedetails['id']); ?>">
                			
                			<div class="row">
                  				<div class="col-sm-6">
		                          	<div class="form-group">
		                            	<label for="tag_name" class="col-sm-12 col-form-label">First Name</label>
		                            	<div class="col-sm-12">
		                              		<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" required="required" />
		                            	</div>
		                        	</div>
		                    	</div>
		                    	<div class="col-sm-6">
		                        	<div class="form-group">
		                            	<label for="tag_name" class="col-sm-12 col-form-label">Last Name</label>
		                           	 	<div class="col-sm-12">
		                              		<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" required="required" />
		                            	</div>
		                          	</div>
		                      	</div>
		                    </div>

		                    
		                     <div class="row">
		                       	<div class="col-sm-6">
		                        	<div class="form-group">
		                            	<label for="tag_name" class="col-sm-12 col-form-label">Phone</label>
		                            	<div class="col-sm-12">
		                              		<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" required="required" />
		                            	</div>
		                          	</div>
		                     	 </div>
		                     	 <div class="col-sm-6">
	                          		<div class="form-group">
	                            		<label for="tag_name" class="col-sm-12 col-form-label">Email</label>
	                            		<div class="col-sm-12">
	                              			<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required="required" />
	                            		</div>
	                         		 </div>
	                      		</div>
                			</div>

	                      	<div class="row">
								<div class="col-sm-6">
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

								<div class="col-sm-6">
									<div class="form-group">
										<label for="exampleInputFile">Image </label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="cover_photo" name="cover_photo">
												<label class="custom-file-label" for="exampleInputFile">Choose file</label>
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

                			<div class="row text-center">
									<div class="col-12">
			                       	<button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Update New Team Member</button>
			                     </div>
			                </div>
                		</form>
            		</div>
        		</div>
          	</div>
    	</div>
    </div>
</div>

  
 <?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/partials/garage-team.blade.php ENDPATH**/ ?>