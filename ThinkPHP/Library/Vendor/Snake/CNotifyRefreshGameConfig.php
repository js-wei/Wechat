<?php
/**
 * SS_MSG_REFRESH_GAMECONFIG
 *
 * User: snake
 * Date: 14-9-4
 * Time: 下午8:58
 */




class CNotifyRefreshGameConfig
{
    public $Uin;
    public $Time;
    public $GameID;
    public $GameCfg;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt32($this->Time)
            ->EncodeInt32($this->GameID);
        $this->GameCfg->Encode($this->buffer);

    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Time = $this->buffer->DecodeInt32();
        $this->GameID = $this->buffer->DecodeInt32();
        $this->GameCfg = new PlayerGameConfig();
        $this->GameCfg = $this->GameCfg->Decode($this->buffer);
    }

    /**
     * @param mixed $GameCfg
     */
    public function setGameCfg(PlayerGameConfig $GameCfg)
    {
        $this->GameCfg = $GameCfg;
    }

    /**
     * @return mixed
     */
    public function getGameCfg()
    {
        return $this->GameCfg;
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
     * @param mixed $Time
     */
    public function setTime($Time)
    {
        $this->Time = $Time;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->Time;
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