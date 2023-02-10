<?php

namespace App\Services\Sms;

interface GatewayInterface
{
    /**
     * @param $receivers
     * @param string $message
     * @return bool
     */
    public function send($receivers, string $message);
}
