<div style="width: 100%; display:block;">
<p>
	<strong><?php echo e(trans('labels.Hi')); ?> <?php echo e($existUser[0]->first_name); ?> <?php echo e($existUser[0]->last_name); ?>!</strong><br>
	<?php echo e(trans('labels.recoverPasswordEmailText')); ?><br>
	<?php echo e(trans('labels.Yourpasswordis')); ?> <strong><?php echo e($existUser[0]->password); ?></strong><br><br>
	<strong><?php echo e(trans('labels.Sincerely')); ?>,</strong><br>
	<?php echo e(trans('labels.regardsForThanks')); ?>

</p>
</div>
<?php /**PATH D:\xampp74\htdocs\g2g\resources\views//mail/recoverPassword.blade.php ENDPATH**/ ?>