<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-5
 * Time: 下午6:20
 */




class XteaPassport {
    public  $ZERO_LENGTH = 7;
    public  $ENCRYPT_BLOCK_LENGTH_IN_BYTE = 8;
    public  $DECRYPT_ROUNDS = -32;
    public  $ENCRYPT_ROUNDS = 32;

    function Decrypt($pbyInBuffer, $arrbyKey) {
        $nInBufferLength = strlen($pbyInBuffer);
        $pbyOutCursor = array ();
        if ($pbyInBuffer == NULL || $nInBufferLength <= 0) {
            return false;
        }

        // Buffer长度应该是能被 $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE 整除的
        if ($nInBufferLength % $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE || $nInBufferLength <= $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE) {
            return false;
        }

        $pbyInCursor = $pbyInBuffer;

        // 先解出最前面包含Pad的$this->ENCRYPT_BLOCK_LENGTH_IN_BYTE个Byte
        $arrbyFirstCrytped8Bytes = substr($pbyInCursor, 0, $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE);
        $arrbyFirstCrytped8Bytes = $this->str2arr($arrbyFirstCrytped8Bytes);
        $arrbyFirst8Bytes = $this->xtea($arrbyFirstCrytped8Bytes, $arrbyKey, $this->DECRYPT_ROUNDS);
        $pbyInCursor = substr($pbyInCursor, $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE);
        // Pad长度只是用了第一个字节的最低3bit，高5bit是随机数
        $nPadLength = ord($arrbyFirst8Bytes[0]) & 0x07;

        // 计算原始数据的长度
        $nPlainDataLength = $nInBufferLength - 1 - $nPadLength - $this->ZERO_LENGTH;
        if ($nPlainDataLength <= 0) {
            return false;
        }

        // 前一块的明文和密文，用于后面的异或操作
        $pbyLast8BytesCryptedData = $arrbyFirstCrytped8Bytes;
        $pbyLast8BytesPlainData = $arrbyFirst8Bytes;

        // 将第一块里Pad信息之后的数据移到输出Buffer
        for ($i = 0; $i < 7 - $nPadLength; ++$i) {
            $pbyOutCursor[] = $arrbyFirst8Bytes[1 + $nPadLength + $i];
        }

        // 解密除了最后一块以外的所有块
        // 同加密过程，下面注释掉的，是不改动InBuffer的

        $arrbySrcBuffer = array (0, 0, 0, 0, 0, 0, 0, 0);
        while (strlen($pbyInCursor) > $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE) {
            $arrbySrcBuffer = substr($pbyInCursor, 0, $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE);
            $arrbySrcBuffer = $this->str2arr($arrbySrcBuffer);
            // 和上一个8char明文异或
            for ($i = 0; $i < $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE; ++$i) {
                $arrbySrcBuffer[$i] ^= $pbyLast8BytesPlainData[$i];
            }
            $result = $this->xtea($arrbySrcBuffer, $arrbyKey, $this->DECRYPT_ROUNDS);
            // 和上一个8char密文异或
            for ($i = 0; $i < $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE; ++$i) {
                $result[$i] ^= $pbyLast8BytesCryptedData[$i];
            }
            $pbyOutCursor = array_merge($pbyOutCursor, $result);

            $pbyLast8BytesCryptedData = $this->str2arr(substr($pbyInCursor, 0, $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE));
            $pbyLast8BytesPlainData = $result;

            $pbyInCursor = substr($pbyInCursor, $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE);
        }

        // 最后8Byte， 最后有7Byte的校验
        $arrbyLast8Bytes = array (0, 0, 0, 0, 0, 0, 0, 0);
        $arrbySrcBuffer = substr($pbyInCursor, 0, $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE);
        $arrbySrcBuffer = $this->str2arr($arrbySrcBuffer);
        // 和上一个8Byte明文异或
        for ($i = 0; $i < $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE; ++$i) {
            $arrbySrcBuffer[$i] ^= $pbyLast8BytesPlainData[$i];
        }
        $arrbyLast8Bytes = $this->xtea($arrbySrcBuffer, $arrbyKey, $this->DECRYPT_ROUNDS);
        // 和上一个8Byte密文异或
        for ($i = 0; $i < $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE; ++$i) {
            $arrbyLast8Bytes[$i] ^= $pbyLast8BytesCryptedData[$i];
        }

        // 校验最后的0
        for ($i = 1; $i < $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE; ++$i) {
            if ($arrbyLast8Bytes[$i] != chr(0)) {
                return false;
            }
        }
        $pbyOutCursor[] = $arrbyLast8Bytes[0];

        return implode('', $pbyOutCursor);
    }

