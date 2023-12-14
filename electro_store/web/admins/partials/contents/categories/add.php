<?php
$query_cates_parent = pg_query($conn, "SELECT id,name FROM category WHERE parent_id = 0");
$cates_parent = pg_fetch_all($query_cates_parent);
// add category
if (isset($_POST['add_category'])) {
    $cate_name = $_POST['category_name'] ?? '';
    $cate_parent_id = $_POST['category_parent_id'] ?? '';
    // may be when add parent cate, function empty(0) will return true;
    $validate_data = !empty($cate_name) && is_numeric($cate_parent_id);
    if ($validate_data) {
        $query_insert_cate = pg_query($conn, "INSERT INTO category(name, parent_id) VALUES('$cate_name', $cate_parent_id)");
        if ($query_insert_cate) {
            echo "<p class='text-success h4'>Thêm danh mục thành công!</p>";
        } else {
            echo "<p class='text-danger h4'>Thêm danh mục thất bại!</p>";
        }
    } else
        echo "<p class='text-danger h4'>Vui lòng nhập đầy đủ thông tin các trường dữ liệu!</p>";
}
?>
<a href="index.php?param=category&page=1" class="btn btn-info mb-2">Về trang chủ danh mục</a>
<form action="<?php echo $_SERVER['PHP_SELF'] . '?param=category&process=add'; ?>" method="post">
    <div class="mb-3">
        <label for="category_name" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" id="category_name" name="category_name" style="width: 50%;" placeholder="Nhập tên danh mục...">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Chọn danh mục cha</label><br>
        <select class="form-select" style="min-width: 50%; min-height: 35px;" name="category_parent_id">
            <option value="0">Danh mục cha</option>
            <?php foreach ($cates_parent as $cate_p) : ?>
                <option value="<?php echo $cate_p['id'] ?>"><?php echo $cate_p['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button name="add_category" type="submit" class="btn btn-primary">Thêm</button>
</form>