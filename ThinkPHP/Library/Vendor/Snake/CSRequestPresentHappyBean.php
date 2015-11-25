<?php
/**
 * SS_MSG_PRESENT_HAPPY_BEAN
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午8:38
 */




class CSRequestPresentHappyBean
{
    public $Uin;
    public $RoomID;
    public $GameID; # 为账单而增加的
    public $PresentMode;
    public $ServiceTag;
    public $DeltaHappyBean;
    public $MaxPresentCount;
    public $ACT; # 异步完成标记，对平台透明的数据，由游戏对象维护
    public $TransTag;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt16($this->GameID)
            ->EncodeInt16($this->PresentMode)
            ->EncodeInt32($this->ServiceTag)
            ->EncodeInt64($this->DeltaHappyBean)
            ->EncodeInt32($this->MaxPresentCount)
            ->EncodeInt32($this->ACT)
            ->EncodeString($this->TransTag);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->PresentMode = $this->buffer->DecodeInt16();
        $this->ServiceTag = $this->buffer->DecodeInt32();
        $this->DeltaHappyBean = $this->buffer->DecodeInt64();
        $this->MaxPresentCount = $this->buffer->DecodeInt32();
        $this->ACT = $this->buffer->DecodeInt32();
        $this->TransTag = $this->buffer->DecodeString();

        return $this;
    }

    /**
     * @param mixed $ACT
     */
    public function setACT($ACT)
    {
        $this->ACT = $ACT;
    }

    /**
     * @return mixed
     */
    public function getACT()
    {
        return $this->ACT;
    }

    /**
     * @param mixed $DeltaHappyBean
     */
    public function setDeltaHappyBean($DeltaHappyBean)
    {
        $this->DeltaHappyBean = $DeltaHappyBean;
    }

    /**
     * @return mixed
     */
    public function getDeltaHappyBean()
    {
        return $this->DeltaHappyBean;
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
     * @param mixed $MaxPresentCount
     */
    public function setMaxPresentCount($MaxPresentCount)
    {
        $this->MaxPresentCount = $MaxPresentCount;
    }

    /**
     * @return mixed
     */
    public function getMaxPresentCount()
    {
        return $this->MaxPresentCount;
    }

    /**
     * @param mixed $PresentMode
     */
    public function setPresentMode($PresentMode)
    {
        $this->PresentMode = $PresentMode;
    }

    /**
     * @return mixed
     */
    public function getPresentMode()
    {
        return $this->PresentMode;
    }

    /**
     * @param mixed $RoomID
     */
    public function setRoomID($RoomID)
    {
        $this->RoomID = $RoomID;
    }

    /**
     * @return mixed
     */
    public function getRoomID()
    {
        return $this->RoomID;
    }

    /**
     * @param mixed $ServiceTag
     */
    public function setServiceTag($ServiceTag)
    {
        $this->ServiceTag = $ServiceTag;
    }

    /**
     * @return mixed
     */
    public function getServiceTag()
    {
        return $this->ServiceTag;
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