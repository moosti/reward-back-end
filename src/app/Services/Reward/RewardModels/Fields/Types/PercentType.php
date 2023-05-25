<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

class PercentType implements BaseTypeInterface
{
    const E_MSG_PATTERN = 'field with name %s must be between 1 and 100';

    public function validate($value): bool
    {
        return $value > 0 && $value <= 100;
    }

    public function __toString(): string
    {
        return 'percent';
    }
    public function generateErrorMessage(string $fieldName): string
    {
        return sprintf(self::E_MSG_PATTERN, $fieldName);
    }
}
