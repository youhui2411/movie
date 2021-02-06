<?php
session_start();
require_once 'init/videodao.php';
$method = $_POST['method'];
$vid = $_POST['vid'];
$uid = $_SESSION['userInfo']['uid'];

var_dump($vid);
var_dump($uid);
if ($method=='add'){
    $rs = addFavourite($vid,$uid);
}

if($rs){
    echo "<script>alert('操作成功！即将跳回视频页面')</script>";
    echo "<script>location.href='video.php?vid=$vid'</script>";
}