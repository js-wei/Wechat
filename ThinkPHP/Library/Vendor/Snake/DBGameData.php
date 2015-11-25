<?php
/**
 * 玩家游戏数据
 *
 * User: snake
 * Date: 14-8-22
 * Time: 下午8:12
 */



/**
 * Class DBGameData UserGameInfo
 * @package Snake
 */
class DBGameData
{
    public $GameID; //游戏类型编号

    public $Level; //积分等级

    public $Point; //积分

    public $WinRound; //赢
    public $LoseRound; //输
    public $DrawRound; //平局
    public $EscapeRound; //逃跑局数

    public $OrgID; //所属帮派
    public $Position; //帮派位置

    public $TotalSecs; //游戏时间
    public $LastDate; //最后玩的时间
    public $GameConfig; //游戏配置
    public $ExtGameInfo; //游戏扩展数据

    public function Encode(CodeEngine &$buf)
    {
        $length = 2 * 3 + 1 + 4 * 7 + $this->ExtGameInfo->getLength() + $this->GameConfig->getLength();
        $buf->EncodeInt16($length) # 需要重新计算
            ->EncodeInt16($this->GameID)
            ->EncodeInt8($this->Level)
            ->EncodeInt32($this->Point)
            ->EncodeInt32($this->WinRound)
            ->EncodeInt32($this->LoseRound)
            ->EncodeInt32($this->DrawRound)
            ->EncodeInt32($this->EscapeRound)
            ->EncodeInt32($this->OrgID)
            ->EncodeInt16($this->Position)
            ->EncodeInt32($this->TotalSecs)
            ->EncodeString($this->LastDate);

        $this->ExtGameInfo->Encode($buf);
        $this->GameConfig->Encode($buf);
    }

    public function Decode(CodeEngine &$buf)
    {
        $len = $buf->DecodeInt16();
        $len -= 2;

        $this->GameID = $buf->DecodeInt16();
        $len -= 2;

        $this->Level = $buf->DecodeInt8();
        $len -= 1;

        $this->Point = $buf->DecodeInt32();
        $len -= 4;

        $this->WinRound = $buf->DecodeInt32();
        $len -= 4;

        $this->LoseRound = $buf->DecodeInt32();
        $len -= 4;

        $this->DrawRound = $buf->DecodeInt32();
        $len -= 4;

        $this->EscapeRound = $buf->DecodeInt32();
        $len -= 4;

        $this->OrgID = $buf->DecodeInt32();
        $len -= 4;

        $this->Position = $buf->DecodeInt16();
        $len -= 2;

        $this->TotalSecs = $buf->DecodeInt32();
        $len -= 4;

        $this->LastDate = $buf->DecodeString();
        $len -= strlen($this->LastDate);

        $this->ExtGameInfo = new TDBExtGameInfo();
        $this->ExtGameInfo->Decode($buf);

        $this->GameConfig = new PlayerGameConfig();
        $this->GameConfig->Decode($buf);

        return $len;
    }

    /**
     * @param mixed $DrawRound
     */
    public function setDrawRound($DrawRound)
    {
        $this->DrawRound = $DrawRound;
    }

    /**
     * @return mixed
     */
    public function getDrawRound()
    {
        return $this->DrawRound;
    }

    /**
     * @param mixed $EscapeRound
     */
    public function setEscapeRound($EscapeRound)
    {
        $this->EscapeRound = $EscapeRound;
    }

    /**
     * @return mixed
     */
    public function getEscapeRound()
    {
        return $this->EscapeRound;
    }

    /**
     * @param mixed $ExtGameInfo
     */
    public function setExtGameInfo($ExtGameInfo)
    {
        $this->ExtGameInfo = $ExtGameInfo;
    }

    /**
     * @return mixed
     */
    public function getExtGameInfo()
    {
        return $this->ExtGameInfo;
    }

    /**
     * @param mixed $GameConfig
     */
    public function setGameConfig($GameConfig)
    {
        $this->GameConfig = $GameConfig;
    }

    /**
     * @return mixed
     */
    public function getGameConfig()
    {
        return $this->GameConfig;
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
     * @param mixed $LastDate
     */
    public function setLastDate($LastDate)
    {
        $this->LastDate = $LastDate;
    }

    /**
     * @return mixed
     */
    public function getLastDate()
    {
        return $this->LastDate;
    }

    /**
     * @param mixed $Level
     */
    public function setLevel($Level)
    {
        $this->Level = $Level;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->Level;
    }

    /**
     * @param mixed $LoseRound
     */
    public function setLoseRound($LoseRound)
    {
        $this->LoseRound = $LoseRound;
    }

    /**
     * @return mixed
     */
    public function getLoseRound()
    {
        return $this->LoseRound;
    }

    /**
     * @param mixed $OrgID
     */
    public function setOrgID($OrgID)
    {
        $this->OrgID = $OrgID;
    }

    /**
     * @return mixed
     */
    public function getOrgID()
    {
        return $this->OrgID;
    }

    /**
     * @param mixed $Point
     */
    public function setPoint($Point)
    {
        $this->Point = $Point;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->Point;
    }

    /**
     * @param mixed $Position
     */
    public function setPosition($Position)
    {
        $this->Position = $Position;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->Position;
    }

    /**
     * @param mixed $TotalSecs
     */
    public function setTotalSecs($TotalSecs)
    {
        $this->TotalSecs = $TotalSecs;
    }

    /**
     * @return mixed
     */
    public function getTotalSecs()
    {
        return $this->TotalSecs;
    }

    /**
     * @param mixed $WinRound
     */
    public function setWinRound($WinRound)
    {
        $this->WinRound = $WinRound;
    }

    /**
     * @return mixed
     */
    public function getWinRound()
    {
        return $this->WinRound;
    }

} 