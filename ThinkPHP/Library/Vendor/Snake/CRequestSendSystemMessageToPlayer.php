<?php
/**
 * SS_MSG_SEND_SYSTEM_MESSAGE_TO_PLAYER
 * 
 * Author: snake
 * Date: 14-5-21
 * Time: 下午10:23
 * Denpend:
 */




class CRequestSendSystemMessageToPlayer {
    public $Uin;
    public $MessageID;

    public $Count;
    public $SystemMessage;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt32($this->MessageID);

        if ($this->Count > count($this->SystemMessage)) {
            $this->Count = count($this->SystemMessage);
        }
        if ($this->Count < 0) {
            $this->Count = 0;
        }

        $this->buffer->EncodeInt8($this->Count);

        foreach ($this->SystemMessage as $msg) {
            $msg->Encode($this->buffer);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
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
     * @param mixed $SystemMessage
     */
    public function setSystemMessage($SystemMessage)
    {
        $this->SystemMessage = $SystemMessage;
    }

    /**
     * @return mixed
     */
    public function getSystemMessage()
    {
        return $this->SystemMessage;
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