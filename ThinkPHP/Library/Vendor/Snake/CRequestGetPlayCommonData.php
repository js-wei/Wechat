<?php
/**
 * 请求获得玩家通用数据
 *
 * User: snake
 * Date: 14-10-7
 * Time: 下午8:17
 */




class CRequestGetPlayCommonData
{
    public $Uin;
    public $DataCount;
    public $DataType; # PlayCommandDataType
    public $DataOtherPosi; #

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt16($this->DataCount);

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->buffer->EncodeInt8($this->DataType[$i]);
        }

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->buffer->EncodeInt8($this->DataOtherPosi[$i]);
        }
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->DataCount = $this->buffer->DecodeInt16();

        if ($this->DataCount > PlayCommandDataType::PCD_MAX_DATA_NUMBER) {
            $this->DataCount = PlayCommandDataType::PCD_MAX_DATA_NUMBER;
        }

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->DataType[] = $this->buffer->DecodeInt8();
        }

        for ($i = 0; $i < $this->DataOtherPosi; $i++) {
            $this->DataType[] = $this->buffer->DecodeInt8();
        }
    }

    /**
     * @param mixed $DataCount
     */
    public function setDataCount($DataCount)
    {
        $this->DataCount = $DataCount;
    }

    /**
     * @return mixed
     */
    public function getDataCount()
    {
        return $this->DataCount;
    }

    /**
     * @param mixed $DataOtherPosi
     */
    public function setDataOtherPosi($DataOtherPosi)
    {
        $this->DataOtherPosi = $DataOtherPosi;
    }

    /**
     * @return mixed
     */
    public function getDataOtherPosi()
    {
        return $this->DataOtherPosi;
    }

    /**
     * @param mixed $DataType
     */
    public function setDataType($DataType)
    {
        $this->DataType = $DataType;
    }

    /**
     * @return mixed
     */
    public function getDataType()
    {
        return $this->DataType;
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