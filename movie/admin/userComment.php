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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php
session_start();
require_once 'nav.php';
require_once '../init/videodao.php';
require_once '../init/commentdao.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php
        require_once 'left.php';
        ?>
        <div class="col-11 mt-3">
            <h5>用户评论管理：</h5>
            <table id="tb" class="table table-dark" style="word-break:break-all; word-wrap:break-word;">
                <thead>
                <tr>
                    <th scope="col">cid</th>
                    <th scope="col">uid</th>
                    <th scope="col">用户名称</th>
                    <th scope="col">评论时间</th>
                    <th scope="col">评论内容</th>
                    <th scope="col">和谐评论</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $allVideos = findAllComment();
                foreach ($allVideos as $item){
                    echo '<tr>
                    <th scope="row">'.$item['cid'].'</th>
                    <td>'.$item['uid'].'</td>
                    <td>'.$item['userName'].'</td>
                    <td>'.$item['commentTime'].'</td>
                    <td>'.$item['commentText']. '</td>
                    <td>
                    <form action="commentfilter.php" method="post" onsubmit="return makeSure()">
                    <input hidden name="cid" type="text" value="' .$item['cid'].'">
                    <button class="btn btn-danger w-50" type="submit">和谐评论</button>
                    </form>
                    </td>
                </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script>
        function makeSure(){
            var flag = confirm("确定和谐这条评论?");
            if (flag==true){
                return true;
            }else{
                return false;
            }
        }
    </script>
</body>
</html>