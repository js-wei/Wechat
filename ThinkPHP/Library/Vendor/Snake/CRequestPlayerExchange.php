<?php
/**
 * 回兑
 *
 * Author: snake
 * Date: 14-10-10
 * Time: 下午9:33
 * Denpend:
 */




class CRequestPlayerExchange
{
    public $Uin;
    public $Account;
    public $OperUin;
    public $OperAccount;
    public $OrderID; #max_web_order_id_size
    public $Excid;
    public $PayAmount;
    public $ReqTimestamp;
    public $TransTag; #max_game_tag_length
    public $TransparentDataSize;
    public $TransparentData; #max_transparent_data_size

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
            ->EncodeInt32($this->OperUin)
            ->EncodeString($this->OperAccount)
            ->EncodeString($this->OrderID)
            ->EncodeInt32($this->Excid)
            ->EncodeInt32($this->PayAmount)
            ->EncodeInt32($this->ReqTimestamp)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->OperUin = $this->buffer->DecodeInt32();
        $this->OperAccount = $this->buffer->DecodeString();
        $this->Excid = $this->buffer->DecodeInt32();
        $this->PayAmount = $this->buffer->DecodeInt32();
        $this->ReqTimestamp = $this->buffer->DecodeInt32();
        $this->TransTag = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->TransparentDataSize > max_transparent_data_size) {
            return false;
        }

        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
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
     * @param mixed $PayAmount
     */
    public function setPayAmount($PayAmount)
    {
        $this->PayAmount = $PayAmount;
    }

    /**
     * @return mixed
     */
    public function getPayAmount()
    {
        return $this->PayAmount;
    }

    /**
     * @param mixed $ReqTimestamp
     */
    public function setReqTimestamp($ReqTimestamp)
    {
        $this->ReqTimestamp = $ReqTimestamp;
    }

    /**
     * @return mixed
     */
    public function getReqTimestamp()
    {
        return $this->ReqTimestamp;
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


} 