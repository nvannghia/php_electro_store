<div class="container py-xl-4 py-lg-2">
    <!-- tittle heading -->
    <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
        <span>K</span>ết <span>Q</span>uả <span>T</span>ìm <span>K</span>iếm
    </h3>
    <!-- //tittle heading -->
    <div class="row">
        <!-- product left -->
        <div class="agileinfo-ads-display col-lg-9">
            <div class="wrapper">
                <?php
                if (!empty($_GET['kw'])) {
                    $kw = $_GET['kw'];
                    if ($kw == 'range' && isset($_GET['from']) && isset($_GET['to'])) { // search by price
                        $from = $_GET['from'];
                        $to =  $_GET['to'];
                        $query_search = pg_query($conn, "SELECT * FROM product WHERE promotion_price > $from AND promotion_price < $to");
                    } else // search by name
                        $query_search = pg_query($conn, "SELECT * FROM product WHERE name LIKE '%$kw%'");
                    $products = pg_fetch_all($query_search);
                } else {
                    die('Bad Request!');
                }
                ?>
                <?php if (!empty($products)) : ?>
                    <!-- first section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5 py-3 mb-4">
                        <div class="row">
                            <?php
                            foreach ($products as $prod) :

                            ?>
                                <div class="col-md-4 product-men mt-5">
                                    <div class="men-pro-item simpleCart_shelfItem">
                                        <div class="men-thumb-item text-center">
                                            <img src="<?php echo $prod['image']; ?>" alt="" width="100%" height="180px" />
                                            <div class="men-cart-pro">
                                                <div class="inner-men-cart-pro">
                                                    <a href="?manage=product_detail&product_id=<?php echo $prod['id']; ?>" class="link-product-add-cart mb-20">
                                                        Xem sản phẩm
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-info-product text-center border-top mt-4">
                                            <h4 class="pt-1">
                                                <a href="?manage=product_detail&product_id=<?php echo $prod['id']; ?>">
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
                                                        <input type="hidden" id="prod_price<?php echo $prod['id']; ?>" name="prod_price" value="<?php echo $prod['promotion_price']; ?>" />
                                                        <input type="submit" id="addtocart<?php echo $prod['id']; ?>" name="addtocart" value="Thêm vào giỏ" class="button" />
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php

                            endforeach;
                            ?>
                        </div>
                    </div>
                    <!-- //first section -->

                <?php
                else :
                    echo '<p class="text-center h3">Không tìm thấy sản phẩm phù hợp!</p>';
                endif;
                ?>
            </div>
        </div>
        <!-- //product left -->
        <!-- sidebar -->
        <?php include_once('sidebar.php') ?>
    </div>
</div>

<!-- cart process -->