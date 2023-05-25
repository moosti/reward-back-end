<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

class NumericType implements BaseTypeInterface
{
    const E_MSG_PATTERN = 'field with name %s must be numeric';

    public function validate($value): bool
    {
        return is_numeric($value);
    }

    public function __toString(): string
    {
        return 'numeric';
    }
    public function generateErrorMessage(string $fieldName): string
    {
        return sprintf(self::E_MSG_PATTERN, $fieldName);
    }
}
