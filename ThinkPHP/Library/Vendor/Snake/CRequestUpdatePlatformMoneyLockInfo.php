<?php
/**
 * 设置当前DB的金币变动类型的开关
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午8:56
 */




class CRequestUpdatePlatformMoneyLockInfo
{
    public $UpdateMode; #值域:(枚举)UpdateMode
    public $LockType;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt8($this->UpdateMode)
            ->EncodeInt32($this->LockType);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->UpdateMode = $this->buffer->DecodeInt8();
        $this->LockType = $this->buffer->DecodeInt32();

        return $this;
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

    /**
     * @param mixed $UpdateMode
     */
    public function setUpdateMode($UpdateMode)
    {
        $this->UpdateMode = $UpdateMode;
    }

    /**
     * @return mixed
     */
    public function getUpdateMode()
    {
        return $this->UpdateMode;
    }
}