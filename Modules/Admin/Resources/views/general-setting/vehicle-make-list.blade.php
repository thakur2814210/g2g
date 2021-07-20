@extends('admin::layouts.master')

@section('content')


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Vehicle Make List</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Vehicle Make List</li>
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
                    <a href="{{ route('superadmin.settings.vehicle-make.add') }}" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Vehicle Make
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
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                          <th>Id</th>
                          <th>Name</th>
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      @if(!empty($lists) && count($lists) > 0)
                        @foreach($lists as $list)
                          <tr>
                            	<td>{{ $list->id }}</td>
                             	<td>{{ $list->name }}</td>
                             	<td>{{ ($list->active) ? 'Yes' : 'No' }}</td>
                              <td>
                                <a href="{{ route('superadmin.settings.vehicle-make.edit',['id' => $list->id])}}">
                                  <button type="button" class="btn btn-sm btn-warning">
                                    <i class="fa fa-fw fa-edit"></i> Edit
                                  </button>
                                </a>
                                @if($list->active == 1)
                                 <a href="{{ route('superadmin.settings.vehicle-make.delete',['id' => $list->id])}}">
                                  <button type="button" class="btn btn-sm btn-danger">
                                    <i class="fa fa-fw fa-times"></i> Inactive
                                  </button>
                                </a>
                                @endif
                              </td>
                          </tr>
                         @endforeach
                      @else
                        <tr>
                          <td colspan="5">
                              No Vehicle Make Found.
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
