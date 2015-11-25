<?php
/**
 * 玩家游戏设置
 *
 * User: snake
 * Date: 14-8-22
 * Time: 下午8:06
 */



/**
 * Class PlayerGameConfig UserGameInfo后部份数据
 * @package Snake
 */
class PlayerGameConfig
{
    public $MinPoint; //最小积分
    public $MaxPointGap; //最大积分差距

    public $MaxOfflineRate; //最大掉线率
    public $IPBit;
    public $BitMap;

    public $OtherSize; //个数
    public $Others;

    public function getLength()
    {
        $length = 2 + 4 + 4 + 4 + 1 * 3 + 4 * $this->OtherSize;
        return $length;
    }

    public function Encode(CodeEngine &$buf)
    {

        $buf
            ->EncodeInt32($this->BitMap)
            ->EncodeInt32($this->MinPoint)
            ->EncodeInt32($this->MaxPointGap)
            ->EncodeInt8($this->MaxOfflineRate)
            ->EncodeInt8($this->IPBit)
            ->EncodeInt8($this->OtherSize);

        for ($i = 0; $i < $this->OtherSize; $i++) {
            $buf->EncodeInt32($this->Others[$i]);
        }

        $length = 4 + 4 + 4 + 1 * 3 + 4 * $this->OtherSize;

        return $length;
    }

    public function Decode(CodeEngine &$buf)
    {
        $len = $buf->DecodeInt16();
        $len -= 2;
        $this->setBitMap($buf->DecodeInt32());
        $len -= 4;
        $this->setMinPoint($buf->DecodeInt32());
        $len -= 4;
        $this->setMaxPointGap($buf->DecodeInt32());
        $len -= 4;
        $this->setMaxOfflineRate($buf->DecodeInt8());
        $len -= 1;
        $this->setIPBit($buf->DecodeInt8());
        $len -= 1;
        $this->setOtherSize($buf->DecodeInt8());
        $len -= 1;

        if ($this->OtherSize > max_game_other_data_count) {
            $this->OtherSize = max_game_other_data_count;
        }

        $t = array();
        for ($i = 0; $i < $this->getOtherSize(); $i++) {
            $t[] = $buf->DecodeInt32();
            $len -= 4;
        }
        $this->setOthers($t);

        if ($len < 0) {
            return 0;
        } else {
            $buf->DecodeMemory($len);
        }
        return $len;
    }

    /**
     * @param mixed $BitMap
     */
    public function setBitMap($BitMap)
    {
        $this->BitMap = $BitMap;
    }

    /**
     * @return mixed
     */
    public function getBitMap()
    {
        return $this->BitMap;
    }

    /**
     * @param mixed $IPBit
     */
    public function setIPBit($IPBit)
    {
        $this->IPBit = $IPBit;
    }

    /**
     * @return mixed
     */
    public function getIPBit()
    {
        return $this->IPBit;
    }

    /**
     * @param mixed $MaxOfflineRate
     */
    public function setMaxOfflineRate($MaxOfflineRate)
    {
        $this->MaxOfflineRate = $MaxOfflineRate;
    }

    /**
     * @return mixed
     */
    public function getMaxOfflineRate()
    {
        return $this->MaxOfflineRate;
    }

    /**
     * @param mixed $MaxPointGap
     */
    public function setMaxPointGap($MaxPointGap)
    {
        $this->MaxPointGap = $MaxPointGap;
    }

    /**
     * @return mixed
     */
    public function getMaxPointGap()
    {
        return $this->MaxPointGap;
    }

    /**
     * @param mixed $MinPoint
     */
    public function setMinPoint($MinPoint)
    {
        $this->MinPoint = $MinPoint;
    }

    /**
     * @return mixed
     */
    public function getMinPoint()
    {
        return $this->MinPoint;
    }

    /**
     * @param mixed $OtherSize
     */
    public function setOtherSize($OtherSize)
    {
        $this->OtherSize = $OtherSize;
    }

    /**
     * @return mixed
     */
    public function getOtherSize()
    {
        return $this->OtherSize;
    }

    /**
     * @param mixed $Others
     */
    public function setOthers($Others)
    {
        $this->Others = $Others;
    }

    /**
     * @return mixed
     */
    public function getOthers()
    {
        return $this->Others;
    }


} 