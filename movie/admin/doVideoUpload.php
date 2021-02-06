<?php
require_once '../init/videodao.php';

if(empty($_POST['videoName'])){
    $error[] = '视频名称不能为空！';
    require '../init/error.php';
    die();
}
if(empty($_POST['videoDesc'])){
    $error[] = '视频简介不能为空！';
    require '../init/error.php';
    die();
}
if(empty($_FILES['videoCover']['name'])){
    $error[] = '视频封面不能为空！';
    require '../init/error.php';
    die();
}
if(empty($_FILES['videoFile']['name'])){
    $error[] = '视频文件不能为空！';
    require '../init/error.php';
    die();
}

$videoName = $_POST['videoName'];
$videoDesc = $_POST['videoDesc'];
$videoArea = $_POST['videoArea'];
$videoCover = $_FILES['videoCover'];
$videoFile = $_FILES['videoFile'];

$coverUploadFlag = false;
$fileUploadFlag = false;
//检查封面是否上传成功
if ($videoCover['error'] > 0) {
    $coverErrorMsg = '封面上传失败';
    $error['videoCover'] = $coverErrorMsg;
} else {
    if ($videoCover['size'] < 2000000) {
        $type = $videoCover['type'];
        $allowType = array('image/jpeg', 'image/png', 'image/gif');
        if (in_array($type, $allowType)) {
            $type = substr(strrchr($videoCover['name'], '.'), 1);
            $file = date("YmdHis") . rand(100, 999) . "." . $type;
            move_uploaded_file($videoCover['tmp_name'], "../img/" . $file);
            $coverUploadFlag = true;
        } else {
            $error['videoCover'] = '图像类型不符合要求,允许的类型为：' . implode(",", $allowType);
        }
    } else {
        $error['videoCover'] = '文件大小应小于 2M';
    }
}
//上传过程中没有错误发生
if (empty($error)) {
    //如果没有选择
    if(!$coverUploadFlag){
        $videoCoverUrl = './img/'.'Nav.png';
    }else{
        $videoCoverUrl = './img/'.$file;
    }
} else {
    require '../init/error.php';
    die();
}

//检查视频是否上传成功
if ($videoFile['error'] > 0) {
    $fileErrorMsg = '视频上传失败';
    $error['videoFile'] = $fileErrorMsg;
} else {
    if ($videoFile['size'] < 400000000) {
        $type = $videoFile['type'];
        $allowType = array('video/mp4','video/webm');
        if (in_array($type, $allowType)) {
            $type = substr(strrchr($videoFile['name'], '.'), 1);
            $file = date("YmdHis") . rand(100, 999) . "." . $type;
            move_uploaded_file($videoFile['tmp_name'], "../videos/" . $file);
            $fileUploadFlag = true;
        } else {
            $error['videoFile'] = '视频类型不符合要求,允许的类型为：' . implode(",", $allowType);
        }
    } else {
        $error['videoFile'] = '文件大小应小于 400M';
    }
}
if (empty($error)) {
    //上传过程中没有错误发生
    if(!$fileUploadFlag){
        $videoFileUrl = './videos/'.'1.mp4';
    }else{
        $videoFileUrl = './videos/'.$file;
    }
} else {
    require '../init/error.php';
    die();
}

//上述操作没有错误，下面将信息存入数据库
addVideo($videoName,$videoFileUrl);
$vid = findVidByName($videoName);
addVideoDesc($vid,$videoCoverUrl,$videoDesc);
addVideoArea($vid,$videoArea);

echo "<script>alert('上传视频成功，即将跳转到视频上传中心')</script>";
echo "<script>location.href='videoUpload.php'</script>";




