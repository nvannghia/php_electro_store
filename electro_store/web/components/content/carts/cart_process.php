<?php
session_start();
// multiple session cart for multlple user
$user_id = $_SESSION['user']['id'] ?? ''; // get user's id logged
$cart_user_id = 'cart' . $user_id; // create cart with user's id logged. Example: 'cart8' .

// delete all items in cart
if (isset($_GET['del_all'])) {
    unset($_SESSION[$cart_user_id]);
}

//add to cart
if (isset($_POST['addtocart']) && $_POST['addtocart']) {
    add_to_cart();
}

// delete an item in cart
if (isset($_GET['del_id'])) {
    $product_id = $_GET['del_id'];
    unset($_SESSION[$cart_user_id][$product_id]);
}

// update cart
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    $prod_id_arr = $_GET['prod_id'] ?? ''; // an array id of product 
    $quantity_arr = $_GET['quantity'] ?? ''; // an array quantity of per product 
    for ($i = 0; $i < count($prod_id_arr); $i++) {
        $_SESSION[$cart_user_id][$prod_id_arr[$i]][2] = $quantity_arr[$i];
    }
}

function add_to_cart()
{
    global $cart_user_id;
    if (!isset($_SESSION[$cart_user_id]))
        $_SESSION[$cart_user_id] = [];
    // neu sp da ton tai -> tang so luong, nguoc lai -> them sp vao session
    $prod_id = $_POST['prod_id'];
    if (array_key_exists($prod_id, $_SESSION[$cart_user_id])) {
        $quantity = $_POST['prod_quantity'];
        $_SESSION[$cart_user_id][$prod_id][2] += $quantity; // tang so luong neu sp da ton tai
    } else {
        $prod_name = $_POST['prod_name'];
        $prod_img = $_POST['prod_img'];
        $prod_quantity = $_POST['prod_quantity'];
        $prod_price = $_POST['prod_price'];
        $_SESSION[$cart_user_id][$prod_id] = array($prod_name, $prod_img, $prod_quantity, $prod_price);
    }
    echo "Thêm sản phẩm vào giỏ hàng thành công!";
}
