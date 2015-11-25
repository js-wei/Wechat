<?php
/**
 *
 * User: snake
 * Date: 14-10-7
 * Time: 下午9:10
 */




class Punish
{
    public $BlackLevel;
    public $ValidDate;
    public $PunishMethod;
    public $DescString;

    /**
     * @param mixed $BlackLevel
     */
    public function setBlackLevel($BlackLevel)
    {
        $this->BlackLevel = $BlackLevel;
    }

    /**
     * @return mixed
     */
    public function getBlackLevel()
    {
        return $this->BlackLevel;
    }

    /**
     * @param mixed $DescString
     */
    public function setDescString($DescString)
    {
        $this->DescString = $DescString;
    }

    /**
     * @return mixed
     */
    public function getDescString()
    {
        return $this->DescString;
    }

    /**
     * @param mixed $PunishMethod
     */
    public function setPunishMethod($PunishMethod)
    {
        $this->PunishMethod = $PunishMethod;
    }

    /**
     * @return mixed
     */
    public function getPunishMethod()
    {
        return $this->PunishMethod;
    }

    /**
     * @param mixed $ValidDate
     */
    public function setValidDate($ValidDate)
    {
        $this->ValidDate = $ValidDate;
    }

    /**
     * @return mixed
     */
    public function getValidDate()
    {
        return $this->ValidDate;
    }


} 