<?php
/**
 *
 * User: snake
 * Date: 14-10-7
 * Time: 下午9:14
 */




class DataValue
{
    public $Charming;
    public $Achievement;
    public $Punish;
    public $OtherData; # TOtherDataUpdate
    public $LoginCount;
    public $LastLoginTime;
    public $LastLoginIP;
    public $WebQunData;
    public $VipData;
    public $IDCard;
    public $Sex;
    public $BirThday;

    /**
     * @param mixed $Achievement
     */
    public function setAchievement($Achievement)
    {
        $this->Achievement = $Achievement;
    }

    /**
     * @return mixed
     */
    public function getAchievement()
    {
        return $this->Achievement;
    }

    /**
     * @param mixed $BirThday
     */
    public function setBirThday($BirThday)
    {
        $this->BirThday = $BirThday;
    }

    /**
     * @return mixed
     */
    public function getBirThday()
    {
        return $this->BirThday;
    }

    /**
     * @param mixed $Charming
     */
    public function setCharming($Charming)
    {
        $this->Charming = $Charming;
    }

    /**
     * @return mixed
     */
    public function getCharming()
    {
        return $this->Charming;
    }

    /**
     * @param mixed $IDCard
     */
    public function setIDCard($IDCard)
    {
        $this->IDCard = $IDCard;
    }

    /**
     * @return mixed
     */
    public function getIDCard()
    {
        return $this->IDCard;
    }

    /**
     * @param mixed $LastLoginIP
     */
    public function setLastLoginIP($LastLoginIP)
    {
        $this->LastLoginIP = $LastLoginIP;
    }

    /**
     * @return mixed
     */
    public function getLastLoginIP()
    {
        return $this->LastLoginIP;
    }

    /**
     * @param mixed $LastLoginTime
     */
    public function setLastLoginTime($LastLoginTime)
    {
        $this->LastLoginTime = $LastLoginTime;
    }

    /**
     * @return mixed
     */
    public function getLastLoginTime()
    {
        return $this->LastLoginTime;
    }

    /**
     * @param mixed $LoginCount
     */
    public function setLoginCount($LoginCount)
    {
        $this->LoginCount = $LoginCount;
    }

    /**
     * @return mixed
     */
    public function getLoginCount()
    {
        return $this->LoginCount;
    }

    /**
     * @param mixed $OtherData
     */
    public function setOtherData($OtherData)
    {
        $this->OtherData = $OtherData;
    }

    /**
     * @return mixed
     */
    public function getOtherData()
    {
        return $this->OtherData;
    }

    /**
     * @param mixed $Punish
     */
    public function setPunish($Punish)
    {
        $this->Punish = $Punish;
    }

    /**
     * @return mixed
     */
    public function getPunish()
    {
        return $this->Punish;
    }

    /**
     * @param mixed $Sex
     */
    public function setSex($Sex)
    {
        $this->Sex = $Sex;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->Sex;
    }

    /**
     * @param mixed $VipData
     */
    public function setVipData($VipData)
    {
        $this->VipData = $VipData;
    }

    /**
     * @return mixed
     */
    public function getVipData()
    {
        return $this->VipData;
    }

    /**
     * @param mixed $WebQunData
     */
    public function setWebQunData($WebQunData)
    {
        $this->WebQunData = $WebQunData;
    }

    /**
     * @return mixed
     */
    public function getWebQunData()
    {
        return $this->WebQunData;
    }


} 