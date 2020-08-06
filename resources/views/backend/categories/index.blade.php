@extends('backend_template')

@section('title', 'Categories')

@section('css')
  <link href="{{ asset('backend_template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">Category List</h1>
      <a href="{{ route('categories.create') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-plus fa-sm text-white-50 pr-1"></i> Add New</a>

    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Category Table</h6>
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
	          	@foreach ($categories as $category)
	          		
	          		<tr>
		          		<td>{{ $i }}.</td>
		          		<td align="center"><img src="{{ asset($category->photo) }}" width="70"></td>
		          		<td>{{ $category->name }}</td>
		          		<td class="td-action">
		          			<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Edit</a>
		          			
		          			<form method="post" action="{{ route('categories.destroy', $category->id) }}" class="d-inline" id="delete-category{{ $category->id }}" >
											@csrf
		          				@method('DELETE')
		          				<button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('delete-category'+{{ $category->id }})"><i class="far fa-trash-alt"></i> Delete</button>
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
  
  	function confirmDelete(category_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+category_id).submit();
  			}
  		});
  	}

  </script>
@endsection