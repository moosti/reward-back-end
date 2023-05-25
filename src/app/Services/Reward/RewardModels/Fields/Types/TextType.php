<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

class TextType implements BaseTypeInterface
{
    const E_MSG_PATTERN = 'value for field with name %s must be string';

    public function validate($value): bool
    {
        return is_string($value);
    }

    public function generateErrorMessage(string $fieldName): string
    {
        return sprintf(self::E_MSG_PATTERN, $fieldName);
    }

    public function __toString(): string
    {
        return 'text';
    }
}
