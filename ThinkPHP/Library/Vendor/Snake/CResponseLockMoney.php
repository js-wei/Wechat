<?php
/**
 *
 *
 * User: snake
 * Date: 14-8-31
 * Time: 下午7:44
 */




class CResponseLockMoney
{
    public $ResultID;
    public $Uin;
    public $Account;
    public $GameID;
    public $LockType;

    public $RoomID;
    public $TableID;

    public $CurrentMoney; #当前游戏币
    public $LockedServerType; #当前占有游戏币锁的服务器type
    public $LockedServerID; #当前占有游戏币锁的服务器id
    public $LockedRoomID; #当前占有游戏币锁的房间id
    public $LockedTableID; #当前占有游戏币锁的游戏桌id
    public $LockMoney; #当前占有游戏币锁的锁定金额

    public $ACT; #异步完成标记，对平台透明的数据，由游戏对象维护
    public $LockStrategy; #策略:此值仅当m_nLockType为锁的时候才为有效

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
            ->EncodeString($this->Account)
            ->EncodeInt16($this->GameID)
            ->EncodeInt16($this->LockType)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID)
            ->EncodeInt32($this->CurrentMoney)
            ->EncodeInt16($this->LockedServerType)
            ->EncodeInt32($this->LockedServerID)
            ->EncodeInt32($this->LockedRoomID)
            ->EncodeInt32($this->LockedTableID)
            ->EncodeInt32($this->LockMoney)
            ->EncodeInt32($this->ACT)
            ->EncodeInt8($this->LockStrategy);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->LockType = $this->buffer->DecodeInt16();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->TableID = $this->buffer->DecodeInt32();
        $this->CurrentMoney = $this->buffer->DecodeInt32();
        $this->LockedServerType = $this->buffer->DecodeInt16();
        $this->LockedServerID = $this->buffer->DecodeInt32();
        $this->LockedRoomID = $this->buffer->DecodeInt32();
        $this->LockedTableID = $this->buffer->DecodeInt32();
        $this->LockMoney = $this->buffer->DecodeInt32();
        $this->ACT = $this->buffer->DecodeInt32();
        $this->LockStrategy = $this->buffer->DecodeInt8();

        $len = 2 + 4 + 2 + strlen($this->Account) + 2 + 2 + 4 * 3 + 2 + 4 * 5 + 1;
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
     * @param mixed $LockedRoomID
     */
    public function setLockedRoomID($LockedRoomID)
    {
        $this->LockedRoomID = $LockedRoomID;
    }

    /**
     * @return mixed
     */
    public function getLockedRoomID()
    {
        return $this->LockedRoomID;
    }

    /**
     * @param mixed $LockedServerID
     */
    public function setLockedServerID($LockedServerID)
    {
        $this->LockedServerID = $LockedServerID;
    }

    /**
     * @return mixed
     */
    public function getLockedServerID()
    {
        return $this->LockedServerID;
    }

    /**
     * @param mixed $LockedServerType
     */
    public function setLockedServerType($LockedServerType)
    {
        $this->LockedServerType = $LockedServerType;
    }

    /**
     * @return mixed
     */
    public function getLockedServerType()
    {
        return $this->LockedServerType;
    }

    /**
     * @param mixed $LockedTableID
     */
    public function setLockedTableID($LockedTableID)
    {
        $this->LockedTableID = $LockedTableID;
    }

    /**
     * @return mixed
     */
    public function getLockedTableID()
    {
        return $this->LockedTableID;
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