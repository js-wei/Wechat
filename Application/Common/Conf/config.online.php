<?php
	$extends=require_once('extends.conf.php');
	$conf = array(
		//'配置项'=>'配置值'
		'APP_GROUP_LIST'=>'Home,Admin,Market,Oauth,Manage,Gamemanage',
		'DEFAULT_GROUP'=>'Home',
		'APP_GROUP_MODE'=>1,
		'APP_GOOUP_PATH'=>'Modules',
		//'SHOW_PAGE_TRACE'=>true,
		'URL_MODEL'=>2,
		'TAGLIB_LOAD'               => true,//加载标签库打开
		'TAGLIB_BUILD_IN'           =>'Cx,Lists',
		//'blog'=>'@.TagLib.TagLibBlog',  //@.TagLib.TagLibBlog  表示的TagLibBlog的标签位置 
										//"@"表示在当前的项目下整个的意思是在当前项目下的TagLib文件夹下的TagLibBlog的文件夹
		'URL_CASE_INSENSITIVE'=>true,
		 
		//数据库配置信息
	    'DB_TYPE'   => 'mysql', // 数据库类型
	    'DB_HOST'   => 'localhost', // 服务器地址
	    'DB_NAME'   => '91game', // 数据库名
	    'DB_USER'   => 'root', // 用户名
	    'DB_PWD'    => 'sipsct20141201', // 密码
	    'DB_PORT'   => 13307, // 端口
	    'DB_PREFIX' => 'think_', // 数据库表前缀


	    //系统相关设置
	    'GIVE_GOLD'=>1000,	//赠送的金币

	    //邮件配置 
	    'THINK_EMAIL' => array(     
		    'SMTP_HOST'   => 'smtp.163.com', //SMTP服务器     
		    'SMTP_PORT'   => '', //SMTP服务器端口     
		    'SMTP_USER'   => 'xxxxx@hotmail.com', //SMTP服务器用户名     
		    'SMTP_PASS'   => 'xxxxx', //SMTP服务器密码     
		    'FROM_EMAIL'  => 'xxxxx@hotmail.com', //发件人EMAIL     
		    'FROM_NAME'   => '游戏官网，密码找回', //发件人名称     
		    'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）     
		    'REPLY_NAME'  => '', //回复名称（留空则为发件人名称） 
	    ),
	    'TOKEN_ON'=>true,  // 是否开启令牌验证
		'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
		'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
		'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true

	    'AUTH_KEY'=>'honghaiqing@hotmail.com',
	    'AUTH_TIMEOUT'=>'120000',
	 
   		//数据库配置2
 		'DB_CONFIG2' => 'mysql://root:sipsct20141201@localhost:13307/game',
 		//数据库配置3
 		'DB_CONFIG3' => 'mysql://sipsct:ghai007@192.168.1.3:3306/91uc_member',

 		//自动加载函数文件
 		'LOAD_EXT_FILE'=>'',
 		//自动加载自定义类文件
 		'APP_AUTOLOAD_PATH'=>'@.Tool',

 		//开启路由
		'URL_ROUTER_ON'   => true, //开启路由

		'URL_ROUTE_RULES' => array( //定义路由规则
			'/^index$/'								=> 'Index/index',
		    '/^shop$/'       						=> 'Shop/index',
		    '/^game$/'       						=> 'Game/index',
		    '/^service$/'       					=> 'Service/index',
		    '/^news$/'       						=> 'NewsCenter/index',
		    '/^uer\/userinfo$/'       				=> 'User/userinfo',
		    '/^payfor$/'       						=> 'Orderpay/index',

		    //商城路由
		    '/^shop\/shoplist\/(\d+)\/(\d+)$/'  	=> 'Shop/shopList?cid=:1&p=:2',
		    '/^shop\/shoplist\/(\d+)$/'  			=> 'Shop/shopList?cid=:1',
		    '/^shop\/details\/(\d+)$/'  			=> 'Shop/shopView?id=:1',
			'/^shop\/payfor\/(\d+)$/'  				=> 'Shop/order?id=:1',

		    //新闻详细
			'/^news\/details-(\d+)$/'  			=> 'NewsCenter/news?id=:1',
			//服务详情
			'/^service\/details-(\d+)$/'  			=> 'Service/details?id=:1',
			//游戏详情
			'/^game\/details-(\d+)-(\d+)$/'  				=> 'Game/gameView?id=:1&gid=:2',
			//活动详情
			'/^active\/(\d+)$/'        =>'Active/index?id=:1',
			
		),
		'HTML_CACHE_ON' => true,//开启静态缓存  
		'HTML_PATH' => '/html',//静态缓存文件目录，HTML_PATH可任意设置，此处设为当前项目下新建的html
		'HTML_FILE_SUFFIX '=>'.html',
		'HTML_CACHE_RULES'=> array(
		    /*'ActionName'            => array('静态规则', '静态缓存有效期', '附加规则'), 
		    'ModuleName(小写)'            => array('静态规则', '静态缓存有效期', '附加规则'), 
		    'ModuleName(小写):ActionName' => array('静态规则', '静态缓存有效期', '附加规则'),
		    '*'                     => array('静态规则', '静态缓存有效期', '附加规则'),*/
		    'news' => array('{:action}_{id}', -1),	//-1表示永久缓存 
		 ),

	);
	$conf=array_merge($conf,$extends);
	return $conf;
?>
