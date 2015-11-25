<?php
/**
 * 生日
 *
 * User: snake
 * Date: 14-8-21
 * Time: 下午9:13
 */




class Birthday
{
    public $Year;
    public $Month;
    public $Day;

    /**
     * @param mixed $Day
     */
    public function setDay($Day)
    {
        $this->Day = $Day;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->Day;
    }

    /**
     * @param mixed $Month
     */
    public function setMonth($Month)
    {
        $this->Month = $Month;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->Month;
    }

    /**
     * @param mixed $Year
     */
    public function setYear($Year)
    {
        $this->Year = $Year;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->Year;
    }


} 