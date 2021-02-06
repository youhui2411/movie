<?php
require_once '../init/videodao.php';

$vid = $_POST['vid'];
$videoName = empty($_POST['videoName'])?$_POST['oldVideoName']:$_POST['videoName'];
$videoDesc = empty($_POST['videoDesc'])?$_POST['oldVideoDesc']:$_POST['videoDesc'];


$updateDesc = updateVideoDesc($vid,$videoDesc);
$updateName = updateVideoName($vid,$videoName);

if($updateDesc&&$updateName){
    echo "<script>alert('视频信息修改成功！即将返回视频管理中心')</script>";
    echo "<script>location.href='videoManage.php'</script>";
}




