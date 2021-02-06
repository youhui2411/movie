<?php
require '../init/commentdao.php';
$cid = (int)$_POST['cid'];

if(coverComment($cid)){
    echo "<script>alert('评论和谐成功，即将跳转到用户评论管理中心')</script>";
    echo "<script>location.href='userComment.php'</script>";
}else{
    echo "<script>alert('评论和谐失败')</script>";
}


