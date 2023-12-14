<?php

if (isset($_POST['submit_statistical']) && !empty($_POST['follow_by'])) {
    $follow_by = $_POST['follow_by'];
    $sql_statistical = '';
    if ($follow_by == 'day') {
        $sql_statistical = pg_query($conn, "SELECT 
                                            to_char(created_at, 'DD-MM-YYYY') AS value, 
                                            SUM(amount) AS total 
                                            FROM orders 
                                            GROUP BY value");
    } else if ($follow_by == 'month') {
        $sql_statistical = pg_query($conn, "SELECT 
                                            EXTRACT(MONTH FROM created_at) || '-' || EXTRACT(YEAR FROM created_at) AS value,
                                            SUM(amount) AS total
                                            FROM orders
                                            GROUP BY value
                                            ORDER BY value DESC
                                    ");
    } else if ($follow_by == 'year') {
        $sql_statistical = pg_query($conn, "SELECT 
                                            EXTRACT(YEAR FROM created_at) AS value,
                                            SUM(amount) AS total
                                            FROM orders
                                            GROUP BY value
                                            ORDER BY value DESC
                                    ");
    } else {
        die("Bad request!");
    }

    if ($sql_statistical) {
        $data = pg_fetch_all($sql_statistical);
    } else
        die("Query failed!");
}
?>


<h2 class="text-info text-center">Thống Kê Doanh Thu</h2>
<hr>
<div class="text-center">
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?param=statistical'; ?>" method="post">
        <label style="font-size:20px !important;">Thống kê doanh thu theo:</label>
        <select name="follow_by" class="form-select" style="font-size:20px !important;">
            <option value="day">Ngày</option>
            <option value="month">Tháng</option>
            <option value="year">Năm</option>
        </select> <br>
        <button name="submit_statistical" type="submit" class="btn btn-primary">Xem thống kê</button>
    </form>
</div>
<hr>



<?php
if (isset($follow_by)) :
?>
    <div class="d-flex justify-content-center">
        <table class="table table-light" style="width: 70%;">
            <thead class="table-info">
                <tr>
                    <?php if ($follow_by == 'day') : ?>
                        <th scope="col" style="font-size: 20px;">Ngày đặt hàng</th>
                    <?php elseif ($follow_by == 'month') : ?>
                        <th scope="col" style="font-size: 20px;">Tháng đặt hàng</th>
                    <?php else : ?>
                        <th scope="col" style="font-size: 20px;">Năm đặt hàng</th>
                    <?php endif; ?>
                    <th scope="col" style="font-size: 20px;">Doanh thu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) : ?>
                    <tr>
                        <th scope="row" style="font-size: 15px;"> <?php echo $item['value']; ?></th>
                        <td style="font-size: 15px;"><?php echo  number_format($item['total']); ?><i class="fa-solid fa-dong-sign"></i></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>