<?php
/**
 * SS_MSG_UPDATE_GAME_CONFIG
 * GameID 没有编码这个参数
 *
 * User: snake
 * Date: 14-9-1
 * Time: 下午9:40
 */




class CRequestUpdateGameConfig
{
    public $Uin;
    public $GameID;
    public $GameConfig;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin);
        $this->GameConfig->Encode($this->buffer);

    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameConfig = new PlayerGameConfig();
        $this->GameConfig = $this->GameConfig->Decode($this->buffer);
    }

    /**
     * @param mixed $GameConfig
     */
    public function setGameConfig(PlayerGameConfig $GameConfig)
    {
        $this->GameConfig = $GameConfig;
    }

    /**
     * @return mixed
     */
    public function getGameConfig()
    {
        return $this->GameConfig;
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