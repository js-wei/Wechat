<?php

	$extends=require_once('extends.conf.php');
	$conf = array(
		'DEFAULT_C_LAYER'       =>  'Action', // 默认的控制器层名称
		//允许访问的模块列表
		'MODULE_ALLOW_LIST'    	=>  array('Wechat','Admin'),
		// 设置禁止访问的模块列表
		'MODULE_DENY_LIST'      =>  array('Common','Runtime','Service'),
		//默认模块
		'DEFAULT_MODULE'     	=> 'Wechat',

		//'SHOW_PAGE_TRACE'=>true,
		'URL_MODEL'=>2,
		//'blog'=>'@.TagLib.TagLibBlog',  //@.TagLib.TagLibBlog  表示的TagLibBlog的标签位置 
										//"@"表示在当前的项目下整个的意思是在当前项目下的TagLib文件夹下的TagLibBlog的文件夹
		//是否开启session
	    'SESSION_AUTO_START' 	=> true,
		//不区分大小写
		'URL_CASE_INSENSITIVE'  =>  true,

		'APP_AUTOLOAD_PATH' => '@.TagLib',
    	'TAGLIB_BUILD_IN' => 'Cx,Lists',


		//数据库配置信息
		
		'DB_DEPLOY_TYPE '=>0,	//是否启用分布式
	    'DB_TYPE'   => 'mysql', // 数据库类型
	    'DB_HOST'   => '127.0.0.1', // 服务器地址
	    'DB_NAME'   => '91game', // 数据库名
	    'DB_USER'   => 'root', // 用户名
	    'DB_PWD'    => '', // 密码
	    'DB_PORT'   => 3306, // 端口
	    'DB_PREFIX' => 'think_', // 数据库表前缀


	    'TOKEN_ON'=>true,  // 是否开启令牌验证
		'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
		'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
		'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
	 
 		//自动加载函数文件
 		'LOAD_EXT_FILE'=>'',
 		//自动加载自定义类文件
 		//'APP_AUTOLOAD_PATH'=>'@.Tool',
 		'AUTOLOAD_NAMESPACE' => array(
        	//'Com'     => THINK_PATH.'Library/Com',
        	//'WechatApi'     => APP_PATH.'WechatApi',
    	),


 		'__ROOT__'      =>  __ROOT__,       // 当前网站地址
		'__APP__'       =>  __APP__,        // 当前应用地址
		'__MODULE__'    =>  __MODULE__,
		'__ACTION__'    =>  __ACTION__,     // 当前操作地址
		'__SELF__'      =>  __SELF__,       // 当前页面地址
		'__CONTROLLER__'=>  __CONTROLLER__,
		'__URL__'       =>  __CONTROLLER__,

		'WechatApi'=>array(
			'appId'=>'wx0ee7ee63fb439f01',
			'crypt'=>'t3RIsZFovvQP5F4qfjPXJixM0e1SEryvurEHHOFeETK',
			'token'=>'winxin'
			),
		'BaiduVoice'=>array(
			'appId'=>'7312072',
			'apiKey'=>'7zk7tQsS5hvq9Lspm5AxEwvU',
			'secretKey'=>'6eafa685183bddd79e175c924ceee751',
			),

	);
	$conf=array_merge($conf,$extends);
	return $conf;
?>
