<div style="width: 100%; display:block;">
<h2><?php echo e(trans('labels.EcommercePasswordRecovery')); ?></h2>
<p>
	<strong><?php echo e(trans('labels.Hi')); ?> <?php echo e($existUser[0]->first_name); ?> <?php echo e($existUser[0]->last_name); ?>!</strong><br>
	<?php echo e(trans('labels.recoverPasswordEmailText')); ?><br>
	<?php echo e(trans('labels.Yourpasswordis')); ?> <strong><?php echo e($existUser[0]->password); ?></strong><br><br>
	<strong><?php echo e(trans('labels.Sincerely')); ?>,</strong><br>
	<?php echo e(trans('labels.regardsForThanks')); ?>

</p>
</div>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views//mail/recoverPassword.blade.php ENDPATH**/ ?>