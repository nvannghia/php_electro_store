<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
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
            url: 'components/content/carts/cart2.php',
            type: 'post',
            data: data,
            success: function(response) {
                alert(response);
            }
        });
    });
}

function delete_cart() {
    $(document).ready(function() {
        alert("Deleted");
    });
}
</script>