<?php
/**
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午8:04
 */




class StatData
{
    public $StatIndex;
    public $StatValue;

    /**
     * @param mixed $StatIndex
     */
    public function setStatIndex($StatIndex)
    {
        $this->StatIndex = $StatIndex;
    }

    /**
     * @return mixed
     */
    public function getStatIndex()
    {
        return $this->StatIndex;
    }

    /**
     * @param mixed $StatValue
     */
    public function setStatValue($StatValue)
    {
        $this->StatValue = $StatValue;
    }

    /**
     * @return mixed
     */
    public function getStatValue()
    {
        return $this->StatValue;
    }
}