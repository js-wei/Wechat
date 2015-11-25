<?php
/**
 *
 *
 * User: snake
 * Date: 14-9-4
 * Time: 下午9:20
 */




class CResponseGetUserInfo
{
    public $ResultID;
    public $Uin;
    public $Money;
    public $Charming;
    public $Achievement;
    public $HappyBean;
    public $LastOfflineCharming;

    public $ServiceData;
    public $IDCard;
    public $UserName;
    public $VIP;


    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->buffer->EncodeInt32($this->Money)
                ->EncodeInt32($this->Charming)
                ->EncodeInt32($this->Achievement)
                ->EncodeInt64($this->HappyBean)
                ->EncodeInt32($this->LastOfflineCharming)
                ->EncodeInt16($this->ServiceData->Count);

            for ($i = 0; $i < $this->ServiceData->Count; $i++) {
                $this->ServiceData->Service[$i]->Encode($this->buffer);
            }

            $this->buffer->EncodeString($this->IDCard)
                ->EncodeString($this->UserName);
            $this->VIP->Encode($this->buffer);
        }
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->Money = $this->buffer->DecodeInt32();
            $this->Charming = $this->buffer->DecodeInt32();
            $this->Achievement = $this->buffer->DecodeInt32();
            $this->HappyBean = $this->buffer->DecodeInt64();
            $this->LastOfflineCharming = $this->buffer->DecodeInt32();
            $this->ServiceData->Count = $this->buffer->DecodeInt16();

            for ($i = 0; $i < $this->ServiceData->Count; $i++) {
                $this->ServiceData->Service[] = new ServiceData();
                $this->ServiceData->Service[$i]->Decode($this->buffer);
            }
        }
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
     * @param mixed $LastOfflineCharming
     */
    public function setLastOfflineCharming($LastOfflineCharming)
    {
        $this->LastOfflineCharming = $LastOfflineCharming;
    }

    /**
     * @return mixed
     */
    public function getLastOfflineCharming()
    {
        return $this->LastOfflineCharming;
    }

    /**
     * @param mixed $Money
     */
    public function setMoney($Money)
    {
        $this->Money = $Money;
    }

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->Money;
    }

    /**
     * @param mixed $ResultID
     */
    public function setResultID($ResultID)
    {
        $this->ResultID = $ResultID;
    }

    /**
     * @return mixed
     */
    public function getResultID()
    {
        return $this->ResultID;
    }

    /**
     * @param mixed $ServiceData
     */
    public function setServiceData(ServiceData $ServiceData)
    {
        $this->ServiceData = $ServiceData;
    }

    /**
     * @return mixed
     */
    public function getServiceData()
    {
        return $this->ServiceData;
    }

    /**
     * @param mixed $Uin
     */
    public function setUin($Uin)
    {
        $this->Uin = $Uin;
    }

    /**
     * @return mixed
     */
    public function getUin()
    {
        return $this->Uin;
    }

    /**
     * @param mixed $UserName
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->UserName;
    }

    /**
     * @param mixed $VIP
     */
    public function setVIP(VipData $VIP)
    {
        $this->VIP = $VIP;
    }

    /**
     * @return mixed
     */
    public function getVIP()
    {
        return $this->VIP;
    }


} 