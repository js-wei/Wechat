<?php
/**
 * 购买/赠送物品响应协议
 *
 * Author: snake
 * Date: 14-7-13
 * Time: 下午7:44
 * Denpend:
 */




class CSResponseBuyCommodity
{
    public $ResultID;

    public $SrcUin;
    public $SrcAccount;
    public $DstUin;
    public $DstAccount;

    public $Price;
    public $CommodityCount;
    public $Bean;
    public $BeanFlag;
    public $ItemCount;
    public $ItemInfo = array(array(
        'ID' => '',
        'Count' => ''
    ));

    public $TransparentDataSize;
    public $TransparentData;

    public $buffer;

    public function Encode()
    {
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt16($this->ResultID)
            ->EncodeInt32($this->SrcUin)
            ->EncodeString($this->SrcAccount)
            ->EncodeInt8($this->DstUin)
            ->EncodeString($this->DstAccount)
            ->EncodeInt32($this->Price)
            ->EncodeInt16($this->CommodityCount)
            ->EncodeInt64($this->Bean)
            ->EncodeInt16($this->BeanFlag)
            ->EncodeInt16($this->ItemCount);

        # 遍历
        foreach ($this->ItemInfo as $iteminfo) {
            $this->buffer->EncodeInt16(6)
                ->EncodeInt32($iteminfo['ID'])
                ->EncodeInt16($iteminfo['Count']);
        }

        $this->buffer->EncodeInt16($this->TransparentDataSize)
            ->EncodeMemory($this->TransparentData, $this->TransparentDataSize);

        return $this;
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->SrcUin = $this->buffer->DecodeInt32();
        $this->SrcAccount = $this->buffer->DecodeString();
        $this->DstUin = $this->buffer->DecodeInt32();
        $this->DstAccount = $this->buffer->DecodeString();
        $this->Price = $this->buffer->DecodeInt32();
        $this->CommodityCount = $this->buffer->DecodeInt16();
        $this->Bean = $this->buffer->DecodeInt64();
        $this->BeanFlag = $this->buffer->DecodeInt16();
        $this->ItemCount = $this->buffer->DecodeInt16();

        $this->ItemInfo = array();
        for ($i = 0; $i < $this->ItemCount; $i++) {
            $t = $this->buffer->DecodeInt16();
            array_push($this->ItemInfo, array(
                'ID' => $this->buffer->DecodeInt32(),
                'Count' => $this->buffer->DecodeInt16()
            ));
        }
        $this->TransparentDataSize = $this->buffer->DecodeInt16();

        $this->TransparentData = $this->buffer->DecodeMemory($this->TransparentDataSize);

        return $this;
    }

    /**
     * @param mixed $Bean
     */
    public function setBean($Bean)
    {
        $this->Bean = $Bean;
    }

    /**
     * @return mixed
     */
    public function getBean()
    {
        return $this->Bean;
    }

    /**
     * @param mixed $BeanFlag
     */
    public function setBeanFlag($BeanFlag)
    {
        $this->BeanFlag = $BeanFlag;
    }

    /**
     * @return mixed
     */
    public function getBeanFlag()
    {
        return $this->BeanFlag;
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
     * @param mixed $ItemCount
     */
    public function setItemCount($ItemCount)
    {
        $this->ItemCount = $ItemCount;
    }

    /**
     * @return mixed
     */
    public function getItemCount()
    {
        return $this->ItemCount;
    }

    /**
     * @param array $ItemInfo
     */
    public function setItemInfo($ItemInfo)
    {
        $this->ItemInfo = $ItemInfo;
    }

    /**
     * @return array
     */
    public function getItemInfo()
    {
        return $this->ItemInfo;
    }

    /**
     * @param mixed $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->Price;
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


} 