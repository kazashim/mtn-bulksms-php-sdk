<?php

namespace MtnApiSdk;

use Exception;

class ApiException extends Exception
{
    protected $statusCode;
    protected $statusMessage;
    protected $supportMessage;
    protected $transactionId;
    protected $timestamp;
    protected $path;
    protected $method;

    public function __construct($statusCode, $statusMessage, $supportMessage = null, $transactionId = null, $timestamp = null, $path = null, $method = null)
    {
        $this->statusCode = $statusCode;
        $this->statusMessage = $statusMessage;
        $this->supportMessage = $supportMessage;
        $this->transactionId = $transactionId;
        $this->timestamp = $timestamp;
        $this->path = $path;
        $this->method = $method;

        $message = "Error occurred with status code: $statusCode, message: $statusMessage";
        parent::__construct($message);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    public function getSupportMessage()
    {
        return $this->supportMessage;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }
}
