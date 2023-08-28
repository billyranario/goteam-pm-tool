<?php

namespace App\Core;

class ServiceResponse 
{

    /**
     * @var bool $success
     * @var bool $error 
     * @var string|null $message
     * @var mixed $data
     */
    private bool $success = false;
    private bool $error = false;
    private ?string $message = null;
    private mixed $data = null;
    
    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
        $this->error = !$success;
    }

    /**
     * @param bool $error
     */
    public function setError(bool $error): void
    {
        $this->error = $error;
        $this->success = !$error;
    }

    /**
     * @param string | null $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    /**
     * @param mixed $data
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isSucces(): bool
    {
        return $this->success;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->error;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return mixed    
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Create success response
     * @param string|null $message
     * @param mixed $data 
     * @return ServiceResponse
     */
    public static function success(?string $message, mixed $data = null): ServiceResponse
    {
        $response = new ServiceResponse();

        $response->setSuccess(true);
        $response->setMessage($message);
        $response->setData($data);

        return $response;
    }

    /**
     * Create error response
     * @param string|null $message
     * @param mixed $data 
     * @return ServiceResponse
     */
    public static function error(?string $message, mixed $data = null): ServiceResponse
    {
        $response = new ServiceResponse();

        $response->setError(true);
        $response->setMessage($message);
        $response->setData($data);

        return $response;
    }
}