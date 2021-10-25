<?php

namespace VoiceNotify\Http;

class JuMeiResponse extends Response
{

    private $taskNo;

    private $callId;

    public function resolve()
    {
        if ($this->code !== '200') {
            $this->setError($this->body);
        } else {
            if (json_decode($this->body)) {
                $this->body = json_decode($this->body, true);
                if ($code = $this->body['code'] ?? '' and $code == '200') {
                    $this->code = '200';
                } else {
                    $this->code = $code;
                }
                $this->taskNo = $this->body['taskNo'] ?? '';
                $this->callId = $this->body['data']['callId'] ?? '';
            } else {
                $this->setError($this->body);
            }
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaskNo()
    {
        return $this->taskNo;
    }

    /**
     * @return mixed
     */
    public function getCallId()
    {
        return $this->callId;
    }
}