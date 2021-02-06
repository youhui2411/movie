<?php
if(isset($_GET['action']) && $_GET['action']=='logout'){
    //清除 COOKIE 数据
    setcookie('userName','',time()-1);
    setcookie('password','',time()-1);
    //清除 SESSION 数据
    unset($_SESSION['userInfo']);
    //如果 SESSION 中没有其他数据，则销毁 SESSION
    if(empty($_SESSION)){
        session_destroy();
    }
    header('Location: index.php');
}
//判断 SESSION 中是否存在用户信息
if(isset($_SESSION['userInfo'])){
    //用户信息存在，说明用户已经登录
    $login = true;   //保存用户登录状态
    $userInfo = $_SESSION['userInfo'];  //获取用户信息
    if($userInfo['power']!='系统管理员'){
        $error[] = '该用户无权限！';
        require '../init/error.php';
        die();
    }
}else{
    //用户信息不存在，说明用户没有登录
    $login = false;
    $error[] = '请先登录！';
    require '../init/error.php';
    die();
}
?>
<nav id="topNavBar" class="navbar navbar-expand-md navbar-dark bg-dark border-bottom">
    <!--Logo文字-->
    <div class="navbar-brand">动漫小屋后台管理</div>
    <!--否则显示个人信息-->
    <ui class="navbar-nav ml-auto <?php echo $login?'':'d-none'?>">
        <li class="nav-link"><span>您好，<?php echo $_SESSION['userInfo']['userName']?></span></li>
        <li><a class="nav-link" href="index.php?action=logout" onclick="return confirm('残忍离开？');">退出登录</a></li>
    </ui>
</nav>
