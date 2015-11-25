<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午8:29
 */




class CResponseUpdatePlatformMoneyLockInfo
{
    public $ResultID; #值域:(枚举)UpdateMode
    public $LockType;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->LockType);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->LockType = $this->buffer->DecodeInt32();

        return $this;
    }
} 