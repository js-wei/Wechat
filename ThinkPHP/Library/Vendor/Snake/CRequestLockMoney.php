<?php
/**
 * SS_MSG_LOCKMONEY
 *
 * Author: snake
 * Date: 14-8-18
 * Time: 下午9:51
 * Denpend:
 */




class CRequestLockMoney
{
    public $Uin;
    public $Account;
    public $RoomID;
    public $TableID;

    public $GameID;
    public $LockType;
    public $LockMoney;
    public $ACT; # 异步完成标记，对平台透明的数据，由游戏对象维护
    public $LockStrategy; # 策略:此值仅当m_nLockType为锁的时候才为有效

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
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID)
            ->EncodeInt16($this->GameID)
            ->EncodeInt16($this->LockType)
            ->EncodeInt32($this->LockMoney)
            ->EncodeInt32($this->ACT)
            ->EncodeInt8($this->LockStrategy);

        $len = 4 + strlen($this->Account) + 2 + 4 + 4 + 2 + 2 + 4 + 4 + 1;

        return $len;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->TableID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->LockType = $this->buffer->DecodeInt16();
        $this->LockMoney = $this->buffer->DecodeInt32();
        $this->ACT = $this->buffer->DecodeInt32();
        $this->LockStrategy = $this->buffer->DecodeInt8();

        return $this;
    }

    /**
     * @param mixed $ACT
     */
    public function setACT($ACT)
    {
        $this->ACT = $ACT;
    }

    /**
     * @return mixed
     */
    public function getACT()
    {
        return $this->ACT;
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
     * @param mixed $GameID
     */
    public function setGameID($GameID)
    {
        $this->GameID = $GameID;
    }

    /**
     * @return mixed
     */
    public function getGameID()
    {
        return $this->GameID;
    }

    /**
     * @param mixed $LockMoney
     */
    public function setLockMoney($LockMoney)
    {
        $this->LockMoney = $LockMoney;
    }

    /**
     * @return mixed
     */
    public function getLockMoney()
    {
        return $this->LockMoney;
    }

    /**
     * @param mixed $LockStrategy
     */
    public function setLockStrategy($LockStrategy)
    {
        $this->LockStrategy = $LockStrategy;
    }

    /**
     * @return mixed
     */
    public function getLockStrategy()
    {
        return $this->LockStrategy;
    }

    /**
     * @param mixed $LockType
     */
    public function setLockType($LockType)
    {
        $this->LockType = $LockType;
    }

    /**
     * @return mixed
     */
    public function getLockType()
    {
        return $this->LockType;
    }

    /**
     * @param mixed $RoomID
     */
    public function setRoomID($RoomID)
    {
        $this->RoomID = $RoomID;
    }

    /**
     * @return mixed
     */
    public function getRoomID()
    {
        return $this->RoomID;
    }

    /**
     * @param mixed $TableID
     */
    public function setTableID($TableID)
    {
        $this->TableID = $TableID;
    }

    /**
     * @return mixed
     */
    public function getTableID()
    {
        return $this->TableID;
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