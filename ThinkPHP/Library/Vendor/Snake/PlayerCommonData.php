<?php
/**
 *
 * User: snake
 * Date: 14-10-7
 * Time: 下午8:58
 */




class PlayerCommonData
{
    public $DataType;
    public $DataValue;

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

    public function Encode(CodeEngine &$buf)
    {
        $buf->EncodeInt8($this->DataType);

        switch ($this->DataType) {
            case PlayCommandDataType::PCD_Charming:
                $buf->EncodeInt32($this->DataValue->Charming);
                break;
            case PlayCommandDataType::PCD_Achievement:
                $buf->EncodeInt32($this->DataValue->Achievement);
                break;
            case PlayCommandDataType::PCD_PunishMethod:
                $buf->EncodeString($this->DataValue->Punish->ValidDate)
                    ->EncodeInt8($this->DataValue->Punish->BlackLevel)
                    ->EncodeInt16($this->DataValue->Punish->PunishMethod)
                    ->EncodeString($this->DataValue->Punish->DescString);
                break;
            case PlayCommandDataType::PCD_OtherData:
                $buf->EncodeInt8($this->DataValue->OtherData->OtherDataIndex)
                    ->EncodeInt8($this->DataValue->OtherData->UpdateMode)
                    ->EncodeInt8($this->DataValue->OtherData->OtherDataValue);
                break;
            case PlayCommandDataType::PCD_LoginCount:
                $buf->EncodeInt32($this->DataValue->LoginCount);
                break;
            case PlayCommandDataType::PCD_LastLoginTime:
                $buf->EncodeInt32($this->DataValue->LastLoginTime);
                break;
            case PlayCommandDataType::PCD_LastLoginIP:
                $buf->EncodeInt32($this->DataValue->LastLoginIP);
                break;
            case PlayCommandDataType::PCD_WebQunData:
                $buf->EncodeInt32($this->DataValue->WebQunData->DataSize)
                    ->EncodeMemory($this->DataValue->WebQunData->WebQunInfo, $this->DataValue->WebQunData->DataSize);
                break;
            case PlayCommandDataType::PCD_VipData:
                $this->DataValue->VipData->Encode($buf);
                break;
            case PlayCommandDataType::PCD_IdCard:
                $buf->EncodeString($this->DataValue->IDCard);
                break;
            case PlayCommandDataType::PCD_Sex:
                $buf->EncodeInt8($this->DataValue->Sex);
                break;
            case PlayCommandDataType::PCD_Birthday:
                $buf->EncodeInt16($this->DataValue->BirThday->Year)
                    ->EncodeInt16($this->DataValue->BirThday->Month)
                    ->EncodeInt16($this->DataValue->BirThday->Day);
                break;
            default:

                break;
        }

        return $buf;
    }

    public function Decode(CodeEngine &$buf)
    {
        $this->DataType = $buf->DecodeInt8();

        $this->DataValue = new DataValue();

        switch ($this->DataType) {
            case PlayCommandDataType::PCD_Charming:
                $this->DataValue->Charming = $buf->DecodeInt32();
                break;
            case PlayCommandDataType::PCD_Achievement:
                $this->DataValue->Achievement = $buf->DecodeInt32();
                break;
            case PlayCommandDataType::PCD_PunishMethod:
                $this->DataValue->Punish->ValidDate = $buf->DecodeString();
                $this->DataValue->Punish->BlackLevel = $buf->DecodeInt8();
                $this->DataValue->Punish->PunishMethod = $buf->DecodeInt16();
                $this->DataValue->Punish->DescString = $buf->DecodeString();
                break;
            case PlayCommandDataType::PCD_OtherData:
                $this->DataValue->OtherData->OtherDataIndex = $buf->DecodeInt8();
                $this->DataValue->OtherData->UpdateMode = $buf->DecodeInt8();
                $this->DataValue->OtherData->OtherDataValue = $buf->DecodeInt8();
                break;
            case PlayCommandDataType::PCD_LoginCount:
                $this->DataValue->LoginCount = $buf->DecodeInt32();
                break;
            case PlayCommandDataType::PCD_LastLoginTime:
                $this->DataValue->LastLoginTime = $buf->DecodeInt32();
                break;
            case PlayCommandDataType::PCD_LastLoginIP:
                $this->DataValue->LastLoginIP = $buf->DecodeInt32();
                break;
            case PlayCommandDataType::PCD_WebQunData:
                $this->DataValue->WebQunData->DataSize = $buf->DecodeInt32();
                $this->DataValue->WebQunData->WebQunInfo = $buf->DecodeMemory($this->DataValue->WebQunData->DataSize);
                break;
            case PlayCommandDataType::PCD_VipData:
                $this->DataValue->VipData = new VipData();
                $this->DataValue->VipData = $this->DataValue->VipData->Decode($buf);
                break;
            case PlayCommandDataType::PCD_IdCard:
                $this->DataValue->IDCard = $buf->DecodeString();
                break;
            case PlayCommandDataType::PCD_Sex:
                $this->DataValue->Sex = $buf->DecodeInt8();
                break;
            case PlayCommandDataType::PCD_Birthday:
                $this->DataValue->BirThday = new Birthday();
                $this->DataValue->BirThday->Year = $buf->DecodeInt16();
                $this->DataValue->BirThday->Month = $buf->DecodeInt16();
                $this->DataValue->BirThday->Day = $buf->DecodeInt16();
                break;
            default:

                break;
        }

        return $this;
    }


}