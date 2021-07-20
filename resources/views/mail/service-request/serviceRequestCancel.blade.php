<div style="width: 100%; display:block;">

<p>
	<strong>Hello,</strong><br>
    The garage {{$data->garage}} has cancelled the service request number {{ $data->sr_code }}. Please follow up with the garage for any queries.<br/><br/>
	
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