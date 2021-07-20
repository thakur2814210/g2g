
   $(document).ready(function() {
        google.maps.event.addDomListener(window, 'load', initialize);
   });


   function initialize() {
       var options = {
         componentRestrictions: {country: "AE"}
       };

       var input = document.getElementById('autocomplete');
       var autocomplete = new google.maps.places.Autocomplete(input, options);
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
		
			if($(this).is(':checked')){

				if($(this).val() == 'all'){
					$('input.city_filter').not(this).prop('checked', false);  
				}else{
					$('#select_all_city').prop('checked', false);  
				}
			}
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
