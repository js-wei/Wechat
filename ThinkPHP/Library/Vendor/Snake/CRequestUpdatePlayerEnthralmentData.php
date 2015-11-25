<?php
/**
 * SS_MSG_UPDATE_PLAYER_ENTHRALMENTDATA
 *
 * Author: snake
 * Date: 14-10-10
 * Time: 下午9:48
 * Denpend:
 */




class CRequestUpdatePlayerEnthralmentData
{
    public $Uin;
    public $CumulativeOnLine;
    public $CumulativeOffLine;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeInt32($this->CumulativeOnLine)
            ->EncodeInt32($this->CumulativeOffLine);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->CumulativeOnLine = $this->buffer->DecodeInt32();
        $this->CumulativeOffLine = $this->buffer->DecodeInt32();
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