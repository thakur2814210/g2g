<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
@include('website.common.meta')

  </head>
    <!-- dir="rtl" -->
    <body class="animation-s1 {{ session('direction')}}"  dir="{{ session('direction')}}">

      <!-- Header Content -->
       <?php  echo $final_theme['header']; ?>
       <!-- End Header Content -->
       <?php  echo $final_theme['mobile_header']; ?>
       <!-- NOTIFICATION CONTENT -->
         @include('website.common.notifications')
      <!-- END NOTIFICATION CONTENT -->


      @yield('content')



      <!-- Footer content -->

      <?php  echo $final_theme['footer']; ?>

      <!-- End Footer content -->
      <?php  echo $final_theme['mobile_footer']; ?>


      <div class="mobile-overlay"></div>
      <!-- Product Modal -->


      <a href="web/#" id="back-to-top" title="Back to top">&uarr;</a>

      <div class="modal" tabindex="-1" id="myModal" role="dialog" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div class="container" id="products-detail">

                    </div>
                  </div>
            </div>
          </div>
      </div>

      <!-- Include js plugin -->
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
     
      
      @yield('js')

    </body>
</html>
