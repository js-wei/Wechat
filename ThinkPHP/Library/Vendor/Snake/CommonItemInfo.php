<?php
/**
 * 普通物品信息
 *
 * User: snake
 * Date: 14-8-15
 * Time: 下午8:54
 */




class CommonItemInfo
{
    public $ItemID; # 物品ID
    public $ItemName; # 道具名称
    public $DeltaItemCount; # 物品变化量

    /**
     * @param mixed $DeltaItemCount
     */
    public function setDeltaItemCount($DeltaItemCount)
    {
        $this->DeltaItemCount = $DeltaItemCount;
    }

    /**
     * @return mixed
     */
    public function getDeltaItemCount()
    {
        return $this->DeltaItemCount;
    }

    /**
     * @param mixed $ItemID
     */
    public function setItemID($ItemID)
    {
        $this->ItemID = $ItemID;
    }

    /**
     * @return mixed
     */
    public function getItemID()
    {
        return $this->ItemID;
    }

    /**
     * @param mixed $ItemName
     */
    public function setItemName($ItemName)
    {
        $this->ItemName = $ItemName;
    }

    /**
     * @return mixed
     */
    public function getItemName()
    {
        return $this->ItemName;
    }


} 