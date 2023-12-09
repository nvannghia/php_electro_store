<?php
$query_cates_parent = pg_query($conn, "SELECT id,name FROM category WHERE parent_id = 0");
$cates_parent = pg_fetch_all($query_cates_parent);
// get cate_id wanna to edit
$cate_id = $_GET['cate_id'] ?? '';
if (!empty($cate_id)) {
    $query_cate_by_id = pg_query($conn, "SELECT * FROM category WHERE id = $cate_id");
    $category = pg_fetch_assoc($query_cate_by_id);
    if ($category['parent_id'] == 0)
        die("Can't edit category parent!");
}

// edit category
if (isset($_POST['edit_category'])) {
    // get data from form to update
    $cate_name = $_POST['category_name'] ?? '';
    $cate_parent_id = $_POST['category_parent_id'] ?? '';

    $validate_data = !empty($cate_name) && is_numeric($cate_parent_id);
    if ($validate_data) {
        $query_update_cate = pg_query($conn, "UPDATE category 
                                                SET name = '$cate_name', parent_id = $cate_parent_id 
                                                WHERE id = $cate_id 
                                                RETURNING *");
        if ($query_update_cate) {
            //update lại bien $category de hien thi duoi form 
            $category = pg_fetch_assoc($query_update_cate);
            echo "<p class='text-success h4'>Sửa danh mục thành công!</p>";
        } else {
            echo "<p class='text-danger h4'>Sửa danh mục thất bại!</p>";
        }
    } else
        echo "<p class='text-danger h4'>Vui lòng nhập đầy đủ thông tin các trường dữ liệu!</p>";
}
?>

<a href="index.php?param=category" class="btn btn-info mb-2">Về trang chủ danh mục</a>
<form action="<?php echo $_SERVER['PHP_SELF'] . "?param=category&process=edit&cate_id=$cate_id"; ?>" method="post">
    <div class="mb-3">
        <label for="category_name" class="form-label">Tên danh mục</label>
        <input value="<?php echo $category['name'];  ?>" type="text" class="form-control" id="category_name" name="category_name" style="width: 50%;" placeholder="Nhập tên danh mục...">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Chọn danh mục cha</label><br>
        <select class="form-select" style="min-width: 50%; min-height: 35px;" name="category_parent_id">
            <option value="0">Danh mục cha</option>
            <?php foreach ($cates_parent as $cate_p) : ?>
                <option value="<?php echo $cate_p['id'] ?>" <?php echo $cate_p['id'] == $category['parent_id'] ? 'selected' : ''; ?>>
                    <?php echo $cate_p['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button name="edit_category" type="submit" class="btn btn-primary">Sửa</button>
</form>