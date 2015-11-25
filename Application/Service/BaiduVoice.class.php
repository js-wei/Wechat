<?php
namespace Service;

class BaiduVoice{
	/**
	 * [$rest 语音rest]
	 * @var string
	 */
	private $rest='http://vop.baidu.com/server_api';
	/**
	 * [$auth 授权地址]
	 * @var string
	 */
	private $auth='https://openapi.baidu.com/oauth/2.0/token';
	/**
	 * [$type description]
	 * @var string
	 */
	private $type='pcm';

	function __construct(){
		$this->appId=C('BaiduVoice.appId');
		$this->apiKey=C('BaiduVoice.apiKey');
		$this->secretKey=C('BaiduVoice.secretKey');
	}
	/**
	 * [auth_url 获取access_token]
	 * @return [type] [description]
	 */
	private  function access_token(){
	
		$param = array(
			'grant_type'=>'client_credentials',
			'client_id'=>$this->apiKey,
			'client_secret'=>$this->secretKey,
		);
		$result = json_decode(self::http($this->auth,$param),true);
		return $result['access_token'];
	}
	/**
	 * [convert 转换]
	 * @param  [type] $path [文件地址]
	 * @return [type]       [description]
	 */
	public function convert($path){
		$audio = file_get_contents($path);
		$base_data = base64_encode($audio);
		$array = array(
		        "format" => $this->type,
		        "rate" => 8000,
		        "channel" => 1,
		        "token" => $this->access_token(),
		        "cuid"=> self::guid(),
		        "len" => filesize($path),
		        "speech" => $base_data,
		        );
		$json_array = json_encode($array);
		$content_len = "Content-Length: ".strlen($json_array);
		$header = array ($content_len, 'Content-Type: application/json; charset=utf-8');
		$result = self::get($this->rest,$json_array,$header);
		if($result['err_no']!=0){
			return $result['err_msg'];
			exit;
		}
		return $result['result'];
	}
	/**
	 * [guid 获取guid]
	 * @return [type] [description]
	 */
	private static function guid(){
		$charid = strtoupper(md5(uniqid(mt_rand(), true)));
	    $hyphen = chr(45);
	    $uuid = //chr(123).
	    substr($charid, 0, 8).$hyphen
	    .substr($charid, 8, 4).$hyphen
	    .substr($charid,12, 4).$hyphen
	    .substr($charid,16, 4).$hyphen
	    .substr($charid,20,12);
	    //.chr(125);
	    return $uuid;
	}

	/**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param  string $url    请求URL
     * @param  array  $param  GET参数数组
     * @param  array  $data   POST的数据，GET请求时该参数无效
     * @param  string $method 请求方法GET/POST
     * @return array          响应数据
     */
    protected static function http($url, $param, $data = '', $method = 'GET'){
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        /* 根据请求类型设置特定参数 */

        $opts[CURLOPT_URL] = $url . '?' . http_build_query($param);

        if(strtoupper($method) == 'POST'){
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $data;
            
            if(is_string($data)){ //发送JSON数据
                $opts[CURLOPT_HTTPHEADER] = array(
                    'Content-Type: application/json; charset=utf-8',  
                    'Content-Length: ' . strlen($data),
                );
            }
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        //发生错误，抛出异常
        if($error) throw new \Exception('请求发生错误：' . $error);

        return  $data;
    }
    /**
     * [get 请求数据]
     * @param  [type] $url        [description]
     * @param  [type] $json_array [description]
     * @param  [type] $header     [description]
     * @return [type]             [description]
     */
    public static function get($url,$json_array,$header){
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json_array);
		$response = curl_exec($ch);
		if(curl_errno($ch)){
		    print curl_error($ch);
		}
		curl_close($ch);
		$response = json_decode($response, true);
		return $response;
    }
}