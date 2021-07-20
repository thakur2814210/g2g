@extends('website::layouts.page')

@section('website_css_pre')
  <link rel="stylesheet" href="{{ asset('website-theme/admin/vendor/font-awesome/css/font-awesome.min.css')}} " rel="stylesheet" type="text/css">
@stop

@section('website_css')
  <style type="text/css">
    

  </style>
@stop

@section('content')
    
  <div class="sub_header_in sticky_header">
    <div class="container">
      <h1>Create New Service request</h1>
    </div>
  </div>
  
  <main>
    <div class="container margin_60">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="step first">
            <h3></h3>
          <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Register</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Login</a>
            </li>
          </ul>
          <div class="tab-content checkout">
            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password">
              </div>
              <hr>
              <div class="row no-gutters">
                <div class="col-6 form-group pr-1">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="col-6 form-group pl-1">
                  <input type="text" class="form-control" placeholder="Last Name">
                </div>
              </div>
              <!-- /row -->
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Full Address">
              </div>
              <div class="row no-gutters">
                <div class="col-6 form-group pr-1">
                  <input type="text" class="form-control" placeholder="City">
                </div>
                <div class="col-6 form-group pl-1">
                  <input type="text" class="form-control" placeholder="Postal code">
                </div>
              </div>
              <!-- /row -->
              <div class="row no-gutters">
                <div class="col-md-12 form-group">
                  <div class="custom-select-form">
                    <select class="wide add_bottom_15" name="country" id="country">
                      <option value="" selected>Country</option>
                      <option value="Europe">Europe</option>
                      <option value="United states">United states</option>
                      <option value="Asia">Asia</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /row -->
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Telephone">
              </div>
              <hr>
              <div class="form-group">
                <label class="container_check" id="other_addr">Other billing address
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div id="other_addr_c" class="pt-2">
              <div class="row no-gutters">
                <div class="col-6 form-group pr-1">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="col-6 form-group pl-1">
                  <input type="text" class="form-control" placeholder="Last Name">
                </div>
              </div>
              <!-- /row -->
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Full Address">
              </div>
              <div class="row no-gutters">
                <div class="col-6 form-group pr-1">
                  <input type="text" class="form-control" placeholder="City">
                </div>
                <div class="col-6 form-group pl-1">
                  <input type="text" class="form-control" placeholder="Postal code">
                </div>
              </div>
              <!-- /row -->
              <div class="row no-gutters">
                <div class="col-md-12 form-group">
                  <div class="custom-select-form">
                    <select class="wide add_bottom_15" name="country" id="country">
                      <option value="" selected>Country</option>
                      <option value="Europe">Europe</option>
                      <option value="United states">United states</option>
                      <option value="Asia">Asia</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /row -->
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Telephone">
              </div>
              </div>
              <!-- /other_addr_c -->
              <hr>
            </div>
            <!-- /tab_1 -->
            <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2">
              <a href="#0" class="social_bt facebook">Login con Facebook</a>
              <a href="#0" class="social_bt google">Login con Google</a>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password_in" id="password_in">
              </div>
                <div class="clearfix add_bottom_15">
                <div class="checkboxes float-left">
                  <label class="container_check">Remember me
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="float-right"><a id="forgot" href="#0">Lost Password?</a></div>
              </div>
                <div id="forgot_pw">
                <div class="form-group">
                  <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
                </div>
                <p>A new password will be sent shortly.</p>
                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
              </div>
              <hr>
                <input type="submit" class="btn_1 full-width" value="Login">
            </div>
            <!-- /tab_2 -->
          </div>
          </div>
          <!-- /step -->
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="step middle">
            <h3>2. Payment Method</h3>
            <div class="payments">
              <ul>
                <li>
                  <label class="container_radio">Credit Card<a href="#0" class="info"></a>
                    <input type="radio" name="payment" checked>
                    <span class="checkmark"></span>
                  </label>
                </li>
                <li>
                  <label class="container_radio">Paypal<a href="#0" class="info"></a>
                    <input type="radio" name="payment">
                    <span class="checkmark"></span>
                  </label>
                </li>
              </ul>
            </div>
            <div class="payment_info d-none d-sm-block">
              <figure><img src="img/cards_all.svg" alt=""></figure>
              <p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p>
              <figure><img src="img/paypal.svg" alt=""></figure>
              <p>No mel dicit perpetua indoctum, nisl repudiare ex nec. Ad usu utinam feugiat, persecuti liberavisse id pri. Elitr nonumy everti mel eu.</p>
            </div>
          </div>
          <!-- /step -->
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="step last">
            <h3>3. Order Summary</h3>
          <div class="box_general summary">
            <ul>
              <li>Where <span class="float-right">Da Alfredo Restaurant</span></li>
              <li>Date <span class="float-right">10/05/2018</span></li>
              <li>Hour <span class="float-right">12.00 PM</span></li>
              <li>Guest <span class="float-right">2 Adults</span></li>
              <li>TOTAL COST <span class="float-right">€96</span></li>
            </ul>
            <textarea class="form-control add_bottom_15" placeholder="Additional notes.." style="height: 100px;"></textarea>
            <div class="form-group">
                <label class="container_check">Please accepts <a target="_blank" href="#0">Terms and conditions</a>.
                  <input type="checkbox" checked>
                  <span class="checkmark"></span>
                </label>
              </div>
            
            <a href="cart-3.html" class="btn_1 full-width cart">CONFIRM AND PAY</a>
          </div>
          <!-- /box_general -->
          </div>
          <!-- /step -->
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </main>
  
  
  
@stop

@section('website_js')

<script type="text/javascript">
  $('#new_vehicle_div').hide(); 
  $('#show_new_vehicle_form').click(function(){
    $('#existing_vehicle_div').hide(); 
    $('#new_vehicle_div').show(); 
  });

  $('#show_existing_vehicle_form').click(function(){
    $('#new_vehicle_div').hide(); 
    $('#existing_vehicle_div').show(); 
  });

 


</script>

  <script type="text/javascript">
    $(document).ready(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function(){

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                  // for making fielset appear animation
                  opacity = 1 - now;

                  current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                  });
                  next_fs.css({'opacity': opacity});
              },
              duration: 600
            });
        });

        $(".previous").click(function(){

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {

                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                      'display': 'none',
                      'position': 'relative'
                    });

                    previous_fs.css({'opacity': opacity});
                },

              duration: 600
            });
        });

        $('.radio-group .radio').click(function(){
            $(this).parent().find('.radio').removeClass('selected');
          $(this).addClass('selected');
        });


        });
  </script>
@stop