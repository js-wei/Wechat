<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午2:00
 */




class HallServerState
{
    public $State;

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