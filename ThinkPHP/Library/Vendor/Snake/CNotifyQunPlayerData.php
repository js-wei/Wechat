<?php
/**
 *
 *
 * Author: snake
 * Date: 14-10-14
 * Time: 下午9:01
 * Denpend:
 */




class CNotifyQunPlayerData
{
    public $Uin;
    public $WebQunData;
    public $ServiceTag;
    public $DataCount;
    public $Data; #class stQunPlayerData QPD_MAX_DATA_NUMBER

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer
            ->EncodeInt32($this->Uin)
            ->EncodeInt16($this->WebQunData->DataSize)
            ->EncodeMemory($this->WebQunData->WebQunInfo, $this->WebQunData->DataSize)
            ->EncodeInt($this->DataCount);

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->Data[$i]->Encode($this->buffer);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->WebQunData->DataSize = $this->buffer->DecodeInt16();

        if ($this->WebQunData->DataSize > max_web_qun_data_size) {
            $this->WebQunData->DataSize = max_web_qun_data_size;
        }

        $this->WebQunData->WebQunInfo = $this->buffer->DecodeMemory($this->WebQunData->DataSize);

        $this->DataCount = $this->buffer->DecodeInt16();

        if ($this->DataCount > QPD_MAX_DATA_NUMBER) {
            $this->DataCount = QPD_MAX_DATA_NUMBER;
        }

        for ($i = 0; $i < $this->DataCount; $i++) {
            $temp = new QunPlayerData();
            $temp->Decode($this->buffer);
            $this->Data[] = $temp;
        }

        return $this;
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
     * @param mixed $ServiceTag
     */
    public function setServiceTag($ServiceTag)
    {
        $this->ServiceTag = $ServiceTag;
    }

    /**
     * @return mixed
     */
    public function getServiceTag()
    {
        return $this->ServiceTag;
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

    /**
     * @param mixed $WebQunData
     */
    public function setWebQunData($WebQunData)
    {
        $this->WebQunData = $WebQunData;
    }

    /**
     * @return mixed
     */
    public function getWebQunData()
    {
        return $this->WebQunData;
    }

} 