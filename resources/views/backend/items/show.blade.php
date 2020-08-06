@extends('backend_template')

@section('title', 'Items')

@section('content')
	
	<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Item Detail</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">{{ $item->name }}</h6>
      </div>
      <div class="card-body p-md-5">

      	<div class="row">
      		<div class="col-md-4 p-4 p-md-0">
      			<img src="{{ asset($item->photo) }}" class="img-fluid shadow mb-4">
      		</div>
      		<div class="col-md-8 pl-md-4">
      			<table class="table table-sm table-striped">
      				<tbody>
	      				<tr>
	      					<th>Name:</th>
	      					<td>{{ $item->name }}</td>
	      				</tr>
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
	      					<th>Price:</th>
	      					<td>Ks.{{ $item->price }}</td>
	      				</tr>
	      				<tr>
	      					<th>Description:</th>
	      					<td>{{ $item->description }}</td>
	      				</tr>
	      			</tbody>
      			</table>
      		</div>
      	</div>

      </div>
    </div>

  </div>

@endsection