<?php
require_once 'conn.php';
//获取所有视频
function findAllVideos(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc where video.vid = video_desc.vid;";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//获取时下流行视频,默认获取6条
function findHotVideos(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc where video.vid = video_desc.vid order by likeCount desc limit 6;";
    $result = mysqli_query($link, $sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//获取时下流行视频,默认获取全部
function findAllHotVideos(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc where video.vid = video_desc.vid order by likeCount desc;";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//获取最新上线视频,默认获取6条
function findLatestVideos(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc where video.vid = video_desc.vid order by video.videoTime desc limit 6;";
    $result = mysqli_query($link, $sql);
    return mysqli_fetch_all($result, MYSQLI_BOTH);
}

//获取最新上线视频,默认获取全部
function findAllLatestVideos(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc where video.vid = video_desc.vid order by video.videoTime desc;";
    $result = mysqli_query($link, $sql);
    return mysqli_fetch_all($result, MYSQLI_BOTH);
}

//根据vid来获取视频信息
function findVideoByViD($vid){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc where (video.vid = '$vid' and video.vid = video_desc.vid);";

    $result = mysqli_query($link,$sql);

    $rs = mysqli_fetch_all($result, MYSQLI_BOTH);
    if(count($rs)>0){
        return $rs[0];
    }
    return $rs;
}

//获取冒险区的视频信息
function findVideoInMovie(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc,video_adventure where (video.vid = video_desc.vid and video.vid = video_adventure.vid) order by video.videoTime desc;";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//获取战斗区的视频信息
function findVideoInSerial(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc,video_battle where (video.vid = video_desc.vid and video.vid = video_battle.vid) order by video.videoTime desc;";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//获取搞笑区的视频信息
function findVideoInLearn(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc,video_funny where (video.vid = video_desc.vid and video.vid = video_funny.vid) order by video.videoTime desc;";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//获取其他区的视频信息
function findVideoInOther(){
    $link = getConnect();
    $sql = "select distinct * from video,video_desc,video_other where (video.vid = video_desc.vid and video.vid = video_other.vid) order by video.videoTime desc;";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//按照标题搜索相关视频
function findVideoByKey($key){
    $link = getConnect();
    $key = '%'.$key.'%';
    $sql = "select distinct * from video,video_desc where (video.vid = video_desc.vid and video.videoName like '$key') order by video.videoTime desc;";
    $result = mysqli_query($link,$sql);
    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//添加新的视频
function addVideo($videoName,$videoUrl){
    $link = getConnect();
    $sql = "insert into video (`videoName`,`videoUrl`) values ('$videoName','$videoUrl');";
    $result = mysqli_query($link,$sql);
    return $result;
}

//按照视频标题寻找vid
function findVidByName($videoName){
    $link = getConnect();
    $sql = "select distinct * from video where videoName = '$videoName' order by video.videoTime desc;";

    $result = mysqli_query($link,$sql);
    $rs = mysqli_fetch_all($result,MYSQLI_BOTH);

    if(count($rs)>0){
        return $rs[0]['vid'];
    }
    return $rs;
}

//添加视频描述
function addVideoDesc($vid,$coverUrl,$videoDesc){
    $link = getConnect();
    $sql = "insert into video_desc (`vid`,`coverUrl`,`videoDesc`) values ('$vid','$coverUrl','$videoDesc');";

    $result = mysqli_query($link,$sql);
    return $result;
}

//修改视频描述内容
function updateVideoDesc($vid,$videoDesc){
    $link = getConnect();
    $sql = "update `video_desc` set videoDesc = '$videoDesc' where vid='$vid';";

    $result = mysqli_query($link,$sql);
    return $result;
}

//修改视频描述内容
function updateVideoName($vid,$videoName){
    $link = getConnect();
    $sql = "update `video` set videoName = '$videoName' where vid='$vid';";
    $result = mysqli_query($link,$sql);
    return $result;
}

//为视频添加分区信息
function addVideoArea($vid,$area){
    $link = getConnect();
    $sql = "insert into video_" .$area." (`vid`) values ('$vid');";
    $result = mysqli_query($link,$sql);
    return $result;
}

//更新点赞信息
function updateLikeCount($vid,$likeCount){
    $link = getConnect();
    $sql = "update video_desc set likeCount = '$likeCount' where vid = '$vid';";
    $result = mysqli_query($link,$sql);
    return $result;
}

//判断视频是否被用户收藏
function judgeFavourite($vid,$uid){
    $link = getConnect();
    $sql = "select * from user_favourite where (vid = '$vid' and uid = '$uid');";

    $result = mysqli_query($link,$sql);
    return $result;
}

//为用户添加收藏视频
function addFavourite($vid,$uid){
    $link = getConnect();
    $sql = "insert into user_favourite (`uid`,`vid`) values ('$uid','$vid');";
    $result = mysqli_query($link,$sql);
    return $result;
}

//为用户取消收藏视频
function deleteFavourite($vid,$uid){
    $link = getConnect();
    $sql = "delete from user_favourite where (`uid`='$uid' and `vid`='$vid');";
    $result = mysqli_query($link,$sql);
    return $result;
}


//根据vid来删除视频
function deleteVideoByVid($vid){
    $flag = true;
    $tables = ['video','comment','video_desc','video_funny','video_adventure','video_other','video_battle'];
    foreach($tables as $item){
       if(!deleteVideoByVidTool($vid,$item)){
           $flag = false;
       }
    }
    return $flag;
}

function deleteVideoByVidTool($vid,$item){
    $link = getConnect();
    $sql = "delete from ".$item." where vid = '$vid';";
    $result = mysqli_query($link,$sql);
    return $result;
}