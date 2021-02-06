<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>动漫小屋</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <div class="bg">
        <div class="bgCover">
            <div class="loginBox">
                <form class="loginForm" action="doLogin.php" method="post">
                    <div class="formTitle">管理员登录</div>
                    <div class="formItem">
                        <input name="userName" class="formInput" type="text" autocomplete="off" placeholder="请输入用户名">
                    </div>
                    <div class="formItem">
                        <input name="password" class="formInput" type="password" autocomplete="off" placeholder="请输入密码">
                    </div>
                    <div class="formItem">
                        <input name="verifyCode" class="formInput verifyCode" type="text" autocomplete="off" placeholder="验证码">
                        <img src="../init/vericode.php" alt="" id="code_img"/>
                    </div>
                    <div class="formItem">
                        <label>
                        <input name="autoLogin" class="checkBox" id="autoLogin" type="checkbox" aria-hidden="false" value="">
                        <span class="checkBoxText">记住我</span>
                        </label>
                    </div>
                    <div class="formItem">
                            <button class="button" type="submit">
                                <span>登录</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script>
        let img = document.getElementById("code_img");
        img.onclick = function(){
            img.src = "../init/vericode.php?t="+Math.random(); //增加一个随机参数，防止图片缓存
            return false; //阻止超链接的跳转动作
        }
    </script>
</body>
</html>