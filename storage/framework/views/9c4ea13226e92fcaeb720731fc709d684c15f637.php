<div style="width: 100%; display:block;">

<p>
	<strong>Hello,</strong><br>
    The garage <?php echo e($data->garage); ?> has cancelled the service request number <?php echo e($data->sr_code); ?>. Please follow up with the garage for any queries.<br/><br/>
	
	<b>Garage Information:</b><br/>
	Garage Name: <?php echo e($data->garage); ?><br/>
	Email: <?php echo e($data->garage_email); ?><br/>
	Contact No: <?php echo e($data->garage_phone); ?><br/><br/>
	
    <b>Customer Information:</b><br/>
	Name: <?php echo e($data->client_name); ?><br/>
	Email : <?php echo e($data->client_email); ?><br/>
	Contact No: <?php echo e($data->client_phone); ?><br/>
	Vehicle : <?php echo e($data->vehicle); ?> <br/><br/>
	
	<strong>Thanks & Sincerely,</strong><br>
	G2G Team
</p>
</div><?php /**PATH /home/g2g/public_html/resources/views//mail/service-request/serviceRequestCancel.blade.php ENDPATH**/ ?>