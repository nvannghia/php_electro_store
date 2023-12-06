<?php
session_start();

require_once('../db/connect.php');
$conn = connect_db();

//get session cart
$user_id = $_SESSION['user']['id'] ?? '';
$cart_user_id = 'cart' . $user_id;

//total money of cart
$amount = 0;
foreach ($_SESSION[$cart_user_id] as $prod) {
    $amount += $prod[2] * $prod[3];
}
// unset($_SESSION['ship_info' . $user_id]);
// die();
?>
<?php
if ($user_id != '') { // if user logged
    $ship_info_payment_method  = $_SESSION['ship_info' . $user_id]['payment_method'] ?? '';
    if ($ship_info_payment_method = 'cash_on_delivery' || isset($_GET['payment_success'])) { // payment cart succcesss
        if (isset($_SESSION['ship_info' . $user_id])) {
            // turn on transaction
            pg_query($conn, "BEGIN");
            try {
                global $conn;

                $full_name = $_SESSION['ship_info' . $user_id]['fullName'];
                $phone_number = $_SESSION['ship_info' . $user_id]['phoneNumber'];
                $email = $_SESSION['ship_info' . $user_id]['email'];
                $address = $_SESSION['ship_info' . $user_id]['address'];
                $note = $_SESSION['ship_info' . $user_id]['note'];
                $payment_method = $_SESSION['ship_info' . $user_id]['payment_method'];

                //insert data into orders table:
                $date = date('Y-m-d');
                $query_insert_orders = "INSERT INTO orders(
                amount, created_at, user_id, full_name, phone_number, email, addr, note, payment_method)
                VALUES ( $amount, to_date('$date', 'YYYY-MM-DD'), 
                $user_id, '$full_name', '$phone_number', '$email', 
                '$address', '$note','$payment_method') RETURNING id";

                $result_orders_id = pg_query($conn, $query_insert_orders);

                //get id of records newly inserted to orders table
                if ($result_orders_id) {
                    $row_orders = pg_fetch_assoc($result_orders_id);
                    $newlyInsertedId_orders = $row_orders['id'];

                    //insert data into order_detail table:
                    $data_insert_order_detail = [];
                    foreach ($_SESSION[$cart_user_id] as $prod_key => $prod_value) {
                        $data_insert_order_detail[] = array($newlyInsertedId_orders, $prod_key, $prod_value[2], $prod_value[3]);
                    }

                    // column name
                    $columns = array("order_id", "product_id", "quantity", "unit_price");
                    // Tạo câu lệnh COPY FROM
                    $query_insert_order_detail = "COPY order_detail (" . implode(',', $columns) . ") FROM STDIN WITH CSV";
                    // Bắt đầu COPY FROM
                    pg_query($conn, $query_insert_order_detail);

                    // Ghi dữ liệu vào STDIN (Standard Input)
                    foreach ($data_insert_order_detail as $row) {
                        $line = implode(',', $row) . "\n";
                        pg_put_line($conn, $line);
                    }
                    // Kết thúc COPY FROM
                    pg_end_copy($conn);
                    pg_query($conn, "COMMIT");

                    //xóa session cart và thông tin ship hàng
                    unset($_SESSION[$cart_user_id]);
                    unset($_SESSION['ship_info' . $user_id]);
                    // chuyển trang
                    header('Location: ../index.php?manage=cart&payment_success');
                    exit;
                }
            } catch (Exception $ex) {
                // Nếu có lỗi, hủy bỏ giao dịch - rollback
                pg_query($conn, "ROLLBACK");
                echo "Lỗi: " . $ex->getMessage();
            } finally {
                // Đóng kết nối
                pg_close($conn);
            }
        }
    }
} else { // if user not log in
    // cart data
    $data = $_SESSION['cart'];
    // Chuyển đổi mảng thành chuỗi JSON
    $jsonData = json_encode($data);
    // dùng cookie store order
    setcookie("cookie_order", $jsonData, time() + 3600, "/");
    //xóa session cart
    unset($_SESSION[$cart_user_id]);
    header('Location: ../index.php?manage=cart&payment_success');
}
$payment_method = $_POST['payment_method'] ?? '';
if (!empty($payment_method)) {
    $_SESSION['ship_info' . $user_id] = $_POST ?? ''; // shipping information receive from cart_view.php
    if ($payment_method == 'cash_on_delivery')
        header('Location: ' . $_SERVER['PHP_SELF']);
    else if ($payment_method == 'momo_QRcode')
        require_once('momo/qr.php');
    else
        require_once('momo/atm.php');
} else
    die('Bad request!');
