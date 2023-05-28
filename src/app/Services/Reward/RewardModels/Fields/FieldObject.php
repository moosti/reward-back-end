<?php

namespace App\Services\Reward\RewardModels\Fields;

use App\Services\Reward\RewardModels\Fields\Types\BaseTypeInterface;

class FieldObject
{
    public function __construct(
        public BaseTypeInterface $type,
        public BaseTypeInterface $valueType,
        public string            $name,
        public string            $label,
    )
    {
    }

    /**
     * @return array<string>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'type' => (string)$this->type,
            'value_type' => (string)$this->valueType
        ];
    }
}
