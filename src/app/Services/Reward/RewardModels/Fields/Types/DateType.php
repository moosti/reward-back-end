<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

class DateType implements BaseTypeInterface
{
    const E_MSG_PATTERN = 'field with name %s must be date like Y-M-D and in future';

    public function validate($value): bool
    {
        if (! $time = strtotime($value)) {
            return false;
        }
        return $time > time();
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
