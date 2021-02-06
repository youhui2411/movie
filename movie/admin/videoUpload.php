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
        <div class="col-11 mt-3">
            <form class="form-group" action="doVideoUpload.php"  enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="">视频名称</label>
                    <input name="videoName" class="form-control" type="text" value="<?php echo $userName?>">
                </div>
                <div class="form-group">
                    <label for="">视频简介</label>
                    <input name="videoDesc" class="form-control" type="text" value="<?php echo $userName?>">
                </div>
                <div class="form-group">
                    <label for="">视频分区</label>
                    <select name="videoArea" class="form-control">
                        <option value="adventure">冒险区</option>
                        <option value="battle">战斗区</option>
                        <option value="funny">搞笑区</option>
                        <option value="other">其他区</option>
                    </select>
                </div>
                <div class="form-group border-bottom">
                    <label for="">视频封面上传</label>
                    <input name="videoCover" class="form-control border-0 mb-1" type="file" value="">
                </div>
                <div class="form-group border-bottom"">
                    <label for="">视频文件上传</label>
                    <input name="videoFile" class="form-control border-0 mb-1" type="file" value="">
                <span>注：文件大小需要小于400M哦</span>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="submit">提交</button>
                    <button class="btn btn-danger" type="button" onclick="location.href='main.php'">返回首页</button>
                </div>
            </form>
    </div>
</div>


<script src="../js/jquery-3.5.1.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
</body>
</html>