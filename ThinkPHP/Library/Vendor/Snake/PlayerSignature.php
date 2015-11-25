<?php
/**
 * 玩家签名信息
 *
 * User: snake
 * Date: 14-8-15
 * Time: 下午9:14
 */




class PlayerSignature
{
    public $Key;
    public $ServiceBitmap;
    public $Uin;
    public $TimeStamp;
    public $SignatureFlag;
    public $Uid;

    /**
     * @param mixed $Key
     */
    public function setKey($Key)
    {
        $this->Key = $Key;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->Key;
    }

    /**
     * @param mixed $ServiceBitmap
     */
    public function setServiceBitmap($ServiceBitmap)
    {
        $this->ServiceBitmap = $ServiceBitmap;
    }

    /**
     * @return mixed
     */
    public function getServiceBitmap()
    {
        return $this->ServiceBitmap;
    }

    /**
     * @param mixed $SignatureFlag
     */
    public function setSignatureFlag($SignatureFlag)
    {
        $this->SignatureFlag = $SignatureFlag;
    }

    /**
     * @return mixed
     */
    public function getSignatureFlag()
    {
        return $this->SignatureFlag;
    }

    /**
     * @param mixed $TimeStamp
     */
    public function setTimeStamp($TimeStamp)
    {
        $this->TimeStamp = $TimeStamp;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->TimeStamp;
    }

    /**
     * @param mixed $Uid
     */
    public function setUid($Uid)
    {
        $this->Uid = $Uid;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->Uid;
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