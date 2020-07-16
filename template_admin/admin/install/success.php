<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo get('sitename'); ?>	-	{if $pass}{lang_admin('fill_in_database_information')}{else}{lang_admin('detecting_database_links')}{/if}</title>
    <link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
    <!-- 调用样式表 -->
    <link href="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$base_url}/common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <script src="{$base_url}/common/js/jquery/jquery.min.js"></script>

    <style type="text/css">

        body {
            font-size:14px;
            line-height:180%;
            background:#EEEEEE;
        }
        a:link {
            text-decoration:none;
        }
        a:visited {
            text-decoration:none;
        }
        a:hover {
            text-decoration:none;
        }
        a:active {
            text-decoration:none;
        }
        * {
            outline: none;
        }
        :focus {
            outline:none;
        }
        .btn:focus,
        .btn:active:focus,
        .btn.active:focus,
        .btn.focus,
        .btn:active.focus,
        .btn.active.focus {
            outline: none;
            border-color: transparent;
            box-shadow:none;
        }

        .install {
            position: absolute;
            left:0; right:0;
            z-index:999;
            width:588px;
            margin: 15px auto;
            max-width: 100%;
        }
        @media (max-width: 768px) {
            .install {
                width:100%;
            }
        }
        .version {float:right; font-size:8px;color:#888;padding-bottom: 10px;}
        .install-box {
            background-color: white;
            border: 1px solid #e5e5e5;
            border-radius: 2px;
            clear: both;
            background-color: #fff;
            box-shadow: 0 .126rem .26rem rgba(0,0,0,.066)!important;box-sizing: border-box;
            padding: 0px 25px 25px 25px;
        }
        .logo {
            text-align: center;
            margin: 50px 0px 5px 0px;
            padding-bottom:25px;
            border-bottom:1px solid #eee;
        }
        .logo img {width:188px;}
        .form-group label {position: relative;}
        .tips {
            color: #ccc;
            cursor:help
        }
        .tooltip {
            width:188px;
            text-align:left;
        }
        .install-content h3 {margin:15px 0px;padding:15px 0px;border-bottom:1px solid #eee;font-size: 150%;
            line-height: 150%;font-weight:500;}
        .form-control {border-radius: 2px;}
        .blank5, .blank10, .blank20,.blank30 { clear: both; height: 5px; }
        .blank10 { height: 10px; }
        .blank20 { height: 20px; }
        .blank30 { height: 30px; }
        .padding10 { padding: 10px; }
        .readpact {margin:15px;padding:15px 0px;border-top:1px solid #eee;}
        .readpact label a {color: #666; font-weight:normal; font-size:0.8rem;}
        .install-content .btn {background:#fff;border:1px solid #ccc;height: 3.385rem;
            padding: 0 1.538rem;border-radius: 2px;}
			.install-content .btn:hover,.install-content .btn:visited,.install-content .btn:active {color: #fff;
            background-color: #009cff;}
        .install-content .btn-install {color: #fff;
            background-color: #009cff;
            border-color: #009cff;font-size: 1.385rem;
            height: 3.385rem;
            padding: 0 1.538rem;border-radius: 2px;}
        .install-content .btn-install:hover {opacity: 0.8;}

        .copy {font-size:0.8rem;color:#ccc;padding:10px 0px;}
        #view { height:180px;min-height:180px; overflow:hidden; padding: 10px;background: #fff;border: 1px solid #CCC;line-height: 200%; font-size:12px; color:#ccc; }
        .copy a {color:#ccc;}
    </style>
</head>
<body>


<div class="install">
    <small class="version">V.<?php echo _VERCODE;?></small>
    <div class="install-box">
        <div class="logo">
            <a href="https://www.cmseasy.cn/" target="_blank"><img src="./images/logo.png"></a>
        </div>
        <div class="install-content">
            <h3 class="text-center">{lang_admin('congratulations_cmseasy_has_been_successfully_installed')}</h3>

<div class="blank20"></div>
<div class="text-center">
    <input onclick="javascrtpt:window.location.href='{$base_url}/'" class="btn" style="margin-right:20px;" value=" {lang_admin('visit_the_home_page_of_the_website')} " />
    <input onclick="javascrtpt:window.location.href='{$base_url}/index.php?case=admin&act=login&admin_dir={get('admin_dir')}&site=default'" class="btn btn-install" value=" {lang_admin('background_of_landing_website')} " />
</div>

            <div class="blank30"></div>
        </div>
        </form>
    </div>
    <div class="copy pull-right">{getCopyRight()}</div>
</div>

</div>

<canvas id="Mycanvas"></canvas>

<script language="javascript" type="text/javascript">
    function changebutton(){
        document.getElementById('installbutton').value="{lang_admin('installation_is_in_progress')}";
    }
</script>

<script type="text/javascript">
    <!--
    //信息{lang_admin('tips')}框
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    //-->
</script>


<script type="text/javascript">
    <!--
    //定义画布宽高和生成点的个数
    var WIDTH = window.innerWidth, HEIGHT = window.innerHeight, POINT = 35;

    var canvas = document.getElementById('Mycanvas');
    canvas.width = WIDTH,
        canvas.height = HEIGHT;
    var context = canvas.getContext('2d');
    context.strokeStyle = 'rgba(0,0,0,0.02)',
        context.strokeWidth = 1,
        context.fillStyle = 'rgba(0,0,0,0.05)';
    var circleArr = [];

    //线条：开始xy坐标，结束xy坐标，线条透明度
    function Line (x, y, _x, _y, o) {
        this.beginX = x,
            this.beginY = y,
            this.closeX = _x,
            this.closeY = _y,
            this.o = o;
    }
    //点：圆心xy坐标，半径，每帧移动xy的距离
    function Circle (x, y, r, moveX, moveY) {
        this.x = x,
            this.y = y,
            this.r = r,
            this.moveX = moveX,
            this.moveY = moveY;
    }
    //生成max和min之间的随机数
    function num (max, _min) {
        var min = arguments[1] || 0;
        return Math.floor(Math.random()*(max-min+1)+min);
    }
    // 绘制原点
    function drawCricle (cxt, x, y, r, moveX, moveY) {
        var circle = new Circle(x, y, r, moveX, moveY)
        cxt.beginPath()
        cxt.arc(circle.x, circle.y, circle.r, 0, 2*Math.PI)
        cxt.closePath()
        cxt.fill();
        return circle;
    }
    //绘制线条
    function drawLine (cxt, x, y, _x, _y, o) {
        var line = new Line(x, y, _x, _y, o)
        cxt.beginPath()
        cxt.strokeStyle = 'rgba(0,0,0,'+ o +')'
        cxt.moveTo(line.beginX, line.beginY)
        cxt.lineTo(line.closeX, line.closeY)
        cxt.closePath()
        cxt.stroke();

    }
    //初始化生成原点
    function init () {
        circleArr = [];
        for (var i = 0; i < POINT; i++) {
            circleArr.push(drawCricle(context, num(WIDTH), num(HEIGHT), num(15, 2), num(10, -10)/40, num(10, -10)/40));
        }
        draw();
    }

    //每帧绘制
    function draw () {
        context.clearRect(0,0,canvas.width, canvas.height);
        for (var i = 0; i < POINT; i++) {
            drawCricle(context, circleArr[i].x, circleArr[i].y, circleArr[i].r);
        }
        for (var i = 0; i < POINT; i++) {
            for (var j = 0; j < POINT; j++) {
                if (i + j < POINT) {
                    var A = Math.abs(circleArr[i+j].x - circleArr[i].x),
                        B = Math.abs(circleArr[i+j].y - circleArr[i].y);
                    var lineLength = Math.sqrt(A*A + B*B);
                    var C = 1/lineLength*7-0.009;
                    var lineOpacity = C > 0.03 ? 0.03 : C;
                    if (lineOpacity > 0) {
                        drawLine(context, circleArr[i].x, circleArr[i].y, circleArr[i+j].x, circleArr[i+j].y, lineOpacity);
                    }
                }
            }
        }
    }

    //调用执行
    window.onload = function () {
        init();
        setInterval(function () {
            for (var i = 0; i < POINT; i++) {
                var cir = circleArr[i];
                cir.x += cir.moveX;
                cir.y += cir.moveY;
                if (cir.x > WIDTH) cir.x = 0;
                else if (cir.x < 0) cir.x = WIDTH;
                if (cir.y > HEIGHT) cir.y = 0;
                else if (cir.y < 0) cir.y = HEIGHT;

            }
            draw();
        }, 16);
    }
    //-->
</script>

</body>
</html>