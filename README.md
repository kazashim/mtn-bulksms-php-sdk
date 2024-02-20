# MTN API SDK

## Overview

The MTN API SDK provides a PHP wrapper for interacting with the MTN Short Message Service (SMS) API. This SDK simplifies the process of sending outbound SMS messages, managing subscriptions, and handling exceptions.

## Installation

You can install the MTN API SDK via Composer. Run the following command in your project directory:

```bash
composer mtn-sms/mtn-bulksms-php-sdk
```



## Usage

### 1. Obtain Access Token

Before using the SDK, you need to obtain an access token using the provided Client Credentials OAuth Flow. You can do this by making a POST request to the token URL with your client credentials.

```php
use MtnApiSdk\AccessToken;

$accessToken = AccessToken::getAccessToken($clientId, $clientSecret);
```

Replace `$clientId` and `$clientSecret` with your actual client credentials.

### 2. Sending SMS

To send an SMS message, use the `SmsSender` class.

```php
use MtnApiSdk\SmsSender;

$senderAddress = "MTN";
$receiverAddress = ["23423456789", "23423456790"];
$message = "Hello from MTN API SDK";
$clientCorrelatorId = "123456";
$serviceCode = "11221";
$requestDeliveryReceipt = false;

$response = SmsSender::sendSms($accessToken, $senderAddress, $receiverAddress, $message, $clientCorrelatorId, $serviceCode, $requestDeliveryReceipt);

// Handle response
print_r($response);
```

### 3. Managing Subscriptions

You can manage subscriptions using the `SubscriptionManager` class.

#### 3.1 Subscribe

```php
use MtnApiSdk\SubscriptionManager;

$callbackUrl = "https://example.com/callback";
$targetSystem = "YourSystem";
$serviceCode = "11221";

$response = SubscriptionManager::subscribe($accessToken, $callbackUrl, $targetSystem, $serviceCode);

// Handle response
print_r($response);
```

#### 3.2 Update Subscription

```php
use MtnApiSdk\SubscriptionManager;

$subscriptionId = "your-subscription-id";
$body = [
    'serviceCode' => '11221',
    'callbackUrl' => 'https://example.com/callback',
    'deliveryReportUrl' => 'https://example.com/delivery-report',
    'targetSystem' => 'YourSystem'
];

$response = SubscriptionManager::updateSubscription($accessToken, $subscriptionId, $body);

// Handle response
print_r($response);
```

#### 3.3 Delete Subscription

```php
use MtnApiSdk\SubscriptionManager;

$subscriptionId = "your-subscription-id";

$response = SubscriptionManager::deleteSubscription($accessToken, $subscriptionId);

// Handle response
print_r($response);
```

### 4. Handling Exceptions

The SDK throws `ApiException` in case of errors. You can catch and handle these exceptions as follows:

```php
use MtnApiSdk\ApiException;

try {
    // Code that may throw an exception
} catch (ApiException $e) {
    // Handle API exception
    echo "Error occurred: " . $e->getMessage();
}
```

## Adding Credentials

You should store your client credentials securely. It's recommended to use environment variables or a configuration file to store sensitive information.

### Using Environment Variables

You can set environment variables in your `.env` file:

```dotenv
MTN_CLIENT_ID=your-client-id
MTN_CLIENT_SECRET=your-client-secret
```

Then, you can access these variables in your code:

```php
$clientId = getenv('MTN_CLIENT_ID');
$clientSecret = getenv('MTN_CLIENT_SECRET');
```

### Using Configuration File

You can store your credentials in a configuration file (e.g., `config.php`):

```php
<?php

return [
    'clientId' => 'your-client-id',
    'clientSecret' => 'your-client-secret'
];
```

Then, include this file in your code:

```php
$config = include('config.php');
$clientId = $config['clientId'];
$clientSecret = $config['clientSecret'];
```

## Example Test
Here's an example script that demonstrates how to use the MTN API SDK to send an SMS message:

```php
<?php

require_once 'vendor/autoload.php';

use MtnApiSdk\AccessToken;
use MtnApiSdk\SmsSender;
use MtnApiSdk\ApiException;

// Replace these values with your actual credentials
$clientId = getenv('MTN_CLIENT_ID');
$clientSecret = getenv('MTN_CLIENT_SECRET');

// Obtain access token
$accessToken = AccessToken::getAccessToken($clientId, $clientSecret);

// SMS details
$senderAddress = "MTN";
$receiverAddress = ["23423456789", "23423456790"];
$message = "Hello from MTN API SDK";
$clientCorrelatorId = "123456";
$serviceCode = "11221";
$requestDeliveryReceipt = false;

try {
    // Send SMS
    $response = SmsSender::sendSms($accessToken, $senderAddress, $receiverAddress, $message, $clientCorrelatorId, $serviceCode, $requestDeliveryReceipt);

    // Handle response
    print_r($response);
} catch (ApiException $e) {
    // Handle API exception
    echo "Error occurred: " . $e->getMessage();
}
```

Make sure to replace `your-client-id` and `your-client-secret` with your actual MTN client credentials. Additionally, ensure you have set up your environment variables or configuration file to securely store your credentials.

To test this example:

1. Save the script to a file (e.g., `send_sms_example.php`).
2. Set up your client credentials either via environment variables or a configuration file.
3. Run the script using PHP:

```
php send_sms_example.php
```

This script will obtain an access token, send an SMS message using the MTN API SDK, and print the response or handle any exceptions that occur during the process. Adjust the SMS details and error handling as needed for your use case.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please create a pull request or open an issue on GitHub.

## License

This SDK is open-source and available under the MIT License. See the [LICENSE](LICENSE) file for details.

---
