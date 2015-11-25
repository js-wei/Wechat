<?php
/**
 * 广告信息结构
 *
 * User: snake
 * Date: 14-8-19
 * Time: 下午10:04
 */




class ADInfo
{
    public $ADInfoLength;
    public $ADID;
    public $StartTime;
    public $EndTime;
    public $CycleType;
    public $URL;
    public $MacCount;
    public $State;

    /**
     * @param mixed $ADID
     */
    public function setADID($ADID)
    {
        $this->ADID = $ADID;
    }

    /**
     * @return mixed
     */
    public function getADID()
    {
        return $this->ADID;
    }

    /**
     * @param mixed $ADInfoLength
     */
    public function setADInfoLength($ADInfoLength)
    {
        $this->ADInfoLength = $ADInfoLength;
    }

    /**
     * @return mixed
     */
    public function getADInfoLength()
    {
        return $this->ADInfoLength;
    }

    /**
     * @param mixed $CycleType
     */
    public function setCycleType($CycleType)
    {
        $this->CycleType = $CycleType;
    }

    /**
     * @return mixed
     */
    public function getCycleType()
    {
        return $this->CycleType;
    }

    /**
     * @param mixed $EndTime
     */
    public function setEndTime($EndTime)
    {
        $this->EndTime = $EndTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->EndTime;
    }

    /**
     * @param mixed $MacCount
     */
    public function setMacCount($MacCount)
    {
        $this->MacCount = $MacCount;
    }

    /**
     * @return mixed
     */
    public function getMacCount()
    {
        return $this->MacCount;
    }

    /**
     * @param mixed $StartTime
     */
    public function setStartTime($StartTime)
    {
        $this->StartTime = $StartTime;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->StartTime;
    }

    /**
     * @param mixed $State
     */
    public function setState($State)
    {
        $this->State = $State;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->State;
    }

    /**
     * @param mixed $URL
     */
    public function setURL($URL)
    {
        $this->URL = $URL;
    }

    /**
     * @return mixed
     */
    public function getURL()
    {
        return $this->URL;
    }


} 