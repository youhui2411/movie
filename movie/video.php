<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <style>
        video{
            width: 100%;
            height: 70vh;
        }
    </style>
    <meta charset="UTF-8">
    <title>动漫小屋</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php
    session_start();
    require_once 'nav.php';
    require_once 'init/videodao.php';
    require_once 'init/commentdao.php';
    require_once 'init/userdao.php';
    $vid = $_GET['vid'];
    $uid = $_SESSION['userInfo']['uid'];
    $video = findVideoByViD($vid);
    $comment = findCommentByVid($vid);
    $likeCount = $video['likeCount'];
    $isFavourite = false;
    if(!empty(judgeFavourite($vid,$uid))){
        $isFavourite = true;
    }
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 w-100">
                <video id="video" src="<?php echo $video['videoUrl']?>" controls></video>
            </div>
        </div>
        <div class="row mx-3 mb-3 flex-column">
            <h2><?php echo $video['videoName']?></h2>
            <small class="ml-auto pr-5">发布时间：<?php echo $video['videoTime']?></small>
            <small class="ml-auto pr-5">点赞数：<span id="likeCount"><?php echo $likeCount?></span></small>
        </div>
        <div class="row mx-3">
            <p><span>简介：<?php echo $video['videoDesc']?></span></p>
        </div>
        <div class="row mx-3">
            <div class="btn-group ml-auto">
                <div>
                <button id="like" class="btn btn-info mr-1 text-decoration-none">点赞</button>
                </div>
                <form action="doFavourite.php" method="post">
                    <input hidden name="vid" value="<?php echo $vid ?>">
                </form>
            </div>
        </div>
        <hr>
        <div class="row mx-1 mb-2">
            <h5 class="ml-3 mb-2">用户评论：<?php if(empty($comment)){echo "<span>暂无用户评论</span>";} ?></h5>
        </div>
        <?php
            foreach ($comment as $item){
                $user = findUserByUid($item['uid']);
                echo '<div class="media mx-3 mb-3">
            <img class="mr-3" src="img/'.$user['avatar'].'" alt="" width="100" height="60">
            <div class="media-body border-bottom">
                <h4>'.$user['userName'].':</h4>
                <p class="pb-3 pl-3">'.$item['commentText'].'</p>
                <div class="text-right">'.$item['commentTime'].'</div>
            </div>
        </div>';
            }
        ?>
        <div class="border-bottom mb-2"></div>
        <div class="row mx-1 mb-2">
            <h5 class="ml-3 mb-2">发表评论：</h5>
        </div>
        <div class="row mx-1 mb-5">
            <form class="w-100 d-flex" action="doComment.php" method="post">
            <div class="col-10">
                <textarea name="commentText" class="w-100"></textarea>
            </div>
            <div class="col-2">
                <button class="btn btn-info border rounded-pill">提交评论</button>
                <input name="vid" hidden value="<?php echo $vid?>">
            </div>
            </form>
        </div>
    </div>
<?php
require_once 'footer.php'
?>
<script src="js/jquery-3.5.1.js"></script>
<script src="./js/bootstrap.bundle.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#like").click(function(){
            $.ajax(
                { url:"updateLike.php",//处理数据的地址
                    type:"post",//数据提交形式
                    data:{//需要提交的数据
                        "vid":<?php echo $vid;?>,
                        "likeCount":<?php echo $likeCount;?>
                    },
                    success:function(data){//数据返回成功的回调
                        if(data==false){
                            alert("赞过了");
                        }else{
                            alert('点赞数+1');
                            $("#likeCount").html(data);
                        }
                    }
                });
        });
    });
</script>
</body>
</html>