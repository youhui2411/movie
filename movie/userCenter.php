<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>动漫小屋</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?
session_start();
require_once 'nav.php';
require_once 'init/userdao.php';
if(!isset($_SESSION['userInfo'])){
    $error[] = '请先登录之后再进入用户中心';
    require 'init/error.php';
    die();
}
$uid = $_SESSION['userInfo']['uid'];
$user = findUserByUid($uid);

?>
<div class="container mt-5 min-vh-100">
    <div class="row border p-4 mb-3">
        <div class="col-12 col-lg-3 align-self-center">
            <img class="mr-5" src="img/<?php echo $user['avatar']; ?>" width="200" height="150">
        </div>
        <div class="col-12 col-lg-4 align-self-center">
            <h6>昵称：<?php echo $user['userName'] ?></h6>
            <h6>性别：<?php echo $user['gender'] ?></h6>
            <h6>邮箱：<?php echo $user['email'] ?></h6>
            <h6>注册时间：<?php echo $user['regtime'] ?></h6>
            <h6>级别：<?php echo $user['power'] ?></h6>
        </div>
        <div class="col-12 col-lg-5">
            <button class="btn btn-info" onclick="location.href='updateUser.php'">编辑资料</button>
            <button class="btn btn-info" onclick="location.href='updatePassword.php'">修改密码</button>
            <button class="btn btn-info" onclick="location.href='index.php'">回主页</button>
        </div>
    </div>
</div>
<?php
require_once 'footer.php';
?>


<script src="js/jquery-3.5.1.js"></script>
<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>