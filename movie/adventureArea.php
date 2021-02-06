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
require 'nav.php';
?>
<div class="container-fluid  min-vh-100">
    <h4 class="my-5">动漫小屋冒险区：</h4>
    <div class="row">
        <?php
        require 'init/videodao.php';
        $videos = findVideoInMovie();
        if(count($videos)==0){
            echo "<h5 class='mx-5'>该分类下暂无视频</h5>";
        }
        for($i=0;$i<count($videos);$i++){
            echo '<div class="item col-sm-12 col-md-4 col-xl-2 mb-4">
                <div class="itemBody d-flex flex-column mx-2 align-items-center">
                    <a href="video.php?vid='.$videos[$i]['vid'].'">
                    <img src="'.$videos[$i]['coverUrl'].'" alt=""></a>
                    <div class="text mx-auto pt-2">
                        '.$videos[$i]['videoName'].'
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</div>
<!--底部-->
<?php
require 'footer.php'
?>

<script src="js/jquery-3.5.1.js"></script>
<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>
