<?php

function inputFilter($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkUsername($username){
    if(!strlen($username)){
        return '用户名不能为空';
    }
    return true;
}

function checkPassword($password){
    if(!preg_match('/^\w{6,16}$/',$password)){
        return '密码格式不符合要求';
    }
    return true;
}

function checkConfirmPassWord($password,$password1){
    if($password!=$password1){
        return '两次密码输入不一致';
    }
    return true;
}

function checkEmail($email){
    if(strlen($email)>50){
        return '邮箱长度不符合要求';
    }elseif(!preg_match('/^[a-z0-9]+@([a-z0-9]+\.)+[a-z]{2,4}$/i',$email)){
        return '邮箱格式不符合要求';
    }
    return true;
}