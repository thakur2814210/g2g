@extends('admin::layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Section</h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li class="breadcrumb-item">
            <a href="{{ route('superadmin.category.list') }}">Section List</a>
        </li>
      <li class="active">Edit Section</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title"> Edit: {{ $categories->name }}</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
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

    
                  <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('superadmin.category.update')}}" enctype="multipart/form-data">
                       {{ csrf_field() }}
                       <input type="hidden" name="id" value="{{$categories->id}}">
                    <div class="box-body">

                        <div class="form-group">
                          <label for="tag_name" class="col-sm-2 col-form-label">Name (English)</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name_en" id="name_en" value="{{ $categories->name_en }}" required="required" />
                          </div>
                        </div>

                         <div class="form-group row">
                          <label for="tag_name" class="col-sm-2 col-form-label">Name (Arabic)</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{ $categories->name_ar }}" required="required" />
                          </div>
                        </div>


                        <div class="form-group row">
                          <label for="tag_slug" class="col-sm-2 col-form-label">Category Slug</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $categories->slug }}" required="required" />
                            <p class="text-sm text-danger"> please eneter in small character and replace space with hyphen.</p>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="tag_slug" class="col-sm-2 col-form-label">Category Description</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="description" id="description" value="{{ $categories->description }}" required="required" />
                          </div>
                        </div>

                        


                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Icon</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="cat_icon" id="cat_icon" value="{{ $categories->cat_icon }}" required="required" />
                          </div>
                        </div>

                    
                      <div class="form-group row">
                        <label for="tag_status" class="col-sm-2 col-form-label">Category Status</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="status" id="status" required="required">
                              <option value="1"  @if( $categories->status == 1) selected @endif >Active</option>
                              <option value="3" @if( $categories->status == 3) selected @endif >Unpublished</option>
                              <option value="2" @if( $categories->status == 2) selected @endif >Delete</option>
                            </select>
                        </div>
                      </div>
                      
                    </div>
                  
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Update</button>
                      <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
                    </div>
                  </form>
                 </div>
               </div>
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

  <script> 

        var file_cat_image_option = $("input[name='file_cat_image_option']:checked").val();
        if(file_cat_image_option == 'no-same-image'){
           $('#cat_image_div').hide();
        }

         $("input[type='radio']").click(function(){

            var file_cat_image_option1 = $("input[name='file_cat_image_option']:checked").val();
            if(file_cat_image_option1 == 'no-same-image'){
              $('#cat_image_div').hide();
            }else{
              $('#cat_image_div').show();
            }

        });
</script>

@stop
