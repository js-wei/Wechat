<?php
/**
 *
 * User: snake
 * Date: 14-11-16
 * Time: 下午3:06
 */




class HallServerStateGM
{
    public $State;
    public $ServerId;

    /**
     * @param mixed $ServerId
     */
    public function setServerId($ServerId)
    {
        $this->ServerId = $ServerId;
    }

    /**
     * @return mixed
     */
    public function getServerId()
    {
        return $this->ServerId;
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

}