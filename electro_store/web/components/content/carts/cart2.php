<?php
session_start();

if (isset($_POST['addtocart']) && $_POST['addtocart']) {
    add_to_cart();
}


function add_to_cart()
{
    if (!isset($_SESSION['cart']))
        $_SESSION['cart'] = [];
    // neu sp da ton tai -> tang so luong, nguoc lai -> them sp vao session
    $prod_id = $_POST['prod_id'];
    if (array_key_exists($prod_id, $_SESSION['cart'])) {
        $quantity = $_POST['prod_quantity'];
        $_SESSION['cart'][$prod_id][2] += $quantity; // tang so luong neu sp da ton tai
    } else {
        $prod_name = $_POST['prod_name'];
        $prod_img = $_POST['prod_img'];
        $prod_quantity = $_POST['prod_quantity'];
        $prod_price = $_POST['prod_price'];
        $_SESSION['cart'][$prod_id] = array($prod_name, $prod_img, $prod_quantity, $prod_price);
    }
    echo "Thêm sản phẩm vào giỏ hàng thành công!";
}
