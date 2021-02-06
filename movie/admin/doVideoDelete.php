<?php
require '../init/videodao.php';

$vid = (int)$_POST['vid'];
$video = findVideoByViD($vid);
$videoFileUrl = ".".$video['videoUrl'];
$videoCoverUrl = ".".$video['coverUrl'];

$dbRes = deleteVideoByVid($vid);

$coverDel = unlink($videoCoverUrl);
$fileDel = unlink($videoFileUrl);

if($coverDel&&$fileDel){
    echo "<script>alert('视频删除成功，即将跳转到视频管理中心')</script>";
    echo "<script>location.href='videoManage.php'</script>";
}else{
    echo "<script>alert('视频删除失败')</script>";
}




