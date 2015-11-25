<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-5
 * Time: 下午2:58
 */




class CodeEngine {
    private $beb = '';

    public function getBuffer(){
        return $this->beb->getBytes();
    }

    public function __construct($buf = '')
    {
        $this->beb = new BigEndianBytesBuffer($buf);
    }

    public function EncodeInt8($char){
        $this->beb->writeChar($char);
        return $this;
    }

    public function DecodeInt8(){
        return $this->beb->readChar();
    }

    public function EncodeInt16($num){
        $this->beb->writeShort($num);
        return $this;
    }

    public function DecodeInt16(){
        return $this->beb->readShort();
    }

    public function EncodeInt32($num){
        $this->beb->writeInt($num);
        return $this;
    }

    public function DecodeInt32(){
        return $this->beb->readInt();
    }

    public function EncodeInt64($num){
        $this->beb->writeLong($num);
        return $this;
    }

    public function DecodeInt64(){
        return $this->beb->readLong();
    }

    public function EncodeString($str){
        $str = $str . chr(0);
        $len = strlen($str);

        $this->EncodeInt16($len);
        $this->beb->writeBytes($str);
        return $this;
    }

    public function DecodeString(){
        $len = $this->DecodeInt16();

        $str = $this->beb->readBytes($len);
        return $str;
    }

    public function EncodeMemory($bytes,$length){
        if(is_null($bytes) || strlen($bytes) != $length){
            return false;
        }
        $this->beb->writeBytes($bytes);
        return $this;
    }

    public function DecodeMemory($length){
        return $this->beb->readBytes($length);
    }
} 