<?php
/**
 * 请求改变钱
 *
 * Author: snake
 * Date: 14-8-18
 * Time: 下午9:31
 * Denpend:
 */




class CRequestChangeMoney
{
    public $Uin; # [必填] 用户UIN
    public $Account; # [必填] 用户账户名称
    public $UnitMoneyChg; # 每个变动的单元
    public $UnitCount; # 变动的单元数

    # ChgMoneyStrategy 类型 三个值
    public $Strategy; # 变动策略 UnitMoneyChg<0时才有效 可取值: ChgMoneyStrategy =1:必须要全额扣除 =2:如果用户余额不足,尽最大可能扣除'变动单元'的整数倍 =3:如果用户余额不足,则扣到0.

    public $ServiceTag; # ServiceType类型
    public $Flag; # 标识 当数据库中没有数据项时，是否要创建一个数据项 1 = 是 0 = 不创建
    public $Description; # 描述这次加钱的原因
    public $TransTag; # 事务标识

    # 以下回传给前端用 传什么 返回什么
    public $TransparentDataSize; # 0
    public $TransparentData; # ''
    public $NotifyTransparentDataSize; # 0
    public $NotifyTransparentData; # ''

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
            ->EncodeInt32($this->UnitMoneyChg)
            ->EncodeInt16($this->UnitCount)
            ->EncodeInt8($this->Strategy)
            ->EncodeInt32($this->ServiceTag)
            ->EncodeInt8($this->Flag)
            ->EncodeString($this->Description)
            ->EncodeString($this->TransTag)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize)
            ->EncodeInt16($this->NotifyTransparentDataSize)
            ->EncodeMemory($this->NotifyTransparentData, $this->NotifyTransparentDataSize);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->UnitMoneyChg = $this->buffer->DecodeInt32();
        $this->UnitCount = $this->buffer->DecodeInt16();
        $this->Strategy = $this->buffer->DecodeInt8();
        $this->ServiceTag = $this->buffer->DecodeInt32();
        $this->Flag = $this->buffer->DecodeInt8();
        $this->Description = $this->buffer->DecodeString();
        $this->TransTag = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);
        $this->NotifyTransparentDataSize = $this->buffer->DecodeInt16();
        $this->NotifyTransparentData = $this->buffer->DecodeMemory($this->NotifyTransparentDataSize);

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
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Flag
     */
    public function setFlag($Flag)
    {
        $this->Flag = $Flag;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->Flag;
    }

    /**
     * @param mixed $NotifyTransparentData
     */
    public function setNotifyTransparentData($NotifyTransparentData)
    {
        $this->NotifyTransparentData = $NotifyTransparentData;
    }

    /**
     * @return mixed
     */
    public function getNotifyTransparentData()
    {
        return $this->NotifyTransparentData;
    }

    /**
     * @param mixed $NotifyTransparentDataSize
     */
    public function setNotifyTransparentDataSize($NotifyTransparentDataSize)
    {
        $this->NotifyTransparentDataSize = $NotifyTransparentDataSize;
    }

    /**
     * @return mixed
     */
    public function getNotifyTransparentDataSize()
    {
        return $this->NotifyTransparentDataSize;
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
     * @param mixed $Strategy
     */
    public function setStrategy($Strategy)
    {
        $this->Strategy = $Strategy;
    }

    /**
     * @return mixed
     */
    public function getStrategy()
    {
        return $this->Strategy;
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

    /**
     * @param mixed $UnitCount
     */
    public function setUnitCount($UnitCount)
    {
        $this->UnitCount = $UnitCount;
    }

    /**
     * @return mixed
     */
    public function getUnitCount()
    {
        return $this->UnitCount;
    }

    /**
     * @param mixed $UnitMoneyChg
     */
    public function setUnitMoneyChg($UnitMoneyChg)
    {
        $this->UnitMoneyChg = $UnitMoneyChg;
    }

    /**
     * @return mixed
     */
    public function getUnitMoneyChg()
    {
        return $this->UnitMoneyChg;
    }
}