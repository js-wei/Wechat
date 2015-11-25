<?php
/**
 *
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午8:30
 */




class CRequestUpdateGameExtInfo
{
    public $Uin;
    public $GameID;
    public $UpdateIntCount;
    public $UpdateGameData; #class ExtGameDataUpdate 约束max_game_ext_int_count
    public $ExtDataSize;
    public $ExtData; #max_game_ext_data_size
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
            ->EncodeInt16($this->UpdateIntCount);

        for ($i = 0; $i < $this->UpdateIntCount && $i < max_game_ext_int_count; $i++) {
            $this->UpdateGameData[$i]->Encode($this->buffer);
        }

        $this->buffer
            ->EncodeInt16($this->ExtDataSize)
            ->EncodeMemory($this->ExtData, $this->ExtDataSize)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();
        $this->UpdateIntCount = $this->buffer->DecodeInt16();


        for ($i = 0; $i < $this->UpdateIntCount && $i < max_game_ext_int_count; $i++) {
            $temp = new ExtGameDataUpdate();
            $this->UpdateGameData[] = $temp->Decode($this->buffer);
        }

        $this->ExtDataSize = $this->buffer->DecodeInt16();

        if ($this->ExtDataSize > max_game_ext_data_size) {
            return false;
        }

        if ($this->ExtDataSize > 0) {
            $this->ExtData = $this->buffer->DecodeMemory($this->ExtDataSize);
        }

        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->TransparentDataSize > max_transparent_data_size) {
            return false;
        }

        if ($this->TransparentDataSize > 0) {
            $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        }
    }

    /**
     * @param mixed $ExtData
     */
    public function setExtData($ExtData)
    {
        $this->ExtData = $ExtData;
    }

    /**
     * @return mixed
     */
    public function getExtData()
    {
        return $this->ExtData;
    }

    /**
     * @param mixed $ExtDataSize
     */
    public function setExtDataSize($ExtDataSize)
    {
        $this->ExtDataSize = $ExtDataSize;
    }

    /**
     * @return mixed
     */
    public function getExtDataSize()
    {
        return $this->ExtDataSize;
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

    /**
     * @param mixed $UpdateGameData
     */
    public function setUpdateGameData($UpdateGameData)
    {
        $this->UpdateGameData = $UpdateGameData;
    }

    /**
     * @return mixed
     */
    public function getUpdateGameData()
    {
        return $this->UpdateGameData;
    }

    /**
     * @param mixed $UpdateIntCount
     */
    public function setUpdateIntCount($UpdateIntCount)
    {
        $this->UpdateIntCount = $UpdateIntCount;
    }

    /**
     * @return mixed
     */
    public function getUpdateIntCount()
    {
        return $this->UpdateIntCount;
    }
} 