<?php
/**
 * 给用户加普通蓝钻请求
 * 
 * Author: snake
 * Date: 14-4-19
 * Time: 下午8:47
 * Denpend:
 */




class CSRequestPayToVip {
    public $OrderID; # 流水号
    public $SrcUin; # 发起UIN
    public $SrcAccount; # 发起account
    public $RequestTime; # 发起请求时的时间戳
    public $OperUin; # 受益UIN
    public $OperAccount; # 受益account
    public $Amount; # 充值扣费付费
    public $ChannelID; # 渠道ID
    public $ComboID; # 套餐ID，主要是充值中心
    public $GoodsID; # 活动ID，包含是否赠送给用户相关物品和服务
    public $AddTime; # 给用户加VIP的时长，增量值
    public $VipType; # 用户的vip类型
    public $AddVipInt; # 附加字段，供扩展用途
    public $AddVipStr; # 附加字段，供扩展用途

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeString($this->OrderID)
            ->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->RequestTime)
            ->EncodeInt32($this->OperUin)
            ->EncodeString($this->OperAccount)
            ->EncodeInt32($this->Amount)
            ->EncodeInt32($this->ChannelID)
            ->EncodeInt32($this->ComboID)
            ->EncodeInt32($this->GoodsID)
            ->EncodeInt32($this->AddTime)
            ->EncodeInt32($this->VipType)
            ->EncodeInt32($this->AddVipInt)
            ->EncodeString($this->AddVipStr);

        return $this;
    }

    public function Decode($buf=''){
        $this->buffer = new CodeEngine($buf);

        $this->OrderID = $this->buffer->DecodeString();
        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->RequestTime = $this->buffer->DecodeInt32();
        $this->OperUin = $this->buffer->DecodeInt32();
        $this->OperAccount = $this->buffer->DecodeString();
        $this->Amount = $this->buffer->DecodeInt32();
        $this->ChannelID = $this->buffer->DecodeInt32();
        $this->ComboID = $this->buffer->DecodeInt32();
        $this->GoodsID = $this->buffer->DecodeInt32();
        $this->AddTime = $this->buffer->DecodeInt32();
        $this->VipType = $this->buffer->DecodeInt32();
        $this->AddVipInt = $this->buffer->DecodeInt32();
        $this->AddVipStr = $this->buffer->DecodeString();

        return $this;
    }

    /**
     * @param mixed $AddTime
     */
    public function setAddTime($AddTime)
    {
        $this->AddTime = $AddTime;
    }

    /**
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->AddTime;
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
     * @param mixed $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->Amount;
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
     * @param mixed $OperAccount
     */
    public function setOperAccount($OperAccount)
    {
        $this->OperAccount = $OperAccount;
    }

    /**
     * @return mixed
     */
    public function getOperAccount()
    {
        return $this->OperAccount;
    }

    /**
     * @param mixed $OperUin
     */
    public function setOperUin($OperUin)
    {
        $this->OperUin = $OperUin;
    }

    /**
     * @return mixed
     */
    public function getOperUin()
    {
        return $this->OperUin;
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
     * @param mixed $SrcUin
     */
    public function setSrcUin($SrcUin)
    {
        $this->SrcUin = $SrcUin;
    }

    /**
     * @return mixed
     */
    public function getSrcUin()
    {
        return $this->SrcUin;
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