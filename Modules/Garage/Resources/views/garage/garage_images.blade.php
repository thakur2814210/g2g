@extends('garage.layout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Garage Images</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Manage Garage Images</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                      
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
                                 @if (isset($status))
                                    <div class="alert alert-warning">
                                        {{ $status }}
                                    </div>
                                @endif
                              </div>
                            </div>
              
                            <div class="box-body">





  

  <div class="row">
    <div class="col-12">
      <div class="box box-solid box-primary">
        <div class="box-header">
         Manage Garage Images
        </div>

        <div class="box-body">

          
            <div class="row">
                <div class="col-md-8">
                   <table class="table table-striped table-condensed table-bordered">
                  <thead>
                     <tr style="background: #e9ecef">
                      <th>#</th>
                      <th>Image Path</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($garageimages) && count($garageimages) > 0)
                      @foreach($garageimages as $garageimage)
                        <tr>
                          <td>{{$garageimage->id}}</td>
                          <td>{{$garageimage->image}}</td>
                          <td>
                            <a href="{{ route('garage.image.delete',['id' => $garageimage->id]) }}">
                              <button type="button" class="btn btn-sm btn-danger">
                                <i class="fa fa-fw fa-trash"></i>
                              </button>
                            </a>
                          </td>
                        </tr>
                       @endforeach
                    @else
                      <tr>
                        <td colspan="9">
                            No Garage Image Found.
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                 <div class="row" style="padding: 20px;">
                     @if(!empty($garageimages) && count($garageimages) > 0)
                       {{ $garageimages->links() }}
                     @endif
                 </div>
                </div>


                <div class="col-md-4">
                   <form class="form-horizontal" method="POST" action="{{ route('garage.image.update')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="garage_id" value="{{ $garage->id }}">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" id="cover_photo" name="cover_photo">
                          </div>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Update Image Gallery</button>
                      </div>
                    </form>
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-12">
      <div class="box box-solid box-primary">
        <div class="box-header">
         Existing Garage Image Gallery( Click to see in Pop up.)
        </div>

        <div class="box-body">
          @if(!empty($garageimages) && count($garageimages) > 0)
             <div class="row">
                @foreach($garageimages as $garageimage)
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/uploads/garage_images/'.$garageimage->image) }}" data-toggle="lightbox" data-title="{{ $garageimage->id}}" data-gallery="gallery">
                      <img src="{{ asset('assets/uploads/garage_images/'.$garageimage->image) }}" class="img-fluid mb-2" alt="Garage Image {{ $garageimage->id}}">
                    </a>
                  </div>
                 @endforeach
              </div>
          @else
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fa fa-info"></i> Alert!</h5>
              No Image preview Exist.
            </div>
          @endif
        </div>
      </div>
    </div>
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

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('assets/vendor/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
      $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });
      })
    </script>
@stop
