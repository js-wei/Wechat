<?php
/**
 * SS_MSG_REFRESH_PLAY_COMMON_DATA
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午8:19
 */




class CNotifyRefreshPlayCommonData
{
    public $Uin;
    public $Account;

    public $DataCount;
    public $CurrentData; #PCD_MAX_DATA_NUMBER
    public $NofifyTransparentDataSize;
    public $NofifyTransparentData; #max_sub_message_size

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
            ->EncodeInt16($this->DataCount);

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->CurrentData[$i]->Encode($this->buffer);
        }

        $this->buffer
            ->EncodeInt16($this->NofifyTransparentDataSize)
            ->EncodeMemory($this->NofifyTransparentData, $this->NofifyTransparentDataSize);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->DataCount = $this->buffer->DecodeInt16();


        for ($i = 0; $i < $this->DataCount; $i++) {
            $temp = new PlayerCommonData();
            $this->CurrentData[] = $temp->Decode($this->buffer);
        }

        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->NofifyTransparentDataSize > max_sub_message_size) {
            return false;
        }

        if ($this->NofifyTransparentDataSize > 0) {
            $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);
        }
    }
} 