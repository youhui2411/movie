<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>动漫小屋</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <?php
    session_start();
    if(isset($_GET['action']) && $_GET['action']=='logout'){
        //清除 COOKIE 数据
        setcookie('userName','',time()-1);
        setcookie('password','',time()-1);
        //        //清除 SESSION 数据
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
    <?php
    require_once 'nav.php';
    ?>
    <!--轮播图-->
    <div id="carousel" class="carousel slide w-100 bg-dark" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
            <li data-target="#carousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/banner/banner01.jpg" class="mx-auto d-block img-fluid" alt="">
            </div>
            <div class="carousel-item">
                <img src="./img/banner/banner02.jpg" class="mx-auto d-block img-fluid" alt="">
            </div>
            <div class="carousel-item">
                <img src="img/banner/banner03.jpg" class="mx-auto d-block img-fluid" alt="">
            </div>
            <div class="carousel-item">
                <img src="./img/banner/banner04.jpg" class="mx-auto d-block img-fluid" alt="">
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!--分区导航栏-->
    <div id="catNavBar" class="container-fluid px-auto bg-light rounded my-2">
            <div class="row">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <a href="adventureArea.php" class="w-25 btn btn-info rounded-pill text-decoration-none m-2 align-self-start">冒险类</a>
                    <div class="text-muted">冒险类</div>
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <a href="battleArea.php" class="w-25 btn btn-info rounded-pill text-decoration-none m-2 align-self-start">战斗类</a>
                    <div class="text-muted">战斗类</div>
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <a href="funnyArea.php" class="w-25 btn btn-info rounded-pill text-decoration-none m-2 align-self-start">搞笑类</a>
                    <div class="text-muted">搞笑类</div>
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <a href="otherArea.php" class="w-25 btn btn-info rounded-pill text-decoration-none m-2 align-self-start">其他类</a>
                    <div class="text-muted">其他类</div>
                </div>
            </div>
        </div>

    <!--时下流行-->
    <!--标题导航栏-->
    <div class="container-fluid mt-4 mb-4">
        <div class="title d-flex ml-5 mb-0">
            <h2 class="mb-0">热门番剧</h2>
            <a href="hotVideo.php" class="align-self-end ml-auto text-muted text-decoration-none">查看全部>></a>
        </div>
        <hr>
    </div>
    <!--内容栏-->
    <div class="container-fluid mb-5">
        <div class="row">
            <?php
            require 'init/videodao.php';
            $hotVideos = findHotVideos();
            for($i=0;$i<count($hotVideos);$i++){
                echo '<div class="item col-sm-12 col-md-4 col-xl-2 mb-4">
                <div class="itemBody d-flex flex-column mx-2 align-items-center">
                    <a href="video.php?vid='.$hotVideos[$i]['vid'].'">
                    <img src="'.$hotVideos[$i]['coverUrl'].'" alt=""></a>
                    <div class="text mx-auto pt-2">
                        '.$hotVideos[$i]['videoName'].'
                    </div>
                </div>
            </div>';
            }
            ?>
        </div>
    </div>

    <!--最新上线-->
    <!--标题导航栏-->
    <div class="container-fluid mb-4">
        <div class="title d-flex ml-5 mb-0">
            <h2 class="mb-0">最新上线</h2>
            <a href="latestVideo.php" class="align-self-end ml-auto text-muted text-decoration-none">查看全部>></a>
        </div>
        <hr>
    </div>
    <!--内容栏-->
    <div class="container-fluid mb-5">
        <div class="row">
            <?php
            $latestVideos = findLatestVideos();
            for($i=0;$i<count($latestVideos);$i++){
                echo '<div class="item col-sm-12 col-md-4 col-xl-2 mb-4">
                <div class="itemBody d-flex flex-column mx-2 align-items-center">
                    <a href="video.php?vid='.$latestVideos[$i]['vid'].'">
                    <img src="'.$latestVideos[$i]['coverUrl'].'" alt=""></a>
                    <div class="text mx-auto pt-2">
                        '.$latestVideos[$i]['videoName'].'
                    </div>
                </div>
            </div>';
            }
            ?>
        </div>
    </div>

    <!--底部-->
    <?php
    require 'footer.php'
    ?>

    <script src="js/jquery-3.5.1.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
    <script>
        let change = document.getElementById("change");
        let img = document.getElementById("code_img");
        change.onclick = function(){
            img.src = "init/vericode.php?t="+Math.random(); //增加一个随机参数，防止图片缓存
            return false; //阻止超链接的跳转动作
        }
    </script>
</body>
</html>