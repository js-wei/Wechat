<?php
/**
 * 
 * 
 * Author: snake
 * Date: 14-4-13
 * Time: 上午11:36
 * Denpend:
 */



/**
 * 兑换响应协议
 *
 * Class CSResponsePayExchange
 * @package Snake
 */
class CSResponsePayExchange {
    public $ResultID;

    public $SrcUin;
    public $SrcAccount;

    public $DstUin;
    public $DstAccount;

    public $OrderID;

    public $Excid;
    public $Payamount;

    public $RequestTimestamp;

    public $GameSequenceID;

    public $ResponseTimestamp;

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->DstUin)
            ->EncodeString($this->DstAccount)
            ->EncodeString($this->OrderID)
            ->EncodeInt32($this->Excid)
            ->EncodeInt32($this->Payamount)
            ->EncodeInt32($this->RequestTimestamp)
            ->EncodeString($this->GameSequenceID)
            ->EncodeInt32($this->ResponseTimestamp);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->DstUin = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->OrderID = $this->buffer->DecodeString();
        $this->Excid = $this->buffer->DecodeInt32();
        $this->Payamount = $this->buffer->DecodeInt32();
        $this->RequestTimestamp = $this->buffer->DecodeInt32();
        $this->GameSequenceID = $this->buffer->DecodeString();
        $this->ResponseTimestamp = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $DstAccount
     */
    public function setDstAccount($DstAccount)
    {
        $this->DstAccount = $DstAccount;
    }

    /**
     * @return mixed
     */
    public function getDstAccount()
    {
        return $this->DstAccount;
    }

    /**
     * @param mixed $DstUin
     */
    public function setDstUin($DstUin)
    {
        $this->DstUin = $DstUin;
    }

    /**
     * @return mixed
     */
    public function getDstUin()
    {
        return $this->DstUin;
    }

    /**
     * @param mixed $Excid
     */
    public function setExcid($Excid)
    {
        $this->Excid = $Excid;
    }

    /**
     * @return mixed
     */
    public function getExcid()
    {
        return $this->Excid;
    }

    /**
     * @param mixed $GameSequenceID
     */
    public function setGameSequenceID($GameSequenceID)
    {
        $this->GameSequenceID = $GameSequenceID;
    }

    /**
     * @return mixed
     */
    public function getGameSequenceID()
    {
        return $this->GameSequenceID;
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
     * @param mixed $Payamount
     */
    public function setPayamount($Payamount)
    {
        $this->Payamount = $Payamount;
    }

    /**
     * @return mixed
     */
    public function getPayamount()
    {
        return $this->Payamount;
    }

    /**
     * @param mixed $RequestTimestamp
     */
    public function setRequestTimestamp($RequestTimestamp)
    {
        $this->RequestTimestamp = $RequestTimestamp;
    }

    /**
     * @return mixed
     */
    public function getRequestTimestamp()
    {
        return $this->RequestTimestamp;
    }

    /**
     * @param mixed $ResponseTimestamp
     */
    public function setResponseTimestamp($ResponseTimestamp)
    {
        $this->ResponseTimestamp = $ResponseTimestamp;
    }

    /**
     * @return mixed
     */
    public function getResponseTimestamp()
    {
        return $this->ResponseTimestamp;
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


} 