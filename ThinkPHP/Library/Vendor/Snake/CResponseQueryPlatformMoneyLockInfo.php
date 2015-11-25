<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午8:24
 */




class CResponseQueryPlatformMoneyLockInfo
{
    public $LockType;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->LockType);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->LockType = $this->buffer->DecodeInt32();

    }

    /**
     * @param mixed $LockType
     */
    public function setLockType($LockType)
    {
        $this->LockType = $LockType;
    }

    /**
     * @return mixed
     */
    public function getLockType()
    {
        return $this->LockType;
    }


} 