<?php
/**
 *
 *
 * Author: snake
 * Date: 14-5-4
 * Time: 下午8:04
 * Denpend:
 */




class CRequestSubmitSystemMessage
{
    public $RoomID;
    public $PushTrigger;
    public $MessageIndex;
    public $GameID;
    public $MessageID;

    public $Count = 0;
    public $SystemMessages = array();

    public $buffer;

    public function __construct()
    {
        $this->PushTrigger = PushTrigger::enmPushTrigger_null;
        $this->MessageIndex = -1;
        $this->GameID = -1;
        $this->MessageID = -1;
        $this->Count = 0;
    }

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
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->MessageID);

        if ($this->Count > count($this->SystemMessages)) {
            $this->Count = count($this->SystemMessages);
        }
        if ($this->Count < 0) {
            $this->Count = 0;
        }

        $this->buffer->EncodeInt8($this->Count);
        foreach ($this->SystemMessages as $msg) {
            $msg->Encode($this->buffer);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->RoomID = $this->buffer->DecodeInt32();
        $this->PushTrigger = $this->buffer->DecodeInt8();
        $this->MessageIndex = $this->buffer->DecodeInt8();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->MessageID = $this->buffer->DecodeInt32();
        $this->Count = $this->buffer->DecodeInt8();

        $tmp = new SystemMessage();
        if(strlen($this->buffer) > 0){
            $this->SystemMessages[] = $tmp->Decode($this->buffer);
        }

        return $this;
    }

    /**
     * @param int $Count
     */
    public function setCount($Count)
    {
        $this->Count = $Count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->Count;
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

    /**
     * @param array $SystemMessages
     */
    public function setSystemMessages($SystemMessages)
    {
        $this->SystemMessages = $SystemMessages;
    }

    /**
     * @return array
     */
    public function getSystemMessages()
    {
        return $this->SystemMessages;
    }
}