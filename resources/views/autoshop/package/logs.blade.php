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

           <div class="box_general padding_bottom">
       <div class="card">
        <div class="card-header">
         @lang('website.Package Subscription') @lang('website.Log') : {{ $clientPackageSubscribe->servicePackage->name }}
       </div>
       
          <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>@lang('website.Date')</th>
                  <th>@lang('website.Descriptions')</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>@lang('website.Date')</th>
                  <th>@lang('website.Descriptions')</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($logs) && count($logs) > 0)
                  @foreach($logs as $log)
                    <tr>
                      <td>{{ date('M d, Y', strtotime($log->date)) }}</td>
                      <td>{{ $log->description }}</td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="3">
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
 </section>

@stop

