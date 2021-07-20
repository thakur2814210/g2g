
<div style="padding: 5px;">
  <div style="width: 100%; display: block">
    <h2>{{ trans('labels.OrderID') }}# {{ $data->ps_code }} 
    <h3>{{ trans('labels.OrderedDate') }}: {{ date('m/d/Y', strtotime($data->created_at)) }}</h3>
  </div>
  
  <!-- info row -->
  <div style="width: 100%;padding: 0 0 20px;">
    <div > <strong>{{ trans('labels.CustomerInfo') }}:</strong>
      <address>
      <span style="text-transform: capitalize;">{{ $data->customers_name }}</span><br>
      {{ $data->customers_street_address }} <br>
        {{ $data->customers_city }}, {{ $data->customers_postcode }}, {{$data->customers_country }}<br>
        {{ trans('labels.Phone') }}: {{ $data->customers_telephone }}<br>
        {{ trans('labels.Email') }}: {{ $data->email }}
      </address>
    </div>
    <br/>
    <br/>
    <div> <strong>{{ trans('labels.PackageInfo') }}:</strong>
      <address>
        <span style="text-transform: capitalize;">
         {{ trans('labels.Package Name') }}: {{ $data->package_name }}</span><br>
         {{ trans('labels.Status') }}: {{ $data->package_status }}</span><br>
        {{ trans('labels.Vehicle') }}: {{ $data->vehicle_plate_no }}<br>
        {{ trans('labels.Garage') }}: {{ $data->garage_name }}<br>
        {{ trans('labels.subscription_start_at') }}: {{ $data->subscription_start_at }}<br>
        {{ trans('labels.subscription_end_at') }}: {{ $data->subscription_end_at }}<br>
      </address>
    </div>
    <br/>
    <br/>
    <div> <strong>{{ trans('labels.PaymentInfo') }}:</strong>
      <address>
        <span style="text-transform: capitalize;">
        {{ trans('labels.Amount') }}: {{ $data->package_payment_amount }}<br>
        {{ trans('labels.Status') }}: {{ $data->package_payment_status }}<br>
        {{ trans('labels.Date') }}: {{ $data->package_payment_date }}<br>
        {{ trans('labels.PaymentMethods') }}: {{ ($data->package_payment_type == 'cod') ? 'Cash On Delivery' : 'Credit Card' }}<br>
      </address>
    </div>
   
    
    <!-- /.col --> 
  </div>
  <!-- /.row --> 

</div>
