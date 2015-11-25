<?php
/**
 * 获取玩家所有的游戏数据
 *
 * User: snake
 * Date: 14-9-10
 * Time: 下午9:55
 */




class CResponseGetPlayerAllGameData
{
    public $ResultId;
    public $Uin;
    public $GameDataCount;
    public $GameData; # DBGameData

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultId)
            ->EncodeInt32($this->Uin)
            ->EncodeInt16($this->GameDataCount);

        if ($this->ResultId == CSResultID::result_id_success) {

            for ($i = 0; $i < $this->GameDataCount; $i++) {
                $this->GameData[$i]->Encode($this->buffer);
            }
        }
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultId = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->GameDataCount = $this->buffer->DecodeInt16();

        if ($this->ResultId == CSResultID::result_id_success) {
            for ($i = 0; $i < $this->GameDataCount; $i++) {
                $temp = new DBGameData();
                $temp->Decode($this->buffer);
                $this->GameData[] = $temp;
            }
        }

        return $this;
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
     * @param mixed $GameDataCount
     */
    public function setGameDataCount($GameDataCount)
    {
        $this->GameDataCount = $GameDataCount;
    }

    /**
     * @return mixed
     */
    public function getGameDataCount()
    {
        return $this->GameDataCount;
    }

    /**
     * @param mixed $ResultId
     */
    public function setResultId($ResultId)
    {
        $this->ResultId = $ResultId;
    }

    /**
     * @return mixed
     */
    public function getResultId()
    {
        return $this->ResultId;
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