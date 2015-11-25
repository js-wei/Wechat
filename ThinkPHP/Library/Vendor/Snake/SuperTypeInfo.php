<?php
/**
 * 
 * User: snake
 * Date: 14-6-1
 * Time: 上午9:59
 */




class SuperTypeInfo {
    public $ItemSuperType;
    public $ItemCount;
    public $ItemInfos;

    /**
     * @param mixed $ItemCount
     */
    public function setItemCount($ItemCount)
    {
        $this->ItemCount = $ItemCount;
    }

    /**
     * @return mixed
     */
    public function getItemCount()
    {
        return $this->ItemCount;
    }

    /**
     * @param mixed $ItemInfos
     */
    public function setItemInfos($ItemInfos)
    {
        $this->ItemInfos = $ItemInfos;
    }

    /**
     * @return mixed
     */
    public function getItemInfos()
    {
        return $this->ItemInfos;
    }

    /**
     * @param mixed $ItemSuperType
     */
    public function setItemSuperType($ItemSuperType)
    {
        $this->ItemSuperType = $ItemSuperType;
    }

    /**
     * @return mixed
     */
    public function getItemSuperType()
    {
        return $this->ItemSuperType;
    } # array(ItemInfo2)


} 