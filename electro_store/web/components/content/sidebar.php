<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
    <div class="side-bar p-sm-4 p-3">
        <div class="search-hotel border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Tìm kiếm..</h3>
            <form action="" method="get">
                <input type="search" placeholder="Nhập tên sản phẩm..." name="kw" required="" />
                <input type="submit" value=" " />
            </form>
        </div>
        <!-- price -->
        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Giá</h3>
            <div class="w3l-range">
                <ul>
                    <li class="my-1">
                        <a href="?kw=range&from=1&to=1000000">Dưới 1 triệu</a>
                    </li>
                    <li>
                        <a href="?kw=range&from=2000000&to=5000000">Từ 2 triệu - 5 triệu</a>
                    </li>
                    <li class="my-1">
                        <a href="?kw=range&from=5000000&to=10000000">Từ 5 triệu - 10 triệu</a>
                    </li>
                    <li>
                        <a href="?kw=range&from=10000000&to=30000000">Từ 10 triệu - 30 triệu</a>
                    </li>
                    <li class="mt-1">
                        <a href="?kw=range&from=30000000&to=300000000">Trên 30 triệu</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- reviews -->
        <div class="customer-rev border-bottom left-side py-2">
            <h3 class="agileits-sear-head mb-3">Đánh giá của khách hàng</h3>
            <ul>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>5.0</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- //reviews -->
        <!-- electronics -->
        <div class="left-side border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Tất cả sản phẩm</h3>
            <ul>
                <?php
                $sql_cates_child = pg_query($conn, "select * from category where parent_id != 0");
                $cates_children = pg_fetch_all($sql_cates_child);
                foreach ($cates_children as $cate_child) :
                ?>
                    <li>
                        <span class="span">
                            <a style="color:black" href="?manage=category&cate_id=<?php echo $cate_child['id']; ?>">
                                <?php echo $cate_child['name']; ?>
                            </a>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- //electronics -->
        <!-- delivery -->
        <!-- <div class="left-side border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Cash On Delivery</h3>
            <ul>
                <li>
                    <input type="checkbox" class="checked" />
                    <span class="span">Eligible for Cash On Delivery</span>
                </li>
            </ul>
        </div> -->
        <!-- //delivery -->
        <!-- arrivals -->
        <!-- <div class="left-side border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">New Arrivals</h3>
            <ul>
                <li>
                    <input type="checkbox" class="checked" />
                    <span class="span">Last 30 days</span>
                </li>
                <li>
                    <input type="checkbox" class="checked" />
                    <span class="span">Last 90 days</span>
                </li>
            </ul>
        </div> -->
        <!-- //arrivals -->
        <!-- best seller -->
        <div class="f-grid py-2">
            <h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
            <div class="box-scroll">
                <div class="scroll">
                    <?php
                    $sql_hot_product = pg_query($conn, "select * from product ORDER BY id DESC LIMIT 6");
                    $hot_products = pg_fetch_all($sql_hot_product);
                    foreach ($hot_products as $hot_prod) :
                    ?>
                        <div class="row">
                            <div class="col-lg-3 col-sm-2 col-3 left-mar">
                                <img src="<?php echo $hot_prod['image']; ?>" alt="" class="img-fluid" />
                            </div>
                            <div class="col-lg-9 col-sm-10 col-9 w3_mvd">
                                <a href="?manage=product_detail&product_id=<?php echo $hot_prod['id']; ?>"><?php echo $hot_prod['name']; ?></a>
                                <a href="" class="price-mar mt-2">
                                    <?php echo number_format($hot_prod['price']); ?>
                                    <i class="fa-solid fa-dong-sign"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- //best seller -->
    </div>
    <!-- //product right -->
</div>