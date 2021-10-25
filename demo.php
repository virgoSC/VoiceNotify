<?php

require_once('./vendor/autoload.php');

$config = [
    'JuMei' => [
        'appId' => 'AwgVgmiJySWQSDxF',
        'appSecret' => 'AwgVgmiJySWQSDxFwFGs8vJrgWPgDabF',
        'templateId' => '453662',
        'notifyUrl' => 'http://api.dailycar.janfish.cn/capital/notify',
    ],

];

$voiceNotify = new \VoiceNotify\VoiceNotify($config);

if (1) {
    /**
     * @var \VoiceNotify\Http\JuMeiResponse $response
     */
    $response = $voiceNotify->send('18215626530', 'JuMei');
    var_dump($response->getCode(), $response->getBody(), $response->getMessage(), $response->getError());
    var_dump($response->isSuccess(),$response->getCallId(), $response->getTaskNo());
}

$notify = json_decode('{"callId":"YYTZ902243075585650689","callDesc":"110","callStatus":"1","callStatusText":"失败"}', true);

$response = $voiceNotify->notify('JuMei', $notify);

/**
 * @var \VoiceNotify\Notify\JuMeiNoNotify $response
 */
var_dump($response->getCallId(), $response->getCallStatus(), $response->getCallStatusText());
