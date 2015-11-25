<?php
/**
 * 提示client有人赠送普通物品
 *
 * User: snake
 * Date: 14-8-15
 * Time: 下午8:56
 */




class CommonItem
{
    public $SrcUIN; # 赠送者UIN
    public $SrcAccount; # 赠送者账户
    public $SrcNick; # 赠送者昵称
    public $SrcGender; # 赠送者性别
    public $DestUIN; # 受赠者UIN
    public $ItemTypeCount; # 多少类道具
    public $CommonItenInfo; # 物品的具体信息 一个商品最多可能有8类
    public $PresentMessage; # 赠言
    public $HappyBeanCount; # 赠送豆子

    /**
     * @param mixed $CommonItenInfo
     */
    public function setCommonItenInfo($CommonItenInfo)
    {
        $this->CommonItenInfo = $CommonItenInfo;
    }

    /**
     * @return mixed
     */
    public function getCommonItenInfo()
    {
        return $this->CommonItenInfo;
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
     * @param mixed $HappyBeanCount
     */
    public function setHappyBeanCount($HappyBeanCount)
    {
        $this->HappyBeanCount = $HappyBeanCount;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanCount()
    {
        return $this->HappyBeanCount;
    }

    /**
     * @param mixed $ItemTypeCount
     */
    public function setItemTypeCount($ItemTypeCount)
    {
        $this->ItemTypeCount = $ItemTypeCount;
    }

    /**
     * @return mixed
     */
    public function getItemTypeCount()
    {
        return $this->ItemTypeCount;
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