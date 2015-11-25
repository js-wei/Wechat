<?php
/**
 * SS_MSG_LOCKMONEY
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午8:51
 */




class CRequestLockHappyBean
{
    public $Uin;
    public $RoomID;
    public $TableID;
    public $GameID;
    public $LockType;
    public $ACT;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID)
            ->EncodeInt16($this->GameID)
            ->EncodeInt16($this->LockType)
            ->EncodeInt32($this->ACT);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->TableID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->LockType = $this->buffer->DecodeInt16();
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