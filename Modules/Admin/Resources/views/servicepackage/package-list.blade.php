@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Service Package List </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Service Package List</li>
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
                    <a href="{{ route('superadmin.service-package.add') }}" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add Service Package
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
                            <th>For</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price / Period</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                           <tr style="background: #e9ecef">
                            <th>Id</th>
                            <th>For</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price / Period</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                         @if(!empty($packages) && count($packages) > 0)
                          @php
                              $allCategory = [];
                              foreach($categories as $category){
                                $allCategory[$category->id] = $category->name;
                              }
                              //dump($allCategory);
                          @endphp
                          @foreach($packages as $package)
                            <tr>
                              <td>{{ $package->id }}</td>
                              <td >
                                @if($package->package_for == 1)
                                  <span class="read">Client</span>
                                @elseif($package->package_for == 2)
                                  <span class="pending">Garage</span>
                                @endif
                              </td>
                              <td>
                                  {{ isset($allCategory[$package->section_id ]) 
                                  ? $allCategory[$package->section_id ] 
                                  : 'N/A'  }}
                              </td>
                              <td>{{ $package->name }}</td>
                              <td >{{ $package->price }} / {{ $package->period }} Days</td>
                              <td >
                                @if($package->status == 1)
                                  <span class="read">Active</span>
                                @elseif($package->status == 3)
                                  <span class="pending">Unpublished</span>
                                @else
                                  <span class="unread">Delete</span>
                                @endif
                              </td>
                              
                              <td>
                                  <a href="{{route('superadmin.service-package.features',['id' => $package->id ])}}" title="Feature List"><button type="button" class="btn btn-sm btn-info"><i class="fa fa-fw fa-list"></i> Feature</button></a>
                                  
                                  <a href="{{route('superadmin.service-package.edit',['id' => $package->id ])}}" title="Edit Package">
                                    <button type="button" class="btn btn-sm btn-warning">
                                      <i class="fa fa-fw fa-edit"></i>
                                    </button>
                                  </a>
                                  
                                  <a href="{{route('superadmin.service-package.delete',['id' => $package->id ])}}" title="Delete Package"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button></a>
                              </td>
                            </tr>
                           @endforeach
                        @else
                          <tr>
                            <td colspan="11">
                                No Package Found.
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

