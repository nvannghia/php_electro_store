<?php
require_once('db/connect.php');
$conn = connect_db();

$per_page = 5;
$query_records = pg_query($conn, "SELECT * FROM category");
$total_records = pg_num_rows($query_records);
$total_page = ceil($total_records / $per_page);
// query limit
if (isset($_GET['page'])) {
    $start = ($_GET['page'] - 1) * $per_page;
} else {
    $start = 0;
}

$query_limit = pg_query($conn, "SELECT * FROM category ORDER BY id DESC LIMIT $per_page OFFSET $start ");
$categories = pg_fetch_all($query_limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <table style="border: 1px solid red">
        <thead>
            <th>id</th>
            <th>name</th>
            <th>parent_id</th>
        </thead>
        <?php foreach ($categories as $cate) : ?>
            <tr>
                <td><?php echo $cate['id']; ?></td>
                <td><?php echo $cate['name']; ?></td>
                <td><?php echo $cate['parent_id']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


    <hr>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            if (isset($_GET['page']) && $_GET['page'] > 1) :
                $current_page = $_GET['page'];
                $page_previous = $current_page - 1;
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=$page_previous"; ?>">Previous</a></li>
            <?php endif; ?>
            <?php
            for ($i = 1; $i <= $total_page; $i++) :
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=$i"; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <?php
            if (isset($_GET['page']) && $_GET['page'] < $total_page) :
                $current_page = $_GET['page'];
                $page_next = $current_page + 1;
            ?>
                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=$page_next"; ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>

</html>