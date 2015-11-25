<?php
/**
 * 发送mac地址列表
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午10:13
 */




class CRequestSendMacList
{
    public $ADID;
    public $MacCount;
    public $Mac;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->ADID)
            ->EncodeInt32($this->MacCount);

        for ($i = 0; $i < $this->MacCount; $i++) {
            $this->buffer->EncodeInt64($this->Mac[$i]);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ADID = $this->buffer->DecodeInt32();
        $this->MacCount = $this->buffer->DecodeInt32();

        for ($i = 0; $i < $this->MacCount; $i++) {
            $this->Mac[] = $this->buffer->DecodeInt64();
        }

        return $this;
    }

    /**
     * @param mixed $ADID
     */
    public function setADID($ADID)
    {
        $this->ADID = $ADID;
    }

    /**
     * @return mixed
     */
    public function getADID()
    {
        return $this->ADID;
    }

    /**
     * @param mixed $Mac
     */
    public function setMac($Mac)
    {
        $this->Mac = $Mac;
    }

    /**
     * @return mixed
     */
    public function getMac()
    {
        return $this->Mac;
    }

    /**
     * @param mixed $MacCount
     */
    public function setMacCount($MacCount)
    {
        $this->MacCount = $MacCount;
    }

    /**
     * @return mixed
     */
    public function getMacCount()
    {
        return $this->MacCount;
    }
}