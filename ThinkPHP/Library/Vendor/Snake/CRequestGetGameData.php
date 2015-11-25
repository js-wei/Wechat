<?php
/**
 * SS_MSG_GETGAMEDATA
 *
 * User: snake
 * Date: 14-8-24
 * Time: 下午9:47
 */




class CRequestGetGameData
{
    public $Uin;
    public $Account;

    public $GameID;
    public $RequireBaseInfo;
    public $AddRefrence;

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
            ->EncodeInt16($this->GameID)
            ->EncodeInt8($this->RequireBaseInfo)
            ->EncodeInt8($this->AddRefrence);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->setUin($this->buffer->DecodeInt32());
        $this->setAccount($this->buffer->DecodeString());
        $this->setGameID($this->buffer->DecodeInt16());
        $this->setRequireBaseInfo($this->buffer->DecodeInt8());
        $this->setAddRefrence($this->buffer->DecodeInt8());

        return $this;
    }

    /**
     * @param mixed $Account
     */
    public function setAccount($Account)
    {
        $this->Account = $Account;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->Account;
    }

    /**
     * @param mixed $AddRefrence
     */
    public function setAddRefrence($AddRefrence)
    {
        $this->AddRefrence = $AddRefrence;
    }

    /**
     * @return mixed
     */
    public function getAddRefrence()
    {
        return $this->AddRefrence;
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
     * @param mixed $RequireBaseInfo
     */
    public function setRequireBaseInfo($RequireBaseInfo)
    {
        $this->RequireBaseInfo = $RequireBaseInfo;
    }

    /**
     * @return mixed
     */
    public function getRequireBaseInfo()
    {
        return $this->RequireBaseInfo;
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