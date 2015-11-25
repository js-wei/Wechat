<?php
/**
 *
 *
 * Author: snake
 * Date: 14-5-8
 * Time: 下午9:55
 * Denpend:
 */




class CResponseSubmitSystemMessage
{
    public $ResultID;
    public $RoomID;
    public $PushTrigger;
    public $MessageIndex;
    public $GameID;
    public $MessageID;
    public $ResultString;

    public $buffer;

    public function __construct()
    {
        $this->PushTrigger = PushTrigger::enmPushTrigger_null;
        $this->MessageIndex = -1;
        $this->MessageID = -1;
        $this->GameID = -1;
        $this->ResultString = '';
    }

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt8($this->PushTrigger)
            ->EncodeInt8($this->MessageIndex)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->MessageID)
            ->EncodeString($this->ResultString);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->PushTrigger = $this->buffer->DecodeInt8();
        $this->MessageIndex = $this->buffer->DecodeInt8();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->MessageID = $this->buffer->DecodeInt32();
        $this->ResultString = $this->buffer->DecodeString();

        return $this;
    }
} 