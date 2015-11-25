<?php
/**
 * SS_MSG_RELAY_SYSTEM_MESSAGE
 *
 * Author: snake
 * Date: 14-4-29
 * Time: 下午10:15
 * Denpend:
 */




class CRequestRelaySystemMessage
{
    public $RoomID;
    public $GameID;
    public $MessageID;

    public $Count;
    public $SystemMessage;

    public $buffer;

    public function __construct()
    {
        $this->Count = 0;
    }


    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();
        $len = 0;

        $this->buffer->EncodeInt32($this->RoomID)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->MessageID);
        $len += 4 + 4 + 2;

        if ($this->Count > strlen($this->SystemMessage)) {
            $this->Count = strlen($this->SystemMessage);
        }
        if ($this->Count < 0) {
            $this->Count = 0;
        }

        $this->buffer->EncodeInt8($this->Count);
        $len += 1;

        for ($i = 0; $i < $this->Count; $i++) {
            $temp = $this->SystemMessage[$i];
            $r = $temp->Encode($this->buffer);
            $len += $r;
        }

        return $len;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->RoomID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->MessageID = $this->buffer->DecodeInt32();
        $this->Count = $this->buffer->DecodeInt8();

        $tmp = new SystemMessage();
        if (strlen($this->buffer) > 0) {
            $this->SystemMessage[] = $tmp->Decode($this->buffer);
        }

        return $this;
    }

    /**
     * @param mixed $Count
     */
    public function setCount($Count)
    {
        $this->Count = $Count;
    }

    /**
     * @return mixed
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
     * @param $SystemMessage
     */
    public function setSystemMessage($SystemMessage)
    {
        $this->SystemMessage = $SystemMessage;
    }

    /**
     * @return array
     */
    public function getSystemMessage()
    {
        return $this->SystemMessage;
    }
}