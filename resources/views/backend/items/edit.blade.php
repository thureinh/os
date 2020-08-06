@extends('backend_template')

@section('title', 'Items')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend_template/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Item Edit Form</h1>
      <a href="{{ route('items.index') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-angle-left fa-sm text-white-50 pr-1"></i> Back</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Edit Item</h6>
      </div>
      <div class="card-body">

      	<form method="post" action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data">
      		@csrf
      		@method('PUT')
      		
      		<div class="form-group row mb-lg-4">
				    <label for="brand" class="col-md-3 col-form-label">Brand: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				     	<select class="form-control nice-select wide" id="brand" name="brand_id">
				     		<option value="default">Choose Brand</option>

				     			@foreach ($brands as $brand)
				     				
			     					<option value="{{ $brand->id }}"
			     						@if ($brand->id == $item->brand_id || old('brand_id') == $brand->id)
				     					 selected
			     						@endif
				     				>{{ $brand->name }}</option>
				     		
				     			@endforeach

				     	</select>

				     	@error('brand_id')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="subcategory" class="col-md-3 col-form-label">Sub Category: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">

				    	<select class="form-control nice-select wide" id="subcategory" name="subcategory_id" >
				     		<option value="default">Choose Subcategory</option>
			     			@foreach ($categories as $category)
					     		<option disabled><strong>{{ $category->name }}</strong></option>

					     			@foreach ($category->subcategories as $subcategory)
					     				<option value="{{ $subcategory->id }}" @if(old('subcategory_id') == $subcategory->id || $subcategory->id == $item->subcategory_id ) selected @endif >{{ $subcategory->name }}</option>
					     			@endforeach

			     			@endforeach
				     	</select>

				     	@error('subcategory_id')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

      		<div class="form-group row mb-lg-4">
				    <label for="code" class="col-md-3 col-form-label">Item Code: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				      <input type="text" class="form-control" id="code" name="codeno" placeholder="Enter Item Code" value="{{ old('codeno',$item->codeno) }}">

				      @error('codeno')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>
      		
      		<div class="form-group row mb-lg-4">
				    <label for="name" class="col-md-3 col-form-label">Item Name: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Item Name" value="{{ old('name',$item->name) }}">

				      @error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="image" class="col-md-3 col-form-label">Photo: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				    	<input type="hidden" name="old_photo" value="{{ $item->photo }}">
				    	
				    	<div class="row" id="div-old-photo">
				    		<div class="col-5 col-lg-2">
					     		<img src="{{ asset($item->photo) }}" class="shadow d-block mb-3 img-fluid">
				    		</div>
				    		<div class="col-7 col-lg-10 pt-5">
				    			<button type="button" class="btn btn-outline-info btn-sm px-3" id="btn-change-photo"><i class="fas fa-upload fa-sm pr-2"></i>Change Photo</button>
				    		</div> 
				    	</div>

				    	<div class="row" id="div-new-photo" style="display: none;">
				    		<div class="col-sm-8 col-md-9 col-xl-10 pr-md-0">
				    			<div class="custom-file">
		                <input type="file" class="custom-file-input" name="photo" accept="image/*" id="image">
		                <label class="custom-file-label" for="image">Choose Item Photo</label>
		              </div>
				    		</div>
				    		<div class="col-sm-4 col-md-3 col-xl-2 mt-sm-0 mt-3">
				    			<button class="btn btn-outline-info btn-block" id="btn-undo" type="button"><i class="fas fa-undo fa-sm pr-2"></i>Undo</button>
				    		</div>
				    	</div>

              @if ($errors->any() && !($errors->first('photo')))
              	<div class="error-message text-success pl-1 mt-1">
				     			<small>* If you have changed new photo, please upload it again.</small>
				     		</div>
              @endif

              @error('photo')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="price" class="col-md-3 col-form-label">Price: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				    	<div class="input-group">
				    		<div class="input-group-prepend">
							    <span class="input-group-text">$</span>
							  </div>
					      <input type="number" class="form-control" id="price" name="price" placeholder="Item Price" value="{{ old('price',$item->price) }}">
				    	</div>

				    	@error('price')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="discount" class="col-md-3 col-form-label">Discount: </label>
				    <div class="col-md-9">
				    	<div class="input-group">
					      <input type="number" class="form-control" id="discount" name="discount" placeholder="Enter Item Discount" value="{{ old('discount', $item->discount) }}">
					      <div class="input-group-append">
							    <span class="input-group-text">%</span>
							  </div>
				    	</div>

				    	@error('discount')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="description" class="col-md-3 col-form-label">Description: </label>
				    <div class="col-md-9">
				      <textarea class="form-control" name="description" id="description" rows="5" placeholder="Add Detail Description...">{{ old('description',$item->description) }}</textarea>

				      @error('description')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				  	<div class="offset-md-3 col-md-9">
				  		<button class="btn btn-info px-5" type="submit">Update</button>
				  	</div>
				  </div>

      	</form>

      </div>
    </div>

  </div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('backend_template/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>

	<script type="text/javascript">
  	$('#image').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    })

    $(function () {
    	$('select').niceSelect();

    	$('#btn-change-photo').click(function() {
    		
    		$('#div-old-photo').hide();
    		$('#div-new-photo').show(500);

    	});

    	$('#btn-undo').click(function() {

    		$('#image').val('');
    		$('.custom-file-label').html('Choose Item Photo');
    		
    		$('#div-new-photo').hide();
    		$('#div-old-photo').show(500);

    	});
    })
  </script>
@endsection