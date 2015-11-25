<?php
/**
 * 手机包月蓝钻
 * 
 * Author: snake
 * Date: 14-4-20
 * Time: 上午9:10
 * Denpend:
 */




class CSRequestPayMobileToVip {
    public $OrderID; # 流水号
    public $SrcUid; # 发起UIN
    public $SrcAccount; # 发起Account
    public $RequestTime; # 发起请求时的时间戳
    public $ChannelID; # 渠道ID
    public $ComboID; # 套餐ID，主要是充值中心
    public $GoodsID; # 活动ID，包含是否赠送给用户相关物品或服务
    public $Mobile; # 绑定手机号码
    public $AddVipInt; # 附加字段，供扩展用途
    public $AddVipStr; # 附加字段，供扩展用途

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeString($this->OrderID)
            ->EncodeInt32($this->SrcUid)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->RequestTime)
            ->EncodeInt32($this->ChannelID)
            ->EncodeInt32($this->ComboID)
            ->EncodeInt32($this->GoodsID)
            ->EncodeString($this->Mobile)
            ->EncodeInt32($this->AddVipInt)
            ->EncodeString($this->AddVipStr);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->OrderID = $this->buffer->DecodeString();
        $this->SrcUid = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->RequestTime = $this->buffer->DecodeInt32();
        $this->ChannelID = $this->buffer->DecodeInt32();
        $this->ComboID = $this->buffer->DecodeInt32();
        $this->GoodsID = $this->buffer->DecodeInt32();
        $this->Mobile = $this->buffer->DecodeString();
        $this->AddVipInt = $this->buffer->DecodeInt32();
        $this->AddVipStr = $this->buffer->DecodeString();

        return $this;
    }

    /**
     * @param mixed $AddVipInt
     */
    public function setAddVipInt($AddVipInt)
    {
        $this->AddVipInt = $AddVipInt;
    }

    /**
     * @return mixed
     */
    public function getAddVipInt()
    {
        return $this->AddVipInt;
    }

    /**
     * @param mixed $AddVipStr
     */
    public function setAddVipStr($AddVipStr)
    {
        $this->AddVipStr = $AddVipStr;
    }

    /**
     * @return mixed
     */
    public function getAddVipStr()
    {
        return $this->AddVipStr;
    }

    /**
     * @param mixed $ChannelID
     */
    public function setChannelID($ChannelID)
    {
        $this->ChannelID = $ChannelID;
    }

    /**
     * @return mixed
     */
    public function getChannelID()
    {
        return $this->ChannelID;
    }

    /**
     * @param mixed $ComboID
     */
    public function setComboID($ComboID)
    {
        $this->ComboID = $ComboID;
    }

    /**
     * @return mixed
     */
    public function getComboID()
    {
        return $this->ComboID;
    }

    /**
     * @param mixed $GoodsID
     */
    public function setGoodsID($GoodsID)
    {
        $this->GoodsID = $GoodsID;
    }

    /**
     * @return mixed
     */
    public function getGoodsID()
    {
        return $this->GoodsID;
    }

    /**
     * @param mixed $Mobile
     */
    public function setMobile($Mobile)
    {
        $this->Mobile = $Mobile;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->Mobile;
    }

    /**
     * @param mixed $OrderID
     */
    public function setOrderID($OrderID)
    {
        $this->OrderID = $OrderID;
    }

    /**
     * @return mixed
     */
    public function getOrderID()
    {
        return $this->OrderID;
    }

    /**
     * @param mixed $RequestTime
     */
    public function setRequestTime($RequestTime)
    {
        $this->RequestTime = $RequestTime;
    }

    /**
     * @return mixed
     */
    public function getRequestTime()
    {
        return $this->RequestTime;
    }

    /**
     * @param mixed $SrcAccount
     */
    public function setSrcAccount($SrcAccount)
    {
        $this->SrcAccount = $SrcAccount;
    }

    /**
     * @return mixed
     */
    public function getSrcAccount()
    {
        return $this->SrcAccount;
    }

    /**
     * @param mixed $SrcUid
     */
    public function setSrcUid($SrcUid)
    {
        $this->SrcUid = $SrcUid;
    }

    /**
     * @return mixed
     */
    public function getSrcUid()
    {
        return $this->SrcUid;
    }

} 