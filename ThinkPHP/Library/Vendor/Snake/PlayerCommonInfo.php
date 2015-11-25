<?php
/**
 *
 * User: snake
 * Date: 14-8-21
 * Time: 下午9:14
 */


class PlayerCommonInfo
{
    public $Coin;
    public $LoginCount;
    public $OfflineCount;
    public $FirstLoginDatetime; //第一次登陆平台的时间

    public $Charming;
    public $Achievement;
    public $HappyBean;

    public $BlackLevel;
    public $ValidDate;
    public $PunishMethod;
    public $LastLoginDate;
    public $LastLoginIP;
    public $DescString; //进入黑名单的描述
    public $LastConsumeDate;


    public $MiscFlag; //具体值域的定义,见后.
    //每天赠送欢乐豆
    public $HappyBean_Daily_PresentedCount; //当天已赠送的次数
    public $HappyBean_Daily_LastPresentedTime; //最近一次赠送的时间


    public $WebQunData;
    public $Others; //预留信息, 下标访问

    public $VipData;

    public $IDCard;
    public $Sex;
    public $BirThday;

    public function Encode(CodeEngine &$buf)
    {
        # 模拟编码VipData 获得长度
        $ttemp = new CodeEngine();


        $len = 13 * 4 + 8 + 1 + strlen($this->ValidDate)
            + strlen($this->LastLoginDate)
            + strlen($this->LastConsumeDate)
            + strlen($this->DescString)
            + strlen($this->LastLoginDate)
            + 4 * count($this->Others)
            + $this->WebQunData->DataSize
            + $this->VipData->Encode($ttemp); # 目的就是为了得到长度
        $buf->EncodeInt16($len)
            ->EncodeInt32($this->Coin)
            ->EncodeInt32($this->LoginCount)
            ->EncodeInt32($this->OfflineCount)
            ->EncodeInt32($this->Charming)
            ->EncodeInt32($this->Achievement)
            ->EncodeInt64($this->HappyBean)
            ->EncodeInt32($this->BlackLevel)
            ->EncodeString($this->ValidDate)
            ->EncodeInt32($this->PunishMethod)
            ->EncodeString($this->LastLoginDate)
            ->EncodeInt32($this->LastLoginIP)
            ->EncodeString($this->DescString)
            ->EncodeString($this->LastConsumeDate)
            ->EncodeInt32($this->MiscFlag)
            ->EncodeInt32($this->HappyBean_Daily_PresentedCount)
            ->EncodeInt32($this->HappyBean_Daily_LastPresentedTime)
            ->EncodeInt16($this->WebQunData->DataSize)
            ->EncodeMemory($this->WebQunData->WebQunInfo, $this->WebQunData->DataSize);

        for ($i = 0; $i < count($this->Others); $i++) {
            $buf->EncodeInt32($this->Others[$i]);
        }

        $buf->EncodeInt32($this->FirstLoginDatetime);
        $this->VipData->Encode($buf);
        $buf->EncodeInt32($this->IDCard)
            ->EncodeInt8($this->Sex)
            ->EncodeInt16($this->BirThday->Year)
            ->EncodeInt16($this->BirThday->Month)
            ->EncodeInt16($this->BirThday->Day);
    }

    public function Decode(CodeEngine &$buf)
    {
        $playercommonSize = 0;
        $outlength = 0;

        $len = $buf->DecodeInt16();
        $outlength += 2;
        $this->setCoin($buf->DecodeInt32());
        $outlength += 4;
        $this->setLoginCount($buf->DecodeInt32());
        $outlength += 4;
        $this->setOfflineCount($buf->DecodeInt32());
        $outlength += 4;
        $this->setCharming($buf->DecodeInt32());
        $outlength += 4;
        $this->setAchievement($buf->DecodeInt32());
        $outlength += 4;
        $this->setHappyBean($buf->DecodeInt64());
        $outlength += 8;
        $this->setBlackLevel($buf->DecodeInt32());
        $outlength += 4;
        $this->setValidDate($buf->DecodeString());
        $outlength += strlen($this->ValidDate) + 2;
        $this->setPunishMethod($buf->DecodeInt32());
        $outlength += 4;
        $this->setLastLoginDate($buf->DecodeString());
        $outlength += strlen($this->LastLoginDate) + 2;
        $this->setLastLoginIP($buf->DecodeInt32());
        $outlength += 4;
        $this->setDescString($buf->DecodeString());
        $outlength += strlen($this->DescString) + 2;
        $this->setLastConsumeDate($buf->DecodeString());
        $outlength += strlen($this->LastConsumeDate) + 2;
        $this->setMiscFlag($buf->DecodeInt32());
        $outlength += 4;
        $this->setHappyBeanDailyPresentedCount($buf->DecodeInt32());
        $outlength += 4;
        $this->setHappyBeanDailyLastPresentedTime($buf->DecodeInt32());
        $outlength += 4;
        $t = new WebQunData();
        $t->DataSize = $buf->DecodeInt16();
        $outlength += 2;
        $t->WebQunInfo = $buf->DecodeMemory($t->DataSize);
        $outlength += $t->DataSize;
        $this->setWebQunData($t);
        # 如何获取Others的长度
        # 卡住了 貌似有逻辑问题

        $this->Others = array();
        for ($i = 0; $i < player_data_other_count; $i++) {
            $this->Others[] = $buf->DecodeInt32();
        }
        $outlength += player_data_other_count * 4;

        $this->FirstLoginDatetime = $buf->DecodeInt32();
        $outlength += 4;

        $tt = new VipData();
        $r = $tt->Decode($buf);
        $this->setVipData($tt);
        $outlength += $r;

        $this->setIDCard($buf->DecodeString());
        $outlength += strlen($this->IDCard) + 2;
        $this->setSex($buf->DecodeInt8());
        $outlength += 1;

        $ttt = new Birthday();
        $ttt->setYear($buf->DecodeInt16());
        $outlength += 2;
        $ttt->setMonth($buf->DecodeInt16());
        $outlength += 2;
        $ttt->setDay($buf->DecodeInt16());
        $outlength += 2;

        $this->setBirThday($ttt);

        $playercommonSize = $len - $outlength;

        if ($playercommonSize > 0) {
            $buf->DecodeMemory($playercommonSize);
        }

        return $len;
    }

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
     * @param mixed $BlackLevel
     */
    public function setBlackLevel($BlackLevel)
    {
        $this->BlackLevel = $BlackLevel;
    }

