@extends('frontend_template')

@section('title', 'Home Page')

@section('content')

<div class="container">

  <!-- Heading Row -->
  <div class="row align-items-center my-5">
    <div class="col-lg-7">
      <div id="carouselExampleIndicators" class="carousel slide mb-3 mb-lg-0" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner shadow">
          <div class="carousel-item active">
            <img src="{{ asset('frontend_template/img/1.jpg') }}" class="d-block w-100" alt="banner image 1">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('frontend_template/img/2.jpg') }}" class="d-block w-100" alt="banner image 2">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('frontend_template/img/3.jpg') }}" class="d-block w-100" alt="banner image 3">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      {{-- <img class="img-fluid rounded mb-4 mb-lg-0" src="http://placehold.it/900x400" alt=""> --}}
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-5">
      <h1 class="font-weight-light">Rainy Season Promotion!</h1>
      <p class="py-3">Every item is now with discount! Check our products for your needs below and do not miss out its discount and our free delivery service! </p>
      <a class="btn btn-outline-dark" href="#">View All Products</a>
    </div>
    <!-- /.col-md-4 -->
  </div>
  <!-- /.row -->

  <!-- Call to Action Well -->
  <div class="card border-0 shadow my-5 py-4 text-center" style="background-image: url({{ asset('frontend_template/img/background.jpg') }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
    <div class="card-body">
      <p class="m-0"><strong>Stay Home & SHOP ONLINE!</strong> Happiness is receiving what you ordered online, don't forget to order from us with <strong>Free Delivery!</strong></p>
    </div>
  </div>

  <!-- Content Row -->
  <h3 class="text-center my-5 py-3">Latest Items</h3>
  <div class="row my-5">

    @foreach ($items as $item)
      
      <div class="col-6 col-md-4 col-lg-3 mb-5">
        <div class="card border-0 shadow div-product">
          <a href="{{ route('itemdetail', $item->id) }}">
            <div class="card-body">
              <div class="img-wrap text-center py-0 py-lg-3">            
                <img src="{{ asset($item->photo) }}" class="img-fluid w-75">
              </div>
              <div class="module line-clamp">
                <h6 class="card-title">{{ $item->name }}</h6>
              </div>
              <div class="div-price">
                <p class="card-text mb-0"> 
                  @php
                    if ($item->discount != 0) {
                      $price = $item->price - ($item->price * $item->discount/100);
                    } else {
                      $price = $item->price;
                    }
                  @endphp
                  Ks.{{ $price }}
                </p>
                @if ($item->discount != 0)
                  <p class="m-0">
                    <span class="text-muted"><small><del class="pr-2">Ks.{{ $item->price }}</del>(-{{ $item->discount }}%)</small></span>
                  </p>
                @endif
              </div>
            </div>
          </a>
          <div class="card-footer bg-white">
            <button class="btn btn-dark btn-block btn-addtocart" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-brand="{{ $item->brand->name }}" data-price="{{ $price }}" data-photo="{{ asset($item->photo) }}"><i class="fas fa-cart-plus fa-sm pr-1"></i> Add to Cart</button>
          </div>
        </div>
      </div>

    @endforeach  
  </div>
  <!-- /.row -->

</div>

@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('frontend_template/js/custom.js') }}"></script>
@endsection