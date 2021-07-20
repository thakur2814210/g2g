@extends('autoshop.layout')
@section('content')
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
     <div class="row">
         
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   @lang('website.My Address')
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
          <i class="fa fa-list"></i> @lang('website.My Address')
        </div>
        <div class="card-body">
          <div style="padding-bottom: 10px;">
           <a class="btn btn-sm btn-outline-danger "  href="{{ URL::to('/my-address/add')}}">
            <i class="fa fa-plus"></i> @lang('website.Add') @lang('website.Address')</a>
           </div>
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>@lang('website.Address')</th>
                  <th>@lang('website.Status')</th>
                  <th>@lang('website.Action')</th>
                </tr>
              </thead>
              <tbody>
                @if(!empty($result['clientLocation']) && count($result['clientLocation']) > 0)
                  @foreach($result['clientLocation'] as $index => $clientLocation)
                    <tr>
                      <td class="text-center">{{ $index + 1 }}</td>
                      <td>{{$clientLocation->address}}</td>
                      <td>{{$clientLocation->status}}</td>
                      <td>
                          <a class="btn btn-sm btn-outline-danger "  href="{{ URL::to('/my-address/edit/'.$clientLocation->id)}}">
                            {{ trans('website.Update')}}
                          </a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        {{ trans('website.No record found')}}
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

@stop