    /**
     * @return mixed
     */
    public function getBlackLevel()
    {
        return $this->BlackLevel;
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
     * @param mixed $Coin
     */
    public function setCoin($Coin)
    {
        $this->Coin = $Coin;
    }

    /**
     * @return mixed
     */
    public function getCoin()
    {
        return $this->Coin;
    }

    /**
     * @param mixed $DescString
     */
    public function setDescString($DescString)
    {
        $this->DescString = $DescString;
    }

    /**
     * @return mixed
     */
    public function getDescString()
    {
        return $this->DescString;
    }

    /**
     * @param mixed $FirstLoginDatetime
     */
    public function setFirstLoginDatetime($FirstLoginDatetime)
    {
        $this->FirstLoginDatetime = $FirstLoginDatetime;
    }

    /**
     * @return mixed
     */
    public function getFirstLoginDatetime()
    {
        return $this->FirstLoginDatetime;
    }

    /**
     * @param mixed $HappyBean
     */
    public function setHappyBean($HappyBean)
    {
        $this->HappyBean = $HappyBean;
    }

    /**
     * @return mixed
     */
    public function getHappyBean()
    {
        return $this->HappyBean;
    }

    /**
     * @param mixed $HappyBean_Daily_LastPresentedTime
     */
    public function setHappyBeanDailyLastPresentedTime($HappyBean_Daily_LastPresentedTime)
    {
        $this->HappyBean_Daily_LastPresentedTime = $HappyBean_Daily_LastPresentedTime;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanDailyLastPresentedTime()
    {
        return $this->HappyBean_Daily_LastPresentedTime;
    }

    /**
     * @param mixed $HappyBean_Daily_PresentedCount
     */
    public function setHappyBeanDailyPresentedCount($HappyBean_Daily_PresentedCount)
    {
        $this->HappyBean_Daily_PresentedCount = $HappyBean_Daily_PresentedCount;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanDailyPresentedCount()
    {
        return $this->HappyBean_Daily_PresentedCount;
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
     * @param mixed $LastConsumeDate
     */
    public function setLastConsumeDate($LastConsumeDate)
    {
        $this->LastConsumeDate = $LastConsumeDate;
    }

    /**
     * @return mixed
     */
    public function getLastConsumeDate()
    {
        return $this->LastConsumeDate;
    }

    /**
     * @param mixed $LastLoginDate
     */
    public function setLastLoginDate($LastLoginDate)
    {
        $this->LastLoginDate = $LastLoginDate;
    }

    /**
     * @return mixed
     */
    public function getLastLoginDate()
    {
        return $this->LastLoginDate;
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
     * @param mixed $MiscFlag
     */
    public function setMiscFlag($MiscFlag)
    {
        $this->MiscFlag = $MiscFlag;
    }

    /**
     * @return mixed
     */
    public function getMiscFlag()
    {
        return $this->MiscFlag;
    }

    /**
     * @param mixed $OfflineCount
     */
    public function setOfflineCount($OfflineCount)
    {
        $this->OfflineCount = $OfflineCount;
    }

    /**
     * @return mixed
     */
    public function getOfflineCount()
    {
        return $this->OfflineCount;
    }

    /**
     * @param mixed $Others
     */
    public function setOthers($Others)
    {
        $this->Others = $Others;
    }

    /**
     * @return mixed
     */
    public function getOthers()
    {
        return $this->Others;
    }

    /**
     * @param mixed $PunishMethod
     */
    public function setPunishMethod($PunishMethod)
    {
        $this->PunishMethod = $PunishMethod;
    }

    /**
     * @return mixed
     */
    public function getPunishMethod()
    {
        return $this->PunishMethod;
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
     * @param mixed $ValidDate
     */
    public function setValidDate($ValidDate)
    {
        $this->ValidDate = $ValidDate;
    }

    /**
     * @return mixed
     */
    public function getValidDate()
    {
        return $this->ValidDate;
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
    public function setWebQunData(WebQunData $WebQunData)
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