<?php
/**
 *
 *
 * Author: snake
 * Date: 14-10-12
 * Time: 下午7:25
 * Denpend:
 */




class CResponseRenewService
{
    public $ResultID;
    public $Uin;
    public $Account;
    public $Coin;
    public $ServiceChg; #stServiceChg
    public $TransTag;
    public $TransparentDataSize;
    public $TransparentData; #max_transparent_data_size

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->Uin)
            ->EncodeString($this->Account)
            ->EncodeInt16($this->ResultID);

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->buffer->EncodeInt32($this->Coin)
                ->EncodeInt32($this->ServiceChg->ServiceID)
                ->EncodeInt32($this->ServiceChg->TimeChg)
                ->EncodeInt32($this->ServiceChg->ExpireTime);
        }

        $this->buffer->EncodeString($this->TransTag)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);

    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->ResultID = $this->buffer->DecodeInt16();

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->Coin = $this->buffer->DecodeInt32();
            $this->ServiceChg->ServiceID = $this->buffer->DecodeInt32();
            $this->ServiceChg->TimeChg = $this->buffer->DecodeInt32();
            $this->ServiceChg->ExpireTime = $this->buffer->DecodeInt32();
        }

        $this->TransTag = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        if ($this->TransparentDataSize > max_transparent_data_size) {
            return false;
        }

        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
    }

    /**
     * @param mixed $Account
     */
    public function setAccount($Account)
    {
        $this->Account = $Account;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->Account;
    }

    /**
     * @param mixed $Coin
     */
    public function setCoin($Coin)
    {
        $this->Coin = $Coin;
    }

    /**
     * @return mixed
     */
    public function getCoin()
    {
        return $this->Coin;
    }

    /**
     * @param mixed $ResultID
     */
    public function setResultID($ResultID)
    {
        $this->ResultID = $ResultID;
    }

    /**
     * @return mixed
     */
    public function getResultID()
    {
        return $this->ResultID;
    }

    /**
     * @param mixed $ServiceChg
     */
    public function setServiceChg($ServiceChg)
    {
        $this->ServiceChg = $ServiceChg;
    }

    /**
     * @return mixed
     */
    public function getServiceChg()
    {
        return $this->ServiceChg;
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