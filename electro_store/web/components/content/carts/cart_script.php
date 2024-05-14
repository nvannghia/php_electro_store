<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
    // add product to cart
    function cartInsert(id) {
        $(document).ready(function() {
            data = {
                addtocart: $("#addtocart" + id).val(),
                prod_id: $("#prod_id" + id).val(),
                prod_name: $("#prod_name" + id).val(),
                prod_img: $("#prod_img" + id).val(),
                prod_quantity: $("#prod_quantity" + id).val(),
                prod_price: $("#prod_price" + id).val()
            };
            $.ajax({
                url: 'components/content/carts/cart_process.php',
                type: 'post',
                data: data,
                success: function(response) {
                    alert(response);
                }
            });
        });
    }

    //delete all items in cart
    function delete_cart() {
        $(document).ready(function() {
            $.ajax({
                url: 'components/content/carts/cart_process.php',
                type: 'get',
                data: 'del_all',
                success: function(response) {
                    $("#cart-wrapper").load(location.href + " #cart-wrapper");
                    alert("Đã xóa giỏ hàng!");
                }
            });
        });
    }

    //delete an items specific
    function delete_an_item(product_id) {
        $(document).ready(function() {
            $.ajax({
                url: 'components/content/carts/cart_process.php',
                type: 'get',
                data: {
                    'del_id': product_id
                },
                success: function(response) {
                    $("#cart-wrapper").load(location.href + " #cart-wrapper");
                    alert("Đã xóa sản phẩm!");
                }
            });
        });
    }

    // update cart

    function update_cart() {
        var prod_id_arr = $("input[name='prod_id[]']")
            .map(function() {
                return $(this).val();
            }).get();
        var quantity_arr = $("input[name='quantity[]']")
            .map(function() {
                return $(this).val();
            }).get();
        console.log(quantity_arr);
        console.log(prod_id_arr);
        $(document).ready(function() {
            $.ajax({
                url: 'components/content/carts/cart_process.php',
                type: 'get',
                data: {
                    'action': 'update',
                    'prod_id': prod_id_arr,
                    'quantity': quantity_arr
                },
                success: function(response) {
                    // alert(response);
                    $("#cart-wrapper").load(location.href + " #cart-wrapper");
                }
            });
        });
    }
</script>