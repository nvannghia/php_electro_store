<?php
//pagination
$per_page = 5; // số records hiển thị trên mỗi trang
$query_number_records_cate = pg_query($conn, "SELECT * FROM category");
$total_records = pg_num_rows($query_number_records_cate); // tổng số records
$total_page = ceil($total_records / $per_page); // tổng số trang

if (isset($_GET['page']))
    $start = ($_GET['page'] - 1) * $per_page; // vị trí bắt đầu lấy dữ liệu
else
    $start = 0;


$query_cates_limit = pg_query($conn, "SELECT * FROM category ORDER BY id DESC LIMIT $per_page OFFSET $start");
$categories = pg_fetch_all($query_cates_limit);
?>

<a href="index.php?param=category&process=add" class="btn btn-primary mb-2" style="float: right; font-weight: 700;">Thêm
    danh mục</a>
<table class="table table-light">
    <thead class="table-info">
        <tr>
            <th scope="col" style="font-size: 20px;"> ID</th>
            <th scope="col" style="font-size: 20px;">Tên</th>
            <th scope="col" style="font-size: 20px;">Danh mục cha</th>
            <th scope="col" style="font-size: 20px;">Sửa|Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $cate) : ?>
            <tr id="<?php echo $cate['id']; ?>">
                <th scope="row" style="font-size: 15px;"><?php echo $cate['id'];  ?></th>
                <td style="font-size: 15px;"><?php echo $cate['name'];  ?></td>
                <td style="font-size: 15px;"><?php echo $cate['parent_id'];  ?></td>
                <td style="font-size: 15px;">
                    <a href="index.php?param=category&process=edit&cate_id=<?php echo $cate['id']; ?>" title="Sửa"><i class="fa-solid fa-pen-to-square h5"></i></a>
                    <span class="h2">|</span>
                    <a href="javascript:void(0)" onclick="detele(<?php echo $cate['id'];  ?>)" title="Xóa"><i class="fa-solid fa-eraser h5"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<section class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            if (isset($_GET['page']) && $_GET['page'] > 1) :
                $current_page = $_GET['page'];
                $page_previous = $current_page - 1;
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?param=category&page=$page_previous"; ?>">Previous</a></li>
            <?php endif; ?>

            <?php
            for ($i = 1; $i <= $total_page; $i++) :
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?param=category&page=$i"; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <?php
            if (isset($_GET['page']) && $_GET['page'] < $total_page) :
                $current_page = $_GET['page'];
                $page_next = $current_page + 1;
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?param=category&page=$page_next"; ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</section>

<script>
    function detele(id) {
        var result = confirm("Bạn có chắc muốn xóa danh mục này?");
        if (result) {
            $.ajax({
                type: "GET",
                url: "./partials/contents/categories/delete.php",
                dataType: 'json',
                data: {
                    cate_id: id
                },
                success: function(response) {
                    $("tr#" + id).css("display", "none");
                    alert(response.message);
                },
                error: function(response) {
                    alert(response.message);
                }
            });
        }
    }
</script>