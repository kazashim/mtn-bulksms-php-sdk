<?php

namespace MtnApiSdk;

class MtnApi
{
    private $clientId;
    private $clientSecret;
    private $accessTokenUrl = "https://api.mtn.com/v1/oauth/access_token/accesstoken";
    private $smsUrl = "https://api.mtn.com/v3/sms/messages/sms/outbound";

    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getAccessToken()
    {
        $params = [
            'grant_type' => 'client_credentials',
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->accessTokenUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic " . base64_encode($this->clientId . ":" . $this->clientSecret),
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true)['access_token'];
    }

    public function sendSms($accessToken, $senderAddress, $receiverAddress, $message, $clientCorrelatorId, $serviceCode, $requestDeliveryReceipt = false)
    {
        $params = [
            "senderAddress" => $senderAddress,
            "receiverAddress" => $receiverAddress,
            "message" => $message,
            "clientCorrelatorId" => $clientCorrelatorId,
            "serviceCode" => $serviceCode,
            "requestDeliveryReceipt" => $requestDeliveryReceipt
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->smsUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $accessToken",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
