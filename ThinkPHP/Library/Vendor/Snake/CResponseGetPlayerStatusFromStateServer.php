<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午1:55
 */




class CResponseGetPlayerStatusFromStateServer
{
    public $ResultID;
    public $MyUin;
    public $Count;
    public $PlayerStatus;

    public $buffer;

    function __construct()
    {
        $this->Count = 0;
    }


    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);
        $len = 0;
        $this->ResultID = $this->buffer->DecodeInt16();
        $len += 2;

        $this->MyUin = $this->buffer->DecodeInt16();
        $len += 2;

        if ($this->ResultID == CSResultID::result_id_success) {
            $this->Count = $this->buffer->DecodeInt16();
            $len += 2;

            if (MAX_RESPONSE_PLAYER_COUNT < $this->Count) {
                $this->Count = MAX_RESPONSE_PLAYER_COUNT;
            }

            for ($i = 0; $i < $this->Count; $i++) {
                $temp = new PlayerStatusInfo();
                $r = $temp->Decode($this->buffer);
                $len += $r;
            }
        }

        # 这样子写是为了反射
        return $this;
    }

    /**
     * @param mixed $MyUin
     */
    public function setMyUin($MyUin)
    {
        $this->MyUin = $MyUin;
    }

    /**
     * @return mixed
     */
    public function getMyUin()
    {
        return $this->MyUin;
    }

    /**
     * @param mixed $PlayerStatus
     */
    public function setPlayerStatus($PlayerStatus)
    {
        $this->PlayerStatus = $PlayerStatus;
    }

    /**
     * @return mixed
     */
    public function getPlayerStatus()
    {
        return $this->PlayerStatus;
    }

    /**
     * @param mixed $ResultID
     */
    public function setResultID($ResultID)
    {
        $this->ResultID = $ResultID;
    }

    /**
     * @return mixed
     */
    public function getResultID()
    {
        return $this->ResultID;
    } # class PlayerStatusInfo

} 