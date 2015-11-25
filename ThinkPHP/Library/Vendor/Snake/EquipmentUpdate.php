<?php
/**
 * 
 * User: snake
 * Date: 14-6-1
 * Time: 上午10:01
 */




class EquipmentUpdate {
    public $EquipmentPosi; # 装备位，即装备数组的下标
    public $ItemId; # 装备的道具ID
    public $EquipmentUpdateMod = EquipmentUpdateMode::Equipment_Update_Mode_must;

    /**
     * @param mixed $EquipmentPosi
     */
    public function setEquipmentPosi($EquipmentPosi)
    {
        $this->EquipmentPosi = $EquipmentPosi;
    }

    /**
     * @return mixed
     */
    public function getEquipmentPosi()
    {
        return $this->EquipmentPosi;
    }

    /**
     * @param mixed $EquipmentUpdateMod
     */
    public function setEquipmentUpdateMod($EquipmentUpdateMod)
    {
        $this->EquipmentUpdateMod = $EquipmentUpdateMod;
    }

    /**
     * @return mixed
     */
    public function getEquipmentUpdateMod()
    {
        return $this->EquipmentUpdateMod;
    }

    /**
     * @param mixed $ItemId
     */
    public function setItemId($ItemId)
    {
        $this->ItemId = $ItemId;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->ItemId;
    } # 装备更新的方式

    public static function encode_EquipmentUpdate(CodeEngine &$buf,EquipmentUpdate $eu){
        $buf->EncodeInt8($eu->getEquipmentUpdateMod())
            ->EncodeInt32($eu->getEquipmentPosi())
            ->EncodeInt32($eu->getItemId());
    }

    public static function decode_EquipmentUpdate(CodeEngine &$buf){
        $eu = new EquipmentUpdate();

        $eu->setEquipmentUpdateMod($buf->DecodeInt8());
        $eu->setEquipmentPosi($buf->DecodeInt32());
        $eu->setItemId($buf->DecodeInt32());

        return $eu;
    }
} 