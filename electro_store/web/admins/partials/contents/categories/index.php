<?php
$query_cates = pg_query($conn, "SELECT * FROM category ORDER BY id DESC");
$categories = pg_fetch_all($query_cates);
?>

<a href="index.php?param=category&process=add" class="btn btn-primary mb-2" style="float: right; font-weight: 700;">Thêm
    danh mục</a>
<table class="table table-light">
    <thead class="table-info">
        <tr>
            <th scope="col" style="font-size: 20px;"> ID</th>
            <th scope="col" style="font-size: 20px;">Tên</th>
            <th scope="col" style="font-size: 20px;">Danh mục cha</th>
            <th scope="col" style="font-size: 20px;">Xóa|Sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $cate) : ?>
        <tr>
            <th scope="row" style="font-size: 15px;"><?php echo $cate['id'];  ?></th>
            <td style="font-size: 15px;"><?php echo $cate['name'];  ?></td>
            <td style="font-size: 15px;"><?php echo $cate['parent_id'];  ?></td>
            <td style="font-size: 15px;">
                <a href="index.php?param=category&process=edit&cate_id=<?php echo $cate['id']; ?>" title="Sửa"><i
                        class="fa-solid fa-pen-to-square h5"></i></a>
                <span class="h2">|</span>
                <a href="#" title="Xóa"><i class="fa-solid fa-eraser h5"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>