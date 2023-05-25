<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

class DateType implements BaseTypeInterface
{
    const E_MSG_PATTERN = 'field with name %s must be date like year-month-day';

    public function validate($value): bool
    {
        return strtotime($value);
    }

    public function __toString(): string
    {
        return 'date';
    }
    public function generateErrorMessage(string $fieldName): string
    {
        return sprintf(self::E_MSG_PATTERN, $fieldName);
    }
}
