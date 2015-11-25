<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午2:01
 */




class LogicServerState
{
    public $RoomCount;
    public $Status;

    /**
     * @param mixed $RoomCount
     */
    public function setRoomCount($RoomCount)
    {
        $this->RoomCount = $RoomCount;
    }

    /**
     * @return mixed
     */
    public function getRoomCount()
    {
        return $this->RoomCount;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    } # class UserStatus


} 