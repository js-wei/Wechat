<?php
/**
 *
 *
 * Author: snake
 * Date: 14-10-12
 * Time: 下午8:37
 * Denpend:
 */




class CResponseLockHappyBean
{
    public $ResultID;
    public $Uin;
    public $GameID;
    public $RoomID;
    public $TableID;
    public $LockType;
    public $CurrentHappyBean;
    public $LockedServerType; #当前占有游戏币锁的服务器type
    public $LockedServerID; #当前占有游戏币锁的服务器id
    public $LockedRoomID; #当前占有游戏币锁的房间id
    public $LockedTableID; #当前占有游戏币锁的游戏桌id
    public $ACT; #异步完成标记，对平台透明的数据，由游戏对象维护

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer
            ->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID)
            ->EncodeInt16($this->LockType)
            ->EncodeInt64($this->CurrentHappyBean)
            ->EncodeInt16($this->LockedServerType)
            ->EncodeInt32($this->LockedServerID)
            ->EncodeInt32($this->LockedRoomID)
            ->EncodeInt32($this->LockedTableID)
            ->EncodeInt32($this->ACT);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->TableID = $this->buffer->DecodeInt32();
        $this->LockType = $this->buffer->DecodeInt16();
        $this->CurrentHappyBean = $this->buffer->DecodeInt64();
        $this->LockedServerType = $this->buffer->DecodeInt16();
        $this->LockedServerID = $this->buffer->DecodeInt32();
        $this->LockedRoomID = $this->buffer->DecodeInt32();
        $this->LockedTableID = $this->buffer->DecodeInt32();
        $this->ACT = $this->buffer->DecodeInt32();

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
     * @param mixed $CurrentHappyBean
     */
    public function setCurrentHappyBean($CurrentHappyBean)
    {
        $this->CurrentHappyBean = $CurrentHappyBean;
    }

    /**
     * @return mixed
     */
    public function getCurrentHappyBean()
    {
        return $this->CurrentHappyBean;
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