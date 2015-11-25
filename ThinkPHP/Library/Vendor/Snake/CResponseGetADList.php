<?php
/**
 *
 * User: snake
 * Date: 14-11-16
 * Time: 下午6:07
 */




class CResponseGetADList
{
    public $ResultID;
    public $ADInfoCount;
    public $ADInfo; # class ADInfo
    public $ReasonMessage;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $len = 0;
        $this->ResultID = $this->buffer->DecodeInt16();
        $len += 2;

        if (CSResultID::result_id_success == $this->ResultID) {
            $this->ADInfoCount = $this->buffer->DecodeInt16();
            $len += 2;

            if ($this->ADInfoCount > max_adinfo_count) {
                $this->ADInfoCount = max_adinfo_count;
            }

            $this->ADInfo = array();
            for ($i = 0; $i < $this->ADInfoCount; $i++) {
                $temp = new ADInfo();
                $temp->ADInfoLength = $this->buffer->DecodeInt32();
                $len += 4;
                $temp->ADID = $this->buffer->DecodeInt32();
                $len += 4;
                $temp->StartTime = $this->buffer->DecodeInt32();
                $len += 4;
                $temp->EndTime = $this->buffer->DecodeInt32();
                $len += 4;
                $temp->CycleType = $this->buffer->DecodeInt16();
                $len += 2;
                $temp->URL = $this->buffer->DecodeString();
                $len += 2 + strlen($temp->URL);
                $temp->MacCount = $this->buffer->DecodeInt32();
                $len += 4;
                $temp->State = $this->buffer->DecodeInt16();
                $len += 2;
                $this->ADInfo[] = $temp;
            }
        } else {
            $this->ReasonMessage = $this->buffer->DecodeString();
            $len += 2 + strlen($this->ReasonMessage);
        }

        return $this;
    }

    /**
     * @param mixed $ADInfo
     */
    public function setADInfo($ADInfo)
    {
        $this->ADInfo = $ADInfo;
    }

    /**
     * @return mixed
     */
    public function getADInfo()
    {
        return $this->ADInfo;
    }

    /**
     * @param mixed $ADInfoCount
     */
    public function setADInfoCount($ADInfoCount)
    {
        $this->ADInfoCount = $ADInfoCount;
    }

    /**
     * @return mixed
     */
    public function getADInfoCount()
    {
        return $this->ADInfoCount;
    }

    /**
     * @param mixed $ReasonMessage
     */
    public function setReasonMessage($ReasonMessage)
    {
        $this->ReasonMessage = $ReasonMessage;
    }

    /**
     * @return mixed
     */
    public function getReasonMessage()
    {
        return $this->ReasonMessage;
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


} 