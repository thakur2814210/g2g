<div bgcolor="#ffffff" text="#000000" style="margin:0;border:0;padding:0">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border:solid 8px #ffffff;font-family:Arial,Helvetica,sans-serif;font-size:12px" bgcolor="#f4f4f4">
		<tbody>
			<tr style="border:0;margin:0;padding:0">
				<td style="border:0;padding:15px;margin:0">
					<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border:0;margin:0;padding:0;clear:both">
						<tbody>
							<tr style="border:0;margin:0;padding:0">
								<td style="border:0;margin:0;padding:0 0 5px 2px;font-family:Arial,Helvetica,sans-serif;font-size:20px;color:#999999">{{ 'Service Request' }}</td>
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
											@if($data->garageSendQuoteAmount == 1)
											<tr style="padding:0;margin:0;border:0">
												<td colspan="2" style="padding:0 0 8px 0;margin:0;border:0;vertical-align:top">
													<div style="font-size:18px;color:#333333">Garage have mention the quote amount for the service.</div>
												</td>
											</tr>
											@endif
											@if($data->customerAcceptQuoteAmount == 1)
											<tr style="padding:0;margin:0;border:0">
												<td colspan="2" style="padding:0 0 8px 0;margin:0;border:0;vertical-align:top">
													<div style="font-size:18px;color:#333333">Customer have accepted the quoute amount by the garage for this service request.</div>
												</td>
											</tr>
											@endif
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ 'Service Request Reference' }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{$data->sr_code }}</td>
											</tr>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ trans('labels.Category') }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ $data->category }}</td>
											</tr>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ 'Customer Name' }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">
												    <span>{{ $data->client_name }}</span>
												</td>
											</tr>
											
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ 'Customer Email' }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">
												    <span>{{ $data->client_email }}</span>
												</td>
											</tr>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ 'Customer Phone' }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">
												    <span>{{ $data->client_phone }}</span>
												</td>
											</tr>
											
											
												<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ trans('labels.Garage') }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ $data->garage }}</td>
											</tr>
											
										
												<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ 'Garage Email' }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ $data->garage_email }}</td>
											</tr>
											
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ trans('labels.Vehicle') }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ $data->vehicle }}</td>
											</tr>
											@if(!empty($data->appointment_at))
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ trans('labels.Appointment At') }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ $data->appointment_at }}</td>
											</tr>
											@endif
											
											@if(!empty($data->quote_amount))
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ trans('labels.Quote Amount') }}</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ 'AED ' . $data->quote_amount }}</td>
											</tr>
											@endif
											
											@if(!empty($data->faults_remarks))
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ 'Faults Remarks' }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ $data->faults_remarks }}</td>
											</tr>
											@endif
											
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ trans('labels.Address') }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ $data->address . ', ' .  $data->pobox  }}</td>
											</tr>
											<tr style="padding:0;margin:0;border:0">
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ trans('labels.Time') }}:</td>
												<td style="padding:3px 0 0 0;margin:0;border:0">{{ date('m/d/Y', strtotime($data->created_at)) }}</td>
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
</div>