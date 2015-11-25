<?php
/**
 * 发送的禁言或者封账号响应协议
 * 
 * Author: snake
 * Date: 14-4-27
 * Time: 下午4:51
 * Denpend:
 */




class CSResponsePunish {
    public $ResultID;
    public $FailReason;

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeString($this->FailReason);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->FailReason = $this->buffer->DecodeString();

        return $this;
    }

    /**
     * @param mixed $FailReason
     */
    public function setFailReason($FailReason)
    {
        $this->FailReason = $FailReason;
    }

    /**
     * @return mixed
     */
    public function getFailReason()
    {
        return $this->FailReason;
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
} 