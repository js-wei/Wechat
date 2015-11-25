<?php
return array(
	'Smap'=>array(		//搜搜地图接口
		 'key'=>'PSSBZ-SXB3R-V5OWA-WS75I-KEXO3-QPFRX',
		 'page_size'=>'10',
		 'orderby'=>'_distance',
		 'output'=>'json'
		),
	'Bmap'=>array(		//百度地图接口
		 'ak'=>'tOVGEEQswsdKWlWVjPZci6W7',
		 'output'=>'json',
		 'coord_type'=>'gcj02',
		 'number'=>10,
		 'page_size'=>10,
		 'sort_rule'=>0
		),
	'Express'=>array(	//爱查快键接口
		'id'=>'106703',
		'secret'=>'687ef6e8a5b24d28bc47be38ad2e6b10',
		'type'=>'json',
		'encode'=>'utf-8',
		'lang'=>'zh-cn',
		'ord'=>'desc'
		),
	'Open186'=>array(	//天翼接口
		"AppId"=>"212987530000247715",////在电信能力开放平台申请开发者账号之后自动获得
	    "AppSecret"=>"d020d947c1b7c20b73d95d5a57783e12",//在电信能力开放平台申请开发者账号之后自动获得
	    "authorizeAPI" =>"https://oauth.api.189.cn/emp/oauth2/v3/authorize",
	    "tokenAPI" =>"https://oauth.api.189.cn/emp/oauth2/v3/access_token",
	    'sms_exp_time'=>1,
	    'redirectUrl'=>'http://www.91uc.cn/Tianyi/callback',
	    'logoutRedirect'=>'http://www.91uc.cn/Tianyi/logout_redirect',
	),
	'ALIPAY'=>array(
		'ALIPAY_PARTNER'=>'2088911712911822',
		'ALIPAY_ACCOUNT'=>'honghaiqing@hotmail',
		'ALIPAY_KEY'=>'cz322gt5ht9iesc9l24ksfjup0myjg6n',
	),

	'lookout'=>array(
		'ak'=>'xooZZG25yNjbmCFGytrRyor0',
		'output'=>'json',
		'page_size'=>10,
		'page_size'=>1,
	),

	'BaseSite'=>array(
		'url'=>'http://localhost/web3.2.3',
		'local'=>'http://localhost',
		'touxiang_path'=>'http://www.91uc.cn/Public/images/touxiang/',
		'game_sever'=>array(		
			'url'=>'192.168.1.6',
			'point1'=>'8089',	//pay服务器
			'point2'=>'8088'	//GM服务器
			),
		),
	'Market'=>array(
		'baseurl'=>'http://61.155.169.108:82/market_buy.cgi?',			//61.155.169.108:82
		'IS_DEBUG'=>0,
		),
	//保存位置
	'SAVE_PATH'=>array(
		'XML'=>'./Data/temp',
		'HTML'=>'./Data/temp',
		'Alipay'=>'./Data/Alipay'
		),
	//游戏XML保存位置
	'GAME_XML_PATH'=>'./Data/xml',
	//支付宝配置参数
	'alipay_pay'=>array(
	    'partner' =>'2088911712911822',   //这里是你在成功申请支付宝接口后获取到的PID；
	    'key'=>'cz322gt5ht9iesc9l24ksfjup0myjg6n',//这里是你在成功申请支付宝接口后获取到的Key
	    'sign_type'=>strtoupper('MD5'),
	    'input_charset'=> strtolower('utf-8'),
	    'cacert'=> getcwd().'\\cacert.pem',
	    'transport'=> 'http',
	    'debug'=>1
	),
	//以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；  
	'alipay_redirect'   =>array(
		 //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
		 'seller_email'=>'honghaiqing@hotmail.com',
		 //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
		 'notify_url'=>'http://www.91uc.cn/Pay/notifyurl', 
		 //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
		 'return_url'=>'http://www.91uc.cn/Pay/returnurl',
		 //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
		 'successpage'=>'orderpay/douziinhistory',   
		 //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
		 'errorpage'=>'orderpay/douziinhistory', 
	 ),
	 'Wechat'=>array(
        // APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
        'APPID'=>'wxdabc6a0bfc9bb4ac',
        // MCHID：商户号（必须配置，开户邮件中可查看）
        'MCHID'=>'1267420801',
        //KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
        //设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
        'KEY'=>'8f857f0e106c7de7adfba87f5724ea21',
        //APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）
        //获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
        'APPSECRET'=>'069af262ae81527cff5d443f85bbdb65',
        //证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
        // API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
        'SSLCERT_PATH'=>'',
        'SSLKEY_PATH'=>'',
        //程通过curl使用HTTP POST方法，此处可修改代理服务器，
        //默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
        'CURL_PROXY_HOST'=>'0.0.0.0',
        'CURL_PROXY_PORT'=>0,
        //(不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量
        //上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
        'REPORT_LEVENL'=>1,
        'DEBUG'=>0,
        //回调地址
        'Notify_url'=>'http://localhost/web/Pay/wxnotify'
    ),
	'BaiduOpenid'=>array(
		'clientId' => 'YTmMyZIjGs7grIT9gd9pCMoy',
		'clientSecret' => '427efda6f5027ec00d14871b0a431f80',
		'redirectUri' => 'http://www.91uc.cn/Baidu/callback',
		'cancelRedirectUri' => 'http://www.91uc.cn/Baidu/cancel_callback',
		),
	'Renren'=>array(
		'apiKey' => '843551305de74f2494324701c3690a2f',
		'AppSecret'=>'fb6ea166d98e401b9872882a4c9f33ad',
		'redirectUrl' => 'http://www.91uc.cn/Renren/callback',
		),
	'Tencent'=>array(
		'apiId' => '101265826',
		'AppSecret'=>'9823a678a740c7704f8e5ee48a932092',
		'redirectUrl' => 'http://www.91uc.cn/Tencent/callback',
		'Scope'       => 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol',
		),
	'Weibo'=>array(
		'WB_AKEY'=>'4117562912',
		'WB_SKEY'=>'20194762c319ea768698883976625206',
		'WB_CALLBACK_URL'=>'http://www.91uc.cn/Weibo/callback',
		'WB_CANCEL_CALLBACK_URL'=>'http://www.91uc.cn/Weibo/cancelCallBack',
		),
);