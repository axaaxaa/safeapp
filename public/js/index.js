var t = 1;
var zj;
var initialize = function() {
    $('#prompt').html('恭喜您获得' + zj);
};
var c1;
var ctx;

var ismousedown;
var isOk = 0;
var fontem = parseInt(window.getComputedStyle(document.documentElement, null)["font-size"]);
window.onload = function() {
    if (window.localStorage.getItem("xdlggl")) {
        var result = JSON.parse(window.localStorage.getItem("xdlggl"));
    };
    if (result) {
        if (confirm('您已经抽过奖了，是否查看中奖结果？')) {
            $('#username').val(result.username);
            $('#contact_way').val(result
                .contact_way);
            $('#c1').hide();
            $('.fixed').hide();
            $('.shadow').hide();
            $('#prompt').html('恭喜您获得' + result.zj);
            $('.ggl_box1_lj').css('opacity', 1);
        };
    };
    c1 = document.getElementById("c1");
    c1.width = c1.clientWidth;
    c1.height = c1.clientHeight;
    ctx = c1.getContext("2d");
    c1.addEventListener("mousemove", eventMove, false);
    c1.addEventListener("mousedown", eventDown, false);
    c1.addEventListener("mouseup", eventUp, false);
    c1.addEventListener('touchstart', eventDown, false);
    c1.addEventListener('touchend', eventUp, false);
    c1.addEventListener('touchmove', eventMove, false);
    initCanvas();
    $('.shadow').css('height', $('.wrapper').height());
};
window.onresize = function() {
    $('.shadow').css('height', $('.wrapper').height());
}
$('.user_submit').on('click', function() {
    if (!/^[\u4e00-\u9fa5]{2,20}$/.test($('#username').val())) {
        alert('姓名格式不正确');
        return false;
    };
    if (!/^1[3|4|5|7|8][0-9]{9}$/.test($('#contact_way').val())) {
        alert('请填写正确的手机号');
        return false;
    };
    ajaxRes();
    // alert(111);
    var result = JSON.parse(window.localStorage.getItem("xdlggl"));
    if (window.localStorage.getItem("xdlggl") && $('#contact_way').val() == result.contact_way) {
        zj = result.zj;
        initialize();
    } else {
        ajaxRes();
    };
    $('.fixed').hide();
    $('.shadow').hide();
    return false;
});

function ajaxRes() {
    var user = {
        username: $('#username').val(),
        contact_way: $('#contact_way').val()
    };
    // alert(111);
    $.ajax({
        url: 'https://www.aaaxia.com/award/begin',
        data: user,
        type: 'post',
        dataType: 'text',
        success: function(data) {
            if (JSON.parse(data).status == '501'){
                alert(JSON.parse(data).msg);
                // window.location.href=window.location.href+"?id="+10000*Math.random();
                location.reload();
            }
            if (JSON.parse(data).status == '502'){
                alert(JSON.parse(data).msg);
                // window.location.href=window.location.href+"?id="+10000*Math.random();
                location.reload();
            }
            zj = JSON.parse(data).zj;
            window.localStorage.setItem("xdlggl", JSON.stringify({ username: $('#username').val(), contact_way: $('#contact_way').val(), zj: zj }));
            initialize();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#prompt').html('啊哦，出错了，刷新试试？');
        }
    });
    return false;
};

function initCanvas() {
    ctx.globalCompositeOperation = "source-over";
    ctx.fillStyle = '#aaaaaa';
    ctx.fillRect(0, 0, c1.clientWidth, c1.clientHeight);
    ctx.fill();
    ctx.font = " " + c1.width / 11 + "px Arial";
    ctx.textAlign = "center";
    ctx.fillStyle = "#999999";
    ctx.fillText("刮开涂层", c1.width / 2, c1.height / 1.5);
    ctx.globalCompositeOperation = 'destination-out';
};

function eventDown(e) {
    e.preventDefault();
    ismousedown = true;
};

function eventUp(e) {
    e.preventDefault();
    var a = ctx.getImageData(0, 0, c1.width, c1.height);
    var j = 0;
    for (var i = 3; i < a.data.length; i += 4) {
        if (a.data[i] == 0) j++;
    };
    if (j >= a.data.length / 100) {
        isOk = 1;
    };
    ismousedown = false;
};

function eventMove(e) {
    var a = ctx.getImageData(0, 0, c1.width, c1.height);
    var j = 0;
    for (var i = 3; i < a.data.length; i += 4) {
        if (a.data[i] == 0) j++;
    };
    if (j >= a.data.length / 50) {
        isOk = 1;
    };
    e.preventDefault();
    if (ismousedown) {
        if (e.changedTouches) {
            e = e.changedTouches[e.changedTouches.length - 1];
        };
        var topY = document.getElementById("top").offsetTop;
        var oX = c1.offsetLeft,
            oY = c1.offsetTop + topY;
        var x = (e.clientX + document.body.scrollLeft || e.pageX) - oX - fontem * 4 || 0,
            y = (e.clientY + document.body.scrollTop || e.pageY) - oY || 0;
        ctx.beginPath();
        ctx.arc(x, y, fontem * 1.2, 0, Math.PI * 2, true);
        c1.style.display = 'none';
        c1.offsetHeight;
        c1.style.display = 'inherit';
        ctx.fill();
        if (isOk && zj != undefined) {
            $('.ggl_box1_lj').css('opacity', 1);
            if ($('#prompt a')) {
                $('#prompt a').css({
                    'position': 'relative',
                    'z-index': '999'
                });
            };
        };
    };
};
window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function() {
    if (window.orientation === 180 || window.orientation === 0) {
        $('.fixed').css('transform', 'scale(1)');
    }
    if (window.orientation === 90 || window.orientation === -90) {
        $('.fixed').css({
            transform: 'scale(0.3)'
        });
    }
}, false);


function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}