<div style="width: 100%; display:block;">
<h2><?php echo e(trans('labels.back')); ?></h2>
<p>
	<strong>
   	<?php echo e(trans('labels.HiAdmin')); ?>!
   	</strong><br><br>
    
	<?php echo e(trans('labels.Name')); ?>: <?php echo e($data['name']); ?><br>
	<?php echo e(trans('labels.Email')); ?>: <?php echo e($data['email']); ?><br><br>
	
	<?php echo e($data['message']); ?><br><br>
	<strong><?php echo e(trans('labels.Sincerely')); ?>,</strong><br>
	<?php echo e(trans('labels.emailSignature')); ?>

</p>
</div><?php /**PATH /home/g2g/public_html/resources/views//mail/contactUs.blade.php ENDPATH**/ ?>