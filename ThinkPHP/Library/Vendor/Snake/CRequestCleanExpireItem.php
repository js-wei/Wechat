<?php
/**
 * GM 清理过期道具
 *
 * User: snake
 * Date: 14-8-13
 * Time: 下午9:38
 */



class CRequestCleanExpireItem
{
    # 流水号
    public $TransTag;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeString($this->TransTag);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->TransTag = $this->buffer->DecodeString();

        return $this;
    }

    /**
     * @param mixed $TransTag
     */
    public function setTransTag($TransTag)
    {
        $this->TransTag = $TransTag;
    }

    /**
     * @return mixed
     */
    public function getTransTag()
    {
        return $this->TransTag;
    }
}