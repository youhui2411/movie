<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>错误信息</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .error-box{
            margin: 20px;
            padding: 10px;
            background: #FFF0F2;
            border: 1px dotted #ff0099;
            font-size: 14px;
            color: #ff0000;
        }
        .error-box ul{
            margin: 10px;
            padding-left: 25px;
        }
    </style>
</head>
<body>
<div class="error-box">
    错误信息如下：
    <ul>
        <?php
            foreach ($error as $v){
                if($v!=''){
                    echo "<li>$v</li>";
                }
            }
        ?>
    </ul>
</div>
</body>
</html>
