<?php
/**
 *
 *
 * User: snake
 * Date: 14-8-31
 * Time: 下午8:50
 */




class CResponseUpdateGamePoint
{

    public $ResultID;
    public $Uin;
    public $Account;
    public $GameTag;
    public $GameID;
    public $RoomID;
    public $TableID;

    public $GamePoint;
    public $WinRound;
    public $LossRound;
    public $DrawRound;
    public $EscapeRound;
    public $Money;
    public $MoneyChg;
    public $HappyBean;
    public $HappyBeanChg; # 实际变更后的值

    public $DeltaGamePoint;
    public $DeltaWinRound;
    public $DeltaLossRound;
    public $DeltaDrawRound;
    public $DeltaEscapeRound;
    public $DeltaMoney;
    public $DeltaHappyBean;
    public $ACT;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin)
            ->EncodeString($this->Account)
            ->EncodeString($this->GameTag)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt32($this->TableID);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->buffer->EncodeInt32($this->GamePoint)
                ->EncodeInt32($this->WinRound)
                ->EncodeInt32($this->LossRound)
                ->EncodeInt32($this->DrawRound)
                ->EncodeInt32($this->EscapeRound)
                ->EncodeInt32($this->Money)
                ->EncodeInt32($this->MoneyChg)
                ->EncodeInt64($this->HappyBean)
                ->EncodeInt64($this->HappyBeanChg);
        }

        $this->buffer->EncodeInt32($this->DeltaGamePoint)
            ->EncodeInt32($this->DeltaWinRound)
            ->EncodeInt32($this->DeltaLossRound)
            ->EncodeInt32($this->DeltaDrawRound)
            ->EncodeInt32($this->DeltaEscapeRound)
            ->EncodeInt32($this->DeltaMoney)
            ->EncodeInt64($this->DeltaHappyBean)
            ->EncodeInt32($this->ACT);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);
        $len = 0;
        $this->ResultID = $this->buffer->DecodeInt16();
        $len += 2;
        $this->Uin = $this->buffer->DecodeInt32();
        $len += 4;
        $this->Account = $this->buffer->DecodeString();
        $len += 2 + strlen($this->Account);
        $this->GameTag = $this->buffer->DecodeString();
        $len += 2 + strlen($this->Account);
        $this->GameID = $this->buffer->DecodeInt16();
        $len += 2;
        $this->RoomID = $this->buffer->DecodeInt32();
        $len += 4;
        $this->TableID = $this->buffer->DecodeInt32();
        $len += 4;

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->GamePoint = $this->buffer->DecodeInt32();
            $len += 4;
            $this->WinRound = $this->buffer->DecodeInt32();
            $len += 4;
            $this->LossRound = $this->buffer->DecodeInt32();
            $len += 4;
            $this->DrawRound = $this->buffer->DecodeInt32();
            $len += 4;
            $this->EscapeRound = $this->buffer->DecodeInt32();
            $len += 4;
            $this->Money = $this->buffer->DecodeInt32();
            $len += 4;
            $this->MoneyChg = $this->buffer->DecodeInt32();
            $len += 4;
            $this->HappyBean = $this->buffer->DecodeInt64();
            $len += 8;
            $this->HappyBeanChg = $this->buffer->DecodeInt64();
            $len += 8;
        }

        $this->DeltaGamePoint = $this->buffer->DecodeInt32();
        $len += 4;
        $this->DeltaWinRound = $this->buffer->DecodeInt32();
        $len += 4;
        $this->DeltaLossRound = $this->buffer->DecodeInt32();
        $len += 4;
        $this->DeltaDrawRound = $this->buffer->DecodeInt32();
        $len += 4;
        $this->DeltaEscapeRound = $this->buffer->DecodeInt32();
        $len += 4;
        $this->DeltaMoney = $this->buffer->DecodeInt32();
        $len += 4;
        $this->DeltaHappyBean = $this->buffer->DecodeInt64();
        $len += 8;
        $this->ACT = $this->buffer->DecodeInt32();
        $len += 4;

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