<?php
/**
 * 发送系统消息请求协议
 * 
 * Author: snake
 * Date: 14-4-27
 * Time: 下午4:58
 * Denpend:
 */




class CSRequestSendSystemMessage {
    public $SrcUin;
    public $SrcAccount;
    public $MessageContent;
    public $RequestTimestamp;

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeString($this->MessageContent)
            ->EncodeInt32($this->RequestTimestamp);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->MessageContent = $this->buffer->DecodeString();
        $this->RequestTimestamp = $this->buffer->DecodeInt32();

        return $this;
    }
} 