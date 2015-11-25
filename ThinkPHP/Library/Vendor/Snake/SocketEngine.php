<?php
/**
 * 业务解包专用套接字封装
 *
 * User: snake
 * Date: 14-11-9
 * Time: 下午7:21
 */

class SocketEngine
{
    private $debug;

    /**
     * @var resource 生成的套接字句柄
     */
    private $fp;

    /**
     * @var string 获得返回的数据
     */
    private $receiveData;

    /**
     * @var int 整个包的长度
     */
    private $packageLength;

    /**
     * @var int 头大小
     */
    private $headLength;

    /**
     * @var object 包的内容
     */
    private $packageContent;

    public function __construct($host, $port, $debug = false)
    {
        $this->fp = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
        socket_connect($this->fp, $host, $port) or die(json_encode(array('code'=>0,'mag'=>'Could not connet server')));
        /*
        if(!socket_connect($this->fp, $host, $port)){
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            //die("Couldn't create socket: [$errorcode] $errormsg");
            file_put_contents('./Data/Wechat/socket_error.re',"Couldn't create socket: [$errorcode] $errormsg");
        }
         */

        $this->debug = $debug;
        $this->receiveData = '';
        $this->packageLength = 0;
        $this->headLength = 0;
        $this->packageContent = '';
    }

    public function getAllData()
    {
        while (strlen($this->receiveData) < $this->packageLength) {
            $tempBuffer = socket_read($this->fp, $this->packageLength - strlen($this->receiveData), PHP_BINARY_READ);
            $this->receiveData = $this->receiveData . $tempBuffer;
        }
        socket_close($this->fp);
        return $this->receiveData;
    }

    public function getPackageLength()
    {
        $this->receiveData = socket_read($this->fp, 4, PHP_BINARY_READ);
        
        $myCodeEngine = new CodeEngine($this->receiveData);
        $this->packageLength = $myCodeEngine->DecodeInt32();

        if ($this->debug) {
            echo '解析出整个包的大小是： ' . $this->packageLength . PHP_EOL;
        }

        return $this->packageLength;
    }

    public function sendData($data)
    {
        socket_write($this->fp, $data) or die("Write failed\n");
    }

    public function getFP()
    {
        return $this->fp;
    }

    /**
     * @return int
     */
    public function getHeadLength()
    {
        $myHead = new CSHead();

        $this->headLength = $myHead->Decode($this->receiveData);
        $this->receiveData = substr($this->receiveData, $this->headLength, $this->packageLength - $this->headLength);

        if ($this->debug) {
            echo '收到包头的长度: ' . $this->headLength . PHP_EOL;
        }
        return $this->headLength;
    }

    /**
     * 获得包的内容
     *
     * @param $class
     * @param $method
     * @return mixed
     */
    public function getPackageContent($class, $method)
    {
        $m = new ReflectionMethod($class, $method);
        $this->packageContent = $m->invokeArgs(new $class(), array($this->receiveData));

        if ($this->debug) {
            var_dump($this->packageContent);
        }
        
        return $this->packageContent;
    }
}