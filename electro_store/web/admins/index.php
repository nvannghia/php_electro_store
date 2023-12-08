<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Ready Bootstrap Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- //get connection -->
    <?php
    require_once('../db/connect.php');
    $conn = connect_db();
    if ($conn == null)
        die('Failed to connect');
    ?>
    <div class="wrapper">
        <!-- //header -->
        <?php require_once('partials/header.html');  ?>
        <!-- //sidebar -->
        <?php require_once('partials/sidebar.html'); ?>
        <!-- //main content -->
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <?php
                    $param = $_GET['param'] ?? '';
                    switch ($param) {
                        case 'category':
                            $process = $_GET['process'] ?? '';
                            if (!empty($process)) {
                                if ($process == 'add')
                                    require_once('partials/contents/categories/add.php');
                                else if ($process == 'edit') {
                                    if (!empty($_GET['cate_id'])) {
                                        require_once('partials/contents/categories/edit.php');
                                    } else
                                        die('Bad Request');
                                }
                            } else
                                require('partials/contents/categories/index.php');
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- //footer -->
        <?php require_once('partials/footer.html'); ?>
    </div>
    </div>

</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/demo.js"></script>

</html>