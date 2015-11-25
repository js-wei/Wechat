<?php
/**
 *
 * User: snake
 * Date: 14-11-23
 * Time: 下午9:49
 */




class CResponseGetPlayerItemData
{
    public $Uin;
    public $ResultID;
    public $ItemCount;
    public $ItemInfos; #class ItemInfo2
    public $CharmItemCount;
    public $CharmItemInfos;
    public $DataSize;

    public $TransparentData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);
        $len = 0;
        $this->Uin = $this->buffer->DecodeInt32();
        $len += 4;
        $this->ResultID = $this->buffer->DecodeInt16();
        $len += 2;

        if (CSResultID::result_id_success == $this->ResultID) {
            $this->ItemCount = $this->buffer->DecodeInt16();
            $len += 2;

            if (MAX_ITEM_COUNT < $this->ItemCount) {
                $this->ItemCount = MAX_ITEM_COUNT;
            }

            $this->ItemInfos = array();
            for ($i = 0; $i < $this->ItemCount; $i++) {
                $temp = new ItemInfo2();
                $len += $temp->decode_item_info2($this->buffer);
                $this->ItemInfos[] = $temp;
            }

            $this->CharmItemCount = $this->buffer->DecodeInt16();
            $len += 2;

            $this->CharmItemInfos = array();
            for ($i = 0; $i < $this->CharmItemCount; $i++) {
                $temp = new ItemInfo2();
                $len += $temp->decode_item_info2($this->buffer);
                $this->CharmItemInfos[] = $temp;
            }

            $this->DataSize = $this->buffer->DecodeInt32();
            if ($this->DataSize > max_transparent_data_size) {
                return false;
            }
            $this->TransparentData = $this->buffer->DecodeMemory($this->DataSize);
            $len += strlen($this->TransparentData);
        }

        return $this;
    }

    /**
     * @param mixed $CharmItemInfos
     */
    public function setCharmItemInfos($CharmItemInfos)
    {
        $this->CharmItemInfos = $CharmItemInfos;
    }

    /**
     * @param mixed $DataSize
     */
    public function setDataSize($DataSize)
    {
        $this->DataSize = $DataSize;
    }

    /**
     * @param mixed $ItemCount
     */
    public function setItemCount($ItemCount)
    {
        $this->ItemCount = $ItemCount;
    }

    /**
     * @param mixed $ItemInfoCount
     */
    public function setItemInfoCount($ItemInfoCount)
    {
        $this->ItemInfoCount = $ItemInfoCount;
    }

    /**
     * @param mixed $ItemInfos
     */
    public function setItemInfos($ItemInfos)
    {
        $this->ItemInfos = $ItemInfos;
    }

    /**
     * @param mixed $ResultID
     */
    public function setResultID($ResultID)
    {
        $this->ResultID = $ResultID;
    }

    /**
     * @param mixed $TransparentData
     */
    public function setTransparentData($TransparentData)
    {
        $this->TransparentData = $TransparentData;
    }

    /**
     * @param mixed $Uin
     */
    public function setUin($Uin)
    {
        $this->Uin = $Uin;
    }


} 