<!DOCTYPE html>
<html>
<head>
    <title>用户注册</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <meta name="description" content="It's item page">

    <link rel="stylesheet" href="./dist/lib/weui.min.css">
    <link rel="stylesheet" href="./dist/css/jquery-weui.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body ontouchstart>

<!-- 头部 -->
<header class='mall-header'>
    <a class="mall-back" href="index.html"><img src="http://ogjfxbd4v.bkt.clouddn.com/icon_nav_back.png"></a>
    <h1 class="mall-title">用户注册</h1>
</header>

<div class="content">
    @if(!empty($msg))
        <div class="alert alert-danger">
            <ul>
                <li>
                    {{ $registerMsg }}
                </li>
            </ul>
        </div>
    @endif

    <div class="mall_phone">
        <form action="/user" method="post">
            {{ csrf_field() }}
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input"  id = 'tel' type="text" name="user_info" placeholder="请输入手机号">
                </div>
                <div class="weui_cell_ft">
                    <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                    <a href="javascript:;" class="weui_btn weui_btn_plain_primary sendcode">获取验证码</a>
                </div>
            </div>
            <div class="weui_cell weui_phone_code">
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text" name="code" placeholder="手机验证码">
                    <input hidden name="path" value="">
                </div>
            </div>
            <div class="weui_cell weui_phone_code">
                <div class="weui_cell_bd weui_cell_primary">
                </div>
            </div>
            <input type="submit" class="weui_btn weui_btn_primary mall_btn_phone" value="提交">
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
<script>
    var time = 60;
    $('.sendcode').click(function () {
        if((time > 0) && (time < 60)) {
            return 0;
        }

        var param = {
            "phone" : $('#tel').val(),
        }
        console.log(param);

        if(param.phone.length<11){
            alert('请正确输入手机号');
        }
        $.ajax({
            url: "http://www.safeapp.com/sendcode",
            type: "get",
            data: param,
            dataType: "json",
            success: function (data) {
                console.log(data);
                    sendcode();
                    if (data.smsResult.result.success){
                    alert('发送成功');
                }else{
                    alert('发送失败');
                }
            }
        });
    });

    function sendcode(){
        clearInterval(timer);
        var timer = setInterval(function(){
            if (time < 0) {
                clearInterval(timer);
                $(".sendcode").html("重新获取").removeClass("weui_btn_disabled");
                time = 60;
                return 0;
            }
            $(".sendcode").html(time + 's').addClass("weui_btn_disabled");
            time--;
        },1000);
    }

</script>
</body>

</html>

