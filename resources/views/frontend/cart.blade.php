@extends('frontend_template')

@section('title', 'Cart')

@section('content')

	<div class="container">
		<h3 class="text-center my-5">My Cart</h3>

		<div class="table-responsive div-cart mb-5">
	    <table class="table table-bordered">
	      <thead>
	        <tr>
	          <th>No.</th>
	          <th>Photo</th>
	          <th>Name</th>
	          <th>Unit_Price</th>
	          <th>Qty</th>
	          <th>Sub_Total</th>
	        </tr>
	      </thead>
	      <tbody id="tbody-cart">
	        
	      </tbody>
	    </table>
	  </div>

		  

	</div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('frontend_template/js/custom.js') }}"></script>
@endsection