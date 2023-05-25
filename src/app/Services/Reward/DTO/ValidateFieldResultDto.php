<?php

namespace App\Services\Reward\DTO;

readonly class ValidateFieldResultDto
{
    public function __construct(public bool $isValid, public string $errorMessage)
    {
    }

    public static function make(bool $isValid, string $message): self
    {
        return new self($isValid, $message);
    }
}
