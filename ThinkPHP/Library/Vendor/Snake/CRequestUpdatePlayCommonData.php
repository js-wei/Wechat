<?php
/**
 * SS_MSG_UPDATE_PLAY_COMMON_DATA
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午7:30
 */




class CRequestUpdatePlayCommonData
{
    public $SrcUin;
    public $SrcAccount;
    public $DstUin;
    public $DstAccount;

    public $DataCount;
    public $DeltaData; #PCD_MAX_DATA_NUMBER
    public $TransparentDataSize;
    public $TransparentData; #max_transparent_data_size
    public $TransTag; #max_game_tag_length
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

        $this->buffer->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->DstUin)
            ->EncodeString($this->DstAccount)
            ->EncodeInt16($this->DataCount);

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->DeltaData[$i]->Encode($this->buffer);
        }

        $this->buffer->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->NofifyTransparentDataSize)
            ->EncodeMemory($this->NofifyTransparentData, $this->NofifyTransparentDataSize);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->DstUin = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->DataCount = $this->buffer->DecodeInt16();


        for ($i = 0; $i < $this->DataCount; $i++) {
            $temp = new PlayerCommonData();
            $this->DeltaData[] = $temp->Decode($this->buffer);
        }

        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->TransparentDataSize > max_transparent_data_size) {
            return false;
        }

        if ($this->TransparentDataSize > 0) {
            $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        }

        $this->TransTag = $this->buffer->DecodeString();
        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->NofifyTransparentDataSize > max_sub_message_size) {
            return false;
        }

        if ($this->NofifyTransparentDataSize > 0) {
            $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);
        }
    }

    /**
     * @param mixed $DataCount
     */
    public function setDataCount($DataCount)
    {
        $this->DataCount = $DataCount;
    }

    /**
     * @return mixed
     */
    public function getDataCount()
    {
        return $this->DataCount;
    }

    /**
     * @param mixed $DeltaData
     */
    public function setDeltaData($DeltaData)
    {
        $this->DeltaData = $DeltaData;
    }

    /**
     * @return mixed
     */
    public function getDeltaData()
    {
        return $this->DeltaData;
    }

    /**
     * @param mixed $DstAccount
     */
    public function setDstAccount($DstAccount)
    {
        $this->DstAccount = $DstAccount;
    }

    /**
     * @return mixed
     */
    public function getDstAccount()
    {
        return $this->DstAccount;
    }

    /**
     * @param mixed $DstUin
     */
    public function setDstUin($DstUin)
    {
        $this->DstUin = $DstUin;
    }

    /**
     * @return mixed
     */
    public function getDstUin()
    {
        return $this->DstUin;
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
     * @param mixed $SrcAccount
     */
    public function setSrcAccount($SrcAccount)
    {
        $this->SrcAccount = $SrcAccount;
    }

    /**
     * @return mixed
     */
    public function getSrcAccount()
    {
        return $this->SrcAccount;
    }

    /**
     * @param mixed $SrcUin
     */
    public function setSrcUin($SrcUin)
    {
        $this->SrcUin = $SrcUin;
    }

    /**
     * @return mixed
     */
    public function getSrcUin()
    {
        return $this->SrcUin;
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
     * @param mixed $TransparentData
     */
    public function setTransparentData($TransparentData)
    {
        $this->TransparentData = $TransparentData;
    }

    /**
     * @return mixed
     */
    public function getTransparentData()
    {
        return $this->TransparentData;
    }

    /**
     * @param mixed $TransparentDataSize
     */
    public function setTransparentDataSize($TransparentDataSize)
    {
        $this->TransparentDataSize = $TransparentDataSize;
    }

    /**
     * @return mixed
     */
    public function getTransparentDataSize()
    {
        return $this->TransparentDataSize;
    }


} 