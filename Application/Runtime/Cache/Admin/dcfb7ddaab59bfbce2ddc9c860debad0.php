<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0044)http://www.zi-han.net/theme/hplus/login.html -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>登录</title>
	    <meta name="keywords" content="管理后台登录">
	    <meta name="description" content="管理后台登录">
	    <link rel="shortcut icon" href="/speechx_wx/Public/favicon/favicon.ico">
	    <link href="/speechx_wx/Public/css/bootstrap.min.3.3.6.css" rel="stylesheet">
	    <link href="/speechx_wx/Public/css/font-awesome.min.4.4.0.css" rel="stylesheet">
	    <link href="/speechx_wx/Public/css/animate.min.css" rel="stylesheet">
        <link href="/speechx_wx/Public/css/login.css" rel="stylesheet">
	    <!--[if lt IE 9]>
	    <meta http-equiv="refresh" content="0;ie.html" />
	    <![endif]-->
	    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
	</head>

<body>

    <div id="particles">

    </div>

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <h1 class="logo-name">SpeechX</h1>
        </div>
        <div>
            <h3>欢迎使用 </h3>
            <form class="m-t" role="form" action="login" method="post">
                <div class="form-group">
                    <input type="text" name="account" class="form-control" placeholder="用户名" required="" value="<?php echo ((isset($account) && ($account !== ""))?($account):''); ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>

                <div class="form-group">
                	<input type="text" name="captcha" class="form-control" placeholder="验证码" required="" style="width: 50%;display: inline;"/>
                	<img src="/speechx_wx/Public/css/patterns/header-profile-skin-1.png" id="captcha" style=" padding:1px;width: 50%; height: 34px; float: right;"/>
                </div>

                <div class="form-group">
                    <p><?php echo ((isset($errmsg) && ($errmsg !== ""))?($errmsg):'&nbsp;'); ?></p>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>


                <p class="text-muted text-center">
                	<a ><small>忘记密码了？</small></a> |
                	<a >申请一个新账号</a>
                </p>

            </form>
        </div>
    </div>

    <script src="/speechx_wx/Public/js/jq.min.2.1.4.js"></script>
    <script src="/speechx_wx/Public/js/bootstrap.min.js"></script>
    <script src="/speechx_wx/Public/js/jquery.particleground.min.js"></script>
    <script type="text/javascript" src="/speechx_wx/Public/js/stat.js" charset="UTF-8"></script>

    <script>
        $(document).ready(function() {
            $('#particles').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
        });

        function change_captcha() {
            $('#captcha').attr('src', 'captcha/time/' + (new Date()).valueOf());
        }

        change_captcha();
        $('#captcha').bind('click', change_captcha);

    </script>
</body>
</html>