@extends('backend_template')

@section('title', 'Order Detail')

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Order Detail</h1>
      <a href="{{ route('orders') }}" class="mt-3 mt-sm-0 d-sm-inline-block btn btn-sm btn-info shadow-sm px-3"><i class="fas fa-angle-left fa-sm text-white-50 pr-1"></i> Back</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Order - {{ $order->voucherno }}</h6>
      </div>
      <div class="card-body">

      	<div class="table-responsive mt-2 mb-5">
      		<table class="table table-bordered">
      			<thead>
      				<tr>
      					<td colspan="3" class="py-3">
      						<strong>Voucher No: </strong> {{ $order->voucherno }} <br>
      						<strong>Order Date: </strong> {{ $order->orderdate }}
      					</td>
      					<td colspan="3" class="py-3">
      						<strong>Customer: </strong> {{ $order->user->name }} <br>
      						<strong>Total Amount: </strong> Ks.{{ $order->total }}
      					</td>
      				</tr>
      				<tr>
      					<th>No.</th>
      					<th>Photo</th>
      					<th>Item_Name</th>
      					<th>Unit_Price</th>
      					<th>Qty</th>
      					<th>Sub_Total</th>
      				</tr>
      			</thead>
      			<tbody>
      				@php $i=1; @endphp
      				@foreach ($order->items as $orderdetail)
      					<tr>
      						<td>{{ $i }}.</td>
      						<td align="center"><img src="{{ asset($orderdetail->photo) }}" width="70"></td>
      						<td>{{ $orderdetail->name }}</td>
      						<td>Ks.{{ $orderdetail->price }}</td>
      						<td>{{ $orderdetail->pivot->qty }}</td>
      						<td>Ks.{{ $orderdetail->pivot->qty * $orderdetail->price }}</td>
      					</tr>
      					@php $i++; @endphp
      				@endforeach
      				<tr>
      					<td colspan="3" rowspan="2">
      						<strong>Notes: </strong> {{ $order->note }}
      					</td>
      					<td><strong>Total Amount:</strong></td>
      					<td colspan="2" align="center"><big>Ks.{{ $order->total }}</big></td>
      				</tr>
      				<tr>
      					<td><strong>Status:</strong></td>
      					<td colspan="2" align="center">
      						<strong>
      						@if ($order->status == 0)
      							<span class="text-info">Order</span>
      						@else
      							<span class="text-success">Delivered</span>
      						@endif
      						</strong>
      					</td>
      				</tr>
      			</tbody>
      		</table>
      	</div>

      </div>
    </div>

  </div>

 @endsection