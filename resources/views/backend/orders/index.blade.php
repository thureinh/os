@extends('backend_template')

@section('title', 'Orders')

@section('css')
  <link href="{{ asset('backend_template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">Order List</h1>
      <a href="#" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-upload fa-sm text-white-50 pr-1"></i> Generate Report</a>

    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Order Table</h6>
      </div>
      <div class="card-body">

				<div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	            	<th>No.</th>
	            	<th>Voucher_No</th>
	            	<th>Order_Date</th>
	            	<th>Total_Amount(Ks)</th>
	            	<th>Status</th>
	            	<th>Action</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@php $i=1; @endphp
	          	@foreach ($orders as $order)
	          		<tr>
	          			<td>{{ $i }}.</td>
	          			<td>V-{{ $order->voucherno }}</td>
	          			<td>{{ $order->orderdate }}</td>
	          			<td>{{ $order->total }}</td>
	          			<td>
	          				@if ($order->status == 0)
	          					<span class="badge badge-warning">Order</span>
	          				@else
	          					<span class="badge badge-info">Delivered</span>
	          				@endif
	          			</td>
	          			<td>
	          				<a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-info btn-sm btn-detail"><i class="fas fa-info-circle"></i> Detail</a>
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

@endsection