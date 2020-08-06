@extends('backend_template')

@section('title', 'Subcategories')

@section('css')
  <link href="{{ asset('backend_template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">Subcategory List</h1>
      <a href="{{ route('subcategories.create') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-plus fa-sm text-white-50 pr-1"></i> Add New</a>

    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Add New Subcategory</h6>
      </div>
      <div class="card-body">

				<div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	            	<th>No.</th>
	            	<th>Name</th>
	            	<th>Category</th>
	            	<th>Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@php
	          		$i=1;
	          	@endphp
	          	@foreach ($subcategories as $subcategory)
	          		
	          		<tr>
		          		<td>{{ $i }}.</td>
		          		<td>{{ $subcategory->name }}</td>
		          		<td>{{ $subcategory->category->name }}</td>
		          		<td class="td-action">
		          			<a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Edit</a>
		          			
		          			<form method="post" action="{{ route('subcategories.destroy', $subcategory->id) }}" class="d-inline" id="delete-subcategory{{ $subcategory->id }}" >
											@csrf
		          				@method('DELETE')
		          				<button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('delete-subcategory'+{{ $subcategory->id }})"><i class="far fa-trash-alt"></i> Delete</button>
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
  
  	function confirmDelete(subcategory_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+subcategory_id).submit();
  			}
  		});
  	}

  </script>
@endsection