<?php
/**
 *
 * User: snake
 * Date: 14-11-16
 * Time: 下午3:05
 */




class StateDataGM
{
    public $Class;

    public $hallState; # class HallServerStateGM
    public $logicState;

    public function Decode(CodeEngine &$buf)
    {
        $len = 0;

        $DataSize = $buf->DecodeInt16();
        $len += 2;

        $this->Class = $buf->DecodeInt8();
        $DataSize -= 1;
        $len += 1;

        if (StateClass::HALL_SERVER_STATUE_DATA_TYPE == $this->Class) {
            $temp = new HallServerStateGM();
            $temp->State = $buf->DecodeInt32();
            $DataSize -= 4;
            $len += 4;

            $temp->ServerId = $buf->DecodeInt32();
            $DataSize -= 4;
            $len += 4;

            $this->hallState = $temp;
        } elseif (StateClass::LOGIC_SERVER_STATUE_DATA_TYPE == $this->Class) {
            $temp = new LogicServerState();
            $temp->RoomCount = $buf->DecodeInt8();
            $DataSize -= 1;
            $len += 1;

            if ($temp->RoomCount > MAX_ROOM_SESSION_COUNT) {
                $temp->RoomCount = MAX_ROOM_SESSION_COUNT;
            }

            $temp->Status = array();
            for ($i = 0; $i < $temp->RoomCount; $i++) {
                $temp1 = new UserStatus();
                $r = $temp1->Decode($buf);
                $DataSize -= $r;
                $len += $r;
                $temp->Status[] = $temp1;
            }

            $this->logicState = $temp;
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
    } # class LogicServerState


} 