<?php
/**
 * 提示client有人赠送魅力物品
 *
 * User: snake
 * Date: 14-8-15
 * Time: 下午8:47
 */




class CharmItem
{
    public $SrcUIN; # 赠送者UIN
    public $SrcAccount; # 赠送者账号
    public $SrcNick; # 赠送者昵称
    public $SrcGender; # 赠送者性别
    public $DestUIN; # 受赠者UIN
    public $DeltaCharmValue; # 受赠者魅力值变化量
    public $ItemID; # 道具ID
    public $ItemName; # 道具名称
    public $DeltaItemCount; # 道具变化量
    public $PresentMessage; # 赠言

    /**
     * @param mixed $DeltaCharmValue
     */
    public function setDeltaCharmValue($DeltaCharmValue)
    {
        $this->DeltaCharmValue = $DeltaCharmValue;
    }

    /**
     * @return mixed
     */
    public function getDeltaCharmValue()
    {
        return $this->DeltaCharmValue;
    }

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
     * @param mixed $DestUIN
     */
    public function setDestUIN($DestUIN)
    {
        $this->DestUIN = $DestUIN;
    }

    /**
     * @return mixed
     */
    public function getDestUIN()
    {
        return $this->DestUIN;
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

    /**
     * @param mixed $PresentMessage
     */
    public function setPresentMessage($PresentMessage)
    {
        $this->PresentMessage = $PresentMessage;
    }

    /**
     * @return mixed
     */
    public function getPresentMessage()
    {
        return $this->PresentMessage;
    }

    /**
     * @param mixed $SrcAccount
     */
    public function setSrcAccount($SrcAccount)
    {
        $this->SrcAccount = $SrcAccount;
    }

    /**
     * @return mixed
     */
    public function getSrcAccount()
    {
        return $this->SrcAccount;
    }

    /**
     * @param mixed $SrcGender
     */
    public function setSrcGender($SrcGender)
    {
        $this->SrcGender = $SrcGender;
    }

    /**
     * @return mixed
     */
    public function getSrcGender()
    {
        return $this->SrcGender;
    }

    /**
     * @param mixed $SrcNick
     */
    public function setSrcNick($SrcNick)
    {
        $this->SrcNick = $SrcNick;
    }

    /**
     * @return mixed
     */
    public function getSrcNick()
    {
        return $this->SrcNick;
    }

    /**
     * @param mixed $SrcUIN
     */
    public function setSrcUIN($SrcUIN)
    {
        $this->SrcUIN = $SrcUIN;
    }

    /**
     * @return mixed
     */
    public function getSrcUIN()
    {
        return $this->SrcUIN;
    }
}