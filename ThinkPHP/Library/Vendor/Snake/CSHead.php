<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-5
 * Time: 下午4:21
 */



define("INVALID_OBJECT_ID",-1);
define("FAIL",-1);
define("MAX_CS_HEAD_OPTION_LENGTH",128);

class CSHead
{
    public $nPackageLength; //头部长度 + Body长度
    public $nUIN; # [必填] 被惩罚用户的UIN(错误) 状态服务器(写死1)
    public $shFlag; # [] 填写0
    public $nOptionalLen; // 填写0

    public $lpbyOptional; // 填写''
    public $nHeaderLen; // 消息头的长度
    public $shMessageID; // 消息功能的ID 比如:CS_MSG_GM_PUNISH
    public $shMessageType; // 返回过来的应该是 MSG_TYPE_RESPONSE
    public $shVersion; // 填写 1
    public $nPlayerID; # [必填] 被惩罚用户的UIN
    public $nSequence; // sequence 使用加密传输 假设它是一个事务ID

    public $buffer = '';

    public function getBuffer(){
        return $this->buffer->getBuffer();
    }

    public function __construct()
    {
        # -1
        $this->nPlayerID = INVALID_OBJECT_ID;
    }

    public function Encode(){
        # 检查属性是否为空
        $this->buffer = new CodeEngine();
        $this->buffer->EncodeInt32($this->nPackageLength)
            ->EncodeInt32($this->nUIN)
            ->EncodeInt16($this->shFlag)
            ->EncodeInt16($this->nOptionalLen);

        if($this->nOptionalLen > 0 && $this->nOptionalLen <= MAX_CS_HEAD_OPTION_LENGTH){
            $this->buffer->EncodeMemory($this->lpbyOptional,$this->nOptionalLen);
        }

        $this->buffer->EncodeInt16($this->nHeaderLen)
            ->EncodeInt16($this->shMessageID)
            ->EncodeInt16($this->shMessageType)
            ->EncodeInt16($this->shVersion)
            ->EncodeInt32($this->nPlayerID)
            ->EncodeInt32($this->nSequence);
        return $this;
    }

    public function Decode($buf){
        $this->buffer = new CodeEngine($buf);

        $decodelen = 0;
        $this->nPackageLength = $this->buffer->DecodeInt32();
        $decodelen += 4;
        $this->nUIN = $this->buffer->DecodeInt32();
        $decodelen += 4;
        $this->shFlag = $this->buffer->DecodeInt16();
        $decodelen += 2;
        $this->nOptionalLen = $this->buffer->DecodeInt16();
        $decodelen += 2;

        if($this->nOptionalLen > 0 && $this->nOptionalLen <= MAX_CS_HEAD_OPTION_LENGTH){
            $this->lpbyOptional = $this->buffer->DecodeMemory($this->nOptionalLen);
            $decodelen += $this->nOptionalLen;
        }

        $this->nHeaderLen = $this->buffer->DecodeInt16();
        $decodelen += 2;
        $this->shMessageID = $this->buffer->DecodeInt16();
        $decodelen += 2;
        $this->shMessageType = $this->buffer->DecodeInt16();
        $decodelen += 2;
        $this->shVersion = $this->buffer->DecodeInt16();
        $decodelen += 2;
        $this->nPlayerID = $this->buffer->DecodeInt32();
        $decodelen += 4;
        $this->nSequence = $this->buffer->DecodeInt32();
        $decodelen += 4;
        return $decodelen;
    }

    public function Size(){

    }

    public function Dump(){

    }

    /**
     * @param mixed $lpbyOptional
     */
    public function setLpbyOptional($lpbyOptional)
    {
        $this->lpbyOptional = $lpbyOptional;
    }

    /**
     * @return mixed
     */
    public function getLpbyOptional()
    {
        return $this->lpbyOptional;
    }

    /**
     * @param mixed $nHeaderLen
     */
    public function setNHeaderLen()
    {
        $this->nHeaderLen = 4+4+2+2+2+2+2+2+4+4;
        if($this->nOptionalLen > 0){
            $this->nHeaderLen += $this->nOptionalLen;
        }
    }

    /**
     * @return mixed
     */
    public function getNHeaderLen()
    {
        return $this->nHeaderLen;
    }

    /**
     * @param mixed $nOptionalLen
     */
    public function setNOptionalLen($nOptionalLen)
    {
        $this->nOptionalLen = $nOptionalLen;
    }

    /**
     * @return mixed
     */
    public function getNOptionalLen()
    {
        return $this->nOptionalLen;
    }

    /**
     * @param mixed $nPackageLength
     */
    public function setNPackageLength($nPackageLength)
    {
        $this->nPackageLength = $nPackageLength;
    }

    /**
     * @return mixed
     */
    public function getNPackageLength()
    {
        return $this->nPackageLength;
    }

    /**
     * @param int $nPlayerID
     */
    public function setNPlayerID($nPlayerID)
    {
        $this->nPlayerID = $nPlayerID;
    }

    /**
     * @return int
     */
    public function getNPlayerID()
    {
        return $this->nPlayerID;
    }

    /**
     * @param mixed $nSequence
     */
    public function setNSequence($nSequence)
    {
        $this->nSequence = $nSequence;
    }

    /**
     * @return mixed
     */
    public function getNSequence()
    {
        return $this->nSequence;
    }

    /**
     * @param mixed $nUIN
     */
    public function setNUIN($nUIN)
    {
        $this->nUIN = $nUIN;
    }

    /**
     * @return mixed
     */
    public function getNUIN()
    {
        return $this->nUIN;
    }

    /**
     * @param mixed $shFlag
     */
    public function setShFlag($shFlag)
    {
        $this->shFlag = $shFlag;
    }

    /**
     * @return mixed
     */
    public function getShFlag()
    {
        return $this->shFlag;
    }

    /**
     * @param mixed $shMessageID
     */
    public function setShMessageID($shMessageID)
    {
        $this->shMessageID = $shMessageID;
    }

    /**
     * @return mixed
     */
    public function getShMessageID()
    {
        return $this->shMessageID;
    }

    /**
     * @param mixed $shMessageType
     */
    public function setShMessageType($shMessageType)
    {
        $this->shMessageType = $shMessageType;
    }

    /**
     * @return mixed
     */
    public function getShMessageType()
    {
        return $this->shMessageType;
    }

    /**
     * @param mixed $shVersion
     */
    public function setShVersion($shVersion)
    {
        $this->shVersion = $shVersion;
    }

    /**
     * @return mixed
     */
    public function getShVersion()
    {
        return $this->shVersion;
    }


}