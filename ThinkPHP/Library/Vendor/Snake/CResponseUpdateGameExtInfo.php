<?php
/**
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午8:59
 */




class CResponseUpdateGameExtInfo
{
    public $Uin;
    public $GameID;
    public $ResultID;
    public $CurrentExtGameInfo; #class TDBExtGameInfo
    public $TransparentDataSize;
    public $TransparentData; #max_transparent_data_size

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
            ->EncodeInt16($this->ResultID);

        $this->CurrentExtGameInfo->Encode($this->buffer);

        $this->buffer
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->ResultID = $this->buffer->DecodeInt16();


        $temp = new TDBExtGameInfo();
        $temp->Decode($this->buffer);
        $this->CurrentExtGameInfo = $temp;

        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->TransparentDataSize > max_transparent_data_size) {
            return false;
        }

        if ($this->TransparentDataSize > 0) {
            $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        }
    }

    /**
     * @param mixed $CurrentExtGameInfo
     */
    public function setCurrentExtGameInfo($CurrentExtGameInfo)
    {
        $this->CurrentExtGameInfo = $CurrentExtGameInfo;
    }

    /**
     * @return mixed
     */
    public function getCurrentExtGameInfo()
    {
        return $this->CurrentExtGameInfo;
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