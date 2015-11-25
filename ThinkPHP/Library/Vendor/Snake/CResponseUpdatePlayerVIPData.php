<?php
/**
 * 
 * 
 * Author: snake
 * Date: 14-5-29
 * Time: 下午9:48
 * Denpend:
 */




class CResponseUpdatePlayerVIPData {
    public $Uin;
    public $Account;
    public $TransTag;
    public $ResultID;
    public $VipType;
    public $GameVipExpireTime;
    public $GameVipScore;
    public $GameVipLevel;
    public $NextUpdateTime;
    public $TransparentDataSize;
    public $TransparentData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeString($this->Account)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->VipType)
            ->EncodeInt32($this->GameVipExpireTime)
            ->EncodeInt32($this->GameVipScore)
            ->EncodeInt32($this->GameVipLevel)
            ->EncodeInt32($this->NextUpdateTime)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentDataSize,$this->TransparentData);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->TransTag = $this->buffer->DecodeString();
        $this->ResultID = $this->buffer->DecodeInt16();
        $this->VipType = $this->buffer->DecodeInt32();
        $this->GameVipExpireTime =$this->buffer->DecodeInt32();
        $this->GameVipScore = $this->buffer->DecodeInt32();
        $this->GameVipLevel = $this->buffer->DecodeInt32();
        $this->NextUpdateTime = $this->buffer->DecodeInt32();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);

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
     * @param mixed $GameVipExpireTime
     */
    public function setGameVipExpireTime($GameVipExpireTime)
    {
        $this->GameVipExpireTime = $GameVipExpireTime;
    }

    /**
     * @return mixed
     */
    public function getGameVipExpireTime()
    {
        return $this->GameVipExpireTime;
    }

    /**
     * @param mixed $GameVipLevel
     */
    public function setGameVipLevel($GameVipLevel)
    {
        $this->GameVipLevel = $GameVipLevel;
    }

    /**
     * @return mixed
     */
    public function getGameVipLevel()
    {
        return $this->GameVipLevel;
    }

    /**
     * @param mixed $GameVipScore
     */
    public function setGameVipScore($GameVipScore)
    {
        $this->GameVipScore = $GameVipScore;
    }

    /**
     * @return mixed
     */
    public function getGameVipScore()
    {
        return $this->GameVipScore;
    }

    /**
     * @param mixed $NextUpdateTime
     */
    public function setNextUpdateTime($NextUpdateTime)
    {
        $this->NextUpdateTime = $NextUpdateTime;
    }

    /**
     * @return mixed
     */
    public function getNextUpdateTime()
    {
        return $this->NextUpdateTime;
    }

    /**
     * @param mixed $ResultID
     */
    public function setResultID($ResultID)
    {
        $this->ResultID = $ResultID;
    }

    /**
     * @return mixed
     */
    public function getResultID()
    {
        return $this->ResultID;
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
     * @param mixed $VipType
     */
    public function setVipType($VipType)
    {
        $this->VipType = $VipType;
    }

    /**
     * @return mixed
     */
    public function getVipType()
    {
        return $this->VipType;
    }


}
