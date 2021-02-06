<?php
header('Content-Type:text/html;charset=utf-8');//设置字符编码
require_once 'init/checkform.php'; //引入表单验证函数库
require_once 'init/userdao.php';
session_start();
//判断$_POST 是否为非空数组
if(!empty($_POST)) {
    $fields = array('userName', 'email', 'avatar');
    //表单字段若不为空，则将数据过滤后存入 saveData 指定字段中
    foreach ($fields as $v) {
        $saveData[$v] = isset($_POST[$v]) ? inputFilter($_POST[$v]) : '';
    }
    $uid = $_SESSION['userInfo']['uid'];
    //$error 数组保存验证后的错误信息
    $error = array();
    $uploadFlag = false; //上传成功标志，初始化为 false
    if (!empty($_FILES['avatar'])) {
        $avatar = $_FILES['avatar'];
        if ($avatar['name'] == '') {
            //若用户没有选择上传头像，则不做任何处理
        } else {
            if ($avatar['error'] > 0) {
                $errorMsg = '上传错误:';
                switch ($avatar['error']) {
                    case 1:
                    case 2:
                        $errorMsg = "文件大小超出系统限制";
                        break;
                    case 3:
                        $errorMsg .= '文件只有部分被上传';
                        break;
                    case 4:
                        $errorMsg .= '没有文件被上传';
                        break;
                    case 6:
                        $errorMsg .= '找不到临时文件夹';
                        break;
                    case 7:
                        $errorMsg .= '文件写入失败';
                        break;
                    default:
                        $errorMsg .= '未知错误';
                        break;
                }
                $error['error'] = $errorMsg;
            } else {
                if ($avatar['size'] < 2000000) {
                    $type = $avatar['type'];
                    $allowType = array('image/jpeg', 'image/png', 'image/gif');
                    if (in_array($type, $allowType)) {
                        $type = substr(strrchr($avatar['name'], '.'), 1);
                        $file = date("YmdHis") . rand(100, 999) . "." . $type;
                        move_uploaded_file($avatar['tmp_name'], "img/" . $file);
                        $uploadFlag = true;
                    } else {
                        $error['avatar'] = '图像类型不符合要求,允许的类型为：' . implode(",", $allowType);
                    }
                } else {
                    $error['avatar'] = '文件大小应小于 2M';
                }
            }
        }
        if (empty($error)) {
        //上传过程中没有错误发生
        if(!$uploadFlag){
            $avatarUrl = 'Nav.png';
        }else{
            $avatarUrl = $file;
        }
        updateUserByUid($uid,$saveData['userName'],$saveData['email'],$avatarUrl);
            echo "<script>alert('资料编辑成功，即将跳转到个人中心')</script>";
            echo "<script>location.href='userCenter.php'</script>";
        } else {
            require 'init/error.php';
        }
    }
}
