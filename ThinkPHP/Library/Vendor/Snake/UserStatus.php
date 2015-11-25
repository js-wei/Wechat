<?php
/**
 *
 *
 * User: snake
 * Date: 14-11-13
 * Time: 下午9:31
 */




class UserStatus
{
    public $GameID;
    public $ServerID;
    public $RoomID;
    public $TableID;
    public $SeatID;
    public $State;
    public $Path;

    public function Decode(CodeEngine &$buf)
    {
        $len = 0;

        $StatusSize = $buf->DecodeInt16();
        $len += 2;

        $this->GameID = $buf->DecodeInt16();
        $len += 2;
        $StatusSize -= 2;

        $this->ServerID = $buf->DecodeInt32();
        $len += 4;
        $StatusSize -= 4;

        $this->RoomID = $buf->DecodeInt32();
        $len += 4;
        $StatusSize -= 4;

        $this->TableID = $buf->DecodeInt32();
        $len += 4;
        $StatusSize -= 4;

        $this->SeatID = $buf->DecodeInt8();
        $len += 1;
        $StatusSize -= 1;

        $this->State = $buf->DecodeInt8();
        $len += 1;
        $StatusSize -= 1;

        $this->Path = $buf->DecodeString();
        $StatusSize -= 2;
        $len += 2;
        $len += strlen($this->Path);
        $StatusSize -= strlen($this->Path);

        if ($StatusSize < 0) {
            return 0;
        } else {

            $buf->DecodeMemory($StatusSize);
            $len += $StatusSize;
        }

        return $len;
    }

    /**
     * @param mixed $GameID
     */
    public function setGameID($GameID)
    {
        $this->GameID = $GameID;
    }

    /**
     * @return mixed
     */
    public function getGameID()
    {
        return $this->GameID;
    }

    /**
     * @param mixed $Path
     */
    public function setPath($Path)
    {
        $this->Path = $Path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->Path;
    }

    /**
     * @param mixed $RoomID
     */
    public function setRoomID($RoomID)
    {
        $this->RoomID = $RoomID;
    }

    /**
     * @return mixed
     */
    public function getRoomID()
    {
        return $this->RoomID;
    }

    /**
     * @param mixed $SeatID
     */
    public function setSeatID($SeatID)
    {
        $this->SeatID = $SeatID;
    }

    /**
     * @return mixed
     */
    public function getSeatID()
    {
        return $this->SeatID;
    }

    /**
     * @param mixed $ServerID
     */
    public function setServerID($ServerID)
    {
        $this->ServerID = $ServerID;
    }

    /**
     * @return mixed
     */
    public function getServerID()
    {
        return $this->ServerID;
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
     * @param mixed $TableID
     */
    public function setTableID($TableID)
    {
        $this->TableID = $TableID;
    }

    /**
     * @return mixed
     */
    public function getTableID()
    {
        return $this->TableID;
    }
} 