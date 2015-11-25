<?php
/**
 *
 * User: snake
 * Date: 14-10-13
 * Time: 下午8:47
 */




class CNotifyRefreshHappyBean
{
    public $Uin;
    public $CurrentHappyBean;
    public $HappyBeanChg;
    public $NofifyTransparentDataSize;
    public $NofifyTransparentData; #max_sub_message_size

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
            ->EncodeInt64($this->CurrentHappyBean)
            ->EncodeInt64($this->HappyBeanChg)
            ->EncodeInt16($this->NofifyTransparentDataSize)
            ->EncodeMemory($this->NofifyTransparentData, $this->NofifyTransparentDataSize);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->CurrentHappyBean = $this->buffer->DecodeInt64();
        $this->HappyBeanChg = $this->buffer->DecodeInt64();
        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt16();
        $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);

        return $this;
    }

    /**
     * @param mixed $CurrentHappyBean
     */
    public function setCurrentHappyBean($CurrentHappyBean)
    {
        $this->CurrentHappyBean = $CurrentHappyBean;
    }

    /**
     * @return mixed
     */
    public function getCurrentHappyBean()
    {
        return $this->CurrentHappyBean;
    }

    /**
     * @param mixed $HappyBeanChg
     */
    public function setHappyBeanChg($HappyBeanChg)
    {
        $this->HappyBeanChg = $HappyBeanChg;
    }

    /**
     * @return mixed
     */
    public function getHappyBeanChg()
    {
        return $this->HappyBeanChg;
    }

    /**
     * @param mixed $NofifyTransparentData
     */
    public function setNofifyTransparentData($NofifyTransparentData)
    {
        $this->NofifyTransparentData = $NofifyTransparentData;
    }

    /**
     * @return mixed
     */
    public function getNofifyTransparentData()
    {
        return $this->NofifyTransparentData;
    }

    /**
     * @param mixed $NofifyTransparentDataSize
     */
    public function setNofifyTransparentDataSize($NofifyTransparentDataSize)
    {
        $this->NofifyTransparentDataSize = $NofifyTransparentDataSize;
    }

    /**
     * @return mixed
     */
    public function getNofifyTransparentDataSize()
    {
        return $this->NofifyTransparentDataSize;
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