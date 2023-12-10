<?php
require '../vendor/autoload.php'; //load cac class can thiet cho cloudinary
require_once('../configs/cloudinary.php'); // cloudinary config
use Cloudinary\Api\Upload\UploadApi;
//query categories parent
$query_cates_parent = pg_query($conn, "SELECT * FROM category WHERE parent_id = 0");
$cates_parent = pg_fetch_all($query_cates_parent);

//query product by id
$prod_id = $_GET['prod_id'];
$query_prod_by_id = pg_query($conn, "SELECT product.name, 
                                    product.price,
                                    product.promotion_price,
                                    product.image,
                                    product.description,
                                    category.id as category_id  
                                    FROM product 
                                    INNER JOIN category 
                                    ON product.category_id = category.id
                                    WHERE product.id = $prod_id");
$product = pg_fetch_assoc($query_prod_by_id);

if (isset($_POST['edit_prod'])) {
    //data 
    $name = $_POST['prod_name'] ?? '';
    $price = $_POST['prod_price'] ?? '';
    $price_promotion = $_POST['prod_promotion'] ?? '';
    $desc = $_POST['prod_desc'] ?? '';
    $category_id = $_POST['category_id'] ?? '';

    // if admin upload new image for product
    if (file_exists($_FILES['prod_image']['tmp_name'])) {
        $response = (new UploadApi())->upload($_FILES['prod_image']['tmp_name'], array('folder' => 'electro_store/product'));
        $url_img = $response['secure_url'];
    } else { // if admin not upload new image for product -> use old image
        $url_img = $product['image'];
    }
    $res = pg_query($conn, "UPDATE product 
                                                SET name = '$name',
                                                price = $price,
                                                promotion_price = $price_promotion,
                                                description = '$desc',
                                                image = '$url_img',
                                                category_id = $category_id 
                                                WHERE id = $prod_id 
                                                RETURNING *");
    if ($res != false) {
        $product = pg_fetch_assoc($res);
        echo "<p class='text-success h4'>Cập nhật sản phẩm thành công!</p>";
    } else {
        echo "<p class='text-danger h4'>Cập nhật sản phẩm thất bại!</p>";
    }
}
?>

<a href="index.php?param=product" class="btn btn-info mb-2" style="font-size: 20px !important;">Về trang chủ sản phẩm</a>
<form action="<?php echo $_SERVER['PHP_SELF'] . "?param=product&process=edit&prod_id=$prod_id"; ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="category_name" class="form-label" style="font-size: 20px !important;">Tên sản phẩm</label>
        <input value="<?php echo $product['name']; ?>" type="text" class="form-control" id="prod_name" name="prod_name" style="width: 50%;" placeholder="Nhập tên sản phẩm...">
    </div>
    <div class="mb-3">
        <label for="category_name" class="form-label" style="font-size: 20px !important;">Giá gốc</label>
        <input value="<?php echo $product['price']; ?>" type="text" class="form-control" id="prod_price" name="prod_price" style="width: 50%;" placeholder="Nhập giá gốc sản phẩm...">
    </div>
    <div class="mb-3">
        <label for="category_name" class="form-label" style="font-size: 20px !important;">Giá khuyễn mãi</label>
        <input value="<?php echo $product['promotion_price']; ?>" type="text" class="form-control" id="prod_promotion" name="prod_promotion" style="width: 50%;" placeholder="Nhập giá khuyến mãi sản phẩm...">
    </div>
    <div class="mb-3">
        <label for="prod_desc" class="form-label" style="font-size: 20px !important;">Mô tả sản phẩm</label> <br>
        <textarea rows="5" name="prod_desc" id="prod_desc" cols="30" rows="10" style="width: 50%; resize: none;" placeholder="Nhập mô tả sản phẩm..."><?php echo $product['description']; ?></textarea>
    </div>
    <div class="mb-3">
        <img class="mb-1 mr-2" src="<?php echo $product['image']; ?>" alt="" width="150px">
        <label for="category_name" class="form-label" style="font-size: 20px !important;">Ảnh sản phẩm</label>
        <input type="file" class="form-control" id="prod_image" name="prod_image" style="width: 50%;">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" style="font-size: 20px !important;">Chọn danh mục</label><br>
        <select class="form-select" style="min-width: 50%; min-height: 35px;" name="category_id">
            <?php foreach ($cates_parent as $cate_p) : ?>
                <option disabled="disabled" style="color:blueviolet; font-size: 25px;"><?php echo $cate_p['name']; ?></option>
                <?php
                $parent_id =  $cate_p['id'];
                $query_cate_child = pg_query($conn, "SELECT * FROM category WHERE parent_id = $parent_id");
                $cates_child = pg_fetch_all($query_cate_child);
                foreach ($cates_child as $cate_c) :
                ?>
                    <option value="<?php echo $cate_c['id']; ?>" style=" font-size: 20px;" <?php echo  $cate_c['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                        &nbsp; &#8870; &nbsp;<?php echo $cate_c['name']; ?>
                    </option>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <button name="edit_prod" type="submit" class="btn btn-primary">Cập nhật</button>
</form>