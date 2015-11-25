<?php
/**
 * CResponseGetOtherUserInfo
 *
 * User: snake
 * Date: 14-9-10
 * Time: 下午8:39
 */




class CResponseGetOtherUserInfo
{
    public $ResultID;
    public $Uin;
    public $Charming;
    public $Achievement;
    public $ResultStr;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->Uin);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->buffer->EncodeInt32($this->Charming)
                ->EncodeInt32($this->Achievement);
        } else {
            $this->buffer->EncodeString($this->ResultStr);
        }
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResultID = $this->buffer->DecodeInt16();
        $this->Achievement = $this->buffer->DecodeInt32();

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->Charming = $this->buffer->DecodeInt32();
            $this->Achievement = $this->buffer->DecodeInt32();
        } else {
            $this->ResultStr = $this->buffer->DecodeString();
        }
    }

    /**
     * @param mixed $Achievement
     */
    public function setAchievement($Achievement)
    {
        $this->Achievement = $Achievement;
    }

    /**
     * @return mixed
     */
    public function getAchievement()
    {
        return $this->Achievement;
    }

    /**
     * @param mixed $Charming
     */
    public function setCharming($Charming)
    {
        $this->Charming = $Charming;
    }

    /**
     * @return mixed
     */
    public function getCharming()
    {
        return $this->Charming;
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
     * @param mixed $ResultStr
     */
    public function setResultStr($ResultStr)
    {
        $this->ResultStr = $ResultStr;
    }

    /**
     * @return mixed
     */
    public function getResultStr()
    {
        return $this->ResultStr;
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