<?php
/**
 * 扩展游戏信息
 *
 * User: snake
 * Date: 14-8-22
 * Time: 下午8:10
 */




class TDBExtGameInfo
{
    public $ExtInt;
    public $ExtDataSize;
    public $ExtData;

    /**
     * 编码时候，需要长度
     */
    public function getLength()
    {
        # 计算长度
        $length = 2 + 4 * max_game_ext_int_count + 2 + strlen($this->ExtData);
        return $length;
    }

    public function Encode(CodeEngine &$buf)
    {
        # 计算长度
        $length = 2 + 4 * max_game_ext_int_count + 2 + strlen($this->ExtData);
        $buf->EncodeInt16($length);

        for ($i = 0; $i < max_game_ext_int_count; $i++) {
            $buf->EncodeInt32($this->ExtInt[$i]);
        }

        $buf->EncodeInt16($this->ExtDataSize);

        if ($this->ExtDataSize > 0) {
            $buf->EncodeMemory($this->ExtData, $this->ExtDataSize);
        }

        return $length;
    }

    public function Decode(CodeEngine &$buf)
    {
        # 未完善
        # 不完善的地方是ExtInt这个地方，C++默认已经使用了max_game_ext_int_count的数值
        $len = $buf->DecodeInt16();
        $len -= 2;

        for ($i = 0; ($i < /*max_game_ext_int_count*/
            128) && ($len > 0); $i++) {
            $this->ExtInt[] = $buf->DecodeInt32();
            $len -= 4;
        }

        if ($len < 0) {
            return 0;
        }

        $this->ExtDataSize = $buf->DecodeInt16();
        $len -= 2;

        if ($this->ExtDataSize > 0) {
            $this->ExtData = $buf->DecodeMemory($this->ExtDataSize);
            $len -= $this->ExtDataSize;
        }

        return $len;
    }

    /**
     * @param mixed $ExtData
     */
    public function setExtData($ExtData)
    {
        $this->ExtData = $ExtData;
    }

    /**
     * @return mixed
     */
    public function getExtData()
    {
        return $this->ExtData;
    }

    /**
     * @param mixed $ExtDataSize
     */
    public function setExtDataSize($ExtDataSize)
    {
        $this->ExtDataSize = $ExtDataSize;
    }

    /**
     * @return mixed
     */
    public function getExtDataSize()
    {
        return $this->ExtDataSize;
    }

    /**
     * @param mixed $ExtInt
     */
    public function setExtInt($ExtInt)
    {
        $this->ExtInt = $ExtInt;
    }

    /**
     * @return mixed
     */
    public function getExtInt()
    {
        return $this->ExtInt;
    }
}