<?php
/**
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午9:07
 */




class CNotifyRefreshGameExtInfo
{
    public $Uin;
    public $GameID;
    public $CurrentExtGameInfo; #class TDBExtGameInfo

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt16($this->GameID);

        $this->CurrentExtGameInfo->Encode($this->buffer);

    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt16();

        $temp = new TDBExtGameInfo();
        $temp->Decode($this->buffer);
        $this->CurrentExtGameInfo = $temp;
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