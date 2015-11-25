<?php
/**
 *
 *
 * Author: snake
 * Date: 14-10-12
 * Time: 下午8:31
 * Denpend:
 */




class CSNotifyPresentHappyBean
{
    public $Uin;
    public $PresentMode;
    public $PresentedCount;
    public $LastPresentedTime;
    public $CurHappyBean;
    public $PlayerCommonInfoMiscFlag; #stPlayerCommonInfo中的misc flag

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer
            ->EncodeInt32($this->Uin);

        $this->buffer->EncodeInt16($this->PresentMode)
            ->EncodeInt32($this->PresentedCount)
            ->EncodeInt32($this->LastPresentedTime)
            ->EncodeInt64($this->CurHappyBean)
            ->EncodeInt32($this->PlayerCommonInfoMiscFlag);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();

        $this->PresentMode = $this->buffer->DecodeInt16();
        $this->PresentedCount = $this->buffer->DecodeInt32();
        $this->LastPresentedTime = $this->buffer->DecodeInt32();
        $this->CurHappyBean = $this->buffer->DecodeInt64();
        $this->PlayerCommonInfoMiscFlag = $this->buffer->DecodeInt32();

        return $this;
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