<?php
/**
 * SS_MSG_UPDATEPOINT
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午9:00
 */




class CRequestUpdateGamePoint
{
    public $Uin;
    public $Account;
    public $SourceIP;
    public $Port;
    public $GameID;
    public $RoomID;
    public $TableID;

    public $DeltaGamePoint;
    public $DeltaWinRound;
    public $DeltaLossRound;
    public $DeltaDrawRound;
    public $DeltaEscapeRound;
    public $DeltaMoney;
    public $DeltaHappyBean;

    public $GameSeconds; # 游戏耗时
    public $DeltaServiceFare;
    public $DeltaServiceFareHappyBean;
    public $ACT; # 异步完成标记，由游戏对象维护，对平台透明

    public $GameTag; # 游戏局标签， 唯一表示一局游戏
    public $GamePara; # 游戏参数

    public $RoomBillFlag; # 账单类型: 普通房间账单，VIP房间账单等
    public $RoomActiveID; # 房间内活动ID。默认是0，无活动

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
            ->EncodeInt32($this->SourceIP)
            ->EncodeInt16($this->Port)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID)
            ->EncodeInt32($this->DeltaGamePoint)
            ->EncodeInt32($this->DeltaWinRound)
            ->EncodeInt32($this->DeltaLossRound)
            ->EncodeInt32($this->DeltaDrawRound)
            ->EncodeInt32($this->DeltaEscapeRound)
            ->EncodeInt32($this->DeltaMoney)
            ->EncodeInt64($this->DeltaHappyBean)
            ->EncodeInt32($this->DeltaServiceFare)
            ->EncodeInt64($this->DeltaServiceFareHappyBean)
            ->EncodeInt32($this->GameSeconds)
            ->EncodeInt32($this->ACT)
            ->EncodeString($this->GameTag)
            ->EncodeString($this->GamePara)
            ->EncodeInt32($this->RoomBillFlag)
            ->EncodeInt32($this->RoomActiveID);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->SourceIP = $this->buffer->DecodeInt32();
        $this->Port = $this->buffer->DecodeInt16();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->TableID = $this->buffer->DecodeInt32();
        $this->DeltaGamePoint = $this->buffer->DecodeInt32();
        $this->DeltaWinRound = $this->buffer->DecodeInt32();
        $this->DeltaLossRound = $this->buffer->DecodeInt32();
        $this->DeltaDrawRound = $this->buffer->DecodeInt32();
        $this->DeltaEscapeRound = $this->buffer->DecodeInt32();
        $this->DeltaMoney = $this->buffer->DecodeInt32();
        $this->DeltaHappyBean = $this->buffer->DecodeInt64();
        $this->DeltaServiceFare = $this->buffer->DecodeInt32();
        $this->DeltaServiceFareHappyBean = $this->buffer->DecodeInt64();
        $this->DeltaGamePoint = $this->buffer->DecodeInt32();
        $this->ACT = $this->buffer->DecodeInt32();
        $this->GameTag = $this->buffer->DecodeString();
        $this->GamePara = $this->buffer->DecodeString();
        $this->RoomBillFlag = $this->buffer->DecodeInt32();
        $this->RoomActiveID = $this->buffer->DecodeInt32();

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
     * @param mixed $DeltaDrawRound
     */
    public function setDeltaDrawRound($DeltaDrawRound)
    {
        $this->DeltaDrawRound = $DeltaDrawRound;
    }

    /**
     * @return mixed
     */
    public function getDeltaDrawRound()
    {
        return $this->DeltaDrawRound;
    }

    /**
     * @param mixed $DeltaEscapeRound
     */
    public function setDeltaEscapeRound($DeltaEscapeRound)
    {
        $this->DeltaEscapeRound = $DeltaEscapeRound;
    }

    /**
     * @return mixed
     */
    public function getDeltaEscapeRound()
    {
        return $this->DeltaEscapeRound;
    }

    /**
     * @param mixed $DeltaGamePoint
     */
    public function setDeltaGamePoint($DeltaGamePoint)
    {
        $this->DeltaGamePoint = $DeltaGamePoint;
    }

    /**
     * @return mixed
     */
    public function getDeltaGamePoint()
    {
        return $this->DeltaGamePoint;
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
     * @param mixed $DeltaLossRound
     */
    public function setDeltaLossRound($DeltaLossRound)
    {
        $this->DeltaLossRound = $DeltaLossRound;
    }

    /**
     * @return mixed
     */
    public function getDeltaLossRound()
    {
        return $this->DeltaLossRound;
    }

    /**
     * @param mixed $DeltaMoney
     */
    public function setDeltaMoney($DeltaMoney)
    {
        $this->DeltaMoney = $DeltaMoney;
    }

    /**
     * @return mixed
     */
    public function getDeltaMoney()
    {
        return $this->DeltaMoney;
    }

    /**
     * @param mixed $DeltaServiceFare
     */
    public function setDeltaServiceFare($DeltaServiceFare)
    {
        $this->DeltaServiceFare = $DeltaServiceFare;
    }

    /**
     * @return mixed
     */
    public function getDeltaServiceFare()
    {
        return $this->DeltaServiceFare;
    }

    /**
     * @param mixed $DeltaServiceFareHappyBean
     */
    public function setDeltaServiceFareHappyBean($DeltaServiceFareHappyBean)
    {
        $this->DeltaServiceFareHappyBean = $DeltaServiceFareHappyBean;
    }

    /**
     * @return mixed
     */
    public function getDeltaServiceFareHappyBean()
    {
        return $this->DeltaServiceFareHappyBean;
    }

    /**
     * @param mixed $DeltaWinRound
     */
    public function setDeltaWinRound($DeltaWinRound)
    {
        $this->DeltaWinRound = $DeltaWinRound;
    }

    /**
     * @return mixed
     */
    public function getDeltaWinRound()
    {
        return $this->DeltaWinRound;
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
     * @param mixed $GamePara
     */
    public function setGamePara($GamePara)
    {
        $this->GamePara = $GamePara;
    }

    /**
     * @return mixed
     */
    public function getGamePara()
    {
        return $this->GamePara;
    }

    /**
     * @param mixed $GameSeconds
     */
    public function setGameSeconds($GameSeconds)
    {
        $this->GameSeconds = $GameSeconds;
    }

    /**
     * @return mixed
     */
    public function getGameSeconds()
    {
        return $this->GameSeconds;
    }

    /**
     * @param mixed $GameTag
     */
    public function setGameTag($GameTag)
    {
        $this->GameTag = $GameTag;
    }

    /**
     * @return mixed
     */
    public function getGameTag()
    {
        return $this->GameTag;
    }

    /**
     * @param mixed $Port
     */
    public function setPort($Port)
    {
        $this->Port = $Port;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->Port;
    }

    /**
     * @param mixed $RoomActiveID
     */
    public function setRoomActiveID($RoomActiveID)
    {
        $this->RoomActiveID = $RoomActiveID;
    }

    /**
     * @return mixed
     */
    public function getRoomActiveID()
    {
        return $this->RoomActiveID;
    }

    /**
     * @param mixed $RoomBillFlag
     */
    public function setRoomBillFlag($RoomBillFlag)
    {
        $this->RoomBillFlag = $RoomBillFlag;
    }

    /**
     * @return mixed
     */
    public function getRoomBillFlag()
    {
        return $this->RoomBillFlag;
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
     * @param mixed $SourceIP
     */
    public function setSourceIP($SourceIP)
    {
        $this->SourceIP = $SourceIP;
    }

    /**
     * @return mixed
     */
    public function getSourceIP()
    {
        return $this->SourceIP;
    }

    /**
     * @param mixed $TableID
     */
    public function setTableID($TableID)
    {
        $this->TableID = $TableID;
    }

    /**
     * @return mixed
     */
    public function getTableID()
    {
        return $this->TableID;
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