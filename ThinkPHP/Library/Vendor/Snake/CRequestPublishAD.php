<?php
/**
 * 请求发布广告
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午10:06
 */




class CRequestPublishAD
{
    public $ADInfo;

    public $buffer;

    function __construct()
    {
        $this->ADInfo = new ADInfo();
    }

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();
        $len = 0;

        $this->buffer->EncodeInt32($this->ADInfo->ADInfoLength)
            ->EncodeInt32($this->ADInfo->ADID)
            ->EncodeInt32($this->ADInfo->StartTime)
            ->EncodeInt32($this->ADInfo->EndTime)
            ->EncodeInt16($this->ADInfo->CycleType)
            ->EncodeString($this->ADInfo->URL)
            ->EncodeInt32($this->ADInfo->MacCount);
        $len += 4 * 5 + 2 + strlen($this->ADInfo->URL);

        return $len;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ADInfo = new ADInfo();
        $this->ADInfo->setADInfoLength($this->buffer->DecodeInt32());
        $this->ADInfo->setADID($this->buffer->DecodeInt32());
        $this->ADInfo->setStartTime($this->buffer->DecodeInt32());
        $this->ADInfo->setEndTime($this->buffer->DecodeInt32());
        $this->ADInfo->setURL($this->buffer->DecodeString());
        $this->ADInfo->setMacCount($this->buffer->DecodeInt32());

        return $this;
    }

    /**
     * @param mixed $ADInfo
     */
    public function setADInfo(ADInfo $ADInfo)
    {
        $this->ADInfo = $ADInfo;
    }

    /**
     * @return mixed
     */
    public function getADInfo()
    {
        return $this->ADInfo;
    }


} 