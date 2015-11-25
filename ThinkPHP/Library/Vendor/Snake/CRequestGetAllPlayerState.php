<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午4:35
 */




class CRequestGetAllPlayerState
{
    public $Flag;

    public $buffer;

    function __construct()
    {
    }

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();
        $len = 0;
        $this->buffer->EncodeInt8($this->Flag);
        $len += 1;

        return $len;
    }

    /**
     * @param mixed $Flag
     */
    public function setFlag($Flag)
    {
        $this->Flag = $Flag;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->Flag;
    }
} 