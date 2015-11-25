<?php
/**
 * 
 * 
 * Author: snake
 * Date: 14-4-24
 * Time: 下午9:41
 * Denpend:
 */



/**
 * 发送的禁言或者封账号请求协议
 *
 * Class CSRequestPunish
 * @package Snake
 */
class CSRequestPunish {

    public $SrcUin; # [必填] GM的uid
    public $SrcAccount; # [必填] GM的账户
    public $DstUin; # [必填] 被惩罚的人的uin
    public $DstAccount; #[必填] 被惩罚的人的账户 (用户名)
    public $PunishType; # [必填] PunishMethod
    public $Reason; # [必填] 原因
    public $RequestTimestamp; # [必填] 时间戳
    public $PunishEndTimestamp; # [必填] 惩罚截止失效

    public $buffer;

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt32($this->DstUin)
            ->EncodeString($this->DstAccount)
            ->EncodeInt8($this->PunishType)
            ->EncodeString($this->Reason)
            ->EncodeInt32($this->RequestTimestamp)
            ->EncodeInt32($this->PunishEndTimestamp);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->DstUin = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->PunishType = $this->buffer->DecodeInt8();
        $this->Reason = $this->buffer->DecodeString();
        $this->RequestTimestamp = $this->buffer->DecodeInt32();
        $this->PunishEndTimestamp = $this->buffer->DecodeInt32();

        return $this;
    }

    /**
     * @param mixed $DstAccount
     */
    public function setDstAccount($DstAccount)
    {
        $this->DstAccount = $DstAccount;
    }

    /**
     * @return mixed
     */
    public function getDstAccount()
    {
        return $this->DstAccount;
    }

    /**
     * @param mixed $DstUin
     */
    public function setDstUin($DstUin)
    {
        $this->DstUin = $DstUin;
    }

    /**
     * @return mixed
     */
    public function getDstUin()
    {
        return $this->DstUin;
    }

    /**
     * @param mixed $PunishEndTimestamp
     */
    public function setPunishEndTimestamp($PunishEndTimestamp)
    {
        $this->PunishEndTimestamp = $PunishEndTimestamp;
    }

    /**
     * @return mixed
     */
    public function getPunishEndTimestamp()
    {
        return $this->PunishEndTimestamp;
    }

    /**
     * @param mixed $PunishType
     */
    public function setPunishType($PunishType)
    {
        $this->PunishType = $PunishType;
    }

    /**
     * @return mixed
     */
    public function getPunishType()
    {
        return $this->PunishType;
    }

    /**
     * @param mixed $Reason
     */
    public function setReason($Reason)
    {
        $this->Reason = $Reason;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->Reason;
    }

    /**
     * @param mixed $RequestTimestamp
     */
    public function setRequestTimestamp($RequestTimestamp)
    {
        $this->RequestTimestamp = $RequestTimestamp;
    }

    /**
     * @return mixed
     */
    public function getRequestTimestamp()
    {
        return $this->RequestTimestamp;
    }

    /**
     * @param mixed $SrcAccount
     */
    public function setSrcAccount($SrcAccount)
    {
        $this->SrcAccount = $SrcAccount;
    }

    /**
     * @return mixed
     */
    public function getSrcAccount()
    {
        return $this->SrcAccount;
    }

    /**
     * @param mixed $SrcUin
     */
    public function setSrcUin($SrcUin)
    {
        $this->SrcUin = $SrcUin;
    }

    /**
     * @return mixed
     */
    public function getSrcUin()
    {
        return $this->SrcUin;
    }


} 