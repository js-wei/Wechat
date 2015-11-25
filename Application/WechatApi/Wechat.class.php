<?php
namespace WechatApi;
use WechatApi\WechatType;

/**
* 微信类
*/
class Wechat{

	private  $token;
	private  $appId;
	private  $encodingAESKey;
    private  $object=null;
    private  $data=null;
    /**
     * 微信api根路径
     * @var string
     */
    private $apiURL = 'https://api.weixin.qq.com/cgi-bin';

    /**
     * 微信二维码根路径
     * @var string
     */
    private $qrcodeURL = 'https://mp.weixin.qq.com/cgi-bin';

    private $requestCodeURL = 'https://open.weixin.qq.com/connect/oauth2/authorize';

    private $oauthApiURL = 'https://api.weixin.qq.com/sns';

	function __construct(){
		$this->token = C('WechatApi.token');
		$this->appId = C('WechatApi.appId');
        $this->encodingAESKey = C('WechatApi.crypt'); 
        $this->check_parameters();      //检测参数
        $this->valid();                 //微信验证
	}
	/**
	 * [valid 微信验证]
	 * @return [type] [description]
	 */
	public function valid() {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            header('content-type:text');
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr,'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            $this->object = $postObj;

            $result = "";
            switch ($RX_TYPE){
                case WechatType::$MSG_EVENT_SUBSCRIBE:              //关注欢迎信息
                    $result = $this->receiveEvent();
                    break;
                case WechatType::$MSG_TYPE_TEXT:                    //文本信息
                    $result = $this->receiveText();
                    break;
            }
            echo $result;
        }else{
            echo "";
            exit;
        }
    }

    /**
     * [getAccessToken 获取access_token]
     * @param  string $type [description]
     * @param  [type] $code [description]
     * @return [type]       [access_token信息，包含 token 和有效期]
     */
    public function getAccessToken($type = 'client', $code = null){
        $param = array(
            'appid'  => $this->appId,
            'secret' => $this->appSecret
        );

        switch ($type) {
            case 'client':
                $param['grant_type'] = 'client_credential';
                $url = "{$this->apiURL}/token";
                break;

            case 'code':
                $param['code'] = $code;
                $param['grant_type'] = 'authorization_code';
                $url = "{$this->oauthApiURL}/oauth2/access_token";
                break;
            
            default:
                throw new \Exception('不支持的grant_type类型！');
                break;
        }

        $token = self::http($url, $param);
        $token = json_decode($token, true);

        if(is_array($token)){
            if(isset($token['errcode'])){
                throw new \Exception($token['errmsg']);
            } else {
                $this->accessToken = $token['access_token'];
                return $token;
            }
        } else {
            throw new \Exception('获取微信access_token失败！');
        }
    }

    /**
     * [request 获取微信返回信息]
     * @return [type] [description]
     */
    public function request(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr,'SimpleXMLElement', LIBXML_NOCDATA);
            $this->object =$postObj;
            $this->data =  self::xml2data($postObj);
            return $postObj;
        }else{
            throw new \Exception("Error Processing Request", 1);
            exit;
        }
    }

    /**
     * [Voice2Text 获取语音文本信息]
     */
    public function getVoiceText($show=0){
        if($this->object->MsgType==WechatType::$MSG_TYPE_VIDEO){
            if($show)
                return $this->transmitText($this->data['Recognition']);
            else
                return $this->data['Recognition'];
        }
    }

    /**
     * [Subscribe 关注]
     */
    public function Subscribe($Weixin='遗忘无钱'){
        $code = $this->object->Event;
        if($code == WechatType::$MSG_EVENT_SUBSCRIBE){
            $content = '欢迎关注'.$str;
        }
        $result = $this->transmitText($content);
        echo $result;
    }

    /**
     * [UnSubscribe 取消关注]
     */
    public function UnSubscribe($Weixin='遗忘无钱'){
        $code = $this->object->Event;
        if($code == WechatType::$MSG_EVENT_UNSUBSCRIBE){
            $content = '您已经取消关注'.$str;
        }
        $result = $this->transmitText($content);
        echo $result;
    }

    public function text($content){
        $result = $this->transmitText($content);
        return $result;
    }

    private function receiveEvent(){
        $code = $this->object->Event;
        if($code == WechatType::$MSG_EVENT_SUBSCRIBE){
            $content = '您已经取消关注'.$str;
        }
        $result = $this->transmitText($content);
        echo $result;
    }

    private function receiveText() {
        $object= $this->object;

        $keyword = trim($object->Content);
        $url = "http://apix.sinaapp.com/weather/?appkey=".$object->ToUserName."&city=".urlencode($keyword); 
        $output = file_get_contents($url);
        $content = json_decode($output, true);

        $result = $this->transmitNews($object, $content);
        return $result;
    }

    /**
     * XML数据解码
     * @param  string $xml 原始XML字符串
     * @return array       解码后的数组
     */
    protected static function xml2data($xml){
        $xml = new \SimpleXMLElement($xml);
        
        if(!$xml){
            throw new \Exception('非法XXML');
        }

        $data = array();
        foreach ($xml as $key => $value) {
            $data[$key] = strval($value);
        }

        return $data;
    }

    private function transmitText($content) {
        if (!isset($content) || empty($content)){
            return "";
        }
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $this->object->FromUserName, $this->object->ToUserName,time(),$content);
        return $result;
    }

    private function transmitNews($newsArray){
        if(!is_array($newsArray)){
            return "";
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($newsTpl, $this->object->FromUserName, $this->object->ToUserName, time(), count($newsArray));
        return $result;
    }

    /**
     * 微信验证
     * @return [type] [description]
     */
    private function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        
        $tmpArr = array($this->token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if($tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 检测是参数
     */
    private function check_parameters(){

        if(empty($this->appId)){
            throw new \Exception("AppId is not Empty", 1);  
        }
        if(empty($this->token)){
            throw new \Exception("Token is not Empty", 1);  
        }
    }
    /**
     * 调用微信api获取响应数据
     * @param  string $name   API名称
     * @param  string $data   POST请求数据
     * @param  string $method 请求方式
     * @param  string $param  GET请求参数
     * @return array          api返回结果
     */
    protected function api($name, $data = '', $method = 'POST', $param = '', $json = true){
        $params = array('access_token' => $this->accessToken);

        if(!empty($param) && is_array($param)){
            $params = array_merge($params, $param);
        }

        $url  = "{$this->apiURL}/{$name}";
        if($json && !empty($data)){
            //保护中文，微信api不支持中文转义的json结构
            array_walk_recursive($data, function(&$value){
                $value = urlencode($value);
            });
            $data = urldecode(json_encode($data));
        }

        $data = self::http($url, $params, $data, $method);

        return json_decode($data, true);
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
}