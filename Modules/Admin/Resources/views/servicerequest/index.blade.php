@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Service Request List</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Service Request List</li>
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
                            <th>ID</th>
                            <th>Date(Y-M-D)</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>User</th>
                            <th>Vehicle</th>
                            <th>Garage</th>
                            <th>Quote Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                      <tbody>
                      @if(!empty($serviceRequests) && count($serviceRequests) > 0)
                        @foreach($serviceRequests as $serviceRequest)
                          <tr>
                              
                            <td>{{ $serviceRequest->id }}</td>
                            <td>{{ date("Y-m-d g:i a", strtotime($serviceRequest->created_at)) }}</td>
                            <td>{{ $serviceRequest->sr_code }}</td>
                            <td>{{ $serviceRequest->category->name }}</td>
                            <td>{{ $serviceRequest->client->user['first_name'] }} {{ $serviceRequest->client->user['last_name'] }}</td>
                            <td>{{ $serviceRequest->vehicle->vmake->name }}<br/>({{ $serviceRequest->vehicle->vmodel->name }})</td>
                            <td>{{ $serviceRequest->garage->defaultGarageDescription[0]->garages_name }}</td>
                             <td class="text-center">
                                @if(!empty($serviceRequest->quote_amount))
                                {{ 'AED '. $serviceRequest->quote_amount}}
                                @else
                                   {{  ' Not Available ' }}
                                @endif
                            </td>
                             <td class="text-center text-uppercase">
                               {{ $serviceRequest->status }}
                              </td>
                            <td>
                               <a class="btn btn-sm btn-outline-danger "  href="{{ route('superadmin.service-requests.view',['id' => $serviceRequest->id]) }}">
                                  Update
                                </a>
                            </td>
                           
                          </tr>
                         @endforeach
                      @else
                        <tr>
                          <td colspan="8">
                              No Service Request Found.
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                   @if(!empty($serviceRequests) && count($serviceRequests) > 0)
                  <div class="col-xs-12 text-right">
                    {{$serviceRequests->links()}}
                  </div>
                 @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


   
@stop

