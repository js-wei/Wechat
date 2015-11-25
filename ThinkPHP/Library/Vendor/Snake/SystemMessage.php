<?php
/**
 * 系统消息
 *
 * Author: snake
 * Date: 14-4-27
 * Time: 下午5:32
 * Denpend:
 */




class SystemMessage
{
    public $LowVersion;
    public $HighVersion;
    public $Size;
    public $Message;

    public function Encode(CodeEngine &$buf)
    {
        #$UnitSize = 2 + 4 + 4 + 2 + strlen($this->Message);
        //unit size 不包含自身的2个字节
        $UnitSize = 4 + 4 + 2 + strlen($this->Message);

        $buf->EncodeInt16($UnitSize)
            ->EncodeInt32($this->LowVersion)
            ->EncodeInt32($this->HighVersion)
            ->EncodeInt16($this->Size);
        if ($this->Size > strlen($this->Message)) {
            $this->Size = strlen($this->Message);
        }

        $buf->EncodeMemory($this->Message, $this->Size);

        return $UnitSize;
    }

    /**
     * @param mixed $HighVersion
     */
    public function setHighVersion($HighVersion)
    {
        $this->HighVersion = $HighVersion;
    }

    /**
     * @return mixed
     */
    public function getHighVersion()
    {
        return $this->HighVersion;
    }

    /**
     * @param mixed $LowVersion
     */
    public function setLowVersion($LowVersion)
    {
        $this->LowVersion = $LowVersion;
    }

    /**
     * @return mixed
     */
    public function getLowVersion()
    {
        return $this->LowVersion;
    }

    /**
     * @param mixed $Message
     */
    public function setMessage($Message)
    {
        $this->Message = $Message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->Message;
    }

    /**
     * @param mixed $Size
     */
    public function setSize($Size)
    {
        $this->Size = $Size;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->Size;
    }

    /**
     * @param mixed $UnitSize
     */
    public function setUnitSize($UnitSize)
    {
        $this->UnitSize = $UnitSize;
    }

    /**
     * @return mixed
     */
    public function getUnitSize()
    {
        return $this->UnitSize;
    }


} 