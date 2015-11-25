<?php
/**
 *
 * User: snake
 * Date: 14-11-13
 * Time: 下午9:51
 */




class CRequestGetPlayerStatusFromStateServer
{
    public $MyUin; # 查询的人的UIN，通常是GM
    public $Count; # 所查询的用户UIN的数量
    public $Uin; # UIN数组

    public $buffer;

    function __construct()
    {
        $this->Count = 0;
    }


    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();
        $len = 0;
        $this->buffer->EncodeInt32($this->MyUin);
        $len += 4;
        if (MAX_REQUEST_PLAYER_COUNT < $this->Count) {
            $this->Count = MAX_REQUEST_PLAYER_COUNT;
        }

        $this->buffer->EncodeInt16($this->Count);
        $len += 2;

        for ($i = 0; $i < $this->Count; $i++) {
            $this->buffer->EncodeInt32($this->Uin[$i]);
            $len += 4;
        }

        return $len;
    }

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
     * @param mixed $MyUin
     */
    public function setMyUin($MyUin)
    {
        $this->MyUin = $MyUin;
    }

    /**
     * @return mixed
     */
    public function getMyUin()
    {
        return $this->MyUin;
    }

    /**
     * @param mixed $Uin
     */
    public function setUin($Uin)
    {
        $this->Uin = $Uin;
    }

    /**
     * @return mixed
     */
    public function getUin()
    {
        return $this->Uin;
    }


} 