<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <title>后台管理系统</title>
    <meta name="keywords" content="后台管理系统">
    <meta name="description" content="后台管理系统">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="/speechx_wx/Public/favicon/favicon.ico">
    <link rel="stylesheet" href="/speechx_wx/Public/access/css/bootstrap.min.3.3.6.css">
    <link rel="stylesheet" href="/speechx_wx/Public/access/css/font-awesome.min.4.4.0.css" >
    <link rel="stylesheet" href="/speechx_wx/Public/access/css/animate.min.css" >
    <link rel="stylesheet" href="/speechx_wx/Public/access/css/style.css" >
    <style type="text/css">
        .header-img {
            width: 70px;
            height: 70px;
        }
        ::-webkit-scrollbar-thumb{
            display: none;
        }
    </style>
</head>
<body class="fixed-sidebar full-height-layout gray-bg  mini-navbar pace-done" style="overflow:hidden">

<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>

<div id="wrapper">

    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation" ><!--style="display: block; "-->
        <div class="nav-close">
            <i class="fa fa-times-circle"></i>
        </div>
        <div class="slimScrollDiv" style="position: relative; width: auto; height: 100%; "><!--overflow: scroll;overflow-x:hidden-->
            <div class="sidebar-collapse" style="width: auto; height: 100%;">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle header-img" src="/speechx_wx/Public/img/header/<?php echo ($header_img); ?>"></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo ($name); ?></strong></span>
                                <span class="text-muted text-xs block"><?php echo ($group_name); ?><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="../AdminUser/update_password.html" data-index="0">修改密码</a>
                                </li>
                                <li><a class="J_menuItem" href="../AdminUser/mine.html" data-index="1">个人资料</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="../auth/loginout">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">HellO
                        </div>
                    </li>

                    <?php if(is_array($lst_menu)): $i = 0; $__LIST__ = $lst_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                            <a href='#' data-url='<?php echo ((isset($menu["url"]) && ($menu["url"] !== ""))?($menu["url"]):""); ?>' data-name="<?php echo ($menu["name"]); ?>" class="parent-url">
                                <i class="fa fa fa-bar-chart-o"><?php echo ((isset($menu["icon"]) && ($menu["icon"] !== ""))?($menu["icon"]):""); ?></i>
                                <span class="nav-label"><?php echo ($menu["name"]); ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <?php if(!empty($menu["lst_child_menu"])): ?><ul class="nav nav-second-level collapse">
                                    <?php if(is_array($menu['lst_child_menu'])): $i = 0; $__LIST__ = $menu['lst_child_menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child_menu): $mod = ($i % 2 );++$i;?><li>
                                            <a class="J_menuItem" href="<?php echo ($child_menu["url"]); ?>" data-index="9"><?php echo ($child_menu["name"]); ?></a>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul><?php endif; ?>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>

                </ul>
            </div>
            <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius:3px; z-index: 99; right: 1px;"></div>
            <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.9; z-index: 90; right: 1px;">
            </div>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="#" class="active J_menuTab" data-id=".html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="../auth/loginout" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src='home' frameborder="0" data-id=".html" seamless=""></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">© 2016-2017 <a href="http://www.speechx.cn/" target="_blank">深圳市声希科技有限公司</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->

</div>

<script type="text/javascript" src="/speechx_wx/Public/access/js/jq.min.2.1.4.js?v=2.1.4" ></script>
<script type="text/javascript" src="/speechx_wx/Public/access/js/bootstrap.min.js?v=3.3.6"></script>
<script type="text/javascript" src="/speechx_wx/Public/access/js/plugins/metisMenu/jquery.metisMenu.js" ></script>
<script type="text/javascript" src="/speechx_wx/Public/access/js/plugins/slimscroll/jquery.slimscroll.min.js" ></script>
<script type="text/javascript" src="/speechx_wx/Public/access/js/plugins/layer/layer.min.js" ></script>
<script type="text/javascript" src="/speechx_wx/Public/access/js/plus.min.js"></script>
<script type="text/javascript" src="/speechx_wx/Public/access/js/contabs.min.js"></script>
<script type="text/javascript" src="/speechx_wx/Public/access/js/plugins/pace/pace.min.js"></script>
<script type="text/javascript">

    $('.parent-url').click(function(){
        var url = $(this).attr('data-url');
        if (url != '' && url != 'undefined') {

            //$('.J_iframe').attr('src', url);
            $('.J_menuTab').removeClass('active');
            var _menu_name = $(this).attr('data-name');
            var _str_html = $('.page-tabs-content').html();

            var _div_tabs_content = $('.page-tabs-content').children();

            var _is_exist = false;
            _div_tabs_content.each(function (index, option) {
                if ($(option).attr('data-id') == url) {
                    _is_exist = true;
                }
            });

            if (!_is_exist) { //如果不存在就写进去
                _str_html += '<a href="#" class="J_menuTab active" data-id="' + url + '"> ' + _menu_name + ' <i class="fa fa-times-circle"></i></a>';
                $('.page-tabs-content').html(_str_html);

                var n='<iframe class="J_iframe" name="iframe9" width="100%" height="100%" src="'+url+'" frameborder="0" data-id="'+url+'" seamless></iframe>';
                $(".J_mainContent").find("iframe.J_iframe").hide().parents(".J_mainContent").append(n);
            }
            else { //已存在就改为activie
                _div_tabs_content.each(function (index, option) {
                    if ($(option).attr('data-id') == url) {
                        $(option).addClass('active');
                    }
                });
                var n='<iframe class="J_iframe" name="iframe9" width="100%" height="100%" src="'+url+'" frameborder="0" data-id="'+url+'" seamless></iframe>';
                $(".J_mainContent").find("iframe.J_iframe").hide().parents(".J_mainContent").append(n);
            }

        }
    });


</script>

</body>
</html>