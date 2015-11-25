<?php
/**
 * 通知(刷新)玩家物品信息
 *
 *
 * User: snake
 * Date: 14-8-12
 * Time: 下午9:11
 */



class CNotifyUpdateItemInfo
{
    public $DstUIN;
    public $DstAccount;
    public $ItemCount;
    public $ItemInfos; # 数组
    public $NofifyTransparentDataSize;
    public $NofifyTransparentData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->DstUIN)
            ->EncodeString($this->DstAccount)
            ->EncodeInt16($this->ItemCount);

        foreach ($this->ItemInfos as $iteminfo) {
            ItemInfo::encode_item_info($this->buffer, $iteminfo);
        }

        $this->buffer->EncodeInt16($this->NofifyTransparentDataSize);

        if ($this->NofifyTransparentDataSize > 0) {
            $this->buffer->EncodeMemory($this->NofifyTransparentData, $this->NofifyTransparentDataSize);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->DstUIN = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->ItemCount = $this->buffer->DecodeInt16();

        for ($i = 0; $i < $this->ItemCount; $i++) {
            $this->ItemInfos[] = ItemInfo::decode_item_info($this->buffer);
        }

        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt16();
        if ($this->NofifyTransparentDataSize > 0) {
            $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);
        }

        return $this;
    }

    /**
     * @param mixed $DstAccount
     */
    public function setDstAccount($DstAccount)
    {
        $this->DstAccount = $DstAccount;
    }

    /**
     * @return mixed
     */
    public function getDstAccount()
    {
        return $this->DstAccount;
    }

    /**
     * @param mixed $DstUIN
     */
    public function setDstUIN($DstUIN)
    {
        $this->DstUIN = $DstUIN;
    }

    /**
     * @return mixed
     */
    public function getDstUIN()
    {
        return $this->DstUIN;
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
     * @param mixed $ItemInfos
     */
    public function setItemInfos($ItemInfos)
    {
        $this->ItemInfos = $ItemInfos;
    }

    /**
     * @return mixed
     */
    public function getItemInfos()
    {
        return $this->ItemInfos;
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
}