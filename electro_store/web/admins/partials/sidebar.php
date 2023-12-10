<div class="sidebar">
  <div class="scrollbar-inner sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="assets/img/author.jpg" />
      </div>
      <div class="info">
        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
          <span>
            Hizrian
            <span class="user-level">Administrator</span>
            <span class="caret"></span>
          </span>
        </a>
        <div class="clearfix"></div>

        <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
          <ul class="nav">
            <li>
              <a href="#profile">
                <span class="link-collapse">My Profile</span>
              </a>
            </li>
            <li>
              <a href="#edit">
                <span class="link-collapse">Edit Profile</span>
              </a>
            </li>
            <li>
              <a href="#settings">
                <span class="link-collapse">Settings</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <?php
    //count categories quantity
    $query_number_records_category = pg_query($conn, "SELECT * FROM category");
    $count_categories = pg_num_rows($query_number_records_category);
    //count products quantity
    $query_number_records_product = pg_query($conn, "SELECT * FROM product");
    $count_products = pg_num_rows($query_number_records_product);
    ?>
    <ul class="nav">
      <li class="nav-item">
        <a href="index.php?param=category&page=1">
          <i class="la la-table"></i>
          <p>Danh mục</p>
          <span class="badge badge-count"><?php echo $count_categories; ?></span>
        </a>
      </li>

      <li class="nav-item">
        <a href="index.php?param=product&page=1">
          <i class="fa-brands fa-product-hunt"></i>
          <p>Sản phẩm</p>
          <span class="badge badge-count"><?php echo $count_products; ?></span>
        </a>
      </li>
    </ul>
  </div>
</div>