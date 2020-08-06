@extends('backend_template')

@section('title', 'Brands')

@section('css')
  <link href="{{ asset('backend_template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">Brand List</h1>
      <a href="{{ route('brands.create') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-plus fa-sm text-white-50 pr-1"></i> Add New</a>

    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Brand Table</h6>
      </div>
      <div class="card-body">

				<div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	            	<th>No.</th>
	            	<th>Photo</th>
	            	<th>Name</th>
	            	<th>Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@php
	          		$i=1;
	          	@endphp
	          	@foreach ($brands as $brand)
	          		
	          		<tr>
		          		<td>{{ $i }}.</td>
		          		<td align="center"><img src="{{ asset($brand->photo) }}" width="70"></td>
		          		<td>{{ $brand->name }}</td>
		          		<td class="td-action">
		          			<a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Edit</a>
		          			
		          			<form method="post" action="{{ route('brands.destroy', $brand->id) }}" class="d-inline" id="delete-brand{{ $brand->id }}" >
											@csrf
		          				@method('DELETE')
		          				<button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('delete-brand'+{{ $brand->id }})"><i class="far fa-trash-alt"></i> Delete</button>
		          			</form>

		          		</td>
		          	</tr>
		          	@php $i++; @endphp
	          	@endforeach
		          	
	          </tbody>
	        </table>
	      </div>

      </div>
    </div>

  </div>

@endsection

@section('script')
	<!-- Page level plugins -->
  <script src="{{ asset('backend_template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend_template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('backend_template/js/demo/datatables-demo.js') }}"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript">
  
  	function confirmDelete(brand_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+brand_id).submit();
  			}
  		});
  	}

  </script>
@endsection