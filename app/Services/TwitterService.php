<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\SmsData;
use App\Models\TweetData;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;
use Termwind\Components\Dd;

/**
 * Class TwitterService
 * @package App\Services
 */
class TwitterService
{
    // base url for twitter api
    const BASE_URL = 'https://api.twitter.com/';

    /**
     * @param $message
     * @return mixed
     */

    public static function sendTweet($message)
    {
       return self::post('2/tweets', [
            'text' => $message,
        ])->json();
    }

    public static function deleteTweet($tweetId)
    {
        return self::delete('2/tweets/'.$tweetId)->json();
    }

    public static function oAuthHeader(string $method,string $path)
    {
        $oauth_access_token = env("TWITTER_ACCESS_TOKEN");
        $oauth_access_token_secret =  env("TWITTER_ACCESS_TOKEN_SECRET");
        $oauth_consumer_key =  env("TWITTER_CONSUMER_KEY");
        $oauth_consumer_secret =  env("TWITTER_CONSUMER_SECRET");

        // OAuth 1.0 params
        $params = array(
            'oauth_consumer_key' => $oauth_consumer_key,
            'oauth_nonce' => mt_rand(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_token' => $oauth_access_token,
            'oauth_version' => '1.0',
        );

        // define request method and url
        $method = $method;
        $url = self::BASE_URL.$path;

        // sort params alphabetically and urlencode
        uksort($params, 'strcmp');
        $params = array_map('urlencode', $params);

        // merge as query string
        $query = urldecode(http_build_query($params, '', '&'));

        // create base string
        $base_string = $method . '&' . urlencode($url) . '&' . urlencode($query);

        // (secret key)
        $consumer_secret = $oauth_consumer_secret;
        $access_secret = $oauth_access_token_secret;
        $key = urlencode($consumer_secret) . '&' . urlencode($access_secret);

        // signature with HMAC-SHA1
        $signature = base64_encode(hash_hmac('sha1', $base_string, $key, true));

        // add signature to params
        $params['oauth_signature'] = urlencode($signature);

        // merge params for request header
        $query = urldecode(http_build_query($params, '', ','));

        return 'OAuth ' . str_replace(',', ', ', $query);
    }

    public static function post(string $path, array $body)
    {
        $header = self::oAuthHeader('POST', $path);
        $url = self::BASE_URL.$path;
        $response = Http::withHeaders([
            'Authorization' => $header,
            'Content-Type' => 'application/json',
        ])->post($url, $body);

        return $response;
    }

    public static function delete(string $path)
    {
        $header = self::oAuthHeader('DELETE', $path);
        $url = self::BASE_URL.$path;
        $response = Http::withHeaders([
            'Authorization' => $header,
            'Content-Type' => 'application/json',
        ])->delete($url);

        return $response;
    }
}
