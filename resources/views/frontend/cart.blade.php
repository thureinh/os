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
                  <tr>
                    <td colspan='4' rowspan='2'>
                      <textarea class='form-control' id='note' placeholder='Add Notes...' rows='3'></textarea>
                    </td>
                    <td colspan='2'>
                      <button class='btn btn-light btn-block btn-clearall'>Clear All</button>
                    </td>
                  </tr>
                  <tr>
                  	@auth
	                    <td colspan='2'>
	                      <a class="btn btn-dark btn-block btn-checkout" href="#">Check Out</a>
	                    </td>
					@else
						<td colspan='2'>
	                      <a class="btn btn-success btn-block" href="{{ route('login') }}">Login</a>
	                    </td>
					@endauth
                  </tr>
	      </tbody>
	    </table>
	  </div>

		  

	</div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('frontend_template/js/custom.js') }}"></script>
@endsection