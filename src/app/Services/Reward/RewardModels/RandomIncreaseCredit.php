<?php

namespace App\Services\Reward\RewardModels;

use App\Services\Reward\RewardModels\Fields\FieldObject;
use App\Services\Reward\RewardModels\Fields\Types\CurrencyType;
use App\Services\Reward\RewardModels\Fields\Types\DateType;
use App\Services\Reward\RewardModels\Fields\Types\TextType;

class RandomIncreaseCredit extends BaseReward
{
    private int $id = 7;

    private string $title = 'افزایش اعتبار تصادفی';

    public function getFields(): array
    {
        return [
            new FieldObject(
                type: new TextType(),
                valueType: new CurrencyType(),
                name: 'minPrice',
                label: 'حداقل مبلغ'
            ),
            new FieldObject(
                type: new TextType(),
                valueType: new CurrencyType(),
                name: 'maxPrice',
                label: 'حداکثر مبلغ'
            ),
            new FieldObject(
                type: new TextType(),
                valueType: new DateType(),
                name: 'dueDate',
                label: 'تاریخ انقضا'
            ),
        ];
    }

    public function getInfo(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title
        ];
    }
}
