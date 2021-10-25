<?php

namespace VoiceNotify\Notify;

use VoiceNotify\Http\Response;

class JuMeiNoNotify extends Notify
{
    private $callId;

    private $callTime;

    private $callDesc;

    private $notifyData;

    private $callStatus;

    private $callStatusText;


    /**
     * @return mixed
     */
    public function getCallTime()
    {
        return $this->callTime;
    }

    /**
     * @param mixed $callTime
     */
    public function setCallTime($callTime): self
    {
        $this->callTime = $callTime;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getNotifyData()
    {
        return $this->notifyData;
    }

    /**
     * @param mixed $notifyData
     */
    public function setNotifyData($notifyData): self
    {
        $this->notifyData = $notifyData;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCallId()
    {
        return $this->callId;
    }

    /**
     * @param mixed $callId
     */
    public function setCallId($callId): self
    {
        $this->callId = $callId;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getCallDesc()
    {
        return $this->callDesc;
    }

    /**
     * @param mixed $callDesc
     */
    public function setCallDesc($callDesc): self
    {
        $this->callDesc = $callDesc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCallStatus()
    {
        return $this->callStatus;
    }

    /**
     * @param mixed $callStatus
     */
    public function setCallStatus($callStatus): self
    {
        $this->callStatus = $callStatus;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getCallStatusText()
    {
        return $this->callStatusText;
    }

    /**
     * @param mixed $callStatusText
     */
    public function setCallStatusText($callStatusText): self
    {
        $this->callStatusText = $callStatusText;
        return $this;

    }
}