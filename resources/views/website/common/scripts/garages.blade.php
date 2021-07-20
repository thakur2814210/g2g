   <script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

   
   <script type="text/javascript">

          var id, target, option;
          target = {
            latitude : 0,
            longitude: 0,
          }

          options = {
            enableHighAccuracy: false,
            timeout: 5000,
            maximumAge: 0
          };

          function getPosition() {
              // Simple wrapper
              return new Promise((res, rej) => {
                //navigator.geolocation.getCurrentPosition(res, rej);
                id = navigator.geolocation.watchPosition(success, error, options);
              });
          }

          async function getCurrentLocation() {
              await getPosition();  // wait for getPosition to complete
          }

         // getCurrentLocation();
          
         
          function success(pos) {
            var crd = pos.coords;
            // console.log(crd);
            if (target.latitude === crd.latitude && target.longitude === crd.longitude) {
              console.log('Congratulation, you reach the target');
              navigator.geolocation.clearWatch(id);
            }else{
              //find lat and long ...
              if(window.sessionStorage.getItem("c_latitude") === null && window.sessionStorage.getItem("c_longitude") === null){
                $.get('https://maps.googleapis.com/maps/api/geocode/json?latlng='+crd.latitude+','+crd.longitude+'&sensor=false&key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI')
                 .done (function(data) {
                    window.sessionStorage.setItem("c_address", data.results[0].formatted_address);
                    window.sessionStorage.setItem("c_latitude", crd.latitude);
                    window.sessionStorage.setItem("c_longitude", crd.longitude);
                });
              }
              
            }
          };

          function error(err) {
            console.log(err);
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
              // Will return ['granted', 'prompt', 'denied']
              console.log(result.state);
              if(result.state == 'denied'){
                 console.log("Looks like your geolocation permissions are blocked. Please, provide geolocation access in your browser settings and get the nearest garages.");
              }
            });
             
          };

          

          //id = navigator.geolocation.watchPosition(success, error, options);

         


          function setSerachLocation(){
            $('#current_location').html(window.sessionStorage.getItem('c_address'));
          }

          function checkUserLocationAndRedirect(){
            @if(Request::path() == 'listings/workshops-garages/near-by-garages')
                c_latitude = window.sessionStorage.getItem('c_latitude');
                c_longitude = window.sessionStorage.getItem('c_longitude');
                c_address = window.sessionStorage.getItem('c_address');

                if(c_latitude === null && c_longitude === null && c_address === null){
                   $('#current_location').html('Please, provide geolocation access in your browser settings and get the nearest garages.');
                }else{
                  navigator.permissions.query({name:'geolocation'}).then(function(result) {
                    if(result.state != 'denied'){
                      location.href = '/listings/search-by-location?latitude='+c_latitude+'&longitude='+ c_longitude +'8&address='+c_address+'&distance=5&category=all';
                    }
                  });
                }
            @endif  
          }
      </script>


    

      <script>
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
            initialize();
       });
  

       function initialize() {
         
          getCurrentLocation();
          setTimeout(function(){ 
             @if(Request::path() == 'listings/workshops-garages/near-by-garages')
              checkUserLocationAndRedirect();
               @endif  
             
            }, 5000);
             setSerachLocation(); 
          
       
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }

       // set value on load
  var slider = document.getElementById("distance_filter_range");
  var output = document.getElementById("distance_filter_range_value");
  output.innerHTML = slider.value;

  slider.oninput = function() {
    output.innerHTML = this.value;
  }

  $(document).ready(function() {

    // only one city is selected except all
    $('input.city_filter').on('change', function() {
        $('input.city_filter').not(this).prop('checked', false);
        // as per new changes.. onlyy one city is allowed
      /*if($(this).is(':checked')){
        
        if($(this).val() == 'all'){
          $('input.city_filter').not(this).prop('checked', false);  
        }else{
          $('#select_all_city').prop('checked', false);  
        }
      }*/
    });

    // only one categort is selected except all
    $('input.category_filter').on('change', function() {
      if($(this).is(':checked')){
        if($(this).val() == 'all'){
          $('input.category_filter').not(this).prop('checked', false);  
        }else{
          $('#select_all_category').prop('checked', false);  
        }
      }
    });
  });

  $('#filterForm').submit(function() {
    
    var city_filter =   [];
        $.each($("input.city_filter:checked"), function(){            
            city_filter.push($(this).val());
        });
        
    var distance_filter = [];
        distance_filter.push(slider.value);
        
      
        var  category_filter = [];
        $.each($("input.category_filter:checked"), function(){            
            category_filter.push($(this).val());
        });

      $('#filterForm').find('input[name=city_filter]').val(city_filter);
      $('#filterForm').find('input[name=distance_filter]').val(distance_filter);
      $('#filterForm').find('input[name=category_filter]').val(category_filter);
  });

    </script>