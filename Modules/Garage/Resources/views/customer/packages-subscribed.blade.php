@extends('garage.layout')


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Customers Packages Subscription List</h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li class="active">Customers Packages Subscription List</li>
      </ol>
    </section>
   
   <section class="content">




   
    <div class="row">
      <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>

 

     
      <div class="box box-danger">
          <div class="box-body">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Service Package</th>
                  <th>Amount</th>
                  <th>Duration</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Service Package</th>
                    <th>Amount</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th width="20%">Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($customers) && count($customers) > 0)
                  @foreach($customers as $customer)
                    <tr>
                      <td>{{ date('M d, Y', strtotime($customer['created_at'])) }}</td>
                      <td>{{ $customer['client']['user']['first_name'] . ' ' .$customer['client']['user']['last_name'] }}</td>
                      <td>{{ $customer['servicePackage']['name'] }}</td>
                      <td>AED {{ number_format($customer['amount'] ,2) }}</td>

                      <td>
                          @if(!empty($customer['subscription_start_at']) && !empty($customer['subscription_start_at']))
                            {{ date('M d, Y', strtotime($customer['subscription_start_at'])) }} - {{ date('M d, Y', strtotime($customer['subscription_end_at'])) }}
                          @else
                            {{ '--'}}
                          @endif
                      </td>
                       <td class="text-uppercase">
                          {{ $packageStatus[$customer['status']]}}
                      </td>
                      <td>
                          @if($customer['servicePackage']['slug'] == 'custom-package')
                            <a class="btn btn-sm btn-outline-danger" href="{{route('garage.customers.packages-subscribed.custom.settings',['id' => $customer['id']])}}" title="Setting">Update</a>
                          @else
                            <a class="btn btn-sm btn-outline-danger" href="{{route('garage.customers.packages-subscribed.settings',['id' => $customer['id']])}}" title="Setting">Update</a>
                          @endif
                          <a class="btn btn-sm btn-outline-danger" href="{{route('garage.customers.packages-subscribed.logs',['id' => $customer['id']])}}" title="Logs">Log</a>
                      </td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        No Customer package subscription found.
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
   

@stop
