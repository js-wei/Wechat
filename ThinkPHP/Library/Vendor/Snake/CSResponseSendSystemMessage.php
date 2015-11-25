<?php
/**
 * 发送系统消息响应协议
 *
 * Author: snake
 * Date: 14-4-27
 * Time: 下午5:05
 * Denpend:
 */



class CSResponseSendSystemMessage
{
    public $ResultID;
    public $FailReason;

    public $SystemMEssage = array();

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeString($this->FailReason);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->FailReason = $this->buffer->DecodeString();

        return $this;
    }
} 