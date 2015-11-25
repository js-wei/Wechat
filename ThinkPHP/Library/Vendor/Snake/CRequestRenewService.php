<?php
/**
 *
 *
 * Author: snake
 * Date: 14-10-12
 * Time: 下午7:06
 * Denpend:
 */




class CRequestRenewService
{
    public $Uin;
    public $Account;
    public $RenewPrice;
    public $ServiceRegisterInfo; #TServiceRegisterInfo
    public $TransTag;
    public $TransparentDataSize;
    public $TransparentData; #max_transparent_data_size

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
            ->EncodeInt32($this->RenewPrice)
            ->EncodeInt32($this->ServiceRegisterInfo->ServiceID)
            ->EncodeInt8($this->ServiceRegisterInfo->TimeType)
            ->EncodeInt32($this->ServiceRegisterInfo->ServiceTime)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->RenewPrice = $this->buffer->DecodeInt32();
        $this->ServiceRegisterInfo->ServiceID = $this->buffer->DecodeInt32();
        $this->ServiceRegisterInfo->TimeType = $this->buffer->DecodeInt8();
        $this->ServiceRegisterInfo->ServiceTime = $this->buffer->DecodeInt32();
        $this->TransTag = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->TransparentDataSize > max_transparent_data_size) {
            return false;
        }

        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
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
     * @param mixed $RenewPrice
     */
    public function setRenewPrice($RenewPrice)
    {
        $this->RenewPrice = $RenewPrice;
    }

    /**
     * @return mixed
     */
    public function getRenewPrice()
    {
        return $this->RenewPrice;
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