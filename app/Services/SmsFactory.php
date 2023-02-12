<?php

namespace App\Services;

use App\Services\Sms\GatewayInterface;
use Exception;
use Illuminate\Http\JsonResponse;

class SmsFactory
{
    /**
     * @return GatewayInterface|JsonResponse
     * @throws Exception
     */
    public static function create()
    {
        $gateway = config('app.sms_gateway');
        if (!isset($gateway)) {
            return response()->json([
                'status' => false,
                'message' => 'SMS_GATEWAY_NOT_FOUND'
            ], 404);
        }

        $class = 'App\\Services\\Sms\\' . $gateway;

        if (!class_exists($class)) {
            return response()->json([
                'status' => false,
                'message' => 'SMS_CLASS_NOT_FOUND'
            ], 404);
        }

        return new $class();
    }
}
