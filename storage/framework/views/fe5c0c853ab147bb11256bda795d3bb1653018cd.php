<?php $__env->startSection('content'); ?>
	<div class="container">
		<div id="results">
   			<div class="container">
			   <?php echo $__env->make('website.garages.common.searchLocationBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   			</div>
		</div>
		<div class="filters_listing version_2  sticky_horizontal">
			<?php echo $__env->make('website.garages.common.paginationBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>

		<div class="row">
			<aside class="col-lg-3" id="sidebar">
				<?php echo $__env->make('website.garages.common.leftSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</aside>

			<div class="col-lg-9">
				<div class="row" id="garages-list">
					<div class="col-md-12 p-3">
						<div class="alert alert-danger">
							<b>Please wait... we are accessing your loaction to get the nearest garages.</b>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
	<?php echo $__env->make('website.common.scripts.garages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!--script>
      $.getJSON('https://geolocation-db.com/json/')
         .done (function(location) {
            //alert(location.country_name);
            var html = 'Current Location: ' + location.city + ', ' + location.state + ', ' + location.country_name + '( IP:' + location.IPv4 + ' )';
             $('#current_location').html(html);

            <?php if(Request::path() == 'listings/workshops-garages/all'): ?>
				 $.ajax({
			        url: "employees",
			        type: "post",
			        data: { id : $(this).val() },
			        success: function(data){
			            $("#employees").html(data);
			        }
			    });
			<?php endif; ?>
           // $('#state').html(location.state);
            //$('#city').html(location.city);
           // $('#latitude').html(location.latitude);
           //$('#longitude').html(location.longitude);
           // $('#ip').html(location.IPv4);
         });
    </script-->

   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/website/garages/byLocation.blade.php ENDPATH**/ ?>