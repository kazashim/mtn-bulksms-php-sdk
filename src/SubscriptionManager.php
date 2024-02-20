<?php

namespace MtnApiSdk;

use Exception;

class SubscriptionManager
{
    public static function subscribe($accessToken, $callbackUrl, $targetSystem, $serviceCode)
    {
        $url = "https://api.mtn.com/v3/sms/messages/sms/subscription";
        $body = [
            'callbackUrl' => $callbackUrl,
            'targetSystem' => $targetSystem,
            'serviceCode' => $serviceCode
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public static function updateSubscription($accessToken, $subscriptionId, $body)
    {
        $url = "https://api.mtn.com/v3/sms/messages/sms/subscription/$subscriptionId";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public static function deleteSubscription($accessToken, $subscriptionId)
    {
        $url = "https://api.mtn.com/v3/sms/messages/sms/subscription/$subscriptionId";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
