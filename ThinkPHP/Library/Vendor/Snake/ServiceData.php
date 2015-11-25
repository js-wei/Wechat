<?php
/**
 * 服务器数据
 *
 * User: snake
 * Date: 14-8-23
 * Time: 下午8:22
 */




class ServiceData
{
    public $Count;
    public $Service; # Service数组

    /**
     * @param mixed $Count
     */
    public function setCount($Count)
    {
        $this->Count = $Count;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->Count;
    }

    /**
     * @param mixed $Service
     */
    public function setService($Service)
    {
        $this->Service = $Service;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->Service;
    }

} 