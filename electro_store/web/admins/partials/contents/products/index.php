<?php
//pagination
$per_page = 3; // số records hiển thị trên mỗi trang
$query_number_records_product = pg_query($conn, "SELECT * FROM product");
$total_records = pg_num_rows($query_number_records_product); // tổng số records
$total_page = ceil($total_records / $per_page); // tổng số trang

if (isset($_GET['page']))
    $start = ($_GET['page'] - 1) * $per_page; // vị trí bắt đầu lấy dữ liệu
else
    $start = 0;

$query_products = pg_query($conn, "SELECT product.id, product.name, 
                                        product.price,
                                        product.promotion_price,
                                        product.image,
                                        product.description,
                                    category.name as category_name  
                                    FROM product 
                                    INNER JOIN category ON product.category_id = category.id
                                    ORDER BY product.id DESC
                                    LIMIT $per_page OFFSET $start
                                    ");
$products = pg_fetch_all($query_products);
?>

<a href="index.php?param=product&process=add" class="btn btn-primary mb-2" style="float: right; font-weight: 700;">Thêm
    sản phẩm</a>
<table class="table table-light">
    <thead class="table-info">
        <tr>
            <th scope="col" style="font-size: 20px;"> ID</th>
            <th scope="col" style="font-size: 20px;">Tên</th>
            <th scope="col" style="font-size: 20px;">Giá gốc</th>
            <th scope="col" style="font-size: 20px;">Giá khuyến mãi</th>
            <th scope="col" style="font-size: 20px;">Ảnh sản phẩm</th>
            <th scope="col" style="font-size: 20px;">Mô tả</th>
            <th scope="col" style="font-size: 20px;">Danh mục</th>
            <th scope="col" style="font-size: 20px;">Sửa|Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $prod) : ?>
            <tr id="<?php echo $prod['id']; ?>">
                <th scope="row" style="font-size: 15px;"><?php echo $prod['id'];  ?></th>
                <td style="font-size: 15px;"><?php echo $prod['name'];  ?></td>
                <td style="font-size: 15px;">
                    <?php echo number_format($prod['price']);  ?>
                    <i class="fa-solid fa-dong-sign"></i>
                </td>
                <td style="font-size: 15px;">
                    <?php echo number_format($prod['promotion_price']);  ?>
                    <i class="fa-solid fa-dong-sign"></i>
                </td>
                <td style="font-size: 15px;"><img src="<?php echo $prod['image']; ?>" width="150px" alt="Lỗi"></td>
                <td style="font-size: 15px; width: 25%;"><?php echo $prod['description'];  ?></td>
                <td style="font-size: 15px;"><?php echo $prod['category_name'];  ?></td>
                <td style="font-size: 15px;">
                    <a href="index.php?param=product&process=edit&prod_id=<?php echo $prod['id']; ?>" title="Sửa"><i class="fa-solid fa-pen-to-square h5"></i></a>
                    <span class="h2">|</span>
                    <a href="javascript:void(0)" onclick="delete_product(<?php echo $prod['id']; ?>)" title="Xóa"><i class="fa-solid fa-eraser h5"></i></a>
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
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?param=product&page=$page_previous"; ?>">Previous</a></li>
            <?php endif; ?>

            <?php
            for ($i = 1; $i <= $total_page; $i++) :
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?param=product&page=$i"; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <?php
            if (isset($_GET['page']) && $_GET['page'] < $total_page) :
                $current_page = $_GET['page'];
                $page_next = $current_page + 1;
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?param=product&page=$page_next"; ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</section>


<script>
    function delete_product(id) {
        var isConfirm = confirm("Bạn có chắc muốn xóa sản phẩm này?");
        if (isConfirm) {
            $.ajax({
                type: "GET",
                url: "./partials/contents/products/delete.php",
                dataType: 'json',
                data: {
                    prod_id: id
                },
                success: function(response) {
                    alert(response.message);
                    $('tr#' + id).css('display', 'none');
                },
                error: function(response) {
                    alert(response.message);
                }
            });
        }
    }
</script>