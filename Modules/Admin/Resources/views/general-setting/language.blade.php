@extends('admin::layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
   <link rel="stylesheet" href="{{ asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css') }}">
   <style type="text/css">
     select.form-control:not([size]):not([multiple]){
      height: 30px;
     }
     .form-control-sm, .input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn{
        padding: .25rem .5rem !important;
     }
   </style>
@stop

@section('breadcrumb')
   <ol class="breadcrumb">
       <li class="breadcrumb-item">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Language</li>
    </ol>
@stop

@section('content')

    <div class="row">
      <div class="col-12">
          @if (session('status'))
              <div class="alert alert-warning">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>

     <div class="box_general padding_bottom">
        <div class="header_box version_2">
          <h2  class="text-danger"><i class="fa fa-users text-danger"></i> Language</h2>
        </div>
         <div class="table-responsive">
          <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr style="background: #e9ecef">
                <th>Code</th>
                <th>Name</th>
                <th>Text Direction</th>
                <th>Folder Name</th>
                <th>Order</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
               <tr style="background: #e9ecef">
                <th>Code</th>
                <th>Name</th>
                <th>Text Direction</th>
                <th>Folder Name</th>
                <th>Order</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
            @if(!empty($languages) && count($languages) > 0)
              @foreach($languages as $language)
                <tr>
                    <td>{{ $language->language_code }}</td>
                  	<td>{{ $language->name }}</td>
                    <td>{{ $language->text_direction }}</td>
                    <td>{{ $language->folder_name }}</td>
                     <td>{{ $language->language_order }}</td>
                   	<td>{{ ($language->status) ? 'Yes' : 'No' }}</td>
                    <td>
                      <a href="#">
                        <button type="button" class="btn btn-sm btn-warning">
                          <i class="fa fa-fw fa-edit"></i>
                        </button>
                      </a>
                    </td>
                </tr>
               @endforeach
            @else
              <tr>
                <td colspan="7">
                    No Language Found.
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
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