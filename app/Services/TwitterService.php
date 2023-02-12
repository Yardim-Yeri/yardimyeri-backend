<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Http;
use Termwind\Components\Dd;

/**
 * Class TwitterService
 * @package App\Services
 */
class TwitterService
{
    // base url for twitter api
    const BASE_URL = 'https://api.twitter.com/';

    // send tweet

    /**
     * @param $message
     * @return mixed
     */

    public static function sendTweet($message)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::BASE_URL.'2/tweets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'text' => $message
            ]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: OAuth oauth_consumer_key="'.env('OAUTH_CONSUMER_KEY').'",oauth_token="'.env('OAUTH_KEY').'",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1676103303",oauth_nonce="6tW6Oci7Mza",oauth_version="1.0",oauth_signature="oZmO1Kxpb21wbv0B77%2BdTNrMQ%2F0%3D"',
                'Content-Type: application/json',
                'Cookie: guest_id=v1%3A167610308945802700'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
