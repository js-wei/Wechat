<?php
/**
 * 请求更新装备信息
 *
 * User: snake
 * Date: 14-5-31
 * Time: 上午10:49
 */



define('MAX_GOODS_UPDATE_COUNT', 15);
define('MAX_ITEM_UPDATE_COUNT', 120); # MAX_GOODS_UPDATE_COUNT * max_item_count_in_goods = 15 * 8
define('max_transparent_data_size', 4096); # 透明数据最大长度
define('max_operate_description_length', 64); # 操作描述符最大长度
define('max_game_tag_length', 32); #
define('max_sub_message_size', 4096); # SubMessage的最大长度,它是序列化以后放在额外的透明数据中的

class CRequestUpdateItemInfo
{
    public $RealUIN; // 实际要进行更新物品信息的玩家UIN
    public $RealAccount; // 实际要进行更新物品信息的玩家的Account
    public $ActorUIN; // 引发此次更新操作的玩家UIN,如果是自己买东西给自己,则RealUIN都是自己
    public $ActorAccount;
    public $ServiceTag; // 业务标识
    public $SourceTag; // 引起业务的源
    public $IP; //

    public $ItemCount; // 道具数量
    public $ItemInfos; // 具体道具信息 15

    public $GoodsCount; // 商品数量
    public $GoodsInfo; // 商品详细信息 120

    public $TransparentDataSize; // 对Item DB 透明的数据
    public $TransparentData; //

    public $OperateDescription;
    public $TransTag;

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

        $this->buffer->EncodeInt32($this->RealUIN)
            ->EncodeString($this->RealAccount)
            ->EncodeInt32($this->ActorUIN)
            ->EncodeString($this->ActorAccount)
            ->EncodeInt32($this->ServiceTag)
            ->EncodeInt32($this->SourceTag)
            ->EncodeInt32($this->IP)
            ->EncodeInt16($this->ItemCount);

        foreach ($this->ItemInfos as $iteminfo) {
            ItemInfo::encode_item_info($this->buffer, $iteminfo);
        }

        $this->buffer->EncodeInt16($this->GoodsCount);

        foreach ($this->GoodsInfo as $goodinfo) {
            GoodsInfo::encode_goods_info($this->buffer, $goodinfo);
        }

        $this->buffer->EncodeInt16($this->TransparentDataSize);

        # 存储块信息
        if ($this->TransparentDataSize > 0) {
            $this->buffer->EncodeMemory($this->TransparentData, $this->TransparentDataSize);
        }

        $this->buffer->EncodeString($this->OperateDescription)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->NofifyTransparentDataSize);

        if ($this->NofifyTransparentDataSize > 0) {
            $this->buffer->EncodeMemory($this->NofifyTransparentData, $this->NofifyTransparentDataSize);
        }

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->RealUIN = $this->buffer->DecodeInt32();
        $this->RealAccount = $this->buffer->DecodeString();
        $this->ActorUIN = $this->buffer->DecodeInt32();
        $this->ActorAccount = $this->buffer->DecodeString();
        $this->ServiceTag = $this->buffer->DecodeInt32();
        $this->SourceTag = $this->buffer->DecodeInt32();
        $this->IP = $this->buffer->DecodeInt32();
        $this->ItemCount = $this->buffer->DecodeInt16();

        for ($i = 0; $i < $this->ItemCount; $i++) {
            $this->ItemInfos[] = ItemInfo::decode_item_info($this->buffer);
        }

        $this->GoodsCount = $this->buffer->DecodeInt16();

        for ($i = 0; $i < $this->GoodsCount; $i++) {
            $this->GoodsInfo[] = GoodsInfo::decode_goods_info($this->buffer);
        }

        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        if ($this->TransparentDataSize > 0) {
            $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        }

        $this->OperateDescription = $this->buffer->DecodeString();
        $this->TransTag = $this->buffer->DecodeString();
        $this->NofifyTransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->NofifyTransparentDataSize > 0) {
            $this->NofifyTransparentData = $this->buffer->DecodeMemory($this->NofifyTransparentDataSize);
        }

        return $this;
    }

    /**
     * @param mixed $ActorAccount
     */
    public function setActorAccount($ActorAccount)
    {
        $this->ActorAccount = $ActorAccount;
    }

    /**
     * @return mixed
     */
    public function getActorAccount()
    {
        return $this->ActorAccount;
    }

    /**
     * @param mixed $ActorUIN
     */
    public function setActorUIN($ActorUIN)
    {
        $this->ActorUIN = $ActorUIN;
    }

    /**
     * @return mixed
     */
    public function getActorUIN()
    {
        return $this->ActorUIN;
    }

    /**
     * @param mixed $GoodsCount
     */
    public function setGoodsCount($GoodsCount)
    {
        $this->GoodsCount = $GoodsCount;
    }

    /**
     * @return mixed
     */
    public function getGoodsCount()
    {
        return $this->GoodsCount;
    }

    /**
     * @param mixed $GoodsInfo
     */
    public function setGoodsInfo($GoodsInfo)
    {
        $this->GoodsInfo = $GoodsInfo;
    }

    /**
     * @return mixed
     */
    public function getGoodsInfo()
    {
        return $this->GoodsInfo;
    }

    /**
     * @param mixed $IP
     */
    public function setIP($IP)
    {
        $this->IP = $IP;
    }

    /**
     * @return mixed
     */
    public function getIP()
    {
        return $this->IP;
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

    /**
     * @param mixed $OperateDescription
     */
    public function setOperateDescription($OperateDescription)
    {
        $this->OperateDescription = $OperateDescription;
    }

    /**
     * @return mixed
     */
    public function getOperateDescription()
    {
        return $this->OperateDescription;
    }

    /**
     * @param mixed $RealAccount
     */
    public function setRealAccount($RealAccount)
    {
        $this->RealAccount = $RealAccount;
    }

    /**
     * @return mixed
     */
    public function getRealAccount()
    {
        return $this->RealAccount;
    }

    /**
     * @param mixed $RealUIN
     */
    public function setRealUIN($RealUIN)
    {
        $this->RealUIN = $RealUIN;
    }

    /**
     * @return mixed
     */
    public function getRealUIN()
    {
        return $this->RealUIN;
    }

    /**
     * @param mixed $ServiceTag
     */
    public function setServiceTag($ServiceTag)
    {
        $this->ServiceTag = $ServiceTag;
    }

    /**
     * @return mixed
     */
    public function getServiceTag()
    {
        return $this->ServiceTag;
    }

    /**
     * @param mixed $SourceTag
     */
    public function setSourceTag($SourceTag)
    {
        $this->SourceTag = $SourceTag;
    }

    /**
     * @return mixed
     */
    public function getSourceTag()
    {
        return $this->SourceTag;
    }

    /**
     * @param mixed $TransTag
     */
    public function setTransTag($TransTag)
    {
        $this->TransTag = $TransTag;
    }

    /**
     * @return mixed
     */
    public function getTransTag()
    {
        return $this->TransTag;
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
     * @param mixed $TransparentDataSize
     */
    public function setTransparentDataSize($TransparentDataSize)
    {
        $this->TransparentDataSize = $TransparentDataSize;
    }

    /**
     * @return mixed
     */
    public function getTransparentDataSize()
    {
        return $this->TransparentDataSize;
    }


} 