<?php
require_once('../../../../../web/db/connect.php');
$conn = connect_db();
if ($conn == null)
    die("Connection failed!");
if (isset($_GET['prod_id']) && is_numeric($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];
    $query_delete_prod_by_id = pg_query($conn, "DELETE FROM product WHERE id = $prod_id");
    if ($query_delete_prod_by_id) {
        http_response_code(200);
        echo json_encode(array('message' => 'Xóa sản phẩm thành công!'));
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'Xóa sản phẩm thất bại!'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Sản phẩm không tồn tại!'));
}
