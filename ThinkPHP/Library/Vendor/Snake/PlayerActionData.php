<?php
/**
 *
 * User: snake
 * Date: 14-10-13
 * Time: 下午9:03
 */




class PlayerActionData
{
    public $DataType;
    public $DataValue;

    public function Encode(CodeEngine &$buf)
    {
        $buf->EncodeInt8($this->DataType);

        switch ($this->DataType) {
            case PlayerActionDataType::PAD_TYPE_LOGIN:
                $buf->EncodeInt32($this->DataValue->LoginCount);
                $buf->EncodeInt16($this->DataValue->HallServerId);
                $buf->EncodeInt32($this->DataValue->HallPlayerId);
                break;
        }
    }

    public function Decode(CodeEngine &$buf)
    {
        $this->DataType = $buf->DecodeInt8();

        switch ($this->DataType) {
            case PlayerActionDataType::PAD_TYPE_LOGIN:
                $this->DataValue->LoginCount = $buf->DecodeInt32();
                $this->DataValue->HallServerId = $buf->DecodeInt16();
                $this->DataValue->HallPlayerId = $buf->DecodeInt32();
                break;
        }
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
     * @param mixed $DataValue
     */
    public function setDataValue($DataValue)
    {
        $this->DataValue = $DataValue;
    }

    /**
     * @return mixed
     */
    public function getDataValue()
    {
        return $this->DataValue;
    }


}