<?php
/**
 *
 * User: snake
 * Date: 14-11-15
 * Time: 下午5:24
 */




class CResponsePublishAD
{
    public $ADID;
    public $ResultID;
    public $ReasonMessage;

    public $buffer;

    function __construct()
    {
    }


    public function getBuffer()
    {
        return $this->buffer->getBuffer();
    }

    public function Decode($buf = '')
    {
        $this->buffer = new CodeEngine($buf);
        $len = 0;

        $this->ADID = $this->buffer->DecodeInt32();
        $len += 4;

        $this->ResultID = $this->buffer->DecodeInt16();
        $len += 2;

        if (CSResultID::result_id_success == $this->ResultID) {
            $this->ReasonMessage = $this->buffer->DecodeString();
            $len += strlen($this->ReasonMessage);
        }
        # 这样子写是为了反射
        return $this;
    }

    /**
     * @param mixed $ADID
     */
    public function setADID($ADID)
    {
        $this->ADID = $ADID;
    }

    /**
     * @return mixed
     */
    public function getADID()
    {
        return $this->ADID;
    }

    /**
     * @param mixed $ReasonMessage
     */
    public function setReasonMessage($ReasonMessage)
    {
        $this->ReasonMessage = $ReasonMessage;
    }

    /**
     * @return mixed
     */
    public function getReasonMessage()
    {
        return $this->ReasonMessage;
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
    }
}