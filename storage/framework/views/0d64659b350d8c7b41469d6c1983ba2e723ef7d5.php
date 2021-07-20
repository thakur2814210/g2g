<div style="width: 100%; display:block;">
<!--h2><?php echo e(trans('labels.WelcomeEamailTitle')); ?></h2-->
<p>
	<strong><?php echo e(trans('labels.Hi')); ?> <?php echo e($userData[0]->first_name); ?> <?php echo e($userData[0]->last_name); ?>!</strong><br>
	<?php echo e(trans('labels.deviceRegisteredText')); ?>.<br>
	<strong><?php echo e(trans('labels.Sincerely')); ?>,</strong><br>
	<?php echo e(trans('labels.regardsForThanks')); ?>

</p>
</div><?php /**PATH /home/g2g/public_html/resources/views//mail/deviceRegistered.blade.php ENDPATH**/ ?>