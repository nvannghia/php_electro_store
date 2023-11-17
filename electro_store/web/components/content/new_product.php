<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>S</span>ản <span>P</span>hẩm <span>M</span>ới
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <?php
                    //query categories
                    $sql_cates_query_limit_4 = pg_query($conn, "SELECT id, name FROM category WHERE parent_id !=0 ORDER BY id DESC LIMIT 4");
                    $categories_limit_4 = pg_fetch_all($sql_cates_query_limit_4);
                    //get id of category
                    $products_limit_3 = [];
                    foreach ($categories_limit_4 as $cate) :
                        $cate_id = $cate['id'];
                        $sql_product_limit_3 = pg_query($conn, "SELECT * FROM product WHERE category_id = $cate_id LIMIT 3");
                        $products_limit_3 = array_merge($products_limit_3, pg_fetch_all($sql_product_limit_3));
                    endforeach;


                    foreach ($categories_limit_4 as $cate) :
                    ?>
                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5 py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">
                                <?php echo $cate['name']; ?>
                            </h3>
                            <div class="row">
                                <?php
                                foreach ($products_limit_3 as $prod) :
                                    if ($prod['category_id'] == $cate['id']) :
                                ?>
                                        <div class="col-md-4 product-men mt-5">
                                            <div class="men-pro-item simpleCart_shelfItem">
                                                <div class="men-thumb-item text-center">
                                                    <img src="images/<?php echo $prod['image']; ?>" alt="" width="200px" height="200px" />
                                                    <div class="men-cart-pro">
                                                        <div class="inner-men-cart-pro">
                                                            <a href="?manage=product_detail&product_id=<?php echo $prod['id']; ?>" class="link-product-add-cart">
                                                                Xem sản phẩm
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info-product text-center border-top mt-4">
                                                    <h4 class="pt-1">
                                                        <a href="?manage=product_detail&prod_id=<?php echo $prod['id']; ?>">
                                                            <?php echo $prod['name']; ?>
                                                        </a>
                                                    </h4>
                                                    <div class="info-product-price my-2">
                                                        <span class="item_price">
                                                            <?php echo number_format($prod['promotion_price']); ?>
                                                            <i class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                        <del>
                                                            <?php echo number_format($prod['price']); ?>
                                                            <i class="fa-solid fa-dong-sign"></i>
                                                        </del>
                                                    </div>
                                                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                        <form onsubmit="return false" onclick="cartInsert(<?php echo $prod['id']; ?>)" method="post">
                                                            <fieldset>
                                                                <input type="hidden" id="prod_id<?php echo $prod['id']; ?>" name="prod_id" value="<?php echo $prod['id']; ?>" />
                                                                <input type="hidden" id="prod_name<?php echo $prod['id']; ?>" name="prod_name" value="<?php echo $prod['name']; ?>" />
                                                                <input type="hidden" id="prod_img<?php echo $prod['id']; ?>" name="prod_img" value="<?php echo $prod['image']; ?>" />
                                                                <input type="hidden" id="prod_quantity<?php echo $prod['id']; ?>" name="prod_quantity" value="1" />
                                                                <input type="hidden" id="prod_price<?php echo $prod['id']; ?>" name="prod_price" value="<?php echo $prod['price']; ?>" />
                                                                <input type="submit" id="addtocart<?php echo $prod['id']; ?>" name="addtocart" value="Thêm vào giỏ" class="button" />
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <!-- //first section -->
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- //product left -->
            <!-- sidebar -->
            <?php include_once('sidebar.php') ?>
        </div>
    </div>
</div>
<!-- cart process -->