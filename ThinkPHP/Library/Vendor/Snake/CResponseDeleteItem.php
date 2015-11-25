<?php
/**
 *
 * User: snake
 * Date: 14-11-25
 * Time: 下午8:57
 */




class CResponseDeleteItem
{
    public $ResultID;
    public $TranTag;

    public $buffer;

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
        $this->TranTag = $this->buffer->DecodeString();
        $len += 2 + strlen($this->TranTag);

        return $this;
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

    /**
     * @param mixed $TranTag
     */
    public function setTranTag($TranTag)
    {
        $this->TranTag = $TranTag;
    }

    /**
     * @return mixed
     */
    public function getTranTag()
    {
        return $this->TranTag;
    }


} 