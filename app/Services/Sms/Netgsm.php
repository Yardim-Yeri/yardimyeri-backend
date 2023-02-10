<?php


namespace App\Services\Sms;

use DOMDocument;
use DOMException;
use Illuminate\Support\Facades\Http;

class Netgsm implements GatewayInterface
{

    /**
     * @throws DOMException
     */
    public function send($receivers, string $message)
    {
        $url = 'https://api.netgsm.com.tr/sms/send/xml';

        $userCode = config('app.sms_user_code');
        $password = config('app.sms_user_password');
        $msgHeader = config('app.sms_message_header');

        if (!$userCode || !$password || !$msgHeader){
            return response()->json([
                'status' => false,
                'message' => 'CREDENTIALS_REQUIRED'
            ], 403);
        }

        if (!is_array($receivers)) {
            $receivers = [$receivers];
        }

        $dom = new DOMDocument('1.0', 'utf-8');

        $langAttribute = $dom->createAttribute('dil');
        $company = $dom->createElement('company', 'Netgsm');
        $langAttribute->value = 'TR';
        $company->appendChild($langAttribute);

        $root = $dom->appendChild($dom->createElement('mainbody'));

        $header = $root->appendChild($dom->createElement('header'));
        $header->appendChild($company);
        $header->appendChild($dom->createElement('usercode', $userCode));
        $header->appendChild($dom->createElement('password', $password));
        $header->appendChild($dom->createElement('type', '1:n'));
        $header->appendChild($dom->createElement('msgheader', $msgHeader));

        $body = $root->appendChild($dom->createElement('body'));
        $msg = $body->appendChild($dom->createElement('msg'));
        $msg->appendChild($dom->createCDATASection($message));

        foreach ($receivers as $to) {
            $body->appendChild($dom->createElement('no', $to));
        }

        $xml = $dom->saveXML();

        $response = Http::withBody(
            $xml, 'text/xml'
        )->post($url);

        if (in_array($response->body(), ['20','30','40','50','51','70','80','85'])){
            return response()->json([
                'status' => false,
                'message' => 'SMS_NOT_SEND'
            ], 406);
        }

        return true;
    }
}
