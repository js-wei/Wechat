<?php
/**
 * 请求获得玩家物品信息
 *
 * User: snake
 * Date: 14-8-12
 * Time: 下午9:30
 */



class CReqeustGetPlayerItemData
{
    public $UIN;
    public $DataSize;
    public $TransparentData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->UIN)
            ->EncodeInt32($this->DataSize)
            ->EncodeMemory($this->DataSize, $this->TransparentData);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->UIN = $this->buffer->DecodeInt32();
        $this->DataSize = $this->buffer->DecodeInt32();
        $this->TransparentData = $this->buffer->DecodeMemory($this->DataSize);

        return $this;
    }

    /**
     * @param mixed $DataSize
     */
    public function setDataSize($DataSize)
    {
        $this->DataSize = $DataSize;
    }

    /**
     * @return mixed
     */
    public function getDataSize()
    {
        return $this->DataSize;
    }

    /**
     * @param mixed $TransparentData
     */
    public function setTransparentData($TransparentData)
    {
        $this->TransparentData = $TransparentData;
    }

    /**
     * @return mixed
     */
    public function getTransparentData()
    {
        return $this->TransparentData;
    }

    /**
     * @param mixed $UIN
     */
    public function setUIN($UIN)
    {
        $this->UIN = $UIN;
    }

    /**
     * @return mixed
     */
    public function getUIN()
    {
        return $this->UIN;
    }
}