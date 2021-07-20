@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add FAQ</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="breadcrumb-item">
            <a href="{{ route('superadmin.pages.faq') }}">FAQ List</a>
        </li>
      <li class="active">Add FAQ</li>
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

                <form class="form-horizontal" method="POST" action="{{ route('superadmin.pages.faq.save')}}" enctype="multipart/form-data">
                   {{ csrf_field() }}
                <div class="box-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tag_name" class="col-md-12 col-form-label">Category Name(English)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="cat_name_en" id="cat_name_en" placeholder="Enter Category Name" required="required" />
                        </div>
                      </div>
                      

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Heading(English)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="heading_en" id="heading_en" placeholder="Enter Heading" required="required" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Answer(English)</label>
                        <div class="col-md-12">
                        

                           <textarea id="answer_en" name="answer_en" required="required" class="form-control" rows="5"></textarea>
                        </div>
                      </div>
                    </div>
                 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tag_name" class="col-md-12 col-form-label">Category Name(Arabic)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="cat_name_ar" id="cat_name_ar" placeholder="Enter Category Name" required="required" />
                        </div>
                      </div>
                      

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Heading(Arabic)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="heading_ar" id="heading_ar" placeholder="Enter Heading" required="required" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Answer(Arabic)</label>
                        <div class="col-md-12">
                           <textarea id="answer_ar" name="answer_ar" required="required" class="form-control" rows="5"></textarea>
                         
                        </div>
                      </div>
                    </div>
                  </div>

                   <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tag_status" class="col-md-12 col-form-label">Status</label>
                          <div class="col-md-12">
                            <select class="form-control" name="status" id="status" required="required">
                                <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">Delete</option>
                                <option value="3">Unpublished</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Create FAQ</button>
                  <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
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


@section('js')
    

    <script type="text/javascript">
    $(function() {

        CKEDITOR.replace('answer_ar');
         CKEDITOR.replace('answer_en');

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>
@stop