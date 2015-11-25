<?php
/**
 * 购买、赠送物品请求协议
 *
 * Author: snake
 * Date: 14-7-13
 * Time: 下午4:54
 * Denpend:
 */




class CSRequestBuyCommodity
{
    public $SrcUin;
    public $SrcAccount;

    public $SrcNickName;
    public $SrcGender;
    public $VipLevel;

    public $DstUin;
    public $DstAccount;

    public $PaymentModel;
    public $ClientIP;
    public $CommodityPrice;
    public $CommodityCount;
    public $CommodityData = array(array(
        'ID' => '123',
        'Count' => '321'
    ), array(
        'ID' => '456',
        'Count' => '789'
    ));

    public $Word;

    public $TransparentDataSize;
    public $TransparentData;

    public $buffer;

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeString($this->SrcNickName)
            ->EncodeInt8($this->SrcGender)
            ->EncodeInt8($this->VipLevel)
            ->EncodeInt32($this->DstUin)
            ->EncodeString($this->DstAccount)
            ->EncodeInt16($this->PaymentModel)
            ->EncodeInt32($this->ClientIP)
            ->EncodeInt32($this->CommodityPrice)
            ->EncodeInt16($this->CommodityCount);

        # 遍历
        foreach ($this->CommodityData as $commodidata) {
            $this->buffer->EncodeInt16(6)
                ->EncodeInt32($commodidata['ID'])
                ->EncodeInt16($commodidata['Count']);
        }

        $this->buffer->EncodeString($this->Word)
            ->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->SrcNickName = $this->buffer->DecodeString();
        $this->SrcGender = $this->buffer->DecodeInt8();
        $this->VipLevel = $this->buffer->DecodeInt8();
        $this->DstUin = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->PaymentModel = $this->buffer->DecodeInt16();
        $this->ClientIP = $this->buffer->DecodeInt32();
        $this->CommodityPrice = $this->buffer->DecodeInt32();
        $this->CommodityCount = $this->buffer->DecodeInt16();

        $this->CommodityData = array();
        for ($i = 0; $i < $this->CommodityCount; $i++) {
            $t = $this->buffer->DecodeInt16();
            array_push($this->CommodityData, array(
                'ID' => $this->buffer->DecodeInt32(),
                'Count' => $this->buffer->DecodeInt16()
            ));
        }

        $this->Word = $this->buffer->DecodeString();
        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);

        return $this;
    }


    /**
     * @param mixed $ClientIP
     */
    public function setClientIP($ClientIP)
    {
        $this->ClientIP = $ClientIP;
    }

    /**
     * @return mixed
     */
    public function getClientIP()
    {
        return $this->ClientIP;
    }

    /**
     * @param mixed $CommodityCount
     */
    public function setCommodityCount($CommodityCount)
    {
        $this->CommodityCount = $CommodityCount;
    }

    /**
     * @return mixed
     */
    public function getCommodityCount()
    {
        return $this->CommodityCount;
    }

    /**
     * @param array $CommodityData
     */
    public function setCommodityData($CommodityData)
    {
        $this->CommodityData = $CommodityData;
    }

    /**
     * @return array
     */
    public function getCommodityData()
    {
        return $this->CommodityData;
    }

    /**
     * @param mixed $CommodityPrice
     */
    public function setCommodityPrice($CommodityPrice)
    {
        $this->CommodityPrice = $CommodityPrice;
    }

    /**
     * @return mixed
     */
    public function getCommodityPrice()
    {
        return $this->CommodityPrice;
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
     * @param mixed $PaymentModel
     */
    public function setPaymentModel($PaymentModel)
    {
        $this->PaymentModel = $PaymentModel;
    }

    /**
     * @return mixed
     */
    public function getPaymentModel()
    {
        return $this->PaymentModel;
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
     * @param mixed $SrcGender
     */
    public function setSrcGender($SrcGender)
    {
        $this->SrcGender = $SrcGender;
    }

    /**
     * @return mixed
     */
    public function getSrcGender()
    {
        return $this->SrcGender;
    }

    /**
     * @param mixed $SrcNickName
     */
    public function setSrcNickName($SrcNickName)
    {
        $this->SrcNickName = $SrcNickName;
    }

    /**
     * @return mixed
     */
    public function getSrcNickName()
    {
        return $this->SrcNickName;
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
     * @param mixed $VipLevel
     */
    public function setVipLevel($VipLevel)
    {
        $this->VipLevel = $VipLevel;
    }

    /**
     * @return mixed
     */
    public function getVipLevel()
    {
        return $this->VipLevel;
    }

    /**
     * @param mixed $Word
     */
    public function setWord($Word)
    {
        $this->Word = $Word;
    }

    /**
     * @return mixed
     */
    public function getWord()
    {
        return $this->Word;
    }

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }
}