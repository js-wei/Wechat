<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午7:41
 */




class CResponseGetPlayerEnthralmentData
{
    public $Uin;
    public $ResultID;
    public $IDCard;
    public $CumulativeOnLine;
    public $CumulativeOffLine;
    public $LastOffline;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt16($this->ResultID);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->buffer->EncodeString($this->IDCard)
                ->EncodeInt32($this->CumulativeOnLine)
                ->EncodeInt32($this->CumulativeOffLine)
                ->EncodeInt32($this->LastOffline);
        }
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->ResultID = $this->buffer->DecodeInt16();

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->IDCard = $this->buffer->DecodeString();
            $this->CumulativeOnLine = $this->buffer->DecodeInt32();
            $this->CumulativeOffLine = $this->buffer->DecodeInt32();
            $this->LastOffline = $this->buffer->DecodeInt32();
        }
    }

    /**
     * @param mixed $CumulativeOffLine
     */
    public function setCumulativeOffLine($CumulativeOffLine)
    {
        $this->CumulativeOffLine = $CumulativeOffLine;
    }

    /**
     * @return mixed
     */
    public function getCumulativeOffLine()
    {
        return $this->CumulativeOffLine;
    }

    /**
     * @param mixed $CumulativeOnLine
     */
    public function setCumulativeOnLine($CumulativeOnLine)
    {
        $this->CumulativeOnLine = $CumulativeOnLine;
    }

    /**
     * @return mixed
     */
    public function getCumulativeOnLine()
    {
        return $this->CumulativeOnLine;
    }

    /**
     * @param mixed $IDCard
     */
    public function setIDCard($IDCard)
    {
        $this->IDCard = $IDCard;
    }

    /**
     * @return mixed
     */
    public function getIDCard()
    {
        return $this->IDCard;
    }

    /**
     * @param mixed $LastOffline
     */
    public function setLastOffline($LastOffline)
    {
        $this->LastOffline = $LastOffline;
    }

    /**
     * @return mixed
     */
    public function getLastOffline()
    {
        return $this->LastOffline;
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