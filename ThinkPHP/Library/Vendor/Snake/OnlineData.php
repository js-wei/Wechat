<?php
/**
 *
 * User: snake
 * Date: 14-10-13
 * Time: 下午9:02
 */




class OnlineData
{
    public $LoginCount;
    public $HallServerId;
    public $HallPlayerId;

    /**
     * @param mixed $HallPlayerId
     */
    public function setHallPlayerId($HallPlayerId)
    {
        $this->HallPlayerId = $HallPlayerId;
    }

    /**
     * @return mixed
     */
    public function getHallPlayerId()
    {
        return $this->HallPlayerId;
    }

    /**
     * @param mixed $HallServerId
     */
    public function setHallServerId($HallServerId)
    {
        $this->HallServerId = $HallServerId;
    }

    /**
     * @return mixed
     */
    public function getHallServerId()
    {
        return $this->HallServerId;
    }

    /**
     * @param mixed $LoginCount
     */
    public function setLoginCount($LoginCount)
    {
        $this->LoginCount = $LoginCount;
    }

    /**
     * @return mixed
     */
    public function getLoginCount()
    {
        return $this->LoginCount;
    }


} 