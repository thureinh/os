@extends('backend_template')

@section('title', 'Items')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend_template/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Item Create Form</h1>
      <a href="{{ route('items.index') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-angle-left fa-sm text-white-50 pr-1"></i> Back</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Add New Item</h6>
      </div>
      <div class="card-body">

      	<form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
      		@csrf
      		
      		<div class="form-group row mb-lg-4">
				    <label for="brand" class="col-lg-3 col-form-label">Brand: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				     	<select class="form-control nice-select wide" id="brand" name="brand_id" >

				     		<option value="default">Choose Brand</option>
				     			@foreach ($brands as $brand)
				     				<option value="{{ $brand->id }}" @if(old('brand_id') == $brand->id) selected @endif >{{ $brand->name }}</option>
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
				    <label for="subcategory" class="col-lg-3 col-form-label">Sub Category: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				     	<select class="form-control nice-select wide" id="subcategory" name="subcategory_id" >
				     		<option value="default">Choose Subcategory</option>
			     			@foreach ($categories as $category)
					     		<option disabled><strong>{{ $category->name }}</strong></option>

					     			@foreach ($category->subcategories as $subcategory)
					     				<option value="{{ $subcategory->id }}" @if(old('subcategory_id') == $subcategory->id ) selected @endif >{{ $subcategory->name }}</option>
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
				    <label for="code" class="col-lg-3 col-form-label">Item Code: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				      <input type="text" class="form-control" id="code" name="codeno" placeholder="Enter Item Code" value="{{ old('codeno') }}">

				      @error('codeno')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>
      		
      		<div class="form-group row mb-lg-4">
				    <label for="name" class="col-lg-3 col-form-label">Item Name: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Item Name" value="{{ old('name') }}" >

				      @error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="image" class="col-lg-3 col-form-label">Photo: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				     	<div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" accept="image/*" id="image">
                <label class="custom-file-label" for="image">Choose Item Photo</label>
              </div>

              @if ($errors->any() && !($errors->first('photo')))
              	<div class="error-message text-success pl-1 mt-1">
				     			<small>* Please upload your photo again.</small>
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
				    <label for="price" class="col-lg-3 col-form-label">Price: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				    	<div class="input-group">
				    		<div class="input-group-prepend">
							    <span class="input-group-text">$</span>
							  </div>
					      <input type="number" class="form-control" id="price" name="price" placeholder="Item Price" value="{{ old('price') }}">
				    	</div>

				    	@error('price')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="discount" class="col-lg-3 col-form-label">Discount: </label>
				    <div class="col-lg-9">
				    	<div class="input-group">
					      <input type="number" class="form-control" id="discount" name="discount" placeholder="Enter Item Discount"  value="{{ old('discount', 0)}}" min="0">
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
				    <label for="description" class="col-lg-3 col-form-label">Description: </label>
				    <div class="col-lg-9">
				      <textarea class="form-control" name="description" id="description" rows="5" placeholder="Add Detail Description..." >{{ old('description') }}</textarea>

				      @error('description')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4 mt-4">
				  	<div class="offset-lg-3 col-lg-9">
				  		<button class="btn btn-info px-5" type="submit">Add</button>
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
    })
  </script>
@endsection