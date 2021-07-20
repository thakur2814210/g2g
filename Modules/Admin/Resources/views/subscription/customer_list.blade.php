@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customer Packages Subscritpion List</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Garage Packages Subscritpion List</li>
    </ol>
  </section>


<!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-12">
          @if (session('status'))
              <div class="alert alert-warning">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>

     <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12 form-inline" id="contact-form">
                     <form>
               <div class="form-group">
                <span>Status Filter:</span>
                 <select class="custom-select mr-sm-2" id="f_status" name="f_status">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="cancel">Cancel</option>
                    <option value="inactive">InActive</option>
                    <option value="request-payment">Request-payment</option>
                     <option value="received-payment">Received-Paymentt</option>
                    <option value="required-payment-approval">Required-Payment-Approval</option>
                  </select>
              </div>
              </form>
                   </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                       <tr style="background: #e9ecef">
                          <th>Id</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Package</th>
                          <th>Garage</th>
                          <th>Username</th>
                           <th>Status</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr style="background: #e9ecef">
                          <th>Id</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Package</th>
                          <th>Garage</th>
                          <th>Username</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @if(!empty($subscriptions) && count($subscriptions) > 0)
                      @foreach($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->updated_at }}</td>
                            <td>AED {{ number_format($subscription->amount, 2) }}</td>
                            <td>{{ $subscription->servicePackage->name }}</td>
                            <td>{{ $subscription->garage->defaultGarageDescription[0]->garages_name }}</td>
                            <td>{{ $subscription->garage->username }}</td>
                            <td>
                                @if($subscription->status == 1)
                                  Active
                                @elseif($subscription->status == 2)
                                  Cancel
                                @elseif($subscription->status == 3)
                                  Pending
                                @elseif($subscription->status == 4)
                                  Inactive
                                @elseif($subscription->status == 5)
                                  Request-Payemnt
                                @elseif($subscription->status == 6)
                                  Received-Payment
                                @elseif($subscription->status == 7)
                                  Required-Payment-Approval
                                @endif
                            </td>
                            <td>
                               <a class="btn btn-sm btn-outline-danger "  href="{{route('superadmin.subscriptions.clients.settings',['id' => $subscription->id])}}">
                                  Update
                                </a>
                                &nbsp;
                                <a  class="btn btn-sm btn-outline-danger" href="{{route('superadmin.subscriptions.clients.logs',['id' => $subscription->id])}}">
                                  Logs
                                </a>
                            </td>
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="8">
                            No Active Subscription Found.
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@stop
