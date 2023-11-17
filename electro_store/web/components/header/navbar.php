<?php
if ($conn != null) {
    //get category parent for category navbar
    $cates_parent_query = pg_query($conn, "select * from category where parent_id = 0");
    $categories_parent = pg_fetch_all($cates_parent_query);
}
?>

<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="agileits-navi_search">
                <form action="#" method="post">
                    <select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
                        <option value="">Danh mục sản phẩm</option>
                        <?php
                        foreach ($categories_parent as $category) {
                            echo '<option value="' . $category['id'] . '">';
                            echo $category['name'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto text-center mr-xl-5">
                    <li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php
                    foreach ($categories_parent as $cate_parent) {
                        // get children of parent category
                        $cate_child_query = pg_query_params($conn, "SELECT * FROM category WHERE parent_id = $1", array($cate_parent['id']));
                        $categories_children = pg_fetch_all($cate_child_query);
                        echo '<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                ' . $cate_parent['name'] . '
                            </a>
                            <div class="dropdown-menu">
                                <div class="agile_inner_drop_nav_info p-4">
                                    <h5 class="mb-3">Thiết bị ' . $cate_parent['name'] . '</h5>
                                    <div class="row">';
                        //loop
                        foreach ($categories_children as  $cate_child) {
                            echo
                            '
                                    <div class="col-sm-6 multi-gd-img">
                                        <ul class="multi-column-dropdown">
                                            <li>
                                                <a href="?manage=category&cate_id=' . $cate_child['id'] . '">' . $cate_child['name'] . '</a>
                                            </li>
                                        </ul>
                                    </div>    
                            ';
                        }
                        //endloop
                        echo    '</div>
                            </div>
                        </div>
                    </li>';
                    }
                    ?>
                    <li class="nav-item mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="product.html">Tin tức</a>
                    </li>
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Các trang
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="product.html">Sản phẩm mới</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="checkout.html">Kiểm tra hàng</a>
                            <a class="dropdown-item" href="payment.html">Thanh toán</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>