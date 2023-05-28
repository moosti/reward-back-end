<?php

namespace App\Services\Reward\ValidationRules;

use App\Services\Reward\Enums\RewardsEnum;
use App\Services\Reward\RewardModels\Fields\FieldObject;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class RewardFieldNameRule implements ValidationRule, DataAwareRule
{
    protected array $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    private function getField($name): ?FieldObject
    {
        $rewardObject = RewardsEnum::tryFrom((int) $this->data['id'])?->getObject();

        return $rewardObject?->getFieldByName($name);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $field = $this->getField($value);

        if (is_null($field)) {
            $fail("field with name '$value' not exist in this reward");
        }
    }
}
