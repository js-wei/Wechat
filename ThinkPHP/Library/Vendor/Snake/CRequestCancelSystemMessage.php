<?php
/**
 *
 *
 * Author: snake
 * Date: 14-5-13
 * Time: 下午10:48
 * Denpend:
 */




class CRequestCancelSystemMessage
{
    public $RoomID;
    public $PushTrigger;
    public $MessageIndex;
    public $GameID;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }


    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->RoomID)
            ->EncodeInt8($this->PushTrigger)
            ->EncodeInt8($this->MessageIndex)
            ->EncodeInt16($this->GameID);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->RoomID = $this->buffer->DecodeInt32();
        $this->PushTrigger = $this->buffer->DecodeInt8();
        $this->MessageIndex = $this->buffer->DecodeInt8();
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