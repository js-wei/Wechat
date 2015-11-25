<?php
/**
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午8:05
 */




class CResponseUpdatePlayCommonData
{
    public $ResultID;
    public $SrcUin;
    public $SrcAccount;
    public $DstUin;
    public $DstAccount;

    public $DataCount;
    public $DeltaData; #PCD_MAX_DATA_NUMBER
    public $CurrentData; #PCD_MAX_DATA_NUMBER
    public $TransparentDataSize;
    public $TransparentData; #max_transparent_data_size
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
            ->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->DstUin)
            ->EncodeString($this->DstAccount)
            ->EncodeInt16($this->DataCount);

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->DeltaData[$i]->Encode($this->buffer);
        }

        if ($this->ResultID == CSResultID::result_id_success) {
            for ($i = 0; $i < $this->DataCount; $i++) {
                $this->CurrentData[$i]->Encode($this->buffer);
            }
        }

        $this->buffer->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize)
            ->EncodeString($this->TransTag);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->DstUin = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->DataCount = $this->buffer->DecodeInt16();


        for ($i = 0; $i < $this->DataCount; $i++) {
            $temp = new PlayerCommonData();
            $this->DeltaData[] = $temp->Decode($this->buffer);
        }

        if ($this->ResultID == CSResultID::result_id_success) {
            $temp = new PlayerCommonData();
            $this->CurrentData[] = $temp->Decode($this->buffer);
        }

        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->TransparentDataSize > max_transparent_data_size) {
            return false;
        }

        if ($this->TransparentDataSize > 0) {
            $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        }

        $this->TransTag = $this->buffer->DecodeString();
    }

    /**
     * @param mixed $CurrentData
     */
    public function setCurrentData($CurrentData)
    {
        $this->CurrentData = $CurrentData;
    }

    /**
     * @return mixed
     */
    public function getCurrentData()
    {
        return $this->CurrentData;
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