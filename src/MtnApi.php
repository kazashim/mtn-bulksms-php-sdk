<?php

namespace MtnApiSdk;

class MtnApi
{
    private $clientId;
    private $clientSecret;

    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getAccessToken()
    {
        $tokenUrl = "https://api.mtn.com/v1/oauth/access_token/accesstoken?grant_type=client_credentials";
        $credentials = base64_encode($this->clientId . ':' . $this->clientSecret);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic $credentials",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);
        return $responseData['access_token'] ?? null;
    }

    public function sendSms($senderAddress, $receiverAddress, $message, $clientCorrelatorId, $serviceCode, $requestDeliveryReceipt = false)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            throw new ApiException("Failed to obtain access token");
        }

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
