<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午4:47
 */




class CResponseGetAllPlayerState
{
    public $ResultID;

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

    public $buffer;

    function __construct()
    {
    }


    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);
        $len = 0;
        $this->ResultID = $this->buffer->DecodeInt16();
        $len += 2;

        # 这样子写是为了反射
        return $this;
    }
} 