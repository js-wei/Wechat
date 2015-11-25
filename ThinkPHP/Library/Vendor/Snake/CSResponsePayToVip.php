<?php
/**
 * 给用户加蓝钻回复
 * 
 * Author: snake
 * Date: 14-4-19
 * Time: 下午10:04
 * Denpend:
 */




class CSResponsePayToVip {
    public $OrderID;
    public $SrcUin;
    public $SrcAccount;
    public $OperUin;
    public $OperAccount;
    public $ResultID;
    public $TransTag;
    public $ActResultID;
    public $VipEndTime;

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeString($this->OrderID)
            ->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->OperUin)
            ->EncodeString($this->OperAccount)
            ->EncodeInt16($this->ResultID)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->ActResultID)
            ->EncodeInt32($this->VipEndTime);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->OrderID = $this->buffer->DecodeString();
        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->OperUin = $this->buffer->DecodeInt32();
        $this->OperAccount = $this->buffer->DecodeString();
        $this->ResultID = $this->buffer->DecodeInt16();
        $this->TransTag = $this->buffer->DecodeString();
        $this->ActResultID = $this->buffer->DecodeInt16();
        $this->VipEndTime = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $ActResultID
     */
    public function setActResultID($ActResultID)
    {
        $this->ActResultID = $ActResultID;
    }

    /**
     * @return mixed
     */
    public function getActResultID()
    {
        return $this->ActResultID;
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
     * @param mixed $VipEndTime
     */
    public function setVipEndTime($VipEndTime)
    {
        $this->VipEndTime = $VipEndTime;
    }

    /**
     * @return mixed
     */
    public function getVipEndTime()
    {
        return $this->VipEndTime;
    }

} 