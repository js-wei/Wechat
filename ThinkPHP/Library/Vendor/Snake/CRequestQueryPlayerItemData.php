<?php
/**
 * 拉取玩家指定的道具及装备信息
 *
 * Author: snake
 * Date: 14-8-14
 * Time: 下午9:30
 * Denpend:
 */




class CRequestQueryPlayerItemData
{
    public $UIN;
    public $SuperTypeCount;
    public $SuperType;
    public $NeedEquipmentInfo;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->UIN)
            ->EncodeInt32($this->SuperTypeCount);

        for ($i = 0; $i <= $this->SuperTypeCount; $i++) {
            $this->buffer->EncodeInt32($this->SuperType[$i]);
        }

        $this->buffer->EncodeInt8($this->NeedEquipmentInfo);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->UIN = $this->buffer->DecodeInt32();
        $this->SuperTypeCount = $this->buffer->DecodeInt32();

        for ($i = 0; $i <= $this->SuperTypeCount; $i++) {
            $this->SuperType[] = $this->buffer->DecodeInt32();
        }

        $this->NeedEquipmentInfo = $this->buffer->DecodeInt8();

        return $this;
    }

    /**
     * @param mixed $NeedEquipmentInfo
     */
    public function setNeedEquipmentInfo($NeedEquipmentInfo)
    {
        $this->NeedEquipmentInfo = $NeedEquipmentInfo;
    }

    /**
     * @return mixed
     */
    public function getNeedEquipmentInfo()
    {
        return $this->NeedEquipmentInfo;
    }

    /**
     * @param mixed $SuperType
     */
    public function setSuperType($SuperType)
    {
        $this->SuperType = $SuperType;
    }

    /**
     * @return mixed
     */
    public function getSuperType()
    {
        return $this->SuperType;
    }

    /**
     * @param mixed $SuperTypeCount
     */
    public function setSuperTypeCount($SuperTypeCount)
    {
        $this->SuperTypeCount = $SuperTypeCount;
    }

    /**
     * @return mixed
     */
    public function getSuperTypeCount()
    {
        return $this->SuperTypeCount;
    }

    /**
     * @param mixed $UIN
     */
    public function setUIN($UIN)
    {
        $this->UIN = $UIN;
    }

    /**
     * @return mixed
     */
    public function getUIN()
    {
        return $this->UIN;
    }
}