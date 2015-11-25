<?php
/**
 * 
 * User: snake
 * Date: 14-6-9
 * Time: 下午9:51
 */




class CNotifyItemDBTransferMessage {
    public $SourceUin;
    public $DestUin;
    public $DataSize;
    public $TransparentData;

    public $buffer;

    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Encode(){
        $this->buffer = new CodeEngine();

        $this->buffer->EncodeInt32($this->SourceUin)
            ->EncodeInt32($this->DestUin)
            ->EncodeInt16($this->DataSize)
            ->EncodeMemory($this->DataSize,$this->TransparentData);

        return $this;
    }

    public function Decode($buf = ''){
        $this->buffer = new CodeEngine($buf);

        $this->SourceUin = $this->buffer->DecodeInt32();
        $this->DestUin = $this->buffer->DecodeInt32();
        $this->DataSize = $this->buffer->DecodeInt16();
        $this->TransparentData = $this->buffer->DecodeMemory($this->DataSize);

        return $this;
    }
} 