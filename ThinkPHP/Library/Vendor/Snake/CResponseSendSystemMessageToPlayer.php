<?php
/**
 * 
 * 
 * Author: snake
 * Date: 14-5-21
 * Time: 下午10:23
 * Denpend:
 */




class CResponseSendSystemMessageToPlayer {
    public $ResultID;
    public $Uin;
    public $MessageID;
    public $ResultString;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin)
            ->EncodeInt32($this->MessageID)
            ->EncodeString($this->ResultString);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->MessageID = $this->buffer->DecodeInt32();
        $this->ResultString = $this->buffer->DecodeString();

        return $this;
    }
} 