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
require_once '../init/videodao.php';
$vid = $_POST['vid'];
$video = findVideoByViD($vid);
?>
<div class="container-fluid">
    <div class="row">
        <?php
        require_once 'left.php';
        if(empty($vid)){
            echo "<h4 class='m-3'>请从对应的入口进入！</h4>";
        }
        ?>
        <div class="col-11 mt-3">
            <h5>修改视频信息：</h5>
            <form class="form-group" action="doVideoUpdate.php"  enctype="multipart/form-data" method="post">
                <input name="vid" hidden value="<?php echo $vid?>">
                <div class="form-group">
                    <label for="">视频名称</label>
                    <input hidden name="oldVideoName" class="form-control" type="text" value="<?php echo $video['videoName']?>">
                    <input name="videoName" class="form-control" type="text" value="<?php echo $video['videoName']?>">
                </div>
                <div class="form-group">
                    <label for="">视频简介</label>
                    <input hidden name="readonly oldVideoDesc" class="form-control" type="text" value="<?php echo $video['videoDesc']?>">
                    <input name="videoDesc" class="form-control" type="text" value="<?php echo $video['videoDesc']?>">
                </div>
            <div class="text-right">
                <button class="btn btn-primary" type="submit">提交</button>
                <button class="btn btn-danger" type="button" onclick="window.history.go(-1);">返回</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="../js/jquery-3.5.1.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
</body>
</html>