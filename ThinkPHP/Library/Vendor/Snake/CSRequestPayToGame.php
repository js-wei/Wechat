<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-5
 * Time: 下午5:21
 */


define("MAX_ORDER_ID_LEN", 64);
define("MAX_TOKEN_LEN",128);
define("MAX_VIP_TYPE_LEN",10);
define("MAX_VIP_ADDITIONAL_LEN",1024);

/**
 * 发送充值请求
 *
 * Class CSRequestPayToGame
 * @package Snake
 */
class CSRequestPayToGame
{
    public $SrcUin;
    public $SrcAccount;
    public $DstUin;
    public $DstAccount;
    public $OrderID;
    public $Channel;
    public $Amount;
    public $Payamount;
    public $RequestTimestamp;

    public $buffer = '';

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->DstUin)
            ->EncodeString($this->DstAccount)
            ->EncodeString($this->OrderID)
            ->EncodeInt32($this->Channel)
            ->EncodeInt32($this->Amount)
            ->EncodeInt32($this->Payamount)
            ->EncodeInt32($this->RequestTimestamp);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->DstUin = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->OrderID = $this->buffer->DecodeString();
        $this->Channel = $this->buffer->DecodeInt32();
        $this->Amount = $this->buffer->DecodeInt32();
        $this->Payamount = $this->buffer->DecodeInt32();
        $this->RequestTimestamp = $this->buffer->DecodeInt32();

        return $this;
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
     * @param mixed $Channel
     */
    public function setChannel($Channel)
    {
        $this->Channel = $Channel;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->Channel;
    }

    /**
     * @param mixed $Dspublic
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