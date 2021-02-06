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
<?php
session_start();
require_once 'init/userdao.php';
require_once 'nav.php';
if(!isset($_SESSION['userInfo'])){
    $error[] = '请先登录之后再进入用户中心';
    require 'init/error.php';
    die();
}
$uid = $_SESSION['userInfo']['uid'];
$userName = $_SESSION['userInfo']['userName'];
$user = findUserByUid($uid);
$email = $user['email'];
?>

<div class="container mt-3 mb-5">
    <h5 class="mb-5">修改用户信息：</h5>
    <form class="form-group" action="doUpdateUser.php"  enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label for="">用户名</label>
            <input name="userName" class="form-control" type="text" value="<?php echo $userName?>">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input name="email" class="form-control" type="email" placeholder="例如:123@123.com" value="<?php echo $email?>">
        </div>
        <div class="form-group">
            <label for="">头像</label>
            <input name="avatar" class="form-control border-0 mb-1" type="file" value="">
        </div>
        <div class="text-right">
            <button class="btn btn-primary" type="submit">提交</button>
            <button class="btn btn-danger" type="button" onclick="location.href='userCenter.php'">返回个人中心</button>
        </div>
    </form>
</div>


<script src="js/jquery-3.5.1.js"></script>
<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>