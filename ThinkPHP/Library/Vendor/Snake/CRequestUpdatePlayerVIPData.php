<?php
/**
 * 
 * 
 * Author: snake
 * Date: 14-5-29
 * Time: 下午9:37
 * Denpend:
 */




class CRequestUpdatePlayerVIPData {
    public $Uin;
    public $Account;
    public $TransTag;
    public $DeltaScore;
    public $TransparentDataSize;
    public $TransparentData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeString($this->Account)
            ->EncodeString($this->TransTag)
            ->EncodeInt32($this->DeltaScore)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentDataSize,$this->TransparentData);

        return $this;
    }

    public function Decode($buf = '') {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->TransTag = $this->buffer->DecodeInt32();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);

        return $this;
    }

    /**
     * @param mixed $Account
     */
    public function setAccount($Account)
    {
        $this->Account = $Account;
    }

    /**
     * @param mixed $DeltaScore
     */
    public function setDeltaScore($DeltaScore)
    {
        $this->DeltaScore = $DeltaScore;
    }

    /**
     * @param mixed $TransTag
     */
    public function setTransTag($TransTag)
    {
        $this->TransTag = $TransTag;
    }

    /**
     * @param mixed $TransparentData
     */
    public function setTransparentData($TransparentData)
    {
        $this->TransparentData = $TransparentData;
    }

    /**
     * @param mixed $TransparentDataSize
     */
    public function setTransparentDataSize($TransparentDataSize)
    {
        $this->TransparentDataSize = $TransparentDataSize;
    }

    /**
     * @param mixed $Uin
     */
    public function setUin($Uin)
    {
        $this->Uin = $Uin;
    }
}