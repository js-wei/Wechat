<?php
/**
 * 服务器信息
 *
 * User: snake
 * Date: 14-8-23
 * Time: 下午8:14
 */




class Service
{
    public $ServiceID;
    public $TimeChg;
    public $ExpireTime;

    public function Encode(CodeEngine &$buf)
    {
        $buf->EncodeInt16(2 + 4 + 4 + 4)
            ->EncodeInt32($this->ServiceID)
            ->EncodeInt32($this->TimeChg)
            ->EncodeInt32($this->ExpireTime);
    }

    public function Decode(CodeEngine &$buf)
    {
        $len = $buf->DecodeInt16();
        $this->ServiceID = $buf->DecodeInt32();
        $this->TimeChg = $buf->DecodeInt32();
        $this->ExpireTime = $buf->DecodeInt32();
        return $this;
    }

    /**
     * @param mixed $ExpireTime
     */
    public function setExpireTime($ExpireTime)
    {
        $this->ExpireTime = $ExpireTime;
    }

    /**
     * @return mixed
     */
    public function getExpireTime()
    {
        return $this->ExpireTime;
    }

    /**
     * @param mixed $ServiceID
     */
    public function setServiceID($ServiceID)
    {
        $this->ServiceID = $ServiceID;
    }

    /**
     * @return mixed
     */
    public function getServiceID()
    {
        return $this->ServiceID;
    }

    /**
     * @param mixed $TimeChg
     */
    public function setTimeChg($TimeChg)
    {
        $this->TimeChg = $TimeChg;
    }

    /**
     * @return mixed
     */
    public function getTimeChg()
    {
        return $this->TimeChg;
    }

}