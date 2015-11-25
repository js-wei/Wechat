<?php
/**
 * 手机包月退订VIP请求
 * 
 * Author: snake
 * Date: 14-4-20
 * Time: 上午9:37
 * Denpend:
 */




class CSRequestPayUnsubscriptVip {
    public $OrderID;
    public $SrcUin;
    public $SrcAccount;
    public $ReqeustTime;
    public $Mobile;

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeString($this->OrderID)
            ->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->ReqeustTime)
            ->EncodeString($this->Mobile);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->OrderID = $this->buffer->DecodeString();
        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->ReqeustTime = $this->buffer->DecodeInt32();
        $this->Mobile = $this->buffer->DecodeString();

        return $this;
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
     * @param mixed $ReqeustTime
     */
    public function setReqeustTime($ReqeustTime)
    {
        $this->ReqeustTime = $ReqeustTime;
    }

    /**
     * @return mixed
     */
    public function getReqeustTime()
    {
        return $this->ReqeustTime;
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


} 