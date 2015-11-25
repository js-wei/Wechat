<?php
/**
 *
 * User: snake
 * Date: 14-10-9
 * Time: 下午9:10
 */




class CRequestUpdatePlayerCardID
{
    public $Uin;
    public $Account;
    public $IDCard;
    public $UserName; #max_player_name_length

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
            ->EncodeString($this->IDCard)
            ->EncodeString($this->UserName);
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);

        $this->Uin = $this->buffer->DecodeInt32();
        $this->Account = $this->buffer->DecodeString();
        $this->IDCard = $this->buffer->DecodeString();
        $this->UserName = $this->buffer->DecodeString();
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
     * @param mixed $IDCard
     */
    public function setIDCard($IDCard)
    {
        $this->IDCard = $IDCard;
    }

    /**
     * @return mixed
     */
    public function getIDCard()
    {
        return $this->IDCard;
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
     * @param mixed $UserName
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->UserName;
    }


} 