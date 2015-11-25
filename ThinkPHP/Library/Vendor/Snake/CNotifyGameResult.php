<?php
/**
 * action server使用
 *
 * User: snake
 * Date: 14-9-1
 * Time: 下午7:58
 */




class CNotifyGameResult
{
    public $Uin;
    public $Account;

    public $GameID;
    public $RoomID;
    public $TableID;

    # 更新后的数据
    public $GamePoint;
    public $WinRound;
    public $LossRound;
    public $DrawRound;
    public $EscapeRound;
    public $Money;
    public $MoneyChg;
    public $HappyBean;
    public $HappyBeanChg;

    # 请求数据变化量
    public $DeltaGamePoint;
    public $DeltaWinRound;
    public $DeltaLossRound;
    public $DeltaDrawRound;
    public $DeltaEscapeRound;
    public $DeltaMoney;
    public $DeltaHappyBean;

    public $DeltaGameSeconds;
    public $TotalGameSeconds;

    public $HallServerId;
    public $HallServerPlayerId;

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
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID)
            ->EncodeInt32($this->GamePoint)
            ->EncodeInt32($this->WinRound)
            ->EncodeInt32($this->LossRound)
            ->EncodeInt32($this->DrawRound)
            ->EncodeInt32($this->EscapeRound)
            ->EncodeInt32($this->Money)
            ->EncodeInt32($this->MoneyChg)
            ->EncodeInt64($this->HappyBean)
            ->EncodeInt64($this->HappyBeanChg)
            ->EncodeInt32($this->DeltaGamePoint)
            ->EncodeInt32($this->DeltaWinRound)
            ->EncodeInt32($this->DeltaLossRound)
            ->EncodeInt32($this->DeltaDrawRound)
            ->EncodeInt32($this->DeltaEscapeRound)
            ->EncodeInt32($this->DeltaMoney)
            ->EncodeInt64($this->DeltaHappyBean)
            ->EncodeInt32($this->DeltaGameSeconds)
            ->EncodeInt32($this->TotalGameSeconds)
            ->EncodeInt32($this->HallServerId)
            ->EncodeInt32($this->HallServerPlayerId);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeString();
        $this->Account = $this->buffer->DecodeString();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->TableID = $this->buffer->DecodeInt32();

        $this->GamePoint = $this->buffer->DecodeInt32();
        $this->WinRound = $this->buffer->DecodeInt32();
        $this->LossRound = $this->buffer->DecodeInt32();
        $this->DrawRound = $this->buffer->DecodeInt32();
        $this->EscapeRound = $this->buffer->DecodeInt32();
        $this->Money = $this->buffer->DecodeInt32();
        $this->MoneyChg = $this->buffer->DecodeInt32();
        $this->HappyBean = $this->buffer->DecodeInt64();
        $this->HappyBeanChg = $this->buffer->DecodeInt64();

        $this->DeltaGamePoint = $this->buffer->DecodeInt32();
        $this->DeltaWinRound = $this->buffer->DecodeInt32();
        $this->DeltaLossRound = $this->buffer->DecodeInt32();
        $this->DeltaDrawRound = $this->buffer->DecodeInt32();
        $this->DeltaEscapeRound = $this->buffer->DecodeInt32();
        $this->DeltaMoney = $this->buffer->DecodeInt32();
        $this->DeltaHappyBean = $this->buffer->DecodeInt64();
        $this->DeltaGameSeconds = $this->buffer->DecodeInt32();

        $this->TotalGameSeconds = $this->buffer->DecodeInt32();
        $this->HallServerId = $this->buffer->DecodeInt32();
        $this->HallServerPlayerId = $this->buffer->DecodeInt32();

        return $this;
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
     * @param mixed $DeltaGameSeconds
     */
    public function setDeltaGameSeconds($DeltaGameSeconds)
    {
        $this->DeltaGameSeconds = $DeltaGameSeconds;
    }

    /**
     * @return mixed
     */
    public function getDeltaGameSeconds()
    {
        return $this->DeltaGameSeconds;
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
     * @param mixed $DrawRound
     */
    public function setDrawRound($DrawRound)
    {
        $this->DrawRound = $DrawRound;
    }

    /**
     * @return mixed
     */
    public function getDrawRound()
    {
        return $this->DrawRound;
    }

    /**
     * @param mixed $EscapeRound
     */
    public function setEscapeRound($EscapeRound)
    {
        $this->EscapeRound = $EscapeRound;
    }

    /**
     * @return mixed
     */
    public function getEscapeRound()
    {
        return $this->EscapeRound;
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
     * @param mixed $GamePoint
     */
    public function setGamePoint($GamePoint)
    {
        $this->GamePoint = $GamePoint;
    }

    /**
     * @return mixed
     */
    public function getGamePoint()
    {
        return $this->GamePoint;
    }

    /**
     * @param mixed $HallServerId
     */
    public function setHallServerId($HallServerId)
    {
        $this->HallServerId = $HallServerId;
    }

    /**
     * @return mixed
     */
    public function getHallServerId()
    {
        return $this->HallServerId;
    }

    /**
     * @param mixed $HallServerPlayerId
     */
    public function setHallServerPlayerId($HallServerPlayerId)
    {
        $this->HallServerPlayerId = $HallServerPlayerId;
    }

    /**
     * @return mixed
     */
    public function getHallServerPlayerId()
    {
        return $this->HallServerPlayerId;
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
     * @param mixed $HappyBeanChg
     */
    public function setHappyBeanChg($HappyBeanChg)
    {
        $this->HappyBeanChg = $HappyBeanChg;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanChg()
    {
        return $this->HappyBeanChg;
    }

    /**
     * @param mixed $LossRound
     */
    public function setLossRound($LossRound)
    {
        $this->LossRound = $LossRound;
    }

    /**
     * @return mixed
     */
    public function getLossRound()
    {
        return $this->LossRound;
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
     * @param mixed $MoneyChg
     */
    public function setMoneyChg($MoneyChg)
    {
        $this->MoneyChg = $MoneyChg;
    }

    /**
     * @return mixed
     */
    public function getMoneyChg()
    {
        return $this->MoneyChg;
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
     * @param mixed $TotalGameSeconds
     */
    public function setTotalGameSeconds($TotalGameSeconds)
    {
        $this->TotalGameSeconds = $TotalGameSeconds;
    }

    /**
     * @return mixed
     */
    public function getTotalGameSeconds()
    {
        return $this->TotalGameSeconds;
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
     * @param mixed $WinRound
     */
    public function setWinRound($WinRound)
    {
        $this->WinRound = $WinRound;
    }

    /**
     * @return mixed
     */
    public function getWinRound()
    {
        return $this->WinRound;
    }


} 