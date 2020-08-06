@extends('backend_template')

@section('title', 'Categories')

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Category Create Form</h1>
      <a href="{{ route('categories.index') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-angle-left fa-sm text-white-50 pr-1"></i> Back</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Add New Category</h6>
      </div>
      <div class="card-body">

      	<form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
      		@csrf
      		
      		<div class="form-group row mb-lg-4">
				    <label for="name" class="col-lg-3 col-form-label">Category Name: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="{{ old('name') }}" >

				      @error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				    </div>
				  </div>

				  <div class="form-group row mb-lg-4">
				    <label for="image" class="col-lg-3 col-form-label">Category Photo: <sup class="text-danger">*</sup></label>
				    <div class="col-lg-9">
				     	<div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" accept="image/*" id="image">
                <label class="custom-file-label" for="image">Choose Category Photo</label>
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

	<script type="text/javascript">
  	$('#image').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    })
  </script>

@endsection