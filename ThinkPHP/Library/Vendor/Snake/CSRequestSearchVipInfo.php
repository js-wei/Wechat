<?php
/**
 *
 *
 * Author: snake
 * Date: 14-4-13
 * Time: 下午2:23
 * Denpend:
 */



/**
 * 发送的查询用户是否为Vip请求协议
 *
 * Class CSRequestSearchVipInfo
 * @package Snake
 */
class CSRequestSearchVipInfo
{
    public $SrcUin;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->SrcUin);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $SrcUin
     */
    public function setSrcUin($SrcUin)
    {
        $this->SrcUin = $SrcUin;
    }

    /**
     * @return mixed
     */
    public function getSrcUin()
    {
        return $this->SrcUin;
    }
} 