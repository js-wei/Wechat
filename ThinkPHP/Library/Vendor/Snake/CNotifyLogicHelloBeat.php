<?php
/**
 *
 * User: snake
 * Date: 14-10-13
 * Time: 下午8:53
 */




class CNotifyLogicHelloBeat
{
    public $Uin;
    public $GameCount;
    public $GameId; #max_game_count_in_server
    public $MoneyLockType;
    public $MoneyLockedServerType;
    public $MoneyLockedServerID;
    public $MoneyLockedRoomID;
    public $MoneyLockedTableID;
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
            ->EncodeInt32($this->Uin)
            ->EncodeInt8($this->GameCount);


        for ($i = 0; $i < $this->GameCount; $i++) {
            $this->buffer->EncodeInt16($this->GameId[$i]);
        }

        $this->buffer
            ->EncodeInt16($this->MoneyLockType)
            ->EncodeInt16($this->MoneyLockedServerType)
            ->EncodeInt32($this->MoneyLockedServerID)
            ->EncodeInt32($this->MoneyLockedRoomID)
            ->EncodeInt32($this->MoneyLockedTableID)
            ->EncodeInt32($this->LockMoney)
            ->EncodeInt16($this->HappyBeanLockType)
            ->EncodeInt16($this->HappyBeanGameID)
            ->EncodeInt16($this->HappyBeanLockedServerType)
            ->EncodeInt32($this->HappyBeanLockedServerID)
            ->EncodeInt32($this->HappyBeanLockedRoomID)
            ->EncodeInt32($this->HappyBeanLockedTableID);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameCount = $this->buffer->DecodeInt8();


        for ($i = 0; $i < $this->GameCount; $i++) {
            $this->GameId[] = $this->buffer->DecodeInt16();
        }

        $this->MoneyLockType = $this->buffer->DecodeInt16();
        $this->MoneyLockedServerType = $this->buffer->DecodeInt16();
        $this->MoneyLockedServerID = $this->buffer->DecodeInt32();
        $this->MoneyLockedRoomID = $this->buffer->DecodeInt32();
        $this->MoneyLockedTableID = $this->buffer->DecodeInt32();
        $this->LockMoney = $this->buffer->DecodeInt32();
        $this->HappyBeanLockType = $this->buffer->DecodeInt16();
        $this->HappyBeanGameID = $this->buffer->DecodeInt16();
        $this->HappyBeanLockedServerType = $this->buffer->DecodeInt16();
        $this->HappyBeanLockedServerID = $this->buffer->DecodeInt32();
        $this->HappyBeanLockedRoomID = $this->buffer->DecodeInt32();
        $this->HappyBeanLockedTableID = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $GameCount
     */
    public function setGameCount($GameCount)
    {
        $this->GameCount = $GameCount;
    }

    /**
     * @return mixed
     */
    public function getGameCount()
    {
        return $this->GameCount;
    }

    /**
     * @param mixed $GameId
     */
    public function setGameId($GameId)
    {
        $this->GameId = $GameId;
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->GameId;
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
     * @param mixed $MoneyLockType
     */
    public function setMoneyLockType($MoneyLockType)
    {
        $this->MoneyLockType = $MoneyLockType;
    }

    /**
     * @return mixed
     */
    public function getMoneyLockType()
    {
        return $this->MoneyLockType;
    }

    /**
     * @param mixed $MoneyLockedRoomID
     */
    public function setMoneyLockedRoomID($MoneyLockedRoomID)
    {
        $this->MoneyLockedRoomID = $MoneyLockedRoomID;
    }

    /**
     * @return mixed
     */
    public function getMoneyLockedRoomID()
    {
        return $this->MoneyLockedRoomID;
    }

    /**
     * @param mixed $MoneyLockedServerID
     */
    public function setMoneyLockedServerID($MoneyLockedServerID)
    {
        $this->MoneyLockedServerID = $MoneyLockedServerID;
    }

    /**
     * @return mixed
     */
    public function getMoneyLockedServerID()
    {
        return $this->MoneyLockedServerID;
    }

    /**
     * @param mixed $MoneyLockedServerType
     */
    public function setMoneyLockedServerType($MoneyLockedServerType)
    {
        $this->MoneyLockedServerType = $MoneyLockedServerType;
    }

    /**
     * @return mixed
     */
    public function getMoneyLockedServerType()
    {
        return $this->MoneyLockedServerType;
    }

    /**
     * @param mixed $MoneyLockedTableID
     */
    public function setMoneyLockedTableID($MoneyLockedTableID)
    {
        $this->MoneyLockedTableID = $MoneyLockedTableID;
    }

    /**
     * @return mixed
     */
    public function getMoneyLockedTableID()
    {
        return $this->MoneyLockedTableID;
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