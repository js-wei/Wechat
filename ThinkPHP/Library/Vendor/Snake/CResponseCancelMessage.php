<?php
/**
 * SS_MSG_CANCEL_MESSAGE
 * 
 * Author: snake
 * Date: 14-5-12
 * Time: 下午10:24
 * Denpend:
 */




class CResponseCancelMessage {
    public $ResultID;
    public $MessageID;
    public $RoomID;
    public $GameID;
    public $ResultString;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->MessageID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt16($this->GameID)
            ->EncodeString($this->ResultString);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->MessageID = $this->buffer->DecodeInt32();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->ResultString = $this->buffer->DecodeString();

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