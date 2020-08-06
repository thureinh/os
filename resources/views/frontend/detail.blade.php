@extends('frontend_template')

@section('title', 'Item Detail')

@section('content')

	<div class="container">
		<h3 class="text-center my-5">Item Detail</h3>

		<div class="row mb-5">
			<div class="col-lg-4">
				<img src="{{ asset($item->photo) }}" class="img-fluid shadow mb-4">
			</div>
			<div class="col-lg-8 pl-3 pl-lg-5">
				<h5>{{ $item->name }}</h5>
				@php
          if ($item->discount != 0) {
            $price = $item->price - ($item->price * $item->discount/100);
          } else {
            $price = $item->price;
          }
        @endphp
				<h6>Price: <span class="text-price">Ks.{{ $price }}</span></h6>
				@if ($item->discount != 0)
					<p>
					<span class="text-muted"><small><del class="pr-2">Ks.{{ $item->price }}</del>(-{{ $item->discount }}%)</small></span>
					</p>
				@endif
				<table class="table table-sm table-striped my-4">
  				<tbody>
    				<tr>
    					<th>Code:</th>
    					<td>{{ $item->codeno }}</td>
    				</tr>
    				<tr>
    					<th>Brand:</th>
    					<td>{{ $item->brand->name }}</td>
    				</tr>
    				<tr>
    					<th>Category:</th>
    					<td>{{ $item->subcategory->category->name }} - {{ $item->subcategory->name }}</td>
    				</tr>
    				<tr>
    					<th>Description:</th>
    					<td>{{ $item->description }}</td>
    				</tr>
    			</tbody>
  			</table>
  			<div class="my-4">
	  			<button class="btn btn-dark px-4 btn-addtocart" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-brand="{{ $item->brand->name }}" data-price="{{ $item->price }}" data-photo="{{ asset($item->photo) }}"><i class="fas fa-cart-plus pr-2"></i> Add to Cart</button>
  			</div>
			</div>
		</div>
	</div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('frontend_template/js/custom.js') }}"></script>
@endsection