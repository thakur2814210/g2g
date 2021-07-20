<?php $__env->startSection('content'); ?>
<style type="text/css" media="screen">
	.faq-list ul{
		display: list-item !important;
		 list-style: square outside none !important;
	}
</style>

	<!-- Site Content -->
<section class="blog-content">
	<div class="container">
		<div class="row">
		 	<div class="col-12 col-lg-12">
			 	 <div class="main_title_2" style="margin-bottom: 10px;">
			        <h2><?php echo app('translator')->get('website.faq'); ?></h2>
			        <br/>
			         	<span><em style="background-color: #b42127;"></em></span>
			      </div>
			 </div>
		</div>
 		<div class="blog-area">

 			<?php if(!empty($faqs)): ?>
	   			<div class="row">
	   				<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_name => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <div class="col-12 col-lg-12  d-lg-block d-xl-block blog-menu">
		                    <div class="category-div">
								<div class="heading">
									<h2><?php echo $cat_name; ?></h2>
									<hr style="margin-bottom: 0;">
								</div>

								<?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                       		<div class="card">
				                       	<a class=" main-manu btn card-header" data-toggle="collapse" href="#<?php echo e('index_' . $index . '_section_' . strtolower($value['id'])); ?>" role="button" aria-expanded="false" aria-controls="<?php echo e('index_' . $index . '_' .strtolower($value['category'])); ?>">
				                            <?php echo $value['header']; ?> <span><i class="fas fa-minus"></i></span>
				                         </a>
				                        <div class="sub-manu collapse multi-collapse" id="<?php echo e('index_' . $index . '_section_' .strtolower($value['id'])); ?>">
				                           	  <div class="card-body faq-list">
												<?=stripslashes($value['answer'])?>     
											</div>
				                        </div>
			                    	</div>
			                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                   </div>
		                </div>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            </div>
	        <?php endif; ?>
    	</div>
    </div>
</section>






	<?php
	/*

      	<!--main class="margin_60_35">
		<div class="container margin_60_35">
			<div class="row">
				@if(!empty($faqs))
				<aside class="col-lg-3" id="faq_cat">
						<div class="box_style_cat" id="faq_box">
							<ul id="cat_nav">
								@foreach($cat_names as $index => $category)
								<li>
									<a href="#{{ strtolower($category) }}" class="@if($index == 0) 'active' @else '' @endif">
										<i class="icon_document_alt"></i>{{$category}}
									</a>
								</li>
								@endforeach
							</ul>
						</div>
						
				</aside>
			
				
				<div class="col-lg-9" id="faq">
					@foreach($faqs as $cat_name => $categories)


					<h4 class="nomargin_top">{{$cat_name}}</h4>
					<div role="tablist" class="add_bottom_45 accordion_2" id="{{ strtolower($cat_name) }}">
						@foreach($categories as $index => $category)
							<div class="card">
								@if(\Config::get('app.locale') == 'en')
									<div class="card-header" role="tab">
										<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse{{$index}}_{{ strtolower($category['cat_name_en']) }}" aria-expanded="true">
												<i class="indicator {{ ($index == 0) ? 'ti-minus' : 'ti-plus' }}"></i>
												{{ $category['heading_en']}}
											</a>
											
										</h5>
									</div>

									<div id="collapse{{$index}}_{{ strtolower($category['cat_name_en']) }}" class="collapse @if($index == 0) show @endif" role="tabpanel" data-parent="#{{ strtolower($category['cat_name_en']) }}">
										<div class="card-body">
											{!! $category['answer_en'] !!}
										</div>
									</div>
								@else
									<div class="card-header" role="tab">
										<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse{{$index}}_{{ strtolower($category['cat_name_ar']) }}" aria-expanded="true">
												<i class="indicator {{ ($index == 0) ? 'ti-minus' : 'ti-plus' }}"></i>
												{{ $category['heading_ar']}}
											</a>
											
										</h5>
									</div>

									<div id="collapse{{$index}}_{{ strtolower($category['cat_name_ar']) }}" class="collapse @if($index == 0) show @endif" role="tabpanel" data-parent="#{{ strtolower($category['cat_name_ar']) }}">
										<div class="card-body">
											{!! $category['answer_ar'] !!}
										</div>
									</div>
								@endif
							</div>
						@endforeach
					</div>
					@endforeach
				</div>
				@endif
			</div>
		
		</div>
	</main-->
	*/
	?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/website/faq.blade.php ENDPATH**/ ?>