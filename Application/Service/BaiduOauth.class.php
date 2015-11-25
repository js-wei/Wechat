<?php
/**
* baidu登陆
*/
namespace Service;

class BaiduOauth {

	//private $url = 'https://openapi.baidu.com/social/oauth/2.0/token';	//
	//
	private static $_STATIC_URL=array(
		'authorize'=>'https://openapi.baidu.com/oauth/2.0/authorize?',
		'token'=>'https://openapi.baidu.com/social/oauth/2.0/token?',
		'logged'=>'https://openapi.baidu.com/rest/2.0/passport/users/getLoggedInUser',
		'userInfo'=>'https://openapi.baidu.com/rest/2.0/passport/users/getInfo',
		'authorize1'=>'https://openapi.baidu.com/oauth/2.0/authorize?',
		'token1'=>'https://openapi.baidu.com/oauth/2.0/token?'
		);
	public $client_id;			//API Key from developer.baidu.com
	public $client_secret;		//Secret Key from developer.baidu.com
	public $redirect_uri;		//social redirect_uri registered in developer.baidu.com

	public function __construct(){
		$this->client_id = C('BaiduOpenid.clientId');
		$this->client_secret = C('BaiduOpenid.clientSecret');
		$this->redirect_uri = C('BaiduOpenid.redirectUri');
	}
	/**
	 * [getLoginUrl 获取登录链接]
	 * @return [type] [description]
	 */
	public function getLoginUrl(){
		$params = array(
            'grant_type'    =>  'authorization_code',
            'client_id'     =>  $this->client_id,
            'client_secret' =>  $this->client_secret,
            'redirect_uri'  =>  $this->redirect_uri,
            'response_type' =>  'code',
            'display'=>'page'
        );
        ksort($params);
        return self::$_STATIC_URL['authorize'].http_build_query($params);
	}

	public function getLoginUrl1(){
		$params = array(
            'client_id'     =>  $this->client_id,
            'redirect_uri'  =>  $this->redirect_uri,
            'response_type' =>  'token',
            'display'=>'page',
            'force_login'=>1,
        );
        ksort($params);
        $uri = self::$_STATIC_URL['authorize1'].http_build_query($params);
        return $uri;
	}


	public function get_access_token(){
		$params = array(
			'grant_type' =>  'client_credentials',
            'client_id'     =>  $this->client_id,
            'client_secret'  =>  $this->client_secret,
            //'scope'=>'base',		//base 用户基本权限 super_msg 往用户的百度首页上发送消息提醒  netdisk 获取用户在个人云存储中存放的数据  public 可以访问公共的开放API hao123 可以访问Hao123 提供的开放API接口该权限需要申请开通
        );
		ksort($params);
        $uri = self::$_STATIC_URL['token1'].http_build_query($params);
        $_result = $this->request($uri);
		return $_result['access_token'];
	}

	/**
	 * [isUserLogged 判断是否登录]
	 * @return boolean [description]
	 */
	public function isUserLogged(){
		$params = array(
            'access_token'    => $this->access_token(),
        );
        ksort($params);
		$_result = $this->request(self::$_STATIC_URL['logged'],$params,'POST');
		return $_result;
	}
	/**
	 * [getUserInfo 获取用户信息]
	 * @return [type] [description]
	 */
	public function getUserInfo(){
		$params = array(
            'access_token'    => $this->access_token(),
        );
        ksort($params);
		$_result = $this->request(self::$_STATIC_URL['userInfo'],$params,'POST');
	}
	/**
	 * [access_token 获取Token]
	 * @return [type] [description]
	 */
	public function access_token($code=''){
		//Get access token and third user information
	    if(empty($code)) {
            $code = $_GET['code'];
        }
        $params = array(
            'grant_type'    =>  'authorization_code',
            'client_id'     =>  $this->client_id,
            'client_secret' =>  $this->client_secret,
            'redirect_uri'  =>  $this->redirect_uri,
            'code'          =>  $code,
        );
        $ret = $this->request(self::$_STATIC_URL['token'],$params,'POST');
        $result = json_decode($ret,true); 
        return $result;
	}

	/**
     * Request for a http/https resource
     * 
     * @param string $url Url to request
     * @param array $params Parameters for the request
     * @param string $httpMethod Http method, 'GET' or 'POST'
     * @param bool $multi Whether it's a multipart POST request
     * @return string|false Returns string if success, or false if failed
     */
	private  function request($url, $params = array(), $httpMethod = 'GET', $multi = false){
    	// when using bae(baidu app engine) to deploy the application,
    	// just comment the following line
    	$ch = curl_init();
    	$curl_opts = array(
			CURLOPT_CONNECTTIMEOUT	=> 3,
			CURLOPT_TIMEOUT			=> 5,
			CURLOPT_USERAGENT		=> 'baidu-apiclient-php-2.0',
	    	CURLOPT_HTTP_VERSION	=> CURL_HTTP_VERSION_1_1,
	    	CURLOPT_RETURNTRANSFER	=> true,
	    	CURLOPT_HEADER			=> false,
	    	CURLOPT_FOLLOWLOCATION	=> false,
		);

		if (stripos($url, 'https://') === 0) {
			$curl_opts[CURLOPT_SSL_VERIFYPEER] = false;
		}
		
		if (strtoupper($httpMethod) === 'GET') {
			$query = http_build_query($params, '', '&');
			$delimiter = strpos($url, '?') === false ? '?' : '&';
    		$curl_opts[CURLOPT_URL] = $url . $delimiter . $query;
    		$curl_opts[CURLOPT_POST] = false;
		} else {
			$headers = array();
			if ($multi && is_array($params) && !empty($params)) {
				$body = self::buildHttpMultipartBody($params);
				$headers[] = 'Content-Type: multipart/form-data; boundary=' . self::$boundary;
			} else {
				$body = http_build_query($params, '', '&');
			}
			$curl_opts[CURLOPT_URL] = $url;
    		$curl_opts[CURLOPT_POSTFIELDS] = $body;
    		$curl_opts[CURLOPT_HTTPHEADER] = $headers;
		}
    
    	curl_setopt_array($ch, $curl_opts);
        $result = curl_exec($ch);
        //var_dump($result);
        //var_dump('-------------------');
        curl_close($ch);
    	return $result;
    }	
}