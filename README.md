# VoiceNotify

语音通知

```phpregexp

$config = [
    'JuMei' => [ //聚美
        'appId' => 'appId',
        'appSecret' => 'appSecret',
        'templateId' => 'templateId',
        'notifyUrl' => 'notifyUrl',
    ],

];

$voiceNotify = new \VoiceNotify\VoiceNotify($config);

if (1) { //发起
    /**
     * @var \VoiceNotify\Http\JuMeiResponse $response
     */
    $response = $voiceNotify->send('182*******', 'JuMei');
    var_dump($response->getCode(), $response->getBody(), $response->getMessage(), $response->getError());
    var_dump($response->isSuccess(),$response->getCallId(), $response->getTaskNo());
}

if (1) { //回调验证
    $notify = json_decode('{"callId":"YYTZ90224*************","callDesc":"110","callStatus":"1","callStatusText":"失败"}', true);
    
    $response = $voiceNotify->notify('JuMei', $notify);
    
    /**
     * @var \VoiceNotify\Notify\JuMeiNoNotify $response
     */
    var_dump($response->getCallId(), $response->getCallStatus(), $response->getCallStatusText());r_dump($response->getCallId(), $response->getCallStatus(), $response->getCallStatusText());

}

```