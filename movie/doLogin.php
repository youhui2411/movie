<?php
header('Content-Type:text/html;charset=utf-8');
require 'init/checkform.php';
require 'init/userdao.php';
$error = array();
session_start();
//当有表单提交时
if(!empty($_POST)){
    $userName = isset($_POST['userName']) ? inputFilter($_POST['userName']) : '';
    $password = isset($_POST['password']) ? inputFilter($_POST['password']) : '';
    $code = isset($_POST['verifyCode']) ? inputFilter($_POST['verifyCode']) : '';
    //将字符串都转成小写然后再进行比较
    if (strtolower($code)!= strtolower($_SESSION['verifyCode'])){
        $error[]='验证码输入错误';
    }
    if(!empty($error)){
        require 'init/error.php';
        die();
    }
    unset($_SESSION['verifyCode']);
    $row=findUserByName($userName);
    if($row){
        if($row['password']==md5($password)){
            //判断用户是否勾选了下次自动登录
            if(isset($_POST['autoLogin']) && $_POST['autoLogin']=='on'){
                $passwordCookie = $row['password'];
                $cookieExpire = time()+2592000; //保存30天3600*24*30
                setcookie('userName',$userName,$cookieExpire);
                setcookie('password',$passwordCookie,$cookieExpire);
            }
            //登录成功，保存用户会话
            $_SESSION['userInfo'] = array(
                'uid'=>$row['uid'],
                'userName'=>$userName,
                'power'=>$row['power']
            );
            echo "<script>alert('登录成功!自动跳转到首页>>>')</script>";
            echo "<script>location.href='index.php';</script>";//注册成功，跳转到首页
            die();
        }
    }
    $error[] = '用户名不存在或密码错误';
    require 'init/error.php';
}
//当 COOKIE 中存在登录状态时
if(isset($_COOKIE['userName']) && isset($_COOKIE['password'])){
    $userName = $_COOKIE['userName'];
    $password = $_COOKIE['password'];
    $row=findUserByName($userName);
    if($row){
        if($row['upass']==$password){

            $_SESSION['userInfo'] = array(
                'uid' => $row['uid'],
                'userName' => $userName,
                'power'=> $row['power']
            );

            header('Location: index.php');

            die();
        }
    }
} ?>