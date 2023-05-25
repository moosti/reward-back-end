<?php

namespace App\Services\Reward\RewardModels;

use App\Services\Reward\DTO\ValidateFieldResultDto;
use App\Services\Reward\RewardModels\Fields\FieldObject;

abstract class BaseReward
{
    public abstract function getFields(): array;

    public abstract function getInfo(): array;

    final public function getFieldByName(string $name): ?FieldObject
    {
        foreach ( $this->getFields() as $field) {
            if ($field->name === $name) {
                return $field;
            }
        }
        return null;
    }

    final public function validateField(string $fieldName, mixed $value): ValidateFieldResultDto
    {
        $message = '';
        $field = $this->getFieldByName($fieldName);

        if (is_null($field)) {
            return ValidateFieldResultDto::make(false, "field with name $fieldName not exist in this reward");
        }

        $isValid = $field->valueType->validate($value);
        if (!$isValid) {
            $message = $field->valueType->generateErrorMessage($fieldName);
        }
        return ValidateFieldResultDto::make($isValid, $message);
    }

}
