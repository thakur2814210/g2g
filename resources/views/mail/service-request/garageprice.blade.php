<div style="width: 100%; display:block;">

<p>
	<strong>Hello,</strong><br>
	The garage {{$data->garage}} has updated the order number {{ $data->sr_code }} with the following amount: {{ $data->quote_amount }}. <br/>
	Please make the payment using Web\App, so respective Garage can proceed with order.<br/><br/>
	
	<b>Garage Information:</b><br/>
	Garage Name: {{ $data->garage }}<br/>
	Email: {{ $data->garage_email }}<br/>
	Contact No: {{ $data->garage_phone }}<br/><br/>
	
    <b>Customer Information:</b><br/>
	Name: {{ $data->client_name }}<br/>
	Email : {{ $data->client_email }}<br/>
	Contact No: {{ $data->client_phone }}<br/>
	Vehicle : {{ $data->vehicle }} <br/><br/>
	
	<strong>Thanks & Sincerely,</strong><br>
	G2G Team
</p>
</div>