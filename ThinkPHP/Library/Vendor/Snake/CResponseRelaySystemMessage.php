<?php
/**
 * SS_MSG_RELAY_SYSTEM_MESSAGE
 *
 * Author: snake
 * Date: 14-5-4
 * Time: 下午7:22
 * Denpend:
 */




class CResponseRelaySystemMessage
{
    public $ResultID;
    public $RoomID;
    public $GameID;
    public $MessageID;
    public $ResultString;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->MessageID)
            ->EncodeString($this->ResultString);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);
        $len = 0;

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->MessageID = $this->buffer->DecodeInt32();
        $this->ResultString = $this->buffer->DecodeString();

        $len += 2 + 4 + 2 + 4 + 2 + strlen($this->ResultString);

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
     * @param mixed $ResultString
     */
    public function setResultString($ResultString)
    {
        $this->ResultString = $ResultString;
    }

    /**
     * @return mixed
     */
    public function getResultString()
    {
        return $this->ResultString;
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