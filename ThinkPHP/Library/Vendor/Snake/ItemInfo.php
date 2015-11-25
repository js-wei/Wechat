<?php
/**
 * 道具信息类
 *
 * User: snake
 * Date: 14-6-1
 * Time: 上午9:52
 */




class ItemInfo {
    public $ItemID; # 道具ID
    public $ItemType; # 道具类别
    public $Count; # 道具数量
    public $GameID; # 道具使用的场景 游戏ID
    public $ExpiredTime; # 道具失效的时间
    public $UpdateMode; # 更新模式

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
     * @param mixed $GameID
     */
    public function setGameID($GameID)
    {
        $this->GameID = $GameID;
    }

    /**
     * @return mixed
     */
    public function getGameID()
    {
        return $this->GameID;
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

    /**
     * @param mixed $ItemType
     */
    public function setItemType($ItemType)
    {
        $this->ItemType = $ItemType;
    }

    /**
     * @return mixed
     */
    public function getItemType()
    {
        return $this->ItemType;
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

    public static function encode_item_info(CodeEngine &$buf,ItemInfo $ii){

        $buf->EncodeInt16(2 + 4 + 2 + 4 + 2 + 4 + 1)
            ->EncodeInt32($ii->ItemID)
            ->EncodeInt16($ii->ItemType)
            ->EncodeInt32($ii->Count)
            ->EncodeInt16($ii->GameID)
            ->EncodeInt32($ii->ExpiredTime)
            ->EncodeInt8($ii->UpdateMode);
    }

    public static function decode_item_info(CodeEngine &$buf){
        $ii = new ItemInfo();

        $temp = $buf->DecodeInt16();
        $ii->setItemID($buf->DecodeInt32());
        $ii->setItemType($buf->DecodeInt16());
        $ii->setCount($buf->DecodeInt32());
        $ii->setGameID($buf->DecodeInt16());
        $ii->setExpiredTime($buf->DecodeInt32());
        $ii->setUpdateMode($buf->DecodeInt8());

        return $ii;
    }
}



