<?php
//delete all varible in session
if (isset($_GET['del_all']))
    session_unset();
// kiem tra session cart da ton tai hay chua ? ch ton tai -> tạo
if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];

// neu sp da ton tai -> tang so luong, nguoc lai -> them sp vao session
if (isset($_POST['addtocart']) && $_POST['addtocart']) {
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
}

// xoa 1 san pham
if (isset($_GET['del_id'])) {
    $product_id = $_GET['del_id'];
    unset($_SESSION['cart'][$product_id]);
}

?>

<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.php">Home</a>
                    <i>|</i>
                </li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
</div>

<div class="privacy py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>C</span>heckout
        </h3>
        <!-- //tittle heading -->
        <div class="checkout-right">
            <h4 class="mb-sm-4 mb-3">Giỏ hàng đang có:
                <span><?php echo count($_SESSION['cart']); ?> sản phẩm</span>
            </h4>
            <div class="table-responsive">
                <table class="timetable_sub">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $sum = 0;
                        foreach ($_SESSION['cart'] as $product_key => $product_value) :
                            $sum += $product_value[2] * (float)$product_value['3'];
                        ?>
                        <tr class="rem1">
                            <td class="invert"><?php echo ++$i; ?></td>
                            <td class="invert-image">
                                <a href="single.html">
                                    <img src="images/<?php echo $product_value[1] ?>" alt=" " class="img-responsive"
                                        style="width: 120px;">
                                </a>
                            </td>
                            <td class="invert"><?php echo $product_value[0]; ?></td>
                            <td class="invert">
                                <div class="quantity">
                                    <div class="quantity-select">
                                        <input type="number" value="<?php echo $product_value[2]; ?>" min=1 max=50>
                                    </div>
                                </div>
                            </td>
                            <td class="invert">
                                <?php echo number_format($product_value[3]); ?>
                                <i class="fa-solid fa-dong-sign"></i>
                            </td>
                            <td class="invert">
                                <?php echo number_format($product_value[2] * $product_value[3]); ?>
                                <i class="fa-solid fa-dong-sign"></i>
                            </td>
                            <td class="invert">
                                <div class="rem">
                                    <a href="?manage=cart&del_id=<?php echo $product_key; ?>">
                                        <div class="close1"></div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <td colspan="6">
                            <h3>
                                Tổng tiền: <?php echo number_format($sum); ?>
                                <i class="fa-solid fa-dong-sign"></i>
                            </h3>
                        </td>
                        <td>
                            <a href="?manage=cart&del_all">Xóa hết</a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="checkout-left">
            <div class="address_form_agile mt-sm-5 mt-4">
                <h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
                <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                    <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                        <div class="information-wrapper">
                            <div class="first-row">
                                <div class="controls form-group">
                                    <input class="billing-address-name form-control" type="text" name="name"
                                        placeholder="Full Name" required="">
                                </div>
                                <div class="w3_agileits_card_number_grids">
                                    <div class="w3_agileits_card_number_grid_left form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Mobile Number"
                                                name="number" required="">
                                        </div>
                                    </div>
                                    <div class="w3_agileits_card_number_grid_right form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Landmark"
                                                name="landmark" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="controls form-group">
                                    <input type="text" class="form-control" placeholder="Town/City" name="city"
                                        required="">
                                </div>
                                <div class="controls form-group">
                                    <select class="option-w3ls">
                                        <option>Select Address type</option>
                                        <option>Office</option>
                                        <option>Home</option>
                                        <option>Commercial</option>
                                    </select>
                                </div>
                            </div>
                            <button class="submit check_out btn">Giao hàng tới địa chỉ ở trên</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>