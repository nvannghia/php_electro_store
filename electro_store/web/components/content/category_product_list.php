<?php
//query category by id 
$cate_id = $_GET['cate_id'] ?? '';
$sql_cate_by_id = pg_query($conn, "SELECT name FROM category WHERE id = $cate_id");
$category = pg_fetch_assoc($sql_cate_by_id);
//query product belongs to category
$sql_products_by_cate_id = pg_query($conn, "SELECT * FROM product WHERE category_id = $cate_id");
$products = pg_fetch_all($sql_products_by_cate_id);
?>

<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.php">Trang chủ</a>
                    <i>|</i>
                </li>
                <li><?php echo $category['name']; ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="ads-grid  py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <?php
            $array_tiltle = array_filter(explode(" ", $category['name']));
            foreach ($array_tiltle as $title) :
            ?>
                <span><?php echo strtoupper($title[0]); ?></span><?php echo mb_substr($title, 1); ?>
            <?php endforeach ?>
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <!-- first section -->
                    <?php
                    foreach ($products as $keyP => $valueP) :
                        if ($keyP % 3 == 0) :
                    ?>
                            <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mt-4">
                                <div class="row">
                                <?php endif; ?>
                                <div class="col-md-4 product-men">
                                    <div class="men-pro-item simpleCart_shelfItem">
                                        <div class="men-thumb-item text-center">
                                            <img src="<?php echo $valueP['image'] ?>" alt="<?php $valueP['name'] ?>" width="200px" height="200px">
                                            <div class="men-cart-pro">
                                                <div class="inner-men-cart-pro">
                                                    <a href="?manage=product_detail&product_id=<?php echo $valueP['id']; ?>" class="link-product-add-cart">Xem chi tiết </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-info-product text-center border-top mt-4">
                                            <h4 class="pt-1">
                                                <a href="single.html"><?php echo $valueP['name']; ?></a>
                                            </h4>
                                            <div class="info-product-price my-2">
                                                <span class="item_price">
                                                    <?php echo number_format($valueP['promotion_price']); ?>
                                                    <i class="fa-solid fa-dong-sign"></i>
                                                </span>
                                                <del>
                                                    <?php echo number_format($valueP['price']); ?>
                                                    <i class="fa-solid fa-dong-sign"></i>
                                                </del>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                <form onsubmit="return false" onclick="cartInsert(<?php echo $valueP['id']; ?>)" method="post">
                                                    <fieldset>
                                                        <input type="hidden" id="prod_id<?php echo $valueP['id']; ?>" name="prod_id" value="<?php echo $valueP['id']; ?>" />
                                                        <input type="hidden" id="prod_name<?php echo $valueP['id']; ?>" name="prod_name" value="<?php echo $valueP['name']; ?>" />
                                                        <input type="hidden" id="prod_img<?php echo $valueP['id']; ?>" name="prod_img" value="<?php echo $valueP['image']; ?>" />
                                                        <input type="hidden" id="prod_quantity<?php echo $valueP['id']; ?>" name="prod_quantity" value="1" />
                                                        <input type="hidden" id="prod_price<?php echo $valueP['id']; ?>" name="prod_price" value="<?php echo $valueP['price']; ?>" />
                                                        <input type="submit" id="addtocart<?php echo $valueP['id']; ?>" name="addtocart" value="Thêm vào giỏ" class="button" />
                                                    </fieldset>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            <?php
                            if ($keyP % 3 == 2)
                                echo "</div> </div>";
                        endforeach;
                            ?>
                            <!-- //first section -->
                                </div>
                            </div>
                            <!-- //product left -->
                            <!-- product right -->
                            <?php include_once('sidebar.php') ?>
                            <!-- //product right -->
                </div>
            </div>
        </div>