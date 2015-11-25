<?php
/**
 * VIP数据
 *
 * User: snake
 * Date: 14-8-21
 * Time: 下午9:11
 */




class VipData
{
    public $GameVipExpireTime; //游戏VIP的过期时间(如果没有开通过，时间为0)
    public $GameVIPScore; //游戏VIP积分
    public $GameVIPLevel; //游戏VIP等级
    public $NextUpdateVIPLevelTime; //下次升级的时间
    public $VIPTips; //个人资料面板上的提示信息
    public $GameVIPType; //游戏VIP类型,具体值定义参见  enmVIPType

    public function Encode(CodeEngine &$buf, $BecomeVIPTime = null)
    {
        $len = 0;

        if (!is_null($BecomeVIPTime)) {
            $len += 4;
        }
        $len += 2 + 4 + 4 + 4 + 4 + strlen($this->VIPTips) + 4;

        $buf->EncodeInt16($len)
            ->EncodeInt32($this->GameVipExpireTime)
            ->EncodeInt32($this->GameVIPScore)
            ->EncodeInt32($this->GameVIPLevel)
            ->EncodeInt32($this->NextUpdateVIPLevelTime)
            ->EncodeString($this->VIPTips)
            ->EncodeInt32($this->GameVIPType);

        if (!is_null($BecomeVIPTime)) {
            $buf->EncodeInt32($BecomeVIPTime);
        }

        return $len;
    }

    public function Decode(CodeEngine &$buf, &$BecomeVIPTime = null)
    {
        $outlength = 0;

        $len = $buf->DecodeInt16();
        $outlength += 2;

        $this->setGameVipExpireTime($buf->DecodeInt32());
        $outlength += 4;

        $this->setGameVIPScore($buf->DecodeInt32());
        $outlength += 4;

        $this->setGameVIPLevel($buf->DecodeInt32());
        $outlength += 4;

        $this->setNextUpdateVIPLevelTime($buf->DecodeInt32());
        $outlength += 4;

        $this->setVIPTips($buf->DecodeString());
        $outlength += strlen($this->VIPTips) + 2;

        $this->setGameVIPType($buf->DecodeInt32());
        $outlength += 4;

        if (!is_null($BecomeVIPTime)) {
            $BecomeVIPTime = $buf->DecodeInt32();
            $outlength += 4;
        }

        $vipsize = $len - $outlength;

        if ($vipsize > 0) {
            $buf->DecodeMemory($vipsize);
        }

        return $len;
    }

    /**
     * @param mixed $GameVIPLevel
     */
    public function setGameVIPLevel($GameVIPLevel)
    {
        $this->GameVIPLevel = $GameVIPLevel;
    }

    /**
     * @return mixed
     */
    public function getGameVIPLevel()
    {
        return $this->GameVIPLevel;
    }

    /**
     * @param mixed $GameVIPScore
     */
    public function setGameVIPScore($GameVIPScore)
    {
        $this->GameVIPScore = $GameVIPScore;
    }

    /**
     * @return mixed
     */
    public function getGameVIPScore()
    {
        return $this->GameVIPScore;
    }

    /**
     * @param mixed $GameVIPType
     */
    public function setGameVIPType($GameVIPType)
    {
        $this->GameVIPType = $GameVIPType;
    }

    /**
     * @return mixed
     */
    public function getGameVIPType()
    {
        return $this->GameVIPType;
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
     * @param mixed $NextUpdateVIPLevelTime
     */
    public function setNextUpdateVIPLevelTime($NextUpdateVIPLevelTime)
    {
        $this->NextUpdateVIPLevelTime = $NextUpdateVIPLevelTime;
    }

    /**
     * @return mixed
     */
    public function getNextUpdateVIPLevelTime()
    {
        return $this->NextUpdateVIPLevelTime;
    }

    /**
     * @param mixed $VIPTips
     */
    public function setVIPTips($VIPTips)
    {
        $this->VIPTips = $VIPTips;
    }

    /**
     * @return mixed
     */
    public function getVIPTips()
    {
        return $this->VIPTips;
    }

}