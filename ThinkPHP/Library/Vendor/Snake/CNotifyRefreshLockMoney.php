<?php
/**
 * SS_MSG_NOTIFY_LOCKMONEY
 *
 * User: snake
 * Date: 14-9-1
 * Time: 下午9:33
 */




class CNotifyRefreshLockMoney
{
    public $Uin;
    public $LockType;
    public $ServerID;
    public $RoomID;
    public $TableID;
    public $LockMoney;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt16($this->LockType)
            ->EncodeInt32($this->ServerID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID);
        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->LockType = $this->buffer->DecodeInt16();
        $this->ServerID = $this->buffer->DecodeInt32();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->TableID = $this->buffer->DecodeInt32();

        return $this;
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
     * @param mixed $ServerID
     */
    public function setServerID($ServerID)
    {
        $this->ServerID = $ServerID;
    }

    /**
     * @return mixed
     */
    public function getServerID()
    {
        return $this->ServerID;
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