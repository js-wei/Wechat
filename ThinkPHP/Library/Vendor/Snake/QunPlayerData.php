<?php
/**
 *
 * User: snake
 * Date: 14-10-15
 * Time: 下午7:36
 */




class QunPlayerData
{
    public $DataType;
    public $Charming;
    public $Achievement;
    public $Money;
    public $HappyBean;
    public $GameResultChange;

    public function Encode(CodeEngine &$buf)
    {
        $buf->EncodeInt8($this->DataType);

        switch ($this->DataType) {
            case QunPlayerDataType::QPD_Type_Charming:
                $buf->EncodeInt32($this->Charming->DeltaValue)
                    ->EncodeInt32($this->Charming->CurrentValue);
                break;

            case QunPlayerDataType::QPD_Type_Achievement:
                $buf->EncodeInt32($this->Achievement->DeltaValue)
                    ->EncodeInt32($this->Achievement->CurrentValue);
                break;

            case QunPlayerDataType::QPD_Type_Money:
                $buf->EncodeInt32($this->Money->DeltaValue)
                    ->EncodeInt32($this->Money->DeltaValue);
                break;

            case QunPlayerDataType::QPD_Type_HappyBean:
                $buf->EncodeInt64($this->HappyBean->DeltaValue)
                    ->EncodeInt64($this->HappyBean->CurrentValue);
                break;

            case QunPlayerDataType::QPD_Type_GameResultChange:
                $buf->EncodeInt32($this->GameResultChange->DeltaGamePoint)
                    ->EncodeInt32($this->GameResultChange->DeltaWinRound)
                    ->EncodeInt32($this->GameResultChange->DeltaLossRound)
                    ->EncodeInt32($this->GameResultChange->DeltaDrawRound)
                    ->EncodeInt32($this->GameResultChange->DeltaEscapeRound)
                    ->EncodeInt32($this->GameResultChange->DeltaCostTime)
                    ->EncodeInt32($this->GameResultChange->GamePoint)
                    ->EncodeInt32($this->GameResultChange->WinRound)
                    ->EncodeInt32($this->GameResultChange->LossRound)
                    ->EncodeInt32($this->GameResultChange->DrawRound)
                    ->EncodeInt32($this->GameResultChange->EscapeRound)
                    ->EncodeInt32($this->GameResultChange->CostTime);
                break;
        }
    }

    public function Decode(CodeEngine &$buf)
    {
        $this->DataType = $buf->DecodeInt8();

        switch ($this->DataType) {
            case QunPlayerDataType::QPD_Type_Charming:

                $this->Charming->DeltaValue = $buf->DecodeInt32();
                $this->Charming->CurrentValue = $buf->DecodeInt32();
                break;

            case QunPlayerDataType::QPD_Type_Achievement:
                $this->Achievement->DeltaValue = $buf->DecodeInt32();
                $this->Achievement->CurrentValue = $buf->DecodeInt32();
                break;

            case QunPlayerDataType::QPD_Type_Money:
                $this->Money->DeltaValue = $buf->DecodeInt32();
                $this->Money->DeltaValue = $buf->DecodeInt32();
                break;

            case QunPlayerDataType::QPD_Type_HappyBean:
                $this->HappyBean->DeltaValue = $buf->DecodeInt32();
                $this->HappyBean->CurrentValue = $buf->DecodeInt32();
                break;

            case QunPlayerDataType::QPD_Type_GameResultChange:
                $this->GameResultChange->DeltaGamePoint = $buf->DecodeInt32();
                $this->GameResultChange->DeltaWinRound = $buf->DecodeInt32();
                $this->GameResultChange->DeltaLossRound = $buf->DecodeInt32();
                $this->GameResultChange->DeltaDrawRound = $buf->DecodeInt32();
                $this->GameResultChange->DeltaEscapeRound = $buf->DecodeInt32();
                $this->GameResultChange->DeltaCostTime = $buf->DecodeInt32();
                $this->GameResultChange->GamePoint = $buf->DecodeInt32();
                $this->GameResultChange->WinRound = $buf->DecodeInt32();
                $this->GameResultChange->LossRound = $buf->DecodeInt32();
                $this->GameResultChange->DrawRound = $buf->DecodeInt32();
                $this->GameResultChange->EscapeRound = $buf->DecodeInt32();
                $this->GameResultChange->CostTime = $buf->DecodeInt32();
                break;
        }

        return $this;
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
     * @param mixed $DataType
     */
    public function setDataType($DataType)
    {
        $this->DataType = $DataType;
    }

    /**
     * @return mixed
     */
    public function getDataType()
    {
        return $this->DataType;
    }

    /**
     * @param mixed $GameResultChange
     */
    public function setGameResultChange($GameResultChange)
    {
        $this->GameResultChange = $GameResultChange;
    }

    /**
     * @return mixed
     */
    public function getGameResultChange()
    {
        return $this->GameResultChange;
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


}
