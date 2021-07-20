@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Testimonials</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Testimonials</li>
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
                    <a href="{{ route('superadmin.pages.testimonial.add') }}" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add Testimonials
                      </button>
                    </a>
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
                          <th>Name</th>
                          <th>Designation)</th>
                          <th>Ordering</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(!empty($testimonials) && count($testimonials) > 0)
                          @foreach($testimonials as $testimonial)
                            <tr>
                              <td>{{ $testimonial->id }}</td>
                              <td>{{ $testimonial->name_en }} ( {{ $testimonial->name_ar }} )</td>
                              <td>{{ $testimonial->designation_en }} ( {{ $testimonial->designation_ar }} ) </td>
                              <td>{{ $testimonial->ordering }}</td>
                              <td>
                                @if($testimonial->status == 1)
                                  <span class=" text-success">Active</span>
                                @else
                                  <span class=" text-danger">Unpublished</span>
                                @endif
                              </td>
                              
                              <td>
                                  <a href="{{ route('superadmin.pages.testimonial.edit',['id' => $testimonial->id])}}">
                                    <button type="button" class="btn btn-sm btn-warning">
                                      <i class="fa fa-fw fa-edit"></i> Edit
                                    </button>
                                  </a>
                              </td>
                            </tr>
                           @endforeach
                        @else
                          <tr>
                            <td colspan="5">
                                No Testimonial Found.
                            </td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                    <div class="row" style="padding: 20px;">
                       @if(!empty($testimonials) && count($testimonials) > 0)
                         {{ $testimonials->links() }}
                       @endif
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>
   </div>
@stop

@section('css')
  
@stop

@section('js')
  
@stop
