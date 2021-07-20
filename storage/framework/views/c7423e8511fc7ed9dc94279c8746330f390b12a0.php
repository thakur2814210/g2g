<div bgcolor="#ffffff" text="#000000" style="margin:0;border:0;padding:0">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border:solid 8px #ffffff;font-family:Arial,Helvetica,sans-serif;font-size:12px" bgcolor="#f4f4f4">
		<tbody>
			<tr style="border:0;margin:0;padding:0">
				<td style="border:0;padding:15px;margin:0">
					<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border:0;margin:0;padding:0;clear:both">
						<tbody>
							<tr style="border:0;margin:0;padding:0">
								<td style="border:0;margin:0;padding:0 0 5px 2px;font-family:Arial,Helvetica,sans-serif;font-size:20px;color:#999999"><?php echo e('Service Request'); ?></td>
								<td style="border:0;margin:0;padding:0 2px 5px 0;text-align:right;width:130px"></td>
							</tr>
						</tbody>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border:solid 1px #cccccc;border-radius:5px;clear:both" bgcolor="#FFFFFF">
						<tbody>
							<tr style="border:0;margin:0;padding:0">
								<td style="border:0;margin:0;padding:10px;font-family:Arial,Helvetica,sans-serif;font-size:12px">

									<table border="0" cellspacing="0" cellpadding="0" width="100%" style="color:#000000;background:#ffffff;min-width:450px;border:none;border-collapse:collapse;table-layout:fixed;text-align:left;padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px">
										<colgroup><col style="width:200px"><col width="*"></colgroup>
										<tbody>
											<tr style="padding:0;margin:0;border:0">
												<td colspan="2" style="padding:0 0 8px 0;margin:0;border:0;vertical-align:top">
													<div style="font-size:18px;color:#333333">G2G - GARAGE TO GO SERVICES</div>
												</td>
											</tr>
											<?php if($data->garageSendQuoteAmount == 1): ?>
											<tr style="padding:0;margin:0;border:0">
												<td colspan="2" style="padding:0 0 8px 0;margin:0;border:0;vertical-align:top">
													<div style="font-size:18px;color:#333333">You have mention the quote amount for the service request.</div>
												</td>
											</tr>
											<?php endif; ?>
											<?php if($data->customerAcceptQuoteAmount == 1): ?>
											<tr style="padding:0;margin:0;border:0">
												<td colspan="2" style="padding:0 0 8px 0;margin:0;border:0;vertical-align:top">
													<div style="font-size:18px;color:#333333">Customer have accepted the quoute amount by the garage for this service request.</div>
												</td>
											</tr>
											<?php endif; ?>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e('Service Request Reference'); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->sr_code); ?></td>
											</tr>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(trans('labels.Category')); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->category); ?></td>
											</tr>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e('Customer Name'); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">
												    <span><?php echo e($data->client_name); ?></span>
												</td>
											</tr>
											
											
											
											
												<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(trans('labels.Garage')); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->garage); ?></td>
											</tr>
											
										
												<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e('Garage Email'); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->garage_email); ?></td>
											</tr>
											
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(trans('labels.Vehicle')); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->vehicle); ?></td>
											</tr>
											<?php if(!empty($data->appointment_at)): ?>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(trans('labels.Appointment At')); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->appointment_at); ?></td>
											</tr>
											<?php endif; ?>
											
											<?php if(!empty($data->quote_amount)): ?>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(trans('labels.Quote Amount')); ?></td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e('AED ' . $data->quote_amount); ?></td>
											</tr>
											<?php endif; ?>
											
											<?php if(!empty($data->faults_remarks)): ?>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e('Faults Remarks'); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->faults_remarks); ?></td>
											</tr>
											<?php endif; ?>
											
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(trans('labels.Address')); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e($data->address . ', ' .  $data->pobox); ?></td>
											</tr>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(trans('labels.Time')); ?>:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0"><?php echo e(date('m/d/Y', strtotime($data->created_at))); ?></td>
											</tr>
										</tbody>
									</table>

								</td>
							</tr>
						</tbody>
					</table>
					<div>Please retain this receipt for your records.<br><br>For more information, please visit <a href="http://www.g2g.ae/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.g2g.ae/&amp;source=gmail&amp;ust=1603507227109000&amp;usg=AFQjCNGpDulei7ygQ7dQ83N8JagSesy93Q">http://www.g2g.ae/</a> or contact <a href="mailto:info@g2g.ae" target="_blank">info@g2g.ae</a></div>
					<br>
				</td>
			</tr>
		</tbody>
	</table>
</div><?php /**PATH D:\xampp74\htdocs\g2g\resources\views//mail/service-request/create/garage.blade.php ENDPATH**/ ?>