<?php
/**
 * 注册服务
 *
 * User: snake
 * Date: 14-10-11
 * Time: 下午8:31
 */




class TServiceRegisterInfo
{
    public $ServiceID;
    public $TimeType; #时间类型:绝对值,相对值
    public $ServiceTime; #时间:TimeType_Relative,TimeType_Absolute


    /**
     * @param mixed $ServiceID
     */
    public function setServiceID($ServiceID)
    {
        $this->ServiceID = $ServiceID;
    }

    /**
     * @return mixed
     */
    public function getServiceID()
    {
        return $this->ServiceID;
    }

    /**
     * @param mixed $ServiceTime
     */
    public function setServiceTime($ServiceTime)
    {
        $this->ServiceTime = $ServiceTime;
    }

    /**
     * @return mixed
     */
    public function getServiceTime()
    {
        return $this->ServiceTime;
    }

    /**
     * @param mixed $TimeType
     */
    public function setTimeType($TimeType)
    {
        $this->TimeType = $TimeType;
    }

    /**
     * @return mixed
     */
    public function getTimeType()
    {
        return $this->TimeType;
    }

} 