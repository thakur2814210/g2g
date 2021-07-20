@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Contact Us</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Contact Us</li>
    </ol>
  </section>

    <!-- Main content -->
  <section class="content">

    <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
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
                <form class="form-horizontal" method="POST" action="{{ route('superadmin.pages.contactus.update')}}" enctype="multipart/form-data">
                   {{ csrf_field() }}
                  <input type="hidden" name="id"  value="{{ !is_null($contactUs) ? $contactUs->id : 1 }}" />
                  <div class="card-body">

                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Contact Form Mail Address</label>
                      <div class="col-sm-12">
                        <input type="email" class="form-control" name="contact_form_mail_address" id="contact_form_mail_address" value="{{ !is_null($contactUs) ? $contactUs->contact_form_mail_address : null }}" required />
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Phone</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ !is_null($contactUs) ? $contactUs->phone : null }}" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Mobile</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="mobile" id="mobile" value="{{ !is_null($contactUs) ? $contactUs->mobile : null }}" required />
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Email</label>
                      <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" id="email" value="{{ !is_null($contactUs) ? $contactUs->email : null }}" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Address(English)</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="address_en" id="address_en" value="{{ !is_null($contactUs) ? $contactUs->address_en : null }}" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Address(Arabic)</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="address_ar" id="address_ar" value="{{ !is_null($contactUs) ? $contactUs->address_ar : null }}" required />
                      </div>
                    </div>

                    
                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Latitude</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="latitude" id="latitude"  value="{{ !is_null($contactUs) ? $contactUs->latitude : null }}" required />
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Longitude</label>
                      <div class="col-sm-12">
                       <input type="text" class="form-control" name="longitude" id="longitude"  value="{{ !is_null($contactUs) ? $contactUs->longitude : null }}" required />
                      </div>
                    </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Upadte Contact Us Info</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop
