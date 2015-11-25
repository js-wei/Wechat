<?php
/**
 *
 * User: snake
 * Date: 14-9-4
 * Time: 下午8:20
 */




class CResponseChangeMoney
{

    public $ResultID;
    public $Uin;
    public $CurrentMoney; #本次操作完后，该用户当前的钱.
    public $TransparentDataSize;
    public $TransparentData;

    public $UnitMoneyChg; #请求时的参数
    public $UnitCount; #请求时的参数
    public $Strategy;

    public $MoneyChg;
    public $ResultStr;
    public $TransTag;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin)
            ->EncodeInt32($this->CurrentMoney)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize)
            ->EncodeInt32($this->UnitMoneyChg)
            ->EncodeInt16($this->UnitCount)
            ->EncodeInt8($this->Strategy);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->buffer->EncodeInt32($this->MoneyChg);
        } else {
            $this->buffer->EncodeString($this->ResultStr);
        }

        $this->buffer->EncodeString($this->TransTag);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->CurrentMoney = $this->buffer->DecodeInt32();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);

        $this->UnitMoneyChg = $this->buffer->DecodeInt32();
        $this->UnitCount = $this->buffer->DecodeInt16();
        $this->Strategy = $this->buffer->DecodeInt8();

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->MoneyChg = $this->buffer->DecodeInt32($this->MoneyChg);
        } else {
            $this->ResultStr = $this->buffer->DecodeInt32($this->ResultStr);
        }

        $this->TransTag = $this->buffer->DecodeString();
        return $this;
    }

    /**
     * @param mixed $CurrentMoney
     */
    public function setCurrentMoney($CurrentMoney)
    {
        $this->CurrentMoney = $CurrentMoney;
    }

    /**
     * @return mixed
     */
    public function getCurrentMoney()
    {
        return $this->CurrentMoney;
    }

    /**
     * @param mixed $MoneyChg
     */
    public function setMoneyChg($MoneyChg)
    {
        $this->MoneyChg = $MoneyChg;
    }

    /**
     * @return mixed
     */
    public function getMoneyChg()
    {
        return $this->MoneyChg;
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
     * @param mixed $ResultStr
     */
    public function setResultStr($ResultStr)
    {
        $this->ResultStr = $ResultStr;
    }

    /**
     * @return mixed
     */
    public function getResultStr()
    {
        return $this->ResultStr;
    }

    /**
     * @param mixed $Strategy
     */
    public function setStrategy($Strategy)
    {
        $this->Strategy = $Strategy;
    }

    /**
     * @return mixed
     */
    public function getStrategy()
    {
        return $this->Strategy;
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

    /**
     * @param mixed $UnitCount
     */
    public function setUnitCount($UnitCount)
    {
        $this->UnitCount = $UnitCount;
    }

    /**
     * @return mixed
     */
    public function getUnitCount()
    {
        return $this->UnitCount;
    }

    /**
     * @param mixed $UnitMoneyChg
     */
    public function setUnitMoneyChg($UnitMoneyChg)
    {
        $this->UnitMoneyChg = $UnitMoneyChg;
    }

    /**
     * @return mixed
     */
    public function getUnitMoneyChg()
    {
        return $this->UnitMoneyChg;
    }
}