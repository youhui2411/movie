<?php
header('Content-Type:text/html;charset=utf-8');
//引入表单验证函数，验证用户名和密码格式
require '../init/checkform.php';
//引入用户数据表数据访问层文件
require '../init/userdao.php';
$error = array(); //保存错误信息
session_start();
//当有表单提交时
if(!empty($_POST)){
    //接收用户登录表单
    $userName = isset($_POST['userName']) ? inputFilter($_POST['userName']) : '';
    $password = isset($_POST['password']) ? inputFilter($_POST['password']) : '';
    $code = isset($_POST['verifyCode']) ? inputFilter($_POST['verifyCode']) : '';
    //将字符串都转成小写然后再进行比较
    if (strtolower($code)!= strtolower($_SESSION['verifyCode'])){
        $error[]='验证码输入错误';
    }
    if(!empty($error)){
        require '../init/error.php';
        die();
    }
    //清除 session 数据
    unset($_SESSION['verifyCode']);
    //根据用户名取出用户信息
    $row=findUserByName($userName);
    if($row){
        //判断密码是否正确
        if($row['password']==md5($password)){
            //判断用户是否有权限
            if($row['power']!='系统管理员'){
                $error[] = '该用户无权限！';
                require '../init/error.php';
                die();
            }
            //判断用户是否勾选了下次自动登录
            if(isset($_POST['autoLogin']) && $_POST['autoLogin']=='on'){
                //将用户名和密码保存到 Cookie
                $passwordCookie = $row['password'];
                $cookieExpire = time()+2592000; //保存 1 个月(60*60*24*30)
                setcookie('userName',$userName,$cookieExpire);      //保存用户名
                setcookie('password',$passwordCookie,$cookieExpire);  //保存密码
            }
            //登录成功，保存用户会话
            $_SESSION['userInfo'] = array(
                'uid'=>$row['uid'],      //将用户 id 保存到 Session
                'userName'=>$userName,  //将用户名保存到 Session
                'power'=>$row['power']   //将用户权限保存到 Session
            );
            echo "<script>alert('登录成功!自动跳转到管理页面>>>')</script>";
            echo "<script>location.href='main.php';</script>";//注册成功，跳转到管理页面
            //终止脚本继续执行
            die();
        }
    }
    $error[] = '用户名不存在或密码错误';
    //调用公共文件 error.php 显示错误提示信息
    require '../init/error.php';
}
//当 COOKIE 中存在登录状态时
if(isset($_COOKIE['userName']) && isset($_COOKIE['password'])){
    //取出用户名和密码
    $userName = $_COOKIE['userName'];
    $password = $_COOKIE['password'];
    //根据用户名取出用户信息
    $row=findUserByName($userName);
    if($row){
        if($row['upass']==$password){
            //判断用户是否有权限
            if($row['power']!='系统管理员'){
                $error[] = '该用户无权限！';
                require '../init/error.php';
                die();
            }
            //登录成功，保存用户会话
            $_SESSION['userInfo'] = array(
                'uid' => $row['uid'],      //将用户 id 保存到 Session
                'userName' => $userName,  //将用户名保存到 Session
                'power'=> $row['power']   //将用户权限保存到 Session
            );
            //登录成功，跳转到 main.php 中
            header('Location: index.php');
            //终止脚本继续执行
            die();
        }
    }
} ?>