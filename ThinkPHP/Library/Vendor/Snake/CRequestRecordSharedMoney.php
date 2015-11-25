<?php
/**
 * SS_MSG_RECORD_SHARED_MONEY
 *
 * User: snake
 * Date: 14-9-4
 * Time: 下午8:48
 */




class CRequestRecordSharedMoney
{
    public $Uin;
    public $Account;
    public $GameTag;
    public $SelfShared;
    public $TotalShared;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin);
        $this->buffer->EncodeString($this->Account);
        $this->buffer->EncodeString($this->GameTag)
            ->EncodeInt32($this->SelfShared)
            ->EncodeInt32($this->TotalShared);

    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->GameTag = $this->buffer->DecodeString();
        $this->SelfShared = $this->buffer->DecodeInt32();
        $this->TotalShared = $this->buffer->DecodeInt32();
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
     * @param mixed $GameTag
     */
    public function setGameTag($GameTag)
    {
        $this->GameTag = $GameTag;
    }

    /**
     * @return mixed
     */
    public function getGameTag()
    {
        return $this->GameTag;
    }

    /**
     * @param mixed $SelfShared
     */
    public function setSelfShared($SelfShared)
    {
        $this->SelfShared = $SelfShared;
    }

    /**
     * @return mixed
     */
    public function getSelfShared()
    {
        return $this->SelfShared;
    }

    /**
     * @param mixed $TotalShared
     */
    public function setTotalShared($TotalShared)
    {
        $this->TotalShared = $TotalShared;
    }

    /**
     * @return mixed
     */
    public function getTotalShared()
    {
        return $this->TotalShared;
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