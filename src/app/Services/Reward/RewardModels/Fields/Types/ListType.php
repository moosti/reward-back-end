<?php

namespace App\Services\Reward\RewardModels\Fields\Types;

class ListType implements BaseTypeInterface
{
    const E_MSG_PATTERN = 'value for field with name %s not in prepare list';

    public function __construct(public array $items)
    {
    }

    public function validate($value): bool
    {
        return array_key_exists($value, $this->items);
    }

    public function generateErrorMessage(string $fieldName): string
    {
        return sprintf(self::E_MSG_PATTERN, $fieldName);
    }

    public function __toString(): string
    {
        return 'list';
    }
}
