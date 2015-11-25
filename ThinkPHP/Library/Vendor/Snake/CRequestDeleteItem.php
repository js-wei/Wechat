<?php
/**
 * 删除指定的道具 GM
 *
 * User: snake
 * Date: 14-8-12
 * Time: 下午9:38
 */




class CRequestDeleteItem
{
    public $ItemCount;
    public $ItemIDs; # 数组
    public $TranTag;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ItemCount);

        for ($i = 0; $i <= $this->ItemCount; $i++) {
            $this->buffer->EncodeInt32($this->ItemIDs[$i]);
        }

        $this->buffer->EncodeString($this->TranTag);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ItemCount = $this->buffer->DecodeInt16();

        for ($i = 0; $i <= $this->ItemCount; $i++) {
            $this->ItemIDs[] = $this->buffer->DecodeInt32();
        }

        $this->TranTag = $this->buffer->DecodeString();

        return $this;
    }

    /**
     * @param mixed $ItemCount
     */
    public function setItemCount($ItemCount)
    {
        $this->ItemCount = $ItemCount;
    }

    /**
     * @return mixed
     */
    public function getItemCount()
    {
        return $this->ItemCount;
    }

    /**
     * @param mixed $ItemIDs
     */
    public function setItemIDs($ItemIDs)
    {
        $this->ItemIDs = $ItemIDs;
    }

    /**
     * @return mixed
     */
    public function getItemIDs()
    {
        return $this->ItemIDs;
    }

    /**
     * @param mixed $TranTag
     */
    public function setTranTag($TranTag)
    {
        $this->TranTag = $TranTag;
    }

    /**
     * @return mixed
     */
    public function getTranTag()
    {
        return $this->TranTag;
    }
}