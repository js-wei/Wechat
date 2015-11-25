<?php
/**
 *
 * User: snake
 * Date: 14-10-7
 * Time: 下午8:36
 */




class CResponseGetPlayCommonData
{
    public $Uin;
    public $ResultID;
    public $DataCount;
    public $Data;

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
            $this->buffer->EncodeInt16($this->DataCount);

            for ($i = 0; $i < $this->DataCount; $i++) {
                $this->DataCount[$i]->Encode($this->buffer);
            }
        }
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->ResultID = $this->buffer->DecodeInt16();

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->DataCount = $this->buffer->DecodeInt16();

            for ($i = 0; $i < $this->DataCount; $i++) {
                $temp = new PlayerCommonData();
                $this->DataCount[] = $temp->Decode($this->buffer);
            }
        }
    }

    /**
     * @param mixed $Data
     */
    public function setData($Data)
    {
        $this->Data = $Data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->Data;
    }

    /**
     * @param mixed $DataCount
     */
    public function setDataCount($DataCount)
    {
        $this->DataCount = $DataCount;
    }

    /**
     * @return mixed
     */
    public function getDataCount()
    {
        return $this->DataCount;
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