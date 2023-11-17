<?php
if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
    $product_id = $_GET['product_id'];
    $sql_prod_by_id = pg_query($conn, "SELECT * FROM product WHERE id = $product_id");
    $product = pg_fetch_assoc($sql_prod_by_id);
} else {
    echo "<h1 style='color:red'>Bad Request!!!</h1>";
    exit();
}
?>

<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.php">Trang chủ</a>
                    <i>|</i>
                </li>
                <li>Chi tiết sản phẩm <?php echo $product['name'] ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="banner-bootom-w3-agileits py-5">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>C</span>hi
            <span>T</span>iết
            <span>S</span>ản
            <span>P</span>hẩm
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <div class="col-lg-5 col-md-8 single-right-left ">
                <div class="grid images_3_of_2">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="images/<?php echo $product['image']; ?>">
                                <div class="thumb-image">
                                    <img src="images/<?php echo $product['image']; ?>" data-imagezoom="true" class="img-fluid" alt="">
                                </div>
                            </li>
                            <!-- <li data-thumb="images/si2.jpg">
                                <div class="thumb-image">
                                    <img src="images/si2.jpg" data-imagezoom="true" class="img-fluid" alt="">
                                </div>
                            </li>
                            <li data-thumb="images/si3.jpg">
                                <div class="thumb-image">
                                    <img src="images/si3.jpg" data-imagezoom="true" class="img-fluid" alt="">
                                </div>
                            </li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 single-right-left simpleCart_shelfItem">
                <h3 class="mb-3"><?php echo $product['name']; ?></h3>
                <p class="mb-3">
                    <span class="item_price">
                        <?php echo number_format($product['promotion_price']); ?>
                        <i class="fa-solid fa-dong-sign"></i>
                    </span>
                    <del class="mx-2 font-weight-light">
                        <?php echo number_format($product['price']); ?>
                        <i class="fa-solid fa-dong-sign"></i>
                    </del>
                    <label>Miễn phí giao hàng</label>
                </p>
                <div class="product-single-w3l">
                    <p><?php echo $product['description']; ?></p>
                </div>
                <div class="occasion-cart">
                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                        <form onsubmit="return false" onclick="cartInsert('<?php echo $product['id']; ?>')" method="post">
                            <fieldset>
                                <input type="hidden" id="prod_id<?php echo $product['id']; ?>" name="prod_id" value="<?php echo $product['id']; ?>" />
                                <input type="hidden" id="prod_name<?php echo $product['id']; ?>" name="prod_name" value="<?php echo $product['name']; ?>" />
                                <input type="hidden" id="prod_img<?php echo $product['id']; ?>" name="prod_img" value="<?php echo $product['image']; ?>" />
                                <input type="hidden" id="prod_quantity<?php echo $product['id']; ?>" name="prod_quantity" value="1" />
                                <input type="hidden" id="prod_price<?php echo $product['id']; ?>" name="prod_price" value="<?php echo $product['price']; ?>" />
                                <input type="submit" id="addtocart<?php echo $product['id']; ?>" name="addtocart" value="Thêm vào giỏ" class="button" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>