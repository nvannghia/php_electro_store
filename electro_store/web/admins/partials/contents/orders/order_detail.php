<?php
$order_id = $_GET['order_id'];
$query_order_by_id = pg_query($conn, "SELECT orders.id as order_id,
                                            product.id as product_id, product.name as product_name, product.image, 
                                            order_detail.quantity, order_detail.unit_price
                                      FROM   order_detail 
                                                    INNER JOIN orders 
                                                    ON order_detail.order_id = orders.id
                                                    INNER JOIN product
                                                    ON order_detail.product_id = product.id
                                        WHERE orders.id = $order_id");
$orders_detail = pg_fetch_all($query_order_by_id);
// echo "<pre>";
// print_r($orders_detail);
// echo "</pre>";
// exit('die');
?>

<a href="index.php?param=orders" class="btn btn-info mb-2" style=" font-weight: 700;">Xem tất cả đơn hàng</a>
<table class="table table-light">
    <thead class="table-info">
        <tr>
            <th scope="col" style="font-size: 20px;">Mã đơn hàng</th>
            <th scope="col" style="font-size: 20px;">Mã sản phẩm</th>
            <th scope="col" style="font-size: 20px;">Tên sản phẩm</th>
            <th scope="col" style="font-size: 20px;">Ảnh sản phẩm</th>
            <th scope="col" style="font-size: 20px;">Số lượng</th>
            <th scope="col" style="font-size: 20px;">Đơn giá</th>
            <th scope="col" style="font-size: 20px;">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        foreach ($orders_detail as $order_detail) :
            $total += $order_detail['quantity'] * $order_detail['unit_price'];
        ?>
            <tr>
                <th scope="row" style="font-size: 15px;"><?php echo $order_detail['order_id']; ?></th>
                <td style="font-size: 15px;"><?php echo $order_detail['product_id']; ?></td>
                <td style="font-size: 15px;"><?php echo $order_detail['product_name']; ?></td>
                <td style="font-size: 15px;"><img src="<?php echo $order_detail['image']; ?>" alt="" width="150px"></td>
                <th scope="row" style="font-size: 15px;"><?php echo $order_detail['quantity']; ?></th>
                <td style="font-size: 15px;"><?php echo number_format($order_detail['unit_price']); ?><i class="fa-solid fa-dong-sign"></i></td>
                <td style="font-size: 15px;"><?php echo number_format($order_detail['quantity'] * $order_detail['unit_price']); ?><i class="fa-solid fa-dong-sign"></i></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" class="text-right">
                <span class="h3">Tổng: <?php echo number_format($total); ?><i class="fa-solid fa-dong-sign"></i></span>
            </td>
        </tr>
    </tbody>
</table>