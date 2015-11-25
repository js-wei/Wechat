<?php
/**
 *
 *
 * Author: snake
 * Date: 14-5-29
 * Time: 下午9:05
 * Denpend:
 */




class CRefreshVIPData
{
    public $Uin;
    public $Account;
    public $GameVipExpireTime; # 游戏vip的过期时间(如果没有开通，时间为0)
    public $GameVipScore; # 游戏vip积分
    public $GameVipLevel; # 游戏vip等级
    public $VipTips; # 个人资料面板上的提示信息
    public $NextUpdateTime; # 下次升级的绝对时间
    public $VipType; # vip类型
    public $LastBecomeVipTime; # 最近成为vip的时间
    public $NofifyTransparentDataSize; #
    public $NofifyTransparentData; # notify透传数据

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
            ->EncodeInt32($this->GameVipExpireTime)
            ->EncodeInt32($this->GameVipScore)
            ->EncodeInt32($this->GameVipLevel)
            ->EncodeString($this->VipTips)
            ->EncodeInt32($this->NextUpdateTime)
            ->EncodeInt32($this->NofifyTransparentDataSize)
            ->EncodeMemory(strlen($this->NofifyTransparentData),$this->NofifyTransparentData)
            ->EncodeInt32($this->VipType)
            ->EncodeInt32($this->LastBecomeVipTime);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->GameVipExpireTime = $this->buffer->DecodeInt32();
        $this->GameVipScore = $this->buffer->DecodeInt32();
        $this->GameVipLevel = $this->buffer->DecodeInt32();
        $this->VipTips = $this->buffer->DecodeString();
        $this->NextUpdateTime = $this->buffer->DecodeInt32();
        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt32();
        $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);
        $this->VipType = $this->buffer->DecodeInt32();
        $this->LastBecomeVipTime = $this->buffer->DecodeInt32();

        return true;
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
     * @param mixed $LastBecomeVipTime
     */
    public function setLastBecomeVipTime($LastBecomeVipTime)
    {
        $this->LastBecomeVipTime = $LastBecomeVipTime;
    }

    /**
     * @return mixed
     */
    public function getLastBecomeVipTime()
    {
        return $this->LastBecomeVipTime;
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
     * @param mixed $VipTips
     */
    public function setVipTips($VipTips)
    {
        $this->VipTips = $VipTips;
    }

    /**
     * @return mixed
     */
    public function getVipTips()
    {
        return $this->VipTips;
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