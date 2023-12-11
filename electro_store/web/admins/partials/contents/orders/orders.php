<?php
$query_orders = pg_query($conn, 'SELECT orders.id,
                                            orders.amount,
                                            orders.addr,
                                            orders.note,
                                            orders.phone_number,
                                            orders.created_at,
                                            orders.payment_method,
                                            users.display_name
                                FROM orders INNER JOIN users
                                ON orders.user_id = users.id
                                ORDER BY id DESC
                                ');

$orders = pg_fetch_all($query_orders);
?>
<table class="table table-light">
    <thead class="table-info">
        <tr>
            <th scope="col" style="font-size: 15px;">ID</th>
            <th scope="col" style="font-size: 15px;">Tổng tiền</th>
            <th scope="col" style="font-size: 15px;">Khách hàng</th>
            <th scope="col" style="font-size: 15px;">Địa chỉ ship</th>
            <th scope="col" style="font-size: 15px;">Ghi chú ship</th>
            <th scope="col" style="font-size: 15px;">Số điện thoại</th>
            <th scope="col" style="font-size: 15px;">Ngày đặt hàng</th>
            <th scope="col" style="font-size: 15px;">PTTT</th>
            <th scope="col" style="font-size: 15px;">Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $orders) : ?>
            <tr>
                <th scope="row" style="font-size: 15px;"><?php echo $orders['id']; ?></th>
                <td style="font-size: 15px;"><?php echo number_format($orders['amount']); ?><i class="fa-solid fa-dong-sign"></i></td>
                <td style="font-size: 15px;"><?php echo $orders['display_name']; ?></td>
                <td style="font-size: 15px;"><?php echo $orders['addr']; ?></td>
                <td style="font-size: 15px;"><?php echo $orders['note']; ?></th>
                <td style="font-size: 15px;"><?php echo $orders['phone_number']; ?></td>
                <td style="font-size: 15px;"><?php echo date('d-m-Y', strtotime($orders['created_at'])); ?></td>
                <td style="font-size: 15px;"><?php echo $orders['payment_method']; ?></td>
                <td style="font-size: 15px;">
                    <a href="index.php?param=orders&process=detail&order_id=<?php echo $orders['id']; ?>" title="Xem chi tiết đơn hàng"><i class="fa-regular fa-eye h5"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>