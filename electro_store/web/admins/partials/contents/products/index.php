<?php
$query_products = pg_query($conn, "SELECT * FROM product ORDER BY id DESC");
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
            <tr id="">
                <th scope="row" style="font-size: 15px;"><?php echo $prod['id'];  ?></th>
                <td style="font-size: 15px;"><?php echo $prod['name'];  ?></td>
                <td style="font-size: 15px;"><?php echo $prod['price'];  ?></td>
                <td style="font-size: 15px;"><?php echo $prod['promotion_price'];  ?></td>
                <td style="font-size: 15px;"><img src="<?php echo $prod['image'];  ?>" alt="Lỗi"></td>
                <td style="font-size: 15px;"><?php echo $prod['description'];  ?></td>
                <td style="font-size: 15px;"><?php echo $prod['category_id'];  ?></td>
                <td style="font-size: 15px;">
                    <a href="index.php?param=product&process=edit&prod_id=<?php echo $prod['id']; ?>" title="Sửa"><i class="fa-solid fa-pen-to-square h5"></i></a>
                    <span class="h2">|</span>
                    <a href="javascript:void(0)" onclick="detele(<?php echo $prod['id'];  ?>)" title="Xóa"><i class="fa-solid fa-eraser h5"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>