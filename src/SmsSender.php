<?php

namespace MtnApiSdk;

use Exception;

class SmsSender
{
    public static function send($accessToken, $senderAddress, $receiverAddress, $message, $clientCorrelatorId, $serviceCode, $requestDeliveryReceipt)
    {
        $url = "https://api.mtn.com/v3/sms/messages/sms/outbound";
        $body = [
            'senderAddress' => $senderAddress,
            'receiverAddress' => $receiverAddress,
            'message' => $message,
            'clientCorrelatorId' => $clientCorrelatorId,
            'serviceCode' => $serviceCode,
            'requestDeliveryReceipt' => $requestDeliveryReceipt
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
}
