<?php

namespace App\Services\Reward;

use App\Services\Reward\Enums\RewardsEnum;
use App\Services\Reward\RewardModels\BaseReward;
use App\Services\Reward\RewardModels\Fields\FieldObject;

class RewardService
{

    public function getAllRewards(): array
    {
        $allRewards = RewardsEnum::cases();
        $result = [];

        foreach ($allRewards as $reward) {
            if ($rewardObject = $reward->getObject()) {
                $result[] = $rewardObject->getInfo();
            }
        }

        return $result;
    }

    public function getRewardFields(BaseReward $reward): array
    {
        $fields = $reward->getFields();

        return array_map(function(FieldObject $field) {
            $items = [];
            if (property_exists($field->type, 'items')) {
                $items = $this->formatFieldTypeItems($field->type->items);
            }
            return [...$field->toArray(), 'items' => $items];
        }, $fields);
    }

    public function rewardValidateFields(BaseReward $reward, array $fields): array
    {
        $messages = [];

        foreach ($fields as $field) {
            $validationDto = $reward->validateField($field['name'], $field['value']);
            if (! $validationDto->isValid) {
                $messages[$field['name']] = $validationDto->errorMessage;
            }
        }

        return $messages;
    }

    private function formatFieldTypeItems(array $items): array
    {
        return array_map(
            fn($key, $value) => ['id' => $key, 'title' => $value],
            array_keys($items),
            $items
        );
    }
}
