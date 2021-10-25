<?php

namespace VoiceNotify\Allocator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use VoiceNotify\Http\JuMeiResponse;
use VoiceNotify\Http\Response;
use VoiceNotify\Notify\JuMeiNoNotify;

class JuMei implements Allocator
{
    private $appId;

    private $appSecret;

    private $templateId;

    private $notifyUrl;

    private $mainUrl = 'https://api.jumdata.com/voice-notify/send';

    public function __construct(array $config)
    {
        $this->appId = $config['appId'] ?? '';
        $this->appSecret = $config['appSecret'] ?? '';
        $this->templateId = $config['templateId'] ?? '';
        $this->notifyUrl = $config['notifyUrl'] ?? '';
    }

    public function Send(string $mobile, array $param = []): Response
    {
        $time = $this->millisecond();
        $postParam = [
            'appId' => $this->appId,
            'timestamp' => $time,
            'sign' => '',
            'mobile' => $mobile,
            'templateId' => $param['templateId'] ?: $this->templateId,
            'param' => $param['param'] ?? '',
            'playTimes' => $param['playTimes'] ?? '',
            'notifyUrl' => $param['notifyUrl'] ?? $this->notifyUrl,
            'notifyData' => $param['notifyData'] ?? ''
        ];
        $this->encrypt($postParam);
        return $this->request($postParam);
    }

    private function request($postParam): Response
    {
        $response = new JuMeiResponse();

        try {
            $client = new Client();
            $res = $client->request('POST', $this->mainUrl, [
                'form_params' => $postParam,
                'verify' => false,
                'debug' => false
            ]);
            $resBody = $res->getBody()->getContents();

            $response->setCode($res->getStatusCode())
                ->setBody($resBody)
                ->setHeader($res->getHeaders())
                ->resolve();
        } catch (GuzzleException $exception) {
            $response->setCode('500')
                ->setError($exception->getMessage());
        }
        return $response;
    }

    public function notify($data): JuMeiNoNotify
    {
        return (new JuMeiNoNotify())
            ->setCallId($data['callId'] ?? '')
            ->setCallDesc($data['callDesc'] ?? '')
            ->setCallTime($data[''])
            ->setCallStatus($data['callStatus'] ?? 'callStatus')
            ->setCallStatusText($data['callStatusText'] ?? '')
            ->setNotifyData($data['notifyData'] ?? '');
    }

    private function encrypt(&$data)
    {
        $data['sign'] = hash('sha256', $this->appId . $this->appSecret . $data['timestamp']);
    }

    private function millisecond(): string
    {
        list($s1, $s2) = explode(' ', microtime());
        return sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }
}