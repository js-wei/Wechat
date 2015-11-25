<?php
/**
 *
 * User: snake
 * Date: 14-11-16
 * Time: 下午5:59
 */




class CRequestGetADList
{
    public $Type;

    /**
     * @param mixed $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->Type;
    }

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->Type);

        return $this;
    }
}