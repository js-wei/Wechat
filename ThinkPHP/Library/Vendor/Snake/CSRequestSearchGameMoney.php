<?php
/**
 *
 *
 * Author: snake
 * Date: 14-4-13
 * Time: 下午1:34
 * Denpend:
 */



/**
 * 查询游戏币请求协议
 *
 * Class CSRequestSearchGameMoney
 * @package Snake
 */
class CSRequestSearchGameMoney
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