<?php
$user_id = $_SESSION['user']['id'] ?? '';
$cart_user_id = 'cart' . $user_id;

?>

<?php

?>
<div id="cart-wrapper">
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
    <?php
    if (isset($_GET['payment_success'])) :
    ?>
        <h1 class="text-success" style="text-align: center ;">
            Đặt hàng thành công! <a href="index.php">Tiếp tục mua sắm</a>
        </h1>
    <?php endif; ?>
    <?php if (isset($_SESSION[$cart_user_id]) && count($_SESSION[$cart_user_id]) > 0) : ?>
        <div class="privacy py-sm-5 py-4">
            <div class="container py-xl-4 py-lg-2">
                <!-- tittle heading -->
                <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                    <span>C</span>heckout
                </h3>
                <!-- //tittle heading -->
                <div class="checkout-right">
                    <h4 class="mb-sm-4 mb-3">Giỏ hàng đang có:
                        <span><?php echo count($_SESSION[$cart_user_id]); ?> sản phẩm</span>
                    </h4>
                    <div class="table-responsive">
                        <form onsubmit="update_cart(); return false;" method="get">
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
                                    foreach ($_SESSION[$cart_user_id] as $product_key => $product_value) :
                                        $sum += $product_value[2] * (float)$product_value['3'];
                                    ?>
                                        <tr class="rem1">
                                            <td class="invert"><?php echo ++$i; ?></td>
                                            <td class="invert-image">
                                                <a href="single.html">
                                                    <img src="<?php echo $product_value[1] ?>" alt=" " class="img-responsive" style="width: 120px;">
                                                </a>
                                            </td>
                                            <td class="invert"><?php echo $product_value[0]; ?></td>
                                            <td class="invert">
                                                <div class="quantity">
                                                    <div class="quantity-select">
                                                        <input type="number" name="quantity[]" value="<?php echo $product_value[2]; ?>" min=1 max=50>
                                                        <input type="hidden" name="prod_id[]" value="<?php echo $product_key; ?>">
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
                                                    <a href="javascript:void(0)" onclick="delete_an_item(<?php echo $product_key; ?>)">
                                                        <img width="50px" src="images/delete-svgrepo-com.svg" title="Xóa sản phẩm này" />
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <td colspan=" 5">
                                        <h3>
                                            Tổng tiền: <?php echo number_format($sum); ?>
                                            <i class="fa-solid fa-dong-sign"></i>
                                        </h3>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-info">Cập nhật</button>
                                    </td>

                                    <td>
                                        <a href="javascript:void(0)" onclick="delete_cart()" class="btn btn-danger">
                                            Xóa hết
                                        </a>
                                    </td>
                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>
                <div class="checkout-left">
                    <div class="address_form_agile mt-sm-5 mt-4">
                        <h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
                        <form action="./payment/process_payment.php" method="post" class="creditly-card-form agileinfo_form" enctype="application/x-www-form-urlencoded">
                            <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                                <div class="information-wrapper">
                                    <div class="first-row">
                                        <div class="controls form-group">
                                            <input class="billing-address-name form-control" type="text" name="fullName" placeholder="Họ và tên" required="" value="<?php echo $_SESSION['user']['display_name'] ?? '' ?>">
                                        </div>
                                        <div class="w3_agileits_card_number_grids">
                                            <div class="w3_agileits_card_number_grid_left form-group">
                                                <div class="controls">
                                                    <input type="text" class="form-control" placeholder="Số điện thoại" name="phoneNumber" required="">
                                                </div>
                                            </div>
                                            <div class="w3_agileits_card_number_grid_right form-group">
                                                <div class="controls">
                                                    <input type="text" class="form-control" placeholder="Email" name="email" required="" value="<?php echo $_SESSION['user']['email'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="controls form-group">
                                            <input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
                                        </div>
                                        <div class="controls form-group">
                                            <textarea rows="5" id="note" placeholder="Ghi chú" name="note" style="width: 100%; resize: none;"></textarea>
                                        </div>
                                    </div>
                                    <?php if (isset($_SESSION['user']['id'])) : ?>
                                        <button type="submit" class="submit check_out btn" name="payment_method" value="momo_QRcode">Thanh
                                            toán bằng
                                            MoMo
                                            QR code</button>
                                        <button type="submit" class="submit check_out btn" name="payment_method" value="momo_transfer">Thanh
                                            toán
                                            bằng MoMo chuyển khoản</button>
                                    <?php endif; ?>
                                    <button type="submit" class="submit check_out btn" name="payment_method" value="cash_on_delivery">Thanh toán
                                        khi nhận hàng</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    else :
        echo '
            <div style="text-align:center">
            <img src="images/empty-cart.png" alt="a" width=50%
            </div>
        ';
    endif;
    ?>
</div>