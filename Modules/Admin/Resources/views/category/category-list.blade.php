@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{$pageTitle}}</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{$pageTitle}}</li>
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
                    <a href="{{ route('superadmin.category.add') }}" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add Category
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
                        <th>Type</th>
                        <th>Name(En)</th>
                        <th>Name(Ar)</th>
                        <th>Slug</th>
                        <th>Status</th>
                         <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr style="background: #e9ecef">
                           <th>Id</th>
                          <th>Type</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Status</th>
                         <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                     @if(!empty($categories) && count($categories) > 0)
                      @foreach($categories as $category)
                        <tr>
                          <td>{{ $category->id }}</td>
                          <td>
                            @if($category->type == 1)
                              <span class="badge bg-green">{{ strtoupper('Quote') }}</span>
                            @else
                              <span class="badge bg-blue">{{ strtoupper('Package') }}</span>
                            @endif
                          </td>
                          <td>{{ $category->name_en }}</td>
                          <td>{{ $category->name_ar }}</td>
                          <td>{{ $category->slug }}</td>
                          <td class="text-center">
                            @if($category->status == 1)
                              <span class="badge bg-green">Active</span>
                            @elseif($category->status == 3)
                              <span class="badge bg-blue">Unpublished</span>
                            @else
                              <span class="badge bg-red">Delete</span>
                            @endif
                          </td>
                          <td>
                               <a href="{{ route('superadmin.subcategory.list',['id' => $category->id]) }}" title="Sub Category List"><button type="button" class="btn btn-sm btn-info"><i class="fa fa-fw fa-list"></i> SubCat</button></a>
                              <a href="{{ route('superadmin.category.edit',['id' => $category->id]) }}" title="Edit Category"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></button></a>
                              <a href="{{ route('superadmin.category.delete',['id' => $category->id]) }}" title="Delete Category"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button></a>
                          </td>
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="6">
                            No Category Found.
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

