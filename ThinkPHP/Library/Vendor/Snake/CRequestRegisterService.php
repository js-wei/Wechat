<?php
/**
 * 注册服务
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午9:43
 */




class CRequestRegisterService
{
    public $Uin;
    public $Account;
    public $ServiceNumber;
    public $ServiceRegisterInfo; # 数组
    public $TransTag;
    public $TransparentDataSize;
    public $TransparentData;
    public $ChannelId;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeString($this->Account)
            ->EncodeInt16($this->ServiceNumber);

        for ($i = 0; $i < $this->ServiceNumber; $i++) {
            $this->buffer->EncodeInt32($this->ServiceRegisterInfo[$i]['ServiceID'])
                ->EncodeInt8($this->ServiceRegisterInfo[$i]['TimeType'])
                ->EncodeInt32($this->ServiceRegisterInfo[$i]['ServiceTime']);
        }

        $this->buffer->EncodeString($this->TransTag)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize)
            ->EncodeInt32($this->ChannelId);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->ServiceNumber = $this->buffer->DecodeInt16();

        for ($i = 0; $i < $this->ServiceNumber; $i++) {
            $this->ServiceRegisterInfo[] = array(
                'ServiceID' => $this->buffer->DecodeInt32(),
                'TimeType' => $this->buffer->DecodeInt8(),
                'ServiceTime' => $this->buffer->DecodeInt32()
            );
        }

        $this->TransTag = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        $this->ChannelId = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $Account
     */
    public function setAccount($Account)
    {
        $this->Account = $Account;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->Account;
    }

    /**
     * @param mixed $ChannelId
     */
    public function setChannelId($ChannelId)
    {
        $this->ChannelId = $ChannelId;
    }

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->ChannelId;
    }

    /**
     * @param mixed $ServiceNumber
     */
    public function setServiceNumber($ServiceNumber)
    {
        $this->ServiceNumber = $ServiceNumber;
    }

    /**
     * @return mixed
     */
    public function getServiceNumber()
    {
        return $this->ServiceNumber;
    }

    /**
     * @param mixed $ServiceRegisterInfo
     */
    public function setServiceRegisterInfo($ServiceRegisterInfo)
    {
        $this->ServiceRegisterInfo = $ServiceRegisterInfo;
    }

    /**
     * @return mixed
     */
    public function getServiceRegisterInfo()
    {
        return $this->ServiceRegisterInfo;
    }

    /**
     * @param mixed $TransTag
     */
    public function setTransTag($TransTag)
    {
        $this->TransTag = $TransTag;
    }

    /**
     * @return mixed
     */
    public function getTransTag()
    {
        return $this->TransTag;
    }

    /**
     * @param mixed $TransparentData
     */
    public function setTransparentData($TransparentData)
    {
        $this->TransparentData = $TransparentData;
    }

    /**
     * @return mixed
     */
    public function getTransparentData()
    {
        return $this->TransparentData;
    }

    /**
     * @param mixed $TransparentDataSize
     */
    public function setTransparentDataSize($TransparentDataSize)
    {
        $this->TransparentDataSize = $TransparentDataSize;
    }

    /**
     * @return mixed
     */
    public function getTransparentDataSize()
    {
        return $this->TransparentDataSize;
    }

    /**
     * @param mixed $Uin
     */
    public function setUin($Uin)
    {
        $this->Uin = $Uin;
    }

    /**
     * @return mixed
     */
    public function getUin()
    {
        return $this->Uin;
    }

} 