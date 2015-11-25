<?php
/**
 * 通知刷新游戏点
 *
 * User: snake
 * Date: 14-8-31
 * Time: 下午9:56
 */




class CNotifyRefreshGamePoint
{
    public $Uin;
    public $GameID;

    public $GamePoint;
    public $WinRound;
    public $LossRound;
    public $DrawRound;
    public $EscapeRound;
    public $Money;
    public $HappyBean;
    public $Charming;
    public $Achievement;
    public $NofifyTransparentDataSize;
    public $NofifyTransparentData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->GamePoint)
            ->EncodeInt32($this->WinRound)
            ->EncodeInt32($this->LossRound)
            ->EncodeInt32($this->DrawRound)
            ->EncodeInt32($this->EscapeRound)
            ->EncodeInt32($this->Money)
            ->EncodeInt64($this->HappyBean)
            ->EncodeInt32($this->Charming)
            ->EncodeInt32($this->Achievement)
            ->EncodeInt16($this->NofifyTransparentDataSize)
            ->EncodeMemory($this->NofifyTransparentData, $this->NofifyTransparentDataSize);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->GamePoint = $this->buffer->DecodeInt32();
        $this->WinRound = $this->buffer->DecodeInt32();
        $this->LossRound = $this->buffer->DecodeInt32();
        $this->DrawRound = $this->buffer->DecodeInt32();
        $this->EscapeRound = $this->buffer->DecodeInt32();
        $this->Money = $this->buffer->DecodeInt64();
        $this->HappyBean = $this->buffer->DecodeInt32();
        $this->Charming = $this->buffer->DecodeInt32();
        $this->Achievement = $this->buffer->DecodeInt32();
        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt16();
        $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);
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
     * @param mixed $NofifyTransparentData
     */
    public function setNofifyTransparentData($NofifyTransparentData)
    {
        $this->NofifyTransparentData = $NofifyTransparentData;
    }

    /**
     * @return mixed
     */
    public function getNofifyTransparentData()
    {
        return $this->NofifyTransparentData;
    }

    /**
     * @param mixed $NofifyTransparentDataSize
     */
    public function setNofifyTransparentDataSize($NofifyTransparentDataSize)
    {
        $this->NofifyTransparentDataSize = $NofifyTransparentDataSize;
    }

    /**
     * @return mixed
     */
    public function getNofifyTransparentDataSize()
    {
        return $this->NofifyTransparentDataSize;
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