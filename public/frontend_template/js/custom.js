  $(function () {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    show_product_count();

    function show_product_count() {

      // get cart JSON form localStorage
      let cart = localStorage.getItem('cart');

      if (cart) {
        // parse JSON to Obj
        let cart_obj = JSON.parse(cart);

        // initial product_count
        let product_count = 0;
        // loop the product_list array to get total quantity
        if (cart_obj.product_list) {
          $.each(cart_obj.product_list, function(i, v) {
            product_count += v.quantity;
          });
          
          $('.product-count').html(product_count);
        }

      }

    }

    function add_to_cart(product) {

      // check cart json in local storage
      let cart = localStorage.getItem('cart');

      if (!cart) {
        // if cart is not in the localStorage, create new one
        cart = '{"product_list":[]}';
      }

      // parse JSON to obj
      let cart_obj = JSON.parse(cart);
      
      // check product id in product list 
      // if same id, increase quantity
      // if not same, push new product to product list
      let has_value = false;
      $.each(cart_obj.product_list, function(i, v) {

        if (product.id == v.id) {
          v.quantity++;
          has_value = true;
        }

      });

      // push one product in product list of cart_obj
      if (!has_value) {
        cart_obj.product_list.push(product);
      }

      // parse cart_obj to JSON string and store to localstorage
      localStorage.setItem('cart', JSON.stringify(cart_obj));
      // console.log(cart_obj);

    }

    $('.btn-addtocart').click(function() {

      let id = $(this).data('id');
      let name = $(this).data('name');
      let brand = $(this).data('brand');
      let price = $(this).data('price');
      let photo = $(this).data('photo');

      var product = {
        id: id,
        name: name,
        brand: brand,
        price: price,
        photo: photo, 
        quantity: 1
      };
      add_to_cart(product);
      swal({
        title: "Added to the Cart!", 
        text: name + " is added to your cart.", 
        icon: "success", 
        timer: 3000
      });
      show_product_count();
    });

    showTable();

    function showTable() {

      let emptyhtml = `<p>
                        Your Cart is Empty.<br><hr><br>
                        <a href="/" class="btn btn-outline-dark px-4">View Products</a>
                      </p>`;
      let cart = localStorage.getItem('cart');
      if (cart) {

        let cart_obj = JSON.parse(cart);
        if (cart_obj.product_list) {
          if (cart_obj.product_list.length) {
            
            let html = ''; let j = 1, total = 0;
            $.each(cart_obj.product_list, function(i, v) {
              html += `
                    <tr>
                      <td>${j}</td>
                      <td align='center'><img src='${v.photo}' width='100'></td>
                      <td>${v.name}<br><small><i>${v.brand}</i></small></td>
                      <td>Ks.${v.price.toLocaleString()}</td>
                      <td class='td-quantity'>
                        <button class='btn btn-secondary btn-sm btn-minus mr-2 rounded-circle' data-id='${v.id}'>
                          <i class="fas fa-minus"></i>
                        </button>
                        ${v.quantity}
                        <button class='btn btn-secondary btn-sm btn-plus ml-2 rounded-circle' data-id='${v.id}'>
                          <i class="fas fa-plus"></i>
                        </button>
                      </td>
                      <td class='text-right'>Ks.${(v.quantity * v.price).toLocaleString()}</td>
                    </tr>
              `;
              total += v.quantity * v.price;
              j++;
            });

            html += ` 
                  <tr>
                    <td colspan='4' class='text-right font-weight-bold'>Total Price:</td>
                    <td colspan='2' class='text-right text-price'>Ks.${total.toLocaleString()}</td>
                  <tr>
                    `;

            $('#tbody-cart').before(html);

          } else {
            $(".div-cart").html(emptyhtml);
          }
        } else {
          $(".div-cart").html(emptyhtml);
        }

      } else {
        $(".div-cart").html(emptyhtml);
      }

    }


    // plus - minus
    function change_product_quantity(type, id) {
      
      let cart = localStorage.getItem('cart');

      let cart_obj = JSON.parse(cart);
      
      $.each(cart_obj.product_list, function(i, v) {

        if (v.id == id) {
          if (type == 1) {
            v.quantity++;
          } else {

            if (v.quantity == 1) {
              swal({
                title: "Are you sure to Remove?",
                text: "This item will be removed from your cart.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  
                  cart_obj.product_list.splice(i, 1);
                  
                  localStorage.setItem('cart', JSON.stringify(cart_obj));
                  showTable();
                  show_product_count();

                  let cart = localStorage.getItem('cart');
                  if (!cart) {
                    $('footer').addClass('fixed-bottom');
                  } else {
                    let cart_obj = JSON.parse(cart);
                    if (!cart_obj.product_list || !cart_obj.product_list.length) {
                      $('footer').addClass('fixed-bottom');
                    }
                  }
                } 
              });
              

            } else {
              v.quantity--;
            }
          }
        }

      });

      localStorage.setItem('cart', JSON.stringify(cart_obj));
      showTable();
      show_product_count();
          

    }

    // plus
    $('#tbody-cart').on('click', '.btn-plus', function() {
      
      let id = $(this).data('id');
      // alert(id);
      change_product_quantity(1, id);

    });
    // minus
    $('#tbody-cart').on('click', '.btn-minus', function() {
      
      let id = $(this).data('id');
      // alert(id);
      change_product_quantity(2, id);

    });


    // checkout 
    $('#tbody-cart').on('click', '.btn-checkout', function() {

      var localSto = localStorage.getItem('cart');
      var notes = $('#note').val();

      if (localSto) {
        $.post("/checkout", {data: localSto, note: notes}, function(response) {
          console.log(response);
        });
        localStorage.clear();
        
        swal("Order Success!", "Your Order is recorded!", "success")
        .then((value) => {
          window.location.href="/";
        });

      }

    });

    $('.btn-clearall').click(function() {
      
      swal({
        title: "Are you sure to Clear All Items?",
        text: "All items will be removed from your cart.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          
          localStorage.clear();
        
          showTable();
          show_product_count();
        } 
      });
      $('footer').addClass('fixed-bottom');
    });
})