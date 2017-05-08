<?php
return array(
	//'配置项'=>'配置值'

    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    //'DB_DSN'    => '',
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'wx', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'wx_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
    'URL_MODEL ' => 1,
    'MODULE_ALLOW_LIST' => array('Home', 'Admin'),

    'WX_OPTIONS' => [
        'token'=>'zrt', //填写你设定的key
        'appid'=>'wx71a7612c1a56b9ac', //填写高级调用功能的app id
        'appsecret'=>'529102b77614ab7e85a059a64245c863', //填写高级调用功能的密钥
        'partnerid'=>'88888888', //财付通商户身份标识
        'partnerkey'=>'', //财付通商户权限密钥Key
        'paysignkey'=>'' //商户签名密钥Key
    ]
);