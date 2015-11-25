<?php
/**
 * 
 * User: snake
 * Date: 14-6-1
 * Time: 上午9:56
 */




class ItemInfo2 {
    public $ItemID;
    public $Count;
    public $ExpiredTime;

    /**
     * @param mixed $Count
     */
    public function setCount($Count)
    {
        $this->Count = $Count;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->Count;
    }

    /**
     * @param mixed $ExpiredTime
     */
    public function setExpiredTime($ExpiredTime)
    {
        $this->ExpiredTime = $ExpiredTime;
    }

    /**
     * @return mixed
     */
    public function getExpiredTime()
    {
        return $this->ExpiredTime;
    }

    /**
     * @param mixed $ItemID
     */
    public function setItemID($ItemID)
    {
        $this->ItemID = $ItemID;
    }

    /**
     * @return mixed
     */
    public function getItemID()
    {
        return $this->ItemID;
    }

    public function encode_item_info2(CodeEngine &$buf, ItemInfo2 $ii)
    {
        $buf->EncodeInt32($ii->ItemID)
            ->EncodeInt32($ii->Count)
            ->EncodeInt32($ii->ExpiredTime);
    }

    public function decode_item_info2(CodeEngine &$buf)
    {
        $ItemSize = $buf->DecodeInt16();

        $len = 0;
        $this->setItemID($buf->DecodeInt32());
        $len += 4;
        $ItemSize -= 4;
        $this->setCount($buf->DecodeInt32());
        $len += 4;
        $ItemSize -= 4;
        $this->setExpiredTime($buf->DecodeInt32());
        $len += 4;
        $ItemSize -= 4;

        if ($ItemSize < 0) {
            return 0;
        } else {
            $buf->DecodeMemory($ItemSize);
        }

        return $len;
    }
} 