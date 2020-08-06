@extends('backend_template')

@section('title', 'Items')

@section('css')
  <link href="{{ asset('backend_template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">Item List</h1>
      <a href="{{ route('items.create') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-plus fa-sm text-white-50 pr-1"></i> Add New</a>

    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Item Table</h6>
      </div>
      <div class="card-body">

				<div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	            	<th>No.</th>
	            	<th>Code_No</th>
	            	<th>Name</th>
	            	<th>Price(Ks)</th>
	            	<th>Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($items as $item)
	          		
	          		<tr>
		          		<td>{{ $item->id }}.</td>
		          		<td>{{ $item->codeno }}</td>
		          		<td>{{ $item->name }}</td>
		          		<td>{{ $item->price }}</td>
		          		<td class="td-action">
		          			<a href="{{ route('items.edit', $item->id) }}" class="btn btn-outline-warning btn-sm"><i class="far fa-edit"></i> Edit</a>
		          			
		          			<form method="post" action="{{ route('items.destroy', $item->id) }}" class="d-inline" id="delete-item{{ $item->id }}" >
											@csrf
		          				@method('DELETE')
		          				<button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('delete-item'+{{ $item->id }})"><i class="far fa-trash-alt"></i> Delete</button>
		          			</form>

		          			{{-- <a href="{{ route('items.show', $item->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-info-circle"></i> Detail</a> --}}

		          			<button class="btn btn-outline-info btn-sm btn-detail" data-name="{{ $item->name }}" data-codeno="{{ $item->codeno }}" data-brand="{{ $item->brand->name }}" data-category="{{ $item->subcategory->category->name }} - {{ $item->subcategory->name }}" data-price="{{ $item->price }}" data-description="{{ $item->description }}" data-photo="{{ asset($item->photo) }}"><i class="fas fa-info-circle"></i> Detail</button>
		          		</td>
		          	</tr>

	          	@endforeach
		          	
	          </tbody>
	        </table>
	      </div>

      </div>
    </div>

  </div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title detail-name" id="exampleModalLabel">Product Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-md-5">
        
      	<div class="row">
      		<div class="col-lg-4">
      			<img src="" id="detail-photo" class="img-fluid shadow mb-5 mb-lg-0">
      		</div>
      		<div class="col-lg-8">
      			<table class="table table-sm table-striped">
      				<tr>
      					<th>Name:</th>
      					<td><span class="detail-name"></span></td>
      				</tr>
      				<tr>
      					<th>Code No:</th>
      					<td><span id="detail-codeno"></span></td>
      				</tr>
      				<tr>
      					<th>Brand:</th>
      					<td><span id="detail-brand"></span></td>
      				</tr>
      				<tr>
      					<th>Category:</th>
      					<td><span id="detail-category"></span></td>
      				</tr>
      				<tr>
      					<th>Price:</th>
      					<td>Ks.<span id="detail-price"></span></td>
      				</tr>
      				<tr>
      					<th>Description:</th>
      					<td><span id="detail-description"></span></td>
      				</tr>
      			</table>
      		</div>
      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
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
  
  	function confirmDelete(item_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+item_id).submit();
  			}
  		});
  	}

  	$(function () {
  		
  		$('tbody').on('click', '.btn-detail', function() {
  			
  			name = $(this).data('name');
  			codeno = $(this).data('codeno');
  			brand = $(this).data('brand');
  			category = $(this).data('category');
  			price = $(this).data('price');
  			description = $(this).data('description');
  			photo = $(this).data('photo');


  			$('#detail-photo').attr('src', photo);
  			$('.detail-name').text(name);
  			$('#detail-codeno').text(codeno);
  			$('#detail-brand').text(brand);
  			$('#detail-category').text(category);
  			$('#detail-price').text(price);
  			$('#detail-description').text(description);

  			$('#detailModal').modal('show');
  			
  		});

  	})

  </script>
@endsection