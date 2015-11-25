<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午9:08
 */




class CResponseGetUserDetailInfo
{
    public $ResultID;
    public $Uin;
    public $BaseInfo; #stPlayerCommonInfo
    public $ServiceData; #stServiceData
    public $LockType;
    public $GameID;
    public $LockedServerType;
    public $LockedServerID;
    public $LockedRoomID;
    public $LockedTableID;
    public $LockMoney;
    public $HappyBeanLockType;
    public $HappyBeanGameID;
    public $HappyBeanLockedServerType;
    public $HappyBeanLockedServerID;
    public $HappyBeanLockedRoomID;
    public $HappyBeanLockedTableID;


    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer
            ->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->BaseInfo->Encode($this->buffer);

            $this->buffer->EncodeInt16($this->ServiceData->Count);

            for ($i = 0; $i < $this->ServiceData->Count; $i++) {
                $this->ServiceData->Service[$i]->Encode($this->buffer);
            }

            $this->buffer
                ->EncodeInt16($this->LockType)
                ->EncodeInt16($this->GameID)
                ->EncodeInt16($this->LockedServerType)
                ->EncodeInt32($this->LockedServerID)
                ->EncodeInt32($this->LockedRoomID)
                ->EncodeInt32($this->LockedTableID)
                ->EncodeInt32($this->LockMoney)
                ->EncodeInt16($this->HappyBeanLockType)
                ->EncodeInt16($this->HappyBeanGameID)
                ->EncodeInt16($this->HappyBeanLockedServerType)
                ->EncodeInt32($this->HappyBeanLockedServerID)
                ->EncodeInt32($this->HappyBeanLockedRoomID)
                ->EncodeInt32($this->HappyBeanLockedTableID);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();

        if ($this->ResultID == CSResultID::result_id_success) {
            $temp1 = new PlayerCommonInfo();
            $temp1->Decode($this->buffer);
            $this->BaseInfo = $temp1;

            $this->ServiceData->Count = $this->buffer->DecodeInt16();
            for ($i = 0; $i < $this->ServiceData->Count; $i++) {
                $temp2 = new Service();
                $temp2->Decode($this->buffer);
                $this->ServiceData->Service[] = $temp2;
            }

            $this->LockType = $this->buffer->DecodeInt16();
            $this->GameID = $this->buffer->DecodeInt16();
            $this->LockedServerType = $this->buffer->DecodeInt16();
            $this->LockedServerID = $this->buffer->DecodeInt32();
            $this->LockedRoomID = $this->buffer->DecodeInt32();
            $this->LockedTableID = $this->buffer->DecodeInt32();
            $this->LockMoney = $this->buffer->DecodeInt32();
            $this->HappyBeanLockType = $this->buffer->DecodeInt16();
            $this->HappyBeanGameID = $this->buffer->DecodeInt16();
            $this->HappyBeanLockedServerType = $this->buffer->DecodeInt16();
            $this->HappyBeanLockedServerID = $this->buffer->DecodeInt32();
            $this->HappyBeanLockedRoomID = $this->buffer->DecodeInt32();
            $this->HappyBeanLockedTableID = $this->buffer->DecodeInt32();
        }

        return $this;
    }

    /**
     * @param mixed $BaseInfo
     */
    public function setBaseInfo($BaseInfo)
    {
        $this->BaseInfo = $BaseInfo;
    }

    /**
     * @return mixed
     */
    public function getBaseInfo()
    {
        return $this->BaseInfo;
    }

    /**
     * @param mixed $GameID
     */
    public function setGameID($GameID)
    {
        $this->GameID = $GameID;
    }

    /**
     * @return mixed
     */
    public function getGameID()
    {
        return $this->GameID;
    }

    /**
     * @param mixed $HappyBeanGameID
     */
    public function setHappyBeanGameID($HappyBeanGameID)
    {
        $this->HappyBeanGameID = $HappyBeanGameID;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanGameID()
    {
        return $this->HappyBeanGameID;
    }

    /**
     * @param mixed $HappyBeanLockType
     */
    public function setHappyBeanLockType($HappyBeanLockType)
    {
        $this->HappyBeanLockType = $HappyBeanLockType;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanLockType()
    {
        return $this->HappyBeanLockType;
    }

    /**
     * @param mixed $HappyBeanLockedRoomID
     */
    public function setHappyBeanLockedRoomID($HappyBeanLockedRoomID)
    {
        $this->HappyBeanLockedRoomID = $HappyBeanLockedRoomID;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanLockedRoomID()
    {
        return $this->HappyBeanLockedRoomID;
    }

    /**
     * @param mixed $HappyBeanLockedServerID
     */
    public function setHappyBeanLockedServerID($HappyBeanLockedServerID)
    {
        $this->HappyBeanLockedServerID = $HappyBeanLockedServerID;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanLockedServerID()
    {
        return $this->HappyBeanLockedServerID;
    }

    /**
     * @param mixed $HappyBeanLockedServerType
     */
    public function setHappyBeanLockedServerType($HappyBeanLockedServerType)
    {
        $this->HappyBeanLockedServerType = $HappyBeanLockedServerType;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanLockedServerType()
    {
        return $this->HappyBeanLockedServerType;
    }

    /**
     * @param mixed $HappyBeanLockedTableID
     */
    public function setHappyBeanLockedTableID($HappyBeanLockedTableID)
    {
        $this->HappyBeanLockedTableID = $HappyBeanLockedTableID;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanLockedTableID()
    {
        return $this->HappyBeanLockedTableID;
    }

    /**
     * @param mixed $LockMoney
     */
    public function setLockMoney($LockMoney)
    {
        $this->LockMoney = $LockMoney;
    }

    /**
     * @return mixed
     */
    public function getLockMoney()
    {
        return $this->LockMoney;
    }

    /**
     * @param mixed $LockType
     */
    public function setLockType($LockType)
    {
        $this->LockType = $LockType;
    }

    /**
     * @return mixed
     */
    public function getLockType()
    {
        return $this->LockType;
    }

    /**
     * @param mixed $LockedRoomID
     */
    public function setLockedRoomID($LockedRoomID)
    {
        $this->LockedRoomID = $LockedRoomID;
    }

    /**
     * @return mixed
     */
    public function getLockedRoomID()
    {
        return $this->LockedRoomID;
    }

    /**
     * @param mixed $LockedServerID
     */
    public function setLockedServerID($LockedServerID)
    {
        $this->LockedServerID = $LockedServerID;
    }

    /**
     * @return mixed
     */
    public function getLockedServerID()
    {
        return $this->LockedServerID;
    }

    /**
     * @param mixed $LockedServerType
     */
    public function setLockedServerType($LockedServerType)
    {
        $this->LockedServerType = $LockedServerType;
    }

    /**
     * @return mixed
     */
    public function getLockedServerType()
    {
        return $this->LockedServerType;
    }

    /**
     * @param mixed $LockedTableID
     */
    public function setLockedTableID($LockedTableID)
    {
        $this->LockedTableID = $LockedTableID;
    }

    /**
     * @return mixed
     */
    public function getLockedTableID()
    {
        return $this->LockedTableID;
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
    public function setServiceData($ServiceData)
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


}