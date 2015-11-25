<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午2:13
 */




class PlayerStatusInfo
{
    public $Uin;
    public $Account;
    public $ClassCount;
    public $StateData; # class StateData

    public function Decode(CodeEngine &$buf)
    {
        $len = 0;

        $PlayStatusSize = $buf->DecodeInt16();
        $len += 2;

        $this->Uin = $buf->DecodeInt32();
        $len += 4;
        $PlayStatusSize -= 4;

        $this->Account = $buf->DecodeString();
        //lsybegin
        //字符串前头自带2字节长度前缀，在字符数据之外
        $len += 2;
        $PlayStatusSize -= 2;
        //lsyend
        $len += strlen($this->Account);
        $PlayStatusSize -= strlen($this->Account);

        $this->ClassCount = $buf->DecodeInt8();
        $len += 1;
        $PlayStatusSize -= 1;

        if ($this->ClassCount > StateClass::MAX_CLASS_COUNT) {
            $this->ClassCount = StateClass::MAX_CLASS_COUNT;
        }

        $this->StateData = array();
        for ($i = 0; $i < $this->ClassCount; $i++) {
            $temp = new StateData();
            $r = $temp->Decode($buf);
            $len += $r;
            $PlayStatusSize -= $r;
            $this->StateData[] = $temp;
        }

        if ($PlayStatusSize < 0) {
            return
                0;
        } else {
            $len += $PlayStatusSize;
            $buf->DecodeMemory($PlayStatusSize);
        }

        return $len;
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
     * @param mixed $ClassCount
     */
    public function setClassCount($ClassCount)
    {
        $this->ClassCount = $ClassCount;
    }

    /**
     * @return mixed
     */
    public function getClassCount()
    {
        return $this->ClassCount;
    }

    /**
     * @param mixed $StateData
     */
    public function setStateData($StateData)
    {
        $this->StateData = $StateData;
    }

    /**
     * @return mixed
     */
    public function getStateData()
    {
        return $this->StateData;
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