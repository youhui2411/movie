<?php
header('Content-Type:text/html;charset=utf-8');
require_once 'init/likedao.php';
require_once 'init/videodao.php';
$vid=isset($_POST['vid'])?$_POST['vid']:'';
$likeCount= isset($_POST['likeCount'])?$_POST['likeCount']:'';
$userIP=getIP();
$result=findVideoLike($vid,$userIP);
if(!$result){
    addVideoLike($vid,$userIP);
    $likeCount+=1;
    $result=updateLikeCount($vid,$likeCount);
    echo $likeCount;
}else{
    return false;
}