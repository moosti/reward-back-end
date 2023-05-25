<?php

namespace App\Services\Reward\RewardModels;

use App\Services\Reward\RewardModels\Fields\FieldObject;
use App\Services\Reward\RewardModels\Fields\Types\ListType;
use App\Services\Reward\RewardModels\Fields\Types\NumericType;

class Medal extends BaseReward
{
    private int $id = 8;

    private string $title = 'مدال';

    public function getFields(): array
    {
        return [
            new FieldObject(
                type: new ListType([1 => 'gold', 2 => 'silver', 3 => 'bronze']),
                valueType: new NumericType(),
                name: 'id',
                label: 'شناسه'
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
