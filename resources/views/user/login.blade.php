<!DOCTYPE html>
<html>
<head>
    <title>微商城</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <meta name="description" content="It's item page">

    <link rel="stylesheet" href="./dist/lib/weui.min.css">
    <link rel="stylesheet" href="./dist/css/jquery-weui.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        input.mall_btn_login{ width: 80%;}
    </style>
</head>

<body ontouchstart>

<!-- 头部 -->
<header class='mall-header'>
    <a class="mall-back" href="index.html"><img src="http://ogjfxbd4v.bkt.clouddn.com/icon_nav_back.png"></a>
    <h1 class="mall-title">用户登录</h1>
</header>
<div class="content">
    @if(!empty($msg))
    <div class="alert alert-danger">
        <ul>
            <li>
                    {{ $msg }}
            </li>
        </ul>
    </div>
    @endif
    <div class="mall_phone">
        <form action="/login" method="post">
            {{ csrf_field() }}
            <div class="weui_cell weui_phone_code">
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text" name="user_info" placeholder="请输入用户名，手机号，邮箱">
                </div>
            </div>
            <div class="weui_cell weui_phone_code">
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="password" name="password" placeholder="请输入密码">
                </div>
            </div>
            <div class="weui_cell weui_phone_code">
                <div class="weui_cell_bd weui_cell_primary">
                </div>
            </div>
            <input type="submit" class="weui_btn weui_btn_primary mall_btn_login" value="提交">
        </form>
    </div>

</div>


<footer>
    <a href="https://www.aaaxia.com/">兄弟会 李明霞</a>
</footer>

<style>
    .weui_icon_info_circle:before {
        font-size: 28px;
        color: #09BB07;
    }
</style>


<script src="./dist/lib/jquery-2.1.4.js"></script>
<script src="./dist/js/jquery-weui.js"></script>

</body>

</html>

