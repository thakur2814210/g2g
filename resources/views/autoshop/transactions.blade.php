@extends('autoshop.layout')
@section('content')
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
     <div class="row">
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   @lang('website.My Account')
               </h2>
               <hr >
             </div>

            @include('autoshop.common.sidebar')
       </div>
       <div class="col-12 col-lg-9 ">
             <div class="card">
        <div class="card-header">
         @lang('website.Payment')  @lang('website.List')
       </div>
       
          <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                      <th>#</th>
                  <th> @lang('website.Date')</th>
                  <th> @lang('website.Amount')</th>
                  <th> @lang('website.Payment') @lang('website.Type')</th>
                  <th> @lang('website.For')</th>
                  <th> @lang('website.Status')</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                     <th>#</th>
                    <th> @lang('website.Date')</th>
                  <th> @lang('website.Amount')</th>
                  <th> @lang('website.Payment') @lang('website.Type')</th>
                  <th> @lang('website.For')</th>
                  <th> @lang('website.Status')</th>
                    
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($payments) && count($payments) > 0)
                  @foreach($payments as $index => $payment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                       <td>{{ date('M d, Y',strtotime($payment['date'])) }}</td>
                    
                      <td>AED {{ $payment['amount'] }}</td>
                      <td> {{ trans('website.'.$payment['payment_type']) }}</td>
                      <td>
                          @if(isset($payment['client_package_subscribe_id']))
                            @lang('website.Package Subscription') 
                          @else
                              @lang('website.Service Request')
                          @endif
                      </td>
                      <td>
                        @if($payment['status'] == 1)
                            @lang('website.Success')
                        @elseif($payment['status'] == 2)
                            @lang('website.Failed') 
                        @else
                            @lang('website.Pending')
                        @endif

                      </td>
                      
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        @lang('website.No record found')
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
</section>

 @endsection
