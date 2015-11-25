<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午2:06
 */




class StateData
{
    public $Class;
    public $hallState;
    public $logicState;

    public function Decode(CodeEngine &$buf)
    {
        $len = 0;

        $DataSize = $buf->DecodeInt16();
        $len += 2;

        $this->Class = $buf->DecodeInt8();
        $len += 1;
        $DataSize -= 1;

        if (StateClass::HALL_SERVER_STATUE_DATA_TYPE == $this->Class) {
            $this->hallState = new HallServerState();
            $this->hallState->setState($buf->DecodeInt32());
            $len += 4;
            $DataSize -= 4;
        } elseif (StateClass::LOGIC_SERVER_STATUE_DATA_TYPE == $this->Class) {
            $this->logicState = new LogicServerState();
            $this->logicState->setRoomCount($buf->DecodeInt8());
            $len += 1;
            $DataSize -= 1;

            if ($this->logicState->RoomCount > MAX_ROOM_SESSION_COUNT) {
                $this->logicState->setRoomCount(MAX_ROOM_SESSION_COUNT);
            }

            $this->logicState->setStatus(array());
            for ($i = 0; $i < $this->logicState->RoomCount; $i++) {
                $temp = new UserStatus();
                $r = $temp->Decode($buf);
                $len += $r;
                $DataSize -= $r;
                $this->logicState->Status[] = $temp;
            }
        } else {
            return 0;
        }

        if ($DataSize < 0) {
            return 0;
        } else {
            $len += $DataSize;
            $buf->DecodeMemory($DataSize);
        }

        return $len;
    }

    /**
     * @param mixed $Class
     */
    public function setClass($Class)
    {
        $this->Class = $Class;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->Class;
    }

    /**
     * @param mixed $hallState
     */
    public function setHallState($hallState)
    {
        $this->hallState = $hallState;
    }

    /**
     * @return mixed
     */
    public function getHallState()
    {
        return $this->hallState;
    }

    /**
     * @param mixed $logicState
     */
    public function setLogicState($logicState)
    {
        $this->logicState = $logicState;
    }

    /**
     * @return mixed
     */
    public function getLogicState()
    {
        return $this->logicState;
    }


} 