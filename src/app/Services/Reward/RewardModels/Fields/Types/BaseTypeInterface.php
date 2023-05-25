<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

interface BaseTypeInterface
{
    public function validate(mixed $value): bool;

    public function generateErrorMessage(string $fieldName): string;

    public function __toString(): string;
}
