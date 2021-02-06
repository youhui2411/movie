<?php
require_once 'conn.php';
//添加点赞记录
function addVideoLike($vid,$userIP){
    $link = getConnect();
    $sql = "insert into `like` (`vid`,`userIP`) values ('$vid','$userIP')";
    $result = mysqli_query($link,$sql);
    return $result;
}

//按视频编号和 ip 查找点赞记录
function findVideoLike($vid,$userIP){
    $link = getConnect();
    $sql = "select * from `like` where `vid`='$vid' and `userIP`= '$userIP'";

    $result = mysqli_query($link,$sql);
    $rs = mysqli_fetch_all($result,MYSQLI_BOTH);

    if(count($rs)>0){
        return $rs[0];
    }

    return $rs;
}

//获取客户端 ip 地址
function getIP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }elseif(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }else{
        $cip = "无法获取！";
    }
    return $cip;
}