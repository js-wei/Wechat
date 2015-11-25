<?php
/**
 * SS_MSG_GETOTHERUSERINFO
 *
 * User: snake
 * Date: 14-9-10
 * Time: 下午8:01
 */




class CRequestGetOtherUserInfo
{
    public $Uin;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
    }
} 