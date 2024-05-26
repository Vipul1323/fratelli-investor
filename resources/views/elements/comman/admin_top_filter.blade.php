{!! Form::open(['method' => 'get','id'=>'filter_form', 'class'=>'pull-right']) !!}
	@if(!empty($propertyType))
	<!-- <div class="col-md-5">
		<div class="form-group">
		    	{!! Form::select('property_type_id', $propertyType, empty($itemProperty) ? '' : $itemProperty->property_type_id, [
		        'class' => 'form-control',
		        'id' => 'property_type_id',
		        'disabled' => !empty($itemProperty)
		    ]) !!}   
		</div>  
	</div> -->
	@endif
	<div class="col-md-12">
		<div class="input-group input-group-sm search" style="<?php echo isset($search_width)?'width:'.$search_width:''; ?>">
	        {{ Form::text('search',isset($search) ? $search : null, array('id'=>'search-input','class' => 'form-control pull-right','placeholder'=> isset($placeholder)?$placeholder:'Search')) }}
	        <div class="input-group-btn">
	            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
	        </div>
	    </div>
	</div>
{!! Form::close() !!}