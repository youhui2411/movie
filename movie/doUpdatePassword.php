<?php
require_once 'init/userdao.php';
require_once 'init/checkform.php';
session_start();
if(!empty($_POST)) {
    $fields = array('oldPassword', 'newPassword', 'newPasswordRep');
    //表单字段若不为空，则将数据过滤后存入 saveData 指定字段中
    foreach ($fields as $v) {
        $saveData[$v] = isset($_POST[$v]) ? inputFilter($_POST[$v]) : '';
    }
    $uid = $_SESSION['userInfo']['uid'];
    $user = findUserByUid($uid);
    if($saveData['newPassword']!=$saveData['newPasswordRep']){
        $error[] = '两次密码输入不一致';
        require 'init/error.php';
        die();
    }
    if($user['password']!=md5($saveData['oldPassword'])){
        $error[] = '旧密码输入错误';
        require 'init/error.php';
        die();
    }
    updatePasswordByUid($uid,md5($saveData['newPassword']));
    //清除 COOKIE 数据
    setcookie('userName','',time()-1);
    setcookie('password','',time()-1);
    //清除 SESSION 数据
    unset($_SESSION['userInfo']);
    echo "<script>alert('密码修改成功，请重新登陆')</script>";
    echo "<script>location.href='index.php'</script>";
}