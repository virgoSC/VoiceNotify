<?php

namespace VoiceNotify;

use VoiceNotify\Http\Response;
use VoiceNotify\Notify\Notify;

class VoiceNotify
{
    private $allocators = [];

    public function __construct($configs)
    {
        foreach ($configs as $allocator => $config) {
            if (!key_exists($allocator, $this->allocators)) {
                $allocatorName = "VoiceNotify\\Allocator\\" . $allocator;
                if (class_exists($allocatorName)) {
                    $this->allocators[$allocator] = new $allocatorName($config);
                }
            }
        }
    }

    public function send(string $phone, array $param, string $facilitator = ''): Response
    {
        if (!$facilitator) {
            $allocator = reset($this->allocators);
        } elseif (key_exists($facilitator, $this->allocators)) {
            $allocator = $this->allocators[$facilitator];
        } else {
            $allocator = reset($this->allocators);
        }
        return $allocator->send($phone, $param);
    }

    public function notify($facilitator, $data): Notify
    {
        if (key_exists($facilitator, $this->allocators)) {
            return $this->allocators[$facilitator]->notify($data);
        }
        return (new Notify());
    }
}