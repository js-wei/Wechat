<?php
/**
 * 
 * 
 * Author: snake
 * Date: 14-4-13
 * Time: 下午2:34
 * Denpend:
 */



/**
 * 查询是否为Vip的回复
 *
 * Class CSResponseSearchVipInfo
 * @package Snake
 */
class CSResponseSearchVipInfo {
    public $SrcUin;
    public $ResultID;
    public $VipType; # vip类型
    public $EndTime; # vip结束时间

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->SrcUin)
            ->EncodeInt16($this->ResultID)
            ->EncodeString($this->VipType)
            ->EncodeInt32($this->EndTime);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->ResultID = $this->buffer->DecodeInt16();
        $this->VipType = $this->buffer->DecodeString();
        $this->EndTime = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $EndTime
     */
    public function setEndTime($EndTime)
    {
        $this->EndTime = $EndTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->EndTime;
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

    /**
     * @param mixed $VipType
     */
    public function setVipType($VipType)
    {
        $this->VipType = $VipType;
    }

    /**
     * @return mixed
     */
    public function getVipType()
    {
        return $this->VipType;
    }
} 