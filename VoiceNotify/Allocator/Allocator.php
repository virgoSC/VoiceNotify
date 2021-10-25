<?php

namespace VoiceNotify\Allocator;

interface Allocator
{
    public function Send(string $mobile, array $param);
}