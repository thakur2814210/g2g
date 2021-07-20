@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Service Package Feature </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Service Package Feature</li>
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
                    <a href="{{ route('superadmin.service-package.features.add') }}" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Service Package Feature
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
                          <th>Code</th>
                          <th>Service Package</th>
                          <th>Name</th>
                          <th width="30%">Value</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                          <th>Id</th>
                          <th>Code</th>
                          <th>Service Package</th>
                          <th>Name</th>
                          <th width="30%">Value</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    <tbody>
                      @if(!empty($packagefeatures) && count($packagefeatures) > 0)

                       @php
                            $allPackages = [];
                            foreach($packages as $val){
                              $allPackages[$val->id] = $val->slug;
                            }
                        @endphp
                       

                        @foreach($packagefeatures as $pakagefeature)
                          <tr>
                            <td>{{ $pakagefeature->id }}</td>
                            <td>{{ $pakagefeature->pf_code }}</td>
                            <td>
                              {{ isset($allPackages[$pakagefeature->service_package_id]) ? $allPackages[$pakagefeature->service_package_id] : 'N/A'  }}
                            </td>
                            <td>{{ $pakagefeature->feature_name }}</td>
                            <td>{{ $pakagefeature->feature_value }}</td>
                            
                            <td class="text-center">
                              @if($pakagefeature->status == 1)
                                <span class="read">Active</span>
                              @else
                                <span class="unread">Disable</span>
                              @endif
                            </td>
                            
                            <td>
                                <a href="{{ route('superadmin.service-package.features.edit' ,['id' => $pakagefeature->id])}}" title="Edit Package"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button></a>
                                <a href="{{ route('superadmin.service-package.features.delete' ,['id' => $pakagefeature->id])}}" title="Delete Package"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                            </td>
                          </tr>
                         @endforeach
                      @else
                        <tr>
                          <td colspan="7">
                              No Package Fetuare Found.
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


@section('js')
    <script src="{{ asset('website-theme/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  
    
    <script src="{{ asset('website-theme/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('website-theme/admin/vendor/jquery.selectbox-0.2.js') }}"></script>  
    <script src="{{ asset('website-theme/admin/vendor/retina-replace.min.js') }}"></script>
    <script src="{{ asset('website-theme/admin/vendor/jquery.magnific-popup.min.js') }}"></script>
    

     <script src="{{ asset('website-theme/admin/js/admin-datatables.js') }}"></script>

   
@stop