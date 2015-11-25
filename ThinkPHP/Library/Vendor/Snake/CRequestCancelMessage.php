<?php
/**
 * SS_MSG_CANCEL_MESSAGE
 *
 * Author: snake
 * Date: 14-5-8
 * Time: 下午10:22
 * Denpend:
 */




class CRequestCancelMessage
{
    public $MessageID;
    public $RoomID;
    public $GameID;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->MessageID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt16($this->GameID);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->MessageID = $this->buffer->DecodeInt32();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();

        return $this;
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
     * @param mixed $MessageID
     */
    public function setMessageID($MessageID)
    {
        $this->MessageID = $MessageID;
    }

    /**
     * @return mixed
     */
    public function getMessageID()
    {
        return $this->MessageID;
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
}