<?php
require_once 'conn.php';

function findCommentByVid($vid){
    $link = getConnect();
    $sql = "select distinct * from comment where vid = '$vid'";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

function findAllComment(){
    $link = getConnect();
    $sql = "select distinct * from comment,user where (comment.uid = user.uid)";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

function addComment($uid,$vid,$commentText){
    $link = getConnect();
    $format="%Y-%m-%d %H:%M:%S";//设置时间格式
    $commentTime=strftime($format); //获取系统时间
    $sql = "insert into `comment` (`uid`,`vid`,`commentTime`,`commentText`) values ('$uid','$vid','$commentTime','$commentText');";

    $result = mysqli_query($link,$sql);
    return $result;
}

function coverComment($cid){
    $link = getConnect();
    $sql = "update comment set commentText = '该用户因为违规发言，评论已被和谐' where cid = '$cid'";
    $result = mysqli_query($link,$sql);
    return $result;
}
