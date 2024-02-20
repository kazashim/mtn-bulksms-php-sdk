# MTN API SDK

PHP SDK for MTN API, providing methods for token retrieval and SMS sending.

## Installation

```cmd
composer mtn-sms/mtn-bulksms-php-sdk
```

## Usage

```php
<?php

require_once 'vendor/autoload.php';

use MtnApiSdk\MtnApi;

$clientId = "YOUR_CLIENT_ID";
$clientSecret = "YOUR_CLIENT_SECRET";
$senderAddress = "MTN";
$receiverAddress = ["23423456789", "23423456790"];
$message = "Hello from PHP!";
$clientCorrelatorId = "your_client_correlator_id";
$serviceCode = "11221"; // or "131"
$requestDeliveryReceipt = false;

$mtnApi = new MtnApi($clientId, $clientSecret);
$accessToken = $mtnApi->getAccessToken();
$response = $mtnApi->sendSms($accessToken, $senderAddress, $receiverAddress, $message, $clientCorrelatorId, $serviceCode, $requestDeliveryReceipt);

print_r($response);

```

## License
This SDK is open-sourced software licensed under the MIT license.


Replace `"YOUR_CLIENT_ID"` and `"YOUR_CLIENT_SECRET"` in the usage example with your actual client credentials provided by MTN.

This SDK provides a convenient way to interact with the MTN API in your PHP projects. You can use Composer to install it in your project and then use the provided methods for token retrieval and SMS sending.

## Developer Information

- **Developer**: Kazashim Kuzasuwat
- **Email**: kazashim@cynojine.online
- **GitHub**: kazashim

## Disclaimer

This script is provided as a sample and may require further customization based on your specific requirements and environment. Use it responsibly and ensure compliance with MTN API usage policies and terms of service.

For more information, refer to the [MTN Developer Portal](https://developer.mtn.com/) and the official [MTN API documentation](https://developer.mtn.com/docs/overview).
