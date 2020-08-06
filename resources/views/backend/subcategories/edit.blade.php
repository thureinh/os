@extends('backend_template')

@section('title', 'Subcategories')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend_template/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Subcategory Edit Form</h1>
      <a href="{{ route('subcategories.index') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-angle-left fa-sm text-white-50 pr-1"></i> Back</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Edit Subcategory</h6>
      </div>
      <div class="card-body">

      	<form method="post" action="{{ route('subcategories.update', $subcategory->id) }}" enctype="multipart/form-data">
      		@csrf
      		@method('PUT')
      		
      		<div class="form-group row mb-lg-4">
				    <label for="name" class="col-md-3 col-form-label">Subcategory Name: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Subcategory Name" value="{{ old('name',$subcategory->name) }}">

				      @error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>
      		
      		<div class="form-group row mb-lg-4">
				    <label for="category" class="col-md-3 col-form-label">Category: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				     	<select class="form-control nice-select wide" id="category" name="category_id">
				     		<option value="default">Choose Category</option>

				     			@foreach ($categories as $category)
				     				
			     					<option value="{{ $category->id }}"
			     						@if ($category->id == $subcategory->category_id || old('category_id') == $category->id)
				     					 selected
			     						@endif
				     				>{{ $category->name }}</option>
				     		
				     			@endforeach

				     	</select>

				     	@error('category_id')
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
    $(function () {
    	$('select').niceSelect();
    })
  </script>
@endsection