<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>动漫小屋</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php
    session_start();
    require_once 'nav.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php
            require_once 'left.php';
        ?>
        <div class="col-11">
            <dl class="border p-2">
                <dt>欢迎访问动漫小屋后台管理</dt>
            </dl>
            <dl class="border p-2">
                <dd>系统当前时间为：<?php echo  date('Y-m-d H:i:s', time());?></dd>
            </dl>
        </div>
    </div>
</div>


<script src="../js/jquery-3.5.1.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
</body>
</html>