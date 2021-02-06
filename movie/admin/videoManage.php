<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <style>
        #tb {
            table-layout:fixed;
        }
    </style>
    <meta charset="UTF-8">
    <title>动漫小屋</title>
    <!-- 引入Bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!--引入自定义样式表-->
    <link rel="stylesheet" href="./css/style.css">
    <!-- 移动设备优先 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php
session_start();
require_once 'nav.php';
require_once '../init/videodao.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php
        require_once 'left.php';
        ?>
        <div class="col-11 mt-3">
            <h5>管理所有视频：</h5>
            <table id="tb" class="table table-dark" style="word-break:break-all; word-wrap:break-word;">
                <thead>
                <tr>
                    <th scope="col">#vid</th>
                    <th scope="col">视频名称</th>
                    <th scope="col">视频简介</th>
                    <th scope="col">上传时间</th>
                    <th scope="col">删除视频</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $allVideos = findAllVideos();
                foreach ($allVideos as $item){
                    echo '<tr>
                    <th scope="row">'.$item['vid'].'</th>
                    <td>'.$item['videoName'].'</td>
                    <td>'.$item['videoDesc'].'</td>
                    <td>'.$item['videoTime'].'</td>
                    <td>
                    <form action="videoUpdate.php" method="post">
                    <input hidden name="vid" type="text" value="'.$item['vid']. '">
                    <button class="btn btn-info w-75 mb-2" type="submit">修改视频信息</button>
                    </form>
                    <form action="doVideoDelete.php" method="post" onsubmit="return makeSure()">
                    <input hidden name="vid" type="text" value="' .$item['vid'].'">
                    <button class="btn btn-danger w-75" type="submit">删除视频</button>
                    </form>
                    </td>
                </tr>';
                }
                ?>
                </tbody>
            </table>
    </div>
</div>


<!--引入jQuery文件-->
<script src="../js/jquery-3.5.1.js"></script>
<!--引入bootstrap文件-->
<script src="../js/bootstrap.bundle.js"></script>
<script>
    function makeSure(){
        var flag = confirm("确定要删除?");
        if (flag==true){
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>