@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Sub-Section List</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="breadcrumb-item">
            <a href="{{ route('superadmin.category.list') }}">Section List</a>
        </li>
      <li class="breadcrumb-item active">Sub-Section List</li>
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
                    <a href="{{ route('superadmin.subcategory.add') }}" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i>  Add Sub-Category
                      </button>
                    </a>
                   </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">

                  <table id="example1" class="table table-bordered">
                    <thead>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                        <th>Subsection</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                        <th>Subsection</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                     @if(!empty($categories) && count($categories) > 0)

                      @foreach($categories as $category)
                        <tr>
                          <td>{{ $category->id }}</td>
                          
                          <td>{{ $category->subsection_name_en }} <br/>( {{ $category->subsection_name_ar }} )</td>
                          <td>{{ $category->slug }}</td>
                          <td>
                            @if($category->status == 1)
                              <span class="badge bg-green">Active</span>
                            @elseif($category->status == 3)
                              <span class="badge bg-blue">unpublished</span>
                            @else
                              <span class="badge bg-red">Delete</span>
                            @endif
                          </td>
                          <td>{{ $category->section_name_en }} <br/> ( {{ $category->section_name_ar }} ) </td>
                          <td>
                              <a href="{{ route('superadmin.subcategory.edit',['id' => $category->id]) }}"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></button></a>
                              <a href="{{ route('superadmin.subcategory.delete',['id' => $category->id]) }}"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button></a>
                          </td>
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="9">
                            No Sub Category Found.
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                @if(!empty($categories) && count($categories) > 0)
                  <div class="col-xs-12 text-right">
                    {{$categories->links()}}
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



