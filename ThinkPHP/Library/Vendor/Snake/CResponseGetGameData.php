<?php
/**
 *
 *
 * User: snake
 * Date: 14-8-26
 * Time: 下午8:29
 */




class CResponseGetGameData
{
    public $ResultID;
    public $Uin;
    public $Account;
    public $HaveBaseInfo;
    public $BaseInfo; # PlayerCommonInfo
    public $IsFirstEnterGame;
    public $GameData; # DBGameData
    public $ServiceData; # ServiceData

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin)
            ->EncodeString($this->Account);

        if ($this->ResultID != CSResultID::result_id_success) {
            $this->buffer->EncodeInt16($this->GameData->GameID);
        }

        $this->buffer->EncodeInt8($this->HaveBaseInfo);
        if ($this->HaveBaseInfo > 0) {
            $this->BaseInfo->Encode($this->buffer);
        }

        $this->buffer->EncodeInt8($this->IsFirstEnterGame);
        $this->GameData->Encode($this->buffer);

        $this->buffer->EncodeInt16($this->ServiceData->Count);

        for ($i = 0; $i < $this->ServiceData->Count; $i++) {
            $this->ServiceData->Service[$i]->Encode($this->buffer);
        }

        return $this;
    }

    /**
     * 总觉得会有逻辑问题
     *
     * @param string $buf
     * @return $this
     */
    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();

        if ($this->ResultID != CSResultID::result_id_success) {
            $this->GameData->GameID = $this->buffer->DecodeInt16();
        }

        $this->HaveBaseInfo = $this->buffer->DecodeInt8();
        if ($this->HaveBaseInfo > 0) {
            $this->BaseInfo->Decode($this->buffer);
        }

        $this->IsFirstEnterGame = $this->buffer->DecodeInt8();
        $this->GameData->Decode($this->buffer);

        $this->ServiceData->Count = $this->buffer->DecodeInt16();
        for ($i = 0; $i < $this->ServiceData->Count; $i++) {
            $this->ServiceData->Service[$i]->Decode($this->buffer);
        }

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
     * @param mixed $BaseInfo
     */
    public function setBaseInfo($BaseInfo)
    {
        $this->BaseInfo = $BaseInfo;
    }

    /**
     * @return mixed
     */
    public function getBaseInfo()
    {
        return $this->BaseInfo;
    }

    /**
     * @param mixed $GameData
     */
    public function setGameData($GameData)
    {
        $this->GameData = $GameData;
    }

    /**
     * @return mixed
     */
    public function getGameData()
    {
        return $this->GameData;
    }

    /**
     * @param mixed $HaveBaseInfo
     */
    public function setHaveBaseInfo($HaveBaseInfo)
    {
        $this->HaveBaseInfo = $HaveBaseInfo;
    }

    /**
     * @return mixed
     */
    public function getHaveBaseInfo()
    {
        return $this->HaveBaseInfo;
    }

    /**
     * @param mixed $IsFirstEnterGame
     */
    public function setIsFirstEnterGame($IsFirstEnterGame)
    {
        $this->IsFirstEnterGame = $IsFirstEnterGame;
    }

    /**
     * @return mixed
     */
    public function getIsFirstEnterGame()
    {
        return $this->IsFirstEnterGame;
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
     * @param mixed $ServiceData
     */
    public function setServiceData($ServiceData)
    {
        $this->ServiceData = $ServiceData;
    }

    /**
     * @return mixed
     */
    public function getServiceData()
    {
        return $this->ServiceData;
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