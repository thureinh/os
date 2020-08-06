<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Online Shop - @yield('title')</title>
  <!-- logo -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('cart.png') }}">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('frontend_template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend_template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="{{ asset('frontend_template/css/small-business.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><i class="fas fa-shopping-bag " style="-webkit-transform: rotate(-15deg);"></i> <span class="font-weight-bold pl-1">Online Shop</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active pr-2">
            <a class="nav-link" href="{{ route('home') }}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown pr-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Brand
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($brands as $brand)
                <li><a class="dropdown-item" href="#">{{ $brand->name }}</a></li>
              @endforeach
            </ul>
          </li>

          <li class="nav-item dropdown pr-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
              @foreach ($categories as $category)
                @if ($category->subcategories_count != 0)
                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">{{ $category->name }}</a> 
                    <ul class="dropdown-menu">
                      @foreach ($category->subcategories as $subcategory)
                        <li><a class="dropdown-item" href="#">{{ $subcategory->name }}</a></li>
                      @endforeach
                    </ul>
                  </li>
                @endif
              @endforeach
            </ul>
          </li>

          <li class="nav-item pr-2">
            <a class="nav-link" href="#">Log in | Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cart') }}">
              <i class="fas fa-shopping-cart"></i>
              <sup>
                <span class="badge badge-pill badge-secondary product-count"></span>
              </sup>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
    @yield('content')
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Online Shop 2020 | Laraval Project</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('frontend_template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend_template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  @yield('script')

  @if (request()->routeIs('cart'))
    <script type="text/javascript">
      let cart = localStorage.getItem('cart');
      if (!cart) {
        $('footer').addClass('fixed-bottom');
      } else {
        let cart_obj = JSON.parse(cart);
        if (!cart_obj.product_list || !cart_obj.product_list.length) {
          $('footer').addClass('fixed-bottom');
        }
      }
    </script>
  @else
    <script type="text/javascript">
      $('footer').removeClass('fixed-bottom');
    </script>
  @endif
</body>

</html>
