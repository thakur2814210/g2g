<div id="filters_col">
	<form id="rightFilterForm" method="get" action="{{ route('listings.search')}}">
		<div class="filter_type">

				<div class="row ">
			<div class="col-6">
				<button type="submit" class="btn btn-sm  btn-success"><i class="fa fa-check-circle"></i> Apply</button>
			</div>
			<div class="col-6">
				<button type="reset" class="btn btn-sm btn-danger float-right"><i class="fa fa-times"></i> Reset</button>
			</div>
		</div>
		<br/>
		
		
		<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
		<div class="collapse show" id="collapseFilters">
			
		</form>
	</div>
</div>