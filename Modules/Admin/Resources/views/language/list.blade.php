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
        <li class="breadcrumb-item active">Language List</li>
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
          <h2  class="text-danger"><i class="fa fa-users text-danger"></i>Language List</h2>
           <ul class="nav nav-pills nav-justified text-uppercase">
              @foreach($modules as $index => $module)
                <li class="nav-item">
                  <a class="nav-link @if($index == 0) active @endif" id="pills-{{strtolower($module)}}-tab" data-toggle="pill" href="#pills-{{strtolower($module)}}" role="tab" aria-controls="pills-{{strtolower($module)}}" aria-selected="true"><i class="fa fas fa-list"></i> {{$module}}</a>
                </li>
              @endforeach
            </ul>
        </div>

        <div class="card">
            <div class="tab-content" id="pills-tabContent">

              @foreach($modules as $index =>  $module)

                <div class="tab-pane fade show @if($index == 0) active @endif" id="pills-{{strtolower($module)}}" role="tabpanel" aria-labelledby="pills-{{strtolower($module)}}-tab">
                  <div class="table-responsive p-2">
                      <div class="alert alert-primary">{{$module}} Langauge</div>
                      <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr style="background: #e9ecef">
                            <th>Key</th>
                            <th>English Trans</th>
                            <th>Arabic Trans</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                           <tr style="background: #e9ecef">
                            <th>Key</th>
                            <th>English Trans</th>
                            <th>Arabic Trans</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @if(!empty($languages[$module]) && count($languages[$module]) > 0)
                          @foreach($languages[$module] as $k => $language)
                            <tr>
                               <td>{{ $k }}</td>
                               <td>{{ isset($language['en']) ? $language['en'] : '' }}</td>
                               <td>{{ isset($language['ar']) ? $language['ar'] : ''  }}</td>
                               <td>
                                  <a  data-toggle="modal" data-target="#languageDataUpdate" data-key="{{ $k }}"  data-english="{{ $language['en'] }}" data-arabic="{{ $language['ar'] }}" data-module="{{ $module }}">
                                     <button type="button" class="btn btn-sm btn-danger">
                                      <i class="fas fa fa-edit"></i> Edit
                                    </button>
                                  </a>
                               </td>
                            </tr>
                           @endforeach
                        @else
                          <tr>
                            <td colspan="4">
                                No Language Translation Key Found.
                            </td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
    </div>

    @include('admin::modals.language-data-upadte')
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

   <script >
        $(document).ready(function() {
          $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
            var lang_key =  $(this).data('key');
            var english_lang = $(this).data('english');
            var arabic_lang = $(this).data('arabic');
            var lang_module = $(this).data('module');
            $('#lang_key').val(lang_key);
            $('#english_lang_content').val(english_lang);
            $('#arabic_lang_content').val(arabic_lang);
            $('#lang_module').val(lang_module);
          });
        });
    </script>
   
@stop