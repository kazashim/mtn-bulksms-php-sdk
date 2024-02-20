<?php

namespace MtnApiSdk;

use Exception;

class AccessToken
{
    public static function getToken($clientId, $clientSecret)
    {
        $tokenUrl = "https://api.mtn.com/v1/oauth/access_token/accesstoken?grant_type=client_credentials";
        $credentials = base64_encode($clientId . ':' . $clientSecret);

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

        if(isset($responseData['access_token'])) {
            return $responseData['access_token'];
        } else {
            throw new ApiException("Failed to obtain access token");
        }
    }
}
