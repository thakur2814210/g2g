@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Privacy Policy</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Privacy Policy</li>
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

                <form class="form-horizontal" method="POST" action="{{ route('superadmin.pages.update.content')}}" enctype="multipart/form-data">
                   {{ csrf_field() }}
                   <input type="hidden" name="page_type" value="privacy-policy">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Content(English)</label>
                      <div class="col-sm-12">
                        <textarea class="form-control faq_textarea" rows="5" name="privacy_policy_en" id="about_us_content_en" placeholder="" required="required" > {{(!empty($privacyPolicy->privacy_policy_en))? $privacyPolicy->privacy_policy_en : ''}}</textarea>
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Content(Arabic)</label>
                      <div class="col-sm-12">
                        <textarea class="form-control faq_textarea" rows="5" name="privacy_policy_ar" id="about_us_content_ar" placeholder="Enter About-Us Contnet" required="required" > {{(!empty($privacyPolicy->privacy_policy_ar))? $privacyPolicy->privacy_policy_ar : ''}}</textarea>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Update</button>
                    </div>
                </div>
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

        CKEDITOR.replace('privacy_policy_en');
         CKEDITOR.replace('privacy_policy_ar');

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>
@stop

