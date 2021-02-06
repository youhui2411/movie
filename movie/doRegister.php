<?php
header('Content-Type:text/html;charset=utf-8');
require 'init/checkform.php';
require 'init/userdao.php';
//判断Post表单数据是否为空
if(!empty($_POST)){
    $fields = array('userName','password','passwordRep','email');

    //表单数据存放
    $saveData = array();
    foreach ($fields as $i){
        $saveData[$i] = isset($_POST[$i])?inputFilter($_POST[$i]):"";
    }

    //错误信息存放
    $error = array();

    //验证用户名
    $result = checkUsername($saveData['userName']);
    if($result !== true){
        $error['userName'] = $result;
    }

    //验证用户名是否重名
    if(findUserByName($saveData['userName'])){
        $error['userName'] = '用户名已经存在，请重新选择一个用户名';
    }

    //验证密码
    $result = checkPassword($saveData['password']);
    if($result !== true){
        $error['password'] = $result;
    }


    //验证两次密码是否一致
    $result = checkConfirmPassWord($saveData['password'],$saveData['passwordRep']);
    if($result !== true){
        $error['passwordRep'] = $result;
    }

    //验证邮箱
    $result = checkEmail($saveData['email']);
    if($result !== true){
        $error['email'] = $result;
    }

    if(empty($error)){
        //表单数据验证完毕且无错误
        $rs = addUser($saveData['userName'],md5($saveData['password']),$saveData['email']);
        if($rs){
            echo "<script>alert('用户注册成功!自动跳转到首页>>>')</script>";
            echo "<script>location.href='index.php';</script>";//注册成功，跳转到首页
        }else{
            //数据库操作失败
            $error['error'] = '用户注册失败---------------';
            require 'init/error.php';
        }
    }else{
        //表单数据错误错误
        require 'init/error.php';
    }




}