    function xtea($v, $k, $N) {
        $o = false;
        $k = unpack("V*", $k);
        $k = array_values($k);
        if (is_array($v)) {
            $v = implode('', $v);
        }
        $v = unpack("V*", $v);

        $y = $v[1];
        $z = $v[2];
        $DELTA = 0x9e3779b9; // 0x00000000 - 0x61C88647 == 0x9e3779b9

        if ($N > 0) {
            // Encoding
            $sum = 0;
            $count = 0;
            for ($i = 0; $i < $N; $i++) {
                $y = $this->add($y, $this->add($z << 4 ^ $this->rshift($z, 5), $z) ^ $this->add($sum, $k[$sum & 3]));
                $sum = $this->add($sum, $DELTA);
                $z = $this->add($z, $this->add($y << 4 ^ $this->rshift($y, 5), $y) ^ $this->add($sum, $k[$this->rshift($sum, 11) & 3]));
            }
        } else {
            // Decoding
            $sum= 0xC6EF3720;
            for ($i = 0; $i < -$N; $i++) {
                $z = $this->add($z, -($this->add($y << 4 ^ $this->rshift($y, 5), $y) ^ $this->add($sum, $k[$this->rshift($sum, 11) & 3])));
                $sum = $this->add($sum, -$DELTA);
                $y = $this->add($y, -($this->add($z << 4 ^ $this->rshift($z, 5), $z) ^ $this->add($sum, $k[$sum & 3])));
            }
        }

        $ret = pack('V', $y) . pack('V', $z);
        $arr = $this->str2arr($ret);

        return $arr;
    }

    public function Encrypt($pbyInBuffer,$arrbyKey){
        $len = strlen($pbyInBuffer);
        $temp = (int)fmod($len,$this->ENCRYPT_BLOCK_LENGTH_IN_BYTE);

        $padbytes = 0;
        if($temp != 0){
            # 补齐字节数
            $padbytes = $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE - $temp;
            $padstr = substr('ABCDEFGH',0,$padbytes);
            $pbyInBuffer = $padstr . $pbyInBuffer;
        }

        $firstbyte = chr(mt_rand(1,255));
        $firstbyte = (ord($firstbyte) & (255-7)) + $padbytes;
        $firstbyte = chr($firstbyte);

        $ttemp = '';
        for($i=$this->ENCRYPT_BLOCK_LENGTH_IN_BYTE - 1; $i>0; $i--){
            $ttemp = $ttemp . chr(0);
        }

        $pbyInBuffer = $firstbyte . $pbyInBuffer . $ttemp ;

        $pbyLast8BytesCryptedData = '';
        $pbyLast8BytesPlainData = '';

        $result = '';

        $encryptedlen = 0;
        $pbyOutCursor = array();
        $len = strlen($pbyInBuffer);
        while( $encryptedlen < $len )
        {
            $src = substr( $pbyInBuffer, $encryptedlen, $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE);
            $arrbySrcBuffer = $this->str2arr($src);
            if( !empty($pbyLast8BytesCryptedData))
            {
                // 和上一个8char密文异或
                for ($i = 0; $i < $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE; ++$i) {
                    $arrbySrcBuffer[$i] ^= $pbyLast8BytesCryptedData[$i];
                }
            }

            $result = $this->xtea($arrbySrcBuffer, $arrbyKey, $this->ENCRYPT_ROUNDS);

            // 和上一个8char明文异或
            if( !empty( $pbyLast8BytesPlainData))
            {
                for ($i = 0; $i < $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE; ++$i) {
                    $result[$i] ^= $pbyLast8BytesPlainData[$i];
                }
            }
            $pbyOutCursor = array_merge($pbyOutCursor, $result);

            $pbyLast8BytesCryptedData = $result;
            $pbyLast8BytesPlainData = $this->str2arr( $src );
            $encryptedlen += $this->ENCRYPT_BLOCK_LENGTH_IN_BYTE;
        }

        return $this->arr2str( $pbyOutCursor );
    }

    function str2arr($str) {
        $arr = array ();
        while(strlen($str) > 0) {
            $arr[] = strval(substr($str, 0, 1));
            $str = substr($str, 1);
        }

        return $arr;
    }

    public function arr2str($arr){
        return implode('',$arr);
    }

    public function add($i1, $i2) {
        $result = 0.0;

        foreach (func_get_args() as $value) {
            // remove sign if necessary
            if (0.0 > $value) {
                $value -= 1.0 + 0xffffffff;
            }

            $result += $value;
        }

        // convert to 32 bits
        if (0xffffffff < $result || -0xffffffff > $result) {
            $result = fmod($result, 0xffffffff + 1);
        }

        // convert to signed integer
        if (0x7fffffff < $result) {
            $result -= 0xffffffff + 1.0;
        } elseif (-0x80000000 > $result) {
            $result += 0xffffffff + 1.0;
        }

        return $result;
    }

    function rshift($integer, $n) {
        // convert to 32 bits
        if (0xffffffff < $integer || -0xffffffff > $integer) {
            $integer = fmod($integer, 0xffffffff + 1);
        }

        // convert to unsigned integer
        if (0x7fffffff < $integer) {
            $integer -= 0xffffffff + 1.0;
        } elseif (-0x80000000 > $integer) {
            $integer += 0xffffffff + 1.0;
        }

        // do right shift
        if (0 > $integer) {
            $integer &= 0x7fffffff;                     // remove sign bit before shift
            $integer >>= $n;                            // right shift
            $integer |= 1 << (31 - $n);                 // set shifted sign bit
        } else {
            $integer >>= $n;                            // use normal right shift
        }

        return $integer;
    }
}