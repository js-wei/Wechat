<?php
/**
 *
 *
 * Author: snake
 * Date: 14-10-12
 * Time: 下午8:54
 * Denpend:
 */




class CRequestChangeHappyBean
{
    public $Uin;
    public $Account;
    public $UnitHappyBeanChg;
    public $UnitCount;
    public $Strategy;
    public $ServiceTag;
    public $Flag;
    public $TransTag;
    public $TransparentDataSize;
    public $TransparentData;
    public $NofifyTransparentDataSize;
    public $NofifyTransparentData; #max_sub_message_size

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer
            ->EncodeInt32($this->Uin)
            ->EncodeString($this->Account)
            ->EncodeInt64($this->UnitHappyBeanChg)
            ->EncodeInt16($this->UnitCount)
            ->EncodeInt8($this->Strategy)
            ->EncodeInt32($this->ServiceTag)
            ->EncodeInt8($this->Flag)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize)
            ->EncodeInt16($this->NofifyTransparentDataSize)
            ->EncodeMemory($this->NofifyTransparentData, $this->NofifyTransparentDataSize);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->UnitHappyBeanChg = $this->buffer->DecodeInt64();
        $this->UnitCount = $this->buffer->DecodeInt16();
        $this->Strategy = $this->buffer->DecodeInt8();
        $this->Flag = $this->buffer->DecodeInt32();
        $this->TransTag = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt16();
        $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);

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
     * @param mixed $Flag
     */
    public function setFlag($Flag)
    {
        $this->Flag = $Flag;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->Flag;
    }

    /**
     * @param mixed $NofifyTransparentData
     */
    public function setNofifyTransparentData($NofifyTransparentData)
    {
        $this->NofifyTransparentData = $NofifyTransparentData;
    }

    /**
     * @return mixed
     */
    public function getNofifyTransparentData()
    {
        return $this->NofifyTransparentData;
    }

    /**
     * @param mixed $NofifyTransparentDataSize
     */
    public function setNofifyTransparentDataSize($NofifyTransparentDataSize)
    {
        $this->NofifyTransparentDataSize = $NofifyTransparentDataSize;
    }

    /**
     * @return mixed
     */
    public function getNofifyTransparentDataSize()
    {
        return $this->NofifyTransparentDataSize;
    }

    /**
     * @param mixed $ServiceTag
     */
    public function setServiceTag($ServiceTag)
    {
        $this->ServiceTag = $ServiceTag;
    }

    /**
     * @return mixed
     */
    public function getServiceTag()
    {
        return $this->ServiceTag;
    }

    /**
     * @param mixed $Strategy
     */
    public function setStrategy($Strategy)
    {
        $this->Strategy = $Strategy;
    }

    /**
     * @return mixed
     */
    public function getStrategy()
    {
        return $this->Strategy;
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

    /**
     * @param mixed $UnitCount
     */
    public function setUnitCount($UnitCount)
    {
        $this->UnitCount = $UnitCount;
    }

    /**
     * @return mixed
     */
    public function getUnitCount()
    {
        return $this->UnitCount;
    }

    /**
     * @param mixed $UnitHappyBeanChg
     */
    public function setUnitHappyBeanChg($UnitHappyBeanChg)
    {
        $this->UnitHappyBeanChg = $UnitHappyBeanChg;
    }

    /**
     * @return mixed
     */
    public function getUnitHappyBeanChg()
    {
        return $this->UnitHappyBeanChg;
    }


} 