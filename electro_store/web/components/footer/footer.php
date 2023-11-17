<footer>
    <div class="footer-top-first">
        <div class="container py-md-5 py-sm-4 py-3">
            <!-- footer first section -->
            <h2 class="footer-top-head-w3l font-weight-bold mb-2">Giới thiệu :</h2>
            <p class="footer-main mb-4">
                Nếu bạn đang xem xét một chiếc laptop mới, tìm kiếm một hệ thống âm
                thanh mạnh mẽ cho ô tô hoặc mua một chiếc TV mới, chúng tôi giúp bạn dễ
                dàng tìm thấy đúng những gì bạn cần với một giá bạn có thể chi trả.
                Chúng tôi cung cấp TV, laptop, điện thoại di động, máy tính bảng và
                iPad, trò chơi video, máy tính để bàn, máy ảnh và máy quay video, âm
                thanh, video và nhiều sản phẩm khác với một mức giá thấp hơn so với thị
                trường.
            </p>
            <!-- //footer first section -->
            <!-- footer second section -->
            <div class="row w3l-grids-footer border-top border-bottom py-sm-4 py-3">
                <div class="col-md-4 offer-footer">
                    <div class="row">
                        <div class="col-4 icon-fot">
                            <i class="fas fa-dolly"></i>
                        </div>
                        <div class="col-8 text-form-footer">
                            <h3>Miễn Phí Vận Chuyển</h3>
                            <p>Cho đơn hàng từ 1 triệu</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offer-footer my-md-0 my-4">
                    <div class="row">
                        <div class="col-4 icon-fot">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="col-8 text-form-footer">
                            <h3>Vận Chuyển Nhanh</h3>
                            <p>Toàn quốc</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offer-footer">
                    <div class="row">
                        <div class="col-4 icon-fot">
                            <i class="far fa-thumbs-up"></i>
                        </div>
                        <div class="col-8 text-form-footer">
                            <h3>Uy tín</h3>
                            <p>Đảm bảo chất lượng</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //footer second section -->
        </div>
    </div>
    <!-- footer third section -->
    <div class="w3l-middlefooter-sec">
        <div class="container py-md-5 py-sm-4 py-3">
            <div class="row footer-info w3-agileits-info">
                <!-- footer categories -->
                <div class="col-md-3 col-sm-6 footer-grids">
                    <h3 class="text-white font-weight-bold mb-3">Danh mục</h3>
                    <ul>
                        <?php
            $sql_categories_parent_footer = pg_query($conn, "SELECT * FROM category WHERE parent_id = 0");
            $categories_parent_footer = pg_fetch_all($sql_categories_parent_footer);
            foreach ($categories_parent_footer as $cate) :
            ?>
                        <li class="mb-3">
                            <a href=""><?php echo $cate['name']; ?> </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- //footer categories -->
                <!-- quick links -->
                <div class="col-md-3 col-sm-6 footer-grids mt-sm-0 mt-4">
                    <h3 class="text-white font-weight-bold mb-3">Liên hệ nhanh</h3>
                    <ul>
                        <li class="mb-3">
                            <a href="about.html">Về chúng tôi</a>
                        </li>
                        <li class="mb-3">
                            <a href="contact.html">Liên hệ</a>
                        </li>
                        <li class="mb-3">
                            <a href="help.html">Trợ giúp</a>
                        </li>
                        <li class="mb-3">
                            <a href="faqs.html">Câu hỏi thường gặp</a>
                        </li>
                        <li class="mb-3">
                            <a href="terms.html">Điều khoản sử dụng</a>
                        </li>
                        <li>
                            <a href="privacy.html">Bảo hành</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 footer-grids mt-md-0 mt-4">
                    <h3 class="text-white font-weight-bold mb-3">Liên lạc</h3>
                    <ul>
                        <li class="mb-3">
                            <i class="fas fa-map-marker"></i> 56 Văn Chung, Phường 13, Tân Bình, HCM
                        </li>
                        <li class="mb-3"><i class="fas fa-mobile"></i> 0372337713</li>
                        <li class="mb-3"><i class="fas fa-phone"></i> 6789568909</li>
                        <li class="mb-3">
                            <i class="fas fa-envelope-open"></i>
                            <a href="mailto:example@mail.com"> vannghianguyen.work@gmail.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 footer-grids w3l-agileits mt-md-0 mt-4">
                    <!-- newsletter -->
                    <h3 class="text-white font-weight-bold mb-3">Bản tin</h3>
                    <p class="mb-3">Miễn phí giao hàng cho đơn hàng đầu tiên</p>
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email..." name="email" required="" />
                            <input type="submit" value="Go" />
                        </div>
                    </form>
                    <!-- //newsletter -->
                    <!-- social icons -->
                    <div class="footer-grids w3l-socialmk mt-3">
                        <h3 class="text-white font-weight-bold mb-3">Theo dỗi chúng tôi</h3>
                        <div class="social">
                            <ul>
                                <li>
                                    <a class="icon fb" href="#">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon tw" href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon gp" href="#">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //social icons -->
                </div>
            </div>
            <!-- //quick links -->
        </div>
    </div>
    <!-- //footer third section -->
</footer>
<!-- copyright -->
<div class="copy-right py-3">
    <div class="container">
        <p class="text-center text-white">© 2023 Electro Store. All rights reserved | Design by
            <a href="http://w3layouts.com"> W3layouts.</a>
        </p>
    </div>
</div>
<!-- //copyright -->