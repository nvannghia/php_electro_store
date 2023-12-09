<?php
session_start();
include_once('../../../db/connect.php');
require '../../../vendor/autoload.php'; //load cac class can thiet cho cloudinary
require_once('../../../configs/cloudinary.php');
require_once('../../../ceasar.php');

use Cloudinary\Api\Upload\UploadApi;

$conn = connect_db();
if ($conn == null)
    die("Connection failed!");

// if user logged
if (!empty($_SESSION['user'])) {
    header('Location: ../../../index.php');
}

if (isset($_POST['submit']) && $_POST['submit'] == 'Đăng ký') {
    $email = $_POST['email'] ?? '';
    $pwd = $_POST['pwd'] ?? '';
    $retypePwd = $_POST['retypePwd'] ?? '';
    $dp_name = $_POST['dp_name'] ?? '';
    //validate data
    $validate_success = !empty($email) && !empty($pwd) &&
        !empty($retypePwd) && !empty($dp_name) && !empty('avt');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $validate_success = false;
    if ($pwd != $retypePwd)
        $validate_success = false;
    if ($validate_success == false) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?error_msg');
        exit;
    }

    //insert into db table user
    if (file_exists($_FILES['avt']['tmp_name']))
        $response = (new UploadApi())->upload($_FILES['avt']['tmp_name'], array('folder' => 'electro_store/avatar'));
    //upload avatar image success
    if ($response['secure_url'] != '') {
        $url_avatar = $response['secure_url'];
        $res = pg_insert($conn, 'users', array('email' => $email, 'password' => ceasar_encode($pwd), 'display_name' => $dp_name, 'avatar' => $url_avatar, 'role' => 'CUSTOMER'));
        if ($res != false) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success_msg');
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?error_msg');
        }
    }
}

if (isset($_POST['submit']) && $_POST['submit'] == 'Đăng nhập') {
    $email = $_POST['email'] ?? '';
    $pwd = ceasar_encode($_POST['pwd']) ?? '';
    if (!empty($email) && !empty($pwd)) {
        $sql_login = "select  * from users where email = '" . $email . "' and password ='" . $pwd . "'";
        $login = pg_query($conn, $sql_login);
        $user_data = pg_fetch_assoc($login); // return false if query is wrong.
        if ($user_data != false) {
            $_SESSION['user'] = $user_data;
            header('Location: ../../../index.php');
            exit;
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF'] . '?error_msg');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <?php
    echo isset($_GET['error_msg'])
        ? '<p class="h3" style="color:yellow;text-align:center; background-color:rgb(8,121,201)">Thông tin thiếu hoặc chưa đúng, Vui lòng nhập lại!</p>'
        : '';
    echo isset($_GET['success_msg'])
        ? '<p class="h3" style="color:lightgreen;text-align:center; background-color:rgb(8,121,201)">Đăng ký thành công!</p>'
        : '';
    ?>
    <div class="login-reg-panel" style="background-color: rgb(8,121,201) !important; color:white">
        <div class="login-info-box">
            <h2>Bạn đã có tài khoản?</h2>
            <p>Đăng nhập ngay nhé</p>
            <label id="label-register" for="log-reg-show">Đăng nhập</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Bạn chưa có tài khoản?</h2>
            <p>Đăng ký ngày nào</p>
            <label id="label-login" for="log-login-show">Đăng ký</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>

        <div class="white-panel">
            <div class="login-show">
                <h2>Đăng Nhập</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input id="email" name="email" type="text" placeholder="Email...">
                    <input id="pwd" name="pwd" type="password" placeholder="Mật khẩu...">
                    <input type="submit" value="Đăng nhập" name="submit" class="btn btn-primary">
                    <a href="">Quên mật khẩu</a>
                </form>
            </div>
            <div class="register-show">
                <h2>Đăng Ký</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <input id="email" name="email" type="text" placeholder="Email...">
                    <input id="pwd" name="pwd" type="password" placeholder="Mật khẩu...">
                    <input id="retypePwd" name="retypePwd" type="password" placeholder="Nhập lại mật khẩu">
                    <input id="dp_name" name="dp_name" type="text" placeholder="Nhập tên đại diện">
                    <label for="avatar">Chọn ảnh đại diện</label>
                    <input type="file" name="avt">
                    <input type="submit" value="Đăng ký" name="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="login.js"></script>

</html>