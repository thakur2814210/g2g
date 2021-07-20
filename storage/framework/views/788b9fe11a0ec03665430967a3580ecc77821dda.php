<div style="width: 100%; display:block;">
<h2><?php echo e(trans('website.WelcomeEamailTitle')); ?></h2>
<p>
	<strong><?php echo e(trans('website.hello')); ?> <?php echo e($userData[0]->first_name); ?> <?php echo e($userData[0]->last_name); ?>!</strong><br>
	<?php echo e(trans('website.accountCreatedText')); ?><br>
	<a href="<?php echo e(route('listings.verify-email-addresss', ['token' => $userData[0]->email_verified_token])); ?>"><?php echo e(trans('website.activeLinkText')); ?></a><br><br>
	<strong><?php echo e(trans('website.Sincerely')); ?>,</strong><br>
	<?php echo e(trans('labels.regardsForThanks')); ?>

</p>
</div><?php /**PATH /home/g2g/public_html/resources/views//mail/confirmEmail.blade.php ENDPATH**/ ?>