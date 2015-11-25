<?php
/**
 * SS_MSG_NOTIFY_DELETE_PLAYER_REFRENCE
 *
 * User: snake
 * Date: 14-9-4
 * Time: 下午9:10
 */




class CNotifyDeletePlayerRefrence
{
    public $Uin;
    public $DeltaCommnonData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin);
        $this->DeltaCommnonData->Encode($this->buffer);

    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();

        $this->DeltaCommnonData = new PlayerCommonInfo();
        $this->DeltaCommnonData = $this->DeltaCommnonData->Decode($this->buffer);
    }

    /**
     * @param mixed $DeltaCommnonData
     */
    public function setDeltaCommnonData(PlayerCommonInfo $DeltaCommnonData)
    {
        $this->DeltaCommnonData = $DeltaCommnonData;
    }

    /**
     * @return mixed
     */
    public function getDeltaCommnonData()
    {
        return $this->DeltaCommnonData;
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