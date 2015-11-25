<?php
/**
 * 手机包月退订VIP回复
 * 
 * Author: snake
 * Date: 14-4-20
 * Time: 上午9:47
 * Denpend:
 */




class CSResponsePayUnsubscriptVip {
    public $OrderID;
    public $SrcUin;
    public $SrcAccount;
    public $ResultID;
    public $TransTag;

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeString($this->OrderID)
            ->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt16($this->ResultID)
            ->EncodeString($this->TransTag);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->OrderID = $this->buffer->DecodeString();
        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->ResultID = $this->buffer->DecodeInt32();
        $this->TransTag = $this->buffer->DecodeString();

        return $this;
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
} 