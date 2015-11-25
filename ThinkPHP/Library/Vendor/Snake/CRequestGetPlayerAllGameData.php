<?php
/**
 * SS_MSG_GET_PLAYER_ALL_GAME_DATA
 * 上一次游戏结果的状态
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午9:37
 */




class CRequestGetPlayerAllGameData
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

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $Uin
     */
    public function setUin($Uin)
    {
        $this->Uin = $Uin;
    }

    /**
     * @return mixed
     */
    public function getUin()
    {
        return $this->Uin;
    }


} 