<?php
/**
 *
 * User: snake
 * Date: 14-10-15
 * Time: 下午8:03
 */




class CNotifyPlayerActionData
{
    public $Uin;
    public $Account;
    public $DataCount;
    public $Data; #stPlayerActionData

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
            ->EncodeString($this->Account)
            ->EncodeInt16($this->DataCount);

        for ($i = 0; $i < $this->DataCount; $i++) {
            $this->Data[$i]->Encode($this->buffer);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();

        $this->DataCount = $this->buffer->DecodeInt16();

        for ($i = 0; $i < $this->DataCount; $i++) {
            $temp = new PlayerActionData();
            $temp->Decode($this->buffer);
            $this->Data[] = $temp;
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