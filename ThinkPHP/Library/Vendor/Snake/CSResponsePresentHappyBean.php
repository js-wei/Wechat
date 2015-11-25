<?php
/**
 *
 *
 * Author: snake
 * Date: 14-10-12
 * Time: 下午8:04
 * Denpend:
 */




class CSResponsePresentHappyBean
{

    public $ResultID;

    public $Uin;
    public $RoomID;
    public $GameID; # 为账单而增加的
    public $PresentMode;
    public $PresentedCount;
    public $LastPresentedTime;
    public $CurHappyBean;
    public $DeltaHappyBean;
    public $PlayerCommonInfoMiscFlag; #stPlayerCommonInfo中的misc flag
    public $ACT; # 异步完成标记，对平台透明的数据，由游戏对象维护
    public $TransTag; #max_game_tag_length

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
            ->EncodeInt32($this->Uin)
            ->EncodeInt32($this->RoomID)
            ->EncodeInt16($this->GameID)
            ->EncodeInt32($this->ACT)
            ->EncodeString($this->TransTag);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->buffer->EncodeInt16($this->PresentMode)
                ->EncodeInt32($this->PresentedCount)
                ->EncodeInt32($this->LastPresentedTime)
                ->EncodeInt64($this->CurHappyBean)
                ->EncodeInt64($this->DeltaHappyBean)
                ->EncodeInt32($this->PlayerCommonInfoMiscFlag);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->RoomID = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->ACT = $this->buffer->DecodeInt32();
        $this->TransTag = $this->buffer->DecodeString();

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->PresentMode = $this->buffer->DecodeInt16();
            $this->PresentedCount = $this->buffer->DecodeInt32();
            $this->LastPresentedTime = $this->buffer->DecodeInt32();
            $this->CurHappyBean = $this->buffer->DecodeInt64();
            $this->DeltaHappyBean = $this->buffer->DecodeInt64();
            $this->PlayerCommonInfoMiscFlag = $this->buffer->DecodeInt32();
        }

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
     * @param mixed $CurHappyBean
     */
    public function setCurHappyBean($CurHappyBean)
    {
        $this->CurHappyBean = $CurHappyBean;
    }

    /**
     * @return mixed
     */
    public function getCurHappyBean()
    {
        return $this->CurHappyBean;
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
     * @param mixed $LastPresentedTime
     */
    public function setLastPresentedTime($LastPresentedTime)
    {
        $this->LastPresentedTime = $LastPresentedTime;
    }

    /**
     * @return mixed
     */
    public function getLastPresentedTime()
    {
        return $this->LastPresentedTime;
    }

    /**
     * @param mixed $PlayerCommonInfoMiscFlag
     */
    public function setPlayerCommonInfoMiscFlag($PlayerCommonInfoMiscFlag)
    {
        $this->PlayerCommonInfoMiscFlag = $PlayerCommonInfoMiscFlag;
    }

    /**
     * @return mixed
     */
    public function getPlayerCommonInfoMiscFlag()
    {
        return $this->PlayerCommonInfoMiscFlag;
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
     * @param mixed $PresentedCount
     */
    public function setPresentedCount($PresentedCount)
    {
        $this->PresentedCount = $PresentedCount;
    }

    /**
     * @return mixed
     */
    public function getPresentedCount()
    {
        return $this->PresentedCount;
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