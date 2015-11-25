<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午8:34
 */




class CResponseRegisterService
{
    public $ResuldID;
    public $Uin;
    public $Account;
    public $ServiceDataChg;
    public $TransTag;
    public $TransparentDataSize;
    public $TransparentData;
    public $ChannelId;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer
            ->EncodeInt16($this->ResuldID)
            ->EncodeInt32($this->Uin)
            ->EncodeString($this->Account);

        if ($this->ResuldID == CSResultID::result_id_success) {
            $this->buffer->EncodeInt32($this->ServiceDataChg->Count);

            for ($i = 0; $i < $this->ServiceDataChg->Count; $i++) {
                $this->buffer->EncodeInt32($this->ServiceDataChg->Service[$i]['ServiceID'])
                    ->EncodeInt32($this->ServiceDataChg->Service[$i]['TimeChg'])
                    ->EncodeInt32($this->ServiceDataChg->Service[$i]['ExpireTime']);
            }
        }

        $this->buffer->EncodeString($this->TransTag)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->ResuldID = $this->buffer->DecodeInt16();
        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();

        if ($this->ResuldID == CSResultID::result_id_success) {
            $this->ServiceDataChg->Count = $this->buffer->DecodeInt32();

            for ($i = 0; $i < $this->ServiceDataChg->Count; $i++) {
                $temp = new Service();
                $temp->ServiceID = $this->buffer->DecodeInt32();
                $temp->TimeChg = $this->buffer->DecodeInt8();
                $temp->ExpireTime = $this->buffer->DecodeInt32();
                $this->ServiceDataChg->Service[] = $temp;
            }
        }

        $this->TransTag = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);

        return $this;
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
     * @param mixed $ChannelId
     */
    public function setChannelId($ChannelId)
    {
        $this->ChannelId = $ChannelId;
    }

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->ChannelId;
    }

    /**
     * @param mixed $ResuldID
     */
    public function setResuldID($ResuldID)
    {
        $this->ResuldID = $ResuldID;
    }

    /**
     * @return mixed
     */
    public function getResuldID()
    {
        return $this->ResuldID;
    }

    /**
     * @param mixed $ServiceDataChg
     */
    public function setServiceDataChg($ServiceDataChg)
    {
        $this->ServiceDataChg = $ServiceDataChg;
    }

    /**
     * @return mixed
     */
    public function getServiceDataChg()
    {
        return $this->ServiceDataChg;
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