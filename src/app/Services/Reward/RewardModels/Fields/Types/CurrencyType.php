<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

class CurrencyType implements BaseTypeInterface
{
    const E_MSG_PATTERN = 'value for field with name %s must be currency like 200,000';

    public function validate($value): bool
    {
        $value = str_replace(',', '', $value);
        return preg_match('/^\d*(\.\d{2})?$/', $value);
    }

    public function generateErrorMessage(string $fieldName): string
    {
        return sprintf(self::E_MSG_PATTERN, $fieldName);
    }

    public function __toString(): string
    {
        return 'currency';
    }
}
