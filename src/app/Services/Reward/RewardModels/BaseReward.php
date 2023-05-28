<?php

namespace App\Services\Reward\RewardModels;

use App\Services\Reward\DTO\ValidateFieldResultDto;
use App\Services\Reward\RewardModels\Fields\FieldObject;
use App\Services\Reward\RewardModels\Fields\Types\BaseTypeInterface;
use App\Services\Reward\RewardModels\Fields\Types\ListType;

abstract class BaseReward
{
    /**
     * @return array<FieldObject>
     */
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
            return ValidateFieldResultDto::make(
                false,
                "field with name $fieldName not exist in this reward"
            );
        }

        $validationDto = $this->typeValidation($fieldName, $field->valueType, $value);
        if (! $validationDto->isValid) {
            return $validationDto;
        }

        if ($field->type instanceof ListType) {
            $validationDto = $this->typeValidation($fieldName, $field->type, $value);
        }
        
        return $validationDto;
    }

    private function typeValidation(string $fieldName, BaseTypeInterface $type, mixed $value): ValidateFieldResultDto
    {
        $message = '';
        $isValid = $type->validate($value);

        if (! $isValid) {
            $message = $type->generateErrorMessage($fieldName);
        }

        return ValidateFieldResultDto::make($isValid, $message);
    }

}
