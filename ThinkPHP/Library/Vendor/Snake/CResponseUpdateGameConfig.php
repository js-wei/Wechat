<?php
/**
 *
 *
 * User: snake
 * Date: 14-9-4
 * Time: 下午8:17
 */




class CResponseUpdateGameConfig
{
    public $ResultID;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();
        $this->buffer->EncodeInt32($this->ResultID);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);
        $this->ResultID = $this->buffer->DecodeInt32();
    }

    /**
     * @param mixed $ResultID
     */
    public function setResultID($ResultID)
    {
        $this->ResultID = $ResultID;
    }

    /**
     * @return mixed
     */
    public function getResultID()
    {
        return $this->ResultID;
    }
}