<?php
require_once('../../../../../web/db/connect.php');
$conn = connect_db();
if (isset($_GET['cate_id']) && is_numeric($_GET['cate_id'])) {
    $cate_id = $_GET['cate_id'];
    $query_cate_by_id = pg_query($conn, "DELETE FROM category WHERE id = $cate_id");
    if ($query_cate_by_id) {
        http_response_code(200);
        echo json_encode(array("message" => "Xóa danh mục thành công!"));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Xóa danh mục thất bại!"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Chưa có thông tin danh mục cần xóa!"));
}
