<?php
require_once 'conn.php';

//新增用户
function addUser($userName,$password,$email,$power=0){
    $link = getConnect();
    $regTime = date('Y-m-d H:i:s',time());
    $sql = "insert into user(userName,password,email,regTime,power) values ('$userName','$password','$email','$regTime','$power');";

    $result = mysqli_query($link,$sql);
    return $result;
}

//根据用户名查找用户
function findUserByName($userName){
    $link = getConnect();

    $sql = "select `uid`,`userName`,
        case
        when gender=0 then '女' 
        when gender=1 then '男' end as `gender`,`password`,`email`,`avatar`,`regtime`,
        case 
        when power=0 then '普通用户' 
        when power=1 then '系统管理员' end as `power` from `user` 
        where `userName`= '$userName';
        ";

    $result = mysqli_query($link,$sql);

    $rs = mysqli_fetch_all($result,MYSQLI_BOTH);

    if(count($rs)>0){
        return $rs[0];
    }

    return $rs;
}

//根据uid查找用户
function findUserByUid($uid){
    $link = getConnect();
    $sql = "select `uid`,`userName`,
        case
        when gender=0 then '女' 
        when gender=1 then '男' end as `gender`,`password`,`email`,`avatar`,`regtime`,
        case 
        when power=0 then '普通用户' 
        when power=1 then '系统管理员' end as `power` from `user` 
        where `uid`= $uid;
        ";

    $result = mysqli_query($link,$sql);

    $rs = mysqli_fetch_all($result,MYSQLI_BOTH);

    if(count($rs)>0){
        return $rs[0];
    }

    return $rs;
}

//根据uid更改用户信息
function updateUserByUid($uid,$userName,$email,$avatar){

    $link = getConnect();

    $sql = "update `user` set `userName`='$userName',`email`='$email',`avatar`='$avatar' where `uid`='$uid'";

    $result = mysqli_query($link,$sql);
    return $result;

}

//根据uid修改用户密码
function updatePasswordByUid($uid,$password){
    $link = getConnect();
    $sql = "update `user` set `password`='$password' where `uid`='$uid'";

    $result = mysqli_query($link,$sql);
    return $result;
}

//找到所有用户
function findAllUser(){
    $link = getConnect();
    $sql = "select `uid`,`userName`,
        case
        when gender=0 then '女' 
        when gender=1 then '男' end as `gender`,`password`,`email`,`avatar`,`regtime`,
        case 
        when power=0 then '普通用户' 
        when power=1 then '系统管理员' end as `power` from `user` ;
        ";
    $result = mysqli_query($link,$sql);

    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

//查找用户收藏的所有视频
function findUserFavourite($uid){
    $link = getConnect();
    $sql = "select * from video,video_desc where video.vid=video_desc.vid and video.vid in (select vid from user_favourite where uid = '$uid');";

    $result = mysqli_query($link,$sql);

    return mysqli_fetch_all($result,MYSQLI_BOTH);
}

