<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest 
{

    /**
     * Transform input value to string.
     * @param string $key
     * @param string|null $defaultValue
     * @return string|null
     */
    public function getInputAsString(string $key, ?string $defaultValue = ''): ?string
    {
        $value = $this->input($key);
        return is_null($value) ? $defaultValue : (string) $value;
    }

    /**
     * Transform input value to int.
     * @param string $key
     * @param int|null $defaultValue
     * @return int|null
     */
    public function getInputAsInt(string $key, ?int $defaultValue = 0): ?int
    {
        $value = $this->input($key);
        return is_null($value) ? $defaultValue : (int) $value;
    }

    /**
     * Transform input value to float.
     * @param string $key
     * @param float|null
     * @return float|null
     */
    public function getInputAsFloat(string $key, ?float $defaultValue = 0.0): ?float
    {
        $value = $this->input($key);
        return is_null($value) ? $defaultValue : (float) $value;
    }

    /**
     * Transform input value to boolean.
     * @param string $key
     * @param bool|null $defaultValue
     * @return bool|null
     */
    public function getInputAsBoolean(string $key, ?bool $defaultValue = false): ?bool
    {
        $value = $this->input($key);
        return is_null($value) ? $defaultValue : filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Transform input value to array.
     * @param string $key
     * @param array|null $defaultValue
     * @return array|null
     */
    public function getInputAsArray(string $key, ?array $defaultValue = []): ?array
    {
        $value = $this->input($key);
        return is_null($value) ? $defaultValue : (array) $value;
    }

    /**
     * Transform input value to array from a comma separated string.
     * @param string $key
     * @return array|null
     */
    public function getInputAsArrayFromCommaSeparatedString(string $key): ?array
    {
        $value = $this->input($key);

        if (empty($value)) {
            return null;
        }

        return explode(',', (string) $value);
    }
}