<?php
/**
 *
 *
 * Author: snake
 * Date: 14-5-21
 * Time: 下午9:55
 * Denpend:
 */




class CResponseCancelSystemMessage
{
    public $ResultID;
    public $RoomID;
    public $PushTrigger;
    public $MessageIndex;
    public $GameID;
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
            ->EncodeInt8($this->PushTrigger)
            ->EncodeInt8($this->MessageIndex)
            ->EncodeInt16($this->GameID)
            ->EncodeString($this->ResultString);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->PushTrigger = $this->buffer->DecodeInt8();
        $this->MessageIndex = $this->buffer->DecodeInt8();
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
     * @param mixed $MessageIndex
     */
    public function setMessageIndex($MessageIndex)
    {
        $this->MessageIndex = $MessageIndex;
    }

    /**
     * @return mixed
     */
    public function getMessageIndex()
    {
        return $this->MessageIndex;
    }

    /**
     * @param mixed $PushTrigger
     */
    public function setPushTrigger($PushTrigger)
    {
        $this->PushTrigger = $PushTrigger;
    }

    /**
     * @return mixed
     */
    public function getPushTrigger()
    {
        return $this->PushTrigger;
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