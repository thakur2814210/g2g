@extends('garage::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customers Service Request</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Customers Service Request</li>
    </ol>
  </section>

  <!-- Main content -->
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

    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <table id="example1" class="table table-bordered table-striped">


         
              <thead>
                  <tr style="background: #e9ecef">
                  <th>#</th>
                  <th>Date</th>
                  <th>User</th>
                  <th>Code / Category</th>
                  <th>Quote Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef"> 
                    <th>#</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Code / Category</th>
                    <th>Quote Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($customers) && count($customers) > 0)
                  @foreach($customers as $index => $customer)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $customer['updated_at'] }}</td>
                       <td>{{ $customer['client']['username'] }}</td>
                      <td>
                           {{ $customer['sr_code']  .'('.  $customer['category']['name'].')' }}
                      </td>
                       
                      <td>
                          {{ (!empty($customer['quote_amount']) ? 'AED '. $customer['quote_amount'] : ' Not Available ' )}}
                      </td>
                    
                      <td class="text-uppercase">
                         {{ $customer['status']}}
                      </td>
                      
                      <td>
                      
                        <a class="btn btn-sm btn-outline-danger "  href="{{ route('garage.customers.service-request.settings',['id' =>$customer['id'] ])}}">
                          Update
                        </a>
                        &nbsp;
                        <a  class="btn btn-sm btn-outline-danger" href="{{ route('garage.customers.service-request.logs',['id' =>$customer['id'] ])}}">
                          Log
                        </a>

                      </td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        No records Found.
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>

        </div>

       



@stop


@section('website_js')

    <script src="{{ asset('website-theme/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  
    
    <script src="{{ asset('website-theme/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('website-theme/admin/vendor/jquery.selectbox-0.2.js') }}"></script>  
    <script src="{{ asset('website-theme/admin/vendor/retina-replace.min.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery.magnific-popup.min.js') }}"></script>
    

    <script src="{{ asset('website-theme/admin/js/admin-datatables.js') }}"></script>
    
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
   
   
  
  
    

  
    
@stop
