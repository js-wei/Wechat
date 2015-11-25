<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午8:56
 */




class CNotifyRefreshService
{
    public $Uin;
    public $ServiceData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer
            ->EncodeInt32($this->Uin);

        $this->buffer->EncodeInt32($this->ServiceData->Count);

        for ($i = 0; $i < $this->ServiceData->Count; $i++) {
            $this->ServiceData->Service[$i]->Encode($this->buffer);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->ServiceData->Count = $this->buffer->DecodeString();

        for ($i = 0; $i < $this->ServiceData->Count; $i++) {
            $temp = new Service();
            $temp = $temp->Decode($this->buffer);
            $this->ServiceData->Service[] = $temp;
        }

        return $this;
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