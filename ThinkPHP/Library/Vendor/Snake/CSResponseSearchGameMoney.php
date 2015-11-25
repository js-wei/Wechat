<?php
/**
 * 
 * 
 * Author: snake
 * Date: 14-4-13
 * Time: 下午1:53
 * Denpend:
 */



/**
 * 查询游戏币响应协议
 *
 * Class CSResponseSearchGameMoney
 * @package Snake
 */
class CSResponseSearchGameMoney {
    public $ResultID;
    public $SrcUin;
    public $Coin;

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->SrcUin)
            ->EncodeInt32($this->Coin);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->Coin = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $Coin
     */
    public function setCoin($Coin)
    {
        $this->Coin = $Coin;
    }

    /**
     * @return mixed
     */
    public function getCoin()
    {
        return $this->Coin;
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