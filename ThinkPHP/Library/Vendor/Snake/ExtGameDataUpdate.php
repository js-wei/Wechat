<?php
/**
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午8:28
 */




class ExtGameDataUpdate
{
    public $ExtIndex;
    public $UpdateMode;
    public $ExtVal;

    public function getLength()
    {
        return 2 + 1 + 4 + 2;
    }

    public function Encode(CodeEngine &$buf)
    {
        $buf->EncodeInt16($this->getLength())
            ->EncodeInt16($this->ExtIndex)
            ->EncodeInt8($this->UpdateMode)
            ->EncodeInt32($this->ExtVal);

        return $this;
    }

    public function Decode(CodeEngine &$buf)
    {
        $length = $buf->DecodeInt16();
        $this->ExtIndex = $buf->DecodeInt16();
        $this->UpdateMode = $buf->DecodeInt8();
        $this->ExtVal = $buf->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $ExtIndex
     */
    public function setExtIndex($ExtIndex)
    {
        $this->ExtIndex = $ExtIndex;
    }

    /**
     * @return mixed
     */
    public function getExtIndex()
    {
        return $this->ExtIndex;
    }

    /**
     * @param mixed $ExtVal
     */
    public function setExtVal($ExtVal)
    {
        $this->ExtVal = $ExtVal;
    }

    /**
     * @return mixed
     */
    public function getExtVal()
    {
        return $this->ExtVal;
    }

    /**
     * @param mixed $UpdateMode
     */
    public function setUpdateMode($UpdateMode)
    {
        $this->UpdateMode = $UpdateMode;
    }

    /**
     * @return mixed
     */
    public function getUpdateMode()
    {
        return $this->UpdateMode;
    }
} 