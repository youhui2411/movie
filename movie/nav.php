<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <style>
        a{
            cursor:pointer;
        }
    </style>
</head>
<body>
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
}else{
    //用户信息不存在，说明用户没有登录
    $login = false;
}
?>
<!--顶部导航栏-->
<nav id="topNavBar" class="navbar navbar-expand-md navbar-light bg-light border-bottom">
    <!--Logo图片-->
    <a class="navbar-brand ml-md-0 ml-lg-4" href="index.php">
           <img src="img/Nav.png" width="80" height="60" alt="">
        </a>
    <!--Logo文字-->
    <a href="index.php" class="text-decoration-none h2 LogoText">动漫小屋</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--注册、登录、搜索栏-->
    <div id="navbar" class="collapse navbar-collapse justify-content-end">
        <!--判断是否登录，如果已经登录就隐藏登注册和登录按钮-->
        <ui class="navbar-nav mr-3 <?php echo $login?'d-none':''?>">
            <li><a data-toggle="modal" data-target="#login" class="nav-link">登录</a></li>
            <li><a data-toggle="modal" data-target="#register" class="nav-link">注册</a></li>
        </ui>
        <!--否则显示个人信息-->
        <ui class="navbar-nav mr-3 <?php echo $login?'':'d-none'?>">
            <li class="nav-link"><span>您好，<?php echo $_SESSION['userInfo']['userName']?></span></li>
            <li><a class="nav-link" href="userCenter.php">个人中心</a></li>
            <li><a class="nav-link" href="index.php?action=logout" onclick="return confirm('残忍离开？');">退出登录</a></li>
        </ui>
        <form action="searchArea.php" class="form-inline" method="post">
            <input name="key" type="text" class="form-control mr-2 my-2" placeholder="关键字">
            <button class="btn btn-outline-secondary ml-auto">搜索</button>
        </form>
    </div>
</nav>

<!-- 注册模态框 -->
<div id="register" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-title">
                <h2 class="text-center">注册</h2>
            </div>
            <div class="modal-body">
                <form class="form-group" action="doRegister.php" method="post">
                    <div class="form-group">
                        <label for="">用户名</label>
                        <input name="userName" class="form-control" type="text" placeholder="6-15位字母或数字">
                    </div>
                    <div class="form-group">
                        <label for="">密码</label>
                        <input name="password" class="form-control" type="password" placeholder="至少6位字母或数字">
                    </div>
                    <div class="form-group">
                        <label for="">再次输入密码</label>
                        <input name="passwordRep" class="form-control" type="password" placeholder="至少6位字母或数字">
                    </div>
                    <div class="form-group">
                        <label for="">邮箱</label>
                        <input name="email" class="form-control" type="email" placeholder="例如:abc@qq.com">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">提交</button>
                        <button class="btn btn-danger" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 登录模态框 -->
<div id="login" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-title">
                <h2 class="text-center">登录</h2>
            </div>
            <div class="modal-body">
                <form class="form-group" action="doLogin.php" method="post">
                    <div class="form-group">
                        <label for="">用户名</label>
                        <input name="userName" class="form-control" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">密码</label>
                        <input name="password" class="form-control" type="password" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="change">验证码</label>
                        <div class="d-flex align-items-center">
                            <div class="d-flex">
                                <img src="init/vericode.php" alt="" id="code_img"/>
                            </div>
                            <input name="verifyCode" class="form-control w-25 ml-auto" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <input name="autoLogin" type="checkbox" placeholder="">
                        <small class="pl-1 pb-lg-1">记住我</small>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">登录</button>
                        <button class="btn btn-danger" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    let img = document.getElementById("code_img");
    img.onclick = function(){
        img.src = "init/vericode.php?t="+Math.random(); //增加一个随机参数，防止图片缓存
        return false; //阻止超链接的跳转动作
    }
</script>
</body>
</html>