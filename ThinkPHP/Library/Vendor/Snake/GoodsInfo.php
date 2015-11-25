<?php
/**
 * 商品信息结构
 *
 * User: snake
 * Date: 14-6-1
 * Time: 上午9:58
 */




class GoodsInfo {
    public $GoodsID; # 商品ID
    public $Count; # 商品数量
    public $Price; # 商品价格

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
     * @param mixed $GoodsID
     */
    public function setGoodsID($GoodsID)
    {
        $this->GoodsID = $GoodsID;
    }

    /**
     * @return mixed
     */
    public function getGoodsID()
    {
        return $this->GoodsID;
    }

    /**
     * @param mixed $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->Price;
    }

    public static function encode_goods_info(CodeEngine &$buf, GoodsInfo $gi){
        # 首先先是总共的字段长度，然后再加上所有的其他参数
        $buf->EncodeInt16(2 + 4 + 4 + 4)
            ->EncodeInt32($gi->GoodsID)
            ->EncodeInt32($gi->Count)
            ->EncodeInt32($gi->Price);
    }

    public static function decode_goods_info(CodeEngine &$buf){
        $gi = new GoodsInfo();

        $len = $buf->DecodeInt16(); # 首先获得整个数组有多少个byte
        $gi->setGoodsID($buf->DecodeInt32());
        $gi->setCount($buf->DecodeInt32());
        $gi->setPrice($buf->DecodeInt32());

        return $gi;
    }
} 