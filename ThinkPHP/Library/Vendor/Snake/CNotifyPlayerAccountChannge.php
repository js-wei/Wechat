<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午8:05
 */




class CNotifyPlayerAccountChannge
{
    public $Uin;
    public $Account;
    public $ChangeTime; #最近的一次变更时间
    public $ChangeMoney; #最近的一次改变的值,正负值
    public $ServiceType;
    public $TransTag; #max_game_tag_length
    public $SelfShared;
    public $StatDataCount;
    public $StatData; #enum_StatMaxSize

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeString($this->Account)
            ->EncodeInt32($this->ChangeTime)
            ->EncodeInt32($this->ChangeMoney)
            ->EncodeInt32($this->ServiceType)
            ->EncodeString($this->TransTag)
            ->EncodeInt32($this->SelfShared)
            ->EncodeInt16($this->StatDataCount);

        for ($i = 0; $i < $this->StatDataCount; $i++) {
            $this->buffer->EncodeInt16($this->StatData[$i]->StatIndex)
                ->EncodeInt32($this->StatData[$i]->StatValue);
        }
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->ChangeTime = $this->buffer->DecodeInt32();
        $this->ChangeMoney = $this->buffer->DecodeInt32();
        $this->ServiceType = $this->buffer->DecodeInt32();
        $this->TransTag = $this->buffer->DecodeString();
        $this->SelfShared = $this->buffer->DecodeInt32();
        $this->StatDataCount = $this->buffer->DecodeInt16();

        if ($this->StatDataCount > enum_StatMaxSize) {
            $this->StatDataCount = enum_StatMaxSize;
        }

        for ($i = 0; $i < $this->StatDataCount; $i++) {
            $temp = new StatData();
            $temp->StatIndex = $this->buffer->DecodeInt16();
            $temp->StatValue = $this->buffer->DecodeInt32();
            $this->StatData[] = $temp;
        }
    }

    /**
     * @param mixed $Account
     */
    public function setAccount($Account)
    {
        $this->Account = $Account;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->Account;
    }

    /**
     * @param mixed $ChangeMoney
     */
    public function setChangeMoney($ChangeMoney)
    {
        $this->ChangeMoney = $ChangeMoney;
    }

    /**
     * @return mixed
     */
    public function getChangeMoney()
    {
        return $this->ChangeMoney;
    }

    /**
     * @param mixed $ChangeTime
     */
    public function setChangeTime($ChangeTime)
    {
        $this->ChangeTime = $ChangeTime;
    }

    /**
     * @return mixed
     */
    public function getChangeTime()
    {
        return $this->ChangeTime;
    }

    /**
     * @param mixed $SelfShared
     */
    public function setSelfShared($SelfShared)
    {
        $this->SelfShared = $SelfShared;
    }

    /**
     * @return mixed
     */
    public function getSelfShared()
    {
        return $this->SelfShared;
    }

    /**
     * @param mixed $ServiceType
     */
    public function setServiceType($ServiceType)
    {
        $this->ServiceType = $ServiceType;
    }

    /**
     * @return mixed
     */
    public function getServiceType()
    {
        return $this->ServiceType;
    }

    /**
     * @param mixed $StatData
     */
    public function setStatData($StatData)
    {
        $this->StatData = $StatData;
    }

    /**
     * @return mixed
     */
    public function getStatData()
    {
        return $this->StatData;
    }

    /**
     * @param mixed $StatDataCount
     */
    public function setStatDataCount($StatDataCount)
    {
        $this->StatDataCount = $StatDataCount;
    }

    /**
     * @return mixed
     */
    public function getStatDataCount()
    {
        return $this->StatDataCount;
    }

    /**
     * @param mixed $TransTag
     */
    public function setTransTag($TransTag)
    {
        $this->TransTag = $TransTag;
    }

    /**
     * @return mixed
     */
    public function getTransTag()
    {
        return $this->TransTag;
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


} 